<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Product as MainModel;
use App\Helper\Functions;
use App\Product_category;
use App\Product_tags;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends AdminController
{
    protected $pathView = "admin.core.";

    protected $resize = [
        'thumbnail' => ['width' => 100],
        'standard' => ['width' => 150],
    ];

    protected $fieldForm = [
        'general_tab' => [
            'tab_label' => 'General (VI)',
            'items' => [
                ['label' => 'Tên sản phẩm', 'name' => 'name', 'type' => 'text'],
                ['label' => 'Số lượng', 'name' => 'amount', 'type' => 'text'],
                ['label' => 'Mô tả', 'name' => 'description', 'type' => 'textarea'],
                ['label' => 'Giá gốc', 'name' => 'price_base', 'type' => 'text'],
                ['label' => 'Giá bán', 'name' => 'price_final', 'type' => 'text'],
                ['label' => 'Thông tin sản phẩm', 'name' => 'information', 'type' => 'ckeditor'],
                ['label' => 'Hỉnh ảnh', 'name' => 'picture', 'type' => 'file'],
                ['label' => 'Hình ảnh mô tả', 'name' => 'gallery', 'type' => 'multipleFile'],
                ['label' => 'Danh mục sản phẩm', 'name' => 'category_id', 'type' => 'select', 'modal' => Product_category::class],
                ['label' => 'Nhãn sản phẩm', 'name' => 'tag_id', 'type' => 'multipleSelect', 'modal' => Product_tags::class],
                ['label' => 'Loại sản phẩm', 'name' => 'type', 'type' => 'select', 'data-source' => [
                    'Bán chạy' => 'bán chạy',
                    'Mới' => 'mới',
                    'Giảm giá' => 'giảm giá',
                ]],
                ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'checkbox'],

            ]
        ],

        'seo_tab' => [
            'tab_label' => 'Meta (VI)',
            'items' => [
                ['label' => 'Slug', 'name' => 'slug', 'type' => 'slug'],
            ]
        ],
    ];

    protected $removeRedundant = ["_token", "tag_id"];

    protected $fieldList = [
        ['label' => 'Mã', 'name' => 'id', 'type' => 'id'],
        ['label' => 'Tên', 'name' => 'name', 'type' => 'text'],
        ['label' => 'Ảnh', 'name' => 'picture', 'type' => 'picture'],
        ['label' => 'Số lượng', 'name' => 'amount', 'type' => 'text'],
        ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'status'],
        ['label' => 'Ngày tạo', 'name' => 'created_at', 'type' => 'dateFormat'],
        ['label' => 'Ngày cập nhật', 'name' => 'updated_at', 'type' => 'dateFormat']
    ];

    public function __construct(){
        //Get name of Controller
        $getControllerName = (new \ReflectionClass($this))->getShortName();
        $shortController = Functions::getModelName($getControllerName);
        $this -> folderUpload = $shortController;
        $this -> controllerName = $shortController;
        view()->share("shortController", $shortController);
        view()->share("folderUpload", $this -> folderUpload);
        view()->share("controllerName",$this -> controllerName);
        view()->share("fieldForm", $this -> fieldForm);
        view()->share("fieldList", $this -> fieldList);
        $this -> model = new MainModel();
    }

    public function store(Request $request){
        //Gửi request sang hàm validateForm để xác thực
        $this -> validateForm($request);
        $data = $this -> getData($request -> all());
        //Gán các trường trong db bằng value
        if($data){
            foreach ($data as $key => $value){
                if( is_object($value) ){
                    $value = $this -> uploadImage($value);
                }
                if($key == "gallery"){
                    if( is_object($value[0]) ){
                        $value = $this -> uploadMultipleImage($value);
                    }
                }
                $this -> model -> $key = $value; //create
            }
        }

        $this -> model -> save(); //store

        // Xử lý với tags
        if( isset($request->tag_id)  && count($request->tag_id) > 0 ){
            $tag_id = $request->tag_id;
            $tags_id = [];
            foreach($tag_id as $k => $v){
                // Kiểm tra xem có phải là số hoặc chữ số hay không
                if(is_numeric ($v)){
                    $tags_id[] = $v;
                }
            }
            // attach(array);
            $this-> model -> tags() -> attach($tags_id);
        }

        Session::flash("action_success", "Thêm mới thành công");
        return redirect() -> route("admin." . $this -> controllerName . ".index");
    }

    public function update(Request $request, $id){
        //dd($request ->all());
        $record = $this -> model -> find($id);

        $this -> validateForm($request);
        $data = $this -> getData($request -> all());

        foreach ($data as $key => $value){
            if(is_object($value)){
                $this -> deleteImage($record -> {$key});
                $value = $this->uploadImage($value);
            }
            if($key == "gallery" ){
                if( is_object($value[0]) ){
                    $value = $this -> uploadMultipleImage($value);
                }
            }
            $record[$key] = $value;
        }

        $record -> save();

        if(isset($request -> tag_id) && count($request -> tag_id) > 0)
        {
            $tag_id = $request -> tag_id;
            $tags_id = [];
            foreach ($tag_id as $key => $value){
                if(is_numeric($value)){
                    $tags_id[] = $value;
                }
            }

            $record -> tags() -> sync($tags_id);
        }

        Session::flash("action_success", "Sửa mới thành công");
        return redirect() -> route("admin." . $this -> controllerName . ".index");
    }

    //Xóa review của product
    public function deleteReview($id){
        $review = Review::find($id);

        if($review){
            $review -> delete();

            return response() -> json([
                "code" => 200,
            ],200);
        }
    }

    public function uploadMultipleImage($object){
        $data = [];
        foreach ($object as $key => $file){
            $data[] = $this -> uploadImage($file);
        }
        return json_encode($data);
    }
}

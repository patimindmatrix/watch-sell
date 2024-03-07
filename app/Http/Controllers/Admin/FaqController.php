<?php

namespace App\Http\Controllers\Admin;

use App\faq as MainModel; //Alias (bí danh) 'use' để gọi đến namespace App\Bank với bí danh là MainModel
use App\Helper\Functions;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FaqController extends AdminController
{
    protected $pathView = "admin.core.";

    protected $resize = [
        'thumbnail' => ['width' => 800],
        'standard' => ['width' => 100],
    ];

    protected $fieldForm = [
        'general_tab' => [
            'tab_label' => 'General (VI)',
            'items' => [
                ['label' => 'Câu hỏi', 'name' => 'question', 'type' => 'text'],
                ['label' => 'Câu trả lời', 'name' => 'answer', 'type' => 'textarea'],
                ['label' => 'Mô tả', 'name' => 'description', 'type' => 'textarea'],
                ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'checkbox'],
            ]
        ],
    ];

    protected $removeRedundant = ["_token", "tag_id"];

    protected $fieldList = [
        ['label' => 'Mã', 'name' => 'id', 'type' => 'id'],
        ['label' => 'Câu hỏi', 'name' => 'question', 'type' => 'text'],
        ['label' => 'Câu trả lời', 'name' => 'answer', 'type' => 'text'],
        ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'status'],
        ['label' => 'Ngày tạo', 'name' => 'created_at', 'type' => 'dateFormat'],
        ['label' => 'Ngày cập nhật', 'name' => 'updated_at', 'type' => 'dateFormat'],
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
        $data = $this -> getData($request -> all());
        //Gán các trường trong db bằng value
        if($data){
            foreach ($data as $key => $value){
                if( is_object($value) ){
                    $value = $this -> uploadImage($value);
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
        $record = $this -> model -> find($id);

        $this -> validateForm($request);
        $data = $this -> getData($request -> all());

        foreach ($data as $key => $value){
            if(is_object($value)){
                $this -> deleteImage($record -> {$key});
                $value = $this->uploadImage($value);
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

}

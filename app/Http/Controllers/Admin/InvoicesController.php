<?php

namespace App\Http\Controllers\Admin;

use App\Invoices;
use App\Invoices as MainModel; //Alias (bí danh) 'use' để gọi đến namespace App\Bank với bí danh là MainModel
use App\Helper\Functions;
use App\Http\Controllers\AdminController;
use App\InvoicesDetail;
use App\Product;
use App\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Str;

class InvoicesController extends AdminController
{
    protected $pathView = "admin.page.invoices.";

    protected $resize = [
        'thumbnail' => ['width' => 800],
        'standard' => ['width' => 100],
    ];

    protected $fieldForm = [];

    protected $removeRedundant = ["_token", "tag_id"];

    protected $fieldList = [
        ['label' => 'Mã', 'name' => 'name', 'type' => 'id'],
        ['label' => 'Người tạo', 'name' => 'created_by', 'type' => 'text'],
        ['label' => 'Số lượng sản phẩm', 'name' => 'amount', 'type' => 'text'],
        ['label' => 'Tổng tiền', 'name' => 'total_price', 'type' => 'numberFormat'],
        ['label' => 'Ngày tạo', 'name' => 'created_at', 'type' => 'dateFormat'],
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

    public function getProductCategories() {
        $productCategories = Product_category::all();
        return response()->json([
            'message'=>'success',
            'data'=>$productCategories
        ]);
    }

    public function getProduct($id) {
        $products = Product::where('category_id', $id)->get();

        return response()->json([
            'message'=>'success',
            'products'=>$products
        ]);
    }

    public function create() {
        $data['partners'] = Product_category::all();
        return view($this -> pathView . "form")->with($data);
    }

    public function storeOldProduct(Request $request) {
        $productID = $request->get('product_id');
        foreach ($productID as $key=>$id) {
            $product = Product::where('id', $id)->first();
            $product->amount += $request->get('amount')[$key];
            $product->price_base = $request->get('price')[$key] + ($request->get('price')[$key] * 30 / 100);
            $product->save();

            $invoiceDetail = new InvoicesDetail();
            $invoiceDetail->invoices_id = $this->model->id;
            $invoiceDetail->product_id = $id;
            $invoiceDetail->partner_id = $request->get('partner_id')[$key];
            $invoiceDetail->amount += $request->get('amount')[$key];
            $invoiceDetail->price += $request->get('price')[$key];
            $invoiceDetail->save();
        }
    }

    public function storeNewProduct(Request $request) {
        $productName = $request->get('name');

        foreach ($productName as $key=>$name) {
            $product = new Product();
            $product->name = $name;
            $product->slug = Str::slug($name);
            $product->type = 'Mới';
            $product->category_id = $request->get('partner_id')[$key];
            $product->status = 'inactive';
            $product->amount += $request->get('amount')[$key];
            $product->price_base = $request->get('price')[$key] + ($request->get('price')[$key] * 15 / 100);
            $product->save();

            $invoiceDetail = new InvoicesDetail();
            $invoiceDetail->invoices_id = $this->model->id;
            $invoiceDetail->product_id = $product->id;
            $invoiceDetail->partner_id = $request->get('partner_id')[$key];
            $invoiceDetail->amount += $request->get('amount')[$key];
            $invoiceDetail->price += $request->get('price')[$key];
            $invoiceDetail->save();
        }
    }

    public function store(Request $request)
    {
        $this->model->name = $this->generateRandomString();
        $this->model->created_by = Auth::user()->user_name;
        $this->model->amount = array_sum($request->get('amount'));
        $this->model->total_price = array_sum($request->get('price'));
        $this->model->save();

        if ( $request->get('type') === 'old' ) {
            $this->storeOldProduct($request);
        } else {
            $this->storeNewProduct($request);
        }

        return redirect() -> route("admin." . $this -> controllerName . ".index");
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function invoiceDetail(Request $request, $id){
        $data['invoice'] = Invoices::find($id);
        $data['invoiceDetail'] = $data['invoice']->invoiceDetail;
//        dd($data);
        return view($this -> pathView . "invoices_detail")->with($data);
    }
}

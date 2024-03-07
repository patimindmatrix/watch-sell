<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Helper\Functions;
use App\Product_category;
use Illuminate\Http\Request;
use App\Product_tags as MainModel;

class Product_tagsController extends AdminController
{
    protected $pathView = "admin.core.";

    protected $resize = [
        'thumbnail' => ['width' => 100],
        'standard' => ['width' => 100],
    ];

    protected $fieldForm = [
        'general_tab' => [
            'tab_label' => 'General (VI)',
            'items' => [
                ['label' => 'Tên tag', 'name' => 'name', 'type' => 'text'],
                ['label' => 'Mô tả', 'name' => 'description', 'type' => 'text'],
                ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'checkbox']
            ]
        ],

        'seo_tab' => [
            'tab_label' => 'Meta (VI)',
            'items' => [
                ['label' => 'Slug', 'name' => 'slug', 'type' => 'slug'],
                ['label' => 'Meta Title', 'name' => 'meta_title', 'type' => 'text'],
                ['label' => 'Meta Description', 'name' => 'meta_description', 'type' => 'text'],
                ['label' => 'Meta Keyword', 'name' => 'meta_keyword', 'type' => 'text']
            ]
        ],
    ];

    protected $fieldList = [
        ['label' => 'Mã', 'name' => 'id', 'type' => 'id'],
        ['label' => 'Tên', 'name' => 'name', 'type' => 'text'],
        ['label' => 'Ảnh', 'name' => 'picture', 'type' => 'picture'],
        ['label' => 'Ngày tạo', 'name' => 'created_at', 'type' => 'dateFormat'],
        ['label' => 'Ngày cập nhật', 'name' => 'updated_at', 'type' => 'dateFormat']
    ];

    protected $removeRedundant = ['token','something'];
    public function __construct(){
        //Get name of Controller
        $getControllerName = (new \ReflectionClass($this))->getShortName();
        $shortController = Functions::getModelName($getControllerName);
        $this -> folderUpload = $shortController;
        $this -> controllerName = $shortController;
        view()->share("shortController", $shortController);
        view()->share("controllerName",$this -> controllerName);
        view()->share("folderUpload", $this -> folderUpload);
        view()->share("fieldForm", $this -> fieldForm);
        view()->share("fieldList", $this -> fieldList);
        $this -> model = new MainModel();
    }


}

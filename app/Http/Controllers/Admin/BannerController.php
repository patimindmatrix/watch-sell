<?php

namespace App\Http\Controllers\Admin;

use App\Banner as MainModel;
use App\Helper\Functions;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class BannerController extends AdminController
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
                ['label' => 'Tên', 'name' => 'name', 'type' => 'text'],
                ['label' => 'Giảm giá', 'name' => 'sale', 'type' => 'text'],
                ['label' => 'Mô tả', 'name' => 'description', 'type' => 'text'],
                ['label' => 'Giá', 'name' => 'price_base', 'type' => 'text'],
                ['label' => 'Hình ảnh', 'name' => 'picture', 'type' => 'file'],
                ['label' => 'Loại banner', 'name' => 'type', 'type' => 'select', 'data-source' => [
                    'Banner' => 0,
                    'Slider' => 1
                ]],
                ['label' => 'Vị trí hiển thị', 'name' => 'location', 'type' => 'select', 'data-source' =>[
                    'Trang chủ' => 'trang chủ',
                    'Trang chủ - dưới slidebar' => 'trang chủ - dưới slidebar',
                ]],
                ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'checkbox'],
            ]
        ],

        'seo_tab' => [
            'tab_label' => 'Meta',
            'items' => [
                ['label' => 'Slug', 'name' => 'slug', 'type' => 'slug']
            ]
        ]
    ];

    protected $removeRedundant = ["_token", "tag_id"];

    protected $fieldList = [
        ['label' => 'Mã', 'name' => 'id', 'type' => 'id'],
        ['label' => 'Tên', 'name' => 'name', 'type' => 'text'],
        ['label' => 'Ảnh', 'name' => 'picture', 'type' => 'picture'],
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
}

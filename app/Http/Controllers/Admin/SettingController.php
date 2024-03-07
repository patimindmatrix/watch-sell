<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Helper\Functions;
use App\Setting as MainModel;
use Illuminate\Http\Request;

class SettingController extends AdminController
{
    protected $pathView = "admin.core.";

    protected $fieldForm = [
        'general_tab' => [
            'tab_label' => 'General (VI)',
            'items' => [
                ['label' => 'Tên', 'name' => 'name', 'type' => 'text'],
                ['label' => 'Đường dẫn', 'name' => 'link', 'type' => 'text'],
                ['label' => 'Biểu tượng', 'name' => 'icon', 'type' => 'text'],
                ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'checkbox']
            ]
        ],
    ];

    protected $fieldList = [
        ['label' => 'Mã', 'name' => 'id', 'type' => 'id'],
        ['label' => 'Tên', 'name' => 'name', 'type' => 'text'],
        ['label' => 'Đường dẫn', 'name' => 'link', 'type' => 'text'],
        ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'status'],
        ['label' => 'Ngày tạo', 'name' => 'created_at', 'type' => 'dateFormat'],
        ['label' => 'Ngày cập nhật', 'name' => 'updated_at', 'type' => 'dateFormat']
    ];

    protected $removeRedundant = ['token','tag_id'];
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

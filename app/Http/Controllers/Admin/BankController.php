<?php

namespace App\Http\Controllers\Admin;

use App\Bank as MainModel; //Alias (bí danh) 'use' để gọi đến namespace App\Bank với bí danh là MainModel
use App\Helper\Functions;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class BankController extends AdminController
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
                ['label' => 'Tên ngân hàng', 'name' => 'name', 'type' => 'text'],
                ['label' => 'Hình ảnh', 'name' => 'picture', 'type' => 'file'],
                ['label' => 'Chi nhánh', 'name' => 'branch', 'type' => 'text'],
                ['label' => 'Tên tài khoản', 'name' => 'account_name', 'type' => 'text'],
                ['label' => 'Số tài khoản', 'name' => 'account_number', 'type' => 'text'],
                ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'checkbox'],
            ]
        ],
    ];

    protected $removeRedundant = ["_token", "tag_id"];

    protected $fieldList = [
        ['label' => 'Mã', 'name' => 'id', 'type' => 'id'],
        ['label' => 'Tên', 'name' => 'name', 'type' => 'text'],
        ['label' => 'Ảnh', 'name' => 'picture', 'type' => 'picture'],
        ['label' => 'Tên tài khoản', 'name' => 'account_name', 'type' => 'text'],
        ['label' => 'Chi nhánh', 'name' => 'branch', 'type' => 'text'],
        ['label' => 'Trạng thái', 'name' => 'status', 'type' => 'status'],
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

<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Http\Controllers\AdminController;
use App\Helper\Functions;
use App\Blog as MainModel;
use Illuminate\Http\Request;

class BlogController extends AdminController
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
                ['label' => 'Hỉnh ảnh', 'name' => 'picture', 'type' => 'file'],
                ['label' => 'Tác giả', 'name' => 'author', 'type' => 'text'],
                ['label' => 'Chủ đề', 'name' => 'title', 'type' => 'text'],
                ['label' => 'Nội dung', 'name' => 'content', 'type' => 'ckeditor'],
                ['label' => 'Mô tả', 'name' => 'description', 'type' => 'textarea'],
                ['label' => 'Trích dẫn', 'name' => 'quote', 'type' => 'textarea'],
                ['label' => 'Loại bài viết', 'name' => 'category_id', 'type' => 'select', 'modal' => BlogCategory::class],
                ['label' => 'Kiểu bài viết', 'name' => 'type', 'type' => 'select', 'data-source' => [
                    'Bài viết mới' => 'new',
                    'Bài viết hot' => 'hot',
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

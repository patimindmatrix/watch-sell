<?php

namespace App\Helper;

class Functions{
    public static function getModelName($string){
        /* Tìm nếu có Controller trong $string thì đổi thành rỗng
        ** Nếu trong $string không có dấu cách VD: pageController;
         * Thêm một trong các kí tự đặc biệt vào trước từ muốn đổi chỗ '{}, //, ##, $$...'
         * /.../ Bắt đầu và kết thúc biểu thức chính quy.
        */
        return strtolower(preg_replace("/Controller/", "", $string));
    }

    public static function getImage($folderUpload, $fileImage, $type=""){
        if(isset($type)){
            $path = public_path() . "/picture/" . $folderUpload . "/" . $type . "/" . $fileImage;
        }
        else{
            $path = public_path() . "/picture/" . $folderUpload . "/" . $fileImage;
        }
        if(isset($fileImage) && file_exists($path)){
            if(isset($type)){
                return asset("picture/" . $folderUpload . "/" . $type . "/" . $fileImage);
            }
            else{
                return asset("picture/" . $folderUpload . "/" . $fileImage);
            }
        }else{
            return asset("picture/default-image.jpg");
        }
    }
}


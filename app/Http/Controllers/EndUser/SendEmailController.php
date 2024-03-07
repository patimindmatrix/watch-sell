<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Mail\MailHandle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SendEmailController extends Controller
{
    protected $pathView = "enduser.pages.SendEmail.";

    /*
     * Gửi mail để lấy lại mật khẩu cho user
     * @param Request $request
     *
     * */

    public function mailToRetrievePassword(Request $request){
        $recipient = $request -> email;

        $data = [
            'type' => 'Đặt lại mật khẩu',
            'sorry' => 'Chúng tôi được biết bạn đã mất mật khẩu Ruiz Clock. Xin lỗi vì điều đó !',
            'message' => 'Nhưng đừng lo lắng ! Bạn có thể đặt lại mật khẩu với nút này: ',
            'button' => 'Đặt lại mật khẩu',
            'pathView' => $this -> pathView . "retrieve_password",
            'email' => $recipient,

        ];

        Mail::to($recipient)->send( new MailHandle($data) );

        Session::flash("action_success", "Hệ thống đã gửi email cho bạn! Check mail để reset password");
        return response() -> json([
            'code' => 200,
            'email' => $recipient,
        ], 200);
    }

    public function mailToMessageAdmin(Request $request){
        $this -> validateMessageForm($request);
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $data = [
            'type' => 'MessageFromUser',
            'name' => $request -> con_name,
            'subject' => 'PHẢN HỔI TỪ KHÁCH HÀNG '.$time->toDateTimeString(),
            'phone' => $request -> con_phone,
            'email' => $request -> con_email,
            'message' => $request -> con_message,
            'pathView' => $this -> pathView . "message_from_user",
        ];
        Mail::to("ndtdeveloper1705@gmail.com")->send( new MailHandle($data) );
        Session::flash("action_success", "Gửi email thành công");
        return back();
    }

    public function validateMessageForm(Request $request){
        $request -> validate([
            'con_name' => 'required',
            'con_email' => 'bail|required|email',
            'con_phone' => 'bail|required|numeric',
            'con_message' => 'required',

        ],[
            'required' => ':attribute không được rỗng',
            'email' => ':attribute phải là email',
            'numeric' => ':attribute phải là số',

        ],[
            'con_name' => 'Tên',
            'con_email' => 'Email',
            'con_phone' => 'Số điện thoại',
            'con_message' => 'Nội dung',

        ]);
    }
}

<div style="box-sizing: border-box;background: #ffffffff;color: #24292e;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI emoji;font-size: 14px;line-height: 1.5;">
    <h2 style="text-align: center">{{ $data['type'] }}</h2>
    <div style="max-width: 544px;width: 100%;margin-right: auto;margin-left: auto;box-sizing: border-box;border: 1px solid #ccc;padding: 15px;border-radius: 10px;">
        <p>{{ $data['sorry'] }}</p>
        <p>{{ $data['message'] }}</p>
        <a href="{{ route("auth.viewResetPassword", ['email' => base64_encode($data['email'])]) }}"
        style="text-decoration: none;background: #009225;color: #fff;padding: 8px 15px;border: 1px solid #009225;border-radius: 5px;text-align: center;display: block;max-width: 150px;margin: 0 auto;">
            {{ $data['button'] }}
        </a>
        <p>Thanks,</p>
        <span> {{ config('app.name') }} </span>
    </div>
</div>

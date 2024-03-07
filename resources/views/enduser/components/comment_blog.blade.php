<div class="row">
    <div class="col-lg-12">

        <div class="comments-area comments-reply-area section-pt">

            <div class="row">
                <div class="col-lg-12">
                    <h5 class="comment-title">Bình luận
                        <span style="font-size: 16px; color: #cccccc">@if(count(@$commentsAll) > 0) ({{ count(@$commentsAll) }}) @endif</span>
                    </h5>
                </div>
                <div class="col-lg-12">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <form action="{{ route("comment.store", ["id" => @$blogContent -> id]) }}" class="comment-form-area" method="POST">
                            @csrf
                            <div class="comment-form">
                                <div class="comment-form-comment mt-15">
                                    <div class="d-flex">
                                        @if(\Illuminate\Support\Facades\Auth::user()->provider_id == NULL)
                                            <img class="user-image-comment user-unique" src="{{ \App\Helper\Functions::getImage("user",\Illuminate\Support\Facades\Auth::user() -> picture) }}" alt="">
                                        @else
                                            <img class="user-image-comment user-unique" src="{{ \Illuminate\Support\Facades\Auth::user() -> picture }}" alt="">
                                        @endif
                                        <textarea class="comment-notes" required="required" rows="3" name="content"></textarea>
                                    </div>
                                </div>
                                <div class="comment-form-submit mt-30 d-flex justify-content-end">
                                    <input type="submit" value="Gửi bình luận" class="comment-submit">
                                </div>
                            </div>
                        </form>
                    @else
                        <a href="{{ route("auth.login") }}" class="login-to-comment border-box mb-5">
                            <div class="comment-wrapper">
                                <i class="far fa-comment mr-1"></i>
                                <p>Đăng nhập để bình luận</p>
                            </div>
                        </a>
                    @endif

                    @if(count(@$comments) > 0)
                        @foreach($comments as $comment)
                            @php
                                $user = \App\User::where("id", @$comment -> user_id)->first();
                                $replies = \App\Comment::where("parent_id", @$comment -> id)->get();
                            @endphp
                            @if(!$comment->parent_id)
                                <div class="user-comments border-box comment-wrapper">
                                        <div class="user-info">
                                            <div class="d-flex align-items-center">
                                                @if( @$user -> provider_id == NULL)
                                                    <img class="user-image-comment" src="{{ \App\Helper\Functions::getImage("user", @$user -> picture) }}" alt="">
                                                @else
                                                    <img class="user-image-comment" src="{{ @$user -> picture }}" alt="">
                                                @endif
                                                <p class="user-name">{{ @$user -> user_name }}</p>
                                                <p class="user-email">{{ @$user -> email }}</p>
                                            </div>
                                            <span class="date-comment">{{ date_format(@$comment -> updated_at, "d/m/Y H:i:s") }}</span>
                                        </div>
                                        <div class="main-content">
                                            <p class="content-of-comment mb-0">{{ @$comment -> content }}</p>
                                            @if(\Illuminate\Support\Facades\Auth::check())
                                                @if( @$user -> id == \Illuminate\Support\Facades\Auth::user()->id )
                                                    <div class="auth-comment ml-2">
                                                        <i class="fas fa-ellipsis-h actions-comment"></i>
                                                        <ul class="action-dropdown">
                                                            <li>
                                                                <a data-url="{{ route("comment.editComment", ["id" => @$comment -> id]) }}"
                                                                   class="d-flex align-items-center mb-3 edit-comment" _token="{{ csrf_token() }}">
                                                                    <i class="fas fa-pencil-alt mr-2"></i> Sửa
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a data-url="{{ route("comment.deleteComment", ["id" => @$comment -> id]) }}" class="d-flex align-items-center delete-comment">
                                                                    <i class="far fa-trash-alt mr-2"></i> Xóa
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="bottom-comment">
                                            <a class="reply-text"
                                               data-url="{{ route("comment.replyComment") }}"
                                               data-id="{{ @$comment -> id }}"
                                               data-token="{{ csrf_token() }}">
                                                Trả lời @if(count(@$replies) > 0)({{ count(@$replies) }}) @endif
                                            </a>
                                        </div>

                                    @if(count(@$replies) > 0)
                                        @foreach($replies as $reply)
                                            @php
                                                $user = \App\User::where("id", @$reply -> user_id)->first();
                                            @endphp
                                            <div class="user-comments border-reply reply-wrapper">
                                                <div class="user-info">
                                                    <div class="d-flex align-items-center">
                                                        @if(@$user -> provider_id == NULL)
                                                            <img class="user-image-comment" src="{{ \App\Helper\Functions::getImage("user",@$user -> picture) }}" alt="">
                                                        @else
                                                            <img class="user-image-comment" src="{{ @$user -> picture }}" alt="">
                                                        @endif
                                                        <p class="user-name">{{ @$user -> user_name }}</p>
                                                        <p class="user-email">{{ @$user -> email }}</p>
                                                    </div>
                                                    <span class="date-comment">{{ date_format(@$reply -> updated_at, "d/m/Y H:i:s") }}</span>
                                                </div>
                                                <div class="main-content">
                                                    <p class="content-of-comment mb-0">{{ @$reply -> content }}</p>
                                                    @if(\Illuminate\Support\Facades\Auth::check())
                                                        @if(@$user -> id == \Illuminate\Support\Facades\Auth::user()->id)
                                                            <div class="auth-comment ml-2">
                                                                <i class="fas fa-ellipsis-h actions-comment"></i>
                                                                <ul class="action-dropdown">
                                                                    <li>
                                                                        <a data-url="{{ route("comment.editComment", ["id" => @$reply -> id]) }}"
                                                                           class="d-flex align-items-center mb-3 edit-comment" _token="{{ csrf_token() }}">
                                                                            <i class="fas fa-pencil-alt mr-2"></i> Sửa
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a data-url="{{ route("comment.deleteComment", ["id" => @$reply -> id]) }}" class="d-flex align-items-center delete-comment">
                                                                            <i class="far fa-trash-alt mr-2"></i> Xóa
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="bottom-comment">
                                                    <a class="reply-text"
                                                       data-url="{{ route("comment.replyComment") }}"
                                                       data-id="{{ @$comment -> id }}"
                                                       data-token="{{ csrf_token() }}">
                                                        Trả lời
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="login-to-comment">
                            <div class="comment-wrapper">
                                <i class="far fa-comment mr-1"></i>
                                <p>Chưa có comment nào</p>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>


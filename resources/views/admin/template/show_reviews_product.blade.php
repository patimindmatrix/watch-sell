@php
    $reviews = \App\Review::where("product_id" , $product_id)->get();

@endphp

@if(count($reviews) > 0)
    @foreach($reviews as $review)
        @php
            //Lấy thông tin user qua user_id
            $user = \App\User::where("id", @$review -> user_id)->first();
            //dd($user);
        @endphp
        <div class="pro_review mt-3 mb-5">
            <div class="review_thumb">
                @if(@$user->provider_id == NULL)
                    <img alt="review images" src="{{ \App\Helper\Functions::getImage("user", @$user -> picture) }}">
                @else
                    <img class="review images" src="{{ @$user -> picture }}" alt="">
                @endif
            </div>
            <div class="review_details d-flex justify-content-between">
                <div>
                    <div class="review_info mb-10 rating-info">
                        <ul class="product-rating d-flex mb-10">
                            @for($i = 0; $i < 5; ++$i)
                                <li class="star-rating @if($i < @$review -> rating)selected @endif"><i class='fa fa-star fa-fw'></i></li>
                            @endfor
                        </ul>
                        <h5>{{ @$user -> user_name }} - <span> {{ date_format(@$review -> updated_at, "d/m/Y H:i:s") }}</span></h5>

                    </div>
                    <div class="main-content">
                        <p class="review-content m-0">{{ @$review -> content }}</p>
                    </div>
                </div>

                <div class="el-button-group">
                    <a style="outline: none" class="el-button el-button--danger el-button--mini delete-button"
                       data-url="{{ route("admin.product.deleteReview", ["id" => @$review -> id]) }}">
                        <span><i class="fa fa-trash"></i></span>
                    </a>
                </div>


            </div>
        </div>
    @endforeach
@endif


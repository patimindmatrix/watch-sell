@if(count($reviews) > 0)
    @foreach($reviews as $review)
        @php
            //Lấy thông tin user qua user_id
            $user = \App\User::where("id", @$review -> user_id)->first();
            //dd($user);
        @endphp
        <div class="pro_review mt-5">
            <div class="review_thumb">
                @if(@$user->provider_id == NULL)
                    <img alt="review images" src="{{ \App\Helper\Functions::getImage("user", @$user -> picture) }}">
                @else
                    <img class="review images" src="{{ @$user -> picture }}" alt="">
                @endif
            </div>
            <div class="review_details">
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
        </div>
    @endforeach
@endif

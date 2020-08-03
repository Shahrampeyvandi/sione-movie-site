<section class="slider d-none d-md-block">
    <div class="swiper-container header-slider">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <div class="slider-box">
                    <div class="shadow-bottom-slider"></div>
                    <img class="slider-back-img" src="{{asset($slider->image)}}" alt="">
                    <div class="movie-details-box-slider">
                        <a href="#">
                            <img src="#" alt="">
                        </a>
                        <h4>
                            {{$slider->post->title}}
                        </h4>
                        <h5>
                            {!! $slider->post->description !!}
                        </h5>
                    <a href="{{$slider->post->play()}}" class="page-movie-play btn--ripple">
                            <i class="fa fa-play"></i>
                            پخش فیلم
                        </a>
                        
                         <a href="#" class="more-detail-movie btn--ripple">
                            <i class="fa fa-star"></i>
                            خرید اشتراک
                        </a>
                    <a href="{{$slider->post->path()}}" class="more-detail-movie btn--ripple">
                            <i class="fa fa-exclamation"></i>
                            جزئیات بیشتر
                        </a>
                        <h6>
                            ستارگان:
                            @php
                            $countactors = count($slider->post->actors);
                            @endphp
                            @foreach ($slider->post->actors as $key =>$item)
                            <a href="#">

                                {{$item->name }}
                                {{$countactors -1  == $key ? ' ' : ' - '}}
                            </a>
                            @endforeach

                        </h6>
                        <h6>
                            کارگران:
                            @php
                            $countdirectors = count($slider->post->directors);
                            @endphp
                            @foreach ($slider->post->directors as $item)
                            <a href="#">

                                {{$item->name }}
                                {{$countdirectors -1  == $key ? ' ' : ' - '}}
                            </a>
                            @endforeach
                        </h6>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="next-header-slide">
            <i class="fa fa-angle-right"></i>
        </div>
        <div class="prev-header-slide">
            <i class="fa fa-angle-left"></i>
        </div>
    </div>
</section>
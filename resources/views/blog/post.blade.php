@extends('Layout.Blog')
@section('Title','وبلاگ')

@section('content')
<section class="blog_page post-blog">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="main-post-blog">
                    <div class="blog-top-img">
                        <div class="top-post-img">
                        
                            <img src="{{asset($post->poster)}}" alt="">
                            <div class="cover-img-post"></div>
                        </div>
                        <div class="bottom-img-post">
                            <img src="{{asset('assets/images/Blog-pages/photo_2017-10-26_13-04-25.jpg')}}" alt="">
                            <h1>
                                {{$post->title}}
                            </h1>
                            <a href="#">
            
                                مدیسا مهراب پور
                            </a>
                        </div>
                    </div>
                    <div class="blog-post-define">
                        <i class="fa fa-quote-right"></i>
                        <p>
                            سروش صحت نامی آشنا برای تماشاگران سینما و تلویزیون است. او کار خود را با مجموعه جنگ ۷۷ به کارگرانی مهران مدیری آغاز کرد. در این مجموعه در ابتدا به عنوان بازیگر حضور داشت و سپس در بعضی از آیتم‌های برنامه، نویسندگی را هم تجربه کرد. او در ادامه کار خود هم بازیگری و نویسندگی را همزمان ادامه داد و جلوتر کارگردانی هم کرد.
                            سروش صحت البته در سینما بیشتر به عنوان بازیگر شناخته می‌شود و اخیرا اولین فیلم سینمایی‌اش جهان با من برقص ‌را کارگردانی کرده.
                            حضور او در تلویزیون بسیار پررنگ است و هرچند تماشاگر در مواجهه اولیه سریال‌هایی را که کارگردانی کرده به‌خاطر می‌آورد اما نویسنده بسیاری از سریال‌های کمدی خاطره انگیز هم بوده. به بهانه پخش جهان با من برقص در شبکه نمایش خانگی، کارنامه او را مرور کرده‌ایم.
                        </p>
                    </div>
                    <section class="blog-post-detail">
                       {{!! $post->description !!}}
                    </section>
                   
                    <div class="sharing-post-blog">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="social-post-sharing">
                                        <span>
                                            این پست را به اشتراک بزارید
                                        </span>
                                        <a href="#">
                                            <i class="fab fa-telegram-plane"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="vote-post-sharing">
                                        <span>
                                            به ابن مطلب رای دهید
                                        </span>
                                        <div class="star-vote-box">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-blog-post">
                    <div class="site_define">
                        <h2>
                            آخرین های سایت
                        </h2>
                        <h3>
                            تماشای آنلاین فیلم و سریال ایرانی و خارجی
                        </h3>
                        <a href="#" class="btn--ripple">
                            ورود به سایت
                        </a>
                    </div>
                    <div class="swiper-container post-blog-page-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="slider-post-img-box">
                                    <a href="#">
                                        <img src="{{asset('assets/images/Blog-pages/slider/09039e66-b949-4866-acca-d67bfbd5a996.jpg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="slider-post-img-box">
                                    <a href="#">
                                    <img src="{{asset('assets/images/Blog-pages/slider/09039e66-b949-4866-acca-d67bfbd5a996.jpg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="slider-post-img-box">
                                    <a href="#">
                                    <img src="{{asset('assets/images/Blog-pages/slider/09039e66-b949-4866-acca-d67bfbd5a996.jpg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="slider-post-img-box">
                                    <a href="#">
                                    <img src="{{asset('assets/images/Blog-pages/slider/09039e66-b949-4866-acca-d67bfbd5a996.jpg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="slider-post-img-box">
                                    <a href="#">
                                    <img src="{{asset('assets/images/Blog-pages/slider/09039e66-b949-4866-acca-d67bfbd5a996.jpg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($relateds)>0)
                <div class="blog-body">
                    <h1>
                        <span>
                            نوشته های مرتبط با این پست
                        </span>
                    </h1>
                    <div class="swiper-container slider-blog">
                        <div class="swiper-wrapper">
                            @foreach($relateds as $related)

                            <div class="swiper-slide">
                                <a href="{{route('Blog.show',['id'=>$related->id])}}">
                                    <div class="slider-blog-box">
                                        <img src="{{asset($related->poster)}}" alt="">
                                        <div class="cover-img-slider"></div>
                                        <div class="play-show">
                                            <i class="fa fa-video"></i>
                                        </div>
                                    </div>
                                    <h4>
                                        {{$related->title}}
                                    </h4>
                                </a>
                            </div>

                            @endforeach
                           
                            
                        </div>
                        <div class="slider-prev">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="slider-next">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </div>
                @endif

                <div class="blog-body">
                    <h1>
                        <span>
                            ارسال نظر
                        </span>
                    </h1>
                    <div class="sendOpinion">
                        <form action="#">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-2 col-lg-1">
                                        <i class="fa fa-user-circle"></i>
                                    </div>
                                    <div class="col-10 col-lg-11">
                                        <div class="input-place">
                                            <textarea type="text" id="Opinion" name="Opinion" autocomplete="off" required></textarea>
                                            <label for="Opinion">
                                                نظر
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-place">
                                            <input type="email" id="Email" name="Opinion" autocomplete="off" required>
                                            <label for="Email">
                                                ایمیل
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="sendOpinionBtn btn--ripple">
                                ارسال دیدگاه
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @include('Includes.Blog.sidebar')

        </div>
    </div>
</section>
@endsection
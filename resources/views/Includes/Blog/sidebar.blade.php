<div class="col-12 col-lg-3">
                <a href="#">
                    <img class="left-blog-img" src="assets/images/blog_images/ads-banner-1.png" alt="">
                </a>
                <div class="blog-place">
                    <h1>
                        <i class="fa fa-star"></i>
                        <span class="blog-place-title">
                            پرونده ها
                        </span>
                        <span class="blog-place-Name">
                            EVENTS
                        </span>
                    </h1>
                    <a href="#">
                        <div class="card-blog-section">
                            <div class="card-cover"></div>
                            <img src="assets/images/blog_images/جلیوند-فرهادی-مهدویان-1024x559-2.jpg" alt="">
                            <h3>
                                حواشی سینمای ایران
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="blog-place">
                    <h1>
                        <i class="fa fa-star"></i>
                        <span class="blog-place-title">
                            آخرین دیدگاه ها
                        </span>
                        <span class="blog-place-Name">
                            RECENT COMMENTS
                        </span>
                    </h1>
                    @foreach(App\Comment::latest()->get()->take(5) as $recentcomment)
                    <a class="quotation-blog" href="{{route('Blog.show',['id'=>$recentcomment->commentable->id])}}">
                        <i class="fa fa-quote-right"></i>
                        <span class="quotation-blog-title">
                    {{mb_substr($recentcomment->text,'0','40')}}        
                    </span>
                        <span class="quotation-blog-text">
                            {{$recentcomment->commentable->title}}
                        </span>
                    </a>
                   
                    @endforeach
                   
                </div>
                <div class="blog-place">
                    <h1>
                        <i class="fa fa-star"></i>
                        <span class="blog-place-title">
                            پربازدیدترین مطالب
                        </span>
                        <span class="blog-place-Name">
                            POPULAR POSTS
                        </span>
                    </h1>

                    @foreach(App\Blog::orderBy('views', 'asc')->get()->take(5) as $mostvisit)
                    <a class="blog-movie" href="{{route('Blog.show',['id'=>$mostvisit->id])}}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-4 no-padding">
                                    <div class="blog-img-box">
                                        <img src="{{asset($mostvisit->poster)}}" alt="">
                                        <div class="cover-img-blog"></div>
                                    </div>
                                </div>
                                <div class="col-8 no-padding">
                                    <h4>
                                        {{$mostvisit->title}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                  
                </div>
                <div class="blog-place">
                    <h1>
                        <i class="fa fa-star"></i>
                        <span class="blog-place-title">
                            آخرین مطالب
                        </span>
                        <span class="blog-place-Name">
                            LAST POSTS
                        </span>
                    </h1>
                    @foreach(App\Blog::latest()->get()->take(5) as $lastposts)
                    <a class="blog-movie" href="{{route('Blog.show',['id'=>$lastposts->id])}}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-4 no-padding">
                                    <div class="blog-img-box">
                                        <img src="{{asset($lastposts->poster)}}" alt="">
                                        <div class="cover-img-blog"></div>
                                    </div>
                                </div>
                                <div class="col-8 no-padding">
                                    <h4>
                                    {{$lastposts->title}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    
                </div>
            </div>
<section class="head-film-cover">
    <div class="cover-img-movies_movie-Page"></div>
    <img src="{{asset($post->poster)}}" alt="">
    <div class="movie-details-header">
       
        <h1>
            {{$post->title}}
        </h1>
        <div class="details_details">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <div class="movie-year">
                            {{$post->year}}
                        </div>
                    </div>
                    @if ($post->imdbRating)
                    <div class="col-3">
                        <div class="IMDb_rank">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-6">
                                        <b><strong>IMDb</strong></b>
                                    </div>
                                    <div class="col-6">{{$post->imdbRating}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-3">
                        <div class="movie-like">
                            <i class="fa fa-heart"></i>
                            93%
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="site-dubbing">
                            @if ($post->checkDubleFarsi())
                            <i class="fa fa-microphone"></i>
                            دوبله فارسی
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="movie-description">
           {!! html_entity_decode($post->description, ENT_QUOTES, 'UTF-8') !!}
        </p>
        <div class="list_like">
        <a href="#" onclick="addToFavorite(event,'{{$post->id}}','{{$post->favoritepath()}}')" class="addMovie_list text-white">
                <i class="fa fa-plus"></i>
                افزودن به لیست
            </a>

            @if ($post->type == 'movies')
            <a href="{{$post->play()}}" class="addMovie_list text-white">
                <i class="fa fa-play"></i>
                پخش فیلم
            </a>
        <a href="#" onclick="downLoad(event,'{{$post->downloadpath()}}')" class="addMovie_list text-white">  
                        دانلود
            </a>
            {{-- <a href="{{$post->downloadpath()}}" target="_blank" class="addMovie_list text-white">  
                     تست   دانلود
            </a> --}}
            @endif
            <!-- <i class="fas fa-thumbs-up"></i>
            <i class="fas fa-thumbs-down"></i> -->
        </div>

        @if (count($post->actors))
        <div class="movie-stars">
            ستارگان:
            @foreach ($post->actors as $key=> $actor)

            <a href="#">
                {{$actor->name}}
            </a>
            @endforeach
        </div>
        @endif



        <div class="movie-age_rank">
            {{-- <span>
                +15
            </span> --}}
            مناسب برای همه سنین
        </div>
    </div>
</section>
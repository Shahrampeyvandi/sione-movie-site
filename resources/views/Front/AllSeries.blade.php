@extends('Layout.Front')
@section('Title','سریال ها')


@section('content')


@include('Includes.Front.DesktopSlider')
@include('Includes.Front.MobileSlider')

@include('Includes.Front.TopSlider')

@if (count($newseries))
<section class="movie-sections">
    <h3>
        تازه ترین ها
        <a href="#">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($newseries as $post)
            <div class="swiper-slide">
                @component('components.article',['model'=>$post])
                @endcomponent
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail',['model'=>$post])
    @endcomponent
</section>
@endif

@if (count($latestdoble))
<section class="movie-sections">
    <h3>
        دوبله فارسی
        <a href="#">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($latestdoble as $post)
            <div class="swiper-slide">
                <a href="#" data-id="1" onclick="showDetails(event,'{{$post->id}}','{{route('GetMovieDetail')}}')">
                    <div class="movie-sections-box">
                        <div class="img-box-movies">
                            <img src="{{asset($post->poster)}}" alt="{{$post->name}}">
                            <div class="cover-img-movies-details">
                                <span>
                                    {{$post->name}} -
                                    @if ($post->type == "series")

                                    {{\Morilog\Jalali\Jalalian::forge($post->first_publish_date)->format('%Y')}}
                                    @else
                                    {{\Morilog\Jalali\Jalalian::forge($post->released)->format('%Y')}}
                                    @endif
                                </span>
                                <span>
                                    <i class="fa fa-heart"></i>
                                    89%
                                </span>
                            </div>
                        </div>
                        <h5>
                            {{$post->title}}
                        </h5>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail',['model'=>$post])

    @endcomponent
</section>
@endif



@if (count($newyear))
<section class="movie-sections">
    <h3>
        جدیدترین فیلم های {{$year}}
        <a href="#">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($newyear as $post)
            <div class="swiper-slide">
                <a href="#" data-id="1" onclick="showDetails(event,'{{$post->id}}','{{route('GetMovieDetail')}}')">
                    <div class="movie-sections-box">
                        <div class="img-box-movies">
                            <img src="{{asset($post->poster)}}" alt="{{$post->name}}">
                            <div class="cover-img-movies-details">
                                <span>
                                    {{$post->name}} -
                                    @if ($post->type == "series")

                                    {{\Morilog\Jalali\Jalalian::forge($post->first_publish_date)->format('%Y')}}
                                    @else
                                    {{\Morilog\Jalali\Jalalian::forge($post->released)->format('%Y')}}
                                    @endif

                                </span>
                                <span>
                                    <i class="fa fa-heart"></i>
                                    89%
                                </span>
                            </div>
                        </div>
                        <h5>
                            {{$post->title}}
                        </h5>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail',['model'=>$post])
    @endcomponent
</section>
@endif


@endsection
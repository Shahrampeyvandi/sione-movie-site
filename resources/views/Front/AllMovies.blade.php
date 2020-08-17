@extends('Layout.Front')
@section('Title','فیلم ها')


@section('content')


@include('Includes.Front.DesktopSlider')
@include('Includes.Front.MobileSlider')

@include('Includes.Front.TopSlider')

@if (count($newmovies))
<section class="movie-sections">
    <h3>
        تازه ترین ها
        <a href="{{route('S.ShowMore')}}?c=new&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($newmovies as $movie)
            <div class="swiper-slide">
                @component('components.article',['model'=>$movie,'ajax'=>1])
                @endcomponent
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail')
    @endcomponent
</section>
@endif

@if (count($latestdoble))
<section class="movie-sections">
    <h3>
        دوبله فارسی
        <a href="{{route('S.ShowMore')}}?c=doble&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($latestdoble as $post)
            <div class="swiper-slide">
                @component('components.article',['model'=>$post , 'ajax'=>1])
                @endcomponent
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail')
    @endcomponent
</section>
@endif



@if (count($newyear))
<section class="movie-sections">
    <h3>
        جدیدترین فیلم های {{$year}}
        <a href="{{route('S.ShowMore')}}?c={{$year}}&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($newyear as $post)
            <div class="swiper-slide">
                @component('components.article',['model'=>$post , 'ajax'=>1])
                @endcomponent
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail')
    @endcomponent
</section>
@endif


@endsection
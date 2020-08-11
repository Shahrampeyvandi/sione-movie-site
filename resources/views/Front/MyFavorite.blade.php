@extends('Layout.Front')
@section('Title','لیست من')


@section('content')



@if (count($myfavorites))
<section class="movie-sections">
    <h3>
        لیست من
        <a href="#">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($myfavorites as $post)
            <div class="swiper-slide">
            @component('components.article',['model'=>$post])
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
@extends('Layout.Front')
@section('Title',$title)
@section('content')
@include('Includes.Front.TopPoster')


<section class="movie-trailer">
  @if (count($post->images))
        <h1>
        تریلر، تصاویر و جزییات
    </h1>
    <div class="container-fluid">
        <div class="row">
            @foreach ($post->images as $image)
            <div class="col-3 col-lg-2">
                <img src="{{asset($image->url)}}" alt="{{$post->name}}">
            </div>
            @endforeach


        </div>
    </div>
  @endif
    <h2>
        {{$post->title}}
    </h2>
    <h3>
        درباره سریال {{$post->title}}
    </h3>

    <div class="col-12 movie-description-color">

        {!! $post->description !!}
    </div>
   @if (count($post->categories))
        <h2>
        دسته بندی:
        @foreach ($post->categories as $category)
        {{$category->name}}
        @endforeach
    </h2>
   @endif

    @if (count($post->captions))
    <h2>
        زیرنویس:
        @foreach ($post->captions as $caption)
        {{$caption->lang}}
        @endforeach
    </h2>
    @endif
    @if (count($post->actors))
    <div class="container-fluid">
        <div class="row">
            @foreach ($post->actors as $actor)

            <div class="col-3 col-lg-2 d-flex justify-content-center">
                <div class="star-img-box w-p-80">
                    <a href="#">
                        @if ($actor->image)

                        <img src="{{asset($actor->image)}}" alt="{{$actor->name}}">
                        @else
                        <img src="{{asset('assets/images/avatar.png')}}" alt="{{$actor->name}}">
                        @endif
                        <h4>
                            {{$actor->name}}
                        </h4>
                        <h5>
                            بازیگر
                        </h5>
                    </a>
                </div>
            </div>
            @endforeach


        </div>
    </div>
    @endif
    <h3>
        تیم دوبلاژ
    </h3>
    {{-- <h3>
        <a href="#">
            ابراهیم شفیعی،
        </a>
        <a href="#">
            ابراهیم شفیعی،
        </a>
        <a href="#">
            ابراهیم شفیعی،
        </a>
        <a href="#">
            ابراهیم شفیعی،
        </a>
        <a href="#">
            ابراهیم شفیعی،
        </a>
        <a href="#">
            ابراهیم شفیعی،
        </a>
        <a href="#">
            ابراهیم شفیعی،
        </a>
        <a href="#">
            ابراهیم شفیعی،
        </a>
        <a href="#">
            ابراهیم شفیعی،
        </a>
    </h3> --}}
</section>
@if (count($relatedPosts))
<section class="movie-related">
    <h1>
        همچنین تماشا کنید
    </h1>
    <div class="container-fluid">
        <div class="row">
            @foreach ($relatedPosts as $item)
            <div class="col-3 col-lg-2">
                @component('components.article',['model'=>$item])
                @endcomponent
            </div>
            @endforeach


        </div>
    </div>
</section>
@endif



@endsection
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
    <div class="container">
        <div class="row ">
            @foreach ($posts as $post)
            <div class="col-6 col-md-2">
                @component('components.article',['model'=>$post , 'ajax'=>0])
                @endcomponent
            </div>
            @endforeach
        </div>
    </div>



</section>
@endif



@endsection
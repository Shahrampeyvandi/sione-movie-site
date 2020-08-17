@extends('Layout.Front')
@section('Title',$title)


@section('content')


<div class="margin-bottom container">
    <div class="row mt-8">
        <div class="col-6 col-md-3 d-flex ">
            <img src="{{asset($cast->image)}}" alt="پریناز ایزدیار" title="پریناز ایزدیار" class="Person-image">

        </div>
        <div class="col-md-9">
            <div class="Person-description">
                <div class="Person-title fs-1-5 mb-2 mt-0 mt-md-5">{{$cast->name}}</div>
                <div class="fs-1">
                    {!! html_entity_decode($cast->bio, ENT_QUOTES, 'UTF-8') !!}
                </div>
            </div>
        </div>
    </div>
</div>


@if (count($posts))
  <div class="container">
<div class="row mt-8 mb-5">
  @foreach ($posts as $post)
         <div class="col-6 col-md-2">
            @component('components.article',['model'=>$post , 'ajax'=>0])
            @endcomponent
            </div>
    @endforeach
  </div>
  </div>
@endif




@endsection
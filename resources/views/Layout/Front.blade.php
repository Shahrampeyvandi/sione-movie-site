<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/index.css')}}">
    <script src="{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
    <script src="{{asset('frontend/assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/all.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/index.js')}}"></script>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> sione | @yield('Title')</title>
</head>


<body @if (\Request::route()->getName() == "S.SiteSharing" || \Request::route()->getName() == "S.Account" || \Request::route()->getName() == "S.OrderLists" )
 class="site-sharing"
@endif>
    <div class="overlay"></div>
    <div class="lds-ripple center-screen" style="display: none">
        <div></div>
        <div></div>
    </div>
    
        
     @if(\Request::route()->getName() !== "login" && \Request::route()->getName() !== "S.SiteSharing" && \Request::route()->getName() !== "S.OrderLists"
     ) 
      @include('Includes.Front.Header')
     @endif
   
    @yield('content')

     @if(\Request::route()->getName() !== "login" && \Request::route()->getName() !== "S.SiteSharing" && \Request::route()->getName() !== "S.OrderLists"
     ) 
     @include('Includes.Front.Footer')
     @endif

    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    @toastr_render
     @yield('js')
</body>

</html>
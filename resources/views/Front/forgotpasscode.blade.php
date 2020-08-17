@extends('Layout.Front')
@section('Title', $title)

@section('content')
<div class="row h-100">
    <div class="col-md-12">
        <section class="main_login_register"
            style="background-image:linear-gradient(rgba(18, 18, 18, 0) 10vw, rgb(18, 18, 18) 46.875vw), linear-gradient(to left, rgba(18, 18, 18, 0.7), rgba(18, 18, 18, 0) 50%),url({{asset('frontend/login/642a2247-9f00-42f8-99a5-63c79e0e13e8.jpg')}})">
            <div class="btn-loader-place">
                <h1>
                    <a href="{{route('MainUrl')}}">
                        LOGO
                    </a>
                </h1>
                
            </div>

       
            <form action="{{route('forgetpass.submitCode')}}" method="post" id="loginForm" class="loginform">
                @csrf
                @if (count($errors))
                <h1>
                    {{ $errors->first() }}
                </h1>
                @endif
                <input type="hidden" id="mobile" name="mobile" value="{{$mobile}}">

                <h3>
                    کد فعال سازی برای شماره {{$mobile}} ارسال گردید
                </h3>
                <div class="input-place">
                    <label for="Mobile">
                        کد فعال سازی
                    </label>
                    <input type="text" id="mobile" name="code" autocomplete="off" dir="rtl" placeholder="12345">
                </div>


                <button class="submit_login btn--ripple" type="submit">
                    تایید
                </button>


            </form>
            
        </section>
    </div>
</div>




@endsection

@section('js')
<script src="{{asset('assets/vendors/bundle.js')}}"></script>

@endsection
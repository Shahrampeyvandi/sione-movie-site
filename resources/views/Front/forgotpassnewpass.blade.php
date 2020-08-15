@extends('Layout.Front')
@section('Title', $title)

@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="main_login_register" style="background-image:linear-gradient(rgba(18, 18, 18, 0) 10vw, rgb(18, 18, 18) 46.875vw), linear-gradient(to left, rgba(18, 18, 18, 0.7), rgba(18, 18, 18, 0) 50%),url({{asset('frontend/login/642a2247-9f00-42f8-99a5-63c79e0e13e8.jpg')}})">
            <div class="btn-loader-place">
                <h1>
                    <a href="{{route('MainUrl')}}">
                        LOGO
                    </a>
                </h1>

            </div>


            <form action="{{route('forgetpass.submitNewPass')}}" method="post" id="loginForm" class="loginform forget-pas">
                @csrf
                @if (count($errors))
                <h1>
                    {{ $errors->first() }}
                </h1>
                @endif

                <h3>
                    لطفا رمز عبور جدید خود را وارد نمایید
                </h3>
                <div class="input-place">
                    <label for="Mobile">
                        کد فعال سازی
                    </label>
                    <input type="hidden" id="mobile" name="mobile" value="{{$mobile}}">
                    <input type="hidden" id="mobile" name="mobile" value="{{$code}}">

                    
                </div>

                <div class="input-place">
                    <label for="password">
                        رمز عبور
                    </label>
                    <input type="text" id="mainpassword" name="password" autocomplete="off" placeholder="رمز عبور">
                </div>
                <div class="input-place">
                    <label for="cpassword">
                        تایید پسورد
                    </label>
                    <input type="text" id="cpassword" name="cpassword" autocomplete="off" placeholder="تایید پسورد">
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
<script src="{{asset('assets/vendors/jquery-validate/jquery.validate.js')}}"></script>
<script>
    $(function() {
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                return this.optional(element) || regexp.test(value);
            },
            "Please check your input."
        );
        $(".loginform").validate({
            rules: {
                mobile: {
                    required: true,
                    regex: /^09[0-9]{9}$/,
                },
                password: {
                    required: true,
                    minlength: 8,
                    regex: /^[a-zA-Z\d]*$/,
                }
            },
            messages: {
                password: {
                    required: "لطفا رمز عبور خود را وارد نمایید",
                    minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
                    regex: "پسورد بایستی شامل اعداد و حروف لاتین باشد",
                },
                mobile: {
                    required: "لطفا شماره موبایل خود را وارد نمایید",
                    regex: "موبایل دارای فرمت نامعتبر می باشد",
                },
            },
        });


        $("#registerForm").validate({
            rules: {
                mobile: {
                    required: true,
                    regex: /^09[0-9]{9}$/,
                },
                fname: {
                    required: true,

                },
                lname: {
                    required: true,

                },
                password: {
                    required: true,
                    minlength: 8,
                    regex: /^[a-zA-Z\d]*$/,
                },
                cpassword: {
                    required: true,
                    minlength: 8,
                    equalTo: '#mainpassword',
                }
            },
            messages: {
                password: {
                    required: "لطفا رمز عبور خود را وارد نمایید",
                    minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
                    regex: "پسورد بایستی شامل اعداد و حروف لاتین باشد",
                },
                cpassword: {
                    required: "لطفا رمز عبور خود را وارد نمایید",
                    minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
                    equalTo: 'رمز عبور یکسان نیست',
                },
                fname: {
                    required: 'نام خود را وارد نمایید',

                },
                lname: {
                    required: 'نام خانوادگی خود را وارد نمایید',

                },
                mobile: {
                    required: "لطفا شماره موبایل خود را وارد نمایید",
                    regex: "موبایل دارای فرمت نامعتبر می باشد",
                },
            },
        });
    })
</script>
@endsection
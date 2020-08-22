<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/swiper.min.css')}}">
            <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
                <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('assets/js/all.min.js')}}"></script>
    <script src="{{asset('assets/js/index.js')}}"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> sione blog | @yield('Title')</title>
</head>
<body>
<header>
    <nav>
        <div class="menuSite">
            <div class="Logo_mobile">
                <a href="index.html" >
                    LOGO
                </a>
            </div>
            <ul class="menuList">
                <li class="menuItems close_menu">
                    <a href="#">
                        بستن منو
                    </a>
                </li>
                <li class="menuItems logo">
                    <a href="index.html" >
                        <i class=""></i>
                        LOGO
                    </a>
                </li>
                <li class="menuItems">
                    <a href="./Movie.html">
                        <i class="far fa-microphone-alt"></i>
                        اخبار
                    </a>
                </li>
                <li class="menuItems">
                    <a href="./Movie.html">
                        <i class="far fa-file-alt"></i>
                        مقالات
                    </a>
                </li>
                <li class="menuItems">
                    <a href="Movie.html">
                        <i class="far fa-camcorder"></i>
                        ویدیوها
                    </a>
                </li>
                <li class="menuItems">
                    <a href="./Movie.html">
                        <i class="far fa-film-alt"></i>
                        نقد و بررسی
                    </a>
                </li>
                <li class="menuItems">
                    <a href="./Movie.html">
                        <i class="far fa-clipboard"></i>
                        نقد فیلم های نماوا
                    </a>
                </li>
                <li class="menuItems">
                    <a href="#">
                        <i class="far fa-video"></i>
                        تماشای آنلاین
                    </a>
                </li>
            </ul>
            <div class="menu-left-items">
                <div class="menu-left-items-elements">
                    <div class="menu-button">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </div>
                <div class="menu-left-items-elements">
                    <div class="far fa-search"></div>
                </div>
            </div>
        </div>
    </nav>
</header>


@yield('content')



<footer>
    <div class="topFooter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h4>
                        تگ های پرطرفدار:
                        <a href="#">
                            pinned post
                        </a>
                        <a href="#">
                            pinned post
                        </a>
                        <a href="#">
                            pinned post
                        </a>
                        <a href="#">
                            pinned post
                        </a>
                        <a href="#">
                            pinned post
                        </a>
                    </h4>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="social-box">
                        <a href="#" class="social">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="social">
                            <i class="fab fa-telegram"></i>
                        </a>
                        <a href="#" class="social">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="LOGO_footer">
                            LOGO
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mainFooter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <p>
                        تمامی حقوق متعلق به نماوا بلاگ بوده و بازنشر آن تنها با ذکر و لینک به منبع مجاز است.
                    </p>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="footer-lists">
                        <ul>
                            <li>
                                <a href="#">
                                    تماشای آنلاین
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    نماوا چیست؟
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    دانلود اپلیکیشن نماوا
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    تماس با ما
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
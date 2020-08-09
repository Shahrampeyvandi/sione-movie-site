$(document).ready(function () {



    var rangeSlider = function () {
        var slider = $(".range-slider"),
            range = $(".range-slider__range"),
            value = $(".range-slider__value");

        slider.each(function () {
            value.each(function () {
                var value = $(this)
                    .prev()
                    .attr("value");
                $(this).html(value);
            });

            range.on("input", function () {
                $(this)
                    .next(value)
                    .html(this.value);
            });
        });
    };

    rangeSlider();


    $('.inbox-icon').on('click', function (e) {
        e.preventDefault();
        var el = $(e.target);
        next = el.next(".inbox");
        if ($(this).next().hasClass('close')) {

            $(this).next().addClass("open");
            $(this).next().removeClass("close");
        } else {
            $(this).next().addClass("close");
            $(this).next().removeClass("open");
        }
    })

    //Ripple
    let $btnRipple = $('.btn--ripple'),
        $btnRippleInk, btnRippleH, btnRippleX, btnRippleY;
    $btnRipple.on('mouseenter', function (e) {
        let $t = $(this);
        if ($t.find(".btn--ripple-ink").length === 0) {
            $t.prepend("<span class='btn--ripple-ink'></span>");
        }

        $btnRippleInk = $t.find(".btn--ripple-ink");
        $btnRippleInk.removeClass("btn--ripple-animate");
        if (!$btnRippleInk.height() && !$btnRippleInk.width()) {
            btnRippleH = Math.max($t.outerWidth(), $t.outerHeight());
            $btnRippleInk.css({ height: btnRippleH, width: btnRippleH });
        }

        btnRippleX = e.pageX - $t.offset().left - $btnRippleInk.width() / 2;
        btnRippleY = e.pageY - $t.offset().top - $btnRippleInk.height() / 2;
        $btnRippleInk.css({ top: btnRippleY + 'px', left: btnRippleX + 'px' }).addClass("btn--ripple-animate");
    });
    // menu
    $('.menu-button').on('click', function () {
        $('.cover-menu').css('display', 'block')
        if ($(this).hasClass('cross')) {
            $('.navList').css('right', '-20rem')
            $(this).removeClass('cross')
            $('.navItem.logo').css('transition', 'none').css('background-color', 'transparent').css('position', 'absolute')
            $('.cover-menu').css('display', 'none')
            $('#search-box,.buy-subscribe').css('z-index', '90')
            $('.menu-button').css('position', 'absolute')
        } else {
            $('.navList').css('right', '0')
            $(this).addClass('cross')
            $('.navItem.logo').css('transition', '1s ease-in-out').css('background-color', '#222327').css('position', 'fixed')
            $('#search-box,.buy-subscribe').css('z-index', '20')
            $('.menu-button').css('position', 'fixed')
        }
    })
    $('.cover-menu').on('click', function () {
        $('.navList').css('right', '-20rem')
        $('.navItem.logo').css('transition', 'none').css('background-color', 'transparent').css('position', 'absolute')
        $(this).css('display', 'none')
        $('.menu-button').removeClass('cross').css('position', 'absolute')
        $('#search-box,.buy-subscribe').css('z-index', '90')
    })
    $(window).scroll(function () {
        let currentScrollPos = window.pageYOffset;
        $(window).scroll(function () {
            let scroll_get_top = $(document).scrollTop()
            if (currentScrollPos > scroll_get_top) {
                $('.siteNav').css('top', '0')
            } else {
                $('.siteNav,.menu-items-left').css('top', '-20rem')
            }
        })
        let scroll_get = $(document).scrollTop()
        if (scroll_get > 0) {
            $('.siteNav').css({
                backgroundColor: '#000000',
                backgroundImage: 'none'
            })
        } else {
            $('.siteNav').css('background-color', 'transparent')
        }
    })
    //profile dropdown
    $('.user-login-show').on('click', function () {
        let status = $('.profile-dropdown-box').css('display')
        if (status === 'none') {
            $('.profile-dropdown-box').fadeIn(300)
        } else {
            $('.profile-dropdown-box').hide()
        }
    })
    // search box
    $('#search-box .fa-search').on('click', function () {
        $('.search-panel').css('display', 'block')
    })
    $('#close_search').on('click', function () {
        $('.search-panel').css('display', 'none')
    })
    $('.filter-search').on('click', function () {
        let status_filter_box = $('.filter-box').css('display')
        if (status_filter_box === 'none') {
            $('.filter-box').slideDown(500).css('display', 'flex')
            $('.filter-search .fa-angle-down').css('transform', 'rotate(180deg)')
        } else {
            $('.filter-box').slideUp(500)
            $('.filter-search .fa-angle-down').css('transform', 'rotate(0)')
        }
    })
    $('.menu-filters ul li').on('click', function () {
        let status_show = $(this).css('background-color')
        if (status_show === 'rgb(34, 35, 39)') {
            $(this).css('background-color', '#37383e')
            $(this).find('.fa-angle-left').css('transform', 'rotate(0)')
        } else {
            $('.menu-filters ul li').css('background-color', '#37383e')
            $(this).css('background-color', '#222327')
            $('.menu-filters ul li .fa-angle-left').css('transform', 'rotate(0)')
            $(this).find('.fa-angle-left').css('transform', 'rotate(-90deg)')
        }
    })
    $(".filter-body-box").css("display", "none");
    $(".genre-box").css("display", "block");
    $('#genre').on('click', function () {
        let status_box_show = $('.genre-box').css('display')
        if (status_box_show === 'none') {
            $('.filter-body-box').css('display', 'none')
            $('.genre-box').css('display', 'block')
        } else {
            $('.genre-box').css('display', 'none')
        }
    })
    $('#Country').on('click', function () {
        let status_box_show = $('.ManufacturingCountry-box').css('display')
        if (status_box_show === 'none') {
            $('.filter-body-box').css('display', 'none')
            $('.ManufacturingCountry-box').css('display', 'block')
        } else {
            $('.ManufacturingCountry-box').css('display', 'none')
        }
    })
    $('#Sound').on('click', function () {
        let status_box_show = $('.SoundSubtitles-box').css('display')
        if (status_box_show === 'none') {
            $('.filter-body-box').css('display', 'none')
            $('.SoundSubtitles-box').css('display', 'block')
        } else {
            $('.SoundSubtitles-box').css('display', 'none')
        }
    })
    $('#Construction').on('click', function () {
        let status_box_show = $('.YearConstruction-box').css('display')
        if (status_box_show === 'none') {
            $('.filter-body-box').css('display', 'none')
            $('.YearConstruction-box').css('display', 'block')
        } else {
            $('.YearConstruction-box').css('display', 'none')
        }
    })
    $("#Order").on("click", function () {
        let status_box_show = $(".OrderConstruction-box").css("display");
        if (status_box_show === "none") {
            $(".filter-body-box").css("display", "none");
            $(".OrderConstruction-box").css("display", "block");
        } else {
            $(".OrderConstruction-box").css("display", "none");
        }
    });

    var timeout = true;
    var delay = 1000;   // 2 seconds

    $('#search-input').on('keyup', function () {
        setTimeout(() => {
            if (timeout) {
                timeout = false;
                arr = [];
                let val = $(this).val();
                let url = $(this).data("url");
                arr.push({ type: "word", key: val });

                var token = $('meta[name="_token"]').attr("content");

                PostData({ data: arr, _token: token }, url);
            }
        }, 1000);
    })






    $('.checkbox-place input').on('click', function () {
        arr = [];
        let val_filter = $(this).val()
        let id_filter = $(this).attr('id')

        let url = $(this).data('url')

        var token = $('meta[name="_token"]').attr("content");



        $("input.filter:checked").each(function () {
            let id = $(this).data("id");
            let type = $(this).data("type");
            arr.push({ type, id });
        });
          
        arr.push({ type: 'order', name: $('input[name="order"]:checked').val() })
        PostData({ data: arr, _token: token }, url);

        if ($(this).prop("checked") === true) {
            $('.filter-place-elements').append("<span id=" + id_filter + " class='filter-place-box_new-filter'>" + val_filter + " <i class='fa fa-times'></i></span>")
        }
        else if ($(this).prop("checked") === false) {
            $('.filter-place-elements span' + '#' + id_filter).remove()
        }
        if ($('.filter_all_delete').length) {
            if ($('.filter-place-elements span').length) {
            } else {
                $('.filter_all_delete').remove()
            }
        } else {
            $('.filter-delete-place').append("<div class='filter_all_delete'>حذف همه فیلتر ها</div>")
        }
    })


    $(".range-slider__range").change(function () {

        arr = [];
        let year = $(this).val()
        
        arr.push({ type: 'year', year: year })
        let url = $(this).data('url')
        var token = $('meta[name="_token"]').attr("content");
        $("input.filter:checked").each(function () {
            let id = $(this).data("id");
            let type = $(this).data("type");
            arr.push({ type, id });
        });
        arr.push({
            type: "order",
            name: $('input[name="order"]').val()
        });

        PostData({ data: arr, _token: token }, url)


    });


    function PostData(data, url) {
        setTimeout(() => {
            var request = $.post(url, data);
            request.done(function (res) {
                $('.results').html(res)
                timeout = true;
            });
        }, 1000);
    }


function SendData() {
      arr = [];
      $("input.filter:checked").each(function() {
          let id = $(this).data("id");
          let type = $(this).data("type");
          arr.push({ type, id });
      });

      arr.push({
          type: "order",
          name: $('input[name="order"]:checked').val()
      });
      var token = $('meta[name="_token"]').attr("content");
      var url = $(".range-slider__range").data("url");
      PostData({ data: arr, _token: token }, url);
}




    $('.filter-place-box').on('mouseenter', function () {
        $('.filter-place-box_new-filter svg').on('click', function () {
            if ($('.filter-place-elements span').length) {
                let get_id = $(this).parent().attr('id')
                $('.checkbox-place input#' + get_id).prop('checked', false)
                $(this).parent().remove()
                if ($('.filter-place-elements span').length === 0) {
                    $('.filter_all_delete').remove()
                    $('.checkbox-place input').prop('checked', false)
                }
              SendData();
            }
        })
        $('.filter_all_delete').on('click', function () {
            $('.filter-place-elements span').remove()
            $(this).remove()
            $('.checkbox-place input').prop('checked', false)
            SendData()
        })
    })
    // login and register page
    $('.login-form-load').on('click', function () {
        $('#registerForm').css('display', 'none')
        $('#loginForm').css('display', 'block')
    })
    $('.register-form-load').on('click', function () {
        $('#loginForm').css('display', 'none')
        $('#registerForm').css('display', 'block')
    })
    $('.changeMood').on('click', function () {
        let status_text = $(this).text()
        if (status_text === "ورود از طریق ایمیل") {
            $(this).text('ورود از طریق شماره تلفن همراه')
            $('#Mobile + label').text('ایمیل')
            $('#Mobile').attr('placeholder', 'example@example.mail')
            $('#loginForm h1').text('ورود از طریق ایمیل')
            $('#loginForm h3').text('لطفا ایمیل خود و رمز عبور را وارد فرمایید')
        } else {
            $(this).text('ورود از طریق ایمیل')
            $('#Mobile + label').text('شماره تلفن همراه')
            $('#Mobile').attr('placeholder', '+98**********')
            $('#loginForm h1').text('ورود از طرق شماره تلفن همراه')
            $('#loginForm h3').text('لطفا شماره تلفن خود و رمز عبور را وارد نمایید')
        }
    })
    //
    // Season movie
    $('.Season-select').on('click', function () {
        let status = $('.movie-Season-box').css('display')
        if (status === 'none') {
            $('.movie-Season-box').fadeIn(200)
        } else {
            $('.movie-Season-box').fadeOut(250)
        }
    })
    // site sharing
    $('.choosePlane').on('click', function (e) {
        e.preventDefault()
        let plan_choose_day = $(this).parent().parent().find('.plan-length').text()
        let id = $(this).data('id')
        $('input[name="plan_name"]').val(id);
        let plan_choose_price = $(this).parent().parent().find('.plan-price').text()
        let plan_choose_off = $(this).parent().parent().find('.after-off').text()
        $('.buy-sharing-plan').css('display', 'block')
        $('.buy-sharing-plan-box h1').text(plan_choose_day)
        $('.price-plan_price').text(plan_choose_price)
        let off_plan = parseInt(plan_choose_price) - parseInt(plan_choose_off)
        $('.off-plan_price').text(off_plan + ' تومان')
        let VAT = (parseInt(plan_choose_price) - parseInt(plan_choose_off)) * 45 / 100
        $('.VAT_price').text(Math.round(VAT))
        let pay_price = parseInt(plan_choose_off) + VAT;
        $('#pay_price').text(pay_price)
    })
    $('#close_buy-plan-box').on('click', function (e) {
        e.preventDefault()
        $('.buy-sharing-plan').css('display', 'none')
    })
    //profile change
    $('.edit-account-name').on('click', function () {
        $('.user-profile-change').css('display', 'block')
        $('.user-detail-change-box').css('display', 'block')
    })
    $('.change_pass_user').on('click', function () {
        $('.user-profile-change').css('display', 'block')
        $('.user-change-pass-box').css('display', 'block')
    })
    $('.user-detail-change-box .fa-times,.user-change-pass-box .fa-times').on('click', function () {
        $(this).parent().css('display', 'none')
        $('.user-profile-change').css('display', 'none')
    })



    // swiper
    var swiper = new Swiper('.header-slider', {
        effect: 'fade',
        navigation: {
            nextEl: '.next-header-slide',
            prevEl: '.prev-header-slide',
        },
        pagination: {
            el: '.swiper-pagination'
        },
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    });
    //top slider
    var swiper = new Swiper('.TopSlider', {
        slidesPerGroup: 2,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            // when window width is >= 0
            0: {
                slidesPerGroup: 2,
                slidesPerView: 1.4,
                spaceBetween: 15
            },
            576: {
                slidesPerView: 3.3,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 3.3,
                spaceBetween: 20
            },
            992: {
                slidesPerView: 3.2,
                spaceBetween: 30
            }
        }
    });
    var swiper = new Swiper(".mobile-slider", {
        spaceBetween: 30,
        effect: "fade",
        speed: 500,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    //iran news
    var swiper = new Swiper('.IranNews', {
        slidesPerGroup: 4,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            // when window width is >= 0
            0: {
                slidesPerGroup: 4,
                slidesPerView: 3,
                spaceBetween: 15
            },
            400: {
                slidesPerGroup: 4,
                slidesPerView: 4.4,
                spaceBetween: 15
            },
            576: {
                slidesPerView: 5.3,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 6.4,
                spaceBetween: 10
            },
            1200: {
                slidesPerView: 7.4,
                spaceBetween: 15
            }
        }
    });
})

$(document).click(function (e) {
    if (
        $(e.target).closest(".user-login-show").length == 0 &&
        $(e.target).closest(".profile-dropdown-box").length == 0
    ) {
        $(".profile-dropdown-box").hide();
    }

    if (
        $(e.target).closest(".inbox-icon").length == 0 &&
        $(e.target).closest(".inbox").length == 0
    ) {
        $(".inbox").removeClass('open');
        $(".inbox").addClass("close");
    }
});

var prev_id = 0;
function showDetails(event, id, url) {
    if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
            navigator.userAgent
        )
    ) {
        return true;
    }
    event.preventDefault();
    let detailbox = $(event.target)
        .parents(".swiper-container")
        .next(".movie-detail-show_index");
    if (id === prev_id) {
        if (detailbox.css("display") == "block") {
            detailbox.hide();
        } else {
            detailbox.fadeIn(300);
        }
    } else {
        $(".lds-ripple").fadeIn();
        prev_id = id;
        // ajax call
        var token = $('meta[name="_token"]').attr("content");


        var request = $.post(url, { id: id, _token: token });
        request.done(function (res) {

            $(".lds-ripple").fadeOut();
            detailbox
                .css({ "background": "url(" + res.poster + ")", 'background-size': '50% 100%', 'background-repeat': 'no-repeat' });
            detailbox.find('h1').text(res.title)
            detailbox.find('.desc').html(res.desc)



            if (res.type == "movies") {
                detailbox.find(".links").html(`
                 <a href="${res.play}" class="page-movie-play btn--ripple mr-0 mt-5">
                        <i class="fa fa-play"></i>
                        پخش فیلم
                    </a>
                     <a href="#" onclick="downLoad(event,'${res.download}')" class="page-movie-download btn--ripple mr-0 mt-5">  
                        دانلود
                    </a>

                   
                <a href="${res.path}" class="more-detail-movie btn--ripple">
                        <i class="fa fa-exclamation"></i>
                        توضیحات بیشتر
                    </a>
                `);


            } else {
                detailbox.find(".links").html(`
                

                   
                <a href="${res.path}" class="more-detail-movie btn--ripple">
                        <i class="fa fa-exclamation"></i>
                        توضیحات بیشتر
                    </a>
                `);

            }


            detailbox.fadeIn(300);
            $("body,html").animate(
                {
                    scrollTop: $(detailbox).offset().top,
                },
                400 //speed
            );

        });
        // end ajax call



    }


}


function getComments(event, url) {
    event.preventDefault();
    $('.overlay').fadeIn()
    $(".lds-ripple").fadeIn();
    $(event.target).on("click", false);
    var data = $(event.target).data("data");

    var token = $('meta[name="_token"]').attr("content");
    // data = ;
    var request = $.post(url, { data: data, _token: token });
    request.done(function (res) {
        $('#comments').append(res.data)
        $(".lds-ripple").fadeOut();
        $(".overlay").fadeOut();
    });
}

function checkTakhfif(event, url) {
    event.preventDefault()
    var code = $("#off_code").val();
    var plan_id = $("#plan_name").val();
    if (code.length) {
        var token = $('meta[name="_token"]').attr("content");
        // data = ;
        var request = $.post(url, { code: code, plan_id: plan_id, _token: token });
        request.done(function (res) {
            if (res !== '') {
                $("#submit-off_code").addClass("bg-success");
                $('#pay_price').text(res)
            }
        });
    }
}

function downLoad(event, url) {
    event.preventDefault()
    var token = $('meta[name="_token"]').attr("content");
    // data = ;
    var request = $.get(url, {
        _token: token
    });
    request.done(function (res) {
        if (res.data == 'error') {
            window.location.href = res.redirect

        }
    });

}


(function ($) {
    "use strict";
    // preloder
    $(window).on('load', function () {
        $('.preloader').fadeOut(1000);
    })


    $(document).ready(function () {
        // lightcase 
        $('a[data-rel^=lightcase]').lightcase();
        
        var $navbar = $('#header');
        var lastScrollTop = 0;
        if ($navbar.length && $navbar.data('sticky') === true) {
            $(window).on('scroll', function () {
                var currentScroll = $(this).scrollTop();
                if (currentScroll > 200) {
                    if (currentScroll > lastScrollTop) {
                        $navbar.removeClass('show-header').addClass('hide-header');
                    } else {
                        $navbar.removeClass('hide-header').addClass('show-header');
                    }
                } else {
                    $navbar.removeClass('hide-header show-header');
                }
                lastScrollTop = currentScroll;
            });
        }






        //Header
        $('.menu ul li a, .menu li a').on('click', function(e) {
            var element = $(this).parent('li');
            if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('li').removeClass('open');
                element.find('ul').slideUp(1000,"swing");
            }
            else {
                element.addClass('open');
                element.children('ul').slideDown(1000,"swing");
                element.siblings('li').children('ul').slideUp(1000,"swing");
                element.siblings('li').removeClass('open');
                element.siblings('li').find('li').removeClass('open');
                element.siblings('li').find('ul').slideUp(1000,"swing");
            }
        });

        $('.ellepsis-bar').on('click', function (e) {
            var element = $('.hafsa-header .header-top');
            if (element.hasClass('open')) {
                element.removeClass('open');
                element.slideUp(300, "swing");
                $('.overlayTwo').removeClass('active');
            } else {
                element.addClass('open');
                element.slideDown(300, "swing");
                $('.overlayTwo').addClass('active');

            }
        });
        $('.hafsa-header .header-bar').on('click', function () {
            $(this).toggleClass('active');
            $('.overlay').toggleClass('active');
            $('.menu').toggleClass('active');
        });




        // Search
        $('.main-header__search, .search-popup__overlay').on('click', () => {
            $('.search-popup ').toggleClass('open');
        });

        // scrollReveal Init
        if (screen.width > 576) {
            $(document).ready(function () {
                new WOW().init();
            });
        }
        // Poster slider
        var swiper = new Swiper('.event__slider', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 10000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".event__next",
                prevEl: ".event__prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
            },
        });


        //Isotope
        jQuery(window).on('load',function() { 
            var $grid = $('.grid').isotope({
                itemSelector: '.col-12',
                masonry: {
                    columnWidth: 0
                }
            })

            // filter items on button click
            $('.gallery__filter ul').on('click', 'li', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });

            $('.gallery__filter ul').each(function (i, buttonGroup) {
                var $buttonGroup = $(buttonGroup);
                $buttonGroup.on('click', 'li', function () {
                    $buttonGroup.find('.active').removeClass('active');
                    $(this).addClass('active');
                });
            });
        });

        //Countdown js initialization
        document.addEventListener('readystatechange', event => {
            if (event.target.readyState === "complete") {
                var clockdiv = document.getElementsByClassName("count-down");
                var countDownDate = new Array();
                for (var i = 0; i < clockdiv.length; i++) {
                    countDownDate[i] = new Array();
                    countDownDate[i]['el'] = clockdiv[i];
                    countDownDate[i]['time'] = new Date(clockdiv[i].getAttribute('data-date')).getTime();
                    countDownDate[i]['days'] = 0;
                    countDownDate[i]['hours'] = 0;
                    countDownDate[i]['seconds'] = 0;
                    countDownDate[i]['minutes'] = 0;
                }
                var countdownfunction = setInterval(function () {
                    for (var i = 0; i < countDownDate.length; i++) {
                        var now = new Date().getTime();
                        var distance = countDownDate[i]['time'] - now;
                        countDownDate[i]['days'] = Math.floor(distance / (1000 * 60 * 60 * 24));
                        countDownDate[i]['hours'] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        countDownDate[i]['minutes'] = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        countDownDate[i]['seconds'] = Math.floor((distance % (1000 * 60)) / 1000);
                        if (distance < 0) {
                            countDownDate[i]['el'].querySelector('.days').innerHTML = 0;
                            countDownDate[i]['el'].querySelector('.hours').innerHTML = 0;
                            countDownDate[i]['el'].querySelector('.minutes').innerHTML = 0;
                            countDownDate[i]['el'].querySelector('.seconds').innerHTML = 0;
                        } else {
                            countDownDate[i]['el'].querySelector('.days').innerHTML = countDownDate[i]['days'];
                            countDownDate[i]['el'].querySelector('.hours').innerHTML = countDownDate[i]['hours'];
                            countDownDate[i]['el'].querySelector('.minutes').innerHTML = countDownDate[i]['minutes'];
                            countDownDate[i]['el'].querySelector('.seconds').innerHTML = countDownDate[i]['seconds'];
                        }
                    }
                }, 1000);
            }
        });

        

        // scroll up start here
        $(function(){
            $(window).scroll(function(){
                if ($(this).scrollTop() > 300) {
                    $('.scrollToTop').css({'bottom':'2%', 'opacity':'1','transition':'all .5s ease'});
                } else {
                    $('.scrollToTop').css({'bottom':'-30%', 'opacity':'0','transition':'all .5s ease'})
                }
            });
            //Click event to scroll to top
            $('.scrollToTop').on('click', function(){
                $('html, body').animate({scrollTop : 0},500);
                return false;
            });
        });


        // Hafsa Demo Js Added
        $(function () {
            $('.progress-bar-wrapper').each(function () {
                $(this).find('.progress-bar').animate({
                    width: $(this).attr('data-percent')
                }, 6000);
            });
        });

        //Program Slier
        var swiper = new Swiper('.program-item-wrapper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: true,
            },
            navigation: {
                nextEl: '.program-next',
                prevEl: '.program-prev'
            },
            breakpoints: {
                768: {
                    // spaceBetween: 20,
                    slidesPerView: 2,
                }
            }
        });
        //qoute slider
        var swiper = new Swiper('.qoute-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 10000,
                disableOnInteraction: false,
            },
            loop: true,
        });
        
    });
})(jQuery);


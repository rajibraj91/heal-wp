
// xirosa
//Header
var fixed_top = $("header");
$(window).on('scroll', function () {
  if ($(this).scrollTop() > 200) {
    fixed_top.addClass("header--fixed animated fadeInDown");
  } else {
    fixed_top.removeClass("header--fixed animated fadeInDown");
  }
});


/*==== Multipage header Section Start here =====*/
$("ul>li>.submenu").parent("li").addClass("menu-item-has-children");
// drop down menu width overflow problem fix
$('ul').parent('li').on('hover', function () {
  var menu = $(this).find("ul");
  var menupos = $(menu).offset();
  if (menupos.left + menu.width() > $(window).width()) {
    var newpos = -$(menu).width();
    menu.css({
      left: newpos
    });
  }
});
$('.menu li a').on('click', function (e) {
  var element = $(this).parent('li');
  if (parseInt($(window).width()) < 992) {
    if (element.hasClass('open')) {
      element.removeClass('open');
      element.find('li').removeClass('open');
      element.find('ul').slideUp(300, "swing");
    } else {
      element.addClass('open');
      element.children('ul').slideDown(300, "swing");
      element.siblings('li').children('ul').slideUp(300, "swing");
      element.siblings('li').removeClass('open');
      element.siblings('li').find('li').removeClass('open');
      element.siblings('li').find('ul').slideUp(300, "swing");
    }
  }
});

$('.header-bar').on('click', function () {
  $(this).toggleClass('active');
  $('.menu').toggleClass('active');
})

//Header
var fixed_top = $("header");
$(window).on('scroll', function () {
  if ($(this).scrollTop() > 300) {
    fixed_top.addClass("header-fixed fadeInUp");
  } else {
    fixed_top.removeClass("header-fixed fadeInUp");
  }
});

/*==== Multipage header Section End here =====*/



// brand slider  
var swiper = new Swiper(".brand__slider-swipper", {
  spaceBetween: 30,
  freemode: true,
  centeredSlides: true,
  loop: true,
  speed: 2000,
  allowTouchMove: false,
  slidesPerView: 5,
  autoplay: {
    delay: 1,
    disableOnInteraction: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
    },
    640: {
      slidesPerView: 3,
    },
    992: {
      slidesPerView: 4,
    },
  },
});



// =================== scroll js start here =================== //

// Show/hide button on scroll
window.addEventListener('scroll', function () {
  var scrollToTop = document.querySelector('.scrollToTop');

  if (scrollToTop) {
      if (window.pageYOffset > 300) {
          scrollToTop.style.bottom = '5%';
          scrollToTop.style.opacity = '1';
          scrollToTop.style.visibility = 'visible';
      } else {
          scrollToTop.style.bottom = '-50px';
          scrollToTop.style.opacity = '0';
          scrollToTop.style.visibility = 'hidden';
      }
  }
});

// Click event to scroll to top
var scrollToTop = document.querySelector('.scrollToTop');

if (scrollToTop) {
  scrollToTop.addEventListener('click', function (e) {
      e.preventDefault();
      window.scrollTo({
          top: 0,
          behavior: 'smooth'
      });
  });
}

// =================== scroll js end here =================== //




// review js
const thumbs = document.querySelectorAll('.rl__thumb img');

        thumbs.forEach(thumb => {
            thumb.addEventListener('mouseenter', function () {

                document.querySelectorAll('li').forEach(li => li.classList.remove('active'));

                const parentLi = thumb.closest('li');
                if (parentLi) {
                    parentLi.classList.add('active');
                }
            });
        });




// contact js
        const btnCommunaute = document.getElementById('btn-communaute');
        const btnPartenaire = document.getElementById('btn-partenaire');
        const contentCommunaute = document.getElementById('content-communaute');
        const contentPartenaire = document.getElementById('content-partenaire');

        // Event listener for the "Community" button
        btnCommunaute.addEventListener('click', () => {
            // Manage active classes for buttons
            btnCommunaute.classList.add('active');
            btnPartenaire.classList.remove('active');

            // Manage active classes for content
            contentCommunaute.classList.add('active');
            contentPartenaire.classList.remove('active');
        });

        // Event listener for the "Partner" button
        btnPartenaire.addEventListener('click', () => {
            // Manage active classes for buttons
            btnPartenaire.classList.add('active');
            btnCommunaute.classList.remove('active');

            // Manage active classes for content
            contentPartenaire.classList.add('active');
            contentCommunaute.classList.remove('active');
        });


document.addEventListener('DOMContentLoaded', function () {

    const swiper = new Swiper('.swiper', {

        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

});

//showcase slider
var swiper = new Swiper(".showcase__slider", {
  spaceBetween: 24,
  grabCursor: true,
  loop: true,
  slidesPerView: 1,
  breakpoints: {

    576: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1200: {
      slidesPerView: 4,
    },
    1440: {
      slidesPerView: 5,
    },
  },
  autoplay: {
    delay: 1,
  },
  speed: 3000,
});



// testimonial slider
var swiper = new Swiper(".testimonial__swiper2", {
  slidesPerView: 2.8,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    576: {
      slidesPerView: 1.1,
    },
    768: {
      slidesPerView: 1.4,
    },
    1200: {
      slidesPerView: 2,
    },
    1600: {
      slidesPerView: 3,
    },
  },
  autoplay: {
    delay: 1,
  },
  speed: 3000,
});


// testimonial slider
var swiper = new Swiper(".testimonial__slider3", {
  slidesPerView: 1,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    1400: {
      slidesPerView: 1,
    },
  },
  autoplay: {
    delay: 1,
  },
  speed: 3000,
});


// blog slider
var swiper = new Swiper(".blog__slider", {
  slidesPerView: 2.4,
  spaceBetween: 30,
  loop: true,
  navigation: {
    nextEl: ".blog__slider-next",
    prevEl: ".blog__slider-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    576: {
      slidesPerView: 1.4,
    },
    768: {
      slidesPerView: 1.8,
    },
    992: {
      slidesPerView: 2.4,
    },
    1200: {
      slidesPerView: 3,
    },
  },
});


//preloader

document.addEventListener('DOMContentLoaded', () => {
  // Initialize any required libraries (like AOS if you're using it)
  if (typeof AOS !== 'undefined') {
    AOS.init();
  }

  // Preloader fade out
  window.addEventListener('load', () => {
    const preloader = document.querySelector('.preloader');
    preloader.style.transition = 'opacity 0.5s ease';
    preloader.style.opacity = '0';

    setTimeout(() => {
      preloader.style.display = 'none';
    }, 500);
  });
});





// button 
$(function () {
  $('.btn-6')
    .on('mouseenter', function (e) {
      var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
      $(this).find('span').css({ top: relY, left: relX })
    })
    .on('mouseout', function (e) {
      var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
      $(this).find('span').css({ top: relY, left: relX })
    });
});


//precounter
document.addEventListener("DOMContentLoaded", function () {
  new PureCounter();
});
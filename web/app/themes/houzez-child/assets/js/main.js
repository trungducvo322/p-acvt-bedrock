$(document).ready(function () {
    // mainv
    if ($('.mainv-container').length > 0) {
        var mySwiper = new Swiper('.mainv-container', {
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: true
            },
            speed: 3000,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            slidesPerView: 1,
            followFinger: false,
            draggable: false,
            preventClicksPropagation: false,
            preventClicks: false,
            touchRatio: 1
        });
    }

    //menu slider
    const topPostSlider = new Swiper('.menu__slider', {
        slidesPerView: 4,
        slidesPerGroup: 1,
        navigation: {
            nextEl: '.menu__slider .swiper-button-next',
            prevEl: '.menu__slider .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 8,
                slidesPerGroup: 1,
            },
            1024: {
                slidesPerView: 10,
                slidesPerGroup: 1,
            },
            1200: {
                slidesPerView: 12,
                slidesPerGroup: 1,
            },
            1366: {
                slidesPerView: 14,
                slidesPerGroup: 1,
            }
        }
    });

    // nav btn
    $(".menu__button").click(function () {
        // $('html').toggleClass('is-expand');
        this.classList.toggle("active");

        $(".header__navList").toggleClass("header__navList--active");
    });

    //href # click
    $('a[href^="#"]').not('.ez-toc-link').click(function () {
        var speed = 100;
        var href = $(this).attr("href");
        var target = $(href == "#" || href == "" ? "html" : href);
        var position = target.offset().top - 100;
        $("html, body").animate({
            scrollTop: position
        }, speed, "swing");
        return false;
    });

    $('.grid__gallery .imgbox button').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).parent('.grid__gallery .imgbox').toggleClass('clicked');
    });

    // menu
    $('#menu-main-menu .menu-item-has-children').append('<div class="js-menu-icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>');
    $('.js-menu-icon').on('click', function () {
        $(this).toggleClass('open-menu');
        $(this).prev('.sub-menu').slideToggle(300);
    });

    //logo branch footer
    var brandSlider = new Swiper('.footer__slider', {
        slidesPerView: 4,
        loop: true,
        autoplay: {
            delay: 3000,
        },
        spaceBetween: 30,
        breakpoints: {
            768: {
                slidesPerView: 5,
            },
            1200: {
                slidesPerView: 10,
            }
        }
    });

    //top review
    if ($('.grid-container__comment').length > 0) {
        var topCommentSlider = new Swiper('.grid-container__comment', {
            slidesPerView: 1.4,
            slidesPerGroup: 1,
            spaceBetween: 32,
            navigation: {
                nextEl: '.grid-container__comment .swiper-button-next',
                prevEl: '.grid-container__comment .swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2.4,
                    slidesPerGroup: 1,
                },
                1024: {
                    slidesPerView: 3.2,
                    slidesPerGroup: 1,
                }
            }
        });
    }

    //video slider
    if ($('.video__content').length > 0) {
        var videoSlider = new Swiper('.video__content', {
            slidesPerView: 1,
            slidesPerGroup: 1,
            centeredSlides: true,
            initialSlide: 2,
            spaceBetween: 36,
            navigation: {
                nextEl: '.video__description .swiper-button-next',
                prevEl: '.video__description .swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 1.4,
                    slidesPerGroup: 1,
                },
                1024: {
                    slidesPerView: 2.6,
                    slidesPerGroup: 1,
                }
            }
        });
    }

    //single location review
    if ($('.location__slider').length > 0) {
        var commentSlider = new Swiper('.location__slider', {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 18,
            navigation: {
                nextEl: '.location__slider .swiper-button-next',
                prevEl: '.location__slider .swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    slidesPerGroup: 1,
                },
                1024: {
                    slidesPerView: 4,
                    slidesPerGroup: 1,
                }
            }
        });
    }

    //infinity load location
    if ($('.js-loadmore').length > 0) {
        $('.js-loadmore').infiniteScroll({
            path: '.js-pagination .next',
            append: '.col-lg-5.col-md-4.col-6',
            status: '.scroller-status',
            hideNav: '.js-pagination',
        });
    } else {

    }

    //load news
    if ($('.js-loadnews').length > 0) {
        if ($('#check_current_taxonomy').val() == 'category' && $('.js-post-item-main').length < 16) {
            $('.js-loadnews').addClass('d-none').removeClass('d-flex');
        }

        if ($('.js-loadnews').length != 0) {
            $('.js-loadnews').click(async function () {
                let notIn = [];
                const total = $('#check_current_taxonomy_count').val();
                $('.js-post-item').each(function () {
                    notIn.push($(this).attr('data-id'));
                });
                $('.js-loadnews-icon').addClass('active');

                try {
                    await loadnews(notIn, total);
                } catch (error) {
                    console.log(error);
                }

            })
        }
    }

    //video gallery
    if ($('#gallery-videos-demo').length > 0) {
        let videoList = document.getElementById('gallery-videos-demo');
        lightGallery(videoList, {
            plugins: [lgVideo],
        });
    }

    if ($('.video__description').length > 0) {
        var videoDescriptionSlider = new Swiper('.video__description', {
            slidesPerView: 1,
            slidesPerGroup: 1,
            loop: true,
            allowTouchMove: false,
        });

        videoSlider.controller.control = videoDescriptionSlider;
    }

    //like
    $(".js-like").click(function () {
        // let like = parseInt($(this).attr('data-like'));
        // like = like + 1;
        // $(this).attr('data-like', like);
        // $(this).children().find('.likes__noteNumber').html(like);
        // const postId = $(this).attr('data-post');
        $(this).parent().prev().children().find('.imgbox').addClass('clicked');
    })


    //favorite
    // function favorite() {
    //     var faved = [];
    //     var clickfav = [];
    //     var current_page_id = $('input[name="postid"]').val(); //現在のページのIDを取得しておく


    //     var cookiefav = $.cookie("fav_item") ? JSON.parse($.cookie("fav_item")) : [];
    //     $('.favorite.btn').each(function (index, el) {
    //         $(this).attr('title', 'お気に入り登録をする');
    //         var _thispost = $(this).data('pageid');
    //         faved.push(_thispost);
    //     });
    //     var defffav = faved.filter(function (x) { return cookiefav.indexOf(x) >= 0; })
    //     for (var i = 0; i < defffav.length; i++) {
    //         $('.favorite.btn[data-pageid="' + defffav[i] + '"]').addClass('active');
    //         $('.favorite.btn[data-pageid="' + defffav[i] + '"]').attr('title', 'お気に入り登録を解除する');
    //     }

    //     favoriteclick();
    // }

    // favorite();


    // function favoriteclick() {
    //     $(document).off('click', '.favorite.btn');
    //     $(document).on('click', '.favorite.btn', function (event) {
    //         event.preventDefault();
    //         var _thispost = $(this).data('pageid');
    //         var cookiefav = $.cookie("fav_item") ? JSON.parse($.cookie("fav_item")) : [];
    //         if ($(this).hasClass('active')) {
    //             var index = cookiefav.indexOf(_thispost);
    //             cookiefav.splice(index, 1);

    //             $('.favorite.btn').each(function (index, el) {
    //                 if ($(this).data('pageid') === _thispost) {
    //                     $(this).removeClass('active');
    //                     $(this).attr('title', 'お気に入り登録をする');
    //                 }
    //             });
    //             $(this).parents('li.favorite').find('p').removeAttr('style')


    //             if ($('body').hasClass('page-template-page-favorite')) {
    //                 $(this).parents('li').find('[class^="block__card"]').css({ 'opacity': '.5' });
    //             }
    //         } else {
    //             cookiefav.push(_thispost);
    //             $('.favorite.btn').each(function (index, el) {
    //                 if ($(this).data('pageid') === _thispost) {
    //                     $(this).addClass('active');
    //                     $(this).attr('title', 'お気に入り登録を解除する');
    //                 }
    //             });
    //             $(this).parents('li.favorite').find('p').css({
    //                 opacity: 0,
    //             });

    //             if ($('body').hasClass('page-template-page-favorite')) {
    //                 $(this).parents('li').find('[class^="block__card"]').css({ 'opacity': '1' });
    //             }
    //         }
    //         var serializedArr = JSON.stringify(cookiefav); //配列をcookieに受け渡す用にシリアライズしておく
    //         $.cookie("fav_item", serializedArr, { expires: 7, path: '/' }); //cookieを保存する
    //     });
    // }

});

$(window).scroll(function () {
    const offsetTop = $(window).scrollTop();
    const headerHeight = $('.header__upper').innerHeight();

    //backtop
    if (offsetTop >= headerHeight) {
        $('.js-backtop').addClass('visible');
    }
    else {
        $('.js-backtop').removeClass('visible');
    }

});


//top tin tuc
if ($('.js-tintuc-slide').length > 0) {
    var topCommentSlider = new Swiper('.js-tintuc-slide', {
        slidesPerView: 1.1,
        slidesPerGroup: 1,
        spaceBetween: 32,
        navigation: {
            // nextEl: '.grid-container__comment .swiper-button-next',
            // prevEl: '.grid-container__comment .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2.1,
                slidesPerGroup: 1,
                spaceBetween: 36,
            },
            1024: {
                slidesPerView: 4,
                slidesPerGroup: 1,
                spaceBetween: 36,
            }
        }
    });
}

//top doi tac
if ($('.js-doitac-slide').length > 0) {
    var topCommentSlider = new Swiper('.js-doitac-slide', {
        slidesPerView: 'auto',
        // slidesPerView: 1,
        spaceBetween: 32,
        navigation: {
            // nextEl: '.grid-container__comment .swiper-button-next',
            // prevEl: '.grid-container__comment .swiper-button-prev',
        },
        loop: true,
        autoplay: {
            delay: 2000,
        },
        speed: 3000,
        breakpoints: {
            768: {
                spaceBetween: 36,
            }
        }
    });
}

//top propertyNew
if ($('.js-propertyNew-slide').length > 0) {
    var topCommentSlider = new Swiper('.js-propertyNew-slide', {
        slidesPerView: 1.2,
        slidesPerGroup: 1,
        spaceBetween: 16,
        // centeredSlides: true,
        navigation: {
            // nextEl: '.grid-container__comment .swiper-button-next',
            // prevEl: '.grid-container__comment .swiper-button-prev',
        },
        autoplay: {
            delay: 3000,
        },
        breakpoints: {
            768: {
                slidesPerView: 2.2,
                slidesPerGroup: 1,
                spaceBetween: 36,
            },
        }
    });
}

// ajax Property "Loai hinh" tab

if ($('.js-propertyTab').length > 0) {
    let tabBox = $('.js-propertyTab');

  $('.js-propertyTab__each').on("click touch", tabBox, function(e) {
    e.preventDefault();

    let parrentDOM = $(this).closest('.js-propertyTab');
    let cate_id = $(this).data('tab-id');
    let catContentDOM = $(this).data('tab-content');

    parrentDOM.find('.js-propertyTab__each').removeClass('is-active');
    $(this).addClass('is-active');

    propertyTabAjax(cate_id, catContentDOM);


  })

  $(document).on('click touch', '.js-pagi-change', function(e) {
    e.preventDefault();

    let parentDOM = $(this).closest('.js-propertyTab__page');
    let catContentDOM = parentDOM.data('tab-content');
    let page = $(this).data('pagi');
    let cate_id = parentDOM.data('tab-id');
    window.scrollTo({top: $('#' + catContentDOM).offset().top - 150, behavior: 'smooth'});
    propertyTabAjax(cate_id, catContentDOM, page);
    return false;

  })

  function propertyTabAjax(cate_id, catContentID, page = 1) {

    let catContentDOM = $('#' + catContentID);
    catContentDOM.addClass('c-loading');

    let process = $.ajax({
        type: "post",
        url: ajaxurl,
        data: {
            cate_id: cate_id,
            cate_page: page,
            action: "ajax_property_loaihinh"
        },
        dataType: "html",
    
    //   dataType: "json",
    //   done: function (response) {
        

        // if (response.type == "success") {
        //     console.log(response);
        //     catContentDOM.html(response.content);
        //     return false;
        // }

        // if (response.type == "empty") {

        //   return false;
        // }
    //   },
    });

    process.then(function (response) {
        catContentDOM.removeClass('c-loading');
        catContentDOM.html(response);
        return false;
    })

    return false;
  }

  // tab slide 

  if ($('.js-propertyTab-slider').length > 0) {
    var topCommentSlider = new Swiper('.js-propertyTab-slider', {
        slidesPerView: 'auto',
        spaceBetween: 0,
        centeredSlides: false,
        breakpoints: {
            768: {
                // centeredSlides: true,
            }
        }
    });
}

}

/**
 * 
 * Post type: post
 * Page tin-tuc
 */

// ajax Page "tin tuc" tab

if ($('.js-newsTab').length > 0) {
    let tabBox = $('.js-newsTab');

  $('.js-newsTab__each').on("click touch", tabBox, function(e) {
    e.preventDefault();

    let parrentDOM = $(this).closest('.js-newsTab');
    let cate_id = $(this).data('tab-id');
    let catContentDOM = $(this).data('tab-content');

    parrentDOM.find('.js-newsTab__each').removeClass('is-active');
    $(this).addClass('is-active');

    toogleTabNews($(this).html());
    newsTabAjax(cate_id, catContentDOM);


  })

  $(document).on('click touch', '.js-pagi2-change', function(e) {
    e.preventDefault();

    let parentDOM = $(this).closest('.js-newsTab__page');
    let catContentDOM = parentDOM.data('tab-content');
    let page = $(this).data('pagi');
    let cate_id = parentDOM.data('tab-id');
    window.scrollTo({top: $('#' + catContentDOM).offset().top - 150, behavior: 'smooth'});
    newsTabAjax(cate_id, catContentDOM, page);
    return false;

  })

  function newsTabAjax(cate_id, catContentID, page = 1) {

    let catContentDOM = $('#' + catContentID);
    catContentDOM.addClass('c-loading');

    let process = $.ajax({
        type: "post",
        url: ajaxurl,
        data: {
            cate_id: cate_id,
            cate_page: page,
            action: "ajax_news_post"
        },
        dataType: "html",
    
    //   dataType: "json",
    //   done: function (response) {
        

        // if (response.type == "success") {
        //     console.log(response);
        //     catContentDOM.html(response.content);
        //     return false;
        // }

        // if (response.type == "empty") {

        //   return false;
        // }
    //   },
    });

    process.then(function (response) {
        catContentDOM.removeClass('c-loading');
        catContentDOM.html(response);
        return false;
    })

    return false;
  }
}

// js-tabNews-current

if ($('.js-tabNews-current').length > 0) {

    $('.js-tabNews-current').on('click touch', function() {

        toogleTabNews();
        return false;
    })

}

function toogleTabNews(name = 0) {
    if ($('.js-tabNews-current').length > 0) {

        let zzz = $('.js-newsTab');

        if (zzz.hasClass('is-active')) {
            zzz.removeClass('is-active');
        } else {
            zzz.addClass('is-active');
        }

        if (name) {
            $('.js-tabNews-current').html(name);
        }
    }
    
}


/**
 *  - End
 */


// Page - tin tuc

$(function(){
    let mySwiper;
    const breakpoint = window.matchMedia( '(min-width:681px)' );
    const breakpointChecker = function() {
        if ( breakpoint.matches === true ) {
            if ( mySwiper !== undefined ) mySwiper.destroy( true, true );
            return;
            } else if ( breakpoint.matches === false ) {
                return enableSwiper();
            }
        };
      
    const enableSwiper = function() {

        mySwiper = new Swiper ('.js-pagenews-slide', {
            slidesPerView: 1.1,
            spaceBetween: 25,
        });
    
        };
        
    breakpoint.addListener(breakpointChecker);

    breakpointChecker();
      
})

// tooltip 

function tooltipFunction(e) {

    var copyURL = $('#myTooltipData').data('url');

    navigator.clipboard.writeText(copyURL);
    
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copied";
  }
  
  function tooltipOutFunc() {
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copy to clipboard";
  }

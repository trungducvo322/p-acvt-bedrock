$(document).ready(function(){if(0<$(".mainv-container").length)new Swiper(".mainv-container",{effect:"fade",loop:!0,autoplay:{delay:6e3,disableOnInteraction:!0},speed:3e3,pagination:{el:".swiper-pagination",clickable:!0},slidesPerView:1,followFinger:!1,draggable:!1,preventClicksPropagation:!1,preventClicks:!1,touchRatio:1});if($(".menu__button").click(function(){this.classList.toggle("active"),$(".header__navList").toggleClass("header__navList--active")}),$('a[href^="#"]').not(".ez-toc-link").click(function(){var e=$(this).attr("href"),i=$("#"==e||""==e?"html":e).offset().top-100;return $("html, body").animate({scrollTop:i},100,"swing"),!1}),$(".grid__gallery .imgbox button").click(function(e){e.preventDefault(),e.stopPropagation(),$(this).parent(".grid__gallery .imgbox").toggleClass("clicked")}),$("#menu-main-menu .menu-item-has-children").append('<div class="js-menu-icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>'),$(".js-menu-icon").on("click",function(){$(this).toggleClass("open-menu"),$(this).prev(".sub-menu").slideToggle(300)}),0<$(".grid-container__comment").length)new Swiper(".grid-container__comment",{slidesPerView:1,slidesPerGroup:1,spaceBetween:36,navigation:{nextEl:".grid-container__comment .swiper-button-next",prevEl:".grid-container__comment .swiper-button-prev"},breakpoints:{768:{slidesPerView:3,slidesPerGroup:1},1024:{slidesPerView:5,slidesPerGroup:1}}});if(0<$(".location__slider").length)new Swiper(".location__slider",{slidesPerView:1,slidesPerGroup:1,spaceBetween:18,navigation:{nextEl:".location__slider .swiper-button-next",prevEl:".location__slider .swiper-button-prev"},breakpoints:{768:{slidesPerView:3,slidesPerGroup:1},1024:{slidesPerView:4,slidesPerGroup:1}}})}),$(window).scroll(function(){var e=$(window).scrollTop();$(".header__upper").innerHeight()<=e?$(".js-backtop").addClass("visible"):$(".js-backtop").removeClass("visible")});
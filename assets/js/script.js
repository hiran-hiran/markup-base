(function ($) {
  $(".header-hum").on("click", function (e) {
    e.preventDefault();
    $(this).toggleClass("is-active");
    $("body").toggleClass("is-opened");
    $(".js-header-nav").fadeToggle();
  });

  // topに戻る
  var topBtn = $(".js-page-top");
  // topBtn.hide();
  // $(window).scroll(function () {
  //   $(this).scrollTop() > 600 ? topBtn.fadeIn() : topBtn.fadeOut();
  // });
  topBtn.on("click", function () {
    $("body, html").animate({ scrollTop: 0 }, 600);
    return false;
  });

  // スムーススクロール
  $('a[href^="#"]').click(function () {
    var adjust = -160;
    var speed = 400;
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "html" : href);
    var position = target.offset().top + adjust;
    $("body,html").animate({ scrollTop: position }, speed, "swing");
    return false;
  });

  // top mv slide
  $(".js-mv-slide").slick({
    slidesToShow: 1,
    infinite: true,
    autoplay: true,
    dots: true,
    pauseOnHover: false,
    pauseOnFocus: false,
    arrows: false,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          dots: false,
        },
      },
    ],
  });

  // top business slide
  $(".js-business-slider01").slick({
    slidesToShow: 3,
    autoplaySpeed: 0,
    speed: 8200,
    cssEase: "linear",
    infinite: true,
    pauseOnHover: false,
    pauseOnFocus: false,
    autoplay: true,
    arrows: false,
    swipe: false,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
    ],
  });

  $(".js-business-slider02").slick({
    slidesToShow: 3.2,
    autoplaySpeed: 0,
    speed: 8000,
    cssEase: "linear",
    infinite: true,
    pauseOnHover: false,
    pauseOnFocus: false,
    autoplay: true,
    arrows: false,
    swipe: false,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2.2,
        },
      },
    ],
  });
})(jQuery);

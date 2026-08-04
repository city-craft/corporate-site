//WEBフォント表示遅延
setTimeout(function () {
  if (document.getElementsByTagName("html")[0].classList.contains('wf-active') != true) {
    document.getElementsByTagName("html")[0].classList.add('loading-delay');
  }
}, 3000);

//smooth
jQuery(function () {
  jQuery('a[href^="#"]').click(function () {
    let speed = 500;
    let href = $(this).attr("href");
    let target = jQuery(href == "#" || href == "" ? 'html' : href);
    let position = target.offset().top;
    jQuery("html, body").animate({ scrollTop: position }, speed, "swing");
    return false;
  });
});


//smooth-header固定時ページ遷移位置調整
$(window).on('load', function () {
  const url = $(location).attr('href'),
    headerHeight = $('header').outerHeight() + 0;
  if (url.indexOf("#") != -1) {
    const anchor = url.split("#"),
      target = $('#' + anchor[anchor.length - 1]),
      position = Math.floor(target.offset().top) - headerHeight;
    $("html, body").animate({ scrollTop: position }, 500);
  }
});


$(window).scroll(function () {
  if ($(window).scrollTop()) {
    $('#header').addClass('scrollClass');
  } else {
    $('#header').removeClass('scrollClass');
  }
});

//nav ハンバーガーメニュー
jQuery(function () {
  jQuery('.menuIconWrap').on('click', function () {
    jQuery(this).toggleClass('active');
    jQuery("#nav,body").toggleClass('active');
  })
  $('#nav a').on('click', function () {
    $(".menuIconWrap").toggleClass('active');
    $("#nav").toggleClass('active');
    jQuery("body").toggleClass('active');
  })
})


//高さブラウザサイズ
jQuery(function ($) {
  var winH = $(window).height();
  $('.heightWindow').outerHeight($(window).height());
  $(window).on('resize', function () {
    winH = $(window).height();
    $('.heightWindow').outerHeight(winH);
  });

});


/*端末ごとの振り分け(重要)*/
if (navigator.userAgent.indexOf('iPhone') > 0 ||
  navigator.userAgent.indexOf('iPod') > 0 ||
  (navigator.userAgent.indexOf('Android') > 0 &&
    navigator.userAgent.indexOf('Mobile') > 0)) {
  //location.href = 'sp/';
} else if (navigator.userAgent.indexOf('iPad') > 0 ||
  navigator.userAgent.indexOf('Android') > 0) {
  document.write('<meta name="viewport" content="width=1400">');
} else if (navigator.userAgent.indexOf('Safari') > 0 &&
  navigator.userAgent.indexOf('Chrome') == -1 &&
  typeof document.ontouchstart !== 'undefined') {
  document.write('<meta name="viewport" content="width=1400">');
}


/*スマホで閲覧時のみ、電話番号にtel:リンクを追加する*/
if (navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)) {
  $(function () {
    $('.tellink').each(function () {
      var str = $(this).html();
      if ($(this).children().is('img')) {
        $(this).html($('<a>').attr('href', 'tel:' + $(this).children().attr('alt').replace(/-/g, '')).append(str + '</a>'));
      } else {
        $(this).html($('<a>').attr('href', 'tel:' + $(this).text().replace(/-/g, '')).append(str + '</a>'));
      }
    });
  });
}

//IEのfixedガタツキ解消
if (navigator.userAgent.match(/MSIE 10/i) || navigator.userAgent.match(/Trident\/7\./) || navigator.userAgent.match(/Edge\/12\./)) {
  $('body').on("mousewheel", function () {
    event.preventDefault();
    var wd = event.wheelDelta;
    var csp = window.pageYOffset;
    window.scrollTo(0, csp - wd);
  });
}


// ページの読み込み時とスクロール時に表示領域に入ったらclass付与
const myFunc = function () {
  const target = document.querySelectorAll('.js-scroll');
  const position = Math.floor(window.innerHeight);

  for (let i = 0; i < target.length; i++) {
    let offsetTop = Math.floor(target[i].getBoundingClientRect().top);
    if (offsetTop < position) {
      target[i].classList.add('active');
    }
  }
}

// ページ読み込み時にクラスを付与
window.addEventListener('load', myFunc, false);

// スクロール時にクラスを付与
window.addEventListener('scroll', myFunc, false);




// recruit message
window.addEventListener('scroll', function () {
  if (window.location.pathname === '/recruit') {
    const recruitMessage = document.getElementById('recruitMessage');
    const recruitOffset = recruitMessage.offsetTop; // 修正：offsetTopを使用
    const scrollY = window.scrollY || window.pageYOffset;

    const img1 = document.querySelector('.recruitMessage .bgImg .img._01');
    const img2 = document.querySelector('.recruitMessage .bgImg .img._02');

    // recruitMessageに入ってからのスクロール量を計算
    const relativeScroll = scrollY - recruitOffset;

    if (relativeScroll <= 100 && relativeScroll >= 0) {
      // recruitMessage到達後の0〜100pxまではimg._01を表示、img._02を非表示
      img1.classList.add('active');
      img2.classList.remove('active');
    } else if (relativeScroll > 100) {
      // 100pxを超えたらimg._02を表示、img._01を非表示
      img1.classList.remove('active');
      img2.classList.add('active');
    }
  }
});


// スライド
  document.addEventListener('DOMContentLoaded', function () {
    const slideNum = document.querySelectorAll('.peopleSlideNum span');

    const swiper = new Swiper('.peopleSlide', {
      spaceBetween: 30,
      loop: true,
      speed: 2000,
      autoplay: {
        delay: 2000,
        disableOnInteraction: false
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      on: {
        slideChange: function () {
          slideNum.forEach((el, idx) => {
            el.classList.toggle('active', idx === this.realIndex);
          });
        }
      }
    });

    // 数字クリックでスライド切り替え
    slideNum.forEach((el, idx) => {
      el.addEventListener('click', () => {
        swiper.slideTo(idx);
      });
    });
  });

  document.addEventListener('DOMContentLoaded', function () {
    const slideNum = document.querySelectorAll('.careerSlideNum span');

    const swiper = new Swiper('.careerSlide', {
      loop: true,
      effect: 'cards',
      grabCursor: true,
      speed: 1000,
        cardsEffect: {
        perSlideOffset: 8,  // スライドごとのオフセット距離（px）
        perSlideRotate: 2,   // スライドごとの回転角度（度）
        slideShadows: false  // シャドウの有無
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      on: {
        slideChange: function () {
          slideNum.forEach((el, idx) => {
            el.classList.toggle('active', idx === this.realIndex);
          });
        }
      }
    });

    // 数字クリックでスライド切り替え
    slideNum.forEach((el, idx) => {
      el.addEventListener('click', () => {
        swiper.slideTo(idx);
      });
    });
  });

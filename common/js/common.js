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
    let position = target.offset().top - 100;
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


//body_headerHeight
jQuery(function() {
  if (!(window.innerWidth <= 780 && jQuery('body').is('#index'))) {
    var height = jQuery("#header").height();
    jQuery("body").css("padding-top", height);
  }
});

$(window).scroll(function () {
  if ($(window).scrollTop() > 300) {
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
window.addEventListener('DOMContentLoaded', function () {
  var ua = navigator.userAgent;

  // スマートフォンの判定（iPhone / iPod / Androidスマホ）
  if (ua.indexOf('iPhone') > 0 ||
      ua.indexOf('iPod') > 0 ||
      (ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0)) {
    // location.href = 'sp/'; // スマホ版にリダイレクト（必要であれば有効化）

  // タブレット（iPad / Androidタブレット）の判定
  } else if (ua.indexOf('iPad') > 0 ||
             (ua.indexOf('Android') > 0 && ua.indexOf('Mobile') === -1)) {
    document.body.classList.add('tablet'); // ← タブレットにクラスを追加
    addViewportMeta('width=1400');

  // Safari（iOS）でタッチ可能な端末
  } else if (ua.indexOf('Safari') > 0 &&
             ua.indexOf('Chrome') === -1 &&
             typeof document.ontouchstart !== 'undefined') {
    document.body.classList.add('tablet');
    addViewportMeta('width=1400');
  }
});

// ヘッド内にmeta viewportを追加する関数
function addViewportMeta(content) {
  var meta = document.createElement('meta');
  meta.name = 'viewport';
  meta.content = content;
  document.head.appendChild(meta);
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


// 1文字ずつ表示 js-textをテキストに付与
jQuery(function ($) {
  const animationTargetElements = document.querySelectorAll('.js-text');

  animationTargetElements.forEach((targetElement) => {
    const nodes = Array.from(targetElement.childNodes);
    targetElement.innerHTML = ''; // 一度中身をクリア

    let index = 0;
    let extraDelay = 0;

    nodes.forEach((node) => {
      if (node.nodeType === Node.TEXT_NODE) {
        // テキストノードを1文字ずつ処理
        node.textContent.split('').forEach((char) => {
          const span = document.createElement('span');
          span.textContent = char;
          span.style.animationDelay = `${(index * 0.1 + extraDelay).toFixed(2)}s`;
          targetElement.appendChild(span);
          index++;
        });
      } else if (
        node.nodeType === Node.ELEMENT_NODE &&
        node.classList.contains('txtImg') &&
        node.classList.contains('js-clip')
      ) {
        // txtImg.js-clip要素はそのまま追加
        targetElement.appendChild(node);

        // 追加ディレイを加算（例：1秒）
        extraDelay += 1.2;
      } else {
        // その他の要素（<br>など）もそのまま
        targetElement.appendChild(node);
      }
    });
  });
});

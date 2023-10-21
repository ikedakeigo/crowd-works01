jQuery(document).ready(function($){

  $("a").bind("focus",function(){if(this.blur)this.blur();});
  $("a.target_blank").attr("target","_blank");

  $('.post_content a[href^="#"]').on('click',function (e) {
    e.preventDefault();

    var target = this.hash;
    var $target = $(target);
    var headerHeight = $('#header_top').height() + 30;

    $('html, body').stop().animate({
        'scrollTop': $target.offset().top - headerHeight
    }, 800, 'easeOutExpo');
    
  });
  

  // ドロワーメニュー
  var $window = $(window);
	var $document = $(document);
  var $html = $('html');
	var $body = $('body');

  winWidth = document.body.clientWidth || window.innerWidth;
  $window.on('resize orientationchange', function(){
    winWidth = document.body.clientWidth || window.innerWidth;
    if(winWidth > 1024 && $html.hasClass('show-drawer')){
      $html.removeClass('show-drawer');
      $body.css({
        position: 'static',
        top: 'auto'
    });
    }
  });

  if ($('#js-drawer').length) {
		/**
		 * ドロワーボタン
		 */
		var drawerScrollTop;
		$('#js-menu-button').click(function() {
			drawerScrollTop = $window.scrollTop();

			// 背景スクロール対策
			$body.css({
				position: 'fixed',
				top: drawerScrollTop * -1
			});

			$('#js-header-view-cart').removeClass('is-active');
			$html.addClass('show-drawer');
			$document.trigger('drawerUpdate');

			return false;
		});

		$('#js-drawer-overlay, #js-drawer-close-button').click(function() {
			$html.removeClass('show-drawer');

			// 背景スクロール対策
			$body.css({
				position: 'static',
				top: 'auto'
			});

			$window.scrollTop(drawerScrollTop);
		});

	}

  /**
	 * グローバルナビゲーション モバイル
	 */
	$('#drawer_nav_menus .menu-item-has-children > a > .drawer_nav_toggle_button').click(function() {
		if (winWidth < 1025) {
			$(this).toggleClass('is-active');
			$(this).closest('.menu-item-has-children').toggleClass('is-active').find('> .sub-menu').slideToggle(300, function(){
				$document.trigger('drawerUpdate');
			});
		}
		return false;
	});


  //return top button
  var return_top_button = $('#return_top');
  $('a',return_top_button).click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });
  return_top_button.removeClass('active');
  $window.scroll(function () {
    if ($(this).scrollTop() > 100) {
      return_top_button.addClass('active');
    } else {
      return_top_button.removeClass('active');
    }
  });


  // ヘッダーの検索フォーム
  $("#js-header-search").on('click', function() {
    $(this).toggleClass("is_active");
    var target = $(this).prev();
    target.toggleClass("is_active");
    return false;
  });


  // カテゴリーにdata-href追加
  $('.js-category-link').on('click', function(event) {
    event.stopPropagation();
    event.preventDefault();
    window.location.href = $(this).attr('data-href');
    return false;
  });

  // アコーディオン
  $('.faq_list .title').on('click', function() {

    var desc = $(this).next('.desc_area');
    var acc_height = desc.find('.desc').outerHeight(true);
    if($(this).hasClass('active')){
      desc.css('height', '');
      $(this).removeClass('active');
    }else{
      desc.css('height', acc_height);
      $(this).addClass('active');
    }

  });

  // comment button
  $("#comment_tab li").click(function() {
    $("#comment_tab li").removeClass('active');
    $(this).addClass("active");
    $(".tab_contents").hide();
    var selected_tab = $(this).find("a").attr("href");
    $(selected_tab).fadeIn();
    return false;
  });


  // quick tag - underline ------------------------------------------
  if ($('.q_underline').length) {
    var gradient_prefix = null;

    $('.q_underline').each(function(){
      var bbc = $(this).css('borderBottomColor');
      if (jQuery.inArray(bbc, ['transparent', 'rgba(0, 0, 0, 0)']) == -1) {
        if (gradient_prefix === null) {
          gradient_prefix = '';
          var ua = navigator.userAgent.toLowerCase();
          if (/webkit/.test(ua)) {
            gradient_prefix = '-webkit-';
          } else if (/firefox/.test(ua)) {
            gradient_prefix = '-moz-';
          } else {
            gradient_prefix = '';
          }
        }
        $(this).css('borderBottomColor', 'transparent');
        if (gradient_prefix) {
          $(this).css('backgroundImage', gradient_prefix+'linear-gradient(left, transparent 50%, '+bbc+ ' 50%)');
        } else {
          $(this).css('backgroundImage', 'linear-gradient(to right, transparent 50%, '+bbc+ ' 50%)');
        }
      }
    });

    $window.on('scroll.q_underline', function(){
      $('.q_underline:not(.is-active)').each(function(){
        var top = $(this).offset().top;
        if ($window.scrollTop() > top - window.innerHeight) {
          $(this).addClass('is-active');
        }
      });
      if (!$('.q_underline:not(.is-active)').length) {
        $window.off('scroll.q_underline');
      }
    });
  }


  // responsive ------------------------------------------------------------------------
  var mql = window.matchMedia('screen and (min-width: 1025px)');
  function checkBreakPoint(mql) {

  if(mql.matches){ //PC

    $("html").removeClass("mobile");
    $("html").addClass("pc");

  } else { //smart phone

    $("html").removeClass("pc");
    $("html").addClass("mobile");

  };
  };
  mql.addListener(checkBreakPoint);
  checkBreakPoint(mql);


});
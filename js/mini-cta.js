jQuery(function($){

	var $mini_cta = $('#js-mini-cta');
	if (!$mini_cta.length) return;

	var $window = $(window);
	var $return_top = $('#return_top').hide();

	/**
	 * ミニCTA min-heightをページトップボタンに合わせる
	 */
	var min_cta_min_height = function () {
		$mini_cta.find('.p-mini-cta__contents').css('minHeight', $return_top.height() || 0);
	};
	min_cta_min_height();
	$window.on('resize.mini_cta', min_cta_min_height);

	/**
	 * ミニCTA スクロールで表示 ※ページトップに合わせる
	 */
	$window.on('scroll.mini_cta', function() {
		if ($window.scrollTop() > 100) {
			$mini_cta.addClass('is-active');
		} else {
			$mini_cta.removeClass('is-active');
		}
	});

	/**
	 * ミニCTA 閉じる
	 */
	$mini_cta.on('click', '.p-mini-cta__close', function() {
		$return_top.show();
		$(document.body).removeClass('hide_return_top');
		$mini_cta.removeClass('is-active');
		$window.off('resize.mini_cta').off('scroll.mini_cta');

		// 非表示クッキー保存
		var cookiepath = $(this).attr('data-cookiepath') || '/';
		document.cookie = 'hide_mini_cta=1; path=' + cookiepath + '; samesite=lax';

		setTimeout(function() {
			$mini_cta.remove();
		}, 1000);
	});

});

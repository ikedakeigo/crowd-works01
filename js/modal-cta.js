jQuery(function($){

	/**
	 * モーダルCTA 閉じる
	 */
	$('#js-modal-cta-close-button, #js-modal-cta-overlay').on('click', function() {
		var $modal_cta = $('#js-modal-cta');
		$modal_cta.removeClass('is-active');

		// 非表示クッキー保存
		var cookiepath = $(this).attr('data-cookiepath') || '/';
		document.cookie = 'hide_modal_cta=1; path=' + cookiepath + '; samesite=lax';

		setTimeout(function(){
			$modal_cta.remove();
		}, 1000);
	});

});

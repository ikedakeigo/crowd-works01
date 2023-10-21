jQuery(function($){


  /**
	 * ヘッダーログイン
	 */
	if ($('#js-header-mypage').length && $('#js-header-memberbox').length) {
		var $headerMemberbox = $('#js-header-memberbox');
		$('#js-header-mypage').hover(
			function() {
				$headerMemberbox.addClass('is-active');
			},
			function() {
				$headerMemberbox.removeClass('is-active');
			}
		);
		$('#js-header-memberbox :input').click(function(){
			// focusだとオートコンプリートの関係で誤動作する
			$headerMemberbox.addClass('is-active');
		});
		$('#js-header-mypage').click(function() {
			$headerMemberbox.toggleClass('is-active');
			return false;
		});
	}


  /**
	 * ヘッダーカート
	 */
	if ($('#js-header-cart').length) {
		if ($('#js-header-view-cart').length) {
			$('#js-header-cart').hover(
				function() {
					$('#js-header-memberbox.is-active').removeClass('is-active');
					$('#js-header-view-cart').addClass('is-active');
				},
				function() {
					$('#js-header-view-cart').removeClass('is-active');
				}
			);
		}

		/**
		 * WooCommerce Cart widgetなどでのajaxカート更新時に商品数バッジを更新
		 */
		if (typeof wc_cart_fragments_params === 'object') {
			$('body').on('wc_fragments_refreshed added_to_cart removed_from_cart', function(){
				try {
					var $supports_html5_storage = ('sessionStorage' in window && window.sessionStorage !== null);
					if ($supports_html5_storage) {
						var wc_fragments = JSON.parse(sessionStorage.getItem(wc_cart_fragments_params.fragment_name));
						var totalquantity = 0;
						$(wc_fragments['div.widget_shopping_cart_content']).find('.quantity').each(function(){
							totalquantity += parseInt(this.innerText, 10);
						});
						if (totalquantity === 0) {
							totalquantity = '';
						}
						$('#js-header-cart-item-count').html(totalquantity);
					}
				} catch(err) {
				}
			});
		}
	}



});
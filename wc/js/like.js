jQuery(function($){

    /**
		 * いいねクリック
		 */
		// $('.js-product-toggle-like').on('click', function(){
		$(document).on('click', '.js-product-toggle-like', function() {
			var $this = $(this);
			var post_id = $this.attr('data-post-id');
			if (!post_id || $this.hasClass('is-ajaxing')) return false;

			$this.addClass('is-ajaxing');
			$.ajax({
				url: TCD_FUNCTIONS.ajax_url,
				type: 'POST',
				data: {
					action: 'toggle_like',
					post_id: post_id
				},
				success: function(data, textStatus, XMLHttpRequest) {
					var updated = false;

					$this.removeClass('is-ajaxing');
					if (data.result == 'added') {
						// フッターバー
						if($('#js-product-footer-bar-like')){
							$('#js-product-footer-bar-like').addClass('is-liked');
						}
						$this.addClass('is-liked');
						updated = true;
						
					} else if (data.result == 'removed') {
						$this.removeClass('is-liked');
						// フッターバー
						if($('#js-product-footer-bar-like')){
							$('#js-product-footer-bar-like').removeClass('is-liked');
						}
						updated = true;
					}

					if (updated) {
						if (data.like_count) {
							$('#js-header-wishlist-count').text(data.like_count);
						} else if (data.like_count === 0) {
							$('#js-header-wishlist-count').text('');
						}

						if (data.message) {

							// if ($this.closest('.p-archive03__item').length) {
							// 	var $msg = $this.siblings('.p-archive03__item-message').remove();
							// 	$msg = $('<div class="p-archive03__item-message"></div>').hide();
							// 	$this.after($msg);
							// 	$msg.html(data.message).fadeIn(500).delay(5000).fadeOut(800, function(){
							// 		$msg.remove();
							// 	});
							// }

							if($('#js-like-modal-message').length){

								var $msg = $('#js-like-modal-message').find('.product_like_message').remove();
								$msg = $('<div class="product_like_message"><span></span><button></button></div>').hide();
								$('#js-like-modal-message').append($msg);
								$msg.find('span').html(data.message);
								$msg.fadeIn(500).delay(5000).fadeOut(800, function(){
									$msg.remove();
								});

							}

						}
					} else if (data.message) {
						alert(data.message);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					$this.removeClass('is-ajaxing');
					alert(TCD_FUNCTIONS.ajax_error_message);
				}
			});

			return false;
		});

		/**
		 * いいね削除
		 */
		$('.js-product-remove-like').on('click', function(){
			console.log('クリック');
			var $this = $(this);
			var post_id = $this.attr('data-post-id');
			var $cl = $this.closest('.product_item');
			if (!post_id || !$cl.length || $this.hasClass('is-ajaxing')) return false;

			$this.addClass('is-ajaxing');
			$.ajax({
				url: TCD_FUNCTIONS.ajax_url,
				type: 'POST',
				data: {
					action: 'remove_like',
					post_id: post_id
				},
				success: function(data, textStatus, XMLHttpRequest) {
					$this.removeClass('is-ajaxing');
					if (data.result == 'removed') {
						$cl.fadeOut(500, function(){
							$cl.remove();
							itemCount = $('.wishlist_loop').children().length;
						$('#js-wishlist-counter').removeClass().addClass('item_count_' + itemCount);
						});
					} else if (data.message) {
						alert(data.message);
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					$this.removeClass('is-ajaxing');
					alert(TCD_FUNCTIONS.ajax_error_message);
				}
			});

			return false;
		});

		// likeモーダルをクリックで非表示
		$(document).on('click', '#js-like-modal-message button', function() {
			var target = $(this).closest('.product_like_message');
			target.stop().fadeOut(800, function(){
				target.remove();
			});
		})

});

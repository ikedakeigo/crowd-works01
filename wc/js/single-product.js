jQuery(function($){

	// var winWidth = window.innerWidth;

	window.tcdSmoothScroll = function(hash){
		if (hash) {
			if ($(hash).length) {
				var t = $(hash).offset().top - 100;
						t -= $('#header_top').height();
				$('body, html').animate({
					scrollTop: t
				}, 800, 'easeOutExpo');
			}
		}
	};

	/**
	 * WooCommerceタブ等はスムーススクロール除外
	 */
	$('.wc-tabs li a, ul.tabs li a, a.woocommerce-review-link, #respond p.stars a').off('click.smoothscroll');

	/**
	 * WooCommerce .woocommerce-review-linkを遅延スムーススクロール化
	 */
	$('a.woocommerce-review-link').on('click.smoothscroll', function(e){
		var hash = this.hash;
		if (hash) {
			e.preventDefault();
			setTimeout(function(){
				window.tcdSmoothScroll(hash);
			}, 20);
		}
	});

	/**
	 * カート内のselectの親にクラス付与
	 */
	$('.p-entry-product__cart select').each(function(){
		$(this).parent().addClass('p-entry-product__cart-select-wrapper');
	});

	$(document).on('js-initialized', function(){
		/**
		 * カートの各項目ラベル幅調整
		 */
		var labelMaxWidth = 0;
		$('.p-entry-product__cart .p-entry-product__cart-label:visible').each(function(){
			var w = $(this).innerWidth();
			var pw = $(this).parent().innerWidth() / 2;
			if (w < pw && w > labelMaxWidth) {
				labelMaxWidth = w;
			}
		});
		$('.p-entry-product__cart dl.item-sku dt').each(function(){
			var w = $(this).innerWidth();
			if (w > labelMaxWidth) {
				labelMaxWidth = w;
			}
		});
		if (labelMaxWidth) {
			$('.p-entry-product__cart .p-entry-product__cart-label').css('minWidth', labelMaxWidth);
			$('.p-entry-product__cart dl.item-sku dt').css('minWidth', labelMaxWidth);
			$('.p-entry-product__cart dl.item-sku dd').css('marginLeft', labelMaxWidth);
			$('.woocommerce-variation.single_variation').css('marginLeft', labelMaxWidth);
		}
	});

	/**
	 * image zoom
	 */
	var $container = $('#js-entry-product__images');
	var $mainimage = $container.find('.p-entry-product__mainimage');
	var $mainSmallImg = $mainimage.find('.p-entry-product__mainimage-normal');
	var $zoomImg = $mainimage.find('.p-entry-product__mainimage-zoom-image');

	// if (!$mainSmallImg.length || !$zoomImg.length) return;

	// イメージ切替
	$container.find('.p-entry-product__subimage').on('click', function(){
		var $this = $(this);
		if ($this.hasClass('is-active')) return false;
		var src = $this.attr('data-zoom-image');
		if (!src) return false;
		$this.siblings('.is-active').removeClass('is-active');
		$this.addClass('is-active');
		var $clone = $mainSmallImg.clone();
		$clone.css({
			position: 'absolute',
			bottom: 0,
			left: 0,
			right: 0,
			top: 0
		});
		$mainSmallImg.after($clone);
		$mainSmallImg.attr('src', src);
		$zoomImg.attr('src', src);
		$clone.fadeOut(600, function(){
			$clone.remove();
		});
	});

	// 初期化済みクラス
	$container.addClass('js-zoom-initialized');


	// 商品数量オプション
	$('.js-single-quantity-decrease').on('click', function(e) {
    var input = $(e.target).closest('.single_product_quantity').find('input[type="number"]');
    input[0]['stepDown']();
	});
	$('.js-single-quantity-increase').on('click', function(e) {
    var input = $(e.target).closest('.single_product_quantity').find('input[type="number"]');
    input[0]['stepUp']();
	});


	// レビュー
	$(".comment-form-rating-radios label").hover(
		function () {		
			$(this).addClass('select');
			$(this).prevAll('label').addClass('select');
			$(this).nextAll('label').addClass('unselect');
		},
		function () {
			$(this).removeClass('select');
			$(this).siblings('label').removeClass('select unselect');
		}
	);



	// フッターバー
	var footerBar = $('#js-product-footer-bar');
	var cartButtun = $('.single_add_to_cart_button');
	if (footerBar.length && cartButtun.length && window.innerWidth < 600) {

		// スクロール処理
		var cartPosition = cartButtun.offset().top - 100;
		$(window).on( 'scroll', function () {
			if ($(this).scrollTop() > cartPosition) {
				footerBar.addClass('is-active');
			} else {
				footerBar.removeClass('is-active');
			}

		});

		// フッターカートボタン
		var footerCartButton = $('#js-product-footer-bar-cart');
		// ラベル変更
		var cartButtonText = $('.single_add_to_cart_button').text();
		footerCartButton.text(cartButtonText);
		// クリック
		footerCartButton.on('click', function(){
			var $cart = $('.single_product_cart');
			if ($cart.find('.single_add_to_cart_button:not(.disabled, :disabled)').length) {
				$cart.find('.single_add_to_cart_button').click();
			} else {
				$('body, html').animate({
					scrollTop: $cart.first().offset().top - 70
				}, 1000, 'easeOutExpo');
			}
			return false;
		});

		// お気に入りボタン
		likeButton = $('#js-single-product-like-button');
		footerLikeButton = $('#js-product-footer-bar-like');
		if(likeButton.hasClass('is-liked')){
			footerLikeButton.addClass('is-liked');
		}
		footerLikeButton.on('click', function(){
			$(this).toggleClass('is-liked');
			likeButton.click();
			return false;
		});


	}

	

	


	





});

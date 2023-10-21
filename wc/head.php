<?php

function tcd_wc_head() {

	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

?>
<style id="tcd-woocommerce-output-style">
.product_item .title { font-size:<?php echo esc_attr($dp_options['product_archive_title_font_size']); ?>px; }
.recentry_viewed_products_loop .product_item .title { font-size:<?php echo esc_attr($dp_options['product_archive_title_font_size_sp']); ?>px; }
@media screen and (max-width:767px) {
	.product_item .title { font-size:<?php echo esc_attr($dp_options['product_archive_title_font_size_sp']); ?>px; }
}
.single_product_title { font-size:<?php echo esc_attr($dp_options['product_single_title_font_size']); ?>px; }
@media screen and (max-width:767px) {
	.single_product_title { font-size:<?php echo esc_attr($dp_options['product_single_title_font_size_sp']); ?>px; }
}
.single_product_like.is-liked:before, .product_footer_like_button.is-liked:before { color:<?php echo esc_attr($dp_options['product_single_wishlist_icon_color']); ?>; }
.star-rating, .star-rating:before, .comment-form-rating-radios label::before { color:<?php echo esc_attr($dp_options['product_single_reviews_star_color']); ?>!important; }
.product_like_message { background-color:<?php echo esc_attr($dp_options['product_wishlist_message_bg_color']); ?>; }
</style>
<?php

  // 関連商品, クロスセル, アップセル
  if( is_product() || is_cart() ){

    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '7.4.1', true );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '7.4.1' );

?>
<script id="wc-related-product-slider">
document.addEventListener("DOMContentLoaded", function(){

	var productSilders = document.querySelectorAll('.js-product-slider');

  if(productSilders.length > 0){

    var swiperBool;
    var breakPoint = 767;
    var swipers = [];

    // swiper初期化
    const initSlider = ( productSilders, swipers ) => {

      for(let slider of productSilders) {

				if(slider.dataset.productNum > 3){

					let sliderWrapId = '#' + slider.closest('.product_carousel').id;
					let sliderId = '#' + slider.id;

					let options = {
						loop: true,
						speed: 700,
						navigation: {
							nextEl: sliderWrapId + ' .swiper-button-next',
							prevEl: sliderWrapId + ' .swiper-button-prev',
						},
						autoplay: {
							delay: 1000,
							disableOnInteraction: false
						},
						breakpoints: {
							1024: { slidesPerView: 3, spaceBetween: 35 },
							768: { slidesPerView: 3, spaceBetween: 25 },
							350: { slidesPerView: 2, spaceBetween: 20 }
						},
						on: {
							init: function () {

								// カルーセルが画面内に表示されたらautoplay開始
								let options = {
									root: null,
									rootMargin: "0px",
									threshold: 0,
								};
								let observer = new IntersectionObserver(callback, options);
								observer.observe(slider);

								function callback(entries) {
									entries.forEach(function (entry) {
										if (entry.isIntersecting) {
											swipers[sliderId].autoplay.start();
											swipers[sliderId].params.autoplay.delay=5000;
											observer.unobserve(entry.target);
										}
									});
								}

							}, // END init function
						},
					} // END options

					swipers[sliderId] = new Swiper( sliderId, options );
					swipers[sliderId].autoplay.stop();

				}

      }
    };

    // swiper解除
    const destroySlider = ( productSilders, swipers ) => {
      for(let slider of productSilders) {
				if(slider.dataset.productNum > 3){
					let sliderId = '#' + slider.id;
					swipers[sliderId].destroy(true,true);
				}
      }
    };

    // 読み込み時にウィンドウ幅に応じて初期化
    const loadSliderAction = () => {
      if(window.innerWidth > breakPoint ) { // 767より大きい
        initSlider(productSilders, swipers);
        swiperBool = true;
      }else{ // 767以下
        swiperBool = false;
      }
    }

		// ロード画面使用可否による初期化
		var target = document.getElementById('body');
		if(target.classList.contains('use_loading_screen') == true){ // ロード画面を使用する
			window.addEventListener('tcd_end_loading', function(){
				loadSliderAction();
			});
		}else{
			loadSliderAction();
		}

    // リサイズ時にウィンドウ幅に応じて初期化・解除
    window.addEventListener('resize', function() {
			let windowWidth = window.innerWidth;
      if( windowWidth <= breakPoint && swiperBool == true ){ // 767以下
        destroySlider(productSilders, swipers);
        swiperBool = false;
      }else if( windowWidth > breakPoint && swiperBool == false){
        initSlider(productSilders, swipers);
        swiperBool = true;
      }
    });

  }

});
</script>
<?php

  }

  // 最近チェックした商品
  if( $dp_options['show_product_single_recentry_viewed_products'] && is_product() ){

    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '7.4.1', true );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '7.4.1' );

?>
<script id="wc-recentry-viewed-products-slider">
document.addEventListener("DOMContentLoaded", function(){

	var recentryViewedSlider = document.getElementById('js-recentry-viewed-products');

  if(recentryViewedSlider !== null){

		var slideNum = recentryViewedSlider.querySelectorAll('.product_item').length;

		var swiper = [];
    var swiperBool;
    var breakPoint = 767;

    // swiper初期化
    const initSlider = ( recentryViewedSlider, swiper, slideNum ) => {

			if(slideNum > 3){

				let options = {
					loop: true,
					speed: 700,
					navigation: {
						nextEl: '.recentry_viewed_products .swiper-button-next',
						prevEl: '.recentry_viewed_products .swiper-button-prev',
					},
					breakpoints: {
						1025: { slidesPerView: 5, spaceBetween: 25 },
						768: { slidesPerView: 3, spaceBetween: 25 },
						350: { slidesPerView: 2, spaceBetween: 20 }
					}
				} // END options

				swiper[recentryViewedSlider.id] = new Swiper( recentryViewedSlider, options );

			}

		}

		// swiper解除
    const destroySlider = ( recentryViewedSlider, swiper, slideNum ) => {
			if(slideNum > 3){
				swiper[recentryViewedSlider.id].destroy(true,true);
			}
    };

		// 読み込み時にウィンドウ幅に応じて初期化
		let windowWidth = window.innerWidth;
    if( (windowWidth > 1024 && slideNum > 5) || windowWidth > 767 && windowWidth <= 1024) { // 767より大きい
			initSlider(recentryViewedSlider, swiper, slideNum);
			swiperBool = true;
		}else{ // 767以下
			swiperBool = false;
		}

		// リサイズ時にウィンドウ幅に応じて初期化・解除
    window.addEventListener('resize', function() {
			let windowWidth = window.innerWidth;
      if( (windowWidth <= 767 && swiperBool == true) || (windowWidth > 1024 && slideNum <= 5 && swiperBool == true) ){ // 767以下
        destroySlider(recentryViewedSlider, swiper, slideNum);
        swiperBool = false;
      }else if( ( swiperBool == false && windowWidth > 767 && windowWidth <= 1024 ) || ( swiperBool == false && windowWidth > 1024 && slideNum > 5 ) ){
        initSlider(recentryViewedSlider, swiper, slideNum);
        swiperBool = true;
      }

    });

	}

});
</script>
<?php

  }

}
add_action('tcd_woocommerc_output_style', 'tcd_wc_head', 11 );
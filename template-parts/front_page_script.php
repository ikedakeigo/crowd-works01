<?php

  $options = get_design_plus_option();

// ヘッダースライダー
  $index_slider_time = $options['index_slider_time'];
  $show_header_slider = apply_filters( 'ankle_show_header_slider', $options['show_index_slider'] );
  if($show_header_slider && !empty($options['index_slider']) ){

    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '7.4.1', true );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '7.4.1' );

?>
<script id="header-slider-js">
document.addEventListener("DOMContentLoaded", function(){

  // スマホ時に高さをあわせる
  var header_slider_wrap = document.getElementById('header_slider_wrap');

  if(header_slider_wrap != null){

    var w_height = window.innerHeight;
    var header_bar_height = document.getElementById('header_top').offsetHeight;
    var slider_height = w_height - header_bar_height;

    // ニュースティッカー
    var news_ticker = document.getElementById('news_ticker');
    if(news_ticker != null){
      slider_height = slider_height - news_ticker.offsetHeight + 1;
    }

    // ヘッダーメッセージ
    var header_message = document.getElementById('header_message');
    if(header_message != null){
      slider_height = slider_height - header_message.offsetHeight;
    }

    if(window.innerWidth < 700){
      header_slider_wrap.style.height = slider_height + 'px';
    }

  }

  var header_slider = document.getElementById('header_slider');
  var ytSlides = header_slider.querySelectorAll('.youtube-player');
  for(var ytSlide of ytSlides) { ytSlide.style.opacity = '0'; }

  // YouTube API 読み込み
  let scripts = document.querySelectorAll('script[src="//www.youtube.com/iframe_api"]');
  if(ytSlides.length > 0 && scripts.length == 0){
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  }

  if(header_slider != null){

    var indexSwiper = new Swiper(header_slider, {
      init: false,
      effect: 'fade', // エフェクト
      speed: 1200, // スライドが切り替わるスピー
      slidesPerView: 'auto',
      autoplay: { // 自動再生
        delay: <?php echo esc_html($index_slider_time); ?>,
        disableOnInteraction: false
      },
      loop:false,
      pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
      }
    }); // new Swiper

    // init
    indexSwiper.on('init', function() {

      let currentSlide = this.slides[this.activeIndex];
      if(currentSlide.classList.contains('video') == true){

        let video = currentSlide.querySelector('video');
        video.currentTime = 0;
        video.play();
        indexSwiper.autoplay.stop();
        indexSwiper.params.autoplay.delay=0;

        video.addEventListener('ended', function() {
          indexSwiper.autoplay.start();
        }, false);

      }else if(currentSlide.classList.contains('youtube') == true){
        indexSwiper.autoplay.stop();
        indexSwiper.params.autoplay.delay=0;
      }
    
    });

    // YouTubeプレイヤー
    var ytPlayers = {};

    // swiper初期化（ロード画面）
    var target = document.getElementById('body');
    if(target.classList.contains('use_loading_screen') == true){ // ロード画面を使用する

      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if(target.classList.contains('close_loading_screen') == true){ // ロード画面終了後にswiper初期化
            indexSwiper.init();
            youtubeControl();
            observer.disconnect();
          }
        });
      });

      const config = { attributes: true }; // 属性のみ監視
      observer.observe(target, config); // 監視開始

    }else{ // ロード画面を使用しない（DOMツリー構築後に初期化）  
      indexSwiper.init();
      window.onYouTubeIframeAPIReady = function(){
        youtubeControl();
      };

    }

    // YouTubeプレイヤー制御
    function youtubeControl() {

      var slides = indexSwiper.slides;
      ytSlides.forEach(slide => {

        var ytPlayerId = slide.id;
        if (!slide) return;

        var player = new YT.Player(ytPlayerId, {

          events: {

            onReady: function(e) {

              ytPlayers[ytPlayerId] = player;
              ytPlayers[ytPlayerId].mute();
              ytPlayers[ytPlayerId].lastStatus = -1;

              let active_slide = slides[indexSwiper.activeIndex];

              if(active_slide.classList.contains('youtube') == true){
                    
                let active_ytPlayerId = active_slide.querySelector('.youtube-player').id;
                if(active_ytPlayerId == ytPlayerId){
                  ytPlayers[ytPlayerId].seekTo(0, true);
                  ytPlayers[ytPlayerId].playVideo();
                }

              }

            }, // onReady

            onStateChange: function(e) {

              if (e.data === 0) { // 再生終了
                indexSwiper.autoplay.start();
              }else if(e.data === 1){
                slide.style.opacity = '1';
              }

            }

          } // events

        });

      }); // for

    }


    // slide change
    indexSwiper.on('slideChange', function() {

      let currentSlide = this.slides[this.activeIndex];
      let prev_slide = this.slides[this.previousIndex];

      if(currentSlide.classList.contains('video') == true){

        let video = currentSlide.querySelector('video');
        video.currentTime = 0;
        setTimeout(function(){ video.play(); }, 100);
        this.autoplay.stop();
        this.params.autoplay.delay=0;
        video.addEventListener('ended', function() {
          indexSwiper.autoplay.start();
        }, false);

      }else if(currentSlide.classList.contains('youtube') == true){

        this.autoplay.stop();
        let iframe = currentSlide.querySelector('.youtube-player');
        let ytPlayerId = iframe.id;
        ytPlayers[ytPlayerId].seekTo(0, true);
        ytPlayers[ytPlayerId].playVideo();

      }else{ // image

        this.params.autoplay.delay=<?php echo esc_html($index_slider_time); ?>;
        this.autoplay.start();

      }

      if(prev_slide.classList.contains('video') == true){
      
        prev_slide.querySelector('video').pause();

      }else if(prev_slide.classList.contains('youtube') == true){

        let ytPlayerPrevId = prev_slide.querySelector('.youtube-player').id;
        if(ytPlayerPrevId){
          ytPlayers[ytPlayerPrevId].pauseVideo();
        }

      }

    });

  } // if selector

});
</script>
<?php

  }

  // ニュースティッカー
  $show_news_ticker = apply_filters( 'ankle_show_news_ticker', $options['show_news_ticker'] );
  if($show_news_ticker){

    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '7.4.1', true );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '7.4.1' );

?>
<script id="news-ticker-slider-js">
document.addEventListener("DOMContentLoaded", function(){

	let news_ticker = document.getElementById('news_ticker_slider');
  if(news_ticker != null){

    var news_ticker_slider = new Swiper(news_ticker, {
      // allowTouchMove: false,
      // direction: 'vertical',
      effect: 'fade',
			fadeEffect: {
				crossFade: true
			},
      loop: true,
      speed: 1000,
      autoplay: {
        delay: 1000,
      }

    });

    news_ticker_slider.autoplay.stop();

    // ロード画面使用可否による初期化
		var target = document.getElementById('body');
		if(target.classList.contains('use_loading_screen') == true){ // ロード画面を使用する
			window.addEventListener('tcd_end_loading', function(){
        news_ticker_slider.autoplay.start();
				news_ticker_slider.params.autoplay.delay=5000;
			});
		}else{
			news_ticker_slider.autoplay.start();
      news_ticker_slider.params.autoplay.delay=5000;
		}

	}

});
</script>
<?php

  }

  // ブログカルーセル
  $show_blog_carousel = apply_filters( 'ankle_show_blog_carousel', $options['show_blog_carousel'] );
  if($show_blog_carousel && $options['main_content_type'] == 'type1') {

    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '7.4.1', true );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '7.4.1' );

?>
<script id="blog-carousel-slider-js">
document.addEventListener("DOMContentLoaded", function(){

  var blog_carousel = document.getElementById('index_blog_carousel');

  if(blog_carousel != null){

    var slideNum = blog_carousel.querySelectorAll('.item').length;

    if(slideNum > 3){

      var swiperBool;
      var breakPoint = 1024;
      var swipers = [];

      // swiper初期化
      const initSlider = ( swipers ) => {

          let sliderId = '#blog_carousel_slider';
          let blog_carousel_slider = document.getElementById('blog_carousel_slider');

          let options = {
            loop: true,
            speed: 700,
            navigation: {
              nextEl: '#index_blog_carousel .swiper-button-next',
              prevEl: '#index_blog_carousel .swiper-button-prev',
            },
            autoplay: {
              delay: 500,
              disableOnInteraction: false
            },
            breakpoints: {
              1000: { slidesPerView: 3, spaceBetween: 35 },
              768: { slidesPerView: 2.5, spaceBetween: 20 },
              350: { slidesPerView: 1.5, spaceBetween: 20 }
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
                observer.observe(blog_carousel_slider);

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

    
      };

      // swiper解除
      const destroySlider = ( swipers ) => {
        let sliderId = '#blog_carousel_slider';
        swipers[sliderId].destroy(true,true);
      };

      // 読み込み時にウィンドウ幅に応じて初期化
      const loadSliderAction = () => {
        if(window.innerWidth > breakPoint ) { // 750より大きい
          initSlider(swipers);
          swiperBool = true;
        }else{ // 750以下
          swiperBool = false;
        }
      }

      // ロード画面使用可否による初期化
      var target = document.getElementById('body');
      if(target.classList.contains('use_loading_screen') == true){ // ロード画面を使用する

        const observer = new MutationObserver((mutations) => {
          mutations.forEach((mutation) => {
            if(target.classList.contains('close_loading_screen') == true){ // ロード画面終了後にswiper初期化
              loadSliderAction();
              observer.disconnect();
            }
          });
        });

        const config = { attributes: true }; // 属性のみ監視
        observer.observe(target, config); // 監視開始

      }else{ // ロード画面を使用しない（DOMツリー構築後に初期化）
        loadSliderAction();
      }

      // リサイズ時にウィンドウ幅に応じて初期化・解除
      window.addEventListener('resize', function() {
        if( window.innerWidth <= breakPoint && swiperBool == true ){ // 750以下
          destroySlider(swipers);
          swiperBool = false;
        }else if( window.innerWidth > breakPoint && swiperBool == false){
          initSlider(swipers);
          swiperBool = true;
        }
      });

    }

  }

});
</script>
<?php

  }

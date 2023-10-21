jQuery(function($){

  var body = $('body');
  var loading_screen = $('#js-loadding-screen');
	if (!loading_screen.length) return;

  // ウィンドウの高さに揃える
  loading_screen.css('height', $(window).innerHeight());

  // ローディング完了後のカスタムイベント登録
  var EndLoading = new Event('tcd_end_loading');

  // ロードが完了したら
  $(window).load(function(){

    // 読み込み完了（アイコン）
    afterLoad();

  });

  // ロードが終わって終わっていなかったら 10秒後に消す
  setTimeout(function(){

    if(!loading_screen.hasClass('loaded')){
      afterLoad();
    }
    
	}, 10000);

  function afterLoad() {

    loading_screen.addClass('loaded');

    if(loading_screen.hasClass('p-loading-screen--simple')){
      body.addClass('close_loading_screen');
      window.dispatchEvent(EndLoading);
    }
    
    if(loading_screen.hasClass('p-loading-screen--splash')){
      $('#js-loading-screen-content').on('animationend', function() {
        loading_screen.addClass('animation_end');
        setTimeout(function(){
          body.addClass('close_loading_screen');
          window.dispatchEvent(EndLoading);
        }, 1500);
      });
    }

  }

});
jQuery(document).ready(function($) {

  if($('body').hasClass('widgets-php')) {
    var current_item;
    var target_id;
    $(document).on('click', '.tcd_ad_widget_headline', function(){
      $(this).toggleClass('active');
      $(this).next('.tcd_ad_widget_box').toggleClass('open');
    });
  }

  // デザイン見出しのアイコン
  $(document).on('click', '.widget_headline_hide_icon', function(event){
    if ($(this).is(":checked")) {
      $(this).closest('.tcd_widget_content').next().hide();
    } else {
      $(this).closest('.tcd_widget_content').next().show();
    }
  });


  // 記事タイプが最新の時は並び順を表示しない
  $('.style_post_list1_field select.style_post_list1_post_type').change(function(){
    if ( $(this).val() == 'recent_post' ) {
      $(this).closest('.style_post_list1_field').find('.style_post_list1_post_order').hide();
    } else {
      $(this).closest('.style_post_list1_field').find('.style_post_list1_post_order').show();
    }
  });
  $('.style_post_list1_field select.style_post_list1_post_type').each(function(){
    if ( $(this).val() == 'recent_post' ) {
      $(this).closest('.style_post_list1_field').find('.style_post_list1_post_order').hide();
    } else {
      $(this).closest('.style_post_list1_field').find('.style_post_list1_post_order').show();
    }
  });


});


//カラーピッカー
(function($){
	function initColorPicker(widget) {
		widget.find('.color-picker').wpColorPicker( {
			change: _.throttle(function() { // For Customizer
				$(this).trigger('change');
			}, 3000 )
		});
	}
	function onFormUpdate(event, widget) {
		initColorPicker(widget);
	}
	$(document).on( 'widget-added widget-updated', onFormUpdate );
	$(document).ready( function() {
		$('#widgets-right .widget:has(.color-picker)').each(function(){
			initColorPicker($(this));
		});
	});
}(jQuery));


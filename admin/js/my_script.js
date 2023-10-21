jQuery(document).ready(function($){


	// 汎用タブ
  $(document).on('click', '.tcd_standard_tab_label', function(event){
    var tab_index = $('.tcd_standard_tab_label').index(this);
    $(this).addClass('is_active').siblings('.tcd_standard_tab_label').removeClass('is_active');
    $(this).closest('.tcd_standard_tab_area').next('.tcd_standard_tab_contents').find('.tcd_standard_tab_content').removeClass('is_active');
    $('.tcd_standard_tab_content').eq(tab_index).addClass('is_active');
  });

  // CTA セレクトボックスでランダム表示を選択した時のみ表示
	$('#js-cta-display').change(function() {
		if ('4' === $(this).val()) {
			$('#js-cta-random-display').removeClass('u-hidden');
		} else {
			$('#js-cta-random-display').addClass('u-hidden');
		}
	});
	$('#js-footer-cta-display').change(function() {
		if ('4' === $(this).val()) {
			$('#js-footer-cta-random-display').removeClass('u-hidden');
		} else {
			$('#js-footer-cta-random-display').addClass('u-hidden');
		}
	});


  // 文字数をカウントして超えた場合はメッセージを表示
  $(document).on('keyup', 'textarea.check_characters', function(){
    var maxlen = $(this).attr('maxlength');
    var length = $(this).val().length;
    if(length > (maxlen - 3) ){
      $(this).next().show();
    } else {
      $(this).next().hide();
    }
  });


  // デザインラジオボタン２
  $(document).on('click', '.design_radio_button2 li', function(event){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
  });

  // カラーピッカー
  var color_picker_change_timer = null
	$('.c-color-picker').wpColorPicker({
		change: function(event){
			clearTimeout(color_picker_change_timer);
			color_picker_change_timer = setTimeout(function(){
				$(event.target).trigger('change')
			}, 100);
		},
		palettes: ['#000000','#FFFFFF','#dd3333','#dd9933','#eeee22','#81d742','#1e73be',TCD_MESSAGES.mainColor ]
	});

  // スライダーの横幅によって推奨画像サイズを切り替える
  $(document).on('click', 'input[name="dp_options[index_slider_content_width]"]', function(event){
    if( $('input[name="dp_options[index_slider_content_width]"]:checked').val() == 'type1' ) {
      $(this).closest('.theme_option_field_ac_content').find('.recommend_desc.width_type1').show();
      $(this).closest('.theme_option_field_ac_content').find('.recommend_desc.width_type2').hide();
    }else{
      $(this).closest('.theme_option_field_ac_content').find('.recommend_desc.width_type1').hide();
      $(this).closest('.theme_option_field_ac_content').find('.recommend_desc.width_type2').show();
    }
  });


  // 固定ページテンプレートで表示メタボックス切替
  function show_lp_meta_box() {
    $('#page_header_meta_box').show();
  }
  function normal_template() {
    $('#page_header_meta_box').hide();
  }
  $('select#hidden_page_template').each(function(){
    if ( $(this).val() == 'page-lp.php' ) {
      show_lp_meta_box();
    } else {
      normal_template();
    }
  });

  $(document).on('change', 'select#page_template, .editor-page-attributes__template select', function(){
    if ( $(this).val() == 'page-lp.php' ) {
      show_lp_meta_box();
    } else {
      normal_template();
    }
  }).trigger('change');

  // ブロックエディタ用
  if(wp.data !== undefined && wp.data.select('core/editor') !== null ){
    const { select, subscribe } = wp.data;
    class PageTemplateSwitcher {
      constructor() {
        this.template = null;
      }
      init() {
        subscribe( () => {
          const newTemplate = select( 'core/editor' ).getEditedPostAttribute( 'template' );
          if (newTemplate !== undefined && this.template === null) {
            this.template = newTemplate;
          }
          if ( newTemplate !== undefined && newTemplate !== this.template ) {
            this.template = newTemplate;
            this.changeTemplate();
          }
        });
      }
      changeTemplate() {
        if ( this.template == 'page-lp.php' ) {
          show_lp_meta_box();
        } else {
          normal_template();
        }
      }
    }
    new PageTemplateSwitcher().init();
  }


  // フッターバーのタイプ
  $(document).on('click', '#footer_bar_display_type1_button, #footer_bar_display_type2_button', function(event){
    $('#footer_bar_setting_area').show();
  });
  $(document).on('click', '#footer_bar_display_type3_button', function(event){
    $('#footer_bar_setting_area').hide();
  });

  $(document).on('click', '#footer_bar_type1_button', function(event){
    $('#footer_bar_type1_option').show();
    $('#footer_bar_type2_option').hide();
  });
  $(document).on('click', '#footer_bar_type2_button', function(event){
    $('#footer_bar_type1_option').hide();
    $('#footer_bar_type2_option').show();
  });


  // 固定ページのカスタムフィールドの並び替え
  $(".theme_option_field_order").sortable({
    placeholder: "theme_option_field_order_placeholder",
    handle: '.theme_option_headline',
    //helper: "clone",
    start: function(e, ui){
      ui.item.find('textarea').each(function () {
        if (window.tinymce) {
          tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
        }
      });
    },
    stop: function (e, ui) {
      ui.item.toggleClass("active");
      ui.item.find('textarea').each(function () {
        if (window.tinymce) {
          tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
        }
     });
    },
    forceHelperSize: true,
    forcePlaceholderSize: true
  });


  //テキストエリアの文字数をカウント
  $('.word_count').each( function(i){
    var count = $(this).val().length;
    $(this).next('.word_count_result').children().text(count);
  });
  $('.word_count').keyup(function(){
    var count = $(this).val().length;
    $(this).next('.word_count_result').children().text(count);
  });


  // アコーディオンの開閉
  $(document).on('click', '.theme_option_subbox_headline', function(event){
    $(this).closest('.sub_box').toggleClass('active');
    return false;
  });
  $(document).on('click', '.sub_box .close_sub_box', function(event){
    $(this).closest('.sub_box').toggleClass('active');
    return false;
  });

  // サブボックスのtitleをheadlineに反映させる
  $(document).on('change keyup', '.sub_box .repeater-label', function(){
    $(this).closest('.sub_box').find('.theme_option_subbox_headline:first').text($(this).val());
  });
  $('.sub_box .repeater-label').each(function(){
    if( $(this).val() != "" ){
      $(this).closest('.sub_box').find('.theme_option_subbox_headline:first').text($(this).val());
    }
  });

  // テーマオプションの入力エリアの開閉
  $('.theme_option_field_ac:not(.theme_option_field_ac.open)').on('click', '.theme_option_headline', function(){
    $(this).parents('.theme_option_field_ac').toggleClass('active');
    return false;
  });
  $('.theme_option_field_ac:not(.theme_option_field_ac.open)').on('click', '.close_ac_content', function(){
    $(this).parents('.theme_option_field_ac').toggleClass('active');
    return false;
  });


  // theme option tab
  $('#my_theme_option').cookieTab({
    tabMenuElm: '#theme_tab',
    tabPanelElm: '#tab-panel'
  });


  // リピーターフィールド ----------------------------------------------------------------------------------------------------------------------------
  var init_repeater = function(el) {
    $(el).each(function() {
      var $repeater_wrapper = $(this).addClass('repeater-initialized');
      var next_index = $repeater_wrapper.find(".repeater:first > .repeater-item").length || 0;

      // アイテムの並び替え
      $repeater_wrapper.find(".sortable").sortable({
        placeholder: "sortable-placeholder",
        handle: '> .theme_option_subbox_headline',
        //helper: "clone",
        start: function(e, ui){
          ui.item.find('textarea').each(function () {
            if (window.tinymce) {
              tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
            }
          });
        },
        stop: function (e, ui) {
          //ui.item.toggleClass("active");
          ui.item.find('textarea').each(function () {
            if (window.tinymce) {
              tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
            }
          });
        },
        distance: 5,
        forceHelperSize: true,
        forcePlaceholderSize: true
      });

      // 新しいアイテムを追加する
      $repeater_wrapper.off("click", ".button-add-row").on("click", ".button-add-row", function() {
        var clone = $(this).attr("data-clone");
        var $parent = $(this).closest(".repeater-wrapper");
        if (clone && $parent.size()) {
          var addindex = $(this).attr("data-add-index") || "addindex";
          var regexp = new RegExp(addindex, "gu");
          next_index++;
          clone = clone.replace(regexp, next_index);
          $parent.find(".repeater:first").append(clone);

          // 記事カスタムフィールド用 リッチエディターがある場合
          var $clone = $($(this).attr('data-clone'));
          if ($clone.find('.wp-editor-area').length) {
            // クローン元のリッチエディターをループ
            $clone.find('.wp-editor-area').each(function(){
              // id
              var id_clone = $(this).attr('id');
              var id_new = id_clone.replace(regexp, next_index);

              // クローン元のmceInitをコピー置換
              if (typeof tinyMCEPreInit.mceInit[id_clone] != 'undefined') {
                // オブジェクトを=で代入すると参照渡しになるため$.extendを利用
                var mce_init_new = $.extend(true, {}, tinyMCEPreInit.mceInit[id_clone]);
                mce_init_new.body_class = mce_init_new.body_class.replace(regexp, next_index);
                mce_init_new.selector = mce_init_new.selector.replace(regexp, next_index);
                tinyMCEPreInit.mceInit[id_new] = mce_init_new;

                // 解除してからリッチエディター化
                var mceInstance = tinymce.get(id_new);
                if (mceInstance) mceInstance.remove();
                tinymce.init(mce_init_new);
              }

              // クローン元のqtInitをコピー置換
              if (typeof tinyMCEPreInit.qtInit[id_clone] != 'undefined') {
                // オブジェクトを=で代入すると参照渡しになるため$.extendを利用
                var qt_init_new = $.extend(true, {}, tinyMCEPreInit.qtInit[id_clone]);
                qt_init_new.id = qt_init_new.id.replace(regexp, next_index);
                tinyMCEPreInit.qtInit[id_new] = qt_init_new;

                // 解除してからリッチエディター化
                var qtInstance = QTags.getInstance(id_new);
                if (qtInstance) qtInstance.remove();
                quicktags(tinyMCEPreInit.qtInit[id_new]);
              }

              setTimeout(function(){
                if ($('#wp-'+id_new+'-wrap').hasClass('tmce-active')) {
                  switchEditors.go(id_new, 'toggle');
                  switchEditors.go(id_new, 'tmce');
                } else {
                  switchEditors.go(id_new, 'html');
                }
              }, 500);
            });
          }
        }

        $repeater_wrapper.find('.c-color-picker').wpColorPicker();

        // リピーター内リピーターがある場合リピーター初期化
        if ($repeater_wrapper.find('.repeater-wrapper:not(.repeater-initialized)').length) {
          init_repeater($repeater_wrapper.find('.repeater-wrapper:not(.repeater-initialized)'));
        }

        // ここに追加

        // ロゴプレビュー機能
        logo_preview();

        return false;
      });

      // アイテムを削除する
      $repeater_wrapper.on("click", ".button-delete-row", function() {
        var del = true;
        var confirm_message = $(this).closest(".repeater").attr("data-delete-confirm");
        if (confirm_message) {
          del = confirm(confirm_message);
        }
        if (del) {
          $(this).closest(".repeater-item").remove();
        }
        return false;
      });

      // フッターの固定ボタンのタイプによって、表示フィールドを切り替える
      $repeater_wrapper.on("change", ".footer-bar-type select", function() {
        var sub_box = $(this).parents(".sub_box");
        var target = sub_box.find(".footer-bar-target");
        var url = sub_box.find(".footer-bar-url");
        var number = sub_box.find(".footer-bar-number");
        switch ($(this).val()) {
          case "type1" :
            target.show();
            url.show();
            number.hide();
            break;
          case "type2" :
            target.hide();
            url.hide();
            number.hide();
            break;
          case "type3" :
            target.hide();
            url.hide();
            number.show();
          break;
        }
      });

/*
      $(document).on('change keyup', '.sub_box .repeater-label', function(){}); があるのでコメントアウト

      // リピーター ボタン名
      $repeater_wrapper.on('change keyup', '.repeater .repeater-label', function(){
        if ($(this).val()) {
          if ($repeater_wrapper.is('.type2 ')) {
            $(this).closest('.repeater-item').find('> .theme_option_subbox_headline span').eq(0).text($(this).val());
          } else {
            $(this).closest('.repeater-item').find('> .theme_option_subbox_headline').text($(this).val());
          }
        }
      });
      $repeater_wrapper.find('.repeater .repeater-label').trigger('change');
*/
    });
  };
  init_repeater($(".repeater-wrapper"));
  // リピーターフィールドここまで --------------------------------------------------------------

	// 保護ページのラベルを見出し（.theme_option_subbox_headline）に反映する
  $(document).on('change keyup', '.theme_option_subbox_headline_label', function(){
		$(this).closest('.sub_box_content').prev().find('span').text(' : ' + $(this).val());
  });



	// AJAX保存 ------------------------------------------------------------------------------------
	var $themeOptionsForm = $('#myOptionsForm');
	if ($themeOptionsForm.length) {

		// タブごとのAJAX保存

		// タブ内フォームAJAX保存中フラグ
		var tabAjaxSaving = 0;

		// 現在値を属性にセット
		var setInputValueToAttr = function(el) {
			// フォーム項目
			var $inputs = $(el).find(':input').not(':button, :submit');

			$inputs.each(function(){
				if ($(this).is('select')) {
					$(this).attr('data-current-value', $(this).val());
					$(this).find('[value="' + $(this).val() + '"]').attr('selected', 'selected');
				} else if ($(this).is(':radio, :checkbox')) {
					if ($(this).is(':checked')) {
						$(this).attr('data-current-checked', 1);
					} else {
						$(this).removeAttr('data-current-checked');
					}

					// チェックボックスで同じname属性が一つだけの場合はマージ対策でinput[type="hidden"]追加
					if ($(this).is(':checkbox') && $(this).closest('form').find('input[name="'+this.name+'"]').length == 1) {
						$(this).before('<input type="hidden" name="'+this.name+'" value="" data-current-value="">')
					}
				} else {
					$(this).attr('data-current-value', $(this).val());
				}
			});
		};

		// タブフォーム項目init処理
		var initAjaxSaveTab = function(el, savedInit) {
			// savedInit以外で更新フラグがあれば終了
			if (!savedInit && $(el).attr('data-has-changed')) return

			// 更新フラグ・ソータブル変更フラグ削除
			$(el).removeAttr('data-has-changed').removeAttr('data-sortable-changed');

			// 現在値を属性にセット
			setInputValueToAttr(el);

			// フォーム項目
			var $inputs = $(el).find(':input').not(':button, :submit');

			// 項目数をセット
			$(el).attr('data-current-inputs', $inputs.length);
		};

		// タブフォーム項目に変更があるか
		var hasChangedAjaxSaveTab = function(el) {
			var hasChange = false;

			// 更新フラグあり
			if ($(el).attr('data-has-changed')) {
				return true
			}

			// フォーム項目
			var $inputs = $(el).find(':input').not(':button, :submit');

			// ソータブル変更フラグチェック
			if ($(el).attr('data-sortable-changed')) {
				hasChange = true;

			// フォーム項目数チェック
			} else if ($inputs.length !== $(el).attr('data-current-inputs') - 0) {
				hasChange = true;

			} else {
				// フォーム変更チェック
				$inputs.each(function(){
					if ($(this).is('select')) {
						if ($(this).val() !== $(this).attr('data-current-value')) {
							hasChange = true;
							return false;
						}
					} else if ($(this).is(':radio, :checkbox')) {
						if ($(this).is(':checked') && !$(this).attr('data-current-checked')) {
							hasChange = true;
							return false;
						} else if (!$(this).is(':checked') && $(this).attr('data-current-checked')) {
							hasChange = true;
							return false;
						}
					} else {
						if ($(this).val() !== $(this).attr('data-current-value')) {
							hasChange = true;
							return false;
						}
					}
				});
			}

			// 変更ありの場合、更新フラグセット
			if (hasChange) {
				$(el).attr('data-has-changed', 1);
			}

			return hasChange;
		};

		// 初期表示タブ
		initAjaxSaveTab($themeOptionsForm.find('.tab-content:visible'));

		// タブ変更前イベント
		$('#my_theme_option').on('jctBeforeTabDisplay', function(event, args) {
			// args.tabDisplayにfalseをセットするとタブ移動キャンセル

			// タブAJAX保存中の場合はタブ移動キャンセル
			if (tabAjaxSaving) {
				args.tabDisplay = false;
				return false;
			}

			// タブ内フォーム項目に変更あり
			if (hasChangedAjaxSaveTab(args.$beforeTabPanel)) {
				if (!confirm(TCD_MESSAGES.tabChangeWithoutSave)) {
					args.tabDisplay = false;
					return false;
				}
			}

			// タブ移動
			initAjaxSaveTab(args.$afterTabPanel);
		});

		// ソータブル監視
		$themeOptionsForm.on('sortupdate', '.ui-sortable', function(event, ui) {
			// 更新フラグセット
			$themeOptionsForm.find('.tab-content:visible').attr('data-sortable-changed', 1);
		});

		// 保存ボタン
		$themeOptionsForm.on('click', '.ajax_button', function() {
			var $buttons = $themeOptionsForm.find('.button-ml');

			// タブAJAX保存中の場合は終了
			if (tabAjaxSaving) return false;

			$('#saveMessage').hide();
			$('#saving_data').show();

			// tinymceを利用しているフィールドのデータを保存
			if (window.tinyMCE) {
				tinyMCE.triggerSave();
			}

			// フォームデータ
			var fd = new FormData();

			// オプション保存用項目
			$themeOptionsForm.find('> input[type="hidden"]').each(function(){
				fd.append(this.name, this.value);
			});

			// 表示中タブ
			var $currentTabPanel = $themeOptionsForm.find('.tab-content:visible');

			// 表示中タブ内フォーム項目
			$currentTabPanel.find(':input').not(':button, :submit').each(function(){
				if ($(this).is('select')) {
					fd.append(this.name, $(this).val());
				} else if ($(this).is(':radio, :checkbox')) {
					if ($(this).is(':checked')) {
						fd.append(this.name, this.value);
					}
				} else {
					fd.append(this.name, this.value);
				}
			});

			// AJAX送信
			$.ajax({
				url: $themeOptionsForm.attr('action'),
				type: 'POST',
				data: fd,
				processData: false,
				contentType: false,
				beforeSend: function() {
					// タブAJAX保存中フラグ
					tabAjaxSaving = 1;

					// ボタン無効化
					$buttons.prop('disabled', true);
				},
				complete: function() {
					// タブAJAX保存中フラグ
					tabAjaxSaving = 0;

					// ボタン有効化
					$buttons.prop('disabled', false);
				},
				success: function(data, textStatus, XMLHttpRequest) {
					$('#saving_data').hide();
					$('#saved_data').html('<div id="saveMessage" class="successModal"></div>');
					$('#saveMessage').append('<p>' + TCD_MESSAGES.ajaxSubmitSuccess + '</p>').show();
					setTimeout(function() {
						$('#saveMessage:not(:hidden, :animated)').fadeOut();
					}, 3000);

					// タブフォーム項目初期値セット
					initAjaxSaveTab($currentTabPanel, true);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					$('#saving_data').hide();
					alert(TCD_MESSAGES.ajaxSubmitError);
				}
			});

			return false;
		});

		// TCDテーマオプション管理のボタン処理
		// max_input_vars=1000だとTCDテーマオプション管理のPOST項目が読みこめずエクスポート等が出来ない対策
		$('#tab-content-tool :submit').on('click', function(){
			var $currentTabPanel = $(this).closest('.tab-content');
			var isFirst = true;
			$('.tab-content').each(function(){
				if ($(this).is($currentTabPanel)) {
					return;
				}
				if (isFirst) {
					isFirst = false;
					return;
				}
				$(this).find(':input').not(':button, :submit').addClass('js-disabled').attr('disabled', 'disabled');
			});
			setTimeout(function(){
				$('.tab-content .js-disabled').removeAttr('disabled');
			}, 1000);
		});

		// タブごとのAJAX保存 ここまで

/*
		// 全体AJAX保存
		$themeOptionsForm.on('click', '.ajax_button', function() {
			var $button = $themeOptionsForm.find('.button-ml');
			$('#saveMessage').hide();
			$('#saving_data').show();

			if (window.tinyMCE) {
				tinyMCE.triggerSave(); // tinymceを利用しているフィールドのデータを保存
			}
			$themeOptionsForm.ajaxSubmit({
				beforeSend: function() {
					$button.prop('disabled', true); // ボタンを無効化し、二重送信を防止
				},
				complete: function() {
					$button.prop('disabled', false); // ボタンを有効化し、再送信を許可
				},
				success: function(){
					$('#saving_data').hide();
					$('#saved_data').html('<div id="saveMessage" class="successModal"></div>');
					$('#saveMessage').append('<p>' + TCD_MESSAGES.ajaxSubmitSuccess + '</p>').show();
					setTimeout(function() {
						$('#saveMessage:not(:hidden, :animated)').fadeOut();
					}, 3000);
				},
				error: function() {
					$('#saving_data').hide();
					alert(TCD_MESSAGES.ajaxSubmitError);
				},
				timeout: 10000
			});
			return false;
		});
*/

		// 保存メッセージクリックで非表示
		$themeOptionsForm.on('click', '#saveMessage', function(){
			$('#saveMessage:not(:hidden, :animated)').fadeOut(300);
		});
	}

	// Modal CTAで使用している汎用処理
	if ($themeOptionsForm.length) {
		// ドロップダウン・ラジオ・チェックボックス汎用表示切替
		$themeOptionsForm.on('change', '[data-toggle]', function() {
			if ($(this).is('select')) {
				if ($(this).attr('data-hide')) {
					$($(this).attr('data-hide')).hide();
				}
				$($(this).attr('data-toggle').replace('%value%', $(this).val())).show();
			} else if ($(this).is(':radio, :checkbox')) {
				if ($(this).attr('data-hide')) {
					$($(this).attr('data-hide')).hide();
				}
				if (this.checked) {
					$($(this).attr('data-toggle')).show();
				} else {
					$($(this).attr('data-toggle')).hide();
				}
			}
		}).find('[data-toggle]').filter('select, :checked').trigger('change');

		$themeOptionsForm.on('change', '[data-toggle-reverse]', function() {
			if ($(this).is(':radio, :checkbox')) {
				if ($(this).attr('data-hide')) {
					$($(this).attr('data-hide')).hide();
				}
				if (this.checked) {
					$($(this).attr('data-toggle-reverse')).hide();
				} else {
					$($(this).attr('data-toggle-reverse')).show();
				}
			}
		}).find('[data-toggle-reverse]').filter(':checked').trigger('change');

		$themeOptionsForm.on('change', '[data-toggle-show]', function() {
			if ($(this).is(':radio, :checkbox')) {
				if (this.checked) {
					$($(this).attr('data-toggle-show')).show();
				}
			}
		}).find('[data-toggle-show]').filter(':checked').trigger('change');
	}

	// ロゴプレビュー -------------------------------------------------------------------------------------------
	var logo_preview_timer = null;
	function logo_preview() {
		var logoPreviewVars = [];

		if (logo_preview_timer) {
			clearInterval(logo_preview_timer);
		}

		if (!$('[data-logo-width-input]').length) return;

		// initialize
		$('[data-logo-width-input]').each(function(i){
			logoPreviewVars[i] = {};
			var lpObj = logoPreviewVars[i];
			lpObj.$preview = $(this);
			lpObj.$logo = $('<div class="slider_logo_preview-logo">');
			lpObj.$logoWidth = $($(this).attr('data-logo-width-input'));
			lpObj.$logoImg = $($(this).attr('data-logo-img'));
			lpObj.logoImg = new Image();
			lpObj.logoImgSrc = null;
			lpObj.logoImgSrcFirst = null;
			lpObj.$bgImg = null;
			lpObj.bgImgSrc = null;
			lpObj.$Overlay = $('<div class="slider_logo_preview-overlay"></div>');
			lpObj.$displayOverlay = $($(this).attr('data-display-overlay'));
			lpObj.$overlayColor = $($(this).attr('data-overlay-color'));
			lpObj.$overlayOpacity = $($(this).attr('data-overlay-opacity'));

			lpObj.$catchBg = $('<div class="catch_background"></div>');
			lpObj.$displayCatchBg = $($(this).attr('data-display-catch-bg'));
			lpObj.$catchBgColor = $($(this).attr('data-catch-bg-color'));
			lpObj.$catchBgOpacity = $($(this).attr('data-catch-bg-opacity'));

			lpObj.$preview.html('').append(lpObj.$logo).append(lpObj.$Overlay).append(lpObj.$catchBg);
			lpObj.$preview.closest('.slider_logo_preview-wrapper').hide();

			if (lpObj.$logoImg && lpObj.$logoImg.length) {
				lpObj.logoImgSrcFirst = lpObj.$logoImg.attr('src'); 
			}

			// logo dubble click to width reset
			lpObj.$logo.on('dblclick', function(){
				lpObj.$logoWidth.val(0);
				lpObj.$logo.width(lpObj.$logo.attr('data-origin-width'));
			});
		});

		// logo, bg change
		var logoPreviewChange = function(){
			for(var i = 0; i < logoPreviewVars.length; i++) {
				var lpObj = logoPreviewVars[i];
				var isChange = false;

				lpObj.$logoImg = $(lpObj.$preview.attr('data-logo-img'));
				lpObj.$bgImg = null;

				// data-bg-imgはカンマ区切りでの複数連動対応しているため順番に探す
				if (lpObj.$preview.attr('data-bg-img')) {
					var bgImgClasses = lpObj.$preview.attr('data-bg-img').split(',');
					$.each(bgImgClasses, function(i,v){
						if (!v) return;
						if (!lpObj.$bgImg && $(v).length) {
							lpObj.$bgImg = $(v);
						}
					});
				}

				// logo
				if (lpObj.$logoImg.length) {
					// 画像変更あり、lpObj.logoImg.srcにセットして読み込みを待つ
					if (lpObj.logoImg.src !== lpObj.$logoImg.attr('src')) {
						lpObj.logoImg.src = lpObj.$logoImg.attr('src');
					}
					// 変更後画像読み込み完了
					if (lpObj.logoImg.src !== lpObj.logoImgSrc && lpObj.logoImg.width > 0) {
							isChange = true;
							lpObj.logoImgSrc = lpObj.$logoImg.attr('src'); 

							if (lpObj.$logo.hasClass('ui-resizable')) {
								lpObj.$logo.resizable('destroy');
							}
							lpObj.$logo.find('img').remove();
							lpObj.$logo.html('<img src="' + lpObj.logoImgSrc + '" alt="" />').attr('data-origin-width', lpObj.logoImg.width).append('<div class="slider_logo_preview-logo-border-e"></div><div class="slider_logo_preview-logo-border-n"></div><div class="slider_logo_preview-logo-border-s"></div><div class="slider_logo_preview-logo-border-w"></div></div>');

							// 初回は既存値
							if (lpObj.logoImgSrcFirst) {
								var logoWidth = parseInt(lpObj.$logoWidth.val(), 10);

								lpObj.logoImgSrcFirst = null;
								if (logoWidth > 0) {
									lpObj.$logo.width(logoWidth);
								} else {
									lpObj.$logo.width(lpObj.logoImg.width);
								}

							// 画像変更時はロゴ横幅リセット
							} else {
								lpObj.$logoWidth.val(0);
								lpObj.$logo.width(lpObj.logoImg.width);
							}

							// logo resizable
							lpObj.$logo.resizable({
								aspectRatio: true,
								distance: 5,
								handles: 'all',
								maxWidth: 1180,
								stop: function(event, ui) {
									// lpObj,iは変わっているため使えない
									$($(this).closest('[data-logo-width-input]').attr('data-logo-width-input')).val(parseInt(ui.size.width, 10));
								}
							});
					}
				} else if (lpObj.bgImgSrc) {
					lpObj.logoImg = new Image();
					lpObj.logoImgSrc = null; 
					lpObj.$logo.html('');
					isChange = true;
				}

				// bg
				if (lpObj.$bgImg && lpObj.$bgImg.length) {
					if (lpObj.bgImgSrc !== lpObj.$bgImg.attr('src')) {
						lpObj.bgImgSrc = lpObj.$bgImg.attr('src'); 
						isChange = true;
					}
				} else if (lpObj.bgImgSrc) {
					lpObj.bgImgSrc = null; 
					isChange = true;
				}

				// overlay
				lpObj.$Overlay.removeAttr('style');
				if (lpObj.$displayOverlay.is(':checked')) {
					var overlayColor = lpObj.$overlayColor.val() || '';
					var overlayOpacity = parseFloat(lpObj.$overlayOpacity.val() || 0);
					if (overlayColor && overlayOpacity > 0) {
						var rgba = [];
						overlayColor = overlayColor.replace('#', '');
						if (overlayColor.length >= 6) {
							rgba.push(parseInt(overlayColor.substring(0,2), 16));
							rgba.push(parseInt(overlayColor.substring(2,4), 16));
							rgba.push(parseInt(overlayColor.substring(4,6), 16));
							rgba.push(overlayOpacity);
							lpObj.$Overlay.css('background-color', 'rgba(' + rgba.join(',') + ')');
						} else if (overlayColor.length >= 3) {
							rgba.push(parseInt(overlayColor.substring(0,1) + overlayColor.substring(0,1), 16));
							rgba.push(parseInt(overlayColor.substring(1,2) + overlayColor.substring(1,2), 16));
							rgba.push(parseInt(overlayColor.substring(2,3) + overlayColor.substring(2,3), 16));
							rgba.push(overlayOpacity);
							lpObj.$Overlay.css('background-color', 'rgba(' + rgba.join(',') + ')');
						}
					}
				}

				// catch background
				lpObj.$catchBg.removeAttr('style');
				if (lpObj.$displayCatchBg.is(':checked')) {
					var catchBgColor = lpObj.$catchBgColor.val() || '';
					var catchBgOpacity = parseFloat(lpObj.$catchBgOpacity.val() || 0);
					if (catchBgColor && catchBgOpacity > 0) {
						var rgba = [];
						catchBgColor = catchBgColor.replace('#', '');
						if (catchBgColor.length >= 6) {
							rgba.push(parseInt(catchBgColor.substring(0,2), 16));
							rgba.push(parseInt(catchBgColor.substring(2,4), 16));
							rgba.push(parseInt(catchBgColor.substring(4,6), 16));
							rgba.push(catchBgOpacity);
							lpObj.$catchBg.css('background-color', 'rgba(' + rgba.join(',') + ')');
						} else if (catchBgColor.length >= 3) {
							rgba.push(parseInt(catchBgColor.substring(0,1) + catchBgColor.substring(0,1), 16));
							rgba.push(parseInt(catchBgColor.substring(1,2) + catchBgColor.substring(1,2), 16));
							rgba.push(parseInt(catchBgColor.substring(2,3) + catchBgColor.substring(2,3), 16));
							rgba.push(catchBgOpacity);
							lpObj.$catchBg.css('background-color', 'rgba(' + rgba.join(',') + ')');
						}
					}
				}

				// 画像変更有
				if (isChange) {
					// 動画・Youtubeはダミー画像なので背景セットなし
					if (lpObj.$preview.hasClass('header_video_logo_preview')) {
						if (lpObj.logoImgSrc) {
							lpObj.$preview.closest('.slider_logo_preview-wrapper').show();
						} else {
							lpObj.$preview.closest('.slider_logo_preview-wrapper').hide();
						}
					} else {
						if (lpObj.logoImgSrc && lpObj.bgImgSrc) {
							lpObj.$preview.css('backgroundImage', 'url(' + lpObj.bgImgSrc + ')');
							lpObj.$preview.closest('.slider_logo_preview-wrapper').show();

						} else {
							lpObj.$preview.closest('.slider_logo_preview-wrapper').hide();
						}
					}
				}
			}
		};

		// 画像読み込み完了を待つ必要があるためSetInterval
		logo_preview_timer = setInterval(logoPreviewChange, 300);

		// 画像削除ボタンは即時反映可能
		$('.cfmf-delete-img').on('click.logoPreviewChange', function(){
			setTimeout(logoPreviewChange, 30);
		});
	}
	logo_preview();
	// ロゴプレビューここまで -------------------------------------------------------------------------------------------

	// ユーザープロフィール 画像削除
	$('.user_profile_image_url_field .delete-button').on('click', function() {
		if ($(this).attr('data-meta-key')) {
			var $cl = $(this).closest('.user_profile_image_url_field');
			$cl.append('<input type="hidden" name="delete-image-'+$(this).attr('data-meta-key')+'" value="1">');
			$(this).addClass('hidden');
			$cl.find('.preview_field').remove();
		}
	});

	// レビュー
	if ($('.cb_content_wrap.review').length) {
		// datepicker
		$('.cb_content_wrap.review .item_list_date').datepicker({dateFormat: 'yy-mm-dd'});

		// リピーター追加後対応 コンテンツビルダーjs処理の関係でfocusを利用
		$(document).on('focus', '.cb_content_wrap.review .item_list_date:not(.hasDatepicker)', function(){
			$(this).datepicker({dateFormat: 'yy-mm-dd'});
		});

		// レビュー投票を使用するチェックボックス
		$(document).on('change', '.cb_content_wrap.review .checkbox-use_review_vote', function(){
			if (this.checked) {
			  $(this).closest('.cb_content_wrap.review').find('.review_vote').show();
			} else {
			  $(this).closest('.cb_content_wrap.review').find('.review_vote').hide();
			}
		});
		$('.cb_content_wrap.review .checkbox-use_review_vote:checked').trigger('change');
	}

});


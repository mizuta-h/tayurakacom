jQuery(document).ready(function($){

  // フッターバナー
  $('.footer_banner_checkbox:checkbox').change(function() {
    var count_checkbox = $('.footer_banner_checkbox:checkbox:checked').length;
    if(count_checkbox == 1){
      $('.footer_banner_size1').show();
      $('.footer_banner_size2').hide();
      $('.footer_banner_size3').hide();
    } else if(count_checkbox == 2){
      $('.footer_banner_size1').hide();
      $('.footer_banner_size2').show();
      $('.footer_banner_size3').hide();
    } else {
      $('.footer_banner_size1').hide();
      $('.footer_banner_size2').hide();
      $('.footer_banner_size3').show();
    }
  }).trigger('change');


	// CTA
	var ctaType = $('.cta-type');
	var ctaContent = $('.cta-content');
	ctaType.click(function() {
		var parent = $(this).parents('.sub_box');
		parent.find('.cta-content').hide();
		parent.find('.cta-' + $(this).val() + '-content').show();
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


  // サイドメニューのタイプ（CODE）
  $(document).on('click', '#side_menu_type1_button', function(event){
    $('.side_menu_type1_option').show();
    $('.side_menu_type2_option').hide();
  });
  $(document).on('click', '#side_menu_type2_button', function(event){
    $('.side_menu_type1_option').hide();
    $('.side_menu_type2_option').show();
  });
  if ($("#side_menu_type1").is(":checked")) {
    $('.side_menu_type1_option').show();
    $('.side_menu_type2_option').hide();
  }
  if ($("#side_menu_type2").is(":checked")) {
    $('.side_menu_type1_option').hide();
    $('.side_menu_type2_option').show();
  }


  // 投稿者一覧の並び替え（CODE）
  $('#author_list_order').sortable({
    placeholder: 'sortable-placeholder'
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


  // クイックタグのボタン
  $(document).on('click', '.qtag_button_hover_option .button_hover_type1', function(event){
    $(this).closest('.sub_box_content').find('.hide_bg_color').show();
    $(this).closest('.sub_box_content').find('.hide_for_button_type4').show();
    $(this).closest('.sub_box_content').find('.show_for_button_type4').hide();
  });
  $(document).on('click', '.qtag_button_hover_option .button_hover_type2, .qtag_button_hover_option .button_hover_type3', function(event){
    $(this).closest('.sub_box_content').find('.hide_bg_color').hide();
    $(this).closest('.sub_box_content').find('.hide_for_button_type4').show();
    $(this).closest('.sub_box_content').find('.show_for_button_type4').hide();
  });
  $(document).on('click', '.qtag_button_hover_option .button_hover_type4', function(event){
    $(this).closest('.sub_box_content').find('.hide_bg_color').hide();
    $(this).closest('.sub_box_content').find('.hide_for_button_type4').hide();
    $(this).closest('.sub_box_content').find('.show_for_button_type4').show();
  });
  $('.qtag_button_hover_option .button_hover_type1').each(function(){
    if( $(this).hasClass('active') ){
      $(this).closest('.sub_box_content').find('.hide_bg_color').show();
      $(this).closest('.sub_box_content').find('.hide_for_button_type4').show();
      $(this).closest('.sub_box_content').find('.show_for_button_type4').hide();
    }
  });
  $('.qtag_button_hover_option .button_hover_type2, .qtag_button_hover_option .button_hover_type3').each(function(){
    if( $(this).hasClass('active') ){
      $(this).closest('.sub_box_content').find('.hide_bg_color').hide();
      $(this).closest('.sub_box_content').find('.hide_for_button_type4').show();
      $(this).closest('.sub_box_content').find('.show_for_button_type4').hide();
    }
  });
  $('.qtag_button_hover_option .button_hover_type4').each(function(){
    if( $(this).hasClass('active') ){
      $(this).closest('.sub_box_content').find('.hide_bg_color').hide();
      $(this).closest('.sub_box_content').find('.hide_for_button_type4').hide();
      $(this).closest('.sub_box_content').find('.show_for_button_type4').show();
    }
  });


  // color picker
  $('.c-color-picker').wpColorPicker();


  // lightcase (lightbox)
  $('a[data-rel^=lightcase]').lightcase();


  // チェックボックスによって入力欄を表示/非表示にする
  // <input class="display_option" data-option-name="show_new_icon" type="checkbox" />
  // <div class="show_new_icon">
  $(document).on('click', '.display_option:checkbox', function(event){
    var option_name = $(this).attr('data-option-name');
    if ($(this).is(":checked")) {
      $('.' + option_name).show();
    } else {
      $('.' + option_name).hide();
    }
  });
  $('.display_option:checkbox').each(function(){
    var option_name = $(this).attr('data-option-name');
    if ($(this).is(":checked")) {
      $('.' + option_name).show();
    } else {
      $('.' + option_name).hide();
    }
  });


  // トップページ　コンテンツビルダーのタイプ
  $(document).on('click', '.index_content_type1_button', function(event){
    $('.index_content_type1_option').show();
    $('.index_content_type2_option').hide();
    $(this).closest('.theme_option_field').addClass('show_arrow');
  });
  $(document).on('click', '.index_content_type2_button', function(event){
    $('.index_content_type1_option').hide();
    $('.index_content_type2_option').show();
    $(this).closest('.theme_option_field').removeClass('show_arrow');
  });
  $(document).on('click', '.mobile_index_content_type1_button', function(event){
    $('.mobile_index_content_type1_option').show();
    $('.mobile_index_content_type2_option').hide();
    $('.mobile_index_content_type3_option').hide();
    $(this).closest('.theme_option_field').removeClass('show_arrow');
  });
  $(document).on('click', '.mobile_index_content_type2_button', function(event){
    $('.mobile_index_content_type1_option').hide();
    $('.mobile_index_content_type2_option').show();
    $('.mobile_index_content_type3_option').hide();
    $(this).closest('.theme_option_field').addClass('show_arrow');
  });
  $(document).on('click', '.mobile_index_content_type3_button', function(event){
    $('.mobile_index_content_type1_option').hide();
    $('.mobile_index_content_type2_option').hide();
    $('.mobile_index_content_type3_option').show();
    $(this).closest('.theme_option_field').removeClass('show_arrow');
  });


  // トップページ　スマホ用スライダー
  $(document).on('click', '#mobile_show_index_slider_type2_button', function(event){
    $('#index_slider_input_area').show();
  });
  $(document).on('click', '#mobile_show_index_slider_type1_button, #mobile_show_index_slider_type3_button', function(event){
    $('#index_slider_input_area').hide();
  });


  // トップページ　ヘッダースライダーのタイプ
  $(document).on('click', '.index_slider_type1', function(event){
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type1_area').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_area').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_area').hide();
  });
  $(document).on('click', '.index_slider_type2', function(event){
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type1_area').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_area').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_area').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_option').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_option').hide();
  });
  $(document).on('click', '.index_slider_type3', function(event){
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type1_area').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_area').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_area').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_option').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_option').show();
  });

  // トップページ　ヘッダースライダー　アイテムのタイプ
  $(document).on('click', '.index_slider_item_type1', function(event){
    $(this).closest('.repeater-item').find('.index_slider_image_area').show();
    $(this).closest('.repeater-item').find('.index_slider_video_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_youtube_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_video_image').hide();
    $(this).closest('.repeater-item').find('.index_slider_post_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_non_post_area').show();
    $(this).closest('.repeater-item').find('.index_slider_background_area').show();
    $(this).closest('.repeater-item').find('.index_slider_bg_image_animation_area').show();
  });
  $(document).on('click', '.index_slider_item_type2', function(event){
    $(this).closest('.repeater-item').find('.index_slider_image_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_video_area').show();
    $(this).closest('.repeater-item').find('.index_slider_youtube_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_video_image').show();
    $(this).closest('.repeater-item').find('.index_slider_post_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_non_post_area').show();
    $(this).closest('.repeater-item').find('.index_slider_background_area').show();
    $(this).closest('.repeater-item').find('.index_slider_bg_image_animation_area').hide();
  });
  $(document).on('click', '.index_slider_item_type3', function(event){
    $(this).closest('.repeater-item').find('.index_slider_image_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_video_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_youtube_area').show();
    $(this).closest('.repeater-item').find('.index_slider_video_image').show();
    $(this).closest('.repeater-item').find('.index_slider_post_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_non_post_area').show();
    $(this).closest('.repeater-item').find('.index_slider_background_area').show();
    $(this).closest('.repeater-item').find('.index_slider_bg_image_animation_area').hide();
  });
  $(document).on('click', '.index_slider_item_type4', function(event){
    $(this).closest('.repeater-item').find('.index_slider_image_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_video_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_youtube_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_video_image').hide();
    $(this).closest('.repeater-item').find('.index_slider_post_area').show();
    $(this).closest('.repeater-item').find('.index_slider_non_post_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_background_area').hide();
    $(this).closest('.repeater-item').find('.index_slider_bg_image_animation_area').hide();
  });


  // トップページ　固定ページコンテンツの横幅
  $(document).on('click', '#page_content_width_type1', function(event){
    $('.page_content_width_type1_option').show();
  });
  $(document).on('click', '#page_content_width_type2', function(event){
    $('.page_content_width_type1_option').hide();
  });


  // パララックス効果有効時に推奨画像サイズを変更
  $(document).on('click', '.use_para_checkbox:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).closest('.cb_content').find('.yes_para').show();
      $(this).closest('.cb_content').find('.no_para').hide();
    } else {
      $(this).closest('.cb_content').find('.yes_para').hide();
      $(this).closest('.cb_content').find('.no_para').show();
    }
  });
  $('.use_para_checkbox:checkbox').each(function(){
    if ($(this).is(":checked")) {
      $(this).closest('.cb_content').find('.yes_para').show();
      $(this).closest('.cb_content').find('.no_para').hide();
    } else {
      $(this).closest('.cb_content').find('.yes_para').hide();
      $(this).closest('.cb_content').find('.no_para').show();
    }
  });


  // 固定ページテンプレートで表示メタボックス切替
  function show_author_meta_box() {
    $('.font_size_setting_option1').hide();
    $('.font_size_setting_option2').show();
    $('#index-tcd_meta_box-hide').attr('checked', 'checked');
    $('#index-tcd_meta_box').show().removeClass('closed');
    $('#author_list_meta_box').show();
    $('#ranking_list_meta_box').hide();
    $('#lp_meta_box').hide();
    $('#page_cf_basic_settings').show();
    $('.change_page_content_width').hide();
    $('#post-body-content #postdivrich').hide();
    $('.block-editor-block-list__layout').hide();
    $('.edit-post-visual-editor .block-editor-block-list__layout').hide();
    $('#page_header_meta_box').show();
    $('.eyecatch_notice1').show();
    $('.eyecatch_notice2').hide();
    $('.change_content_width').hide();
    $('#hide_other-setting').hide();
    page_header_setting_area_check($('#hide_page_header input:checkbox').is(":checked"))
    page_width_setting_area_check('hide_area')
  }
  function show_ranking_meta_box() {
    $('.font_size_setting_option1').hide();
    $('.font_size_setting_option2').show();
    $('#index-tcd_meta_box-hide').attr('checked', 'checked');
    $('#index-tcd_meta_box').show().removeClass('closed');
    $('#ranking_list_meta_box').show();
    $('#author_list_meta_box').hide();
    $('#lp_meta_box').hide();
    $('#page_cf_basic_settings').show();
    $('.change_page_content_width').hide();
    $('#post-body-content #postdivrich').hide();
    $('.block-editor-block-list__layout').hide();
    $('.edit-post-visual-editor .block-editor-block-list__layout').hide();
    $('#page_header_meta_box').show();
    $('.eyecatch_notice1').show();
    $('.eyecatch_notice2').hide();
    $('#hide_other-setting').hide();
    $('.change_content_width').hide();
    page_header_setting_area_check($('#hide_page_header input:checkbox').is(":checked"))
    page_width_setting_area_check('hide_area')
  }
  function show_lp_meta_box() {
    $('.font_size_setting_option1').show();
    $('.font_size_setting_option2').hide();
    $('#index-tcd_meta_box-hide').attr('checked', 'checked');
    $('#index-tcd_meta_box').show().removeClass('closed');
    $('#lp_meta_box').show();
    $('#page_cf_basic_settings').show();
    $('#author_list_meta_box').hide();
    $('#ranking_list_meta_box').hide();
    $('.change_page_content_width').show();
    $('#post-body-content #postdivrich').hide();
    $('.block-editor-block-list__layout').hide();
    $('.edit-post-visual-editor .block-editor-block-list__layout').hide();
    $('#page_header_meta_box').show();
    $('.eyecatch_notice1').show();
    $('.eyecatch_notice2').hide();
    $('#hide_other-setting').show();
    page_width_setting_area_check($('#hide_content_width input:checkbox').is(":checked"))
    page_header_setting_area_check($('#hide_page_header input:checkbox').is(":checked"))
  }
  function show_2columns_template() {
    $('.font_size_setting_option1').show();
    $('.font_size_setting_option2').hide();
    $('#index-tcd_meta_box-hide').removeAttr('checked');
    $('#index-tcd_meta_box').hide();
    $('#lp_meta_box').hide();
    $('#page_cf_basic_settings').show();
    $('#author_list_meta_box').hide();
    $('#ranking_list_meta_box').hide();
    $('.change_page_content_width').show();
    $('#post-body-content #postdivrich').show();
    $('.block-editor-block-list__layout').show();
    $('.edit-post-visual-editor .block-editor-block-list__layout').show();
    $('#page_header_meta_box').show();
    $('.eyecatch_notice1').hide();
    $('.eyecatch_notice2').show();
    $('#hide_other-setting').hide();
    page_width_setting_area_check('hide_area')
    page_header_setting_area_check('hide_area')
  }
  function normal_template() {
    $('.font_size_setting_option1').show();
    $('.font_size_setting_option2').hide();
    $('#index-tcd_meta_box-hide').removeAttr('checked');
    $('#index-tcd_meta_box').hide();
    $('#lp_meta_box').hide();
    $('#page_cf_basic_settings').show();
    $('#author_list_meta_box').hide();
    $('#ranking_list_meta_box').hide();
    $('.change_page_content_width').show();
    $('#post-body-content #postdivrich').show();
    $('.block-editor-block-list__layout').show();
    $('.edit-post-visual-editor .block-editor-block-list__layout').show();
    $('#page_header_meta_box').show();
    $('.eyecatch_notice1').show();
    $('.eyecatch_notice2').hide();
    $('.change_content_header').show();
    $('#hide_other-setting').show();
    page_header_setting_area_check($('#hide_page_header input:checkbox').is(":checked"))
    page_width_setting_area_check($('#hide_content_width input:checkbox').is(":checked"))
  }
  
    /** 横幅設定の表示非表示 **/
    function page_width_setting_area_check($val){
      $('#hide_content_width').show();
      if ($val) {
        $('#page_width_setting_area').show();
      } else {
        $('#page_width_setting_area').hide();
      }
      if($val === 'hide_area' ){
        $('#hide_content_width').hide()
        $('#page_width_setting_area').hide();
      }
    }
  
  /** ヘッダーの設定の表示非表示 **/
  function page_header_setting_area_check($val){
    $('#hide_page_header').show();
    if ($val) {
      $('#page_header_setting_area').hide();
    } else {
      $('#page_header_setting_area').show();
    }
    if($val === 'hide_area' ){
      $('#hide_page_header').hide();
    }
  }
  
  $('select#hidden_page_template').change(function(){ //ブロックエディタ対策
    if ( $(this).val() == 'page-lp.php' ) {
      show_lp_meta_box();
    } else if ( $(this).val() == 'page-author-list.php' ) {
      show_author_meta_box();
    } else if ( $(this).val() == 'page-ranking-list.php' ) {
      show_ranking_meta_box();
    } else if ( $(this).val() == 'page-2columns.php' ) {
      show_2columns_template();
    } else {
      normal_template();
    }
  }).trigger('change');
  
  $(document).on('change', 'select#page_template, .editor-page-attributes__template select', function(){
    if ( $(this).val() == 'page-lp.php' ) {
      show_lp_meta_box();
    } else if ( $(this).val() == 'page-author-list.php' ) {
      show_author_meta_box();
    } else if ( $(this).val() == 'page-ranking-list.php' ) {
      show_ranking_meta_box();
    } else if ( $(this).val() == 'page-2columns.php' ) {
      show_2columns_template();
    } else {
      normal_template();
    }
  }).trigger('change');
  
  
  /** 横幅設定の表示非表示 **/
  $(document).on('click', '#hide_content_width input:checkbox', function(event){
    page_width_setting_area_check($(this).is(":checked"))
  });

  /** ヘッダーの設定の表示非表示切り替え **/
  $(document).on('click', '#hide_page_header input:checkbox', function(event){
    page_header_setting_area_check($(this).is(":checked"))
  });
    
  // ブロックエディタ用
  if(wp.data !== undefined ){
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
        // console.log(this.template);
        if ( this.template == 'page-lp.php' ) {
          show_lp_meta_box();
        } else if ( this.template == 'page-author-list.php' ) {
          show_author_meta_box();
        } else if ( this.template == 'page-ranking-list.php' ) {
          show_ranking_meta_box();
        } else if ( this.template == 'page-2columns.php' ) {
          show_2columns_template();
        } else {
          normal_template();
        }
      }
    }
    new PageTemplateSwitcher().init();
  }

  // トップページのスライダー　アニメーションが無効な場合はスライダーの時間を変更
  $(document).on('click', '.stop_index_slider_animation:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).closest('.theme_option_field').find('.index_slider_time .no_animation').show();
      $(this).closest('.theme_option_field').find(".index_slider_time option[value='5000']").prop('selected', true);
    } else {
      $(this).closest('.theme_option_field').find('.index_slider_time .no_animation').hide();
      $(this).closest('.theme_option_field').find(".index_slider_time option[value='5000']").prop('selected', true);
    }
  });
  $('.stop_index_slider_animation:checkbox').each(function(){
    if ($(this).is(":checked")) {
      $(this).closest('.theme_option_field').find('.index_slider_time .no_animation').show();
    } else {
      $(this).closest('.theme_option_field').find('.index_slider_time .no_animation').hide();
    }
  });


  // ボタンタイプ
  $('select.button_type_option').change(function(){
    if ( $(this).val() == 'type4' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').hide();
    } else if ( $(this).val() == 'type1' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type1_option').show();
      $(this).closest('.button_option_area').find('.button_type2_option').hide();
    } else {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type1_option').hide();
      $(this).closest('.button_option_area').find('.button_type2_option').show();
    }
  });
  $('select.button_type_option').each(function(){
    if ( $(this).val() == 'type4' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').hide();
    } else if ( $(this).val() == 'type1' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type1_option').show();
      $(this).closest('.button_option_area').find('.button_type2_option').hide();
    } else {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type1_option').hide();
      $(this).closest('.button_option_area').find('.button_type2_option').show();
    }
  });


  // メインカラーを適用する
  $(document).on('click', '.use_main_color_checkbox input:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).closest('li').find('.use_main_color').hide();
    } else {
      $(this).closest('li').find('.use_main_color').show();
    }
  });
  $('.use_main_color_checkbox input:checkbox').each(function(){
    if ($(this).is(":checked")) {
      $(this).closest('li').find('.use_main_color').hide();
    } else {
      $(this).closest('li').find('.use_main_color').show();
    }
  });


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



  // 固定ページ　ヘッダーのタイプ
  if ($('#page_header_type1_button input[name=page_header_type]:checked').val() === 'type1') {
    $('.page_header_type1_option').show();
    $('.page_header_type2_option').hide();
  } else if ($('#page_header_type2_button input[name=page_header_type]:checked').val() === 'type2') {
    $('.page_header_type1_option').hide();
    $('.page_header_type2_option').show();
    $('#page_header_height2_button input[value="type2"]').prop('checked', true);
    $('.page_header_height1_option').hide();
  }
  $(document).on('click', '#page_header_type1_button', function(event){
    $('.page_header_type1_option').show();
    $('.page_header_type2_option').hide();
  });
  $(document).on('click', '#page_header_type2_button', function(event){
    $('.page_header_type1_option').hide();
    $('.page_header_type2_option').show();
    $('#page_header_height2_button input[value="type2"]').prop('checked', true);
    $('.page_header_height1_option').hide();
  });


  // 固定ページ　ヘッダーの高さ
  if ($('#page_header_height1_button input[name=page_header_height]:checked').val() === 'type1') {
    $('.page_header_height1_option').show();
    $('.page_header_height2_option').hide();
  } else if ($('#page_header_height2_button input[name=page_header_height]:checked').val() === 'type2') {
    $('.page_header_height1_option').hide();
    $('.page_header_height2_option').show();
  }
  $(document).on('click', '#page_header_height1_button', function(event){
    $('.page_header_height1_option').show();
    $('.page_header_height2_option').hide();
  });
  $(document).on('click', '#page_header_height2_button', function(event){
    $('.page_header_height1_option').hide();
    $('.page_header_height2_option').show();
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


  // フッターコンテンツタイプの設定
  $(document).on('click', '#footer_content_type_type1_button', function(event){
    $('#footer_button_area').show();
    $('#footer_bar_area').hide();
  });
  $(document).on('click', '#footer_content_type_type2_button', function(event){
    $('#footer_button_area').hide();
    $('#footer_bar_area').show();
  });


  // ロード画面の設定
  $(document).on('click', '#show_load_screen_type1_button', function(event){
    $('#load_screen_options').hide();
  });
  $(document).on('click', '#show_load_screen_type2_button', function(event){
    $('#load_screen_options').show();
    $('#after_loading_effect_option').show();
  });
  $(document).on('click', '#show_load_screen_type3_button', function(event){
    $('#load_screen_options').show();
    $('#after_loading_effect_option').hide();
  });


  // 基本設定のロードタイプ
  $('select#load_icon_type').change(function(){
    if ( $(this).val() == 'type5' ) {
      $('#load_icon_type5').show();
      $('#load_icon_type4').hide();
      $('#load_message_option').show();
      $('#load_icon_color1').hide();
    } else if ( $(this).val() == 'type4' ) {
      $('#load_icon_type4').show();
      $('#load_icon_type5').hide();
      $('#load_message_option').show();
      $('#load_icon_color1').hide();
    } else {
      $('#load_icon_type4').hide();
      $('#load_icon_type5').hide();
      $('#load_message_option').hide();
      $('#load_icon_color1').show();
    }
  }).trigger('change');


  // チェックボックスにチェックをして、ボックスを表示・非表示する（オーバーレイなどに使用）
  $(document).on('click', '.displayment_checkbox input:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).parents('.displayment_checkbox').next().show();
    } else {
      $(this).parents('.displayment_checkbox').next().hide();
    }
  });
  $(document).on('click', '.displayment_checkbox2 input:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).parents('.displayment_checkbox2').next().hide();
    } else {
      $(this).parents('.displayment_checkbox2').next().show();
    }
  });
  // チェックボックスにチェックをして、ボックスを表示・非表示する（オーバーレイなどに使用）・・・カスタムフィールド用
  $(document).on('click', '.displayment_checkbox_cf input:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).parents('.displayment_checkbox_cf').parent().next().show();
    } else {
      $(this).parents('.displayment_checkbox_cf').parent().next().hide();
    }
  });


  // Googleマップ
  $(document).on('click', '.gmap_marker_type_button_type1', function(event){
    $(this).parent().next().hide();
  });
  $(document).on('click', '.gmap_marker_type_button_type2', function(event){
    $(this).parent().next().show();
  });
  $(document).on('click', '.gmap_custom_marker_type_button_type1', function(event){
   $(this).closest('.gmap_marker_type2_area').find('.gmap_custom_marker_type1_area').show();
   $(this).closest('.gmap_marker_type2_area').find('.gmap_custom_marker_type2_area').hide();
  });
  $(document).on('click', '.gmap_custom_marker_type_button_type2', function(event){
   $(this).closest('.gmap_marker_type2_area').find('.gmap_custom_marker_type1_area').hide();
   $(this).closest('.gmap_marker_type2_area').find('.gmap_custom_marker_type2_area').show();
  });


  // フッターの固定コンテンツ
  $(".fixed_footer_content_type_type1").click(function () {
   $(this).closest('.sub_box_content').find('.fixed_footer_content_type1').show();
   $(this).closest('.sub_box_content').find('.fixed_footer_content_type2').hide();
  });
  $(".fixed_footer_content_type_type2").click(function () {
   $(this).closest('.sub_box_content').find('.fixed_footer_content_type2').show();
   $(this).closest('.sub_box_content').find('.fixed_footer_content_type1').hide();
  });

  $(".fixed_footer_sub_content_type_type1").click(function () {
   $(this).closest('.fixed_footer_content_type1').find('.fixed_footer_sub_content_type1').show();
   $(this).closest('.fixed_footer_content_type1').find('.fixed_footer_sub_content_type2').hide();
  });
  $(".fixed_footer_sub_content_type_type2").click(function () {
   $(this).closest('.fixed_footer_content_type1').find('.fixed_footer_sub_content_type2').show();
   $(this).closest('.fixed_footer_content_type1').find('.fixed_footer_sub_content_type1').hide();
  });
  $("#show_fixed_footer_content input:checkbox").click(function(event) {
   if ($(this).is(":checked")) {
    $('#footer_bar_setting_area').hide();
   } else {
    $('#footer_bar_setting_area').show();
   }
  });


  // ロゴに画像を使うかテキストを使うか選択
  $(".select_logo_type .logo_type_option_type1").click(function () {
    $(this).closest('.theme_option_field_ac_content').find(".logo_text_area").show();
    $(this).closest('.theme_option_field_ac_content').find(".logo_image_area").hide();
  });
  $(".select_logo_type .logo_type_option_type2").click(function () {
    $(this).closest('.theme_option_field_ac_content').find(".logo_text_area").hide();
    $(this).closest('.theme_option_field_ac_content').find(".logo_image_area").show();
  });


  // Hoverアニメーション
  $(document).on('click', '#hover_type_type1', function(event){
    $('#hover_type1_area').show();
    $('#hover_type2_area, #hover_type3_area, #hover_type4_area').hide();
  });
  $(document).on('click', '#hover_type_type2', function(event){
    $('#hover_type2_area').show();
    $('#hover_type1_area, #hover_type3_area, #hover_type4_area').hide();
  });
  $(document).on('click', '#hover_type_type3', function(event){
    $('#hover_type3_area').show();
    $('#hover_type1_area, #hover_type2_area, #hover_type4_area').hide();
  });
  $(document).on('click', '#hover_type_type4', function(event){
    $('#hover_type4_area').show();
    $('#hover_type1_area, #hover_type2_area, #hover_type3_area').hide();
  });
  $(document).on('click', '#hover_type_type5', function(event){
    $('#hover_type1_area, #hover_type2_area, #hover_type3_area, #hover_type4_area').hide();
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


  // radio button for page custom fields
   $("#map_type_type2").click(function () {
     $(".google_map_code_area").hide();
     $(".google_map_code_area2").show();
   });

   $("#map_type_type1").click(function () {
     $(".google_map_code_area").show();
     $(".google_map_code_area2").hide();
   });


  // サブボックス内のタブ
  $(document).on('click', '.sub_box_tab .tab', function(event){
    var tab_name = $(this).attr('data-tab');
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
    $(this).closest('.tab_parent').find('.sub_box_tab_content').each( function() {
      $(this).removeClass('active');
    });
    $(this).closest('.tab_parent').find('[data-tab-content="'+tab_name+'"]').each( function() {
      $(this).addClass('active');
    });
//    $(this).closest('.tab_parent').find('[data-tab-content="'+tab_name+'"]').addClass('active').siblings().removeClass('active');
  });
  $(document).on('change keyup', '.sub_box_tab_content .tab_label', function(){
    var tab_content_name = $(this).closest('.sub_box_tab_content').attr('data-tab-content');
    $(this).closest('.tab_parent').find('[data-tab="'+tab_content_name+'"]').text($(this).val());
  });
  $('.sub_box_tab_content .tab_label').each(function(){
    if( $(this).val() != 0 ){
      var tab_content_name = $(this).closest('.sub_box_tab_content').attr('data-tab-content');
      $(this).closest('.tab_parent').find('[data-tab="'+tab_content_name+'"]').text($(this).val());
    }
  });

  // コンテンツビルダー ----------------------------------------------------------------------------------------------------------

  // コンテンツビルダー ソータブル
  $('.contents_builder').sortable({
    handle: '.cb_move',
    stop: function (e, ui) {
      ui.item.toggleClass('active');
      if (window.tinymce) {
        ui.item.find('textarea.wp-editor-area').each(function () {
          tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
          tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
        });
      }
    }
  });

  $('.contributors_list').sortable({
    placeholder: 'sortable-placeholder'
  });

  // コンテンツビルダー クローンインデックス
  var clone_next = 1;

  // コンテンツビルダー 行追加
  $('.cb_add_row_buttton_area .add_row').click(function(){
    var clone_html = $(this).closest('.contents_builder_wrap').find('.contents_builder-clone > .cb_row').get(0).outerHTML;
    clone_html = clone_html.replace(/cb_cloneindex/g, 'add_' + clone_next + '');
    clone_next++;
    $(this).closest('.contents_builder_wrap').find('.contents_builder').append(clone_html);
  });

  // コンテンツプルダウン変更
  $('.contents_builder').on('change', '.cb_content_select', function(){
    var $cb_column = $(this).closest('.cb_column');
    var cb_index = $cb_column.find('.cb_index').val();
    $cb_column.find('.cb_content_wrap').remove('');

    if (!$(this).val() || !cb_index) return;

    var $clone = $(this).closest('.contents_builder_wrap').find('.contents_builder-clone > .' + $(this).val());
    if (!$clone.size()) return;
    $(this).hide();

    var clone_html = $clone.get(0).outerHTML;
    clone_html = clone_html.replace(/cb_cloneindex/g, cb_index);
    $cb_column.append(clone_html);
    $cb_column.find('.cb_content_wrap').addClass('open').show();

    $('.contributors_list').sortable({
      placeholder: 'sortable-placeholder'
    });

		// リッチエディターがある場合
		if ($cb_column.find('.cb_content .wp-editor-area').length) {
			// クローン元のリッチエディターをループ
			$clone.find('.cb_content .wp-editor-area').each(function(){
				// id
				var id_clone = $(this).attr('id');
				var id_new = id_clone.replace(/cb_cloneindex/g, cb_index);

				// クローン元のmceInitをコピー置換
				if (typeof tinyMCEPreInit.mceInit[id_clone] != 'undefined') {
					// オブジェクトを=で代入すると参照渡しになるため$.extendを利用
					var mce_init_new = $.extend(true, {}, tinyMCEPreInit.mceInit[id_clone]);
					mce_init_new.body_class = mce_init_new.body_class.replace(/cb_cloneindex/g, cb_index);
					mce_init_new.selector = mce_init_new.selector.replace(/cb_cloneindex/g, cb_index);
					tinyMCEPreInit.mceInit[id_new] = mce_init_new;

					// リッチエディター化
					tinymce.init(mce_init_new);
				}

				// クローン元のqtInitをコピー置換
				if (typeof tinyMCEPreInit.qtInit[id_clone] != 'undefined') {
					// オブジェクトを=で代入すると参照渡しになるため$.extendを利用
					var qt_init_new = $.extend(true, {}, tinyMCEPreInit.qtInit[id_clone]);
					qt_init_new.id = qt_init_new.id.replace(/cb_cloneindex/g, cb_index);
					tinyMCEPreInit.qtInit[id_new] = qt_init_new;

					// テキスト入力のタグボタン有効化
					quicktags(tinyMCEPreInit.qtInit[id_new]);
					try {
						if (QTags.instances['0'].theButtons) {
							QTags.instances[id_new].theButtons = QTags.instances['0'].theButtons;
						}
					} catch(err) {
					}
				}

				// ビジュアルボタンがあればビジュアル/テキストをビジュアル状態に
				if ($cb_column.find('.wp-editor-tabs .switch-tmce').length) {
					$cb_column.find('.wp-editor-wrap').removeClass('html-active').addClass('tmce-active');
				}
			});
		}

		// リピーターがある場合
		if ($cb_column.find('.cb_content .repeater-wrapper').length) {
			init_repeater($cb_column.find('.cb_content .repeater-wrapper'));
		}

    // WordPress Color Picker API
    $cb_column.find('.cb_content_wrap .c-color-picker').each(function(){
      // WordPress Color Picker 解除して再セット
      var $pickercontainer = $(this).closest('.wp-picker-container');
      var $clone = $(this).clone();
      $pickercontainer.after($clone).remove();
      $clone.wpColorPicker();
    });
    

  // ボタンタイプ
  $('select.button_type_option').change(function(){
    if ( $(this).val() == 'type4' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').hide();
    } else if ( $(this).val() == 'type1' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type2_option').hide();
    } else {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type1_option').hide();
      $(this).closest('.button_option_area').find('.button_type2_option').show();
    }
  });
  $('select.button_type_option').each(function(){
    if ( $(this).val() == 'type4' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').hide();
    } else if ( $(this).val() == 'type1' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type2_option').hide();
    } else {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type1_option').hide();
      $(this).closest('.button_option_area').find('.button_type2_option').show();
    }
  });

  // メインカラーを適用する
  $(document).on('click', '.use_main_color_checkbox input:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).closest('li').find('.use_main_color').hide();
    } else {
      $(this).closest('li').find('.use_main_color').show();
    }
  });
  $('.use_main_color_checkbox input:checkbox').each(function(){
    if ($(this).is(":checked")) {
      $(this).closest('li').find('.use_main_color').hide();
    } else {
      $(this).closest('li').find('.use_main_color').show();
    }
  });

  // パララックス効果有効時に推奨画像サイズを変更
  $(document).on('click', '.use_para_checkbox:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).closest('.cb_content').find('.yes_para').show();
      $(this).closest('.cb_content').find('.no_para').hide();
    } else {
      $(this).closest('.cb_content').find('.yes_para').hide();
      $(this).closest('.cb_content').find('.no_para').show();
    }
  });
  $('.use_para_checkbox:checkbox').each(function(){
    if ($(this).is(":checked")) {
      $(this).closest('.cb_content').find('.yes_para').show();
      $(this).closest('.cb_content').find('.no_para').hide();
    } else {
      $(this).closest('.cb_content').find('.yes_para').hide();
      $(this).closest('.cb_content').find('.no_para').show();
    }
  });

  });

	// コンテンツ削除
  $('.contents_builder').on('click', '.cb_delete', function(){
    if (confirm(TCD_MESSAGES.contentBuilderDelete)) {
      var $cb_row = $(this).closest('.cb_row');
      $cb_row.slideUp('fast', function(){ $cb_row.remove(); });
    }
  });

  // コンテンツの開閉
  $('.contents_builder').on('click', '.cb_content_headline', function(){
    $(this).parents('.cb_content_wrap').toggleClass('open');
    return false;
  });
  $('.contents_builder').on('click', 'a.close-content', function(){
    $(this).parents('.cb_content_wrap').toggleClass('open');
    return false;
  });

  // トグルボタン
  $('.contents_builder').on('change', '.cb_content_switch input:checkbox', function(){
    $(this).closest('.cb_content_wrap').toggleClass('off');
  });
  $('.cb_content_switch input:checkbox').each(function(){
    if ($(this).is(":checked")) {
      $(this).closest('.cb_content_wrap').removeClass('off');
    } else {
      $(this).closest('.cb_content_wrap').addClass('off');
    }
  });

  // 見出しの変更
  $(document).on('change keyup', '.cb_content_wrap .cb-repeater-label', function(){
    var $cb_content_wrap = $(this).closest('.cb_content_wrap');
    var overview = [];
    $cb_content_wrap.find('.cb-repeater-label').each(function(){
      overview.push($(this).val());
    });
    overview = overview.join(', ');
    if (overview.length) {
      overview = overview.replace(/\s+/gm, ' ').replace(/<.*?>/gm, '').replace(/\[.*?\]/gm, '');
    }
    if (overview.length > 100) {
      overview = overview.substring(0, 99) + '…';
    }
    if (overview.length) {
      if ($cb_content_wrap.find('.cb_content_headline span').length) {
        $cb_content_wrap.find('.cb_content_headline span').text(overview);
      } else {
        $cb_content_wrap.find('.cb_content_headline').text(overview);
      }
    }
  })
  $('.cb_content_wrap .cb-repeater-label').trigger('change');

  // コンテンツビルダーここまで ----------------------------------------------------


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

  // トップページ　ヘッダースライダーのタイプ
  if($('.index_slider_type1 input').is(':checked')) {
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type1_area').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_area').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_area').hide();
  }
  if($('.index_slider_type2 input').is(':checked')) {
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type1_area').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_area').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_area').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_option').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_option').hide();
  }
  if($('.index_slider_type3 input').is(':checked')) {
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type1_area').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_area').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_area').show();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type2_option').hide();
    $(this).closest('.theme_option_field_ac_content').find('.index_slider_type3_option').show();
  }


  // ボタンタイプ
  $('select.button_type_option').change(function(){
    if ( $(this).val() == 'type4' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').hide();
    } else if ( $(this).val() == 'type1' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type2_option').hide();
    } else {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type1_option').hide();
      $(this).closest('.button_option_area').find('.button_type2_option').show();
    }
  });
  $('select.button_type_option').each(function(){
    if ( $(this).val() == 'type4' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').hide();
    } else if ( $(this).val() == 'type1' ) {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type2_option').hide();
    } else {
      $(this).closest('.button_option_area').find('.button_type4_option').show();
      $(this).closest('.button_option_area').find('.button_type1_option').hide();
      $(this).closest('.button_option_area').find('.button_type2_option').show();
    }
  });

  // メインカラーを適用する
  $(document).on('click', '.use_main_color_checkbox input:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).closest('li').find('.use_main_color').hide();
    } else {
      $(this).closest('li').find('.use_main_color').show();
    }
  });
  $('.use_main_color_checkbox input:checkbox').each(function(){
    if ($(this).is(":checked")) {
      $(this).closest('li').find('.use_main_color').hide();
    } else {
      $(this).closest('li').find('.use_main_color').show();
    }
  });

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

  // Saturation
  $(document).on('change', '.range', function() {
    $(this).prev('.range-output').find('span').text($(this).val());
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

});


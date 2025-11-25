<?php

// Global variables
$toc_post_names = array('post');
$toc_id_name = 'toc-';

// その他目次用ファイルの読み込み
require get_template_directory() . '/functions/toc/toc_cf.php';
require get_template_directory() . '/functions/toc/toc_widget.php';

// 記事本文から目次に使用する見出しの取得
function get_toc_headings($content) {

    global $post, $toc_post_names;
    $options = get_design_plus_option();

    // 目次が有効化された投稿タイプを取得
    $post_types = array();
    foreach ( $toc_post_names as $toc_post_name ){
      if($options['active_toc_post_type_'.$toc_post_name]){
        array_push($post_types,$toc_post_name);
      }
    };
    
    if (!is_null($post) && isset($post->ID)) {
        $hide_toc = get_post_meta($post->ID, 'hide_toc', true);
    }

    if( is_singular( $post_types ) && !empty($post_types) && !$hide_toc ){

        $heading_type = $options['active_toc_heading_type'];
        $pattern = '/<h['.$heading_type.'](.*?)>(.*?)<\/h['.$heading_type.']>/s';
        preg_match_all( $pattern, $content, $headings, PREG_SET_ORDER );

        // $heading[0] hタグ全部
        // $heading[1] hタグのセレクタのみ
        // $heading[2] hタグに囲まれた文字列

        $extracted_headings = array();
        foreach ( $headings as $heading ):

        // hタグ内にhtmlタグが使用されていた場合は取り除く
        $heading[2] = strip_tags($heading[2]);

        // no_tocが無い && hタグに文字が存在していれば
        if(strpos( $heading[1], 'no_toc' ) === false && strlen($heading[2]) ){
            array_push($extracted_headings,$heading);
        }
        endforeach;

        $active_num = $options['active_toc_heading_num'];
        if ( count( $extracted_headings ) >= $active_num ) {
            return $extracted_headings;
        }

    }

}

// 目次の見出しを取得
function get_toc_title($title_type = 'type1') {

    global $post;
    $options = get_design_plus_option();

    $cf_title = get_post_meta($post->ID, 'toc_title', true);
    if($cf_title){
        $title = $cf_title;
    }elseif($title_type == 'type1'){
        $title = $options['toc_title'];
    }elseif($title_type == 'type2'){
        $title = get_the_title();
    }

    return $title;

}

// 記事本文の見出しをid付き見出しに書き換える
function convert_toc_heading($content, $headings, $id_name) {

    $i = 0;
    $id = $id_name;

    foreach ( $headings as $heading ):
        $id .= $i + 1;
        $regex_heading = '/' . preg_quote( $heading[0], '/' ) . '/su';

        // idがなかったら置換え
        // idがあったら置換えない
        if(strpos( $heading[1], 'id=' ) === false ){ // idがなかったら
            $replace_title = preg_replace( '/<(h[2-6])/s', '<$1 id="'.$id. '"', $heading[0], 1 );
        }else{
            $replace_title = $heading[0];
            $i--;
        }

        $content = preg_replace( $regex_heading, $replace_title, $content, 1 );
        $i++;
		$id = $id_name;
    endforeach;

    return $content;

}

// カレントページのサイドバーに目次ウィジェットが存在していたら
function is_active_toc_widget() {

     $post_type = get_post_type();
     $widgets = wp_get_sidebars_widgets();
     $toc_widget_id = '/^tcd_toc_widget-[1-9]*/';

//     $exist_common_widgets = preg_grep($toc_widget_id, $widgets['common_widget']);
     $exist_current_widgets = preg_grep($toc_widget_id, $widgets[$post_type.'_single_widget']);

//     if ( $exist_common_widgets || $exist_current_widgets ) {
     if ( $exist_current_widgets ) {
          return true;
     }

}

// サイドバーの目次だけ表示する場合
function is_only_display_toc_widget() {

     $post_type = get_post_type();
     $widgets = wp_get_sidebars_widgets();
     $target = '/only_sidebar/';

//     $exist_common_widgets = preg_grep($target, $widgets['common_widget']);
     $exist_current_widgets = preg_grep($target, $widgets[$post_type.'_single_widget']);

     $toc_widgets =  get_option( 'widget_tcd_toc_widget' );
     $key = array_search( '1', array_column( $toc_widgets, 'only_sidebar'));

//     if ( $exist_common_widgets || $exist_current_widgets || is_numeric($key) ) {
     if ( $exist_current_widgets || is_numeric($key) ) {
          return true;
     }

}

// 目次リストの作成
function create_toc_list($toc_title, $headings, $id_name, $widget = true) {

    $options = get_design_plus_option();

    $toc_wrap = '';
	$i = 0;
	$currentlevel = 0;
	$id = $id_name;

	foreach ( $headings as $heading ):

		$id .= $i + 1;

        // 各見出しによるレベル定義
        switch (true) {
            case strpos( $heading[0], '<h2' ) !== false:
                $level = 1;
                break;
            case strpos( $heading[0], '<h3' ) !== false:
                $level = 2;
                break;
            case strpos( $heading[0], '<h4' ) !== false:
                $level = 3;
                break;
            case strpos( $heading[0], '<h5' ) !== false:
                $level = 4;
                break;
        }

        // 見出しのレベルが指定したレベルよりも低い間
		while ( $currentlevel < $level ) {
            if ( $currentlevel === 0 ) {
                $toc_wrap .= '<ul class="toc_wrap parent">';
            } else {
                $toc_wrap .= '<ul class="toc_wrap child">';
            }
            $currentlevel++;
		}

        // 見出しのレベルが指定したレベルよりも大きい間
		while ( $currentlevel > $level ) {
			$toc_wrap .= '</li></ul>';
			$currentlevel--;
		}

        // 見出しにidが付与されている場合は、既存のid名を目次のリンクに付与
        if(preg_match( '/id=["\'](.*?)["\']/i', $heading[1], $exist_id_names )) {
            $id = $exist_id_names[1];
            $i--;
        }		    

        $toc_wrap .= '<li class="toc_item"><a href="#' . $id . '" class="toc_link">' . $heading[2] . '</a>';

		$i++;
		$id = $id_name;

        endforeach;

		// 目次の最後の項目をどの要素から作成したかによりタグの閉じ方を変更
		while ( $currentlevel > 0 ) {
			$toc_wrap .= '</li></ul>';
			$currentlevel--;
		}

        $toc_title_style = "";
        $title_color = $options['toc_title_color'];
        $use_style = $options['use_toc_theme_style'];
        $styled = '';
        if(!$use_style){ $styled = 'styled'; }

        // ウィジェットかどうかで出力するHTMLを変える
        if($widget) {

            if(!$use_style){ $toc_title_style = ''; }
            if($toc_title){ $toc_title = '<h3 class="widget_headline"'.$toc_title_style.'>'.$toc_title.'</h3>'; }
            $toc_wrap_selector = '<div class="toc_widget_wrap '.$styled.'">';

        }else{

            if(!$use_style ){ $toc_title_style = 'style="color:'.esc_attr($title_color).';"'; }
            if($toc_title){ $toc_title = '<div class="toc_title" '.$toc_title_style.'><span>'.$toc_title.'</span></div>'; }
            $toc_wrap_selector = '<div id="tcd_toc" class="'.$styled.'">';
        }

		$index = $toc_wrap_selector.$toc_title.$toc_wrap .'</div>';

        return $index;
    
}


// the_contentの内容を書き換えて目次を設置する
function add_toc_content( $content ) {

    global $toc_id_name;

    $headings = get_toc_headings($content);

    if($headings):

        // $id_name = 'index-';

        $content = convert_toc_heading($content, $headings, $toc_id_name);

        if( !is_only_display_toc_widget() ){

            $toc_title = get_toc_title();
            $toc = create_toc_list($toc_title, $headings, $toc_id_name, false);  
            
            // ショートコードが存在していたら
            if ( strpos( $content, '[tcd_toc]' ) !== false ) {
                $content = preg_replace( '/\[tcd_toc\]/', $toc , $content, 1 );
            } elseif ( preg_match( '/<h2.*?>/i', $content, $h2s ) ) {
                $content = preg_replace( '/<h2.*?>/i', $toc . $h2s[0], $content, 1 );
            }

        }

    endif;

    return $content;

}
add_filter( 'the_content', 'add_toc_content', 9 ); // ショートコード実行前に書き換え
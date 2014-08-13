<?php
/*
 Weaver X shortcodes
*/

function wvrx_ts_setup_shortcodes() {
    // we setup all of our shortcodes only after the theme has been loaded...

    $codes = array(						    // list of shortcodes
	array('div' => 'wvrx_ts_sc_div'),       // [div]
	array('html' => 'wvrx_ts_sc_html'),		// [html]
	array('span' => 'wvrx_ts_sc_span'),	    // [span]

	array('hide_if_logged_in' => 'wvrx_ts_sc_hide_if_logged_in' ),	      		// [hide_if_logged_in]

	array('hide_mobile' => 'wvrx_ts_sc_hide_if_mobile'),      		// [hide_mobile]

	array('bloginfo' => 'wvrx_ts_sc_bloginfo'),      // [bloginfo]

	array('header_image' => 'wvrx_ts_sc_header_image'),      // [header_image]

	array('iframe' => 'wvrx_ts_sc_iframe'),         // [iframe]

	array('site_tagline' => 'wvrx_ts_sc_site_tagline'),   // [site_tagline]

	array('site_title' => 'wvrx_ts_sc_site_title'), // [site_title]

	array('tab_group' => 'wvrx_ts_sc_tab_group',
          'tab' => 'wvrx_ts_sc_tab'),               // [tab_group], [tab]

	array('user_can' => 'user_can'),                // [user_can]

	array('vimeo' => 'wvrx_ts_sc_vimeo'),           // [vimeo]

	array('youtube' => 'wvrx_ts_sc_youtube'),       // [youtube]

	array('weeaverx_info' => 'wvrx_ts_weaverx_sc_info'),     // [weaverx_info]

    );

   foreach ($codes as $code) {
	wvrx_ts_set_shortcodes($code);
   }
}

add_action('init', 'wvrx_ts_setup_shortcodes');  // allow shortcodes to load after theme has loaded so we know which version to use


// ===============  [weaver_header_image style='customstyle'] ===================
function wvrx_ts_sc_header_image($args = ''){
    extract(shortcode_atts(array(
	    'style' => '',	// STYLE
	    'h' => '',
	    'w' => ''
    ), $args));

    $width = $w ? ' width="' . $w . '"' : '';
    $height = $h ? ' height="' . $h . '"' : '';
    $st = $style ? ' style="' . $style . '"' : '';

	$hdrimg = '<img src="' . get_header_image() . '"' . $st . $width . $height
	 . ' alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />' ;

    return $hdrimg;
}

// ===============  [weaver_bloginfo arg='name'] ======================
function wvrx_ts_sc_bloginfo($args = '') {
    extract(shortcode_atts(array(
	    'arg' => 'name',		// a WP bloginfo name
	    'style' => ''		// wrap with style
    ), $args));

    $code = '';
    if ($style != '') $code = '<span style="' . $style . '">';
    $code .= esc_attr( get_bloginfo( $arg ));
    if ($style != '') $code .= '</span>';
    return $code;
}

// ===============  [weaver_site_title style='customstyle'] ======================
function wvrx_ts_sc_site_title($args = '') {
    extract(shortcode_atts(array(
	    'style' => ''		/* styling for the header */
    ), $args));
    $title = esc_attr( get_bloginfo( 'name', 'display' ));

    if ($style) {
        return '<span style="' . $style . '">' . $title . '</span>';
    }
    return $title;

}

// ===============  [weaver_site_title style='customstyle'] ======================
function wvrx_ts_sc_site_tagline($args = '') {
    extract(shortcode_atts(array(
	    'style' => ''		/* styling for the header */
    ), $args));
    $title = get_bloginfo( 'description' );

    if ($style) {
	return '<span style="' . $style . '">' . $title . '</span>';
    }
    return $title;
}

// ===============  [weaver_iframe src='address' height=nnn] ======================
function wvrx_ts_sc_iframe($args = '') {
    extract(shortcode_atts(array(
	    'src' => '',
	    'height' => '600', /* styling for the header */
	    'percent' => 100,
	    'style' => 'border:1px;'
    ), $args));

    $sty = $style ? ' style="' . $style . '"' : '';

    if (!$src) return '<h4>No src address provided to [iframe].</h4>';
    return "\n" . '<iframe src="' . $src . '" height="' .  $height . 'px" width="' . $percent . '%"' . $sty . '></iframe>' . "\n";
}

// ===============  [weaver_show_if_mobile style='customstyle'] ======================

function wvrx_ts_sc_hide_if_mobile($args = '', $text) {

    extract(shortcode_atts(array(
	    'phone' => true,
        'smalltablet' => true,
        'desktop' => false,
    ), $args));

    $class = '';
    if ( $phone )
        $class = 'atw-hide-phone ';
    if ( $smalltablet )
        $class .= 'atw-hide-smalltablet ';
    if ( $desktop )
        $class .= 'atw-hide-desktop';
    $class = trim($class);

    return '<span class="' . $class . '">' . do_shortcode($text) . '</span>';
}

// ===============  [weaver_show_if_logged_in] ======================
function wvrx_ts_sc_show_if_logged_in($args = '',$text) {

    if (is_user_logged_in()) {
	return do_shortcode($text);
    }
    return '';
}

function wvrx_ts_sc_hide_if_logged_in($args = '',$text) {

    if (!is_user_logged_in()) {
	return do_shortcode($text);
    }
    return '';
}


// ===============  [tab_group ] ======================
function wvrx_ts_sc_tab_group( $args, $content ) {
    extract( shortcode_atts( array(
	'border_color' => '',		// tab and pane bodder color - default #888
	'tab_bg' => '',			// normal bg color of tab (default #CCC)
	'tab_selected_color' => '',	// color of tab when selected (default #EEE)
	'pane_min_height' => '',	// min height of a pane to help make all even if needed
	'pane_bg' => ''			// bg color of pane
    ), $args ) );

    if (isset($GLOBALS['wvrx_ts_in_tab_container']) && $GLOBALS['wvrx_ts_in_tab_container']) {
	return '<strong>Sorry, you cannot nest tab_containers.</strong>';
    }

    if ( !isset( $GLOBALS['wvrx_ts_tab_id'] ) )
        $GLOBALS['wvrx_ts_tab_id'] = 1;
    else
        ++$GLOBALS['wvrx_ts_tab_id'];

    $group_id = 'atw-tab-group-' . $GLOBALS['wvrx_ts_tab_id'];

    $css = '';	// default styles
    $add_style = '';
    if ($border_color != '')
        $css .= '#' . $group_id . '.atw-tabs-style .atw-tabs-pane,#' .
            $group_id . '.atw-tabs-style .atw-tabs-nav span {border-color:' . $border_color . ";}\n";

    if ($pane_min_height != '')
        $css .= '#' . $group_id . '.atw-tabs-style .atw-tabs-pane {min-height:' . $pane_min_height . ";}\n";

    if ($pane_bg != '')
        $css .= '#' . $group_id . '.atw-tabs-style .atw-tabs-pane {background-color:' . $pane_bg . ";}\n";

    if ($tab_bg != '')
        $css .= '#' . $group_id . '.atw-tabs-style .atw-tabs-nav span {background-color:' . $tab_bg . ";}\n";

    if ($tab_selected_color != '')
        $css .= '#' . $group_id . '.atw-tabs-style .atw-tabs-nav span.atw-tabs-current,#' .
            $group_id . '.atw-tabs-style .atw-tabs-nav span:hover {background-color:' . $tab_selected_color . ";}\n";

    if ($css != '') {	// specified some style...
        $add_style = "<style type=\"text/css\">\n" . $css . "</style>\n";
    }

    $GLOBALS['wvrx_ts_in_tab_container'] = true;
    $GLOBALS['wvrx_ts_num_tabs'] = 0;

    do_shortcode( $content );	// process the tabs on this

    $out = '*** Unclosed or mismatched [tab_group] shortcodes ***';

    if ( isset( $GLOBALS['wvrx_ts_tabs'] ) && is_array( $GLOBALS['wvrx_ts_tabs'] ) ) {
        foreach ( $GLOBALS['wvrx_ts_tabs'] as $tab ) {
            $tabs[] = '<span>' . $tab['title'] . '</span>'. "\n";
            $panes[] = "\n" .'<div class="atw-tabs-pane">' . $tab['content'] . '</div>';
        }
        $out = '<div id="' . $group_id . '" class="atw-tabs atw-tabs-style"> <!-- tab_group -->' . "\n"
            . '<div class="atw-tabs-nav">' . "\n"
            . implode( '', $tabs ) . '</div>' . "\n"
            . '<div class="atw-tabs-panes">'
            . implode( '', $panes ) . "\n"
            . '</div><div class="atw-tabs-clear"></div>' . "\n"
            . '</div> <!-- end tab_group -->' . "\n";
    }

    // Forget globals we generated
    unset( $GLOBALS['wvrx_ts_in_tab_container'],$GLOBALS['wvrx_ts_tabs'],$GLOBALS['wvrx_ts_num_tabs']);

    return $add_style . $out;
}

function wvrx_ts_sc_tab( $args, $content ) {
    extract( shortcode_atts( array(
	'title' => 'Tab %d'
    ), $args ) );

    if ( ! isset( $GLOBALS['wvrx_ts_num_tabs'] ) ) {
        $GLOBALS['wvrx_ts_num_tabs'] = 0;
    }
    $cur = $GLOBALS['wvrx_ts_num_tabs'];
    $GLOBALS['wvrx_ts_tabs'][$cur] = array(
        'title' => sprintf( $title, $GLOBALS['wvrx_ts_num_tabs'] ),		// the title with number
        'content' => do_shortcode( $content ) );
    $GLOBALS['wvrx_ts_num_tabs']++;
}


// =============== [user_can] ===================
function wvrx_ts_sc_user_can($args = '',$content='') {
    extract( shortcode_atts( array(
	'role' => '',
	'alttext' => '',
    'not' => false
    ), $args ) );

    $code = '';
    if ($role != '' && (!$not && current_user_can($role)) ) {
        $code = do_shortcode($content);
    } else {
        $code = $alttext;
    }
    return $code;
}

// ===============  [weaver_youtube id=videoid sd=0 hd=0 related=0 https=0 privacy=0 w=0 h=0] ======================
function wvrx_ts_sc_youtube($args = '') {
    $share = '';
    if ( isset ( $args[0] ) )
	$share = trim($args[0]);

    // http://code.google.com/apis/youtube/player_parameters.html
    // not including: enablejsapi, fs,playerapiid,

    extract(shortcode_atts(array(
        'id' => '',
        'sd' => false,
        'related' => '0',
        'https' => false,
        'privacy' => false,
        'ratio' => false,
        'center' => '1',
        'autohide' => '~!',
        'autoplay' => '0',
        'border' => '0',
        'color' => false,
        'color1' => false,
        'color2' => false,
        'controls' => '1',
        'disablekb' => '0',
        'egm' => '0',
        'fs' => '1',
        'fullscreen' => 1,
        'hd' => '0',
        'iv_load_policy' => '1',
        'loop' => '0',
        'modestbranding' => '0',
        'origin' => false,
        'percent' => 100,
        'playlist' => false,
        'rel' => '0',
        'showinfo' => '1',
        'showsearch' => '1',
        'start' => false,
        'theme' => 'dark',
        'w' => '~!',
        'wmode' => 'transparent'

    ), $args));

    if (!$share && !$id)
        return '<strong>No share or id values provided for youtube shortcode.</strong>';

    if ($share)	{	// let the share override any id
        $share = str_replace('http://youtu.be/','',$share);
        if (strpos($share,'youtube.com/watch') !== false) {
            $share = str_replace('http://www.youtube.com/watch?v=', '', $share);
            $share = str_replace('&amp;','+',$share);
            $share = str_replace('&','+',$share);
        }
        if ($share)
            $id = $share;
    }

    $opts = $id . '%%';

    $opts = wvrx_ts_add_url_opt($opts, $hd != '0', 'hd=1');
    $opts = wvrx_ts_add_url_opt($opts, $autohide != '~!', 'autohide='.$autohide);
    $opts = wvrx_ts_add_url_opt($opts, $autoplay != '0', 'autoplay=1');
    $opts = wvrx_ts_add_url_opt($opts, $border != '0', 'border=1');
    $opts = wvrx_ts_add_url_opt($opts, $color, 'color='.$color);
    $opts = wvrx_ts_add_url_opt($opts, $color1, 'color1='.$color1);
    $opts = wvrx_ts_add_url_opt($opts, $color2, 'color2='.$color2);
    $opts = wvrx_ts_add_url_opt($opts, $controls != '1', 'controls=0');
    $opts = wvrx_ts_add_url_opt($opts, $disablekb != '0', 'disablekb=1');
    $opts = wvrx_ts_add_url_opt($opts, $egm != '0', 'egm=1');
    $opts = wvrx_ts_add_url_opt($opts, true, 'fs='.$fs);
    $opts = wvrx_ts_add_url_opt($opts, true, 'iv_load_policy='.$iv_load_policy);
    $opts = wvrx_ts_add_url_opt($opts, $loop != '0', 'loop=1');
    $opts = wvrx_ts_add_url_opt($opts, $modestbranding != '0', 'modestbranding=1');
    $opts = wvrx_ts_add_url_opt($opts, $origin, 'origin='.$origin);
    $opts = wvrx_ts_add_url_opt($opts, $playlist, 'playlist='.$playlist);
    $opts = wvrx_ts_add_url_opt($opts, true, 'rel='.$rel);
    $opts = wvrx_ts_add_url_opt($opts, true, 'showinfo=' . $showinfo);
    $opts = wvrx_ts_add_url_opt($opts, $showsearch != '1', 'showsearch=0');
    $opts = wvrx_ts_add_url_opt($opts, $start, 'start='.$start);
    $opts = wvrx_ts_add_url_opt($opts, $theme != 'dark', 'theme=light');
    $opts = wvrx_ts_add_url_opt($opts, $wmode, 'wmode='.$wmode);

    if ($https) $url = 'https://';
    else $url = 'http://';

    if ($privacy) $url .= 'www.youtube-nocookie.com';
    else $url .= 'www.youtube.com';

    $opts = str_replace('%%+','%%?', $opts);
    $opts = str_replace('%%','', $opts);
    $opts = str_replace('+','&amp;', $opts);

    $url .= '/embed/' . $opts;

    $vert = $sd ? 0.75 : 0.5625;
    if ($ratio) $vert = $ratio;

    $allowfull = $fullscreen ? ' allowfullscreen' : '';
    $cntr1 = $center ? '<div style="text-align:center">' : '';
    $cntr2 = $center ? '</div>' : '';

    if (wvrx_ts_getopt('video_fitvids') && $w == '~!') {	// fitvids forces override of percent, etc
	$w = 640;	// a reasonable number
    }

    if ($w != '~!' && $w != 0) {
	$h = ($w * $vert) + 5;
	$ret ="\n" . $cntr1 . '<iframe src="' . $url
     . '" frameborder="0" width="'.$w.'" height="' . $h . '"></iframe>'
     . $cntr2 . "\n";

    } else {
	$ret = "\n" . $cntr1 . '<iframe src="' . $url
     . '" frameborder="0" width="'.$percent.'%" height="0" onload="wvrx_ts_fixVideo(this,'.$vert.');"></iframe>'
     . $cntr2 . "\n";
    }

    return $ret;
}

// ===============  [weaver_vimeo id=videoid sd=0 w=0 h=0 color=#hex autoplay=0 loop=0 portrait=1 title=1 byline=1] ======================
function wvrx_ts_sc_vimeo($args = '') {
    $share = '';
    if ( isset ( $args[0] ) )
	$share = trim($args[0]);

    extract(shortcode_atts(array(
	'id' => '',
	'sd' => false,
	'color' => '',
	'autoplay' => false,
	'loop' => false,
	'portrait' => true,
	'title' => true,
	'byline' => true,
	'ratio' => false,
	'percent' => 100,
	'center' => '1',
	'w' => '~!'
    ), $args));

    if (!$share && !$id) return '<strong>No share or id values provided for vimeo shortcode.</strong>';

    if ($share)	{	// let the share override any id
	$share = str_replace('http://vimeo.com/','',$share);
	if ($share) $id = $share;
    }

    $opts = $id . '##';

    $opts = wvrx_ts_add_url_opt($opts, $autoplay, 'autoplay=1');
    $opts = wvrx_ts_add_url_opt($opts, $loop, 'loop=1');
    $opts = wvrx_ts_add_url_opt($opts, $color, 'color=' . $color);
    $opts = wvrx_ts_add_url_opt($opts, !$portrait, 'portrait=0');
    $opts = wvrx_ts_add_url_opt($opts, !$title, 'title=0');
    $opts = wvrx_ts_add_url_opt($opts, !$byline, 'byline=0');

    $url = 'http://player.vimeo.com/video/';

    $opts = str_replace('##+','##?', $opts);
    $opts = str_replace('##','', $opts);
    $opts = str_replace('+','&amp;', $opts);

    $url .= $opts;

    if (function_exists('weaverii_use_mobile'))
        if (weaverii_use_mobile('mobile')) $percent = 100;

    $vert = $sd ? 0.75 : 0.5625;
    if ($ratio) $vert = $ratio;
    $cntr1 = $center ? '<div style="text-align:center">' : '';
    $cntr2 = $center ? '</div>' : '';

    if ($w != '~!' && $w != 0) {
        $h = ($w * $vert) + 5;
	$ret = "\n" . $cntr1 . '<iframe src="' . $url
     . '" width="'.$w.'" height="'. $h . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen "></iframe>'
     . $cntr2 . "\n";

    } else {
	$ret = "\n" . $cntr1 . '<iframe src="' . $url
     . '" width="'.$percent.'%" height="0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen onload="wvrx_ts_fixVideo(this,'.$vert.');"></iframe>'
     . $cntr2 . "\n";
    }

    return $ret;
}

// ===== video utils =====

function wvrx_ts_add_url_opt($opts, $add, $add_val) {
    if ($add) {
	$opts = $opts . '+' . $add_val;
    }
    return $opts;
}



function wvrx_ts_sc_html($vals = '') {           //  [html style='customstyle'] - all ======================
    $tag = 'span';
    if ( isset ( $vals[0] ) )
	$tag = trim( $vals[0]);

    extract(shortcode_atts(array(
	'args' => ''
    ), $vals));
    if ($args) $args = ' ' . $args;
    return '<' . $tag . $args .  '>';
}

function wvrx_ts_sc_div($vals = '',$text) {              // [div] - all  ===================
    extract(shortcode_atts(array(
	'id' => '',
	'class' => '',
	'style' => ''
    ), $vals));

    $args = '';
    if ($id) $args .= ' id="' . $id . '"';
    if ($class) $args .= ' class="' . $class . '"';
    if ($style) $args .= ' style="' . $style . '"';

    return '<div' . $args . '>' . do_shortcode($text) . '</div>';
}

function wvrx_ts_sc_span($vals = '',$text) {     // [span] - all ==================
    extract(shortcode_atts(array(
	'id' => '',
	'class' => '',
	'style' => ''
    ), $vals));

    $args = '';
    if ($id) $args .= ' id="' . $id . '"';
    if ($class) $args .= ' class="' . $class . '"';
    if ($style) $args .= ' style="' . $style . '"';

    return '<span' . $args . '>' . do_shortcode($text) . '</span>';
}

function wvrx_ts_weaverx_sc_info() {           // [info]  ======================
    global $current_user;
    $out = '<strong>Theme/User Info</strong><hr />';

    get_currentuserinfo();
    if (isset($current_user->display_name)) {
	$out .= '<em>User:</em> ' . $current_user->display_name . '<br />';
    }
    $out .= '&nbsp;&nbsp;' . wp_register('','<br />',false);
    $out .= '&nbsp;&nbsp;' . wp_loginout('',false) . '<br />';

    $agent = 'Not Available';
    if (isset($_SERVER["HTTP_USER_AGENT"]) )
	$agent = $_SERVER['HTTP_USER_AGENT'];
    $out .= '<em>User Agent</em>: <small>' . $agent . '</small>';
    $out .= '<div id="example"></div>
<script type="text/javascript">
var txt = "";
var myWidth;
if( typeof( window.innerWidth ) == "number" ) {
//Non-IE
myWidth = window.innerWidth;
} else if( document.documentElement &&
( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
//IE 6+ in "standards compliant mode"
myWidth = document.documentElement.clientWidth;
} else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
//IE 4 compatible
myWidth = document.body.clientWidth;
}
txt+= "<em>Browser Width: </em>" + myWidth + " px</br>";
document.getElementById("example").innerHTML=txt;
</script>';

    $out .= '<em>Feed title:</em> ' . get_bloginfo_rss('name') . '<br />' . get_wp_title_rss();

    $out .= '<br /><em>You are using</em> WordPress ' . $GLOBALS['wp_version'] . '<br /><em>PHP Version:</em> ' . phpversion();
    $out .= '<br /><em>Memory:</em> ' . round(memory_get_usage()/1024/1024,2) . 'M of ' .  (int)ini_get('memory_limit') . 'M <hr />';
    return $out;
}


function wvrx_ts_set_shortcodes($sc_list) {
    foreach ($sc_list as $sc_name => $sc_func) {
        remove_shortcode($sc_name);
        add_shortcode($sc_name,$sc_func);
    }
}

// ===============  Utilities ======================


?>

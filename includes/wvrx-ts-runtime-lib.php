<?php

// # Weaver X SW Globals ==============================================================
$wvrx_ts_opts_cache = false;	// internal cache for all settings


// ===============================  options =============================

function wvrx_ts_getopt($opt) {
    global $wvrx_ts_opts_cache;
    if (!$wvrx_ts_opts_cache)
        $wvrx_ts_opts_cache = get_option('wvrx_ts_settings' ,array());

    if (!isset($wvrx_ts_opts_cache[$opt]))	// handles changes to data structure
      {
	return false;
      }
    return $wvrx_ts_opts_cache[$opt];
}

function wvrx_ts_setopt($opt, $val, $save = true) {
    global $wvrx_ts_opts_cache;
    if (!$wvrx_ts_opts_cache)
        $wvrx_ts_opts_cache = get_option('wvrx_ts_settings' ,array());

    $wvrx_ts_opts_cache[$opt] = $val;
    if ($save)
	wvrx_ts_wpupdate_option('wvrx_ts_settings',$wvrx_ts_opts_cache);
}

function wvrx_ts_save_all_options() {
    global $wvrx_ts_opts_cache;
    wvrx_ts_wpupdate_option('wvrx_ts_settings',$wvrx_ts_opts_cache);
}

function wvrx_ts_delete_all_options() {
    global $wvrx_ts_opts_cache;
    $wvrx_ts_opts_cache = false;
    if (current_user_can( 'manage_options' ))
	delete_option( 'wvrx_ts_settings' );
}

function wvrx_ts_wpupdate_option($name,$opts) {
    if (current_user_can( 'manage_options' )) {
	update_option($name, $opts);
    }
}

// Interface to Weaver Xtreme

add_action('weaverx_theme_support_addon','wvrx_ts_theme_support_addon');
function wvrx_ts_theme_support_addon() {
?>
<div class="a-plus">
	<p><strong style="font-size:110%;">You have Weaver Xtreme Theme Support installed.</strong><br />
	&nbsp;&nbsp;See the Dashboard : Appearance : Theme Support menu for settings and help.</p>
</div>
<?php
}
?>

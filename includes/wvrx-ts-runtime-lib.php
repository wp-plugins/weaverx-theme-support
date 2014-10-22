<?php

// # Weaver X SW Globals ==============================================================
$wvrx_ts_opts_cache = false;	// internal cache for all settings

function wvrx_ts_help_link($ref, $label) {

    $t_dir = wvrx_ts_plugins_url('/help/' . $ref, '');
    $pp_help =  '<a style="text-decoration:none;" href="' . $t_dir . '" target="_blank" title="' . $label . '">'
		. '<span style="color:red; vertical-align: middle; margin-left:.25em;" class="dashicons dashicons-editor-help"></span></a>';
    echo $pp_help ;
}


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
	This page shows the shortcodes and widgets available with Weaver X Theme Support.
Click the<span style="color:red; vertical-align: middle; margin-left:.25em;" class="dashicons dashicons-editor-help"></span> button to open help entry.</p>
    <h3>Shortcodes</h3>
    <ul>

    <li><span class="wvr-blue">Show If- [show_if]</span> - Show content only if args meet specified conditions
        <?php wvrx_ts_help_link('help.html#scshowif','Help for Show/Hide If');?><br />
        <code>[show|hide_if device=device logged_in=true/false not_post_id=id-list post_id=id-list user_can=what]text[/show|hide_if]</code>
    </li>

    <li><span class="wvr-blue">Hide If - [hide_if]</span> - Hide content
    </li>

    <li><span class="wvr-blue">Header Image - [header_image]</span> - Display default header image
        <?php wvrx_ts_help_link('help.html#headerimage','Help for Header Image');?><br />
        <code>[header_image h='size' w='size' style='inline-style']</code>
    </li>

    <li><span class="wvr-blue">HTML - [html]</span> - Wrap content in any HTML tag
        <?php wvrx_ts_help_link('help.html#schtml','Help for HTML');?><br />
        <code>[html html-tag args='parameters']</code>
    </li>

    <li><span class="wvr-blue">DIV - [div]text[/div]</span> - Wrap content in a &lt;div&gt; tag
        <?php wvrx_ts_help_link('help.html#scdiv','Help for Header Div');?><br />
        <code>[div id='class_id' class='class_name' style='style_values']text[/div]</code>
    </li>

    <li><span class="wvr-blue">SPAN - [span]text[/span]</span> - Wrap content in a &lt;span&gt; tag
        <?php wvrx_ts_help_link('help.html#scdiv','Help for Span');?><br />
        <code>[span id='class_id' class='class_name' style='style_values']text[/span]</code>
    </li>

    <li><span class="wvr-blue">Tab Group - [tab_group]</span> - Display content on separate tabs
        <?php wvrx_ts_help_link('help.html#tab_group','Help for Tab Group');?><br />
        <code>[tab_group][tab]...[/tab][tab]...[/tab][/tab_group]</code>
    </li>

    <li><span class="wvr-blue">iFrame - [iframe]</span> - Display external content in an iframe
        <?php wvrx_ts_help_link('help.html#sciframe','Help for iframe');?><br />
        <code>[iframe src='http://example.com' height=600 percent=100 style="style"]</code>
    </li>

    <li><span class="wvr-blue">Site Title - [site_title]</span> - Display the site title
        <?php wvrx_ts_help_link('help.html#sitetitlesc','Help for Site Title');?><br />
        <code>[site_title style='inline-style']</code>
    </li>

    <li><span class="wvr-blue">Site Tagline - [site_tagline]</span> - Display the site tagline
        <?php wvrx_ts_help_link('help.html#sitetitlesc','Help for Site Tagline');?><br />
        <code>[site_tagline style='inline-style']</code>
    </li>

    <li><span class="wvr-blue">Blog Info - [bloginfo]</span> - Display blog info as provided by WordPress bloginfo function
        <?php wvrx_ts_help_link('help.html#bloginfo','Help for Blog Info');?><br />
        <code>[bloginfo name='WP bloginfo name' style='style-rules']</code>
    </li>

    <li><span class="wvr-blue">Vimeo - [vimeo]</span> - Display video from Vimeo responsively, with options
        <?php wvrx_ts_help_link('help.html#video','Help for Video');?><br />
        <code>[vimeo vimeo-url id=videoid sd=0 percent=100 center=1 color=#hex autoplay=0 loop=0 portrait=1 title=1 byline=1]</code>
    </li>

    <li><span class="wvr-blue">YouTube - [youtube]</span> - Display video from YouTube responsively, with options
        <?php wvrx_ts_help_link('help.html#video','Help for Video');?><br />
        <code>[youtube youtube-url id=videoid sd=0 percent=100 center=1 rel=0 privacy=0  see_help_for_others]</code>
    </li>
    </ul>
    <h3>Widgets</h3>
    <ul>
    <li><span class="wvr-blue">Weaver X Login Widget</span> - Simplified login widget
        <?php wvrx_ts_help_link('help.html#widg-login','Help for Login Widget');?>
    </li>

    <li><span class="wvr-blue">Weaver X Per Page Text</span> - Display text on a per page basis, based on a Custom Field value
        <?php wvrx_ts_help_link('help.html##widg_pp_text','Help for Per Page Text Widget');?>
    </li>

    <li><span class="wvr-blue">Weaver X Text 2</span> - Display text in two columns - great for wide top/bottom widgets
        <?php wvrx_ts_help_link('help.html#widg_text_2','Help for Two Column Text Widget');?>
    </li>
    </ul>
</div>
<?php
}
?>

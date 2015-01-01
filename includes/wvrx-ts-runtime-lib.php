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

add_filter('widget_text', 'do_shortcode');		// add shortcode processing to standard text widget


// Interface to Weaver Xtreme

add_action('weaverx_theme_support_addon','wvrx_ts_theme_support_addon');
function wvrx_ts_theme_support_addon() {
?>
<div class="a-plus">
	<p><strong style="font-size:110%;"><?php _e('You have Weaver Xtreme Theme Support installed.','weaver-xtreme' /*adm*/); ?></strong><br />
	<?php _e('This section shows the shortcodes and widgets available with Weaver X Theme Support.
Click the<span style="color:red; vertical-align: middle; margin-left:.25em;" class="dashicons dashicons-editor-help"></span> button to open help entry.','weaver-xtreme' /*adm*/); ?></p>
    <h3><?php _e('Shortcodes','weaver-xtreme' /*adm*/); ?></h3>
    <ul>
    <li><?php _e('<span class="wvr-blue">Blog Info - [bloginfo]</span> - Display blog info as provided by WordPress bloginfo function','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#bloginfo',__('Help for Blog Info','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e("[bloginfo name='WP bloginfo name' style='style-rules']",'weaver-xtreme' /*adm*/); ?></code>
    </li>
    <li><?php _e('<span class="wvr-blue">Box - [box]</span> - Display content in a Box','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#box',__('Help for Box','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e("[box background=#fff align=left border=true border_rule='border-css' border_radius=4 color=#000 margin=1 padding=1 shadow=1 style='style-rules' width=100]text[/box]",'weaver-xtreme' /*adm*/); ?></code>
    </li>
    <li><?php _e('<span class="wvr-blue">DIV - [div]text[/div]</span> - Wrap content in a &lt;div&gt; tag','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#scdiv',__('Help for Header Div','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e("[div id='class_id' class='class_name' style='style_values']text[/div]",'weaver-xtreme' /*adm*/); ?></code>
    </li>
    <li<?php _e('><span class="wvr-blue">Header Image - [header_image]</span> - Display default header image','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#headerimage',__('Help for Header Image','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e("[header_image h='size' w='size' style='inline-style']",'weaver-xtreme' /*adm*/); ?></code>
    </li>

    <li><?php _e('<span class="wvr-blue">HTML - [html]</span> - Wrap content in any HTML tag','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#schtml',__('Help for HTML','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e("[html html-tag args='parameters']",'weaver-xtreme' /*adm*/); ?></code>
    </li>
    <li><?php _e('<span class="wvr-blue">iFrame - [iframe]</span> - Display external content in an iframe','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#sciframe',__('Help for iframe','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e("[iframe src='http://example.com' height=600 percent=100 style='style']",'weaver-xtreme' /*adm*/); ?></code>
    </li>

    <li><?php _e('<span class="wvr-blue">Show If- [show_if]</span> - Show content only if args meet specified conditions','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#scshowif',__('Help for Show/Hide If','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e('[show|hide_if device=device logged_in=true/false not_post_id=id-list post_id=id-list user_can=what]text[/show|hide_if]','weaver-xtreme' /*adm*/); ?></code>
    </li>
    <li><?php _e('<span class="wvr-blue">Hide If - [hide_if]</span> - Hide content','weaver-xtreme' /*adm*/); ?>
    </li>

    <li><?php _e('<span class="wvr-blue">Site Tagline - [site_tagline]</span> - Display the site tagline','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#sitetitlesc',__('Help for Site Tagline','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e("[site_tagline style='inline-style']",'weaver-xtreme' /*adm*/); ?></code>
    </li>
    <li><?php _e('<span class="wvr-blue">Site Title - [site_title]</span> - Display the site title','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#sitetitlesc',__('Help for Site Title','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e("[site_title style='inline-style']",'weaver-xtreme' /*adm*/); ?></code>
    </li>
    <li><?php _e('<span class="wvr-blue">SPAN - [span]text[/span]</span> - Wrap content in a &lt;span&gt; tag','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#scdiv',__('Help for Span','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e("[span id='class_id' class='class_name' style='style_values']text[/span]",'weaver-xtreme' /*adm*/); ?></code>
    </li>
    <li><?php _e('<span class="wvr-blue">Tab Group - [tab_group]</span> - Display content on separate tabs','weaver-xtreme' /*adm*/);?>
        <?php wvrx_ts_help_link('help.html#tab_group',__('Help for Tab Group','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e('[tab_group][tab]...[/tab][tab]...[/tab][/tab_group]','weaver-xtreme' /*adm*/); ?></code>
    </li>
    <li><?php _e('<span class="wvr-blue">Vimeo - [vimeo]</span> - Display video from Vimeo responsively, with options','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#video',__('Help for Video','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e('[vimeo vimeo-url id=videoid sd=0 percent=100 center=1 color=#hex autoplay=0 loop=0 portrait=1 title=1 byline=1]','weaver-xtreme' /*adm*/); ?></code>
    </li>

    <li><?php _e('<span class="wvr-blue">YouTube - [youtube]</span> - Display video from YouTube responsively, with options','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#video',__('Help for Video','weaver-xtreme' /*adm*/));?><br />
        <code><?php _e('[youtube youtube-url id=videoid sd=0 percent=100 center=1 rel=0 privacy=0  see_help_for_others]','weaver-xtreme' /*adm*/); ?></code>
    </li>
    </ul>
    <h3><?php _e('Widgets','weaver-xtreme' /*adm*/); ?></h3>
    <ul>
    <li><?php _e('<span class="wvr-blue">Weaver X Login Widget</span> - Simplified login widget','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#widg-login',__('Help for Login Widget','weaver-xtreme' /*adm*/));?>
    </li>

    <li><?php _e('<span class="wvr-blue">Weaver X Per Page Text</span> - Display text on a per page basis, based on a Custom Field value','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html##widg_pp_text',__('Help for Per Page Text Widget','weaver-xtreme' /*adm*/));?>
    </li>

    <li><?php _e('<span class="wvr-blue">Weaver X Text 2</span> - Display text in two columns - great for wide top/bottom widgets','weaver-xtreme' /*adm*/); ?>
        <?php wvrx_ts_help_link('help.html#widg_text_2',__('Help for Two Column Text Widget','weaver-xtreme' /*adm*/));?>
    </li>
    </ul>
</div>
<?php
}
?>

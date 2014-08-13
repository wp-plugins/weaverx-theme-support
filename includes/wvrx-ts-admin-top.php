<?php
/*
Weaver X Theme Support - admin code

This code is Copyright 2011 by Bruce E. Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.txt.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

require_once(dirname( __FILE__ ) . '/wvrx-ts-admin-lib.php'); // NOW - load the admin stuff
require_once(dirname( __FILE__ ) . '/wvrx-ts-shortcodes-admin.php'); // NOW - load the admin stuff

function wvrx_ts_admin_page() {
    wvrx_ts_submits();
?>

<div class="atw-wrap">
    <h2>Weaver X Theme Support - Settings and Help - Version <?php echo WVRX_TS_VERSION;?> </h2>
    <hr />
<p>This page shows all the shortcodes available with Weaver X Theme Support.
Most of the shortcode tabs provide a brief summary of the shortcodes options.
The "Slider" shortcode includes some settings needed to enable some of its features.</p>

<p style="font-weight:bold;">You can get more complete help for any of these shortcodes by clicking the "Shortcode Help" tab.</p>

<div id="tabwrap_plus" style="padding-left:5px;">
    <div id="tab-container-plus" class='yetiisub'>
	<ul id="tab-container-plus-nav" class='yetiisub'>

    <li><a href="#ctabtab" style="background:#D4FAC3;" title="Tab Group"><?php echo(wvrx_ts_t_('Tab Group' /*a*/ )); ?></a></li>

    <li><a href="#sctabmobile" style="background:#FCDEE4;" title="Hide Mobile Shortcode"><?php echo(wvrx_ts_t_('Hide Mobile' /*a*/ )); ?></a></li>
    <li><a href="#sctabloggedin" style="background:#FCDEE4;" title="Show/Hide Logged In Shortcodes"><?php echo(wvrx_ts_t_('Show/Hide Logged In' /*a*/ )); ?></a></li>


    <li><a href="#sctabhdr" style="background:#FFCC33;" title="Header Image Shortcode"><?php echo(wvrx_ts_t_('Header Img' /*a*/ )); ?></a></li>
    <li><a href="#sctabhtml" style="background:#FFCC33;" title="HTML Shortcode"><?php echo(wvrx_ts_t_('HTML' /*a*/ )); ?></a></li>
    <li><a href="#sctabdiv" style="background:#FFCC33;" title="DIV Shortcode"><?php echo(wvrx_ts_t_('div,span' /*a*/ )); ?></a></li>
    <li><a href="#sctabiframe" style="background:#FFCC33;" title="iframe Shortcode"><?php echo(wvrx_ts_t_('iframe' /*a*/ )); ?></a></li>



    <li><a href="#sctabstitle" style="background:#FFCC33;" title="Site Title/Desc Shortcodes"><?php echo(wvrx_ts_t_('Site Title/Desc' /*a*/ )); ?></a></li>
    <li><a href="#sctabvodep" style="background:#FFCC33;" title="Video Shortcodes"><?php echo(wvrx_ts_t_('Video' /*a*/ )); ?></a></li>

    <li style="clear:both;margin-left:60px;margin-top:3px;"><a href="#xtab5" style="background:#FFFF00;"><?php echo(wvrx_ts_t_('Shortcode Help' /*a*/ )); ?></a></li>

	</ul>
        <hr />

<?php   /* IMPORTANT - in spite of the id's, these MUST be in the correct order - the same as the above list... */
?>


        <div id="ctabtab" class="tab_plus" > <!-- Tab Group -->
<?php
            if (function_exists('wvrx_ts_tabgroup_admin')) {
                wvrx_ts_tabgroup_admin();
            }
?>
	</div>

        <!-- ******* -->

        <div id="sctabmobile" class="tab_plus" > <!-- Show/Hide Mobile -->
<?php
        if (function_exists('wvrx_ts_hide_mobile_admin')) {
            wvrx_ts_hide_mobile_admin();
	}
 ?>
        </div>

	<div id="sctabloggedin" class="tab_plus" > <!-- Show/Hide Logged In -->
<?php
        if (function_exists('wvrx_ts_showhide_logged_in_admin')) {
            wvrx_ts_showhide_logged_in_admin();
	}
 ?>
        </div>

        <!-- ******* -->

	<div id="sctabhdr" class="tab_plus" > <!-- Header Image -->
<?php
        if (function_exists('wvrx_ts_headerimg_admin')) {
            wvrx_ts_headerimg_admin();
	}
 ?>
        </div>


	<div id="sctabhtml" class="tab_plus" > <!-- HTML -->
<?php
        if (function_exists('wvrx_ts_sc_html_admin')) {
            wvrx_ts_sc_html_admin();
	}
 ?>
        </div>

	<div id="sctabdiv" class="tab_plus" > <!-- DIV -->
<?php
        if (function_exists('wvrx_ts_sc_div_admin')) {
            wvrx_ts_sc_div_admin();
	}
 ?>
        </div>

	<div id="sctabiframe" class="tab_plus" > <!-- iframe -->
<?php
        if (function_exists('wvrx_ts_sc_iframe_admin')) {
            wvrx_ts_sc_iframe_admin();
	}
 ?>
        </div>


	<div id="sctabstitle" class="tab_plus" > <!-- Site Title/Description -->
<?php
        if (function_exists('wvrx_ts_sitetitle_admin')) {
            wvrx_ts_sitetitle_admin();
	}
 ?>
        </div>


	<div id="sctabvodep" class="tab_plus" > <!-- Video -->
<?php
        if (function_exists('wvrx_ts_video_admin')) {
            wvrx_ts_video_admin();
	}
 ?>
        </div>

        <!-- ******* -->


        <div id="xtab5" class="tab_plus" >      <!-- Help -->
            <span style="color:blue;font-weight:bold; font-size: larger;"><b>Weaver X Theme Support Short Codes Help</b></span>&nbsp;
<?php wvrx_ts_help_link('help.html','Help for Weaver X Theme Support'); ?>
<br />
<h3 style="color:green;text-decoration:underline;">Shortcode Summary</h3>
<ul>
    <li><b>Tab Group - [tab_group]</b> - Display content on separate tabs</li>
    <li><b>Hide Mobile - [hide_mobile]</b> - Hide content on devices - phone, smalltablet, desktop</li>
    <li><b>Show If Logged In - [show_if_logged_in]</b> - Show content only if logged in</li>
    <li><b>Hide If Logged In - [hide_if_logged_in]</b> - Hide content if logged in</li>
    <li><b>Header Image - [header_image]</b> - Display default header image</li>
    <li><b>HTML - [html]</b> - Wrap content in any HTML tag</li>
    <li><b>DIV - [div]text[/div]</b> - Wrap content in a &lt;div&gt; tag</li>
    <li><b>SPAN - [span]text[/span]</b> - Wrap content in a &lt;span&gt; tag</li>
    <li><b>iFrame - [iframe]</b> - Display external content in an iframe</li>
    <li><b>Site Title - [site_title]</b> - Display the site title</li>
    <li><b>Site Tagline - [site_tagline]</b> - Display the site tagline</li>
    <li><b>User Can - [user_can role="role" alttext="text if can't'"] if has role[/user_can]</b> - Display content if user has given role</li>
    <li><b>Blog Info - [bloginfo]</b> - Display blog info as provided by WordPress bloginfo function</li>
    <li><b>Vimeo - [vimeo]</b> - Display video from Vimeo responsively, with options</li>
    <li><b>YouTube - [youtube]</b> - Display video from YouTube responsively, with options</li>
</ul>
<h3 style="color:green;text-decoration:underline;">Widget Summary</h3>
<ul>
    <li><b>Weaver X Login Widget</b> - Simplified login widget</li>
    <li><b>Weaver X Per Page Text</b> - Display text on a per page basis, based on a Custom Field value</li>
    <li><b>Weaver X Text 2</b> - Display text in two columns - great for wide top/bottom widgets</li>
</ul>

    </div>
</div> <!-- #tabwrap_plus -->
<hr />
</div>

<script type="text/javascript">
	var tabber2 = new Yetii({
	id: 'tab-container-plus',
	tabclass: 'tab_plus',
	persist: true
	});
</script>


<?php
} // end wvrx_ts_admin



function wvrx_ts_t_($s) {
    return $s;
}


function wvrx_ts_submits() {
    // process settings for plugin parts

    if (!wvrx_ts_submitted('wvrx_ts_save_options')) {		// did they submit anything?
	return;
    }

    $actions = array('wvrx_ts_save_global_opts'
        );


    foreach ($actions as $functionName) {
	if (isset($_POST[$functionName])) {
            if (function_exists($functionName)) {
		$functionName();
	    }
        }
    }
}

// ======================== options handlers ==========================


function wvrx_ts_save_global_opts() {
    // global options
    $checkboxes = array('generic_shortcodes');

    foreach ($checkboxes as $opt) {
        if (isset($_POST[$opt])) wvrx_ts_setopt($opt, true);
        else wvrx_ts_setopt($opt, false, false);
    }
    wvrx_ts_save_all_options();    // and save them to db
    wvrx_ts_save_msg('Global Options saved');
}

?>

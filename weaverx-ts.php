<?php
/*
Plugin Name: Weaver X Theme Support
Plugin URI: http://weavertheme.com/plugins
Description: Weaver X Theme Support - a package of useful shortcodes and widgets that integrates closely with the Weaver X theme. This plugin Will also allow you to switch from Weaver X to any other theme and still be able to use the shortcodes and widgets from Weaver X with minimal effort.
Author: wpweaver
Author URI: http://weavertheme.com/about/
Version: 0.8

License: GPL

Weaver X Theme Support

Copyright (C) 2014, Bruce E. Wampler - weaver@weavertheme.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/* CORE FUNCTIONS
*/

define ('WVRX_TS_VERSION','0.8');
define ('WVRX_TS_MINIFY','.min');		// '' for dev, '.min' for production
define ('WVRX_TS_APPEARANCE_PAGE', false );

function wvrx_ts_installed() {
    return true;
}


function wvrx_ts_plugins_url($file,$ext) {
    return plugins_url($file,__FILE__) . $ext;
}

function wvrx_ts_enqueue_scripts() {	// action definition

    if (function_exists('wvrx_ts_slider_header')) wvrx_ts_slider_header();

    //-- Weaver X PLus js lib - requires jQuery...


    // put the enqueue script in the tabs shortcode where it belongs

    //wp_enqueue_script('wvrxtsJSLib', wvrx_ts_plugins_url('/js/wvrx-ts-jslib', WVRX_TS_MINIFY . '.js'),array('jquery'),WVRX_TS_VERSION);


    // add plugin CSS here, too.

    wp_register_style('wvrx-ts-style-sheet',wvrx_ts_plugins_url('weaverx-ts-style', WVRX_TS_MINIFY.'.css'),null,WVRX_TS_VERSION,'all');
    wp_enqueue_style('wvrx-ts-style-sheet');
}

add_action('wp_enqueue_scripts', 'wvrx_ts_enqueue_scripts' );


require_once(dirname( __FILE__ ) . '/includes/wvrx-ts-runtime-lib.php'); // NOW - load the basic library
require_once(dirname( __FILE__ ) . '/includes/wvrx-ts-widgets.php'); 		// widgets runtime library

require_once(dirname( __FILE__ ) . '/includes/wvrx-ts-shortcodes.php'); // load the shortcode definitions

// ======================================== subthemes ========================================
    add_action('weaverx_child_show_extrathemes','wvrx_ts_child_show_extrathemes_action');

function wvrx_ts_child_show_extrathemes_action() {
    echo '<h3 class="atw-option-subheader">Select an Add-on Subtheme You Have Uploaded</h3>';
    $addon_dir = weaverx_f_uploads_base_dir() . 'weaverx-subthemes/addon-subthemes/';
    $addon_url = weaverx_f_uploads_base_url() . 'weaverx-subthemes/addon-subthemes/';

    $addon_list = array();
    if($media_dir = @opendir($addon_dir)) {	    // build the list of themes from directory
        while ($m_file = readdir($media_dir)) {
            $len = strlen($m_file);
            $base = substr($m_file,0,$len-4);
            $ext = $len > 4 ? substr($m_file,$len-4,4) : '';
            if($ext == '.wxt' ) {
                $addon_list[] = $base;
            }
        }
    }

    if (!empty($addon_list)) {
        natcasesort($addon_list);

        $cur_addon = weaverx_getopt('wvrx_addon_name');
        if ($cur_addon)
            echo '<h3>Currently selected Add-on Subtheme: ' . ucwords(str_replace('-',' ',$cur_addon)) . '</h3>';
?>
    <form enctype="multipart/form-data" name='pick_added_theme' action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method='post'>

     <h4>Select an add-on subtheme: </h4>

<?php
        foreach ($addon_list as $addon) {
            $name = ucwords(str_replace('-',' ',$addon));
?>
            <div style="float:left; width:200px;">
            <label><input type="radio" name="wvrx_addon_name"
<?php	    echo 'value="' . $addon . '"' . (weaverx_getopt('wvrx_addon_name') == $addon ? 'checked' : '') .
            '/> <strong>' . $name . '</strong><br />
            <img style="border: 1px solid gray; margin: 5px 0px 10px 0px;" src="' . $addon_url . $addon . '.jpg" width="150px" height="113px" /><label></div>' . "\n";
        }
?>
        <div style="clear:both;"></div>
        <br /><span class='submit'><input name="set_added_subtheme" type="submit" value="Set to Selected Add-on Subtheme" /></span>
        <small style="color:#b00;"><br /><strong>Note:</strong> Selecting a new subtheme will change only theme related settings.
    Options labelled with (&diams;) will be retained.
	You can use the Save/Restore tab to save a copy of all your current settings first.</small>

        <?php weaverx_nonce_field('set_added_subtheme'); ?>

        <br /><br /><span class='atw-small-submit' style="margin-left:100px;"><input name="delete_added_subtheme" type="submit" value="Delete Selected Add-on Subtheme" /></span> &nbsp;<small>This will delete the selected Add-on Subtheme from the Add-on directory</small>
        <?php weaverx_nonce_field('delete_added_subtheme'); ?>
        </form>
<?php
    } else {
?>
	<p>No Add-on Subthemes available.</p>
<?php
    }
    echo '<h3 class="atw-option-subheader">Upload an Add-on Subtheme From Your Computer</h3>';
?>
    <p>You can find additional free and premium Add-on Subthemes for <em>Weaver Xtreme</em>
    <a href="http://xtreme.weavertheme.com/add-on-subthemes/" title="Weaver Xtreme Add-on Subthemes"><strong>HERE</strong></a>.</p>
<form name='form_added_theme' enctype="multipart/form-data" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST">
    <table>
	<tr valign="top">
	    <td><strong>Select Add-on Subtheme .zip file to upload:</strong>
		<input name="uploaded_addon" type="file" />
		<input type="hidden" name="uploadaddon" value="yes" />
            </td>
	</tr>
        <tr><td>
	    <span style="margin-left:50px;" class='submit'>
		<input name="upload_addon" type="submit" value="Upload Add-on Subtheme" /><br />
	    </span>&nbsp;<small><strong>Upload and Save</strong> an Add-on Subtheme or Subtheme collection from .zip file on your computer. Will be saved on your site's filesystem.</small>
	</td></tr>
    </table>
    <?php weaverx_nonce_field('upload_addon'); ?>
</form>

<?php
}

add_action('weaverx_child_process_options','wvrx_ts_child_process_options');
function wvrx_ts_child_process_options() {

    if (weaverx_submitted('set_added_subtheme') ) {	// Set to selected addon - theme
        if (isset($_POST['wvrx_addon_name']))
        {
            $name = $_POST['wvrx_addon_name'];

            $openname = weaverx_f_uploads_base_dir() . 'weaverx-subthemes/addon-subthemes/' . $name . '.wxt';
            $contents = file_get_contents($openname);

                if (!weaverx_ex_set_current_to_serialized_values($contents,'weaverx_uploadit:'.$openname)) {
                    echo '<div id="message" class="updated fade"><p><strong><em style="color:red;">Sorry,
            there was a problem uploading your add on theme. The name you picked did not have a valid
            Weaver Xtreme theme file in the /weaverx-subthemes/addon-subthemes directory.</em></strong></p></div>';
            } else {
                weaverx_save_msg('Weaver Xtreme theme reset to ' .
                 ucwords(str_replace('-',' ',$name )) . ' add-on subtheme.');
                weaverx_setopt('wvrx_addon_name',$name);
            }
        }
    }

    else if (weaverx_submitted('delete_added_subtheme') ) {	// Delete selected addon theme
        if (isset($_POST['wvrx_addon_name']))
        {
            $name = $_POST['wvrx_addon_name'];
            @unlink(weaverx_f_uploads_base_dir() . 'weaverx-subthemes/addon-subthemes/' . $name . '.wxt');
            @unlink(weaverx_f_uploads_base_dir() . 'weaverx-subthemes/addon-subthemes/' . $name . '.jpg');
            weaverx_save_msg('Deleted ' .
                ucwords(str_replace('-',' ',$name )) . ' add-on subtheme.');
        }
    }

    else if (weaverx_submitted('upload_addon')
	&& isset($_POST['uploadaddon'])
	&& $_POST['uploadaddon'] == 'yes') {
        // upload theme from users computer
        // they've supplied and uploaded a file
        $ok = wvrx_ts_wunpackzip('uploaded_addon', weaverx_f_uploads_base_dir() . 'weaverx-subthemes/addon-subthemes/');
    }

}

function wvrx_ts_wunpackzip($uploaded, $to_dir) {
    // upload theme from users computer
    // they've supplied and uploaded a file
    // This version and the one in Aspen Plus must be identical...

    $ok = true;     // no errors so far

    if (isset($_FILES[$uploaded]['name']))	// uploaded_addon
        $filename = $_FILES[$uploaded]['name'];
    else
        $filename = "";

    if (isset($_FILES[$uploaded]['tmp_name'])) {
        $openname = $_FILES[$uploaded]['tmp_name'];
    } else {
        $openname = "";
    }

    //Check the file extension
    $check_file = strtolower($filename);
    $per = '.';
    $end = explode($per, $check_file);		// workaround for PHP strict standards warning
    $ext_check = end($end);

    if (false && !weaverx_f_file_access_available()) {
        $errors[] = "Sorry - Aspen Theme unable to access files.<br />";
        $ok = false;
    }

    if ($filename == "") {
        $errors[] = "You didn't select a file to upload.<br />";
        $ok = false;
    }

    if ($ok && $ext_check != 'zip'){
        $errors[] = "Uploaded files must have <em>.zip</em> extension.<br />";
        $ok = false;
    }

    if ($ok) {
        if (!weaverx_f_exists($openname)) {
            $errors[] = '<strong><em style="color:red;">
Sorry, there was a problem uploading your file. You may need to check your folder permissions
or other server settings.</em></strong><br />' . "(Trying to use file '$openname')";
            $ok = false;
        }
    }

    if ($ok) {
        // should be ready to go, but check out WP_Filesystem
        if (! WP_Filesystem()) {
                function wvrx_ts_wvx_return_direct() { return 'direct'; }
                add_filter('filesystem_method', 'wvrx_ts_wvx_return_direct');
                $try2 = WP_Filesystem();
                remove_filter('filesystem_method', 'wvrx_ts_wvx_return_direct');
                if (!$try2) {
                    $errors[] = 'Sorry, there\'s a problem trying to use the WordPress unzip function. Please
    see the FAQ at weavertheme.com support for more information.';
                    $ok = false;
                }
        }
    }
    if ($ok) {
        // $openname has uploaded .zip file to use
        // $filename has name of file uploaded
        $is_error = unzip_file( $openname, $to_dir );
        if ( !is_wp_error( $is_error ) ) {
            weaverx_save_msg('File ' . $filename . ' successfully uploaded and unpacked to: <br />' . $to_dir);
            @unlink($openname);	// delete temp file...
        } else {
            $errors[] = "Sorry, unpacking the .zip you selected file failed. You may have a corrupt .zip file, or there many a file permissions problem on your WordPress installation.";
            $errors[] = $is_error->get_error_message();
            $ok = false;
        }
    }
    if (!$ok) {
        echo '<div id="message" class="updated fade"><p><strong><em style="color:red;">ERROR</em></strong></p><p>';
        foreach($errors as $error){
            echo $error.'<br />';
        }
        echo '</p></div>';
    }
    return $ok;
}


    add_action('weaverx_child_saverestore','wvrx_ts_child_saverestore_action');
function wvrx_ts_child_saverestore_action() {
    echo '<h3 class="atw-option-subheader" style="font-style:italic">Use the <em>Weaver Xtreme Subthemes</em>
 tab to upload Add-on Subthemes.</h3><p>You can upload extra add-on subthemes you\'ve downloaded using the
 Subthemes tab. Note: the Save and Restore options on this page are for the custom settings you
 have created. These save/restore options are not related to Add-on Subthemes, although you can
 modify an Add-on Subtheme, and save your changes here.</p>';
}

?>

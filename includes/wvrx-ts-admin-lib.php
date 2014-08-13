<?php

function wvrx_ts_help_link($ref, $label) {

    $t_dir = wvrx_ts_plugins_url('/help/' . $ref, '');
    $icon = wvrx_ts_plugins_url('/help/help.png','');
    $pp_help =  '<a href="' . $t_dir . '" target="_blank" title="' . $label . '">'
		. '<img class="entry-cat-img" src="' . $icon . '" style="position:relative; top:4px; padding-left:4px;" title="Click for help" alt="Click for help" /></a>';
    echo $pp_help ;
}


function wvrx_ts_save_msg($msg) {
    echo '<div id="message" class="updated fade" style="width:70%;"><p><strong>' . $msg .
	    '</strong></p></div>';
}
function wvrx_ts_error_msg($msg) {
    echo '<div id="message" class="updated fade" style="background:#F88;" style="width:70%;"><p><strong>' . $msg .
	    '</strong></p></div>';
}
/*
    ================= nonce helpers =====================
*/
function wvrx_ts_submitted($submit_name) {
    // do a nonce check for each form submit button
    // pairs 1:1 with wvrx_ts__nonce_field
    $nonce_act = $submit_name.'_act';
    $nonce_name = $submit_name.'_nonce';

    if (isset($_POST[$submit_name])) {
	if (isset($_POST[$nonce_name]) && wp_verify_nonce($_POST[$nonce_name],$nonce_act)) {
	    return true;
	} else {
	    die("WARNING: invalid form submit detected ($submit_name). Probably caused by session time-out, or, rarely, a failed security check. Please contact WeaverTheme.com if you continue to receive this message.");
	}
    } else {
	return false;
    }
}

function wvrx_ts_nonce_field($submit_name,$echo = true) {
    // pairs 1:1 with sumbitted
    // will be one for each form submit button

    return wp_nonce_field($submit_name.'_act',$submit_name.'_nonce',$echo);
}

/*
    ================= form helpers =====================
*/

function wvrx_ts_form_checkbox($id, $desc, $br = '<br />') {
?>
    <div style = "display:inline-block;padding-left:2.5em;text-indent:-1.7em;"><label><input type="checkbox" name="<?php echo $id ?>" id="<?php echo $id; ?>"
        <?php checked(wvrx_ts_getopt($id) ); ?> >&nbsp;
<?php   echo $desc . '</label></div>' . $br . "\n";
}
?>

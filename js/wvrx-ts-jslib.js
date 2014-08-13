/* *********************************************************************************
 * Weaver X Theme Support JavaScript support Library
 *
 * Author: WeaverTheme - www.weavertheme.com
 * @version 1.0
 * @license GNU Lesser General Public License, http://www.gnu.org/copyleft/lesser.html
 * @author  Bruce Wampler
 *
 * Notes - this library requires jQuery to be loaded
 *  this library was cobbled together over a long period of time, so it contains a
 *  bit of a jumble of straight JavaScript and jQuery calls. So it goes. It works.
 *
 *
 ************************************************************************************* */


jQuery(document).ready(function($) {		// self-defining function
    // Tabs
	$('.atw-tabs-nav').delegate('span:not(.atw-tabs-current)', 'click', function() {
		$(this).addClass('atw-tabs-current').siblings().removeClass('atw-tabs-current')
		.parents('.atw-tabs').find('.atw-tabs-pane').hide().eq($(this).index()).show();
	});
	$('.atw-tabs-pane').hide();
	$('.atw-tabs-nav span:first-child').addClass('atw-tabs-current');
	$('.atw-tabs-panes .atw-tabs-pane:first-child').show();

});

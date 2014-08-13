<?php
/*
Weaver X Shortcodes Admin - admin code

This code is Copyright 2011 by Bruce E. Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.txt.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

function wvrx_ts_headerimg_admin() {
?>
    <span style="color:blue;font-weight:bold; font-size: larger;"><b>Header Image - [header_image]</b></span>&nbsp;
<?php wvrx_ts_help_link('help.html#headerimage','Help for Header Image');
?>
<br />
<span style="font-style:italic;margin-left:2em;">;Alternative names:</span> <code>[weaver_header_image], [header_image]</code>
<br />
<p>The <code>[header_image]</code> shortcode allows you display the current header image wherever you want.
For example, you can get the header image into the Header Widget Area by using this shortcode in a text widget.
The current standard or mobile header image will be displayed. Only the <code>&lt;img ... &gt;</code> is displayed --
the image will not be wrapped in a link to the site.</p>

<p><strong>Shortcode usage:</strong> <code>[header_image h='size' w='size' style='inline-style']</code>

<ol>
    <li><strong>w='size' h='size'</strong> - By default, no height or image properties are included with the
    header <code>&lt;img ... &gt;</code>, which will result in an image scaled to fit into whatever the natural
    width of the enclosing HTML container is (the content area, a text widget, etc.). You may specify an explicit
    value (usually in px) for the height and width of the image.
    </li>
    <li><strong>style='inline-style-rules'</strong> - Allows you to add inline style to wrap output of the shortcode.
    Don't include the 'style=' or wrapping quotation marks. Do include a ';' at the end of each rule. The output will look like
    <code>style="your-rules;"</code> - using double quotation marks.
    </li>
    </ol>
</p>
<?php
}

function wvrx_ts_sc_html_admin() {

?>
    <span style="color:blue;font-weight:bold; font-size: larger;"><b>HTML - [html]</b></span>&nbsp;
<?php wvrx_ts_help_link('help.html#schtml','Help for HTML Shortcode');
?>
<br />
<span style="font-style:italic;margin-left:2em;">;Alternative names:</span> <code>[weaver_html], [html ...]</code>
<br />
<p>The Weaver X <code>[html]</code> shortcode allows you to add arbitrary HTML to your post and page content. The
main purpose of this shortcode is to get around the auto paragraph and line break and other HTML stripping functionality
of the WordPress editor. See the Help document for more details.</p>

<p><strong>Shortcode usage:</strong> <code>[html html-tag args='parameters']</code>

<ol>
    <li><strong>html-tag</strong> - The first parameter to the shortcode must be present, and must be a standard
    HTML tag - <code>p</code>, <code>br</code>, or <code>span</code>, for example. You just supply the tag - no quotation
    marks, no '=', just the tag. The shortcode provides the &lt; and &gt;. If you need a wrapping HTML tag (e.g., <code>span</code> and <code>/span</code>), use
    two shortcodes:<br />
    <code>[html span args='style="color:red"']content to make red[html /span]</code>
    </li>
    <li><strong>args='parameters'</strong> - Allows you to specify arbitrary parameters for your HTML tag. See the example above.
    </li>
</ol>
</p>
<?php
}

function wvrx_ts_sc_div_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>DIV - [div]text[/div]<br />SPAN - [span]text[/span]</b></span></label>&nbsp;
<?php wvrx_ts_help_link('help.html#scdiv','Help for div Shortcode');
?>
<br />
<span style="font-style:italic;margin-left:2em;">;Alternative names:</span> <code>[weaver_div], [div]</code>
<br />
<p>The Weaver X <code>[div]</code> and <code>[span]</code> shortcodes allow easily add HTML &lt;div&gt; and &lt;span&gt; tags
to your post and page content. The main purpose of these shortcodes is to get around need to switch to the HTML editor view when you need to
wrap your content in a &lt;div&gt; or &lt;span&gt;.</p>
<p>
	These will work exactly like a standard HMTL &lt;div&gt; or &lt;span&gt; tag. They support 'id', 'class',
    and 'style' parameters, which are the most useful. Instead of wrapping your text in &lt;div&gt; or &lt;span&gt; tags, wrap them like
    this (the Visual view will work just fine):<br />
    <code>[div style="font-size:20px;']This content will be large.[/div]</code> or <br />
    <code>[span style="font-size:20px;']This content will be large.[/span]</code> or <br />
</p>

<p><strong>Shortcode usage:</strong> <code>[div id='class_id' class='class_name' style='style_values']text[/div]</code>
<br /><code>[span id='class_id' class='class_name' style='style_values']text[/span]</code>
<br />
<ol>
    <li><strong>id='class_id' class='class_name' style='style_values'</strong> - Allows you to specify id, class, and style for the &lt;div&gt;. See the example above.
    </li>
</ol>
</p>
<?php
}

function wvrx_ts_sc_iframe_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>iFrame - [iframe]</b></span></label>&nbsp;
<?php wvrx_ts_help_link('help.html#sciframe','Help for iFrame');
?>
<br />
<span style="font-style:italic;margin-left:2em;">;Alternative names:</span> <code>[weaver_iframe], [iframe]</code>
<br />
<p>The <code>[iframe]</code> shortcode allows you easily display the content of an external site. You simply have to specify
the URL for the external site, and optionally a height. This shortcode automatically generates the correct HTML &lt;iframe&gt; code.</p>

<p><strong>Shortcode usage:</strong> <code>[iframe src='http://example.com' height=600 percent=100 style="style"]</code>
<br />
<ol>
    <li><strong>src='http://example.com'</strong> - The standard URL for the external site.
    </li>
    <li><strong>height=600</strong> - Optional height to allocate for the site - in px. Default is 600.
    </li>
    <li><strong>percent=100</strong> - Optional width specification in per cent. Default is 100%.
    </li>
    <li><strong>style="style"</strong> - Optional style values. Added to &lt;iframe&gt; tag as style="values" (shortcode adds double quotation marks).
    </li>
</ol>
</p>

<?php
}

function wvrx_ts_hide_mobile_admin() {
?>
    <span style="color:blue;font-weight:bold; font-size: larger;"><b>Hide Mobile - [hide_mobile]</b></span>&nbsp;
<?php wvrx_ts_help_link('help.html#showhidemobile','Help for Hide Mobile');
?>
<br />
<p>The <code>[hide_mobile]</code>shortcode allows you to selectively
display content depending if the visitor is using a standard browser or a mobile device browser. You might want
to disable a video on mobile devices.</p>

<p><strong>Shortcode usage:</strong> <code>[hide_mobile phone=0|1 smalltablet=0|1 desktop=0|1]content to hide[/hide_mobile]</code>
</p>
<p>You bracket the content you want to selectively display with <code>[hide_mobile]</code> and closing
<code>[/hide_mobile]</code> tags. That content can contain other shortcodes as needed.
</p>
<p>
The parameters for <code>[hide_mobile]</code> are designed to allow you to hide <em>or</em> show any content on and of the
three device sizes recognized by Weaver X: 'phone', 'smalltablet', and 'desktop'. If you want to <strong>hide</strong> content on
a specific device, you give the appropriate parameter a value of 1 (e.g., <code>[hide_mobile desktop=1]</code>). If you want to <strong>show</strong> content
on a specific device, you give the parameter a value of 0 (e.g., <code>[hide_mobile phone=0]</code>). Because this shortcode will typically be
used to <em>hide</em> content, the default is to hide on 'phone' and 'smalltablet' if you don't specify any values. So,
<code>[hide_mobile]content[/hide_mobile]</code> is the same as <code>[hide_mobile phone=1 smalltablet=1 desktop=0]content[/hide_mobile]</code>. You can use
the default values, or always specify 'phone', 'smalltablet', and 'desktop'.
</p>
<?php
}

function wvrx_ts_showhide_logged_in_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Show If Logged In - [show_if_logged_in]</b></span></label>&nbsp;
<?php wvrx_ts_help_link('help.html#showhideloggedin','Help for Show/Hide if Logged In');
?>
<br />
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Hide If Logged In - [hide_if_logged_in]</b></span></label>
<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_show/hide_if_logged_in], [show/hide_if_logged_in]</code>
<br />
<p>The <code>[show_if_logged_in]</code> and <code>[hide_if_logged_in]</code>shortcodes allow you to selectively
display content depending if the visitor is logged in or not.</p>

<p><strong>Shortcode usage:</strong> <code>[show_if_logged_in]content to show[/show_if_logged_in]</code>
</p>
<p>You bracket the content you want to selectively display with <code>[show_if_logged_in] or [hide_if_logged_in]</code>
and closing tags <code>[/show_if_logged_in]</code> or
<code>[/hide_if_logged_in]</code>. That content can contain other shortcodes as needed. </p>


<?php
}

function wvrx_ts_show_posts_admin() {
?>
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Show Posts - [show_posts]</b></span></label>&nbsp;
<?php wvrx_ts_help_link('help.html#showposts','Help for Weaver X Theme Support'); ?>
<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_show_posts], [show_posts]</code>
<br />
<p>The Weaver X <code>[show_posts]</code> shortcode allows you to display posts on your pages or in a text widget
in the sidebar. You can specify a large number of filtering options to select a specific set of posts to show.</p>
<p>
<strong>Summary of all parameters, shown with default values.</strong> You don't need to supply every
option when you add the [show_posts] to your own content. The options available for this short code allow
you a lot of flexibility id displaying posts. A full description of all the parameters
is included in the Help file - <em>please</em> read it to learn more about this shortcode. Just click the ? above.</p>
<p>
<em>[show_posts cats="" tags="" author="" author_id="" single_post="" post_type='' orderby="date" sort="DESC" number="5" paged=false show="full" hide_title=""
hide_top_info="" hide_bottom_info="" show_featured_image="" hide_featured_image="" show_avatar="" show_bio="" excerpt_length="" style=""
class="" header="" header_style="" header_class="" more_msg="" left=0 right=0 clear=0]</em>
</p>
<?php
}

function wvrx_ts_sitetitle_admin() {
?>
    <span style="color:blue;font-weight:bold; font-size: larger;"><b>Site Title - [site_title]</b></span>&nbsp;
<?php wvrx_ts_help_link('help.html#sitetitlesc','Help for Site Title and Tagline');
?>
<br />
<span style="color:blue;font-weight:bold; font-size: larger;"><b>Site Tagline - [site_tagline]</b></span>

<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_site_title/desc], [site_title/desc]</code>
<br />
<p>The <code>[site_title]</code> and <code>[site_tagline]</code> shortcodes allow you display the current
site title and site tagline. (Site Tagline was formerly called Site Description.) This can be useful in a text widget in the Header Widget Area, for example.</p>
<p><em>Note:</em> If you want to position the content of a text widget within the a cell of the Header Widget Area, you could use the following
example:</p>
    <p><code>[site_title style='font-size:150%;position:absolute;padding-left:20px;padding-top:30px;']</code></p>

<p><strong>Shortcode usage:</strong> <code>[site_title style='inline-style'] [site_tagline style='inline-style']</code>
<br />
<ol>
    <li><strong>style='inline-style-rules'</strong> - Allows you to add inline style to wrap output of the shortcode.
    Don't include the 'style=' or wrapping quotation marks. Do include a ';' at the end of each rule. The output will look like
    <code>style="your-rules;"</code> - using double quotation marks.
    </li>
</ol>
</p>

<?php
}

function wvrx_ts_video_admin() {
?>
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Vimeo - [vimeo]</b></span></label>&nbsp;
<?php wvrx_ts_help_link('help.html#video','Help for Video shortcodes');
?>
<br /><label><span style="color:blue;font-weight:bold; font-size: larger;"><b>YouTube - [youtube]</b></span></label>
<br />

<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_vimeo/youtube], [vimeo/youtube]</code>
<br />
<p>The Weaver X Theme Support plugin supports specialized shortcodes to display video. While there are other ways to embed video, the Weaver X versions have two important features. First, when used with the Weaver X theme, they will auto adjust to the width of your content, <em><strong>including</strong></em> the mobile view. Second, they use the latest iframe/HTML5 interface provided by YouTube and Vimeo.</p>
<h4>Vimeo</h4>
<strong>Shortcode usage:</strong> <code>[vimeo vimeo-url id=videoid sd=0 w=640/percent=100 ratio=.5625 center=1 color=#hex autoplay=0 loop=0 portrait=1 title=1 byline=1]</code>

<p>This will display Vimeo videos. At the minimum, you can provide the standard http://vimeo.com/nnnnn link, or just the video ID number (which is part of the Vimeo Link). The other options are explained in the Help document</p>
<h4>YouTube</h4>
<strong>Shortcode usage:</strong> <code>[youtube youtube-url id=videoid sd=0 w=640/percent=100 ratio=.5625 center=1 rel=0 https=0 privacy=0  see_help_for_others]</code>
<p>This will display YouTube videos. At the minimum, you can provide the standard http://youtu.be/xxxxxx share link (including the options YouTube lets you specify), the long format share link, or just the video ID number (which is part of the YouTube Link). The other options are explained in the Help document</p>
<p>Specifying a percent will cause the video to be displayed using that percentage of the width of the containing element (content, widget).The videos will auto-resize as you shrink the browser width. If you specify a width (w=640), then that width will be used,
overriding any percent you may have specified, and
the videos will not auto-shrink. This setting is useful when used with an [slider].</p>

<h3 style="color:blue;">Responsive Video Display</h3>

<p>
When used with the Weaver X theme, the videos displayed by these shortcodes, and in fact any videos displayed using standard
YouTube or Vimeo embed codes, will be automatically responsively sized using the FitVids script.
</p>

<?php
}


function wvrx_ts_tabgroup_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Tab Group - [tab_group]</b></span></label>&nbsp;
<?php wvrx_ts_help_link('help.html#tab_group','Help for [tab_group]'); ?>
<br />
<span style="font-style:italic;margin-left:2em;">Alternative names:</span> <code>[weaver_tab_group], [tab_group]</code>
<br />
<p>Show content displayed on tabbed pages.</p>
<p><strong>Shortcode usage:</strong><br>
<pre>
[tab_group border_color=black page_min_height=200px]
    [tab title='tab one']This is the content found on first tab.[/tab]
    [tab title='tab two']And we have more content for the second tab.[/tab]
    [tab title='last tab']And this is the last tab. There could be more.[/tab]
[/tab_group]
</pre>

</p>
<p>
<h4>Short code parameters</h4>
You can supply values for these parameters to control the look of the tabbed section.
<br />
<ul>
    <li><b>border_color:</b> tab and pane border color - default #888</li>
    <li><b>tab_bg</b>: normal bg color of tab (default #CCC)</li>
    <li><b>tab_selected_color</b>: color of tab when selected (default #EEE)</li>
    <li><b>pane_min_height</b>: min height of a pane to help make all even if needed</li>
    <li><b>pane_bg</b>: bg color of pane</li>
</ul>
</p>

<?php
}
?>

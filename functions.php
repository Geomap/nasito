<?php

if (!session_id()) {
	session_start();
}
include TEMPLATEPATH."/inc/library.php";
$settingsfile='settings';
$defparamsfile="defaults";
$default='global|slider|layout|seo|translations';
	$rightargs = array(
		'before_widget' => '<div class="widget2 %2$s"><div class="inner">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="caption"><h3>',
        'after_title' => '</h3></div>'
	);
	$footerargs = array(
		'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<div class="caption"><h3>',
        'after_title' => '</h3></div>'
	);

if ( function_exists('register_sidebar') ) {
	$sidebar='default';
    register_sidebar(array(
        'name' => 'Right Sidebar',
        'id' => 'right_sidebar',
        'description' =>'The right sidebar widget area',
        'before_widget' => '<div class="widget2 %2$s"><div class="inner">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="caption"><h3>',
        'after_title' => '</h3></div>'
    ));
	
	register_sidebar(array(
        'name' => 'Left Sidebar',
        'id' => 'left_sidebar',
        'description' =>'The left sidebar widget area',
        'before_widget' => '<div class="widget2 %2$s"><div class="inner">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="caption"><h3>',
        'after_title' => '</h3></div>'
    ));
	
	$$sidebar='footer';
	register_sidebar(array(
        'name' => 'Footer 1',
        'id' => 'footer_1',
        'description' => 'The primary sidebar widget area',
        'before_widget' => '<div class="%2$s">',
        'after_widget' => '</div>',
         'before_title' => '<div class="caption"><h3>',
        'after_title' => '</h3></div>'
    ));
	register_sidebar(array(
        'name' => 'Footer 2',
        'id' => 'footer_2',
        'description' => 'The primary sidebar widget area',
        'before_widget' => '<div class="%2$s">',
        'after_widget' => '</div>',
         'before_title' => '<div class="caption"><h3>',
        'after_title' => '</h3></div>'
    ));
	register_sidebar(array(
        'name' => 'Footer 3',
        'id' => 'footer_3',
        'description' => 'The primary sidebar widget area',
        'before_widget' => '<div class="%2$s">',
        'after_widget' => '</div>',
         'before_title' => '<div class="caption"><h3>',
        'after_title' => '</h3></div>'
    ));
	register_sidebar(array(
        'name' => 'Tabs',
        'id' => 'tabs_sidebar',
        'description' => 'The primary sidebar widget area',
        'before_widget' => '<dd><ul class="widget-container"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul></dd>',
        'before_title' => '<dt class="tab_widget_dt">',
        'after_title' => '</dt>'
    ));
}
$settings=$default;
$SMTheme=new SMTheme;
include TEMPLATEPATH."/inc/widgets/facebook.php";
include TEMPLATEPATH."/inc/widgets/banners.php";
include TEMPLATEPATH."/inc/widgets/comments.php";
include TEMPLATEPATH."/inc/widgets/posts.php";
include TEMPLATEPATH."/inc/widgets/social-profiles.php";
include TEMPLATEPATH."/inc/widgets/video.php";
include TEMPLATEPATH."/inc/widgets/flickr.php";
include TEMPLATEPATH."/inc/widgets/tabs.php";

if ($_SESSION['commentinput']=='') {
	$_SESSION['commentinput']=substr(md5(rand(1,234234)),0,5);
}
if (isset($_POST[$_SESSION['commentinput']])) {
	$_POST['comment']=$_POST[$_SESSION['commentinput']];
}
if (function_exists('add_theme_support')) {
	add_theme_support('automatic-feed-links');
    add_theme_support('menus');
	add_theme_support( 'post-thumbnails' ); 
	set_post_thumbnail_size( $SMTheme->get( 'layout', 'imgwidth' ), $SMTheme->get( 'layout', 'imgheight' ) , true );
}

if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'sec-menu', 'Top Menu' );
    register_nav_menu( 'main-menu', 'Main Menu' );
	
	
}
	if ( current_user_can('administrator') ) {
        include (TEMPLATEPATH."/inc/administrator.php");
        $APage = new AdminPage();
    }


	$SMTheme->prepare_func('right_sidebar', 'show_right_sidebar_widgets');
	$SMTheme->prepare_func('left_sidebar', 'show_left_sidebar_widgets');
	$SMTheme->prepare_func('footer_1', 'show_footer_1_widgets');
	$SMTheme->prepare_func('footer_2', 'show_footer_2_widgets');
	$SMTheme->prepare_func('footer_3', 'show_footer_3_widgets');
	$SMTheme->prepare_func('tabs_sidebar', 'show_tabs_sidebar_widgets');
	
	
	
	function show_tabs_sidebar_widgets() {
		$rightargs=array('before_widget' => '<dd><ul class="widget-container"><li class="widget widget_categories">',
        'after_widget' => '</li></ul></dd>',
        'before_title' => '<dt class="tab_widget_dt">',
        'after_title' => '</dt>');
		$instance['hierarchical']='1';
		the_widget('WP_Widget_Categories', $instance, $rightargs);
		$rightargs=array('before_widget' => '<dd><ul class="widget-container"><li class="widget widget_recent_entries">',
        'after_widget' => '</li></ul></dd>',
        'before_title' => '<dt class="tab_widget_dt">',
        'after_title' => '</dt>');
		unset($instance);
		the_widget('WP_Widget_Recent_Posts', $instance, $rightargs);
	}
	
	function show_right_sidebar_widgets() {
		global $rightargs;
		$instance = array(
		'width' =>'200',
        'title' => 'Video',
        'videos' => array(
				array(
					'title' => 'The Mountain', 
					'url' => 'http://vimeo.com/22439234/', 
					'type' => 'vimeo', 
					'videoid' => '22439234'
				),
				array(
					'title' => 'Amazing nature scenery', 
					'url' => 'http://www.youtube.com/watch?v=6v2L2UGZJAM', 
					'type' => 'youtube', 
					'videoid' => '6v2L2UGZJAM'
				)
			)
		);
		$rightargs['before_widget'] = '<div class="widget2 widget_video"><div class="inner">';
		the_widget('VideoFeed', $instance, $rightargs);
		unset($instance);
		$rightargs['before_widget'] = '<div class="widget2 widget_search"><div class="inner">';
		the_widget('WP_Widget_Search', $instance, $rightargs);
		$rightargs['before_widget'] = '<div class="widget2 widget_posts"><div class="inner">';
		$instance['display_featured_image']=1;
		$instance['title']='Recent Posts';
		$instance['display_title']=1;
		$instance['excerpt_length']=120;
		the_widget('Posts', $instance, $rightargs);
		$rightargs['before_widget'] = '<div class="widget2 widget_comments"><div class="inner">';
		$instance = array(
			'title' => 'Recent Comments',
			'comments_number' => '5',
			'display_author' => 'true',
			'display_comment' => 'true',
			'display_avatar' => 'true',
			'read_more_text' => '&raquo;',
			'comment_length' => '26',
			'avatar_size' => '32',
			'avatar_align' => 'alignleft'
		);
		the_widget('Comments', $instance, $rightargs);
		unset($instance);
		$rightargs['before_widget'] = '<div class="widget2 widget_tag_cloud"><div class="inner">';
		the_widget('WP_Widget_Tag_Cloud', $instance, $rightargs);
	}
	function show_left_sidebar_widgets() {
		global $rightargs;
		$instance = array(
			'title' => 'Flickr',
			'userid' => '80789124@N02',
			'width' => '55'
		);
		$rightargs['before_widget'] = '<div class="widget2 widget_flickr"><div class="inner">';
		the_widget('Flickr', $instance, $rightargs);
		$rightargs['before_widget'] = '<div class="widget2 widget_posts"><div class="inner">';
		$instance = array(
			'title' => 'Facebook',
			'url' => 'http://www.facebook.com/smthemes',
			'width' => '240',
			'height' => '180',
			'colorscheme' => 'light',
			'show_faces' => 'true',
			'stream' => 'false',
			'header' => 'false',
			'border' => '#f3f3f3'
		);
		the_widget('Facebook', $instance, $rightargs);
		$instance = array(
			'randomize' => '',
			'count' => '3',
			'title' => '',
			'banners' => array(
				"<smt:banner colorscheme='dark' layout='6' link='http://smthemes.com/?i=wordpress'></smt:banner>",
				"<smt:banner colorscheme='dark' layout='2' link='http://smthemes.com/?i=wordpress'></smt:banner>",
				"<smt:banner colorscheme='light' layout='2' link='http://smthemes.com/?i=wordpress'></smt:banner><script type='text/javascript' src='http://smthemes.com/api/banner.js'></script>"
			)
		);
		the_widget('Banners', $instance, $rightargs);
		unset($instance);
		$rightargs['before_widget'] = '<div class="widget2 widget_categories"><div class="inner">';
		unset($instance);
		$instance = array(
			'effect' => 'fadeIn'
		);
		the_widget('Tabs', $instance, $rightargs);
	}
	function show_footer_1_widgets() {
		global $footerargs;
		$instance = array(
			'title' => 'Calendar'
		);
		$footerargs['before_widget'] = '<div class="widget_calendar">';
		the_widget('WP_Widget_Calendar', $instance, $footerargs);
		
	}
	function show_footer_2_widgets() {
		global $footerargs;
		the_widget('WP_Widget_Tag_Cloud', $instance, $footerargs);
	}
	function show_footer_3_widgets() {
		global $footerargs;
		$instance= array(
			'width' =>'32',
			'title' => 'Social Profiles',
			'profiles' => array(
			array('id'=>'twitter', 'title' => 'Twitter', 'url' => 'http://twitter.com/', 'button' => get_template_directory_uri() . '/images/social-profiles/twitter.png'),
			array('id'=>'facebook','title' => 'Facebook', 'url' => 'http://facebook.com/', 'button' => get_template_directory_uri() . '/images/social-profiles/facebook.png'),
			array('id'=>'gplus','title' => 'Google Plus', 'url' => 'https://plus.google.com/', 'button' => get_template_directory_uri() . '/images/social-profiles/gplus.png'),
			array('id'=>'linkedin','title' => 'LinkedIn', 'url' => 'http://www.linkedin.com/', 'button' => get_template_directory_uri() . '/images/social-profiles/linkedin.png'),
			array('id'=>'email','title' => 'Email', 'url' => 'mailto:your@email.com', 'button' => get_template_directory_uri() . '/images/social-profiles/email.png')
			)
		);
		$footerargs['before_widget'] = '<div class="widget_social_profiles">';
		the_widget('SocialProfiles', $instance, $footerargs);
		$footerargs['before_widget'] = '<div>';
		unset($instance);
		$instance['title']='SMThemes';
		$instance['text']='Smart free Wordpress themes on SMT Framework';
		the_widget('WP_Widget_Text', $instance, $footerargs);
		
	}
	
	function smtheme_excerpt($args='', $postid=''){
		global $post, $SMTheme;  
			if ((int)$postid==0)$p=$post;
			else $p=get_post($postid);
			parse_str($args, $i);  
			$maxchar     = isset($i['maxchar']) ?  (int)trim($i['maxchar'])     : 0;  
			$echo        = isset($i['echo']) ?          true                   : false;  
			$allow_tags        = isset($i['allow_tags']) ? trim($i['allow_tags']): "<strong><b><i><p><abbr><acronim><cite><q><strike>";  
			if ($maxchar)$allow_tags='';
			$maxsmchar=($SMTheme->get( 'layout','cuttxton' ))?$SMTheme->get( 'layout','cuttxt' ):0;
			$out = ($p->post_excerpt && !$maxchar) ? $p->post_excerpt : $p->post_content;  
			$out = preg_replace ("!\[/?.*\]!U", '', $out ); 
			if(!$maxchar&&!$p->post_excerpt && strpos($p->post_content, '<!--more-->') ){  
				$maxsmchar=0;
				$allow_tags.="<a>";
				preg_match ('/(.*)<!--more-->/s', $out, $match);  
				$out = $match[1];  
			} 
		$excerpt=($maxchar||!($p->post_excerpt))?false:true;
		$maxchar=($maxchar)?$maxchar:$maxsmchar;
		if (!$maxchar)$allow_tags.="<a>";
		$out = strip_tags($out, $allow_tags);  
		if(!($excerpt)&&$maxchar&&( iconv_strlen($out, 'utf-8') > $maxchar )){  
			$out = iconv_substr( $out, 0, $maxchar, 'utf-8' );  
			$out = preg_replace('@(.*)\s[^\s]*$@s', '\\1', $out);
		}  
		
		if ($maxchar==$maxsmchar) {
			$out = str_replace("\r", '', trim($out, "\n"));  
			$out = preg_replace( "!\n\n+!s", "</p><p>", $out );  
			$out = str_replace( "\n", "<br />", $out )."</p>";
		}
		if($echo) return print $out;  
		return $out;  
	}  
	
	function smt_menu($a) {
		$a=preg_replace("/<ul\sclass='children'>/", "<ul class='children'$2><div class='transparent'></div><div class='inner'>", $a);
		$a=preg_replace('/<ul\sclass="sub-menu">/', "<ul class='sub-menu'><div class='transparent'></div><div class='inner'>", $a);
		$a=preg_replace("/<\/ul>/", "</div></ul>", $a);
		return $a;
	}
	add_filter('wp_list_categories', 'smt_menu');
	add_filter('wp_list_pages', 'smt_menu');
	add_filter('wp_nav_menu_items', 'smt_menu');
	
	function block_main_menu() {
	global $SMTheme;
		?>
		 <div class="menu-primary-container">
			<ul class="menus menu-primary">
                <li <?php if(is_home() || is_front_page()) { ?>class="current_page_item"<?php } ?>><a href="<?php echo home_url(); ?>"><?php echo $SMTheme->_(  'homelink' );?></a></li>
				<?php wp_list_categories('title_li=&'); ?>
			</ul>
		</div>
		<?php
	}
	
	function block_sec_menu() {
		?>	<div class='menu-topmenu-container'><ul class="menus">
				<?php wp_list_pages('title_li=&'); ?>
			</ul></div>
		<?php
	}
	
	
	
	
	
	
	
function addYouTube($atts, $content = null) {
        extract(shortcode_atts(array( "id" => '' ), $atts));
        return '<p style="text-align:center;display:block;overflow:hidden;clear:left">
        <a href="http://www.youtube.com/watch?v='.$id.'" target="_blank" alt="'.$id.'" class="youtube">
        <img src="http://img.youtube.com/vi/'.$id.'/0.jpg" width="400" height="300" />
        </a></p>';
}
add_shortcode('youtube', 'addYouTube');

function addVimeo($atts, $content = null) {
        extract(shortcode_atts(array( "id" => '' ), $atts));
		$videoinf = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$id.".php"));
        return '<p style="text-align:center;display:block;overflow:hidden;">
        <a href="http://vimeo.com/'.$id.'" target="_blank" alt="'.$id.'" class="vimeo">
        <img alt="" src="'.$videoinf[0]['thumbnail_large'].'" width="400">
        </a></p>';
}
add_shortcode('vimeo', 'addVimeo');

function addTooltips($atts, $content = "") {
        extract(shortcode_atts(array( "tiptext" => '' ), $atts));
        return '<span class="tooltip" title="'.$tiptext.'">'.$content.'</span>';
}
add_shortcode('tooltip', 'addTooltips');


function add_smpanel() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
   if ( get_user_option('rich_editing') == 'true') {
     add_filter('mce_external_plugins', 'add_smpanel_tinymce_plugin');
     add_filter('mce_buttons_3', 'register_smpanel');
   }
}

add_action('init', 'add_smpanel');
function register_smpanel($buttons) {
   array_push($buttons, "youtube","vimeo","|","btns","cols","tooltips","highlights");
   return $buttons;
}

function add_smpanel_tinymce_plugin($plugin_array) {
   $plugin_array['smpanel'] = get_template_directory_uri().'/js/editor_plugin.js';
   return $plugin_array;
}

function my_refresh_mce($ver) {
  $ver += 3;
  return $ver;
}
add_editor_style( 'css/editor.css' );
add_filter( 'tiny_mce_version', 'my_refresh_mce');




if ( ! function_exists('tdav_css') ) {
	function tdav_css($wp) {
		$wp .= ','.get_template_directory_uri().'/css/shortcode.css ';
	return $wp;
	}
}
add_filter( 'mce_css', 'tdav_css' );
function smtheme_topic_count_text($count) {
	global $SMTheme;
	return sprintf( _n($SMTheme->_( 'altposts' ), $SMTheme->_( 'altpostss' ), $count), number_format_i18n( $count ) );
}
function smtheme_tag_cloud() {
	$args['topic_count_text_callback']='smtheme_topic_count_text';
	return $args;
}
add_filter('widget_tag_cloud_args', 'smtheme_tag_cloud');






add_filter( 'gettext', 'theme_change_comment_field_names', 20, 3 );
/**
 * Change comment form default field names.
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function theme_change_comment_field_names( $translated_text, $text, $domain ) {
global $SMTheme;
        switch ( $translated_text ) {

            case 'View all posts filed under %s' :

                $translated_text = $SMTheme->_( 'altcats' );
                break;

        }
    return $translated_text;
}






?>
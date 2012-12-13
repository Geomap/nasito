<?php global $SMTheme;?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php $SMTheme->show_title()?>

<?php
	if(
		(is_archive()&&is_day()&&$SMTheme->get( 'seo', 'day' ))||
		(is_archive()&&is_month()&&$SMTheme->get( 'seo', 'month' ))||
		(is_archive()&&is_year()&&$SMTheme->get( 'seo', 'year' ))||
		(is_category()&&$SMTheme->get( 'seo', 'category' ))||
		(is_tag()&&$SMTheme->get( 'seo', 'tag' ))||
		(is_author()&&$SMTheme->get( 'seo', 'author' ))||
		(is_search()&&$SMTheme->get( 'seo', 'search' ))
	) {
	?><meta name="robots" content="noindex" /><?php
	}
?>

<?php if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); } ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
<?php  wp_head(); ?>
<style type="text/css">
	<?php $class=$SMTheme->block_slider_css(); ?>
	
	<?php echo $SMTheme->get( 'integration','css' )?>
</style>
	<?php
		echo $SMTheme->get( 'integration','headcode' );
	?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			<?php
				$SMTheme->block_slider_config();
			?>
			jQuery('#secondarymenu ul.menus').each(function(){
				jQuery('li:first', this).css('border-width', '0px').css('background', 'none');
			});
			jQuery('ul.menus').css('overflow', 'visible');
			jQuery(".menus .children").addClass('sub-menu');
			
			<?php
				$SMTheme->block_menu_config("menus");
			?>
			jQuery('textarea#comment').each(function(){
				jQuery(this).attr('name','<?php echo $_SESSION['commentinput']; ?>');
			});
			jQuery('.feedback input').each(function(){
				jQuery(this).attr('name','<?php echo $_SESSION['commentinput']; ?>['+jQuery(this).attr('name')+']');
			});
			jQuery('.feedback textarea').each(function(){
				jQuery(this).attr('name','<?php echo $_SESSION['commentinput']; ?>['+jQuery(this).attr('name')+']');
			});
		});
	</script>
</head>
<body <?php body_class( $class ); ?>>
<div id='header'>
	
	<div class='container clearfix'>
		<div id='secondarymenu-container'>
				
				<div id='secondarymenu'><?php
					wp_nav_menu('depth=0&theme_location=sec-menu&container_class=menu-topmenu-container&menu_class=menus menu-topmenu&fallback_cb=block_sec_menu');
				?></div>
				<div id="logo">
				<?php if ($SMTheme->get( 'general', 'logosource' )==1&&$SMTheme->get( 'general', 'logoimage' )!='') { ?>
				<a href='<?php echo home_url(); ?>'><img src='<?php echo $SMTheme->get( 'general', 'logoimage' )?>' class='logo' alt='<?php echo bloginfo( 'name' ); ?>' title="<?php echo bloginfo( 'name' ); ?>" /></a>
				<?php } ?>
				<?php if ($SMTheme->get( 'general', 'logosource' )==2&&$SMTheme->get( 'general', 'customtext' )!='') { ?>
				<h1 class='site_ttl'><?php echo $SMTheme->get( 'general', 'customtext' )?></h1>
				<?php } ?>
			</div>
				<div class="menusearch" title="">
					<?php get_search_form(); ?>
				</div>
		</div>
			<div id='mainmenu-container'>
			
			<div id='mainmenu'><div class='innerleft'></div><ul><?php
			$nav_menu_params=array(
				'depth'=>0,
				'theme_location'=>'main-menu',
				'menu_class'=>'menus menu-primary',
				'fallback_cb'=>'block_main_menu'
			);
					wp_nav_menu($nav_menu_params);
				?></ul><div class='innerright'></div></div>
			
		</div>
		
		
		
		
		
			<?php
				if ((is_front_page()&&$SMTheme->get( 'slider', 'homepage'))||(!is_front_page()&&$SMTheme->get( 'slider', 'innerpage'))) {
					?><div class='slider-container'><?php
					$SMTheme->block_slider();
				?><div class='shadow'></div></div><?php
				}
			?>
	</div>

</div>
<?php	
if ($SMTheme->get( 'social', 'showsocial')) {
?>
<div id='smthemes_share'>
		<ul class='inner'>
			<?php
				$href=get_bloginfo('url').$_SERVER['REQUEST_URI'];
				$SMTheme->pagetitle;
				$services=$SMTheme->get( 'social', 'socials' );
				if (is_single()) {$img=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium');$img=$img[0];}
				if ($img=='')$img=$SMTheme->get( 'general', 'logoimage' );
				foreach ($services as $service) {
					if ($service['show']) {
						$code=preg_replace('/smt_social_url/', $href, $service['code']);
						$code=preg_replace('/smt_social_title/', $SMTheme->pagetitle, $code);
						$code=preg_replace('/smt_social_desc/', $SMTheme->pagetitle, $code);
						$code=preg_replace('/smt_social_img_url/', $img, $code);
						echo "<li>".$code."</li>";
					}
				}
			?>
		</ul>
</div>
<?php
	}
?>
<div id='content-top' class='container'></div>
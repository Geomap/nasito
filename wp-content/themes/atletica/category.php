<?php 
	global $SMTheme;
	get_header(); 
?>
<div id='content'>
	<div class='container clearfix'>
		<?php get_sidebar('right'); ?>
		<?php get_sidebar('left'); ?>
		<div class="main_content">
			<h1 class="page-title"><?php printf( $SMTheme->_( 'catarchive' ), single_cat_title( '', false ) ); ?></h1>
			
				
			<?php get_template_part('theloop'); ?>
			
			<?php get_template_part('navigation'); ?>
        
		</div><!-- #content -->
    </div>
</div>
<?php get_footer(); ?>
<?php 
	global $SMTheme, $query_string;
	get_header(); 
?>
<div id='content'>
	<div class='container clearfix'>
		
		<?php get_sidebar('right'); ?>
		<?php get_sidebar('left'); ?>
		
		<div class="main_content">
			
			<?php get_template_part('theloop'); ?>
			
			<?php the_tags("<div class='tags'><span>".$SMTheme->_( 'tags' ).":&nbsp;&nbsp;</span>", ", ","</div>");	?>
			
			<?php get_template_part('relatedposts'); ?>
			
			<?php comments_template(); ?>
			
			<?php get_template_part('navigation'); ?>
		
        </div><!-- #content -->
    
    </div>
</div>

<?php get_footer(); ?>
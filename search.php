<?php 
	global $SMTheme;
	get_header(); 
?>
<div id='content'>
	<div class='container clearfix'>
	
		<?php get_sidebar('right'); ?>
		<?php get_sidebar('left'); ?>
	
		<div class="main_content">
		
			<?php
			
				if (!have_posts()) { ?>
					<div class="entry">
					<p><?php echo $SMTheme->_( 'nothingfound' )?></p>
					</div>
				<?php }
				
				get_template_part('theloop');
				
			?>
			
			<?php get_template_part('navigation'); ?>
		
        </div><!-- #content -->
               
	</div>
</div>
<?php get_footer(); ?>
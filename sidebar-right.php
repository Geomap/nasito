<?php global $SMTheme; ?>

<div class='sidebar clearfix'>
		 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Right Sidebar") ) : ?>
		<?php
			$SMTheme->go_func('right_sidebar');
		?>
<?php endif; ?>
	</div>
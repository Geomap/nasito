<?php global $SMTheme; ?>

<div class='sidebar-left clearfix'>
		 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Left Sidebar") ) : ?>
		<?php
			$SMTheme->go_func('left_sidebar');
		?>
<?php endif; ?>
	</div>
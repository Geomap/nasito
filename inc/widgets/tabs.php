<?php
/*
Plugin Name: Tabs Widget
*/
?>
<?php
        
$tabs_defaults = array(
    'effect' => 'fadeIn'
);

$effects = array (
	'noEffect'=>array (
		'title'=>'No effect',
		'action'=>"jQuery(this).addClass('active').siblings().removeClass('active').parents('.tabs_widget').find('dd').eq(jQuery(this).index()).addClass('active');"
	),
	'fadeIn'=>array (
		'title'=>'Fade in',
		'action'=>"jQuery(this).addClass('active').siblings('dt').removeClass('active').parents('.tabs_widget').find('dd').hide().removeClass('active').eq(jQuery(this).index()).fadeIn('slow');"
	),
	'slideDonw'=>array (
		'title'=>'Slide down',
		'action'=>"jQuery(this).addClass('active').siblings('dt').removeClass('active').parents('.tabs_widget').find('dd').hide().removeClass('active').eq(jQuery(this).index()).slideDown();"
	)
);
        


class Tabs extends WP_Widget {
    var $defaults;
    var $effects;
	
    function __construct(){
        global $tabs_defaults,$effects;
        $this->defaults = $tabs_defaults;
		$this->effects = $effects;
	   
        $widget_options = array('description' => 'Allows you to add multiple widgets in tabs. ' );
        $control_options = array( );
		$this->WP_Widget('tabs', '&raquo; Tabs Widget', $widget_options,$control_options);
    }

    function widget($args, $instance){
		global $Page, $SMTheme;
       extract( $args );

        ?> 
		<script>
			jQuery(document).ready(function() {
				jQuery('.tabs_widget dd').each(function() {
					jQuery(this).find('dt').insertBefore(jQuery(this).parent().find('dd:first'));
				});
				jQuery('.tabs_widget dt').each(function() {
					jQuery(this).html(jQuery(this).text());
				});
				jQuery('.tabs_widget').each(function() {
					jQuery('dt:first', this).addClass('active');
					jQuery('dd:first', this).addClass('active');
				});
				jQuery('.tabs_widget dt').die();
				jQuery('.tabs_widget dt').live('click', function() {
					<?php echo $this->effects[$instance['effect']]['action']?>
				});
			});
		</script>
		<dl class='tabs_widget'>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("tabs_sidebar") ) : ?>
			<?php
				$SMTheme->go_func('tabs_sidebar');
			?>
			<?php endif; ?>
			<div style='clear:both'></div>
		</dl>
        
        <?php
    }

    function update($new_instance, $old_instance) 
    {				
        return $new_instance;
    }
    
    function form($instance) {	
        $instance = wp_parse_args( (array) $instance, $this->defaults );
		
        ?>
       <div class="tabs_widget">
		<p><label for="<?php echo $this->get_field_id('effect')?>">Effect:</label><select class="widefat" id="<?php echo $this->get_field_id('effect')?>" name="<?php echo $this->get_field_name('effect')?>">
			<?php
				foreach ($this->effects as $value=>$effect) {
				?><option value='<?php echo $value?>'<?php echo (($instance['effect']==$value)?' selected="selected"':"")?>><?php echo $effect['title']?></option><?php
				}
			?>
		</select></p>
		
		
	   </div>
        <?php
    }
} 
add_action('widgets_init', create_function('', 'return register_widget("Tabs");'));
?>
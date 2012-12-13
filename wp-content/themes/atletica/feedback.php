<?php
	/*Template Name: Contact form*/
?>
<?php global $SMTheme;?>
<?php
	if ($form=$_POST[$_SESSION['commentinput']]) {
		$msg='';
		$error='';
		$errorcode='red';
		foreach ($SMTheme->get( 'contactform', 'contactform' ) as $key=>$detail) {
			if ($detail['req']=='required'&&$form[$key]=='') $error.='Field '.$detail['ttl']." is required<br />";
			if ($detail['regex']!=''&&!eregi(stripslashes($detail['regex']),$form[$key])) {
				$error.='Field '.$detail['ttl']." is not valid<br />";
			}
			$msg.=$detail['ttl'].": ".$form[$key]."\r\n";
		}
		$from=($SMTheme->get( 'general','sitename' ))?$SMTheme->get( 'general','sitename' ):get_bloginfo('name');
		if ($error=='') {
			mail($SMTheme->get( 'contactform', 'email' ), 'Message from '.$from, $msg);
			$error=$SMTheme->_( 'emailok' );
			$errorcode='green';
		}
	}		
?>
<?php get_header(); ?>
<div id='content'><div class='container clearfix'>
			<?php get_sidebar('right'); ?>
	<?php get_sidebar('left'); ?>
		<div class="main_content">
		<?php
	the_post();
	the_content();
?>
		<?php if ( $SMTheme->get( 'contactform','address' ) != '' ) {?>
		<div class='googlemap'><div id="map_canvas" style="width: 100%; height: 300px;"></div></div>
		<?php } ?>
<?php echo ($error!='')?"<p style='color:".$errorcode."'>".$error."</p>":''?>
<?php if ($SMTheme->get( 'contactform','detailttl' ) != '') {?>
<h3><?php echo $SMTheme->get( 'contactform','detailttl' )?></h3>
<?php } ?>
<?php if ($SMTheme->get( 'contactform','text' )) { ?>
<div style='margin-bottom:20px;'>
<?php echo $SMTheme->get( 'contactform','text' )?>
</div>
<?php } ?>
<ul class='contact-details'>
	<?php
		foreach ($SMTheme->get( 'contactform', 'details' ) as $key=>$detail) {
		?>
			<li class='contact<?php echo $key?>'><?php echo $detail['content']?></li>
		<?php
		}
	?>
	
</ul>
<?php
	if ($SMTheme->get( 'contactform', 'email' )) {
?>
<form action='' method='POST' class='feedback'>
<h3><?php echo $SMTheme->_( 'feedbackttl' ); ?></h3>
<i><?php echo $SMTheme->_( 'feedbackbefore' ); ?></i>
	<?php
		foreach ($SMTheme->get( 'contactform', 'contactform' ) as $key=>$detail) {
			switch ($detail['type']) {
				case 'text':
				?>
<p><?php echo $detail['ttl']?>: <?php echo ($detail['req']=='required')?'(*)':''?>
<div class='input'><input type='text' value='' name='<?php echo $key?>'<?php echo ($detail['req']=='required')?" required='true'":''?> /></div>
</p>
				<?php
				break;
				case 'textarea':
				?>
<p><?php echo $detail['ttl']?>: <?php echo ($detail['req']=='required')?'(*)':''?>
<div class='input'><textarea rows='5' name='<?php echo $key?>'<?php echo ($detail['req']=='required')?" required='true'":''?>></textarea></div>
</p>
				<?php
				break;
			}
		}
	?>

<center><input type='submit' class='readmore' value='<?php echo $SMTheme->_( 'send' );?>' /></center>
</form>
<?php } ?>

</div><!-- #content -->
    
        
                
</div></div>
    <?php get_footer(); ?>
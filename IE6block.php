<?
$plugin_dir = basename(dirname(__FILE__));
$url = get_settings('home').'/wp-content/plugins/'.$plugin_dir;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php bloginfo('name'); ?></title>
<script type="text/javascript" src="<?php echo $url; ?>/js/jquery-1.3.2.min.js"></script> 
<script type="text/javascript" src="<?php echo $url; ?>/js/jquery.pngFix.js"></script> 
<style type="text/css">
a img { border:none;}
body {
	background: url(<?php echo $url; ?>/images/body-background.jpg);
	text-align:center;}
.main {
	background: url(<?php echo $url; ?>/images/main-background.png);
	width:540px;
	height:370px;}	
.header { margin-top:150px; width:450px;}
.sub-head {width:450px;}
.footer { margin-top:74px; text-align:left; padding-left:33px;}
.footer a { margin-right:28px;}
</style>
<script type="text/javascript">     $(document).ready(function(){         $(document).pngFix();     }); </script> 
</head>

<body>
<div class="main">
<div class="header">
<strong>
<h3>
<?php if ( !get_option('vasthtml_blockie_text') ) : ?>
It looks like your still using Internet Explorer 6
<?php else: ?>
<?php echo ($custom_text = get_option('vasthtml_blockie_text')); ?>
<?php endif; ?>
</h3>
</strong>
</div>
<div class="sub-head">
<strong>
<?php if ( !get_option('vasthtml_upgrade_box') ) : ?>
Internet Explorer 6 is not supported by this website. Please update to a new browser.
<?php else: ?>
<?php echo ($custom_text = get_option('vasthtml_upgrade_box')); ?>
<?php endif; ?>
</strong>
</div>
<div class="footer">
<?php if ( !get_option('vasthtml_ie') ) : ?>  
<?php else: ?>
<a href="http://www.microsoft.com/ie"><img src="<?php echo $url; ?>/images/IE.png" /></a>    
<?php endif; ?>
<?php if ( !get_option('vasthtml_safari') ) : ?>
<?php else: ?>
<a href="http://www.apple.com/safari/"><img src="<?php echo $url; ?>/images/Safari.png" /></a>
<?php endif; ?>
<?php if ( !get_option('vasthtml_opera') ) : ?>
<?php else: ?>
<a href="http://www.opera.com/"><img src="<?php echo $url; ?>/images/Opera.png" /></a>
<?php endif; ?>
<?php if ( !get_option('vasthtml_firefox') ) : ?>
<?php else: ?>
<a href="http://www.mozilla.com/firefox/ie.html"><img src="<?php echo $url; ?>/images/Firefox.png" /></a>
<?php endif; ?>
<?php if ( !get_option('vasthtml_chrome') ) : ?>
<?php else: ?>
<a href="http://www.google.com/chrome"><img src="<?php echo $url; ?>/images/Chrome.png" /></a>
<?php endif; ?>
</div>
</div>
<!--Plugin By: http://vasthtml.com-->
</body>
</html>
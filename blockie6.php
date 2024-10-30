<?php
/*
Plugin Name: Block IE6
Plugin URI: http://vasthtml.com
Description: This plugin keeps people from viewing your site if they are using Internet Explorer 6. Gives options to download a variety of newer browsers.
Author: Eric Hamby
Version: 2.1
Author URI: http://erichamby.com
*/
function blockie6_admin_css() {
	$plugin_dir = basename(dirname(__FILE__));
	$url = get_settings('home').'/wp-content/plugins/'.$plugin_dir;
    echo '
<style>	
	.jquery-checkbox       {display: inline; font-size: 20px; line-height: 20px; cursor: pointer; cursor: hand;}
.jquery-checkbox .mark {display: inline;}

.jquery-checkbox img {vertical-align: middle; width: 60px; height: 20px;}
.jquery-checkbox img{background: transparent url(' . $url . '/images/checkbox.png) no-repeat;}

.jquery-checkbox img{
	background-position: 0px 0px;
}
#admin_form {
	background: transparent url(' . $url . '/images/input-bg.png) right no-repeat ;
	width: 590px;
	height: 30px;
	padding: 13px 5px 5px 5px;
	color: #6f737e;
	font-size: 24px;
	border: none;
	}
#admin_form_small {
	background: transparent url(' . $url . '/images/small-bg.png) right no-repeat ;
	width: 115px;
	height: 30px;
	padding: 13px 5px 5px 5px;
	color: #6f737e;
	font-size: 24px;
	border: none;
	}	
#admin_textarea {
	background: transparent url(' . $url . '/images/text-area.png) bottom no-repeat ;
	width: 590px;
	height: 170px;
	padding: 13px 5px 5px 5px;
	color: #6f737e;
	font-size: 24px;
	overflow: hidden;
	border: none;
	}	
.jquery-checkbox-hover img{
	background-position: 0px -20px;
}
.jquery-checkbox-checked img{
	background-position: 0px -40px;
}
.jquery-checkbox-checked .jquery-checkbox-hover img {
	background-position: 0px -60px;
}

.jquery-checkbox-disabled img{
	background-position: 0px -80px;
}
.jquery-checkbox-checked .jquery-checkbox-disabled img{
	background-position: 0px -100px;
} </style>
	
	';
	} 
	
add_action('admin_head', 'blockie6_admin_css'); ?>
<?php if ( get_option('activate_block') ) : ?>
<?php function detectIE6(){
	if (ereg('MSIE ([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
		if($log_version[1] == '6')
			return true;
	}
	return false;
}

function redirect_if_needed(){
	if (detectIE6()){
		include('IE6block.php');
		exit;	
	}
}

add_action('template_redirect', 'redirect_if_needed');
?><?php endif; ?>
<?php function get_version_blockie6(){
	$plugin_dir = basename(dirname(__FILE__));
	$url = '/wp-content/plugins/'.$plugin_dir.'/blockie6.php';
	$plugin_data = implode('', file(ABSPATH.$url));
	if (preg_match("|Version:(.*)|i", $plugin_data, $version)) {
		$version = $version[1];
	}
	return $version;
} ?>
<?php add_action('admin_menu', 'blockie6_info_page'); 
function blockie6_info_page(){
	$plugin_dir = basename(dirname(__FILE__));
	$url = get_settings('home').'/wp-content/plugins/'.$plugin_dir;
	$mypage = add_menu_page('Block IE6', 'Block IE6', 8, 'blockie6_info', 'blockie6_info', $url.'/images/ie-favicon.png');
	add_action( "admin_print_scripts-$mypage", 'blockie6_admin_head' );
}
function blockie6_admin_head() {
	$plugin_dir = basename(dirname(__FILE__));
	$url = get_settings('home').'/wp-content/plugins/'.$plugin_dir;
	wp_enqueue_script('loadjs', $url . '/js/jquery.js');
	wp_enqueue_script('loadjsone', $url . '/js/jquery.checkbox.min.js');
	wp_enqueue_script('loadjstwo', $url . '/js/jsslideone.js');
}
function blockie6_info() {
  echo '<div class="wrap">';
  echo '<div id="icon-tools" class="icon32"><br /></div><h2>Block IE6 Options</h2>';
  echo '<p>';
  echo '<table class="widefat">
    <thead>
      <tr>
        <th>Block IE6</th>
		<th><span style="float:right"><small>'.get_version_blockie6().'</small></span></th>
      </tr>
    </thead>
	
	
			<tr class="alternate">
			<td width="250">Activate IE6 Block</td>
			<td>'; ?>
             <form method="post" action="options.php">
	<?php settings_fields('IE6block_options'); ?>
<input name="activate_block" value="true" type="checkbox"<?php checked("true", get_option("activate_block")); ?> />
<?php echo 'Activate<br />'; ?>
<?php echo 'This will show a image and link to upgrade Internet Explorer'; ?>
			
			<?php echo '</td>
		</tr>
	
	
	
	
		<tr class="alternate">
			<td width="250">Show Internet Explorer Upgrade</td>
			<td>'; ?>           
		<label>
<input name="vasthtml_ie" value="true" type="checkbox"<?php checked("true", get_option("vasthtml_ie")); ?> />
<?php echo 'Activate<br />'; ?>
<?php echo 'This will show a image and link to upgrade Internet Explorer'; ?>
</label>
			
			<?php echo '</td>
		</tr>
		<tr class="alternate">
			<td>Show Safari Upgrade</td>
			<td>'; ?>
            
		<label>
<input name="vasthtml_safari" value="true" type="checkbox"<?php checked("true", get_option("vasthtml_safari")); ?> />
<?php echo 'Activate<br />'; ?>
<?php echo 'This will show a image and link to upgrade Safari'; ?>
</label>
			
			<?php echo '</td>
	
		</tr>
		<tr class="alternate">
				<td>Show Opera Upgrade</td>
			  	<td>'; ?>
            
		<label>
<input name="vasthtml_opera" value="true" type="checkbox"<?php checked("true", get_option("vasthtml_opera")); ?> />
<?php echo 'Activate<br />'; ?>
<?php echo 'This will show a image and link to upgrade Opera'; ?>
</label>
			
			<?php echo '</td>
			</tr>
		
		<tr class="alternate">
			<td>Show FireFox Upgrade</td>
			<td>'; ?>
            
		<label>
<input name="vasthtml_firefox" value="true" type="checkbox"<?php checked("true", get_option("vasthtml_firefox")); ?> />
<?php echo 'Activate<br />'; ?>
<?php echo 'This will show a image and link to upgrade FireFox'; ?>
</label>
			
			<?php echo '</td>
		</tr>
		<tr class="alternate">
			<td>Show Chrome Upgrade</td>
			<td>'; ?>
            
		<label>
<input name="vasthtml_chrome" value="true" type="checkbox"<?php checked("true", get_option("vasthtml_chrome")); ?> /> 
<?php echo 'Activate<br />'; ?>
<?php echo 'This will show a image and link to upgrade Chrome'; ?>
</label>
			
			<?php echo '</td>
		</tr>
		
		
		
		<tr class="alternate">
			<td>Change Text For Block IE6 Box</td>
			<td>'; ?>
            
	<input id="admin_form" name="vasthtml_blockie_text" value="<?php echo get_option('vasthtml_blockie_text'); ?>" type="text" /><br />
			<?php echo 'Leave blank for default'; ?>
			<?php echo '</td>
		</tr>
		
		<tr class="alternate">
			<td>Change Text For Upgrade Box</td>
			<td>'; ?>
            
	<input id="admin_form" name="vasthtml_upgrade_box" value="<?php echo get_option('vasthtml_upgrade_box'); ?>" type="text" /><br />
			<?php echo 'Leave blank for default'; ?>
			<?php echo '</td>
		</tr>
		
		
							
		<tr class="alternate">
			<td colspan="2">'; ?>
			
			<?php echo '<span style="float:left">'; ?>
			
			<input type="submit" class="button" value="Save Options" />
			
			<?php echo '</span>
			</td>
		</tr>
		</table>';
		echo '</p>';
		
		
		
		
		echo '<div id="icon-themes" class="icon32"><br /></div><h2>Block IE6 Information</h2>';
		echo '<p>';
  echo '<table class="widefat">
    <thead>
      <tr>
        <th>Block IE6</th>
		<th><span style="float:right"><small>'.get_version_blockie6().'</small></span></th>
      </tr>
    </thead>
		<tr class="alternate">
<td>Plugin Name:</td>
<td>Block IE6</td>
</tr>

<tr class="alternate">
<td>Plugin Version:</td>
<td>'.get_version_blockie6().'</td>
</tr>

<tr class="alternate">
<td>Build:</td>
<td>2135</td>
</tr>


<tr class="alternate">
<td>Author:</td>
<td><a href="http://erichamby.com" target="_blank">Eric Hamby</a></td>
</tr>

<tr class="alternate">
<td>Release Date:</td>
<td>7/30/2009</td>
</tr>

<tr class="alternate">
<td>FAQ:</td>
<td><a href="http://vasthtml.com/faq/" target="_blank">FAQ Page</a></td>
</tr>

<tr class="alternate">
<td>Donations:</td>
<td><a href="http://vasthtml.com/donations/" target="_blank">Donations Page</a></td>
</tr>

<tr class="alternate">
<td>Support Forums:</td>
<td><a href="http://vasthtml.com/support/" target="_blank">Vast HTML Support</a></td>
</tr>


	<tr class="alternate">
			<td colspan="2">
			<span class="button" style="float:left"><a href="http://vasthtml.com" target="_blank">Vast HTML</a></span>
			<span class="button" style="float:right"><a href="http://erichamby.com" target="_blank">Eric Hamby</a></span>
			</td>
		</tr>

							
		</table>';
		echo '</p>';
		
		
		
		
  echo '</div>';
}

function IE6block_option_fields() {
	register_setting('IE6block_options', 'vasthtml_chrome');
	register_setting('IE6block_options', 'vasthtml_firefox');
	register_setting('IE6block_options', 'vasthtml_opera');
	register_setting('IE6block_options', 'vasthtml_safari');
	register_setting('IE6block_options', 'vasthtml_ie');
	register_setting('IE6block_options', 'vasthtml_blockie_text');
	register_setting('IE6block_options', 'vasthtml_upgrade_box');
	register_setting('IE6block_options', 'activate_block');
}
add_action('admin_init', IE6block_option_fields);
?>

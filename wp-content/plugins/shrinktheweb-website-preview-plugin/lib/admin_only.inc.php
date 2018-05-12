<?php

/**
 * Message shown when a feature requires an upgrade.
 */
define('STWWT_FEATURE_UPGRADE', '<span class="stwwt_account_upgrade">'.sprintf(__('This is a PRO feature, and requires an <a href="%s" target="_blank">account upgrade</a>.', 'shrinktheweb-website-preview-plugin'),'https://shrinktheweb.com/auth/order-page').'</span>');

/**
 * Message shown when an account requires a Basic or PLUS account.
 */
define('STWWT_ACCOUNT_UPGRADE', '<span class="stwwt_account_upgrade">'.__('Requires <b>Basic</b> or <b>PLUS</b> account.', 'shrinktheweb-website-preview-plugin').' <a href="https://shrinktheweb.com/auth/order-page" target="_blank">'.__('Upgrade your account.', 'shrinktheweb-website-preview-plugin').'</a></span>');



/**
 * Shows the usage guide on the documentation page.
 */
function STWWT_showPage_Documentation()
{
	$page = new PageBuilder(false);
	$page->showPageHeader(__('Shrink The Web - How to use the plugin', 'shrinktheweb-website-preview-plugin'), '70%');
	
	echo '<div class="stwwt_doc_wrap">';
	echo '<div class="stwwt_doc_title">';
		echo '<a name="embed"></a>';
		echo '<h3>'.__('Embedded Screenshots - Shortcodes', 'shrinktheweb-website-preview-plugin').'</h3>';
	echo '</div>';
	echo '<div id="stwwt_size_box">';
		echo '<p><b>'.sprintf(__('Valid sizes for the %s option are:', 'shrinktheweb-website-preview-plugin'),'size="xlg"').'</b></p>';
		echo '<ul>';
			echo '<li><code>mcr</code> = '.__('Micro', 'shrinktheweb-website-preview-plugin').'</li>';
			echo '<li><code>tny</code> = '.__('Tiny', 'shrinktheweb-website-preview-plugin').'</li>';
			echo '<li><code>vsm</code> = '.__('Very Small', 'shrinktheweb-website-preview-plugin').'</li>';
			echo '<li><code>sm</code> = '.__('Small', 'shrinktheweb-website-preview-plugin').'</li>';
			echo '<li><code>lg</code> = '.__('Large', 'shrinktheweb-website-preview-plugin').'</li>';
			echo '<li><code>xlg</code> = '.__('Extra Large', 'shrinktheweb-website-preview-plugin').'</li>';
		echo '</ul>';
	echo '</div>';

		echo '<p>'.sprintf(__('The Shrink The Web embed code shows a thumbnail for any link you wrap in %1$s or %2$s tags. Any use of these tags is replaced with the thumbnail of the website included in the tags.','shrinktheweb-website-preview-plugin'),'<code>[thumb][/thumb]</code>','<code>[stwthumb][/stwthumb]</code>').'</p>';
		echo '<p>'.sprintf(__('The %1$s attribute, which can be %2$s (add a link) or %3$s (don\'t add a link). To use a custom link, do not use the "%4$s" shortcode. Instead, just wrap the shortcode in a standard A HREF (see ex. 5 of this section). The %5$s attribute, which can be %6$s or  %7$s. The %8$s attribute, which can contain letters, numbers, hyphens and underscores. All spaces will be replaced with underscores automatically. This attribute may be added for SEO proposes to prepend human readable name to the cached thumbnail before hashed parameters.','shrinktheweb-website-preview-plugin'),'<code>link</code>','<code>true</code>','<code>false</code>','link','<code>size</code>','<code>mcr</code>, <code>tny</code>, <code>vsm</code>, <code>sm</code>, <code>lg</code>','<code>xlg</code>','<code>custom_filename</code>').
		'</p>';

		echo '<dl class="stwwt_examples">';
			echo '<dt>1) [thumb]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a thumbnail using the default thumbail size.','shrinktheweb-website-preview-plugin').'</dd>';
			
			echo '<dt>2) [thumb link="true"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.sprintf(__('Creates a thumbnail using the default thumbail size , and also adds a link to the %s URL. If you have a free account, the link is always added.','shrinktheweb-website-preview-plugin'),'https://shrinktheweb.com').'</dd>';
			
			echo '<dt>3) [thumb link="true" size="xlg"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.sprintf(__('Creates an extra-large thumbnail <b>regardless</b> of the default thumbnail size. Also adds a link to the %s URL. If you have a free account, the link is always added.','shrinktheweb-website-preview-plugin'),'https://shrinktheweb.com').'</dd>';
			
			echo '<dt>4) [thumb size="sm"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a small thumbnail <b>regardless</b> of the default thumbnail size.','shrinktheweb-website-preview-plugin').'</dd>';

			echo '<dt>5) '.htmlspecialchars('<a href="http://somedomain.com/aff/link01/product.cgi" target="_blank"> [thumb]http://affiliatehomepage.com[/thumb] </a>').'</dt>';
			echo '<dd>'.sprintf(__('Creates thumbnail of %1$s with the link to %2$s.','shrinktheweb-website-preview-plugin'),'http://affiliatehomepage.com','http://somedomain.com/aff/link01/product.cgi').'</dd>';

			echo '<dt>6) [thumb custom_filename="cats and dogs are great "]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.sprintf(__('Creates a thumbnail, which will be cached locally with filename like %s.','shrinktheweb-website-preview-plugin'),'\'cats_and_dogs_are_great_f40c61ee7761e42decef49e3b0dc2e2b.jpg\'').'</dd>';

		echo '</dl>';
	echo '</div>';
	
	
	
	
	echo '<div class="stwwt_doc_wrap">';
	echo '<div class="stwwt_doc_title">';
		echo '<a name="embed"></a>';
		echo '<h3>'.__('Pro Feature - Full-Length Screenshots','shrinktheweb-website-preview-plugin').'</h3>';
	echo '</div>';
	
	if (STWWT_account_featuredAllowed('embedded_pro_full_length')) :
		
		echo '<p>'.sprintf(__('The full length capture feature uses the %1$s attribute, which can be %2$s or %3$s. This attribute works with any of the other attributes on this page. Here are some examples:','shrinktheweb-website-preview-plugin'),'<code>full_length</code>','<code>true</code>','<code>false</code>').'</p>';
		echo '<dl class="stwwt_examples">';
			echo '<dt>1) [thumb full_length="true"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a thumbnail using the default thumbail size, but forces the display of a <b>full length</b> screenshot thumbnail even if the full-length setting is disabled globally.','shrinktheweb-website-preview-plugin').'</dd>';
			
			echo '<dt>2) [thumb link="true" full_length="true"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.sprintf(__('Creates a thumbnail using the default thumbail size, as a full length thumbnail, and also adds a link to the %s URL.','shrinktheweb-website-preview-plugin'),'https://shrinktheweb.com').'</dd>';
			
			echo '<dt>3) [thumb full_length="false"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a thumbnail using the default thumbail size, but forces the display of a <b>normal length</b> screenshot thumbnail even if the full-length setting is enabled globally.','shrinktheweb-website-preview-plugin').'</dd>';
			
			echo '<dt>4) [thumb size="xlg" full_length="true"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates an extra large width thumbnail and forces the display of a <b>full length</b> screenshot thumbnail even if the full-length setting is disabled globally.','shrinktheweb-website-preview-plugin').'</dd>';
		echo '</dl>';
		
	else :
		echo '<div class="stwwt_upgrade_required">'.STWWT_FEATURE_UPGRADE.'</div>';
	endif;
	echo '</div>';
	
	
	
	
	echo '<div class="stwwt_doc_wrap">';
	echo '<div class="stwwt_doc_title">';
		echo '<a name="embed"></a>';
		echo '<h3>'.__('Pro Feature - Custom Size Screenshots','shrinktheweb-website-preview-plugin').'</h3>';
	echo '</div>';
	
	if (STWWT_account_featuredAllowed('embedded_pro_custom_size')) :
		echo '<p>'.sprintf(__('The custom-size feature uses the %1$s attribute, which can be a number e.g. %2$s or both width and height e.g. %3$s. This attribute works with any of the other attributes on this page. Here are some examples:','shrinktheweb-website-preview-plugin'),'<code>size</code>','<code>500</code>','<code>640x320</code>').'</p>';
		echo '<dl class="stwwt_examples">';
			echo '<dt>1) [thumb size="600" ]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a thumbnail <b>600 pixels wide</b>, regardless of the global thumbnail size.','shrinktheweb-website-preview-plugin').'</dd>';

			echo '<dt>2) [thumb size="340" ]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a thumbnail <b>340 pixels wide</b>, regardless of the global thumbnail size.','shrinktheweb-website-preview-plugin').'</dd>';

			echo '<dt>3) [thumb]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a thumbnail using the default thumbail size.','shrinktheweb-website-preview-plugin').'</dd>';

			echo '<dt>4) [thumb size="640x320"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a thumbnail <b>640 pixels wide</b> and <b>320 pixels high</b>, regardless of the global thumbnail size.','shrinktheweb-website-preview-plugin').'</dd>';

			echo '<dt>5) [thumb size="340"  link="true"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.sprintf(__('Creates a thumbnail <b>340 pixels wide</b> and also adds a link to the %s URL.','shrinktheweb-website-preview-plugin'),'https://shrinktheweb.com').'</dd>';
		echo '</dl>';

		echo '<p>'.sprintf(__('Also you can use %1$s attribute to set custom thumbnail creator\'s browser size, e.g. %2$s. This attribute works with any of the other attributes on this page. Here are some examples:','shrinktheweb-website-preview-plugin'),'<code>screen</code>','<code>screen = "1280x960"</code>').'</p>';
		echo '<dl class="stwwt_examples">';
			echo '<dt>1) [thumb size="320x240" screen="1280x960"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a thumbnail of <b>320x240 pixels</b> from web page screenshot how it looks on custom viewport <b>1280x960 pixels</b>.','shrinktheweb-website-preview-plugin').'</dd>';

			echo '<dt>2) [thumb size="400x225" screen="1366x768"]https://shrinktheweb.com[/thumb]</dt>';
			echo '<dd>'.__('Creates a widescreen thumbnail of <b>400x225 pixels</b>, from web page screenshot how it looks on custom viewport <b>1366x768 pixels</b>.','shrinktheweb-website-preview-plugin').'</dd>';
		echo '</dl>';
	else :
		echo '<div class="stwwt_upgrade_required">'.STWWT_FEATURE_UPGRADE.'</div>';
	endif;
	echo '</div>';

	$page->showPageFooter();
}

/**
 * Shows information about the thumbnail cache.
 */
function STWWT_showPage_ThumbnailCache()
{
	$page = new PageBuilder(false);
	$page->showPageHeader(__('Shrink The Web - Website Thumbnails - Cache', 'shrinktheweb-website-preview-plugin'), '70%');
	
	?>
	<?php echo sprintf('<h3>'.__('Clear Thumbnail Cache', 'shrinktheweb-website-preview-plugin').'</h3>')?>
	<?php echo sprintf('<p>'.__('Generally speaking, you do not need to clear the thumbnail cache. The plugin automatically manages the thumbnail cache, updating thumbnails automatically. However, if you do need to clear the cache for any reason, you can use the button below to flush the cache.', 'shrinktheweb-website-preview-plugin').'</p>')?>
	<?php 
		
	$form = new FormBuilder('stwwt_cache_clear');
	$form->setSubmitLabel(__('Clear Thumbnail Cache', 'shrinktheweb-website-preview-plugin'));
	
	if ($form->formSubmitted() && $form->formValid()) 
	{
		STWWT_cache_emptyCache(false);
		$page->showMessage(__('Cache successfully emptied.', 'shrinktheweb-website-preview-plugin'));
	}
	
	echo $form->toString();
	
		
	
	// #### Cache Path Information
	$cachePathDir = STWWT_plugin_getCacheDirectory();
	$cachePathURL = STWWT_plugin_getCacheURL();
	$pathIsWriteable = (file_exists($cachePathDir) && is_dir($cachePathDir) && is_writable($cachePathDir));
	
	?>
	<br/>
	<?php echo sprintf('<h3>'.__('Cache Path Information', 'shrinktheweb-website-preview-plugin').'</h3>')?>
	<?php echo sprintf('<p>'.__('Your server cache path is %1$s, which translates to a URL of %2$s.', 'shrinktheweb-website-preview-plugin').'</p>',"<b>$cachePathDir</b>","<b>$cachePathURL</b>")?>
	<?php echo sprintf('<p>'.__('Your cache path is currently %s', 'shrinktheweb-website-preview-plugin').'</p>', ($pathIsWriteable ? '<span class="stwwt_cache_status stwwt_cache_ok">'.__('Writeable', 'shrinktheweb-website-preview-plugin').'</span>. '.__('This is fine, so you do not need to do anything more.', 'shrinktheweb-website-preview-plugin') : '<span class="stwwt_cache_status stwwt_cache_error">'.__('Not Writeable', 'shrinktheweb-website-preview-plugin').'</span>. '.__('This needs fixing for the thumbnail cache to work.', 'shrinktheweb-website-preview-plugin')))?>
	<?php
	
	$page->showPageFooter();
}

/**
 * Shows the page where the caching settings and information is shown.
 */
function STWWT_showPage_ErrorLogs()
{
	// To add at some point - shows if the cache directory is writeable.
	//$cachePath = STWWT_plugin_getCacheDirectory(); 
	//echo $isWriteable = (file_exists($cachePath) && is_dir($cachePath) && is_writable($cachePath));

	global $wpdb;
	$wpdb->show_errors();
	$error_log = $wpdb->prefix . STWWT_TABLE_ERRORS;		
	
	$page = new PageBuilder(false);
	$page->showPageHeader(__('Shrink The Web - Website Thumbnails - Error Logs', 'shrinktheweb-website-preview-plugin'), '70%');
	
	
	// Check for clear of logs
	if (isset($_POST['stwwt-clear-logs']))
	{
		// Delete error thumbnails
		STWWT_cache_emptyCache(true);
		
		$SQL = "TRUNCATE $error_log";
		$wpdb->query($SQL);
		
		$page->showMessage(__('Debug logs have successfully been emptied.', 'shrinktheweb-website-preview-plugin'));
	}
	
	
	// Refresh and Clear Buttons
	?>
		<form class="stwwt-button-right" method="post" action="<?= str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
			<input type="submit" name="stwwt-refresh-logs" value="<?= __('Refresh Logs','shrinktheweb-website-preview-plugin')?>" class="button-primary" />
			<input type="submit" name="stwwt-clear-logs" value="<?= __('Clear Logs','shrinktheweb-website-preview-plugin')?>" class="button-secondary" />
			<div class="stwwt-clear"></div>
		</form>	
	<?php 
		
		$SQL = "SELECT *, UNIX_TIMESTAMP(request_date) AS request_date_ts
				FROM $error_log
				ORDER BY request_date DESC
				LIMIT 50
				";
		
		$wpdb->show_errors();
		$logMsgs = $wpdb->get_results($SQL, OBJECT);

		if ($logMsgs)
		{
			printf('<div id="stwwt_error_count">'.__('Showing a total of %s log messages.', 'shrinktheweb-website-preview-plugin').'</div>', "<b>$wpdb->num_rows</b>");

			printf(__("<p>All <b>errors are cached for 12 hours</b> so that your thumbnail allowance with STW does not get used up if you have persistent errors. If you've <b>had errors</b>, and you've <b>now fixed them</b>, you can click on the '<b>Clear Logs</b>' button on the right to <b>flush the error cache</b> and re-attempt to fetch a thumbnail.</p>", 'shrinktheweb-website-preview-plugin'));

			$table = new TableBuilder();
			$table->attributes = array('id' => 'stwwt_error_log');
	
			$column = new TableColumn(__('ID', 'shrinktheweb-website-preview-plugin'), 'id');
			$column->cellClass = 'stwwt_id';
			$table->addColumn($column);
			
			$column = new TableColumn(__('Result', 'shrinktheweb-website-preview-plugin'), 'request_result');
			$column->cellClass = 'stwwt_result';
			$table->addColumn($column);			
			
			$column = new TableColumn(__('Requested URL', 'shrinktheweb-website-preview-plugin'), 'request_url');
			$column->cellClass = 'stwwt_url';
			$table->addColumn($column);
			
			$column = new TableColumn(__('Type', 'shrinktheweb-website-preview-plugin'), 'request_type');
			$column->cellClass = 'stwwt_type';
			$table->addColumn($column);
			
			$column = new TableColumn(__('Request Date', 'shrinktheweb-website-preview-plugin'), 'request_date');
			$column->cellClass = 'stwwt_request-date';
			$table->addColumn($column);
			
			$column = new TableColumn(__('Detail', 'shrinktheweb-website-preview-plugin'), 'request_detail');
			$column->cellClass = 'stwwt_detail';
			$table->addColumn($column);

			
			foreach ($logMsgs as $logDetail)
			{
				$rowdata = array();
				$rowdata['id'] 				= $logDetail->logid;
				$rowdata['request_url'] 	= $logDetail->request_url;
				$rowdata['request_type'] 	= $logDetail->request_type;
				$rowdata['request_result'] 	= '<span>'.($logDetail->request_result == 1 ? __('Success', 'shrinktheweb-website-preview-plugin') : __('Error', 'shrinktheweb-website-preview-plugin')).'</span>';
				$rowdata['request_date'] 	= $logDetail->request_date . '<br/>' . sprintf(__('about %s ago', 'shrinktheweb-website-preview-plugin'), human_time_diff($logDetail->request_date_ts));
				
				
				// Show arguments and details
				$rowdata['request_detail'] = sprintf('<span class="stwwt_debug_header">'.__('Error Message', 'shrinktheweb-website-preview-plugin').'</span>
					  									   <span class="stwwt_debug_info">%s</span>', $logDetail->request_error_msg);
				
				$rowdata['request_detail'] .= sprintf('<span class="stwwt_debug_header">'.__('Request Arguments', 'shrinktheweb-website-preview-plugin').'</span>
					  									   <span class="stwwt_debug_info">%s</span>', STWWT_debug_formatArray(unserialize($logDetail->request_args)));
				
				if ($logDetail->request_detail) {
					$rowdata['request_detail'] 	.= sprintf('<span class="stwwt_debug_header">'.__('Raw STW Response', 'shrinktheweb-website-preview-plugin').'</span>
					  									   <textarea class="stwwt_debug_raw" readonly="readonly">%s</textarea>', htmlentities($logDetail->request_detail));
				}

				$table->addRow($rowdata, ($logDetail->request_result == 1 ? 'stwwt_success' : 'stwwt_error'));
			}
			
			// Finally show table
			echo $table->toString();
			echo "<br/>";
		}
		else {
			printf('<div class="stwwt_clear"></div>');
			$page->showMessage(__('There are currently no debug logs to show.', 'shrinktheweb-website-preview-plugin'), true);
		}
	
	 
	$page->showPageFooter();
}





/**
 * Function that shows the settings page.
 */
function STWWT_showPage_Settings()
{
	/**
 	 * Constant: Documentation on how the mouseover bubble works.
 	 */
	define('STWWT_DESC_MOUSEOVER',		'
		<p><img src="'.STWWT_plugin_getPluginPath().'img/stw_bubble_example.png" class="stwwt_settings_bubble_example"/> 
		'.sprintf(__('The Shrink The Web mouseover bubble shows a thumbnail of the website when hovered over a link on your WordPress website. This gives website visitors a preview of the link before they visit the website you link to.','shrinktheweb-website-preview-plugin').'</p>
		<p>'.__('If the "%1$s" is selected below, all external links will show ShrinkTheWeb preview bubbles. Use %2$s to disable popup bubble for a specific link.','shrinktheweb-website-preview-plugin').'</p>
		<p>'.__('If the "%3$s" method is selected below, then you choose which links get a preview bubble by adding %4$s to any link where you want to show them.','shrinktheweb-website-preview-plugin').'</p>','<b>'.__('Automatic','shrinktheweb-website-preview-plugin').'</b>','<code>class="nopopup"</code>','<b>'.__('Manual','shrinktheweb-website-preview-plugin').'</b>','<code>class="stwpopup"</code>').'
		<div class="stwwt_clear"></div>
	');
	
	/**
 	 * Constant: Documentation on how the embedded code works.
 	 */	
	define('STWWT_DESC_EMBEDDED', '
		<p>'.sprintf(__('The Shrink The Web embed code shows a thumbnail for any link you wrap in %1$s or %2$s tags. Any use of these tags is replaced with the thumbnail of the website included in the tags.','shrinktheweb-website-preview-plugin').' '.'<a href="admin.php?page=stwwt_documentation#embed">'.__('See some examples on the documentation page','shrinktheweb-website-preview-plugin').'</a>.','<code>[thumb][/thumb]</code>','<code>[stwthumb][/stwthumb]</code>'));
	
	
	/**
 	 * Constant: Documentation on how the pro features work.
 	 */	
	define('STWWT_DESC_EMBEDDED_PRO',
		sprintf('<p>'.__('The following features <b>require an upgraded account</b>. You can find more details on the <a href="%1$s" target="_blank">Shrink The Web Upgrade Page</a>','shrinktheweb-website-preview-plugin').'.</p>
		<p>'.__('These settings are <b>global</b>, so they apply to <b>all thumbnails</b> on your website. Some of these settings have a per-thumbnail override, so please read <a href="%2$s">the documentation</a> on how to apply these settings to specific thumbnails.','shrinktheweb-website-preview-plugin').'</p>
	','https://shrinktheweb.com/auth/order-page','admin.php?page=stwwt_documentation'));


	STWWT_check_scheme_options();
	$page = new PageBuilder(true);
	$page->showPageHeader(__('Shrink The Web - Website Thumbnails - Settings', 'shrinktheweb-website-preview-plugin'), '70%');
	
	$page->openPane('stw_settings_main', __('Thumbnail Settings','shrinktheweb-website-preview-plugin'));
	
	
		
	$settingDetails = array(
	
		'stwwt_break_main' => array(
				'type'  				=> 'break',
				'html'  				=> STWWT_forms_createBreakHTML(__('Account Settings','shrinktheweb-website-preview-plugin')),
			),
	
		'stwwt_access_id' => array(
				'label' 	=> __('Access Key Id','shrinktheweb-website-preview-plugin'),
				'type'  	=> 'text',
				'required'  => true,
				'cssclass'	=> 'stwwt_access_id',
				'desc'  	=> sprintf(__('Your Shrink The Web <b>access</b> key. You can find this within your <a href="%s" target="_blank">STW Account Details</a>.','shrinktheweb-website-preview-plugin'),'https://shrinktheweb.com/auth/stw-lobby'),
				'validate'	 	=> array(
					'type'		=> 'string',
					'regexp'	=> '/^[A-Za-z0-9]{12,20}$/',
					'error'		=> __('Your STW access key should only contain numbers and letters, and it\'s about 15 characters long.','shrinktheweb-website-preview-plugin')
				)	
			),
			
		'stwwt_secret_id' => array(
				'label' 	=> __('Secret Key Id','shrinktheweb-website-preview-plugin'),
				'type'  	=> 'text',
				'required'  => true,
				'cssclass'	=> 'stwwt_access_id',
				'desc'  	=> sprintf(__('Your Shrink The Web <b>secret</b> key. You can find this within your <a href="%s" target="_blank">STW Account Details</a>.','shrinktheweb-website-preview-plugin'),'https://shrinktheweb.com/auth/stw-lobby'),
				'validate'	 	=> array(
					'type'		=> 'string',
					'regexp'	=> '/^[a-z0-9A-Z\'^£$%&*()}{@#~?!><>,|=_+¬-]{5,32}$/',
					'error'		=> __('Your STW secret key should only contain letters, numbers and special characters, and it\'s about 5-32 characters long.','shrinktheweb-website-preview-plugin')
				)	
			),			
			
		'stwwt_account_level' => array(
				'label' 	=> __('Your STW Account Level','shrinktheweb-website-preview-plugin'),
				'type'  	=> 'custom',
				'html'		=> false,
				'desc'  	=> __('If you change any aspects of your Shrink The Web account (such as upgrades), click on the <b>Save All Settings</b> button below to re-load what features you can use.','shrinktheweb-website-preview-plugin'),
			),							
				
			
		'stwwt_break_embedded' => array(
				'type'  				=> 'break',
				'html'  				=> STWWT_forms_createBreakHTML(__('Screenshot Settings','shrinktheweb-website-preview-plugin'), __('Save ALL Settings','shrinktheweb-website-preview-plugin')) .
							   '<div class="stwwt_description">'.STWWT_DESC_EMBEDDED.'</div>',
			),

		'stwwt_enable_https' => array(
			'label' => __('Enable HTTP Secure (HTTPS)','shrinktheweb-website-preview-plugin'),
			'type' => TidySettings_getSettingSingle(STWWT_SETTINGS_KEY,'stwwt_enable_https_set_automatically', false) ? 'hidden' : 'select',
			'data'=> array(
				0 => __('Disable','shrinktheweb-website-preview-plugin'),
				1 => __('Enable','shrinktheweb-website-preview-plugin'),
			),
			'desc' => __('Use HTTPS to get screenshots.','shrinktheweb-website-preview-plugin') . ' ' . __('This option disappears and HTTPS will be enabled automatically whenever HTTPS is detected.', 'shrinktheweb-website-preview-plugin'),
			'default' => '0'
		),

		'stwwt_enable_https_set_automatically' => array(
			'type' => 'break',
			'default' => '0'
		),

		'stwwt_shortcode' => array(
				'label' 				=> __('Shortcode Syntax','shrinktheweb-website-preview-plugin'),
				'type'  				=> 'radio',
				'data'					=> array(
												'stwthumb'	=> '<b>[stwthumb]</b>',
												'thumb' 	=> '[thumb]',
											),
				'default'				=> 'thumb'
			),
			
		'stwwt_embedded_default_size' => array(
				'label' 				=> __('Default Screenshot Size','shrinktheweb-website-preview-plugin'),
				'type'  				=> 'select',				
				'data'					=> array(
												'mcr'	=> __('Micro','shrinktheweb-website-preview-plugin').' (75x56)',
												'tny'	=> __('Tiny','shrinktheweb-website-preview-plugin').' (90x68)',
												'vsm'	=> __('Very Small','shrinktheweb-website-preview-plugin').' (100x75)',
												'sm'	=> __('Small','shrinktheweb-website-preview-plugin').' (120x90)',
												'lg' 	=> __('Large','shrinktheweb-website-preview-plugin').' (200x150)',
												'xlg' 	=> __('Extra Large','shrinktheweb-website-preview-plugin').' (320x240)'
											),	
				'desc'  				=> __('The size of the thumbnail shown by the thumbnail shortcode.','shrinktheweb-website-preview-plugin'),
				'default'				=> 'lg'
			),

		'stwwt_embedded_cache_length' => array(
				'label' 				=> __('Cache Length in Days','shrinktheweb-website-preview-plugin'),
				'type'  				=> 'select',				
				'data'					=> array(
												'-1'    => __('No caching (Embedded requests)','shrinktheweb-website-preview-plugin'),
												'3'		=> __('3 Days','shrinktheweb-website-preview-plugin'),
												'7'		=> __('7 Days (recommended)','shrinktheweb-website-preview-plugin'),
												'10'	=> __('10 Days','shrinktheweb-website-preview-plugin'),
												'14'	=> __('14 Days','shrinktheweb-website-preview-plugin'),
												'21'	=> __('21 Days','shrinktheweb-website-preview-plugin'),
												'30'	=> __('30 Days','shrinktheweb-website-preview-plugin')
											),	
				'desc'  				=> __('How long you want to cache the thumbnails for.','shrinktheweb-website-preview-plugin'),
				'default'				=> 7
			),

		'stwwt_embedded_pro_custom_quality' => array(
			'label' 				=> __('Custom Thumbnail Quality','shrinktheweb-website-preview-plugin'),
			'type'  				=> 'select',
			'data'					=> STWWT_getQualityList(),
			'desc'					=> __('If you want to customise the thumbnail image quality, then you can select a quality value between 1% and 100%. A value of <b>1% is the lowest quality</b>, and <b>100% is the best quality</b>.','shrinktheweb-website-preview-plugin'),
		),
			
		'stwwt_break_embedded_pro' => array(
				'type'  				=> 'break',
				'html'  				=> STWWT_forms_createBreakHTML(__('PRO Feature Settings','shrinktheweb-website-preview-plugin'), __('Save ALL Settings','shrinktheweb-website-preview-plugin')) .
							   				'<div class="stwwt_description">'.STWWT_DESC_EMBEDDED_PRO.'</div>',
			),

		'stwwt_embedded_pro_full_length' => array(
				'label' 				=> __('Full-length Page Captures','shrinktheweb-website-preview-plugin'),
				'type'  				=> 'radio',				
				'data'					=> array(
											'enable'	=> '<b>'.__('Enabled','shrinktheweb-website-preview-plugin').'</b>',
											'disable' 	=> __('Disabled','shrinktheweb-website-preview-plugin'),
										),	
				'account_feature' 		=> 'embedded_pro_full_length',
				'account_denied_msg' 	=> STWWT_FEATURE_UPGRADE,	
				'default'				=> 'disable'						
			),

		'stwwt_embedded_pro_custom_size' => array(
			'label' 	=> __('Custom Size','shrinktheweb-website-preview-plugin'),
			'type'  	=> 'text',
			'cssclass'	=> 'stwwt_custom_size',
			'desc'  	=> __('Use this option if you want to set custom thumbnail size e.g. 641x356 or just custom width e.g 573 (image height will be calculated automatically to fit 4:3 proportion). Default Screenshot Size will be ignored. This setting apply to all screenshots that do not use a shortcode option override.','shrinktheweb-website-preview-plugin'),
			'validate'	 	=> array(
				'type'		=> 'string',
				'regexp'	=> '/^[0-9xX]{1,11}$/',
				'error'		=> __('You must enter an integer for custom thumbnail size.','shrinktheweb-website-preview-plugin')
			),
			'account_feature' 		=> 'embedded_pro_custom_size',
			'account_denied_msg' 	=> STWWT_FEATURE_UPGRADE,
		),

		'stwwt_embedded_pro_custom_screen' => array(
			'label' 	=> __('Custom Viewport','shrinktheweb-website-preview-plugin'),
			'type'  	=> 'text',
			'cssclass'	=> 'stwwt_custom_screen',
			'desc'  	=> __('Use this option if you want to set custom browser size e.g. 1280x960. This setting apply to all screenshots that do not use a shortcode option override.','shrinktheweb-website-preview-plugin'),
			'validate'	 	=> array(
				'type'		=> 'string',
				'regexp'	=> '/^[0-9xX]{1,11}$/',
				'error'		=> __('You must enter an integer for custom viewport size.','shrinktheweb-website-preview-plugin')
			),
			'account_feature' 		=> 'embedded_pro_custom_size',
			'account_denied_msg' 	=> STWWT_FEATURE_UPGRADE,
		),

		'stwwt_break_bubble' => array(
			'type'  	=> 'break',
			'html'  	=> STWWT_forms_createBreakHTML(__('Mouseover Bubble Settings','shrinktheweb-website-preview-plugin'), __('Save ALL Settings','shrinktheweb-website-preview-plugin')) .
							'<div class="stwwt_description">'.STWWT_DESC_MOUSEOVER.'</div>',
			),
			
		'stwwt_bubble_method' => array(
				'label' 	=> __('Preview Bubbles Show Method','shrinktheweb-website-preview-plugin'),
				'type'  	=> 'select',				
				'data'		=> array(
									'disable'	=> __('Disabled','shrinktheweb-website-preview-plugin'),
									'automatic' => __('Automatic','shrinktheweb-website-preview-plugin'),
									'manual' 	=> __('Manual','shrinktheweb-website-preview-plugin')
								),	 
				'default'	=> 'disable'
			),
			
		'stwwt_bubble_size' => array(
				'label' 	=> __('Preview Bubbles Thumbnail Size','shrinktheweb-website-preview-plugin'),
				'type'  	=> 'select',				
				'data'		=> array(
									'sm'	=> __('Small','shrinktheweb-website-preview-plugin').' (120x90)',
									'lg' 	=> __('Large','shrinktheweb-website-preview-plugin').' (200x150)',
									'xlg' 	=> __('Extra Large','shrinktheweb-website-preview-plugin').' (320x240)'
								),	
				'desc'  	=> __('The size of the thumbnail shown in the preview bubble when a website visitor hovers over a link.','shrinktheweb-website-preview-plugin'),
				'default'	=> 'lg'
			),				
		
	);
		
	// Show main settings form
	$settings = new STWSettingsForm($settingDetails, STWWT_SETTINGS_KEY, 'stwwt_settings');
	$settings->setSaveButtonLabel(__('Save ALL Settings','shrinktheweb-website-preview-plugin'));
	$settings->show();
	
	
	// #### Support section
	$page->showPageMiddle('27%');
	
	$yes = sprintf('<img src="%simg/icon_%s.png" />', STWWT_plugin_getPluginPath(),  'tick');
	$no  = sprintf('<img src="%simg/icon_%s.png" />', STWWT_plugin_getPluginPath(),  'cross');
	
	// Feature check
	$accountSettings = TidySettings_getSettings(STWWT_SETTINGS_KEY_ACCOUNT);
	if ($accountSettings) 
	{
		$page->openPane('stw_settings_support', __('Your Account Features','shrinktheweb-website-preview-plugin'));

			echo '<table id="stwwt_feature_comp">';
				echo '<thead>';
					echo '<tr>';
						echo '<th>'.__('Feature','shrinktheweb-website-preview-plugin').'</th>';
						echo '<th>'.__('Your Account','shrinktheweb-website-preview-plugin').'</th>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
	
					// Now show the features
					unset($accountSettings['account_type']); // So we can just loop through settings.
					foreach ($accountSettings as $settingName => $enabled)
					{
						switch ($settingName)	
						{
							case 'embedded_pro_inside':
								printf('<tr><th>%s</th><td>%s</td></tr>', __('Inside Pages Capture','shrinktheweb-website-preview-plugin'), (1 == $enabled ? $yes : $no));
								break;
								
							case 'embedded_pro_full_length':
								printf('<tr><th>%s</th><td>%s</td></tr>', __('Full Length Capture','shrinktheweb-website-preview-plugin'), (1 == $enabled ? $yes : $no));
								break;
								
							case 'embedded_pro_custom_size':
								printf('<tr><th>%s</th><td>%s</td></tr>', __('Custom Sizes','shrinktheweb-website-preview-plugin'), (1 == $enabled ? $yes : $no));
								break;

							// Don't show feature
							default: 
								break;						}
					}
					
				echo '</tbody>';
			echo '</table>';
		
		$page->closePane();
	} // end of your feature list
		
	$page->openPane('stw_settings_support', __('Get a STW Account...','shrinktheweb-website-preview-plugin'));
	echo '<div id="stwwt_signup">';
			echo '<a href="https://shrinktheweb.com/user/register" target="_blank">';
				echo '<img src="https://shrinktheweb.com/uploads/stw-banners/shrinktheweb-234x60.gif" alt="'.__('Website Thumbnail Provider','shrinktheweb-website-preview-plugin').'" class="stwwt_settings_banner" width="234" height="60" alt="'.__('Register for a free account with Shrink The Web','shrinktheweb-website-preview-plugin').'">';
			echo '</a>';
			
			echo '<div class="stwwt_settings_banner_text">';
				echo '<span>'.__('Need an account?','shrinktheweb-website-preview-plugin').'</span>';
				echo '<a href="https://shrinktheweb.com/user/register" target="_blank" class="button-primary">'.__('Register for FREE','shrinktheweb-website-preview-plugin').'</a>';
			echo '</div>';
		echo '</div>';

	$page->closePane();

	
	// Donate
	$page->openPane('stw_settings_donate', __('Donate','shrinktheweb-website-preview-plugin'));
	echo '<div id="donate">';
	STWWT_showDonateButton();
	echo '</div>';
	$page->closePane();
			
	
	// Support
	$page->openPane('stw_settings_support', __('Help &amp; Support','shrinktheweb-website-preview-plugin'));

	echo '<p>'.__('If you\'ve got a problem with the plugin, please follow the following steps.','shrinktheweb-website-preview-plugin').'</p>';
	echo '<ol>';
		echo '<li>'.sprintf(__('Check the <a href="%s" target="_blank">Frequently Asked Questions</a> on WordPress.org. Your issue might already be answered or resolved.','shrinktheweb-website-preview-plugin'),'http://wordpress.org/extend/plugins/shrinktheweb-website-preview-plugin/faq/').'</li>';
		echo '<li>'.sprintf(__('Check the <a href="%s" target="_blank">plugin support forum</a> on WordPress.org. Someone might have had the same issue, and fixed it already.','shrinktheweb-website-preview-plugin'),'http://wordpress.org/tags/shrinktheweb-website-preview-plugin?forum_id=10').'</li>';
		echo '<li>'.sprintf(__('If you think the problem is a <b>plugin problem</b>, please raise the problem in the <a href="%s" target="_blank">plugin support forum</a> on WordPress.org, including <b>as much detail as possible</b>, including any <b>error messages</b>.','shrinktheweb-website-preview-plugin'),'http://wordpress.org/tags/shrinktheweb-website-preview-plugin?forum_id=10').'</li>';
		echo '<li>'.sprintf(__('If you think the problem is a <b>STW or STW account problem</b>, please raise the problem in the <a href="%s" target="_blank">STW support forum</a>, including <b>as much detail as possible</b>, including any <b>error messages</b>.','shrinktheweb-website-preview-plugin'),'https://shrinktheweb.com/forum').'</li>';
	echo '</ol>';
	
	echo '<br/>';
	echo '<div class="stwwt_title">'.__('A word about the plugin authors...','shrinktheweb-website-preview-plugin').'</div>';
	echo '<p>'.sprintf(__('This plugin and the <a href="%1$s" target="_blank">Shrink The Web</a> service has been developed and is provided by <a href="%2$s" target="_blank">Neosys Consulting, Inc.</a>','shrinktheweb-website-preview-plugin'),'https://shrinktheweb.com','https://neosys.net/profile.htm').'</p>';

	$page->closePane();
	
	$page->showPageFooter();
}



/**
 * Create a break bar for the forms, with a save button too.
 * @param String $title The title for the section.
 * @param String $buttonText The text for the button on the break section.
 * @return String The HTML for the section break.
 */
function STWWT_forms_createBreakHTML($title, $buttonText = null)
{
	$buttonText = is_null($buttonText) ? __('Save ALL Settings', 'shrinktheweb-website-preview-plugin') : $buttonText;
	return sprintf('
		<div class="stwwt_form_break">
			<input type="submit" value="%s" name="Submit" class="button-primary">						
			<h3>%s</h3>
			<div class="stwwt_clear">&nbsp;</div>
		</div>
	', $buttonText, $title);
}


/**
 * Nicely formats an array for debug purposes.
 * @param Array $array The array to format.
 * @return String The formatted array.
 */
function STWWT_debug_formatArray($array)
{
	$html = false;
	if (!$array) {
		return false;
	}
	
	foreach ($array as $key => $value) 
	{
		$html .= sprintf('[%s] => %s<br/>', $key, urldecode($value));
	}
	
	return $html;
}


/**
 * Show donate button.
 */
function STWWT_showDonateButton()
{
	printf('<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="%s">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>', __('PayPal - The safer, easier way to pay online!', 'shrinktheweb-website-preview-plugin'));
}
<?php
/**
 * Plugin Name: ShrinkTheWeb Website Thumbnails
 * Plugin URI: http://wordpress.org/extend/plugins/shrinktheweb-website-preview-plugin/
 * Description: Add ShrinkTheWeb Link Previews to your blog.
 * Version: 2.8.5
 * Text Domain: shrinktheweb-website-preview-plugin
 * Domain Path: /languages
 * Author: Neosys Consulting, Inc.
 * Author URI: https://neosys.net/profile.htm
 * Tags: homepage,website,thumbnail,thumbnails,thumb,screenshot,snapshot,link,links,images,image
*/

/** Constant: The current version of the database needed by this version of the plugin.  */
define('STWWT_VERSION', 							'2.8.5');

/** Constant: The database key for all of the settings.  */
define('STWWT_SETTINGS_KEY', 						'stwwt_main_settings');

/** Constant: The database key for all of the account info.  */
define('STWWT_SETTINGS_KEY_ACCOUNT', 				'stwwt_main_settings_account');

/** Constant: The database key for the current version.  */
define('STWWT_SETTINGS_VERSION', 					'stwwt_main_settings_version');

/** Constant: The name of the table of errors. */
define('STWWT_TABLE_ERRORS',						'stw_error_log');


// Common
include_once('wplib/utils_settings.inc.php');

// Only load these PHP files when in admin area
if (is_admin())
{
	include_once('wplib/utils_pagebuilder.inc.php');
	include_once('wplib/utils_tablebuilder.inc.php');
	
	// Main Backend functionality
	include_once('lib/stw_settings_class.inc.php');
	include_once('lib/admin_only.inc.php');	
}

// Only load these PHP files when in frontend
else {
	// Main Frontend functionality
	include_once('lib/frontend_only.inc.php');
}


/* Load translation files */
add_action('init', 'stwwt_load_textdomain');
function stwwt_load_textdomain() {
	load_plugin_textdomain( 'shrinktheweb-website-preview-plugin', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}


/**
 * Function called when the plugin is initialised.
 */
function STWWT_plugin_init()
{
	// Backend only code
	if (is_admin())
	{
		// Menus
		add_action('admin_menu', 	'STWWT_plugin_mainMenu');
		add_action('admin_head', 	'STWWT_plugin_renameFirstMenuEntry'); 
		
		// Scripts/Styles
		add_action('admin_print_styles',  'STWWT_plugin_styles_Backend');

		if (current_user_can('administrator') && !empty($_GET['page']) && $_GET['page'] === 'stwwt_menu_main') {
			$dismiss_notice = get_option('stwwt_dismiss_notice');
			$dismiss_notice_time = get_option('stwwt_dismiss_notice_time');
			if (!$dismiss_notice && (time() - $dismiss_notice_time) > 45 * 24 * 60 * 60) {
				add_action('admin_notices', 'STWWT_show_thanks_admin_notice');
			}
		}
	}
	
	// Frontend only code
	else 
	{
		// Bubble mouseover 
		add_action('wp_footer', 'STWWT_plugin_addAutoPopupJS');
				
		// Shortcodes
		$allSettings = TidySettings_getSettings(STWWT_SETTINGS_KEY);
		if ($allSettings['stwwt_shortcode'] == 'thumb')
		  add_shortcode('thumb', 'STWWT_shortcode_showThumbnail' );
        else
		  add_shortcode('stwthumb', 'STWWT_shortcode_showThumbnail' );
	}

	// Add custom links to plugins page
	add_filter( 'plugin_action_links', 'STWWT_add_custom_plugin_actions', 10, 5 );
}
add_action('init', 'STWWT_plugin_init');


function STWWT_show_thanks_admin_notice()
{
	$stwwt_dismiss_notice_nonce = wp_create_nonce('stwwt_dismiss_notice_nonce');
	echo '<div id="stwwt-thanks-notice" class="updated notice">

	<h2>' . __("Thank you for using the ShrinkTheWeb Previews plugin! We see that you've been using this plugin for 45 days, so we hope you are thrilled with it!", 'shrinktheweb-website-preview-plugin') . '</h2>	
	<a href="https://www.shrinktheweb.com/"><img alt="Shrink The Web" src="' . STWWT_plugin_getPluginPath() . '/img/stw_logo.jpg"></a>
	<p>' . sprintf(__('First, we wanted to mention that if you have a need to create a portfolio, then please take a look at the %s plugin.', 'shrinktheweb-website-preview-plugin'), '<a href="https://wordpress.org/plugins/wp-portfolio/">WordPress Portfolio (WP Portfolio)</a>') . '</p>
	<p>' . __('Now, if you LOVE this plugin, we\'d like to ask you to take a moment and leave a very positive review. :)', 'shrinktheweb-website-preview-plugin') . '</p>

	<p>
		<a href="https://wordpress.org/plugins/shrinktheweb-website-preview-plugin/#reviews">' . __('Sure, I\'ll write a review', 'shrinktheweb-website-preview-plugin') . '</a> | 
		<a href="#" onclick="jQuery(\'#stwwt-thanks-notice\').slideUp(\'10\'); jQuery.post(ajaxurl, {action: \'stwwt_dismiss_notice_ajax\', subaction: \'dismiss_notice\', nonce: \'' . $stwwt_dismiss_notice_nonce . '\' });">' . __('I\'ve already reviewed this plugin', 'shrinktheweb-website-preview-plugin') . '</a> | 
		<a href="#" onclick="jQuery(\'#stwwt-thanks-notice\').slideUp(\'10\'); jQuery.post(ajaxurl, {action: \'stwwt_dismiss_notice_ajax\', subaction: \'dismiss_notice_later\', nonce: \'' . $stwwt_dismiss_notice_nonce . '\' });">' . __('Maybe later', 'shrinktheweb-website-preview-plugin') . '</a> | 
		<a href="http://feedback.shrinktheweb.com">' . __('Request a new feature or enhancement', 'shrinktheweb-website-preview-plugin') . '</a> | 
		<a href="#" onclick="jQuery(\'#stwwt-thanks-notice\').slideUp(\'10\'); jQuery.post(ajaxurl, {action: \'stwwt_dismiss_notice_ajax\', subaction: \'dismiss_notice\', nonce: \'' . $stwwt_dismiss_notice_nonce . '\' });">' . __('Dismiss this notice', 'shrinktheweb-website-preview-plugin') . '</a>
	</p>

	<p>&nbsp;</p>
	<button type="button" class="notice-dismiss" onclick="jQuery(\'#stwwt-thanks-notice\').slideUp(\'10\'); jQuery.post(ajaxurl, {action: \'stwwt_dismiss_notice_ajax\', subaction: \'dismiss_notice_later\', nonce: \'' . $stwwt_dismiss_notice_nonce . '\' });"><span class="screen-reader-text">' . __('Dismiss this notice.', 'shrinktheweb-website-preview-plugin') . '</span></button>
	</div>';
}

/**
 * Executed when the plugin is installed and activated.
 */
function STWWT_plugin_install()
{
	// Migrate the old settings (only if new settings don't already exist).
	STWWT_plugin_migrateSettings(false);	
			
	// Update the version of the settings
	update_option(STWWT_SETTINGS_VERSION, STWWT_VERSION);
	
	// Table names
	global $wpdb;
	$error_log = $wpdb->prefix . STWWT_TABLE_ERRORS;
	
	// #### Create the error log
	$SQL = "CREATE TABLE `$error_log` (
				  `logid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				  `request_url` varchar(255) NOT NULL,
				  `request_result` varchar(5) NOT NULL DEFAULT 'error',
				  `request_args` text NOT NULL,
				  `request_detail` text NOT NULL,
				  `request_type` varchar(25) NOT NULL,
				  `request_date` datetime NOT NULL,
				  `request_param_hash` varchar(35) NOT NULL,
				  `request_error_msg` varchar(200) NOT NULL,
				  PRIMARY KEY (`logid`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";

	STWWT_check_scheme_options();

	STWWT_plugin_install_installTable($error_log, $SQL, true);

	if (get_option('stwwt_dismiss_notice') === FALSE) {
		update_option('stwwt_dismiss_notice', 0);
	}

	if (get_option('stwwt_dismiss_notice_time') === FALSE) {
		update_option('stwwt_dismiss_notice_time', time());
	}

	// Try to create the cache directory
	STWWT_cache_createCacheDirectory();
}
register_activation_hook( __FILE__, 'STWWT_plugin_install');



/**
 * Install or upgrade a table for this plugin.
 * @param String $tableName The name of the table to upgrade/install.
 * @param String $SQL The core SQL to create or upgrade the table
 * @param String $upgradeTables If true, we're upgrading to a new level of database tables.
 */
function STWWT_plugin_install_installTable($tableName, $SQL, $upgradeTables)
{
	global $wpdb;
	
	// Determine if the table exists or not.
	$tableExists = ($wpdb->get_var("SHOW TABLES LIKE '$tableName'") == $tableName);
	
	// Table doesn't exist or needs upgrading
	if (!$tableExists || $upgradeTables) 
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($SQL);
	}
}


/**
 * Migrates settings from the older version of the plugin to a single entry if settings
 * cannot be found for the new style of data.
 * 
 * @param Boolean $forceMigrate If true, then force the migration of data from the old version.
 */
function STWWT_plugin_migrateSettings($forceMigrate = false)
{
	// Check we have existing settings - if not, do a migration.
	$allSettings = TidySettings_getSettings(STWWT_SETTINGS_KEY);
	if (!(!$allSettings || $forceMigrate)) {
		return false;
	}
		
	// Default cache length
	$allSettings['stwwt_embedded_cache_length'] = '7';
	
	
	
	// Access ID
	$stw_keyid = get_option('STWThumbnails_KeyId');
	if ($stw_keyid) {
		$allSettings['stwwt_access_id'] = $stw_keyid;
	}

	// Thumbnail Bubble	Method
	$stw_enable	= get_option('STWThumbnails');
	$stw_method = get_option('STWThumbnails_method');
	if ($stw_enable && $stw_method) 
	{
		// See if manual or automatic
		if ($stw_method == 'manual') {
			$allSettings['stwwt_bubble_method'] = 'manual';
		}
		
		// Default is automatic
		else {
			$allSettings['stwwt_bubble_method'] = 'automatic';
		}
	} 
	// Disabled
	else {
		$allSettings['stwwt_bubble_method'] = 'disable';
	}
	
	
	// Thumbnail Bubble Size 
	$stw_sz	= get_option('STWThumbnails_sz');
	if (in_array($stw_sz, array('xlg', 'lg', 'sm'))) {
		$allSettings['stwwt_bubble_size'] = $stw_sz;
	} else {
		$allSettings['stwwt_bubble_size'] = 'lg';
	}
	
	// Embedded thumbnail size
	$stw_embedsz = get_option('STWThumbnails_embedsz');
	if (in_array($stw_embedsz, array('xlg', 'lg', 'sm', 'vsm', 'tny', 'mcr'))) {
		$allSettings['stwwt_embedded_default_size'] = $stw_embedsz;
	} else {
		$allSettings['stwwt_embedded_default_size'] = 'lg';
	}
	
	// Pro Features - Specific Pages
	$stw_permspec = get_option('STWThumbnails_permspec');
	if ($stw_permspec) {
		$allSettings['stwwt_embedded_pro_inside'] = 'enable';
	} else {
		$allSettings['stwwt_embedded_pro_inside'] = 'disable';
	}
	
	// Pro Features - Full Length
	$stw_permfull = get_option('STWThumbnails_permfull');
	if ($stw_permfull) {
		$allSettings['stwwt_embedded_pro_full_length'] = 'enable';
	} else {
		$allSettings['stwwt_embedded_pro_full_length'] = 'disable';
	}	
	
	// Pro Features - Custom Quality
	$stw_permqual = get_option('STWThumbnails_permqual');
	$allSettings['stwwt_embedded_pro_custom_quality'] = false;
	if ($stw_permqual) 
	{
		// Only copy quality if enabled and set to a number greater than 0.
		$stw_stwq = get_option('STWThumbnails_stwq');
		if ($stw_stwq+0 > 0) {
			$allSettings['stwwt_embedded_pro_custom_quality'] = $stw_stwq+0;
		}
	}


	// Save settings
	TidySettings_saveSettings($allSettings, STWWT_SETTINGS_KEY);
	
	// Remove all previous settings
	delete_option('STWThumbnails');
	delete_option('STWThumbnails_KeyId');
	delete_option('STWThumbnails_sz');
	delete_option('STWThumbnails_embedsz');
	delete_option('STWThumbnails_permspec');
	delete_option('STWThumbnails_permfull');
	delete_option('STWThumbnails_permqual');
	delete_option('STWThumbnails_stwq');
	delete_option('STWThumbnails_method');	
}


/**
 * Function called to show the main STW plugin menu.
 */
function STWWT_plugin_mainMenu()
{	
	add_menu_page('Shrink The Web - '.__('Website Thumbnail Settings', 'shrinktheweb-website-preview-plugin'), 'Shrink The Web', 'manage_options', 'stwwt_menu_main', 'STWWT_showPage_Settings');
	
	add_submenu_page('stwwt_menu_main', 	'Shrink The Web - '.__('How to use the plugin', 'shrinktheweb-website-preview-plugin'), 		__('How to use', 'shrinktheweb-website-preview-plugin'), 	'manage_options', 'stwwt_documentation', 'STWWT_showPage_Documentation');
	
	// Show caching/error log information.
    $errorCount = STWWT_debug_getErrorCount();
	$errorCountMsg = false;
	if ($errorCount > 0) {
		$errorCountMsg = sprintf('<span title="%d Error" class="update-plugins"><span class="update-count">%d</span></span>', $errorCount, $errorCount);
	}
		
	add_submenu_page('stwwt_menu_main', 	'Shrink The Web - '.__('Error Logs', 'shrinktheweb-website-preview-plugin'), 		__('Error Logs', 'shrinktheweb-website-preview-plugin') .$errorCountMsg, 	'manage_options', 'stwwt_error_logs', 'STWWT_showPage_ErrorLogs');
	add_submenu_page('stwwt_menu_main', 	'Shrink The Web - '.__('Thumbnail Cache', 'shrinktheweb-website-preview-plugin'), 	__('Thumbnail Cache', 'shrinktheweb-website-preview-plugin'), 					'manage_options', 'stwwt_thumb_cache', 'STWWT_showPage_ThumbnailCache');
}


/**
 * Appropriately names the first entry in our custom menu.
 */
function STWWT_plugin_renameFirstMenuEntry()
{
	global $submenu;
	
	$title = 'stwwt_menu_main';
	
	// Not found
	if (!isset($submenu[$title])) {
		return false;
	}

	$submenu[$title][0][0] =__('Settings', 'shrinktheweb-website-preview-plugin');
}





/**
 * Creates a thumbnail for the specified URL and returns it.
 * 
 * @param String $url The URL of the thumbnail to create.
 * @param String $addLink If true, then add a clickable link to the thumbnail.
 * @param $showCustomSize If specified, then use the specified size for a thumbnail.
 * @param $showFullLength If 'full', show full length, if 'normal', force normal, if false, use default.
 * 
 * @return String The HTML for the thumbnail.
 */
function STWWT_thumbnail_createThumbnail($url, $addLink = false, $showCustomSize = false,
	$showFullLength = false, $customFileName = false, $alt = false, $title = false, $screen = false)
{
	$allSettings = TidySettings_getSettings(STWWT_SETTINGS_KEY);	
	$accountSettings =  TidySettings_getSettings(STWWT_SETTINGS_KEY_ACCOUNT);
	
	// Common Defaults
	$args = array();
	$args["stwaccesskeyid"] = $allSettings['stwwt_access_id'];
	$args["stwsize"] 		= $allSettings['stwwt_embedded_default_size'];

	if (STWWT_account_featuredAllowed('embedded_pro_custom_size') &&
	    (preg_match('/^(\d+)x(\d+)$/', $allSettings['stwwt_embedded_pro_custom_size']) || is_numeric($allSettings['stwwt_embedded_pro_custom_size'])))
	{
		$args["stwsize"] = $allSettings['stwwt_embedded_pro_custom_size'];
	}

	// Check if override for size is given.
	if ($showCustomSize)
	{
		// Check for standard STW size parameter (for free or paid accounts)
		$showCustomSize = strtolower($showCustomSize);
		if (in_array($showCustomSize, array('xlg', 'lg', 'sm', 'vsm', 'tny', 'mcr')) || preg_match('/^(\d+)x(\d+)$/', $showCustomSize) || is_numeric($showCustomSize))
		{
			$args["stwsize"] = $showCustomSize;
		}
	}

	if (STWWT_account_featuredAllowed('embedded_pro_custom_size') && preg_match('/^(\d+)x(\d+)$/', $allSettings['stwwt_embedded_pro_custom_screen']))
	{
		$args["stwscreen"] = $allSettings['stwwt_embedded_pro_custom_screen'];
	}

	if ($screen)
	{
		$screen = strtolower($screen);
		if (preg_match('/^(\d+)x(\d+)$/', $screen))
		{
			$args["stwscreen"] = $screen;
		}
	}

	// #### Download and Cache Method
	// Settings for specifically fetching details
	$args["stwembed"] 	= 0; // We want XML data returned		
	$args["stwu"] 		= $allSettings['stwwt_secret_id'];	

	// ### Pro Settings (need to go before URL)
	// Full Length feature allowed?
	if (STWWT_account_featuredAllowed('embedded_pro_full_length'))
	{  
		if ('full' == $showFullLength ||  // Check that full override requested
		   (false == $showFullLength && 'enable' == $allSettings['stwwt_embedded_pro_full_length'])) // Check if default requested
		{
			$args["stwfull"] = '1';

			// Change size to match width of chosen thumbnail size.
			switch ($args['stwsize'])
			{
				case 'mcr':
					$args['stwsize'] = '75';
					break;
				case 'tny':
					$args['stwsize'] = '90';
					break;
				case 'vsm':
					$args['stwsize'] = '100';
					break;
				case 'sm' :
					$args['stwsize'] = '120';
					break;
				case 'lg' :
					$args['stwsize'] = '200';
					break;
				case 'xlg':
					$args['stwsize'] = '320';
					break;
			}
		}
	}
		
	// Quality
	if ($allSettings['stwwt_embedded_pro_custom_quality'] > 0 && STWWT_account_featuredAllowed('embedded_pro_custom_quality')) {
		$args["stwq"] = $allSettings['stwwt_embedded_pro_custom_quality'];
	}

	// URL (needs to be last)
	$args["stwurl"]	= urlencode($url);
				
	// Finally do the request
	$thumbURL = STWWT_fetch_thumbnail($args, $customFileName);

	// Add link to website using the URL if requested
	if ($addLink) {
		// Class of nopopup is added to link to prevent auto mouseover from showing.
		$html = '<div class="stw_thumbnail_wrapper">
					<a href="' . esc_url($url) . '" class="nopopup">
						<img src="' . esc_url($thumbURL) . '" class="stw_thumbnail stw_embed"alt="'
		                    . esc_attr($alt) . '" title="' . esc_attr($title) . '" />
					</a>
				</div>';
	} else {
		$html = '<div class="stw_thumbnail_wrapper">
					<img src="' . esc_url($thumbURL) . '" class="stw_thumbnail stw_embed" alt="'
		                . esc_attr($alt) . '" title="' . esc_attr($title) . '" />
				</div>';
	}
		
	return $html;
}


/**
 * Requests a thumbnail for the specified website, using the cache or a live
 * fetch, depending on if the image already exists in the cache.
 *  
 * @param Array $args The list of arguments required to request the thumbnail capture.
 */
function STWWT_fetch_thumbnail($args, $customFileName = false)
{
	// Check cache for thumbnail
	if ($customFileName)
	{
		$customFileName = html_entity_decode($customFileName);
		$customFileName = preg_replace('/[^A-Za-z0-9\. _-]/', '', $customFileName);
		$customFileName = preg_replace('/\\s+/', '_', $customFileName);
		if ($customFileName != '')
		{
			$cacheFilename = $customFileName . '_' . md5( serialize( $args ) ) . '.jpg';
		}
	}
	else {
		$cacheFilename = md5( serialize( $args ) ) . '.jpg';
	}
	$cachePath = STWWT_plugin_getCacheDirectory($cacheFilename);

	// Grab the cache length from the setting. Set a default of 7 days.
	$cacheDays = TidySettings_getSettingSingle(STWWT_SETTINGS_KEY, 'stwwt_embedded_cache_length') + 0;
	if ($cacheDays == -1)
	{
		// ONLY on "Advanced" method requests!! (not allowed on embedded).
		unset($args['stwu']);
		$args['stwembed'] = 1;

		$protocol = TidySettings_getSettingSingle(STWWT_SETTINGS_KEY, 'stwwt_enable_https') ? 'https:' : 'http:';
		$imageUrl = urldecode($protocol . '//images.shrinktheweb.com/xino.php?' . http_build_query($args, '', '&'));
		return $imageUrl;
	}
	else {
		// Check cache if site was involved with an error of any kind....
		$useCachedThumb = FALSE;
		$errorThumb     = FALSE;

		// Still got a cached error, so don't do anything other than
		// use the cached thumbnail.
		if ( STWWT_debug_gotCachedError( $args, $cacheFilename ) ) {
			$useCachedThumb = TRUE;
			$errorThumb     = TRUE;
		}

		// There was no cached error, so now we need to check that the
		// thumbnail has expired or not.
		else {
			// Are we using the cache? If so, check file exists in the cache...
			if ( $cacheDays > 0 && file_exists( $cachePath ) ) {
				$cacheCutoffDate = time() - ( 86400 * $cacheDays );

				// File is still within cache date, so just use cached file
				if ( filemtime( $cachePath ) > $cacheCutoffDate ) {
					$useCachedThumb = TRUE;
				}
			}// end of if cacheDays
		}

		if ( $useCachedThumb ) {
			return STWWT_plugin_getCacheURL( $cacheFilename, $errorThumb );
		} else {
			// File is not in cache, or we need a live version, so return it.
			return STWWT_fetch_requestThumbnailCapture( $args, $cacheFilename );
		}
	}
}



/**
 * Fetches a thumbnail from STW using the thumbnail fetching service, logging any errors if they occur.
 * 
 * @param Array $args The list of arguments required to request the thumbnail capture.
 * @return String The URL for the thumbnail to show, or false if there was a problem fetching the thumbnail.
 */
function STWWT_fetch_requestThumbnailCapture($args, $cacheFilename = false)
{
	// Use WP method of fetch for compatibility
	$protocol = TidySettings_getSettingSingle(STWWT_SETTINGS_KEY, 'stwwt_enable_https') ? 'https:' : 'http:';
	$fetchURL = urldecode("$protocol//images.shrinktheweb.com/xino.php?".http_build_query($args));
	
	$resp = wp_remote_get($fetchURL);
	$http_code = wp_remote_retrieve_response_code($resp);
	$remotedata = wp_remote_retrieve_body($resp);
	
	if (is_wp_error($resp)) {
		$err = $resp->get_error_code();
		$errmsg = $resp->get_error_message();
		$result = __('Request HTTP Code:','shrinktheweb-website-preview-plugin') . ' ' . $http_code . '(' . $err . '): ' . $errmsg;
		STWWT_debug_logError($args, 'web', false, $result, __('Did not get HTTP 200 OK result from ShrinkTheWeb.com', 'shrinktheweb-website-preview-plugin'));
		return false;
	}
	
	// Process XML response from server
	$resultData = STWWT_fetch_xml_processReturnData($remotedata);
	switch ($resultData['status'])
	{
		// Return the cached error message
		case 'error':
				// Error logging, as something was wrong.
				STWWT_debug_logError($args, 'web', false, $remotedata, __('Request HTTP Code:','shrinktheweb-website-preview-plugin') . ' ' . $http_code . '<br />' . $resultData['msg']);
				
				// Check that we have a thumbnail. If not, give the default account problem
				// thumbnail.
				if (!$resultData['thumbnail']) 
				{
					$errorArgs = array();
					$errorArgs['stwaccesskeyid'] = 'accountproblem';

					if (isset($args['stwsize'])) {
						$errorArgs['stwsize'] = $args['stwsize'];
					}
					
					// Minimal handling of error path here, as we're already in an error state.
					// So just abort if we can't get the error thumbnail.
					$protocol = TidySettings_getSettingSingle(STWWT_SETTINGS_KEY, 'stwwt_enable_https') ? 'https:' : 'http:';
					$fetchURL = urldecode("$protocol//images.shrinktheweb.com/xino.php?".http_build_query($errorArgs));
					$respError = wp_remote_get($fetchURL);	
					if (!is_wp_error($respError))
					{
						// Return thumbnail for caching as usual below.
						$resultDataError = STWWT_fetch_xml_processReturnData($respError['body']);
						if ($resultDataError['thumbnail']) { 
							$resultData['thumbnail'] = $resultDataError['thumbnail'];
						}
					}
				}
				
				// Cache error thumbnail, and return it. Saves hitting server hard when errors.
				return STWWT_fetch_downloadRemoteImageToLocalPath($resultData['thumbnail'], $args, true, $cacheFilename);
			break;
			
		// Just returned the image queued message without caching
		case 'queued':
				return $resultData['thumbnail'];
			break;
			
		// Cache image, and then return cached image
		case 'success':
				return STWWT_fetch_downloadRemoteImageToLocalPath($resultData['thumbnail'], $args, false, $cacheFilename);
			break;
	}
}





/**
 * Insert data into the database.
 * @param String $tablename The name of the table to insert the data into.
 * @param String $dataarray The map of column names to key values to insert into the table.
 */
function STWWT_database_arrayToSQLInsert($tablename, $dataarray)
{
	global $wpdb; 
	
	// Handle dodgy data
	if (!$tablename || !$dataarray || count($dataarray) == 0) {
		return false;	
	}
	
	$SQL = "INSERT INTO $tablename (";
	
	// Insert Column Names
	$columnnames = array_keys($dataarray);
	foreach ($columnnames AS $column) {
		$SQL .= sprintf('`%s`, ', $column);
	}
	
	// Remove last comma to maintain valid SQL
	if (substr($SQL, -2) == ', ') {
		$SQL = substr($SQL, 0, strlen($SQL)-2);
	}
	
	$SQL .= ") VALUES (";
	
	// Now add values, escaping them all
	foreach ($dataarray AS $columnname => $datavalue) {
		$SQL .= "'" . $wpdb->escape($datavalue) . "', ";
	}
	
	// Remove last comma to maintain valid SQL
	if (substr($SQL, -2) == ', ') {
		$SQL = substr($SQL, 0, strlen($SQL)-2);
	}	
	
	return $SQL . ")";
}


/**
 * Method to get image at the specified remote URL and attempt to save it to the specifed local cache path.
 * @param String $remoteURL The URL of the remote image to download.
 * @param Array $args The list of arguments needed to fetch an image.
 * @param Boolean $errorThumb If true, the file should be downloaded to an error filename.
 */
function STWWT_fetch_downloadRemoteImageToLocalPath($remoteURL, $args, $errorThumb, $_cacheFilename = false)
{
	$resp = wp_remote_get($remoteURL);
	$http_code = wp_remote_retrieve_response_code($resp);

	// Some kind of error from STW? e.g. empty request
	if (is_wp_error($resp)) 
	{
		$err = $resp->get_error_code();
		$errmsg = $resp->get_error_message();
		$result = __('Request HTTP Code:','shrinktheweb-website-preview-plugin') . ' ' . $http_code . '(' . $err . '): ' . $errmsg;
		STWWT_debug_logError($args, 'web', false, $result, __('Did not get HTTP 200 OK when downloading thumbnail image.','shrinktheweb-website-preview-plugin'));
		return false;
	}
	else if (200 != $http_code) {
		
		STWWT_debug_logError($args, 'web', false, __('Request HTTP Code:','shrinktheweb-website-preview-plugin') . ' ' . $http_code, __('Did not get HTTP 200 OK when downloading thumbnail image.','shrinktheweb-website-preview-plugin'));
		return false;
	}
	
	$imagedata = wp_remote_retrieve_body($resp);

	if ($_cacheFilename)
	{
		$cacheFilename = $_cacheFilename;
	}
	else
	{
		$cacheFilename = md5( serialize( $args ) ) . '.jpg';
	}
	$createFilepath = STWWT_plugin_getCacheDirectory($cacheFilename, $errorThumb); 
	
	// Only save data if we managed to get the file contents
	if ($imagedata) 
	{
		$fh = fopen($createFilepath, "w+");
		fputs($fh, $imagedata);
		fclose($fh);
		
		return STWWT_plugin_getCacheURL($cacheFilename, $errorThumb);
	} 
	
	STWWT_debug_logError($args, 'web', false, __('Request HTTP Code:','shrinktheweb-website-preview-plugin') . ' ' . $http_code . ' ' . $imagedata, __('Empty image data from ShrinkTheWeb.com.','shrinktheweb-website-preview-plugin'));
	return false;
}



/**
 * Process the XML data from STW, and turn it into meaningful messages that we can return to the use.
 * @param String $data The raw XML data from the XML web service.
 * @return Array The details of the fetch results ([msg] = Raw message returned, [status] = interpreted message, [thumbnail] = thumbnail URL if all is ok.
 */
function STWWT_fetch_xml_processReturnData($data)
{
	if (!$data) {
		$returndata['status'] 		= 'error';
		$returndata['msg'] 	  		= __('Data from STW was empty.','shrinktheweb-website-preview-plugin');
		$returndata['thumbnail']	= false;
		return $returndata;
	}
	
	$stw_response_status = false;
	
	// SimpleXML loaded in PHP	
	if (extension_loaded('simplexml')) 
	{
		$returndata = array();

		// Load XML into DOM object
		$dom 		= new DOMDocument;
		$dom->loadXML($data);
		$xml 		= simplexml_import_dom($dom);
		$xmlLayout  = 'http://www.shrinktheweb.com/doc/stwresponse.xsd';

		// Pull response codes from XML feed
		$stw_response_status	= (string)$xml->children($xmlLayout)->Response->ResponseStatus->StatusCode; // HTTP Response Code
		$thumbnail				= (string)$xml->children($xmlLayout)->Response->ThumbnailResult->Thumbnail[0]; // Image Location (alt method)
		$stw_action				= (string)$xml->children($xmlLayout)->Response->ThumbnailResult->Thumbnail[1]; // ACTION
		$parseMethod            = 'simplexml';

	} // endif if (extension_loaded('simplexml'))

	// SimpleXML not loaded in PHP.
	else 
	{
		// Check for thumbnail
		if (preg_match('/<[^:]*:Thumbnail\\s*(?:Exists=\"((?:true)|(?:false))\")?[^>]*>([^<]*)<\//', $data, $matches)) {
			$thumbnail = $matches[2];
		}

		// Check for stw_action
		if (preg_match('/<[^:]*:Thumbnail\\s*(?:Verified=\"((?:true)|(?:false))\")[^>]*>([^<]*)<\//', $data, $matches)) {
			$stw_action = $matches[2];
		}

		// Check for response code.
		if (preg_match('/<[^:]*:ResponseStatus>[^:]*:StatusCode>([^>]*)<\/[^:]*:StatusCode>[^:]*:ResponseStatus>/', $data, $matches)) {
			$stw_response_status = $matches[1];
		}
		$parseMethod = 'legacy regex';
	}

	// ### Format data for returning
	$returndata['thumbnail'] 	= $thumbnail; 
	$returndata['stw_status'] 	= $stw_response_status;
	$returndata['stw_action'] 	= $stw_action;
	
	// ### Check if everything was ok....
	switch($stw_action)
	{
		// Situations where there's a valid thumbnail to use 
		case 'delivered':
				$returndata['status'] 	= 'success';	
				$returndata['msg'] 		= __('Thumbnail delivered successfully.','shrinktheweb-website-preview-plugin');
			break;	
	
		// Situation where things are OK, but there's no thumbnail yet
		case 'queued':
		case 'noexist':
				$returndata['msg'] 		= __('Thumbnail queued for update.','shrinktheweb-website-preview-plugin');
				$returndata['status'] 	= 'queued';
			break;
		 	
		// Remaining status situations are errors
		default:
				$returndata['msg'] = $stw_response_status;

				// Invalid API details
				if (strpos($stw_response_status, 'Invalid Credentials') !== FALSE) {
					$returndata['stw_status'] = 'invalid_api_access_details';
				}

				// Need IP or host locking
				else if (strpos($stw_response_status, 'Lock to account') !== FALSE) {
					$returndata['stw_status'] = 'lock_to_account';
				}

				// Unknown site
				else if (strpos($stw_response_status, 'NS_ERROR_UNKNOWN_HOST') !== FALSE) {
					$returndata['stw_status'] = 'unknown_host';
				}

				// Need to upgrade to Basic/Plus
				else if (strpos($stw_response_status, 'Upgrade account') !== FALSE) {
					$returndata['stw_status'] = 'upgrade_account';
				}

				// Need feature update - e.g. inside thumbs
				else if (strpos($stw_response_status, 'Upgrade to use this feature') !== FALSE) {
					$returndata['stw_status'] = 'upgrade_account_feature';
				}

				else {
					$returndata['stw_status'] = 'other_error';
					$returndata['msg'] .= ' ' . __('Could not parse response using', 'shrinktheweb-website-preview-plugin').' '.$parseMethod;
				}

				$returndata['status']	= 'error';
			break;
	}	

	return $returndata;
}




/**
 * Adds javascript to footer of page to handle the automatic mouseover thumbnail feature.
 */
function STWWT_plugin_addAutoPopupJS()
{
	// Only continue if bubbles have been enabled.
	$allSettings = TidySettings_getSettings(STWWT_SETTINGS_KEY);
	if ($allSettings['stwwt_bubble_method'] != 'automatic' && $allSettings['stwwt_bubble_method'] != 'manual') {
		return false;
	}
	
	$args = array();
	$args["stwaccesskeyid"] = $allSettings['stwwt_access_id'];
	$args["stwembed"] 		= 1; // we do not cache locally in WP
	$args["stwsize"] 		= $allSettings['stwwt_bubble_size'];


	$protocol = TidySettings_getSettingSingle(STWWT_SETTINGS_KEY, 'stwwt_enable_https') ? 'https:' : 'http:';
	// Automatic
	if ($allSettings['stwwt_bubble_method'] == "automatic") {
		echo '<script type="text/javascript" src="'.urldecode("$protocol//images.shrinktheweb.com/plugins/wp/wppopup.php?".http_build_query($args)).'"></script>';
	} 
	
	// Manual
	else {
		echo '<script type="text/javascript" src="'.urldecode("$protocol//images.shrinktheweb.com/plugins/wp/wppopup_man.php?".http_build_query($args)).'"></script>';
	}
}




/**
 * Creates a list of custom quality for thumbnails.
 */ 
function STWWT_getQualityList()
{
	$list = array();
	$list[] = __('Disable Custom Quality','shrinktheweb-website-preview-plugin');
	for ($i = 1; $i <= 100; $i++) {
		$list[$i] = $i . '%';
	}
	
	return $list;
}





/** 
 * Add the scripts needed for the page for this plugin.
 */
function STWWT_plugin_styles_Backend()
{
	// Check on STW settings page before loading any scripts/styles - so 
	// we don't break other plugins.
	if (!(isset($_GET['page']) && substr(strtoupper($_GET['page']), 0, 6) == 'STWWT_')) { 
		return;
	}

	wp_enqueue_style('stwwt_admin', 	STWWT_plugin_getPluginPath() . 'css/stwwt_admin.css', false, STWWT_VERSION);
}


/**
 * Get the URL for the plugin path including a trailing slash.
 * @return String The URL for the plugin path.
 */
function STWWT_plugin_getPluginPath() {
	return trailingslashit(trailingslashit(WP_PLUGIN_URL) . plugin_basename(dirname(__FILE__)));
}


/**
 * Get the URL for the cache directory.
 * @param String $file If specified, add the file name to the end of the cache directory URL.
 * @param Boolean If true, return add a string to the path to denote an error thumbnail.
 * 
 * @return String The URL for the file in the cache directory.
 */
function STWWT_plugin_getCacheURL($file = false, $errorThumb = false) 
{
	return trailingslashit(WP_CONTENT_URL).'stw-thumbnails/'.($errorThumb ? 'error_' : '').$file;
}


/**
 * Get the absolute path for the cache directory.
 * @param String $file If specified, add the file name to the end of the cache directory path.
 * @param Boolean If true, return add a string to the path to denote an error thumbnail. 
 * 
 * @return String The directory for the file in the cache directory. 
 */
function STWWT_plugin_getCacheDirectory($file = false, $errorThumb = false) 
{
	return trailingslashit(WP_CONTENT_DIR).'stw-thumbnails/'.($errorThumb ? 'error_' : '').$file;
}


/**
 * Function that removes the cached files.
 * @param Boolean $errorOnly If true, only remove the error cache files.
 */
function STWWT_cache_emptyCache($errorOnly)
{
	// Remove only error thumbnails, or all files.
	if ($errorOnly) {
		$removeType = 'error_*';
	} else {
		$removeType = '*';
	}
	
	$cacheDir = STWWT_plugin_getCacheDirectory(false, false);
	
	foreach (glob($cacheDir.$removeType) AS $filename) {
		@unlink($filename);
	}
}


/**
 * Create the cache directory if it doesn't exist.
 */
function STWWT_cache_createCacheDirectory()
{
	// Cache directory
	$actualThumbPath = STWWT_plugin_getCacheDirectory();
			
	// Create cache directory if it doesn't exist	
	if (!file_exists($actualThumbPath)) {
		@mkdir($actualThumbPath, 0777, true);		
	} else {
		// Try to make the directory writable
		@chmod($actualThumbPath, 0777);
	}
}


/**
 * Simple debug function to echo a variable to the page.
 * @param Array $showvar The variable to echo.
 * @param Boolean $return If true, then return the information rather than echo it.
 * @return String The HTML to render the array as debug output.  
 */
function STWWT_debug_showArray($showvar, $return = false)
{
	$html = "<pre style=\"background: #FFF; margin: 10px; padding: 10px; border: 2px solid grey; clear: both; display: block;\">";
	$html .= print_r($showvar, true);
	$html .= "</pre>";
 
	if (!$return) {
		echo $html;
	}
	return $html;
}



/**
 * Logs a thumbnail request to the debug log.
 * 
 * @param Array $args The arguments used to fetch the thumbnail. 
 * @param String $requestType The type of request, namely 'cache' or 'web' request.
 * @param String $requestSuccess If true, the event succeeded.
 * @param String $requestResult The raw result data.
 * @param String $errorMessage The error message if there was one.
 */
function STWWT_debug_logError($args, $requestType, $requestSuccess, $requestResult, $errorMessage)
{
	// Escape if everything was ok
	if ($requestSuccess) {
		return false;
	}
	
	global $wpdb;
	$wpdb->show_errors();
	$error_log = $wpdb->prefix . STWWT_TABLE_ERRORS;
	
	$data = array();
	$data['request_url'] 		= urldecode($args['stwurl']);
	$data['request_type'] 		= $requestType;
	$data['request_result'] 	= ($requestSuccess ? 'ok' : 'error');
	$data['request_detail'] 	= $requestResult;
	$data['request_args'] 		= serialize($args);
	$data['request_date'] 		= date('Y-m-d H:i:s');
	$data['request_param_hash'] = md5(serialize($args));	
	$data['request_error_msg']  = $errorMessage;
	 	
	
	$SQL = STWWT_database_arrayToSQLInsert($error_log, $data);
	$wpdb->query($SQL);
}

/**
 * Get a total count of the errors currently logged.
 */
function STWWT_debug_getErrorCount()
{
	global $wpdb;
	$wpdb->show_errors;
	$error_log = $wpdb->prefix . STWWT_TABLE_ERRORS;
	
	return $wpdb->get_var("
		SELECT COUNT(*) 
		FROM $error_log 
		WHERE request_result = 'error'
	");
}



/**
 * Check if there's a cached error for the specified arguments.
 * 
 * @param Array $args The arguments to check the cache log for.
 * @return Boolean True if there's a cached error, false otherwise.
 */
function STWWT_debug_gotCachedError($args, $cacheFilename = false)
{
	global $wpdb;
	$wpdb->show_errors();
	$error_log = $wpdb->prefix . STWWT_TABLE_ERRORS;

	if ($cacheFilename)
	{
		$argHash = $cacheFilename;
	}
	else
	{
		$argHash = md5( serialize( $args ) );
	}

	$SQL = $wpdb->prepare("
		SELECT *, UNIX_TIMESTAMP(request_date) AS request_date_ts 
		FROM $error_log
		WHERE request_param_hash = %s
		  AND request_result = 'error'
		ORDER BY request_date DESC
		", $argHash);
	
	$errorCache = $wpdb->get_row($SQL);
	
	// No error cached at all, so no need to do further checks.
	if (!$errorCache) {
		return false;
	}
	
	// Got a cached error - check the age
	else  
	{
		// 12 hours in seconds = 43200
		// Check if error occurred within 12 hours, if so, our error is cached
		if ($errorCache->request_date_ts > (time() - 43200))
		{
			// See if error thumbnail exists or not. If it doesn't, we can return 
			// false to say there's no error cached, and a re-fetch will be attempted.
			// This is added just in case the cache file has been deleted, but the error
			// log has not been emptied.
			if (!file_exists(STWWT_plugin_getCacheDirectory($argHash . '.jpg', true))) {
				return false;
			}
			
			
			return true;
		}
		
		// It was previously cached for 12 hours, so remove any cached thumbnails
		// from the cache directory, and then return that it's not cached. This
		// allows the fetch to be re-attempted.
		else 
		{			
			@unlink(STWWT_plugin_getCacheDirectory($argHash . '.jpg', true)); 
			return false;
		}
	}
}


/**
 * Function checks if a feature is permitted
 * @param String $featureName Name of feature
 * @return Boolean True if the feature is allowed, false otherwise.
 */
function STWWT_account_featuredAllowed($featureName)
{
	// Get account settings, return false if no account settings.
	$accountSettings = TidySettings_getSettings(STWWT_SETTINGS_KEY_ACCOUNT);
	if (!$accountSettings) {
		return false;
	}
	
	// Enabled if setting == 1
	if (isset($accountSettings[$featureName]) && $accountSettings[$featureName] == 1) {
		return true;
	}
	
	return false;
}

/**
 * Register TinyMCE Button
 *
 * @param array $buttons List of TinyMCE buttons.
 * @return array Modified list of TinyMCE buttons.
 */
function register_wpthumb_mce_button( $buttons ) {
	array_push( $buttons, '|', 'wpthumb' );
	return $buttons;
}

/**
 * Register TinyMCE Plugin
 *
 * @param array $plugins List of tinyMCE plugins already available.
 * @return array Modified list of TinyMCE plugins
 */
function register_wpthumbtinymce_mce_plugin( $plugins ) {
	$plugins['wpthumbtinymce'] = plugins_url( 'js/wpthumb-tinymce-plugin.js' , __FILE__ );
	return $plugins;
}

/**
 * Add translations to TinyMCE plugin
 *
 * @param array $locales List of TinyMCE plugin locales.
 * @return array Modified list of TinyMCE plugin locales.
 */
function mce_wpthumbtinymce_plugin_locale( $locales ) {
	$locales['wpthumbtinymce'] = plugin_dir_path( __FILE__ ) . 'stw-wp-thumbnails-tinymce-translation.php';
	return $locales;
}

function setup_wpthumbtinymce_plugin()
{
	// Check if the logged in WordPress User can edit Posts or Pages
	// If not, don't register our TinyMCE plugin
	if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
		return;
	}

	// Check if the logged in WordPress User has the Visual Editor enabled
	// If not, don't register our TinyMCE plugin
	if (get_user_option('rich_editing') !== 'true') {
		return;
	}

	// Setup some filters
	add_filter('mce_buttons', 'register_wpthumb_mce_button');
	add_filter('mce_external_plugins', 'register_wpthumbtinymce_mce_plugin');
	add_filter('mce_external_languages', 'mce_wpthumbtinymce_plugin_locale', 10, 1);
}

add_action('init', 'setup_wpthumbtinymce_plugin');

/**
 * Function to fetch info for tinyMCE plugin
 * @return json
 */
function wpthumb_account_info()
{
	$allSettings = TidySettings_getSettings(STWWT_SETTINGS_KEY);
	$shortcode = !empty($allSettings['stwwt_shortcode']) ? $allSettings['stwwt_shortcode'] : 'thumb';
	$allSettings = TidySettings_getSettings(STWWT_SETTINGS_KEY_ACCOUNT);
	$account_info = array(
		'shortcode' => $shortcode,
		'custom_screen' => !empty($allSettings['embedded_pro_custom_size']) &&
		($allSettings['embedded_pro_custom_size'] === 1 ||
			$allSettings['embedded_pro_custom_size'] === '1') ? true : false,
		'custom_size' => !empty($allSettings['embedded_pro_custom_size']) &&
		($allSettings['embedded_pro_custom_size'] === 1 ||
			$allSettings['embedded_pro_custom_size'] === '1') ? true : false,
		'full_length' => !empty($allSettings['embedded_pro_full_length']) &&
		($allSettings['embedded_pro_full_length'] === 1 ||
			$allSettings['embedded_pro_full_length'] === '1') ? true : false
	);
	wp_send_json($account_info);
}

/**
 * Function to fetch data
 * @return string
 */
function wpthumb_account_info_ajax() {
	// check for nonce
	check_ajax_referer( 'wpthumb-nonce', 'security' );
	$account_info = wpthumb_account_info();
	return $account_info;
}
add_action( 'wp_ajax_wpthumb_account_info_output', 'wpthumb_account_info_ajax' );

/**
 * Function to output data ajax script
 * @return string
 */
function wpthumb_account_info_output()
{
	// create nonce
	global $pagenow;
	if ($pagenow != 'admin.php') {
		$nonce = wp_create_nonce('wpthumb-nonce');
		?>
		<script type="text/javascript">
			function getAccountInfo(cb) {
				var data = {
					'action': 'wpthumb_account_info_output', // wp ajax action
					'security': '<?php echo $nonce; ?>' // nonce value created earlier
				};
				// fire ajax
				jQuery.post(ajaxurl, data, function (response) {
					// if nonce fails then not authorized else settings saved
					if (response === '-1') {
						// do nothing
						console.log('error');
					} else {
						if (typeof(tinyMCE) != 'undefined') {
							if (tinyMCE.activeEditor != null) {
								tinyMCE.activeEditor.settings.wpthumbAccountData = response;
							}
						}
					}
					cb();
				});
			}
		</script>
		<?php
	}
}
add_action( 'admin_footer', 'wpthumb_account_info_output' );

/**
 * AJAX callback function.
 */
function stwwt_dismiss_notice_ajax_handler()
{
	$nonce = empty($_POST['nonce']) ? '' : $_POST['nonce'];
	if (!wp_verify_nonce($nonce, 'stwwt_dismiss_notice_nonce') || empty($_POST['subaction'])) die(__('Error', 'shrinktheweb-website-preview-plugin'));

	$subaction = $_POST['subaction'];

	// Some commands that are available via AJAX only
	if ('dismiss_notice' == $subaction) {
		update_option('stwwt_dismiss_notice', 1);

	} elseif ('dismiss_notice_later' == $subaction) {
		update_option('stwwt_dismiss_notice_time', time());
	}
	die;
}
add_action('wp_ajax_stwwt_dismiss_notice_ajax', 'stwwt_dismiss_notice_ajax_handler');

function check_stwwt_plugin_version()
{
	$installed_ver = get_option(STWWT_SETTINGS_VERSION);
	$current_ver = STWWT_VERSION;
	if ($installed_ver > '0' && $current_ver > $installed_ver) {
		STWWT_plugin_install();
	}
}

add_action('init', 'check_stwwt_plugin_version');

function STWWT_is_ssl()
{
	if (!empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'off') != 0) {
		return true;
	} elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
		return true;
	} elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') == 0) {
		return true;
	}
	return false;
}

function STWWT_check_scheme_options()
{
	if (STWWT_is_ssl()) {
		TidySettings_setSettingSingle(STWWT_SETTINGS_KEY, 'stwwt_enable_https', 1);
		TidySettings_setSettingSingle(STWWT_SETTINGS_KEY, 'stwwt_enable_https_set_automatically', 1);
	} else {
		if (TidySettings_getSettingSingle(STWWT_SETTINGS_KEY,'stwwt_enable_https_set_automatically', false)) {
			TidySettings_setSettingSingle(STWWT_SETTINGS_KEY, 'stwwt_enable_https_set_automatically', 0);
			TidySettings_setSettingSingle(STWWT_SETTINGS_KEY, 'stwwt_enable_https', 0);
		}
	}
}

/**
 * Adds custom links to the plugin page.
 */
function STWWT_add_custom_plugin_actions( $actions, $plugin_file )
{
	static $plugin;

	if (!isset($plugin))
		$plugin = plugin_basename(__FILE__);
	if ($plugin == $plugin_file) {
		$custom_actions = array(
			'donate' => sprintf('<a href="%1$s" target="_blank">%2$s</a>', 'https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ZBNAT7HJACUAG&lc=US&item_name=ShrinkTheWeb&no_note=0&cn=Add%20special%20instructions%20to%20the%20seller%3a&no_shipping=1&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted', __('Donate', 'shrinktheweb-website-preview-plugin'))
		);
		$actions = array_merge($custom_actions, $actions);
	}

	return $actions;
}
?>
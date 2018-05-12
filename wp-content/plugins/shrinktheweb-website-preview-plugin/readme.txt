=== ShrinkTheWeb (STW) Website Previews Plugin ===
Contributors: puravida1976, devdokimov, DanHarrison, Andreas Pachler, STW Support, nikitanovikov
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ZBNAT7HJACUAG&lc=US&item_name=ShrinkTheWeb&no_note=0&cn=Add%20special%20instructions%20to%20the%20seller%3a&no_shipping=1&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: website screenshots, screenshot, preview, thumbnails, snapshot
Requires at least: 2.9
Tested up to: 4.8
Stable tag: 2.8.5

This plugin accesses the ShrinkTheWeb API to automatically replace special tags in posts with website screenshots, where desired.

== Description ==

This plugin allows any WordPress user to **easily add thumbnail previews** of websites right in the content of their posts using a simple `[stwthumb]http://www.yourwebsite.com[/stwthumb]` format. Loads of examples are available within the plugin documentation (you'll see it when you activate the plugin).

The plugin requires a free or paid account from the thumbnail provider service [ShrinkTheWeb.com](https://shrinktheweb.com/). No purchase is required to use the plugin or the free service.

**Cool Features**

* Easily embed web page screenshots anywhere using shortcode!
* So simple to use with TinyMCE shortcode helper!
* Supports caching screenshots locally
* Plenty of examples in the plugin documentation
* Custom screenshot image quality
* Enable mouseover (hover) screenshot previews
* Alt and Title attributes support via shortcodes
* Custom filename option support via shortcode for SEO purposes

**Supported ShrinkTheWeb PRO features**

* Display "Inside Pages" or full URLs (Upgrade required)
  ...rather than just the homepage of a domain.
* Full-Length screenshot captures (Upgrade required)
* Custom Size screenshot captures (Upgrade required)
* Custom Browser Resolution (Upgrade required)

Take a look at ShrinkTheWeb for more information [Shrink The Web](https://shrinktheweb.com/ "Automated Website Preview Provider").

= Donate =
Did this plugin get you out of trouble? Please consider [making a small donation](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ZBNAT7HJACUAG&lc=US&item_name=ShrinkTheWeb&no_note=0&cn=Add%20special%20instructions%20to%20the%20seller%3a&no_shipping=1&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted) to thank the developer for their time.



== Installation ==

1. Unzip plugin archive downloaded from https://wordpress.org/plugins/shrinktheweb-website-preview-plugin
2. Upload archive contents to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The default shortcode is [stwthumb]. Select [thumb] for legacy support


== Frequently Asked Questions ==


= Is it possible for STW to add more of the STW PRO Features to this plugin? =

Yes, but priority is based on demand or a financial sponsor for the project.

= Do I have to pay for your service in order to show website previews? =

Generally, no. Most of our users sign up for free and never pay any fees. Higher volume sites, companies, or power users may actually hit some of our high limits and need to pay for bandwidth or "capture generator" upgrades to keep up with their requests. Additionally, some users may wish to add unique PRO features to their sites and those are an optional upgrade.

= Where have all of my settings gone from pre V2.0? =

If you've just uploaded the latest version of this plugin to your WordPress website, you just need to deactivate and activate the plugin. The settings will be migrated automatically. If that does't work, then just set your settings again.
  

== Screenshots ==

1. The ShrinkTheWeb WP Plugin admin settings page.
2. An example of an optional mouseover preview bubble
3. An example of how easy it is to use the embedding feature when writing your posts
4. An example of an embedded website preview in post (https://shrinktheweb.com in this case)

== Changelog ==

= 2.8.3 =
* BUG FIX: Reverted unintentional change to XSD URLs, which broke XML parsing, in some cases.

= 2.8.2 =
* New Feature: Someone suggested adding a "Donate" option. Thank you! :)
* New Feature: Now, when using "embedded" screenshots, HTTPS is detected and supported automatically

= 2.8.1 =
* New Feature: Prepared plugin for translation
* Updated all legacy ShrinkTheWeb links

= 2.8 =
* Security Feature: Added support for up to 32-character ShrinkTheWeb SECRET key
* New Feature: Improved logging to assist in troubleshooting
* BUG FIX: Fixed rare crash on form save with certain WP vs plugin versions.
* BUG FIX: User reports garbled UTF-8 characters (remove if cannot reproduce)
* New Feature: Added a TinyMCE Icon Shortcode Helper to WP Visual Editor

= 2.7 =
* Updated settings form to accept Secret keys up to 32 symbols length (letters, numbers, special charecters).
* Made minor fixes.

= 2.6.1 =
* Fixed readme.txt and plugin documentation.

= 2.6 =
* Added Custom Size Captures PRO feature support.
* Added Custom Browser Resolution PRO feature support.
* Added Custom filename option support via shortcode for SEO purposes.
* Added Alt and Title attributes support via shortcodes.
* Added surrounding DIV to IMG output.
* Updated documentation.

= 2.5 =
* Added an admin option to use HTTPS in requests.
* Updated Form Builder Library to v0.28.
* Moved the "Custom Quality" option to free options block since it's not a paid upgrade any longer.
* Added support for "Custom Size" PRO feature.
* Added an "Embedded" option to the "Cache Days" option.
* Removed the "Inside Pages" option, because it works automatically.

= 2.4 = 
* changed shortcode default to [thumb] (plan to support [stwthumb] if detected, else support legacy [thumb]).
* rearranged admin panel settings.
* changed labels on admin panel settings for accuracy.

= 2.3 =
* added new shortcode [stwthumb]

= 2.2 =
* fixed PHP 5.4 fatal error

= 2.1 =
* purged the whole PVP code out

= 2.0 = 
* Complete overhaul of the plugin to make it really easy to use, with new documentation and features. 
* Addition of support for free STW account. 
* Settings automatically enable/disable based on your account type
* Added thumbnail caching support for Basic and Plus accounts.
* Detailed Error Logging when using caching mode, to help you solve problems quickly. 

= 1.2.2 = 
* Changes a few parameter names that may eventually be deprecated

= 1.2.1 = 
* Changes request from www.shrinktheweb.com/xino.php to images.shrinktheweb.com/xino.php

= 1.2 =
* Fixes a minor security oversight regarding our service (overcome by "locking to" specific domains/IPs at our site).
* Introduces streamlined code.
* Adds support for some PRO Features, such as "Specific Pages", "Full-length Captures", and "Custom Quality."

= 1.1 = 
* This version made Mouseover Preview bubbles optional and added support for Embedded website previews (shown in posts themselves).

= 1.0 =
* This version supported Mouseover Preview bubbles showing website previews over links.


== Upgrade Notice ==

= 2.8.5 =
Security update

= 2.8.3 =
Security update. Required to update

= 2.8.2 =
Security update

= 2.0 =
This release is a massive improvement to the original plugin, and adds support for thumbnail caching, and adds error logging capabilities. So please deactivate and re-activate the plugin to upgrade your settings.

= 1.2.1 = 
Minor modification to some parameter names for maximum long-term compatibility

= 1.2.1 = 
Slight modification to request location to prepare for image migration

= 1.2 =
Security Vulnerability and added Feature Support

= 1.1 = 
Added functionality using embedded website screenshots in posts

= 1.0 =
This version supported Mouseover Preview bubbles showing website previews over links.
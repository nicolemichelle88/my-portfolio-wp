<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'my-portfolio');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '}jKU;]W^gNPnwl8m)c`V=k!R*&`vkU)02Dx2^[`T9:d02Uor]XQ,fE,q-#R8Nqz8');
define('SECURE_AUTH_KEY',  '2vCu!.[UCQ043V5guyN!4&3Ci5$tgP1&o FVC8gA]wfRMI ETCKWmqL-Ej=w-80S');
define('LOGGED_IN_KEY',    '7uXay+,lL#WeF2VCAf+>Yu#0.XF7a]YR-(Zzc)7Q?AQr:Gnp-MC|x&@2mX~.Q/QF');
define('NONCE_KEY',        'a<) _U4=8KeL<k%JUjIjSdy|@iq(~/4s*8/#px$To:Qk=*@7m2?U aq@LCprSLuz');
define('AUTH_SALT',        '#?_I!Acg,1:p)k*(v5J#d,[na&[A(O6/x!qFzgb-bS(j&xi.ZZ[AL+*{j =}(5En');
define('SECURE_AUTH_SALT', 'Om:Gr$Z5cVE/*=i,2sCRfYkC]k`+z% NY~|>gpM9J. #9uMwi>XAeLPeq8|L/?iW');
define('LOGGED_IN_SALT',   '*k:G~E+DRYZ(-s~EZzgxFGi66h cQ5>t7o6eU+we8q TEeU~V5c)!)1D)BKBnR+*');
define('NONCE_SALT',       'W?D4E 2N1+W!&#`Xn|K(BElELNP%(!k~ivF?rpmli#_74[B&!~JPxe/wNV,`+]}w');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp3_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

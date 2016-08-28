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
define('DB_NAME', 'polaris-systems');

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
define('AUTH_KEY',         'EaG8&{dSgyZ_n)*yljH@{|uU0XaF.OJn%^&@$4U[1Z,h6cu(YR!=EyRt>[c:fNSC');
define('SECURE_AUTH_KEY',  '{RuPTB ^e,hQUR_(EN|w)llusfb)ItTH{CM)>q<g)-S34b vAM[`>j[T{}#t+$@;');
define('LOGGED_IN_KEY',    '^>||EWCEMJ>Z|+S7rRhu+@lqaJHO(BY-+/xtAU[9-lO<`N=|,o(EViX0N7W.}kf4');
define('NONCE_KEY',        'axF#p|Fj$_fq@k5aMRF>Ri?lAlHrQo/|hewki,bhd)9tA@6O*|R2G/[E0_SrCzbM');
define('AUTH_SALT',        '$:YW5?-C|YrQQborkhUx~l^gE7P@ys?D RYWhZxC%`-rpA-eWZ!t}O_g)$]:dZQ>');
define('SECURE_AUTH_SALT', '+{:Un[oNu;N?LS5|{&hY@8areku<dk3mRZC[wd2K]uT@x,HuLrN49c,0yk#x+;Mx');
define('LOGGED_IN_SALT',   'MdJC  3Ujc(FGdCfM+,t#7 7xs=3]y*/f)q^f-zvOdk:{kzBmP^E?7]91eXy!Ksg');
define('NONCE_SALT',       'K{;N 1R $Qk,){l)}sol5ow<pFZH|TJA0_(vV`ojg;<OW{Fa>IDlv}%2R7u9 MRe');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'polaris_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

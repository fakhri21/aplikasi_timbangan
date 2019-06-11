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
define('DB_NAME', 'timbangan');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ']?V5X6D<5_3R)^iV@qIg8v[h2F[)}3Wz=T$sLA@:[c*1x^hWId8+|)9nQ,Vaw%[)');
define('SECURE_AUTH_KEY',  '%!g ;wJyE^KZ.|A5`>o(eJ2`lEnR;eu  Bs{EHEI*7flOMv$z!WX6hfy=S[$08?B');
define('LOGGED_IN_KEY',    ']cjM~q>d/*fX(z 26rZb51J-!6{D^~ZUv&|}ge&z_32z78S+{RTzDl!3Gpbf<^7(');
define('NONCE_KEY',        ']]uKD.M$q8Y:4GZX1Uaor,<%)/u6H!3Cz8CLM!Z4`D`c[K0yx}+*/H`o#2Qh7Qpf');
define('AUTH_SALT',        'ust@=s.bh;v]1+hSRT.tx.j#U&-0)[aG$)6Ym}mzN[?7X[{&u?(=&<)dP$0uc<k}');
define('SECURE_AUTH_SALT', 'k%@75<C(>Cz2sf0}PVyR2 >I#U_h`1;x7fK?.]vc(~DU6L7r@r#(<_ZR}1M?06Z#');
define('LOGGED_IN_SALT',   'F$/I/tTp=LiZNP]XuO9@-Jt2|Z`?mujEe.e5R`ku]>Di<A$u#r:Q_`6t]d;+En.a');
define('NONCE_SALT',       '9|~omlr2ncf@hu4Wmv}C?d<o[*I% v=,=xULE84!EBd)Iq_U<h%+qR]U]Q3oy@&t');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_apporder_';

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

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
define('DB_NAME', 'wpskbincrowd');

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
define('AUTH_KEY',         'f6GS%YBJz78[Pox)#% {[4Y/D&.c? <$[,vclI d{M/BY26.L:UYZkMUI%7|/ugC');
define('SECURE_AUTH_KEY',  '5RH#Y(UnY!<{%`v|~)VD9`{5[k8{@?PbN%|:c9UWKyq&]39,<9 8{s@(`T)~e-{c');
define('LOGGED_IN_KEY',    '<>sV>EFDF!JKCbu`4LCz(UmNOn.n|69e6C{(t!W<1f8&jjGNiLmTg8b-QN;M(m!D');
define('NONCE_KEY',        'g%=>n9[_0dT|!r.i]3Pq7g8f@xL{Ok%_5$R:5;m)G6(&q=I/Y7g]Glo0)N(PZK8j');
define('AUTH_SALT',        '|/4^<p.bF/bl~.lC:i-46XpUS!.4e2i()5(H$iqLV{_5_j?eP5+hm{jtNk=eFpn5');
define('SECURE_AUTH_SALT', 'O@[EjZdQ}$`TS1(ovkm.~k7%Q<_j6k- HzpH@}-uLp{2p%D.JMxCBbXrrGGf2~nX');
define('LOGGED_IN_SALT',   'AfZUz6qMq!$+rz-_e(}G=B.HxA/LH~.](&?Cae,i|NxtIYJa(Dm?#xOP$6])SjQc');
define('NONCE_SALT',       'O_1X7OZ4LTrElg7h&!)G*G_Xwq9}N*akT zCq}G6:-[y0nmD>t&=I6>=*k5S+7j>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

define('WP_HOME','http://localhost:8888');
define('WP_SITEURL','http://localhost:8888');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('RELOCATE',true);

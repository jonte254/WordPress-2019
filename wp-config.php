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
define( 'DB_NAME', 'wordpress2019' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '),mA0/,Py}%06gYBMp_@c2We=^cs%9um,cy6JASm&2:2%DNiFs`_~-p`Y5A]<X1]' );
define( 'SECURE_AUTH_KEY',  '06qRn34a#kl+h0-u)s:S;=JyE[^.=|9bJR[l<Zk{aRcx;KO-5{1S+F],-A~b>:;A' );
define( 'LOGGED_IN_KEY',    '<3q^&A{$y+dspI1s!m(O6FKk8$WD%}#[1:~uYk[w3dJ|U GeHX4{Vk={Sm79<dj5' );
define( 'NONCE_KEY',        ']|NBU@=>NMx%UhgvrW7ju+(KO4K8z57K9@~)URpY#}YreH28M$l8I$;?Vj(O)bI5' );
define( 'AUTH_SALT',        'mn6jrfD,ouCoG]w}My/S3gp[Z4^>lp9T_WNqW?a4yh%o`M4X8TY8`0f5d;Q~|$Fx' );
define( 'SECURE_AUTH_SALT', '%Bw{:;gc*>,=%Xat$Y.<a/b/4^Q0fpk17:Bk?Z@|nz4hH+d=YEc23U[iK_`3@o$Y' );
define( 'LOGGED_IN_SALT',   'HO8,neS~#j2Yi|,!&x`5Mr[y7~Ll2:~3^mKqn,TMWq^dc|_[J&Q:DN:0P{qr^)]5' );
define( 'NONCE_SALT',       '|F~(H40snF=]xld37]?py56|F/Qc4u.1x[w]zff|!wJ~o`,z(wX9(Y;%717n@hrv' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

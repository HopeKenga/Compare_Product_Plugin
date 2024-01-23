<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.oF:^>TJG`}}+K(rF.TX~D6=>z r@I,F|<lJv{D>4 g g9_`%!<oWHlHI.1@_+L}' );
define( 'SECURE_AUTH_KEY',  '|p3G<sh_y?uq(pc,exJd{O/OY;cuS~br:ELh2)twJeYc*|L}u*e5/_kJIP]0Lvg~' );
define( 'LOGGED_IN_KEY',    '9jKB]{7,T.^|d34)$0@ l9#w.4io3%b}>Hwas@RdX%br082i1!<{]fYx0@saDvui' );
define( 'NONCE_KEY',        'G91&EA&kz=WqRFr6^`#|:#*O`_wo( ]70rdnAuh q@3^7c@{CfvG^MBj&U#%nnI!' );
define( 'AUTH_SALT',        '6-A tsD{u_D~[kI|>>q0_&y&! jx3N9+X2B`)$}>P)x irK>MFk+ADGqMf.0zyKK' );
define( 'SECURE_AUTH_SALT', '4]ZPi8=#DH..M1>Xf)X^FVI&AsO9F18WynY|I3C%e%[9VG?rlvv`~FY4KmOXY+Q*' );
define( 'LOGGED_IN_SALT',   'lfIsijGQtx- (o&o$;h/GHBr<U;Lhkdwx1bkq|fZyNOclauhBo5$L(O{S|r{wbN.' );
define( 'NONCE_SALT',       'yRa-uQ7Y+GGJ-Hs%G7AOH[ESez@5Vt)y`}0e+Q;!_ZwhY0`a1HP6Y_08d6j4r:,A' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

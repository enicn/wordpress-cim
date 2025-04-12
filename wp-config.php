<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
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
define( 'AUTH_KEY',         'NlB)JxL?Kdf`1iC_xn;2-F%Z4oYrd=E).#THWzw.l74kM%F6Ey& Otp+Y]`:;Kx?' );
define( 'SECURE_AUTH_KEY',  'dG%R(MC3%s)YYH~856^%,UY-? n_o~{:=#G|5jpufVi]:n`1Ry#*%(h!<wRh>{_}' );
define( 'LOGGED_IN_KEY',    'Lv;P>ez$!LMg4Tl2Et4FO|!-Y*!%=>=DcbUn!FZWiZ_<+!46bT[118^{<46h7h{r' );
define( 'NONCE_KEY',        'j@@3#eexYQ_)?ojxaa4m9(L5bS#^D*QaKd3S=iL7UE%A|())[s^/e#.~mQg7Z6y:' );
define( 'AUTH_SALT',        'dho,KYWn!V;r1Hq6AEWeq6PM:DRwBl7Ml^nC7=l?%SZX1<R$>5!5QSv2Y,|Yyd!j' );
define( 'SECURE_AUTH_SALT', '`-ya;gXq^uGkmQIDWnvtVy2?P@0l/@~Cs +ctR6Gc*!Dm~lkPCi%zTW*$;V!s}*R' );
define( 'LOGGED_IN_SALT',   'uGSlMh%]C(H+/nzKFAEX7%qQOv)hkK/B1k8QTBIX4q`~`09_KzAvxn9U9Gl/6T_T' );
define( 'NONCE_SALT',       'o{v)Who<banf!idW;$!+Pk DcX[FRdL_jb#M+7. i$8CW|UO_G!lgisi6{B>IIt3' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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

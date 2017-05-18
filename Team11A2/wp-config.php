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
define('DB_NAME', 'woochulh_wp169');

/** MySQL database username */
define('DB_USER', 'woochulh_wp169');

/** MySQL database password */
define('DB_PASSWORD', '30p26.)9S5');

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
define('AUTH_KEY',         'xg1yjxuloylsbnyfr39cenfckhrbify9bo02aclvknb6oyuvpbnvkhkanzdgbefh');
define('SECURE_AUTH_KEY',  'ykswxanvjqv4jqds4tu7r8hriprpxgyfgtobj18aw8rwaz20xyyoe4pl0j4gdjcd');
define('LOGGED_IN_KEY',    '1shyfndwicox7isjmgcgnfxkr3loglqzv9n9jjghqincr2smhnzx1ekiboan8jqp');
define('NONCE_KEY',        'fbgyjizz7l6uhaf3gnt5ioddsfc0s5gincqqn5rmnqym61kgclr69gnuj6fbykdf');
define('AUTH_SALT',        'mwhrz3fusczjr6lb8vdtufdv1wlu5vreohcejxuiyjxto5jbnabqwq1xg1jskn58');
define('SECURE_AUTH_SALT', 'c8ktpcjklkkdnlsgnjcu8vstzkffcgj4ahqrkowk0qxde7f2gstqbpxude5ldhci');
define('LOGGED_IN_SALT',   'n6bwpmnhzchj3jwkwltzn418nkxfpeevoijicirakaxtfau20vqqilyqitzhwzxk');
define('NONCE_SALT',       'u6kbnjehq9x3pl6hl01in4mocx9pecs0vkkkhodakmnqjpffghbjtxgtss0mr1xk');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpy9_';

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
define( 'WP_MEMORY_LIMIT', '128M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

# Disables all core updates. Added by SiteGround Autoupdate:
define( 'WP_AUTO_UPDATE_CORE', false );

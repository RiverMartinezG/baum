<?php
/**
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define( 'DB_NAME', 'baum' );

/** Tu nombre de usuario de MySQL */
define( 'DB_USER', 'homestead' );

/** Tu contraseña de MySQL */
define( 'DB_PASSWORD', 'secret' );

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define( 'DB_HOST', 'localhost' );

/** Codificación de caracteres para la base de datos. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', 'lttr}(Gu%C>zd9hq!1 hJFZm jI;NWY}S`CRvO+w<6);{KC.@}Q4v(.m< .}A|^<' );
define( 'SECURE_AUTH_KEY', 'oLe*|=p_g%0Swh3><wq[)Vy5EX)&#<mshks0;`<5,}r2uvcG59mJ;DI/!4+~OfaD' );
define( 'LOGGED_IN_KEY', '~GElUzSoj#&]koH3^ s<78b2h:S-!l.]Ff5J+HiP6Y<J0=F1#(=ShMGq>kR1QwO]' );
define( 'NONCE_KEY', '{+Jlf;;TW)me8V=%K{RdMH]*LX/]k([-x^6UV4<J2C4nZ<+~tfosiOI?o#w|hZ[q' );
define( 'AUTH_SALT', 'TR1vY|q9ff v@nIZm6G0>GcRV!Cb!A];AQt:b2?_pJtOXtl0d:jD/kmyw<H^xqug' );
define( 'SECURE_AUTH_SALT', 'kLb tg2$okNBh- )y1VeLhiU fW}-<%*W}sR`G-F=G-]/;~.]0^{1(Xi|zAHG,;x' );
define( 'LOGGED_IN_SALT', '^-TBk#]DD@`e+1Y^[] ;zo?8?+{?DEr:#<w j7aStfr;o-PWeF1U~^k<UPvO8=_u' );
define( 'NONCE_SALT', 'N0vkXrRB0)pgbKi~):vix:7HLeX)[Eg*LqkfC MA>dZ78U6}rh)gCnvuV<{8V_O|' );

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


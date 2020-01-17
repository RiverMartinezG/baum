<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://twitter.com/rianmz
 * @since      1.0.0
 *
 * @package    Baumfestival
 * @subpackage Baumfestival/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Baumfestival
 * @subpackage Baumfestival/init
 * @author     River Martínez <rianmartinez@gmail.com>
 */
class Baumfestival_Init {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function register_posts_type() {
		$this->register_festival_post_type();
		$this->register_event_post_type();
		$this->register_artist_post_type();
	}

	/**
	 * Add CPT Festival
	 */
	private function register_festival_post_type() {
		$labels = [
			'name'          => __( 'Festivals' ),
			'singular_name' => __( 'Festival' ),
			'add_new_item'  => __( 'Add new Festival' )
		];

		$args = [
			'public'             => true,
			'has_archive'        => true,
			'labels'             => $labels,
			'menu_icon'          => 'dashicons-buddicons-tracking',
			'publicly_queryable' => true,
		];

		register_post_type( 'festival', $args );
	}

	/**
	 * Add CPT Events
	 */
	private function register_event_post_type() {
		$labels = [
			'name'          => __( 'Events' ),
			'singular_name' => __( 'Event' ),
			'add_new_item'  => __( 'Add new Event' )
		];

		$args = [
			'public'             => true,
			'has_archive'        => true,
			'labels'             => $labels,
			'menu_icon'          => 'dashicons-tickets',
			'publicly_queryable' => true,
		];

		register_post_type( 'event', $args );
	}

	/**
	 * Add CPT Artist
	 */
	private function register_artist_post_type() {
		$labels = [
			'name'          => __( 'Artists' ),
			'singular_name' => __( 'Artist' ),
			'add_new_item'  => __( 'Add new Artist' )
		];

		$args = [
			'public'             => true,
			'has_archive'        => true,
			'labels'             => $labels,
			'menu_icon'          => 'dashicons-businessperson',
			'publicly_queryable' => true,
		];

		register_post_type( 'artist', $args );
	}

	/**
	 * Change the title in Custom Post Types.
	 *
	 * @param $input
	 *
	 * @return string|void
	 */
	public function custom_enter_title( $input ) {
		if ( 'festival' === get_post_type() ) {
			return __( 'Nombre del Festival', 'baum-festivals' );
		}

		if ( 'event' === get_post_type() ) {
			return __( 'Nombre del Evento', 'baum-festivals' );
		}

		if ( 'artist' === get_post_type() ) {
			return __( 'Nombre del Artista', 'baum-festivals' );
		}

		return $input;
	}

	/**
	 * Config Google Maps API Key
	 *
	 * @param $api
	 *
	 * @return mixed
	 */
	public function baum_acf_google_map_api( $api ) {
		$api['key'] = 'AIzaSyDpJ919ntqiQF4YHwd6RLOSNp3A_hNJ32M';

		return $api;
	}

	/**
	 * Set custom ACF URL
	 * @return string
	 */
	public function custom_acf_settings_url() {
		return MY_ACF_URL;
	}

	/**
	 * Hide ACF Options on menu.
	 * @return bool
	 */
	public function custom_acf_settings_show_admin() {
		return false;
	}

	/**
	 * Load template for Archive templates.
	 *
	 * @param $template
	 *
	 * @return string
	 */
	public function load_archives_template( $template ) {
		if ( is_archive() ) {
			$post_type       = get_post_type();
			$theme_template  = get_template_directory() . '/archive-{$post_type}.php';
			$plugin_template = plugin_dir_path( dirname( __FILE__ ) ) . "templates/archive-{$post_type}.php";

			if ( is_post_type_archive( $post_type ) ) {
				if ( file_exists( $theme_template ) ) {
					$template = $theme_template;
				} else {
					$template = $plugin_template;
				}
			}
		}

		if ( is_single() ) {
			$post_type = get_post_type();
			$single_plugin_template = plugin_dir_path( dirname( __FILE__ ) ) . 'templates/single-cpt.php';

			if ( 'festival' === $post_type || 'event' === $post_type || 'artist' ) {
				if ( file_exists( $single_plugin_template ) ) {
					return $single_plugin_template;
				}
			}
		}

		return $template;
	}

	/**
	 * Custom endpoint for CPT Artist for REST API
	 */
	public function custom_api_rest() {
		register_rest_route( 'baum/v1', '/artists', [
			'methods'  => WP_REST_Server::READABLE,
			'callback' => [ $this, 'api_get_all_artists' ]
		] );
	}

	/**
	 * API Callback for CPT
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return array
	 */
	public function api_get_all_artists(WP_REST_Request $request ) {
		$args = [
			'post_type'  => 'artist',
		];

		$event = $request->get_param('event');

		if ( $event ) {
			$args = [
				'p' => $event,
				'post_type' => 'event'
			];

			$events = new WP_Query( $args );
			$artists_by_event = [];

			if ( $events ) {
				while ( $events->have_posts() ) : $events->the_post();
					if ( get_field( 'artista' ) ) {
						$artists_by_event[] = get_field( 'artista' );
					}
				endwhile;
				wp_reset_postdata();
			}

			return $artists_by_event;
		}

		$artists = new WP_Query( $args );

		return $artists->posts;
	}
}

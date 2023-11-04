<?php
/*
Plugin Name: RAW-CODE Elementor Addons
Description: An Wordpress plugin with Elementor Addons Custom Widget
Author: RAW-CODE
Author URI: https://raw-code.it/
Version: 1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function raw_code_elementor_addons_load_textdomain() {
    load_plugin_textdomain('rawcodeplugin', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('plugins_loaded', 'raw_code_elementor_addons_load_textdomain');

/**
 * Load all custom post type from selected directory
 */

$cpt_folder = plugin_dir_path(__FILE__)  . 'custom-post-type/';

foreach ( glob( $cpt_folder . '*.php' ) as $file ) {
	  require_once($file);

}

final class Rawcodeplugin {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.5.11';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '6.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * The single instance of the class.
	 */
	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}


	
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	protected function __construct() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		require_once('widgets/heading/heading.php');
		require_once('widgets/opinions/opinions.php');
		require_once('widgets/clients/clients.php');
		require_once('widgets/goodtoknow/goodtoknow.php');
		require_once('widgets/subscription/subscription.php');
		require_once('widgets/services/services.php');
		require_once('widgets/rating/rating.php');
		require_once('widgets/postlist/postlist.php');
		require_once('widgets/filelist/filelist.php');
		require_once('widgets/projectsgrid/projectsgrid.php');
		require_once('widgets/postls/postls.php');
		require_once('widgets/likeview/likeview.php');
		require_once('widgets/taxonomylist/taxonomylist.php');
		require_once('widgets/archive-postlist/archive-postlist.php');
		require_once('widgets/search-postlist/search-postlist.php');
		require_once('widgets/icon-link/icon-link.php');

		// Register Widget
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		// Register Widget Scripts
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );
			
		// Register Widget Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_custom_category' ] );

	
	}


	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\HeadingH() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Opinions() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Clients() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\GoodToKnow() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Subscription() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Services() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Rating() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\PostList() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\FileList() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Archive_PostList() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ProjectsGrid() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\PostLS() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\LikeView() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\TaxonomyList() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Search_PostList() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Icon_Link() );
	}

	public function widget_styles() {
		wp_enqueue_style( 'rawcode-custom-css', plugins_url( '/css/custom.css', __FILE__ ) );
		wp_enqueue_style ('swiper-style', plugins_url( '/css/swiper.min.css', __FILE__ ) );
	}

	public function widget_scripts() {
		wp_enqueue_script( 'rawcode-custom-js', plugins_url( '/js/custom.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'swiper', plugins_url( '/js/swiper.min.js', __FILE__ ), array( 'jquery' ) );
	}

	public function register_custom_category( $elements_manager ){
		$elements_manager->add_category(
			'raw-code-plugin',
			[
				'title' => __( 'RAW-CODE ADDONS', 'rawcodeplugin' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'rawcodeplugin' ),
			'<strong>' . esc_html__( 'RawCodePlugin', 'rawcodeplugin' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rawcodeplugin' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rawcodeplugin' ),
			'<strong>' . esc_html__( 'RawCodePlugin', 'rawcodeplugin' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rawcodeplugin' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rawcodeplugin' ),
			'<strong>' . esc_html__( 'RawCodePlugin', 'rawcodeplugin' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'rawcodeplugin' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

}

add_action( 'init', 'Rawcodeplugin_elementor_init' );
function Rawcodeplugin_elementor_init() {
	Rawcodeplugin::get_instance();
}

    
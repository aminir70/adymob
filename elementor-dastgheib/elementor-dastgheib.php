<?php
/**
 * Plugin Name:  Elementor – Dastgheib Landing Page
 * Description:  ویجت المنتور برای لندینگ پیج نرم‌افزار آیت‌الله دستغیب — تمام بخش‌ها با پنل المنتور قابل تغییر
 * Version:      1.0.0
 * Requires PHP: 7.4
 * Author:       DastgheibQoba
 * Text Domain:  dastgheib-landing
 * License:      GPL v2 or later
 */

defined( 'ABSPATH' ) || exit;

define( 'DGL_VERSION', '1.0.0' );
define( 'DGL_PATH',    plugin_dir_path( __FILE__ ) );
define( 'DGL_URL',     plugin_dir_url( __FILE__ ) );

add_action( 'plugins_loaded', function () {

	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-error"><p>' .
				esc_html__( 'افزونه لندینگ پیج دستغیب نیازمند نصب و فعال بودن المنتور است.', 'dastgheib-landing' ) .
				'</p></div>';
		} );
		return;
	}

	/* Register widget */
	add_action( 'elementor/widgets/register', function ( $manager ) {
		require_once DGL_PATH . 'widgets/class-dastgheib-landing-widget.php';
		$manager->register( new Dastgheib_Landing_Widget() );
	} );

	/* Register assets (frontend + editor) */
	$register = function () {
		wp_register_style(
			'dgl-fonts',
			'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&family=Amiri:wght@400;700&display=swap',
			[],
			null
		);
		wp_register_style(
			'dgl-style',
			DGL_URL . 'assets/css/dastgheib-landing.css',
			[ 'dgl-fonts' ],
			DGL_VERSION
		);
		wp_register_script(
			'dgl-script',
			DGL_URL . 'assets/js/dastgheib-landing.js',
			[],
			DGL_VERSION,
			true
		);
	};

	add_action( 'wp_enqueue_scripts',              $register );
	add_action( 'elementor/editor/after_enqueue_scripts', $register );
	add_action( 'elementor/preview/enqueue_scripts',      $register );
} );

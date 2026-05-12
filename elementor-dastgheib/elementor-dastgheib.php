<?php
/**
 * Plugin Name:  Elementor – Dastgheib Landing Page
 * Description:  ویجت المنتور برای لندینگ پیج نرم‌افزار آیت‌الله دستغیب — تمام بخش‌ها با پنل المنتور قابل تغییر
 * Version:      1.0.1
 * Requires PHP: 7.4
 * Author:       DastgheibQoba
 * Text Domain:  dastgheib-landing
 * License:      GPL v2 or later
 */

defined( 'ABSPATH' ) || exit;

define( 'DGL_VERSION', '1.0.1' );
define( 'DGL_PATH',    plugin_dir_path( __FILE__ ) );
define( 'DGL_URL',     plugin_dir_url( __FILE__ ) );

/* ── Widget registration ───────────────────────────────────────────
   Hook directly into elementor/widgets/register — no plugins_loaded
   wrapper needed; Elementor fires this action during its own init.   */
add_action( 'elementor/widgets/register', function ( $manager ) {
	require_once DGL_PATH . 'widgets/class-dastgheib-landing-widget.php';
	$manager->register( new Dastgheib_Landing_Widget() );
} );

/* ── Asset registration ────────────────────────────────────────── */
function dgl_register_assets() {
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
}
add_action( 'wp_enqueue_scripts',                     'dgl_register_assets' );
add_action( 'elementor/editor/after_enqueue_scripts', 'dgl_register_assets' );
add_action( 'elementor/preview/enqueue_scripts',      'dgl_register_assets' );

/* ── Admin notice when Elementor is missing ────────────────────── */
add_action( 'admin_notices', function () {
	if ( ! did_action( 'elementor/loaded' ) ) {
		echo '<div class="notice notice-error"><p>' .
			esc_html__( 'افزونه لندینگ پیج دستغیب نیازمند نصب و فعال بودن المنتور است.', 'dastgheib-landing' ) .
			'</p></div>';
	}
} );

<?php
/**
 * Plugin Name: AdyMob Elementor Widgets
 * Plugin URI:  https://adymob.com
 * Description: ویجت‌های سفارشی Elementor برای وب‌سایت AdyMob — Hero، ماشین‌حساب، سرویس‌ها، آمار، مراحل، نظرات، وبلاگ، CTA، فرم سفارش
 * Version:     1.0.0
 * Author:      AdyMob
 * Text Domain: adymob-elementor
 * License:     GPL v2 or later
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Elementor tested up to: 3.25
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ADYMOB_VERSION', '1.0.0' );
define( 'ADYMOB_PATH',    plugin_dir_path( __FILE__ ) );
define( 'ADYMOB_URL',     plugin_dir_url( __FILE__ ) );

add_action( 'plugins_loaded', 'adymob_init' );

function adymob_init() {
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', function () {
			echo '<div class="error"><p><strong>AdyMob Elementor Widgets</strong> نیاز به افزونه <strong>Elementor</strong> دارد. لطفاً ابتدا Elementor را نصب و فعال کنید.</p></div>';
		} );
		return;
	}

	// ── Category ──────────────────────────────────────────────────────────────
	add_action( 'elementor/elements/categories_registered', function ( $mgr ) {
		$mgr->add_category( 'adymob', [ 'title' => 'AdyMob', 'icon' => 'eicon-apps' ] );
	} );

	// ── Assets (front-end) ────────────────────────────────────────────────────
	add_action( 'wp_enqueue_scripts', 'adymob_enqueue_assets' );

	// ── Assets (editor) ───────────────────────────────────────────────────────
	add_action( 'elementor/editor/after_enqueue_styles', function () {
		wp_enqueue_style( 'vazirmatn', 'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css', [], null );
		wp_enqueue_style( 'adymob-widgets', ADYMOB_URL . 'assets/adymob.css', [], ADYMOB_VERSION );
	} );

	// ── Load & register widgets ───────────────────────────────────────────────
	add_action( 'elementor/widgets/register', 'adymob_register_widgets' );

	// ── AJAX: order form ──────────────────────────────────────────────────────
	add_action( 'wp_ajax_adymob_order',        'adymob_handle_order' );
	add_action( 'wp_ajax_nopriv_adymob_order', 'adymob_handle_order' );
}

function adymob_enqueue_assets() {
	wp_enqueue_style(
		'vazirmatn',
		'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css',
		[], null
	);
	wp_enqueue_style(
		'adymob-widgets',
		ADYMOB_URL . 'assets/adymob.css',
		[ 'vazirmatn' ], ADYMOB_VERSION
	);
	wp_enqueue_script(
		'adymob-widgets',
		ADYMOB_URL . 'assets/adymob.js',
		[], ADYMOB_VERSION, true
	);
	wp_localize_script( 'adymob-widgets', 'admobData', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'adymob_order' ),
	] );
}

function adymob_register_widgets( $mgr ) {
	$files = [
		'class-hero-widget',
		'class-calculator-widget',
		'class-stats-bar-widget',
		'class-services-grid-widget',
		'class-how-it-works-widget',
		'class-why-us-widget',
		'class-testimonials-widget',
		'class-blog-teaser-widget',
		'class-cta-band-widget',
		'class-contact-form-widget',
	];
	foreach ( $files as $f ) {
		require_once ADYMOB_PATH . 'widgets/' . $f . '.php';
	}

	$classes = [
		'AdyMob\Widgets\Hero_Widget',
		'AdyMob\Widgets\Calculator_Widget',
		'AdyMob\Widgets\Stats_Bar_Widget',
		'AdyMob\Widgets\Services_Grid_Widget',
		'AdyMob\Widgets\How_It_Works_Widget',
		'AdyMob\Widgets\Why_Us_Widget',
		'AdyMob\Widgets\Testimonials_Widget',
		'AdyMob\Widgets\Blog_Teaser_Widget',
		'AdyMob\Widgets\CTA_Band_Widget',
		'AdyMob\Widgets\Contact_Form_Widget',
	];
	foreach ( $classes as $cls ) {
		if ( class_exists( $cls ) ) {
			$mgr->register( new $cls() );
		}
	}
}

function adymob_handle_order() {
	check_ajax_referer( 'adymob_order', 'nonce' );

	$name    = sanitize_text_field( wp_unslash( $_POST['order_name']    ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['order_phone']   ?? '' ) );
	$service = sanitize_text_field( wp_unslash( $_POST['order_service'] ?? '' ) );
	$amount  = floatval( $_POST['order_amount'] ?? 0 );

	$to      = get_option( 'admin_email' );
	$subject = sprintf( 'سفارش جدید AdyMob — %s', $name );
	$body    = sprintf( "نام: %s\nتلفن: %s\nسرویس: %s\nمبلغ: %s دلار", $name, $phone, $service, $amount );
	wp_mail( $to, $subject, $body );

	wp_send_json_success( [ 'message' => 'سفارش شما ثبت شد.' ] );
}

// ── Icon helper ────────────────────────────────────────────────────────────────
function adymob_icon( string $name, int $size = 20 ): string {
	$icons = [
		'users'   => ['fill' => false, 'd' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>'],
		'trend'   => ['fill' => false, 'd' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>'],
		'clock'   => ['fill' => false, 'd' => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>'],
		'star'    => ['fill' => true,  'd' => '<polygon points="12 2 15.1 8.6 22 9.3 17 14.1 18.2 21 12 17.8 5.8 21 7 14.1 2 9.3 8.9 8.6"/>'],
		'bolt'    => ['fill' => false, 'd' => '<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>'],
		'shield'  => ['fill' => false, 'd' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>'],
		'eye'     => ['fill' => false, 'd' => '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/>'],
		'phone'   => ['fill' => false, 'd' => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.13 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.37 1.9.72 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.59 2.81.72a2 2 0 0 1 1.72 2z"/>'],
		'mail'    => ['fill' => false, 'd' => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/>'],
		'check'   => ['fill' => false, 'd' => '<path d="M20 6L9 17l-5-5"/>'],
		'sparkle' => ['fill' => false, 'd' => '<path d="M12 3l1.9 5.6L19 10l-5.1 1.4L12 17l-1.9-5.6L5 10l5.1-1.4z"/>'],
		'arrow'   => ['fill' => false, 'd' => '<path d="M19 12H5M12 19l-7-7 7-7"/>'],
	];

	$i = $icons[ $name ] ?? $icons['star'];
	$extra = $i['fill']
		? 'fill="currentColor"'
		: 'fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"';

	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" %2$s>%3$s</svg>',
		$size, $extra, $i['d']
	);
}

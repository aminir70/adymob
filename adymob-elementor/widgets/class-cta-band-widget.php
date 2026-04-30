<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class CTA_Band_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-cta-band'; }
	public function get_title()      { return 'AdyMob — بنر CTA'; }
	public function get_icon()       { return 'eicon-call-to-action'; }
	public function get_categories() { return [ 'adymob' ]; }

	protected function register_controls() {

		$this->start_controls_section( 's_content', [ 'label' => 'محتوا' ] );

		$this->add_control( 'heading', [
			'label'   => 'عنوان',
			'type'    => Controls_Manager::TEXT,
			'default' => 'آماده شروع هستید؟',
		] );
		$this->add_control( 'sub', [
			'label'   => 'توضیحات',
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'همین الان حساب رایگان بسازید و در کمتر از ۲ ساعت اولین درآمدتان را به تومان تبدیل کنید.',
		] );
		$this->add_control( 'btn1_text', [ 'label' => 'دکمه اول — متن',  'type' => Controls_Manager::TEXT, 'default' => 'ثبت سفارش رایگان' ] );
		$this->add_control( 'btn1_url',  [ 'label' => 'دکمه اول — لینک', 'type' => Controls_Manager::URL,  'default' => [ 'url' => '#contact' ] ] );
		$this->add_control( 'btn2_text', [ 'label' => 'دکمه دوم — متن',  'type' => Controls_Manager::TEXT, 'default' => 'تماس با ما' ] );
		$this->add_control( 'btn2_url',  [ 'label' => 'دکمه دوم — لینک', 'type' => Controls_Manager::URL,  'default' => [ 'url' => '#contact' ] ] );

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<div class="adm-widget">
		<div class="adm-cta__inner">
			<div class="adm-cta__orb" style="top:-60px;left:-60px;width:200px;height:200px;background:rgba(255,255,255,.1);"></div>
			<div class="adm-cta__orb" style="bottom:-80px;right:-40px;width:240px;height:240px;background:rgba(255,255,255,.08);"></div>
			<div class="adm-cta__content">
				<h2 class="adm-cta__heading"><?php echo esc_html( $s['heading'] ?? '' ); ?></h2>
				<p class="adm-cta__sub"><?php echo esc_html( $s['sub'] ?? '' ); ?></p>
				<div class="adm-cta__btns">
					<?php if ( $s['btn1_text'] ?? '' ) : ?>
						<a href="<?php echo esc_url( $s['btn1_url']['url'] ?? '#' ); ?>" class="adm-btn adm-btn--white adm-btn--lg">
							<?php echo esc_html( $s['btn1_text'] ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $s['btn2_text'] ?? '' ) : ?>
						<a href="<?php echo esc_url( $s['btn2_url']['url'] ?? '#' ); ?>" class="adm-btn adm-btn--dark-glass adm-btn--lg">
							<?php echo esc_html( $s['btn2_text'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		</div>
		<?php
	}
}

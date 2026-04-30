<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class How_It_Works_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-how-it-works'; }
	public function get_title()      { return 'AdyMob — مراحل کار'; }
	public function get_icon()       { return 'eicon-flow'; }
	public function get_categories() { return [ 'adymob' ]; }

	protected function register_controls() {

		$this->start_controls_section( 's_header', [ 'label' => 'سر بخش' ] );
		$this->add_control( 'eyebrow', [ 'label' => 'متن بالا', 'type' => Controls_Manager::TEXT,     'default' => 'مراحل کار' ] );
		$this->add_control( 'heading', [ 'label' => 'عنوان',    'type' => Controls_Manager::TEXT,     'default' => 'در ۴ مرحله ساده' ] );
		$this->end_controls_section();

		$this->start_controls_section( 's_steps', [ 'label' => 'مراحل' ] );

		$rep = new Repeater();
		$rep->add_control( 'number', [ 'label' => 'شماره',      'type' => Controls_Manager::TEXT, 'default' => '۰۱' ] );
		$rep->add_control( 'title',  [ 'label' => 'عنوان مرحله','type' => Controls_Manager::TEXT, 'default' => 'مرحله' ] );
		$rep->add_control( 'desc',   [ 'label' => 'توضیحات',    'type' => Controls_Manager::TEXTAREA, 'default' => 'توضیحات مرحله.' ] );

		$this->add_control( 'steps', [
			'label'       => 'مراحل',
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep->get_controls(),
			'default'     => [
				[ 'number' => '۰۱', 'title' => 'ثبت سفارش',    'desc' => 'فرم ساده را پر کنید — کمتر از ۲ دقیقه.' ],
				[ 'number' => '۰۲', 'title' => 'تأیید نرخ',    'desc' => 'نرخ نهایی ظرف چند دقیقه به شما اعلام می‌شود.' ],
				[ 'number' => '۰۳', 'title' => 'انجام تراکنش', 'desc' => 'تیم تخصصی ما عملیات را با امنیت کامل انجام می‌دهد.' ],
				[ 'number' => '۰۴', 'title' => 'دریافت نتیجه', 'desc' => 'مبلغ نهایی به حساب شما در کمتر از ۲ ساعت کاری.' ],
			],
			'title_field' => '{{{ number }}} — {{{ title }}}',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$steps = $s['steps'] ?? [];
		?>
		<div class="adm-widget">
			<div class="adm-section-head">
				<?php if ( $s['eyebrow'] ?? '' ) : ?>
					<div><span class="adm-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
				<?php endif; ?>
				<?php if ( $s['heading'] ?? '' ) : ?>
					<h2 class="adm-h2" style="margin-top:16px;"><?php echo esc_html( $s['heading'] ); ?></h2>
				<?php endif; ?>
			</div>
			<div class="adm-hiw__grid">
				<?php foreach ( $steps as $step ) : ?>
					<div class="adm-card">
						<div class="adm-hiw__num adm-num"><?php echo esc_html( $step['number'] ); ?></div>
						<h3 class="adm-h4" style="margin-bottom:6px;"><?php echo esc_html( $step['title'] ); ?></h3>
						<p class="adm-hiw__desc"><?php echo esc_html( $step['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}

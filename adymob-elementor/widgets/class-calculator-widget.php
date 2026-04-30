<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Calculator_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-calculator'; }
	public function get_title()      { return 'AdyMob — ماشین‌حساب'; }
	public function get_icon()       { return 'eicon-calculator'; }
	public function get_categories() { return [ 'adymob' ]; }
	public function get_keywords()   { return [ 'calculator', 'income', 'adymob', 'youtube', 'admob' ]; }

	protected function register_controls() {

		$this->start_controls_section( 's_settings', [ 'label' => 'تنظیمات' ] );

		$this->add_control( 'default_tab', [
			'label'   => 'تب پیش‌فرض',
			'type'    => Controls_Manager::SELECT,
			'default' => 'youtube',
			'options' => [ 'youtube' => 'YouTube', 'admob' => 'AdMob', 'adsense' => 'AdSense' ],
		] );
		$this->add_control( 'default_amount', [
			'label'   => 'مبلغ پیش‌فرض (دلار)',
			'type'    => Controls_Manager::NUMBER,
			'default' => 1000, 'min' => 0,
		] );
		$this->add_control( 'usd_rate', [
			'label'   => 'نرخ دلار (تومان)',
			'type'    => Controls_Manager::NUMBER,
			'default' => 89500,
		] );
		$this->add_control( 'fee_youtube', [ 'label' => 'کارمزد YouTube (٪)', 'type' => Controls_Manager::NUMBER, 'default' => 4,  'min' => 0, 'max' => 30 ] );
		$this->add_control( 'fee_admob',   [ 'label' => 'کارمزد AdMob (٪)',   'type' => Controls_Manager::NUMBER, 'default' => 5,  'min' => 0, 'max' => 30 ] );
		$this->add_control( 'fee_adsense', [ 'label' => 'کارمزد AdSense (٪)', 'type' => Controls_Manager::NUMBER, 'default' => 6,  'min' => 0, 'max' => 30 ] );

		$this->end_controls_section();

		$this->start_controls_section( 's_labels', [ 'label' => 'متن‌ها' ] );

		$this->add_control( 'title',   [ 'label' => 'عنوان', 'type' => Controls_Manager::TEXT, 'default' => 'محاسبه درآمد' ] );
		$this->add_control( 'btn_txt', [ 'label' => 'متن دکمه',  'type' => Controls_Manager::TEXT, 'default' => 'ثبت سفارش با این مبلغ' ] );
		$this->add_control( 'btn_url', [ 'label' => 'لینک دکمه', 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#' ] ] );

		$this->end_controls_section();
	}

	protected function render() {
		$s       = $this->get_settings_for_display();
		$rate    = intval( $s['usd_rate']       ?? 89500 );
		$yt      = intval( $s['fee_youtube']    ?? 4 );
		$am      = intval( $s['fee_admob']      ?? 5 );
		$as      = intval( $s['fee_adsense']    ?? 6 );
		$tab     = esc_attr( $s['default_tab']  ?? 'youtube' );
		$amount  = intval( $s['default_amount'] ?? 1000 );
		$title   = esc_html( $s['title']        ?? 'محاسبه درآمد' );
		$btn_txt = esc_html( $s['btn_txt']      ?? 'ثبت سفارش' );
		$btn_url = esc_url( $s['btn_url']['url'] ?? '#' );
		?>
		<div class="adm-widget">
		<div class="adm-calculator"
			data-usd-rate="<?php echo $rate; ?>"
			data-fee-youtube="<?php echo $yt; ?>"
			data-fee-admob="<?php echo $am; ?>"
			data-fee-adsense="<?php echo $as; ?>"
			data-default-tab="<?php echo $tab; ?>"
			data-default-amount="<?php echo $amount; ?>">

			<div class="adm-calc__header">
				<span class="adm-calc__title"><?php echo $title; ?></span>
				<span class="adm-calc__live">
					<span style="width:6px;height:6px;background:#10B981;border-radius:50%;display:inline-block;"></span>
					نرخ زنده
				</span>
			</div>

			<div class="adm-tabs adm-calc__tabs">
				<button class="adm-tab adm-calc-tab" data-tab="youtube">YouTube</button>
				<button class="adm-tab adm-calc-tab" data-tab="admob">AdMob</button>
				<button class="adm-tab adm-calc-tab" data-tab="adsense">AdSense</button>
			</div>

			<label class="adm-calc__label">مبلغ (دلار)</label>
			<div class="adm-calc__input-wrap">
				<input type="number" class="adm-input adm-num adm-calc-input" value="<?php echo $amount; ?>" min="0" max="999999">
				<span class="adm-calc__suffix">USD</span>
			</div>
			<input type="range" class="adm-calc-range" min="100" max="20000" step="100" value="<?php echo $amount; ?>">
			<div class="adm-calc__range-labels"><span>$۱۰۰</span><span>$۲۰٬۰۰۰</span></div>

			<div class="adm-calc__results">
				<div class="adm-calc__row">
					<span class="adm-calc__row-l">معادل تومانی</span>
					<span class="adm-calc__row-v adm-num adm-calc-gross">—</span>
				</div>
				<div class="adm-calc__row">
					<span class="adm-calc__row-l adm-calc__row-l--mute adm-calc-fee-label">کارمزد</span>
					<span class="adm-calc__row-v adm-num adm-calc-fee" style="color:var(--adm-text-mute);">—</span>
				</div>
				<div class="adm-calc__divider"></div>
				<div class="adm-calc__row">
					<span class="adm-calc__row-l">مبلغ نهایی واریزی</span>
					<span class="adm-calc-net adm-num">—</span>
				</div>
			</div>

			<a href="<?php echo $btn_url; ?>" class="adm-btn adm-btn--primary" style="width:100%;justify-content:center;">
				<?php echo $btn_txt; ?>
			</a>
		</div>
		</div>
		<?php
	}
}

<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Hero_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-hero'; }
	public function get_title()      { return 'AdyMob — Hero'; }
	public function get_icon()       { return 'eicon-header'; }
	public function get_categories() { return [ 'adymob' ]; }
	public function get_keywords()   { return [ 'hero', 'adymob', 'banner' ]; }

	protected function register_controls() {

		// ── Layout ────────────────────────────────────────────────────────────
		$this->start_controls_section( 's_layout', [ 'label' => 'چیدمان' ] );

		$this->add_control( 'layout', [
			'label'   => 'نوع Hero',
			'type'    => Controls_Manager::SELECT,
			'default' => 'split',
			'options' => [
				'split'     => 'دو ستونه (پیش‌فرض)',
				'centered'  => 'مرکزی',
				'editorial' => 'مجله‌ای تیره',
			],
		] );
		$this->add_control( 'show_calc', [
			'label'        => 'نمایش ماشین‌حساب',
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => 'بله',
			'label_off'    => 'خیر',
		] );
		$this->end_controls_section();

		// ── Content ───────────────────────────────────────────────────────────
		$this->start_controls_section( 's_content', [ 'label' => 'محتوا' ] );

		$this->add_control( 'eyebrow', [
			'label'   => 'متن بالای عنوان',
			'type'    => Controls_Manager::TEXT,
			'default' => 'پلتفرم نقد درآمد ارزی شماره ۱ ایران',
		] );
		$this->add_control( 'heading', [
			'label'   => 'عنوان اصلی',
			'type'    => Controls_Manager::TEXTAREA,
			'default' => "درآمد ارزی شما را\nامن، سریع و شفاف\nمدیریت می‌کنیم.",
			'rows'    => 4,
		] );
		$this->add_control( 'heading_highlight', [
			'label'       => 'عبارت رنگی در عنوان (دقیقاً مانند متن بالا بنویسید)',
			'type'        => Controls_Manager::TEXT,
			'default'     => 'امن، سریع و شفاف',
			'description' => 'این عبارت با گرادیان نارنجی نمایش داده می‌شود.',
		] );
		$this->add_control( 'subheading', [
			'label'   => 'توضیحات',
			'type'    => Controls_Manager::TEXTAREA,
			'default' => 'نقد درآمد AdMob، YouTube، AdSense؛ شارژ Google Ads، حواله ارزی و پرداخت‌های بین‌المللی — همه در یک پلتفرم.',
			'rows'    => 3,
		] );
		$this->end_controls_section();

		// ── Buttons ───────────────────────────────────────────────────────────
		$this->start_controls_section( 's_buttons', [ 'label' => 'دکمه‌ها' ] );

		$this->add_control( 'btn1_text', [ 'label' => 'دکمه اول (متن)', 'type' => Controls_Manager::TEXT, 'default' => 'ثبت سفارش رایگان' ] );
		$this->add_control( 'btn1_url',  [ 'label' => 'دکمه اول (لینک)', 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#contact' ] ] );
		$this->add_control( 'btn2_text', [ 'label' => 'دکمه دوم (متن)', 'type' => Controls_Manager::TEXT, 'default' => 'درباره AdyMob' ] );
		$this->add_control( 'btn2_url',  [ 'label' => 'دکمه دوم (لینک)', 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#about' ] ] );
		$this->end_controls_section();

		// ── Trust badges ──────────────────────────────────────────────────────
		$this->start_controls_section( 's_badges', [ 'label' => 'نشان‌های اعتماد' ] );

		$this->add_control( 'show_badges', [ 'label' => 'نمایش نشان‌ها', 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ] );
		$this->add_control( 'badge1', [ 'label' => 'نشان ۱', 'type' => Controls_Manager::TEXT, 'default' => 'واریز در ۲ ساعت', 'condition' => [ 'show_badges' => 'yes' ] ] );
		$this->add_control( 'badge2', [ 'label' => 'نشان ۲', 'type' => Controls_Manager::TEXT, 'default' => 'تضمین بازگشت وجه', 'condition' => [ 'show_badges' => 'yes' ] ] );
		$this->add_control( 'badge3', [ 'label' => 'نشان ۳', 'type' => Controls_Manager::TEXT, 'default' => 'بدون کارمزد پنهان', 'condition' => [ 'show_badges' => 'yes' ] ] );
		$this->end_controls_section();

		// ── Calculator settings ───────────────────────────────────────────────
		$this->start_controls_section( 's_calc', [ 'label' => 'تنظیمات ماشین‌حساب', 'condition' => [ 'show_calc' => 'yes' ] ] );

		$this->add_control( 'calc_tab',    [ 'label' => 'تب پیش‌فرض', 'type' => Controls_Manager::SELECT, 'default' => 'youtube', 'options' => [ 'youtube' => 'YouTube', 'admob' => 'AdMob', 'adsense' => 'AdSense' ] ] );
		$this->add_control( 'usd_rate',    [ 'label' => 'نرخ دلار (تومان)', 'type' => Controls_Manager::NUMBER, 'default' => 89500 ] );
		$this->add_control( 'fee_youtube', [ 'label' => 'کارمزد YouTube (٪)', 'type' => Controls_Manager::NUMBER, 'default' => 4, 'min' => 0, 'max' => 30 ] );
		$this->add_control( 'fee_admob',   [ 'label' => 'کارمزد AdMob (٪)',   'type' => Controls_Manager::NUMBER, 'default' => 5, 'min' => 0, 'max' => 30 ] );
		$this->add_control( 'fee_adsense', [ 'label' => 'کارمزد AdSense (٪)', 'type' => Controls_Manager::NUMBER, 'default' => 6, 'min' => 0, 'max' => 30 ] );
		$this->add_control( 'calc_btn',    [ 'label' => 'متن دکمه ماشین‌حساب', 'type' => Controls_Manager::TEXT, 'default' => 'ثبت سفارش با این مبلغ' ] );
		$this->add_control( 'calc_btn_url', [ 'label' => 'لینک دکمه ماشین‌حساب', 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#contact' ] ] );
		$this->end_controls_section();

		// ── Editorial stats ───────────────────────────────────────────────────
		$this->start_controls_section( 's_ed_stats', [ 'label' => 'آمار (فقط چیدمان مجله‌ای)', 'condition' => [ 'layout' => 'editorial' ] ] );
		$this->add_control( 'ed_s1v', [ 'label' => 'آمار ۱ — عدد', 'type' => Controls_Manager::TEXT, 'default' => '۱۲هزار+' ] );
		$this->add_control( 'ed_s1l', [ 'label' => 'آمار ۱ — برچسب', 'type' => Controls_Manager::TEXT, 'default' => 'مشتری فعال' ] );
		$this->add_control( 'ed_s2v', [ 'label' => 'آمار ۲ — عدد', 'type' => Controls_Manager::TEXT, 'default' => '۹۹.۸٪' ] );
		$this->add_control( 'ed_s2l', [ 'label' => 'آمار ۲ — برچسب', 'type' => Controls_Manager::TEXT, 'default' => 'تسویه به‌موقع' ] );
		$this->add_control( 'ed_s3v', [ 'label' => 'آمار ۳ — عدد', 'type' => Controls_Manager::TEXT, 'default' => '<۲ ساعت' ] );
		$this->add_control( 'ed_s3l', [ 'label' => 'آمار ۳ — برچسب', 'type' => Controls_Manager::TEXT, 'default' => 'زمان واریز' ] );
		$this->end_controls_section();
	}

	protected function render() {
		$s  = $this->get_settings_for_display();
		$lo = $s['layout'] ?? 'split';

		$btn1_url = esc_url( $s['btn1_url']['url'] ?? '#' );
		$btn2_url = esc_url( $s['btn2_url']['url'] ?? '#' );
		$heading  = esc_html( $s['heading']   ?? '' );
		$highlight= esc_html( $s['heading_highlight'] ?? '' );

		if ( $highlight ) {
			$heading = str_replace(
				$highlight,
				'<span class="adm-gradient-text">' . $highlight . '</span>',
				$heading
			);
		}
		$heading_html = nl2br( $heading );
		?>
		<div class="adm-widget">
		<?php if ( $lo === 'editorial' ) : ?>

			<div class="adm-hero adm-hero--editorial">
				<div class="adm-hero__inner">
					<div style="position:absolute;top:-80px;left:-80px;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(251,191,36,.3),transparent 70%);pointer-events:none;"></div>
					<div style="position:absolute;bottom:-60px;right:-60px;width:280px;height:280px;border-radius:50%;background:radial-gradient(circle,rgba(245,158,11,.18),transparent 70%);pointer-events:none;"></div>
					<div class="adm-hero__grid">
						<div>
							<div class="adm-hero__badge-ed">
								<span class="adm-hero__live-dot"></span>
								<?php echo esc_html( $s['eyebrow'] ?? '' ); ?>
							</div>
							<h1 class="adm-h1" style="margin-bottom:22px;"><?php echo wp_kses_post( $heading_html ); ?></h1>
							<p class="adm-lead" style="max-width:480px;margin-bottom:28px;"><?php echo esc_html( $s['subheading'] ?? '' ); ?></p>
							<div class="adm-hero__buttons">
								<a href="<?php echo $btn1_url; ?>" class="adm-btn adm-btn--primary adm-btn--lg"><?php echo esc_html( $s['btn1_text'] ?? '' ); ?></a>
								<a href="<?php echo $btn2_url; ?>" class="adm-btn adm-btn--dark-glass adm-btn--lg"><?php echo esc_html( $s['btn2_text'] ?? '' ); ?></a>
							</div>
							<?php
							$stats = [
								[ $s['ed_s1v'] ?? '', $s['ed_s1l'] ?? '' ],
								[ $s['ed_s2v'] ?? '', $s['ed_s2l'] ?? '' ],
								[ $s['ed_s3v'] ?? '', $s['ed_s3l'] ?? '' ],
							];
							?>
							<div class="adm-hero__stats">
								<?php foreach ( $stats as $st ) : ?>
									<div>
										<div class="adm-hero__stat-v adm-num"><?php echo esc_html( $st[0] ); ?></div>
										<div class="adm-hero__stat-l"><?php echo esc_html( $st[1] ); ?></div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<?php if ( 'yes' === $s['show_calc'] ) : ?>
							<div><?php $this->render_calculator( $s ); ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>

		<?php elseif ( $lo === 'centered' ) : ?>

			<div class="adm-hero adm-hero--centered" style="position:relative;">
				<div class="adm-hero__dot-grid"></div>
				<div style="position:relative;max-width:880px;margin:0 auto;">
					<div class="adm-hero__eyebrow">
						<span class="adm-eyebrow"><?php echo adymob_icon( 'star', 14 ); ?> <?php echo esc_html( $s['eyebrow'] ?? '' ); ?></span>
					</div>
					<h1 class="adm-h1 adm-hero__heading"><?php echo wp_kses_post( $heading_html ); ?></h1>
					<p class="adm-lead adm-hero__sub"><?php echo esc_html( $s['subheading'] ?? '' ); ?></p>
					<div class="adm-hero__buttons">
						<a href="<?php echo $btn1_url; ?>" class="adm-btn adm-btn--primary adm-btn--lg"><?php echo esc_html( $s['btn1_text'] ?? '' ); ?></a>
						<a href="<?php echo $btn2_url; ?>" class="adm-btn adm-btn--outline adm-btn--lg"><?php echo esc_html( $s['btn2_text'] ?? '' ); ?></a>
					</div>
					<?php if ( 'yes' === $s['show_calc'] ) : ?>
						<div class="adm-hero__calc-col"><?php $this->render_calculator( $s ); ?></div>
					<?php endif; ?>
				</div>
			</div>

		<?php else : /* split */ ?>

			<div class="adm-hero adm-hero--split" style="position:relative;">
				<div class="adm-hero__orb" style="top:-100px;left:-100px;width:360px;height:360px;background:radial-gradient(circle,rgba(251,191,36,.18),transparent 70%);"></div>
				<div class="adm-hero__orb" style="bottom:-120px;right:-100px;width:320px;height:320px;background:radial-gradient(circle,rgba(245,158,11,.12),transparent 70%);"></div>
				<div class="adm-hero__grid">
					<div>
						<div class="adm-hero__eyebrow">
							<span class="adm-eyebrow"><?php echo adymob_icon( 'sparkle', 14 ); ?> <?php echo esc_html( $s['eyebrow'] ?? '' ); ?></span>
						</div>
						<h1 class="adm-h1 adm-hero__heading"><?php echo wp_kses_post( $heading_html ); ?></h1>
						<p class="adm-lead adm-hero__sub"><?php echo esc_html( $s['subheading'] ?? '' ); ?></p>
						<div class="adm-hero__buttons">
							<a href="<?php echo $btn1_url; ?>" class="adm-btn adm-btn--primary adm-btn--lg"><?php echo esc_html( $s['btn1_text'] ?? '' ); ?></a>
							<a href="<?php echo $btn2_url; ?>" class="adm-btn adm-btn--ghost adm-btn--lg"><?php echo esc_html( $s['btn2_text'] ?? '' ); ?></a>
						</div>
						<?php if ( 'yes' === $s['show_badges'] ) :
							$badges = [
								[ 'bolt',   $s['badge1'] ?? '' ],
								[ 'shield', $s['badge2'] ?? '' ],
								[ 'eye',    $s['badge3'] ?? '' ],
							];
							?>
							<div class="adm-hero__badges">
								<?php foreach ( $badges as $b ) : ?>
									<div class="adm-hero__badge">
										<span class="adm-hero__badge-icon"><?php echo adymob_icon( $b[0], 18 ); ?></span>
										<?php echo esc_html( $b[1] ); ?>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ( 'yes' === $s['show_calc'] ) : ?>
						<div><?php $this->render_calculator( $s ); ?></div>
					<?php endif; ?>
				</div>
			</div>

		<?php endif; ?>
		</div>
		<?php
	}

	private function render_calculator( array $s ): void {
		$rate    = intval( $s['usd_rate']    ?? 89500 );
		$yt      = intval( $s['fee_youtube'] ?? 4 );
		$am      = intval( $s['fee_admob']   ?? 5 );
		$as      = intval( $s['fee_adsense'] ?? 6 );
		$tab     = esc_attr( $s['calc_tab']  ?? 'youtube' );
		$btn_txt = esc_html( $s['calc_btn']  ?? 'ثبت سفارش با این مبلغ' );
		$btn_url = esc_url( $s['calc_btn_url']['url'] ?? '#' );
		?>
		<div class="adm-calculator" data-usd-rate="<?php echo $rate; ?>" data-fee-youtube="<?php echo $yt; ?>" data-fee-admob="<?php echo $am; ?>" data-fee-adsense="<?php echo $as; ?>" data-default-tab="<?php echo $tab; ?>" data-default-amount="1000">
			<div class="adm-calc__header">
				<span class="adm-calc__title">محاسبه درآمد</span>
				<span class="adm-calc__live"><span style="width:6px;height:6px;background:#10B981;border-radius:50%;display:inline-block;"></span> نرخ زنده</span>
			</div>
			<div class="adm-tabs adm-calc__tabs">
				<button class="adm-tab adm-calc-tab" data-tab="youtube">YouTube</button>
				<button class="adm-tab adm-calc-tab" data-tab="admob">AdMob</button>
				<button class="adm-tab adm-calc-tab" data-tab="adsense">AdSense</button>
			</div>
			<label class="adm-calc__label">مبلغ (دلار)</label>
			<div class="adm-calc__input-wrap">
				<input type="number" class="adm-input adm-num adm-calc-input" value="1000" min="0" max="999999">
				<span class="adm-calc__suffix">USD</span>
			</div>
			<input type="range" class="adm-calc-range" min="100" max="20000" step="100" value="1000">
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
			<a href="<?php echo $btn_url; ?>" class="adm-btn adm-btn--primary" style="width:100%;justify-content:center;"><?php echo $btn_txt; ?></a>
		</div>
		<?php
	}
}

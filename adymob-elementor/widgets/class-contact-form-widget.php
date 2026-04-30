<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Contact_Form_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-contact-form'; }
	public function get_title()      { return 'AdyMob — فرم سفارش'; }
	public function get_icon()       { return 'eicon-form-horizontal'; }
	public function get_categories() { return [ 'adymob' ]; }

	protected function register_controls() {

		// ── Form ──────────────────────────────────────────────────────────────
		$this->start_controls_section( 's_form', [ 'label' => 'فرم' ] );
		$this->add_control( 'form_title',    [ 'label' => 'عنوان فرم',    'type' => Controls_Manager::TEXT, 'default' => 'ثبت سفارش رایگان' ] );
		$this->add_control( 'label_name',    [ 'label' => 'برچسب نام',    'type' => Controls_Manager::TEXT, 'default' => 'نام و نام خانوادگی' ] );
		$this->add_control( 'ph_name',       [ 'label' => 'پیش‌نویس نام', 'type' => Controls_Manager::TEXT, 'default' => 'نام شما' ] );
		$this->add_control( 'label_phone',   [ 'label' => 'برچسب تلفن',   'type' => Controls_Manager::TEXT, 'default' => 'شماره تماس' ] );
		$this->add_control( 'ph_phone',      [ 'label' => 'پیش‌نویس تلفن','type' => Controls_Manager::TEXT, 'default' => '۰۹۱۲۳۴۵۶۷۸۹' ] );
		$this->add_control( 'label_service', [ 'label' => 'برچسب سرویس',  'type' => Controls_Manager::TEXT, 'default' => 'سرویس مورد نظر' ] );
		$this->add_control( 'label_amount',  [ 'label' => 'برچسب مبلغ',   'type' => Controls_Manager::TEXT, 'default' => 'مبلغ تقریبی (دلار)' ] );
		$this->add_control( 'ph_amount',     [ 'label' => 'پیش‌نویس مبلغ','type' => Controls_Manager::TEXT, 'default' => '۱۰۰۰' ] );
		$this->add_control( 'submit_text',   [ 'label' => 'متن دکمه ارسال','type' => Controls_Manager::TEXT, 'default' => 'ارسال درخواست' ] );
		$this->add_control( 'privacy_note',  [ 'label' => 'نکته حریم خصوصی','type' => Controls_Manager::TEXT, 'default' => 'اطلاعات شما کاملاً محرمانه باقی می‌ماند.' ] );
		$this->end_controls_section();

		// ── Services list ─────────────────────────────────────────────────────
		$this->start_controls_section( 's_services', [ 'label' => 'لیست سرویس‌ها' ] );
		$rep = new Repeater();
		$rep->add_control( 'svc_id',   [ 'label' => 'شناسه (انگلیسی)', 'type' => Controls_Manager::TEXT, 'default' => 'youtube' ] );
		$rep->add_control( 'svc_name', [ 'label' => 'نام سرویس',       'type' => Controls_Manager::TEXT, 'default' => 'نقد درآمد YouTube' ] );
		$this->add_control( 'services', [
			'label'       => 'سرویس‌ها',
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep->get_controls(),
			'default'     => [
				[ 'svc_id' => 'admob',       'svc_name' => 'نقد درآمد AdMob' ],
				[ 'svc_id' => 'youtube',     'svc_name' => 'نقد درآمد YouTube' ],
				[ 'svc_id' => 'adsense',     'svc_name' => 'نقد درآمد AdSense' ],
				[ 'svc_id' => 'gads-charge', 'svc_name' => 'شارژ Google Ads' ],
				[ 'svc_id' => 'gads-mng',    'svc_name' => 'مدیریت Google Ads' ],
				[ 'svc_id' => 'wire',        'svc_name' => 'حواله ارزی' ],
				[ 'svc_id' => 'paypal',      'svc_name' => 'پرداخت بین‌المللی' ],
			],
			'title_field' => '{{{ svc_name }}}',
		] );
		$this->end_controls_section();

		// ── Success state ─────────────────────────────────────────────────────
		$this->start_controls_section( 's_success', [ 'label' => 'پیام موفقیت' ] );
		$this->add_control( 'success_title', [ 'label' => 'عنوان', 'type' => Controls_Manager::TEXT,     'default' => 'سفارش شما ثبت شد' ] );
		$this->add_control( 'success_text',  [ 'label' => 'متن',   'type' => Controls_Manager::TEXTAREA,  'default' => 'تیم ما طی چند دقیقه با شما تماس می‌گیرد.' ] );
		$this->add_control( 'reset_text',    [ 'label' => 'دکمه سفارش مجدد','type' => Controls_Manager::TEXT,'default' => 'ثبت سفارش جدید' ] );
		$this->end_controls_section();

		// ── Contact info ──────────────────────────────────────────────────────
		$this->start_controls_section( 's_info', [ 'label' => 'اطلاعات تماس (ستون راست)' ] );
		$this->add_control( 'info_title', [ 'label' => 'عنوان', 'type' => Controls_Manager::TEXT, 'default' => 'سؤال، سفارش، مشاوره' ] );
		$this->add_control( 'info_sub',   [ 'label' => 'توضیح', 'type' => Controls_Manager::TEXTAREA, 'default' => 'تیم پشتیبانی ما به‌صورت ۲۴/۷ آماده پاسخگویی است. سریع‌ترین راه: تلفن یا تلگرام.' ] );

		$rep2 = new Repeater();
		$rep2->add_control( 'ci_icon',   [ 'label' => 'آیکون', 'type' => Controls_Manager::SELECT, 'default' => 'phone', 'options' => [ 'phone' => 'تلفن', 'mail' => 'ایمیل', 'clock' => 'ساعت / آنلاین' ] ] );
		$rep2->add_control( 'ci_label',  [ 'label' => 'برچسب',       'type' => Controls_Manager::TEXT, 'default' => 'تلفن' ] );
		$rep2->add_control( 'ci_detail', [ 'label' => 'جزئیات',      'type' => Controls_Manager::TEXT, 'default' => '۰۲۱-۹۱۰۰۰۰۰۰' ] );
		$rep2->add_control( 'ci_sub',    [ 'label' => 'توضیح کوچک',  'type' => Controls_Manager::TEXT, 'default' => 'شنبه تا پنجشنبه ۹ تا ۹' ] );

		$this->add_control( 'contact_items', [
			'label'       => 'آیتم‌های تماس',
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep2->get_controls(),
			'default'     => [
				[ 'ci_icon' => 'phone', 'ci_label' => 'تلفن',          'ci_detail' => '۰۲۱-۹۱۰۰۰۰۰۰',      'ci_sub' => 'شنبه تا پنجشنبه — ۹ صبح تا ۹ شب' ],
				[ 'ci_icon' => 'mail',  'ci_label' => 'ایمیل',          'ci_detail' => 'info@adymob.com',      'ci_sub' => 'پاسخ در کمتر از ۲ ساعت کاری' ],
				[ 'ci_icon' => 'clock', 'ci_label' => 'پشتیبانی آنلاین','ci_detail' => '@adymob_support',      'ci_sub' => '۲۴ ساعته' ],
			],
			'title_field' => '{{{ ci_label }}}',
		] );
		$this->end_controls_section();
	}

	protected function render() {
		$s        = $this->get_settings_for_display();
		$services = $s['services']      ?? [];
		$ci_items = $s['contact_items'] ?? [];
		$uniq     = 'adm-cf-' . $this->get_id();
		?>
		<div class="adm-widget adm-contact-widget" id="<?php echo esc_attr( $uniq ); ?>">
		<div class="adm-contact__grid">

			<!-- Left: contact info -->
			<div>
				<span class="adm-eyebrow" style="margin-bottom:16px;display:inline-flex;">
					<?php echo adymob_icon( 'phone', 14 ); ?> در تماس باشیم
				</span>
				<h1 class="adm-h1" style="margin-top:16px;margin-bottom:16px;font-size:clamp(28px,4vw,48px);">
					<?php echo esc_html( $s['info_title'] ?? '' ); ?>
				</h1>
				<p class="adm-lead" style="margin-bottom:32px;"><?php echo esc_html( $s['info_sub'] ?? '' ); ?></p>

				<?php foreach ( $ci_items as $ci ) : ?>
					<div class="adm-contact__info-item">
						<div class="adm-contact__info-icon">
							<?php echo adymob_icon( $ci['ci_icon'] ?? 'phone', 20 ); ?>
						</div>
						<div>
							<div class="adm-contact__info-lbl"><?php echo esc_html( $ci['ci_label'] ); ?></div>
							<div class="adm-contact__info-detail"><?php echo esc_html( $ci['ci_detail'] ); ?></div>
							<div class="adm-contact__info-sub"><?php echo esc_html( $ci['ci_sub'] ); ?></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Right: form -->
			<div class="adm-card adm-contact__form-wrap">

				<!-- Success state -->
				<div class="adm-contact-success">
					<div class="adm-contact-success__icon">
						<?php echo adymob_icon( 'check', 32 ); ?>
					</div>
					<h3 class="adm-h3" style="margin-bottom:10px;"><?php echo esc_html( $s['success_title'] ?? '' ); ?></h3>
					<p style="font-size:14px;color:var(--adm-text-mute);"><?php echo esc_html( $s['success_text'] ?? '' ); ?></p>
					<button type="button" class="adm-btn adm-btn--outline" style="margin-top:20px;" onclick="this.closest('.adm-contact-widget').querySelector('.adm-contact-form').style.display='';this.closest('.adm-contact-success').style.display='none';">
						<?php echo esc_html( $s['reset_text'] ?? 'ثبت سفارش جدید' ); ?>
					</button>
				</div>

				<!-- Form -->
				<form class="adm-contact-form">
					<h3 class="adm-h3" style="margin-bottom:18px;"><?php echo esc_html( $s['form_title'] ?? '' ); ?></h3>

					<div class="adm-contact-error"></div>

					<div class="adm-form__field">
						<label class="adm-form__label"><?php echo esc_html( $s['label_name'] ?? '' ); ?></label>
						<input type="text" name="order_name" class="adm-input" placeholder="<?php echo esc_attr( $s['ph_name'] ?? '' ); ?>" required>
					</div>
					<div class="adm-form__field">
						<label class="adm-form__label"><?php echo esc_html( $s['label_phone'] ?? '' ); ?></label>
						<input type="text" name="order_phone" class="adm-input" placeholder="<?php echo esc_attr( $s['ph_phone'] ?? '' ); ?>" required>
					</div>
					<div class="adm-form__field">
						<label class="adm-form__label"><?php echo esc_html( $s['label_service'] ?? '' ); ?></label>
						<select name="order_service" class="adm-input">
							<?php foreach ( $services as $svc ) : ?>
								<option value="<?php echo esc_attr( $svc['svc_id'] ); ?>">
									<?php echo esc_html( $svc['svc_name'] ); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="adm-form__field">
						<label class="adm-form__label"><?php echo esc_html( $s['label_amount'] ?? '' ); ?></label>
						<input type="number" name="order_amount" class="adm-input" placeholder="<?php echo esc_attr( $s['ph_amount'] ?? '' ); ?>">
					</div>

					<button type="submit" class="adm-btn adm-btn--primary adm-btn--lg" style="width:100%;margin-top:8px;justify-content:center;">
						<?php echo esc_html( $s['submit_text'] ?? 'ارسال درخواست' ); ?>
						<?php echo adymob_icon( 'arrow', 16 ); ?>
					</button>

					<?php if ( $s['privacy_note'] ?? '' ) : ?>
						<p style="font-size:12px;color:var(--adm-text-mute);margin-top:12px;text-align:center;">
							<?php echo esc_html( $s['privacy_note'] ); ?>
						</p>
					<?php endif; ?>
				</form>
			</div>

		</div>
		</div>
		<?php
	}
}

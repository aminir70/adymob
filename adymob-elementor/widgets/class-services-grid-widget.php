<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Services_Grid_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-services-grid'; }
	public function get_title()      { return 'AdyMob — گرید سرویس‌ها'; }
	public function get_icon()       { return 'eicon-apps'; }
	public function get_categories() { return [ 'adymob' ]; }

	protected function register_controls() {

		// ── Header ────────────────────────────────────────────────────────────
		$this->start_controls_section( 's_header', [ 'label' => 'سر بخش' ] );
		$this->add_control( 'eyebrow',  [ 'label' => 'متن بالا',    'type' => Controls_Manager::TEXT, 'default' => 'سرویس‌های ما' ] );
		$this->add_control( 'heading',  [ 'label' => 'عنوان',        'type' => Controls_Manager::TEXT, 'default' => 'هر آنچه برای کسب‌وکار ارزی لازم دارید' ] );
		$this->add_control( 'subhead',  [ 'label' => 'توضیحات',      'type' => Controls_Manager::TEXTAREA, 'default' => 'هفت سرویس تخصصی، طراحی‌شده برای کسب‌وکارهای دیجیتال ایرانی.' ] );
		$this->end_controls_section();

		// ── Card style ────────────────────────────────────────────────────────
		$this->start_controls_section( 's_style', [ 'label' => 'سبک کارت' ] );
		$this->add_control( 'card_style', [
			'label'   => 'سبک',
			'type'    => Controls_Manager::SELECT,
			'default' => 'warm',
			'options' => [ 'warm' => 'گرم (نوار رنگی)', 'minimal' => 'مینیمال', 'gradient' => 'گرادیان' ],
		] );
		$this->end_controls_section();

		// ── Services ──────────────────────────────────────────────────────────
		$this->start_controls_section( 's_services', [ 'label' => 'سرویس‌ها' ] );

		$rep = new Repeater();
		$rep->add_control( 'name',  [ 'label' => 'نام سرویس', 'type' => Controls_Manager::TEXT,     'default' => 'سرویس' ] );
		$rep->add_control( 'desc',  [ 'label' => 'توضیحات',   'type' => Controls_Manager::TEXTAREA,  'default' => 'توضیحات کوتاه' ] );
		$rep->add_control( 'icon',  [
			'label'   => 'آیکون',
			'type'    => Controls_Manager::SELECT,
			'default' => 'bolt',
			'options' => [
				'bolt'   => 'صاعقه', 'shield' => 'سپر', 'eye'   => 'چشم',
				'users'  => 'کاربران', 'trend' => 'نمودار', 'star' => 'ستاره',
				'phone'  => 'تلفن',  'mail'  => 'ایمیل',
			],
		] );
		$rep->add_control( 'color', [ 'label' => 'رنگ', 'type' => Controls_Manager::COLOR, 'default' => '#F59E0B' ] );
		$rep->add_control( 'link',  [ 'label' => 'لینک', 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#' ] ] );

		$this->add_control( 'services', [
			'label'       => 'سرویس‌ها',
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep->get_controls(),
			'default'     => [
				[ 'name' => 'نقد درآمد AdMob',    'desc' => 'تبدیل سریع درآمد دلاری AdMob به تومان با کمترین کارمزد بازار.',    'icon' => 'bolt',   'color' => '#FBC02D', 'link' => [ 'url' => '#' ] ],
				[ 'name' => 'نقد درآمد YouTube',  'desc' => 'دریافت درآمد یوتیوب از Google AdSense و واریز مستقیم به حساب.',   'icon' => 'users',  'color' => '#FF0000', 'link' => [ 'url' => '#' ] ],
				[ 'name' => 'نقد درآمد AdSense',  'desc' => 'نقد درآمد سایت‌ها و وبلاگ‌های دارای AdSense با تضمین قیمت.',      'icon' => 'eye',    'color' => '#34A853', 'link' => [ 'url' => '#' ] ],
				[ 'name' => 'شارژ Google Ads',    'desc' => 'شارژ سریع اکانت گوگل ادز با ارز معادل دلار، یورو یا پوند.',       'icon' => 'trend',  'color' => '#4285F4', 'link' => [ 'url' => '#' ] ],
				[ 'name' => 'مدیریت Google Ads',  'desc' => 'راه‌اندازی، بهینه‌سازی و مدیریت کمپین‌های گوگل ادز توسط متخصصان.', 'icon' => 'shield', 'color' => '#9333EA', 'link' => [ 'url' => '#' ] ],
				[ 'name' => 'حواله ارزی',          'desc' => 'ارسال و دریافت ارز به/از کشورهای مختلف با نرخ روز و کارمزد شفاف.',  'icon' => 'star',   'color' => '#06B6D4', 'link' => [ 'url' => '#' ] ],
				[ 'name' => 'پرداخت بین‌المللی',   'desc' => 'پرداخت سرویس‌های آنلاین، خرید نرم‌افزار و پلتفرم‌های خارجی.',      'icon' => 'mail',   'color' => '#0EA5E9', 'link' => [ 'url' => '#' ] ],
			],
			'title_field' => '{{{ name }}}',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$s        = $this->get_settings_for_display();
		$style    = $s['card_style'] ?? 'warm';
		$services = $s['services']   ?? [];
		?>
		<div class="adm-widget">

			<?php if ( $s['heading'] ?? '' ) : ?>
			<div class="adm-section-head">
				<?php if ( $s['eyebrow'] ?? '' ) : ?>
					<div><span class="adm-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
				<?php endif; ?>
				<h2 class="adm-h2" style="margin-top:16px;margin-bottom:12px;"><?php echo esc_html( $s['heading'] ); ?></h2>
				<?php if ( $s['subhead'] ?? '' ) : ?>
					<p class="adm-lead" style="max-width:580px;margin:0 auto;"><?php echo esc_html( $s['subhead'] ); ?></p>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<div class="adm-services__grid">
				<?php foreach ( $services as $svc ) :
					$color   = esc_attr( $svc['color'] ?? '#F59E0B' );
					$link    = esc_url( $svc['link']['url'] ?? '#' );
					$name    = esc_html( $svc['name'] ?? '' );
					$desc    = esc_html( $svc['desc'] ?? '' );
					$icon_svg= adymob_icon( $svc['icon'] ?? 'bolt', 22 );

					if ( $style === 'gradient' ) : ?>
						<a href="<?php echo $link; ?>" class="adm-card adm-card--hover adm-svc--gradient" style="background:linear-gradient(135deg,<?php echo $color; ?>18,<?php echo $color; ?>06);border:1px solid <?php echo $color; ?>40;text-decoration:none;color:inherit;">
							<div class="adm-svc__icon-g" style="background:<?php echo $color; ?>;box-shadow:0 8px 20px <?php echo $color; ?>40;">
								<?php echo $icon_svg; ?>
							</div>
							<h3 class="adm-h4" style="margin-bottom:8px;"><?php echo $name; ?></h3>
							<p class="adm-svc__desc"><?php echo $desc; ?></p>
						</a>

					<?php elseif ( $style === 'minimal' ) : ?>
						<a href="<?php echo $link; ?>" class="adm-card adm-card--hover adm-svc--minimal" style="text-decoration:none;color:inherit;">
							<div class="adm-svc__icon" style="background:<?php echo $color; ?>18;color:<?php echo $color; ?>;">
								<?php echo $icon_svg; ?>
							</div>
							<h3 class="adm-h4" style="margin-bottom:8px;"><?php echo $name; ?></h3>
							<p class="adm-svc__desc"><?php echo $desc; ?></p>
							<div class="adm-svc__more">مشاهده <?php echo adymob_icon( 'arrow', 14 ); ?></div>
						</a>

					<?php else : /* warm */ ?>
						<a href="<?php echo $link; ?>" class="adm-card adm-card--hover adm-svc--warm" style="text-decoration:none;color:inherit;">
							<div class="adm-svc__bar" style="background:<?php echo $color; ?>;"></div>
							<div class="adm-svc__body">
								<div class="adm-svc__head">
									<div class="adm-svc__icon" style="background:<?php echo $color; ?>18;color:<?php echo $color; ?>;">
										<?php echo $icon_svg; ?>
									</div>
									<h3 class="adm-h4"><?php echo $name; ?></h3>
								</div>
								<p class="adm-svc__desc"><?php echo $desc; ?></p>
							</div>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>

		</div>
		<?php
	}
}

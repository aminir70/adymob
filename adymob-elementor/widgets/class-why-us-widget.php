<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Why_Us_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-why-us'; }
	public function get_title()      { return 'AdyMob — چرا ما'; }
	public function get_icon()       { return 'eicon-star'; }
	public function get_categories() { return [ 'adymob' ]; }

	protected function register_controls() {

		$this->start_controls_section( 's_header', [ 'label' => 'سر بخش' ] );
		$this->add_control( 'eyebrow', [ 'label' => 'متن بالا', 'type' => Controls_Manager::TEXT, 'default' => 'چرا AdyMob' ] );
		$this->add_control( 'heading', [ 'label' => 'عنوان',    'type' => Controls_Manager::TEXT, 'default' => 'چرا هزاران مشتری ما را انتخاب کرده‌اند' ] );
		$this->end_controls_section();

		$this->start_controls_section( 's_points', [ 'label' => 'مزایا' ] );

		$rep = new Repeater();
		$rep->add_control( 'icon',  [
			'label'   => 'آیکون',
			'type'    => Controls_Manager::SELECT,
			'default' => 'shield',
			'options' => [
				'shield' => 'سپر / امنیت', 'bolt'  => 'صاعقه / سرعت',
				'eye'    => 'چشم / شفافیت', 'users' => 'کاربران / پشتیبانی',
				'star'   => 'ستاره',         'trend' => 'نمودار',
			],
		] );
		$rep->add_control( 'title', [ 'label' => 'عنوان',    'type' => Controls_Manager::TEXT,     'default' => 'مزیت' ] );
		$rep->add_control( 'desc',  [ 'label' => 'توضیحات', 'type' => Controls_Manager::TEXTAREA,  'default' => 'توضیحات مزیت.' ] );

		$this->add_control( 'points', [
			'label'       => 'مزایا',
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep->get_controls(),
			'default'     => [
				[ 'icon' => 'shield', 'title' => 'امنیت تضمین‌شده',  'desc' => 'تمام تراکنش‌ها با پروتکل‌های امن انجام می‌شود و شامل ضمانت بازگشت وجه است.' ],
				[ 'icon' => 'bolt',   'title' => 'سرعت بالا',         'desc' => 'میانگین زمان واریز از ثبت سفارش تا دریافت تومان، کمتر از ۲ ساعت کاری است.' ],
				[ 'icon' => 'eye',    'title' => 'شفافیت کامل',       'desc' => 'نرخ تبدیل و کارمزد قبل از تأیید سفارش به‌طور دقیق به شما اعلام می‌شود.' ],
				[ 'icon' => 'users',  'title' => 'پشتیبانی ۲۴/۷',    'desc' => 'تیم متخصص ما به‌صورت شبانه‌روزی پاسخگوی سؤالات شماست.' ],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$s      = $this->get_settings_for_display();
		$points = $s['points'] ?? [];
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
			<div class="adm-whyus__grid">
				<?php foreach ( $points as $p ) : ?>
					<div class="adm-whyus__item">
						<div class="adm-whyus__icon">
							<?php echo adymob_icon( $p['icon'] ?? 'star', 24 ); ?>
						</div>
						<h3 class="adm-h4" style="margin-bottom:8px;"><?php echo esc_html( $p['title'] ); ?></h3>
						<p class="adm-whyus__desc"><?php echo esc_html( $p['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}

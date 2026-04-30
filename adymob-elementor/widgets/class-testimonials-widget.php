<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Testimonials_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-testimonials'; }
	public function get_title()      { return 'AdyMob — نظرات مشتریان'; }
	public function get_icon()       { return 'eicon-testimonial'; }
	public function get_categories() { return [ 'adymob' ]; }

	protected function register_controls() {

		$this->start_controls_section( 's_header', [ 'label' => 'سر بخش' ] );
		$this->add_control( 'eyebrow', [ 'label' => 'متن بالا', 'type' => Controls_Manager::TEXT, 'default' => 'نظر مشتریان' ] );
		$this->add_control( 'heading', [ 'label' => 'عنوان',    'type' => Controls_Manager::TEXT, 'default' => 'صدای کسانی که با ما کار می‌کنند' ] );
		$this->end_controls_section();

		$this->start_controls_section( 's_items', [ 'label' => 'نظرات' ] );

		$rep = new Repeater();
		$rep->add_control( 'name',  [ 'label' => 'نام',        'type' => Controls_Manager::TEXT, 'default' => 'نام مشتری' ] );
		$rep->add_control( 'role',  [ 'label' => 'سمت / نقش',  'type' => Controls_Manager::TEXT, 'default' => 'یوتیوبر' ] );
		$rep->add_control( 'text',  [ 'label' => 'نظر',        'type' => Controls_Manager::TEXTAREA, 'default' => 'نظر مشتری درباره سرویس.' ] );
		$rep->add_control( 'stars', [
			'label'   => 'تعداد ستاره',
			'type'    => Controls_Manager::NUMBER,
			'default' => 5, 'min' => 1, 'max' => 5,
		] );

		$this->add_control( 'items', [
			'label'       => 'نظرات',
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep->get_controls(),
			'default'     => [
				[ 'name' => 'مهدی رضایی',  'role' => 'یوتیوبر • ۲.۴M سابسکرایبر', 'text' => 'بعد از ۲ سال کار با AdyMob، تنها سرویسی هست که هیچ‌وقت ناامیدم نکرده. سریع، دقیق، شفاف.', 'stars' => 5 ],
				[ 'name' => 'سارا محمدی',  'role' => 'توسعه‌دهنده اپ',              'text' => 'برای نقد درآمد AdMob از پلتفرم‌های مختلف استفاده کرده بودم. تجربه AdyMob واقعاً متفاوته.',    'stars' => 5 ],
				[ 'name' => 'علی کریمی',   'role' => 'مدیر آژانس دیجیتال',          'text' => 'برای شارژ گوگل ادز کلاینت‌هامون، نرخ AdyMob رقابتی‌ترین بود و هیچ‌وقت تأخیر نداشتیم.',      'stars' => 5 ],
			],
			'title_field' => '{{{ name }}}',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$items = $s['items'] ?? [];
		$star  = adymob_icon( 'star', 16 );
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
			<div class="adm-testi__grid">
				<?php foreach ( $items as $item ) :
					$stars = intval( $item['stars'] ?? 5 );
					$initial = mb_substr( $item['name'] ?? '؟', 0, 1 );
					?>
					<div class="adm-card">
						<div class="adm-testi__stars">
							<?php for ( $i = 0; $i < $stars; $i++ ) echo $star; ?>
						</div>
						<p class="adm-testi__text">«<?php echo esc_html( $item['text'] ?? '' ); ?>»</p>
						<div class="adm-testi__author">
							<div class="adm-testi__avatar"><?php echo esc_html( $initial ); ?></div>
							<div>
								<div class="adm-testi__name"><?php echo esc_html( $item['name'] ?? '' ); ?></div>
								<div class="adm-testi__role"><?php echo esc_html( $item['role'] ?? '' ); ?></div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}

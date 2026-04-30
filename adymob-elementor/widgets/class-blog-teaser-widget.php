<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Blog_Teaser_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-blog-teaser'; }
	public function get_title()      { return 'AdyMob — تازه‌ترین مقالات'; }
	public function get_icon()       { return 'eicon-posts-grid'; }
	public function get_categories() { return [ 'adymob' ]; }

	protected function register_controls() {

		$this->start_controls_section( 's_header', [ 'label' => 'سر بخش' ] );
		$this->add_control( 'eyebrow',      [ 'label' => 'متن بالا',            'type' => Controls_Manager::TEXT, 'default' => 'وبلاگ' ] );
		$this->add_control( 'heading',      [ 'label' => 'عنوان',               'type' => Controls_Manager::TEXT, 'default' => 'تازه‌ترین مقالات' ] );
		$this->add_control( 'all_btn_text', [ 'label' => 'متن دکمه «مشاهده همه»','type' => Controls_Manager::TEXT, 'default' => 'مشاهده همه' ] );
		$this->add_control( 'all_btn_url',  [ 'label' => 'لینک «مشاهده همه»',   'type' => Controls_Manager::URL,  'default' => [ 'url' => '#blog' ] ] );
		$this->end_controls_section();

		$this->start_controls_section( 's_posts', [ 'label' => 'مقالات' ] );

		$rep = new Repeater();
		$rep->add_control( 'title',   [ 'label' => 'عنوان مقاله', 'type' => Controls_Manager::TEXT,  'default' => 'عنوان مقاله' ] );
		$rep->add_control( 'cat',     [ 'label' => 'دسته',         'type' => Controls_Manager::TEXT,  'default' => 'راهنما' ] );
		$rep->add_control( 'date',    [ 'label' => 'تاریخ',        'type' => Controls_Manager::TEXT,  'default' => '۱۵ فروردین ۱۴۰۴' ] );
		$rep->add_control( 'link',    [ 'label' => 'لینک',         'type' => Controls_Manager::URL,   'default' => [ 'url' => '#' ] ] );
		$rep->add_control( 'color1',  [ 'label' => 'رنگ شروع تصویر','type' => Controls_Manager::COLOR, 'default' => '#FEF3C7' ] );
		$rep->add_control( 'color2',  [ 'label' => 'رنگ پایان تصویر','type' => Controls_Manager::COLOR,'default' => '#FBBF24' ] );

		$this->add_control( 'posts', [
			'label'       => 'مقالات',
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep->get_controls(),
			'default'     => [
				[ 'title' => 'چطور درآمد یوتیوب را به تومان تبدیل کنیم؟',   'cat' => 'راهنما',   'date' => '۱۵ فروردین ۱۴۰۵', 'link' => ['url'=>'#'], 'color1' => '#FEF3C7', 'color2' => '#FBBF24' ],
				[ 'title' => 'تفاوت AdMob و AdSense در درآمدزایی',           'cat' => 'تحلیل',    'date' => '۲ فروردین ۱۴۰۵',  'link' => ['url'=>'#'], 'color1' => '#FDE68A', 'color2' => '#F59E0B' ],
				[ 'title' => '۱۰ نکته برای کاهش هزینه کمپین گوگل ادز',      'cat' => 'تبلیغات',  'date' => '۱۸ اسفند ۱۴۰۴',   'link' => ['url'=>'#'], 'color1' => '#FCD34D', 'color2' => '#D97706' ],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$posts = $s['posts'] ?? [];
		?>
		<div class="adm-widget">
			<div class="adm-blog__header">
				<div>
					<?php if ( $s['eyebrow'] ?? '' ) : ?>
						<div><span class="adm-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span></div>
					<?php endif; ?>
					<?php if ( $s['heading'] ?? '' ) : ?>
						<h2 class="adm-h2" style="margin-top:12px;"><?php echo esc_html( $s['heading'] ); ?></h2>
					<?php endif; ?>
				</div>
				<?php if ( $s['all_btn_text'] ?? '' ) : ?>
					<a href="<?php echo esc_url( $s['all_btn_url']['url'] ?? '#' ); ?>" class="adm-btn adm-btn--outline">
						<?php echo esc_html( $s['all_btn_text'] ); ?>
						<?php echo adymob_icon( 'arrow', 14 ); ?>
					</a>
				<?php endif; ?>
			</div>
			<div class="adm-blog__grid">
				<?php foreach ( $posts as $post ) :
					$c1 = esc_attr( $post['color1'] ?? '#FEF3C7' );
					$c2 = esc_attr( $post['color2'] ?? '#FBBF24' );
					?>
					<article class="adm-card adm-card--hover adm-blog-card">
						<a href="<?php echo esc_url( $post['link']['url'] ?? '#' ); ?>" style="text-decoration:none;color:inherit;display:block;">
							<div class="adm-blog-card__img" style="background:linear-gradient(135deg,<?php echo $c1; ?>,<?php echo $c2; ?>);">
								<span class="adm-blog-card__cat"><?php echo esc_html( $post['cat'] ?? '' ); ?></span>
							</div>
							<div class="adm-blog-card__body">
								<h3 class="adm-h4 adm-blog-card__title"><?php echo esc_html( $post['title'] ?? '' ); ?></h3>
								<div class="adm-blog-card__meta"><?php echo esc_html( $post['date'] ?? '' ); ?></div>
							</div>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}

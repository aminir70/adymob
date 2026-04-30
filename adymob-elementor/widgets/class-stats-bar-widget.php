<?php
namespace AdyMob\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Stats_Bar_Widget extends Widget_Base {

	public function get_name()       { return 'adymob-stats-bar'; }
	public function get_title()      { return 'AdyMob — آمار و دستاوردها'; }
	public function get_icon()       { return 'eicon-counter'; }
	public function get_categories() { return [ 'adymob' ]; }

	protected function register_controls() {

		$this->start_controls_section( 's_stats', [ 'label' => 'آمار' ] );

		$rep = new Repeater();
		$rep->add_control( 'icon', [
			'label'   => 'آیکون',
			'type'    => Controls_Manager::SELECT,
			'default' => 'users',
			'options' => [
				'users'  => 'کاربران',
				'trend'  => 'آمار / نمودار',
				'clock'  => 'ساعت',
				'star'   => 'ستاره',
				'bolt'   => 'صاعقه / سرعت',
				'shield' => 'سپر / امنیت',
				'eye'    => 'چشم / شفافیت',
			],
		] );
		$rep->add_control( 'value', [ 'label' => 'عدد / مقدار', 'type' => Controls_Manager::TEXT, 'default' => '۱۲٬۴۰۰+' ] );
		$rep->add_control( 'label', [ 'label' => 'برچسب',       'type' => Controls_Manager::TEXT, 'default' => 'مشتری فعال' ] );

		$this->add_control( 'stats', [
			'label'       => 'آمارها',
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $rep->get_controls(),
			'default'     => [
				[ 'icon' => 'users',  'value' => '۱۲٬۴۰۰+',     'label' => 'مشتری فعال' ],
				[ 'icon' => 'trend',  'value' => '۸۵۰ میلیارد',  'label' => 'تومان تراکنش' ],
				[ 'icon' => 'clock',  'value' => '۸ سال',         'label' => 'سابقه فعالیت' ],
				[ 'icon' => 'star',   'value' => '۹۸٪',           'label' => 'رضایت مشتریان' ],
			],
			'title_field' => '{{{ label }}}',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$stats = $s['stats'] ?? [];
		?>
		<div class="adm-widget">
		<div class="adm-stats-bar">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="adm-stat">
					<div class="adm-stat__icon">
						<?php echo adymob_icon( $stat['icon'] ?? 'star', 20 ); ?>
					</div>
					<div>
						<div class="adm-stat__value adm-num"><?php echo esc_html( $stat['value'] ); ?></div>
						<div class="adm-stat__label"><?php echo esc_html( $stat['label'] ); ?></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		</div>
		<?php
	}
}

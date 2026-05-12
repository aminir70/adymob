<?php
defined( 'ABSPATH' ) || exit;

class Dastgheib_Landing_Widget extends \Elementor\Widget_Base {

	public function get_name()       { return 'dastgheib_landing'; }
	public function get_title()      { return 'لندینگ پیج دستغیب'; }
	public function get_icon()       { return 'eicon-single-page'; }
	public function get_categories() { return [ 'general' ]; }
	public function get_keywords()   { return [ 'dastgheib', 'landing', 'دستغیب', 'لندینگ' ]; }

	public function get_style_depends()  { return [ 'dgl-style' ]; }
	public function get_script_depends() { return [ 'dgl-script' ]; }

	// =========================================================
	// CONTROLS
	// =========================================================
	protected function register_controls() {

		/* ── CONTENT TAB ─────────────────────────────────────── */

		// ── Header ──────────────────────────────────────────────
		$this->start_controls_section( 'sec_header', [
			'label' => '🔝 هدر',
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		] );
		$this->add_control( 'brand_title', [ 'label' => 'نام برند', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'آیت‌الله دستغیب' ] );
		$this->add_control( 'brand_sub',   [ 'label' => 'زیرعنوان برند', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'DastgheibQoba.info' ] );
		$this->add_control( 'nav_about',   [ 'label' => 'منو: معرفی',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'معرفی' ] );
		$this->add_control( 'nav_features',[ 'label' => 'منو: مزایا',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'مزایا' ] );
		$this->add_control( 'nav_screens', [ 'label' => 'منو: تصاویر',   'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'تصاویر' ] );
		$this->add_control( 'nav_download',[ 'label' => 'منو: دانلود',   'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'دانلود' ] );
		$this->add_control( 'header_cta',  [ 'label' => 'دکمه هدر',      'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'دریافت نرم‌افزار' ] );
		$this->end_controls_section();

		// ── Hero ────────────────────────────────────────────────
		$this->start_controls_section( 'sec_hero', [
			'label' => '🦸 هیرو',
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		] );
		$this->add_control( 'eyebrow_text', [ 'label' => 'نشان بالا', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'نسخه ۲٫۴ هم‌اکنون منتشر شد' ] );
		$this->add_control( 'hero_h2_pre',  [ 'label' => 'عنوان — بخش اول',  'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'همراه معنوی شما،' ] );
		$this->add_control( 'hero_h2_accent',[ 'label' => 'عنوان — بخش رنگی','type' => \Elementor\Controls_Manager::TEXT, 'default' => 'آثار و بیانات' ] );
		$this->add_control( 'hero_h2_post', [ 'label' => 'عنوان — بخش سوم',  'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'آیت‌الله دستغیب' ] );
		$this->add_control( 'hero_lead',    [
			'label'   => 'متن لید',
			'type'    => \Elementor\Controls_Manager::TEXTAREA,
			'default' => 'دسترسی آسان به مجموعه‌ای کامل از کتاب‌ها، تفسیرها، سخنرانی‌ها و بیانات مرحوم آیت‌الله سید علی‌محمد دستغیب — یکجا، آفلاین و در دست شما.',
			'rows'    => 3,
		] );
		$this->add_control( 'btn_ios_label',   [ 'label' => 'دکمه iOS — متن',  'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'iOS — TestFlight' ] );
		$this->add_control( 'btn_ios_link',    [ 'label' => 'دکمه iOS — لینک', 'type' => \Elementor\Controls_Manager::URL,  'default' => [ 'url' => '#download' ] ] );
		$this->add_control( 'btn_android_label',[ 'label' => 'دکمه Android — متن',  'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Android — APK' ] );
		$this->add_control( 'btn_android_link', [ 'label' => 'دکمه Android — لینک', 'type' => \Elementor\Controls_Manager::URL,  'default' => [ 'url' => '#download' ] ] );

		// Hero stats repeater
		$stats_rep = new \Elementor\Repeater();
		$stats_rep->add_control( 'stat_value', [ 'label' => 'عدد', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '+۴۰' ] );
		$stats_rep->add_control( 'stat_label', [ 'label' => 'برچسب', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'عنوان کتاب' ] );
		$this->add_control( 'hero_stats', [
			'label'       => 'آمار',
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $stats_rep->get_controls(),
			'default'     => [
				[ 'stat_value' => '+۴۰',  'stat_label' => 'عنوان کتاب' ],
				[ 'stat_value' => '+۳۰۰', 'stat_label' => 'ساعت سخنرانی' ],
				[ 'stat_value' => '+۲۷۳', 'stat_label' => 'صفحه تفسیر در هر جلد' ],
			],
			'title_field' => '{{{ stat_value }}} {{{ stat_label }}}',
		] );

		// Phone mockup images
		$this->add_control( 'phone_main',  [ 'label' => 'تصویر گوشی اصلی',  'type' => \Elementor\Controls_Manager::MEDIA, 'default' => [ 'url' => DGL_URL . '../../assets/screen-home.jpg' ] ] );
		$this->add_control( 'phone_back',  [ 'label' => 'تصویر گوشی دوم',   'type' => \Elementor\Controls_Manager::MEDIA, 'default' => [ 'url' => DGL_URL . '../../assets/screen-library.jpg' ] ] );
		$this->add_control( 'phone_back2', [ 'label' => 'تصویر گوشی سوم',   'type' => \Elementor\Controls_Manager::MEDIA, 'default' => [ 'url' => DGL_URL . '../../assets/screen-lectures.jpg' ] ] );
		$this->end_controls_section();

		// ── About ────────────────────────────────────────────────
		$this->start_controls_section( 'sec_about', [
			'label' => '📖 معرفی',
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		] );
		$this->add_control( 'about_tag',     [ 'label' => 'برچسب بخش',    'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'معرفی نرم‌افزار' ] );
		$this->add_control( 'about_h3',      [ 'label' => 'عنوان',         'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'میراث علمی و معنوی،' ] );
		$this->add_control( 'about_h3_em',   [ 'label' => 'عنوان — رنگی',  'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'یکجا در دست شما' ] );
		$this->add_control( 'about_para1',   [ 'label' => 'پاراگراف اول',  'type' => \Elementor\Controls_Manager::TEXTAREA, 'rows' => 4,
			'default' => 'این نرم‌افزار با هدف نشر و دسترسی رایگان به آثار و بیانات حضرت آیت‌الله سید علی‌محمد دستغیب شیرازی طراحی شده است. مجموعه‌ای کامل از کتاب‌های تفسیر هادی، رسالهٔ توضیح‌المسائل، مناسک حج، سخنرانی‌های ماه مبارک رمضان و محرم، عکس‌نوشته‌ها، فیلم‌ها و پاسخ به سؤالات شرعی — همگی به‌صورت یکپارچه در یک اپلیکیشن.',
		] );
		$this->add_control( 'about_para2',   [ 'label' => 'پاراگراف دوم',  'type' => \Elementor\Controls_Manager::TEXTAREA, 'rows' => 3,
			'default' => 'تجربه‌ای روان، آفلاین، بدون نیاز به اتصال دائم به اینترنت و کاملاً متناسب با ذائقهٔ کاربر فارسی‌زبان.',
		] );

		// About card rows repeater
		$card_rep = new \Elementor\Repeater();
		$card_rep->add_control( 'card_icon',  [ 'label' => 'آیکون', 'type' => \Elementor\Controls_Manager::ICONS, 'default' => [ 'value' => 'fas fa-book', 'library' => 'fa-solid' ] ] );
		$card_rep->add_control( 'card_title', [ 'label' => 'عنوان', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'ردیف جدید' ] );
		$card_rep->add_control( 'card_desc',  [ 'label' => 'توضیح', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '' ] );
		$this->add_control( 'about_card_items', [
			'label'       => 'ردیف‌های کارت',
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $card_rep->get_controls(),
			'default'     => [
				[ 'card_icon' => [ 'value' => 'fas fa-book',            'library' => 'fa-solid' ], 'card_title' => 'کتابخانه دیجیتال',      'card_desc' => '۴۰ عنوان کتاب با قابلیت دانلود و مطالعه آفلاین' ],
				[ 'card_icon' => [ 'value' => 'fas fa-headphones',       'library' => 'fa-solid' ], 'card_title' => 'پخش زنده و آرشیو صوتی', 'card_desc' => 'دسترسی به سخنرانی‌های رمضان، محرم و تفسیر قرآن' ],
				[ 'card_icon' => [ 'value' => 'fas fa-video',            'library' => 'fa-solid' ], 'card_title' => 'گالری فیلم و عکس‌نوشته','card_desc' => 'محتوای بصری دسته‌بندی‌شده برای هر مناسبت' ],
				[ 'card_icon' => [ 'value' => 'fas fa-question-circle',  'library' => 'fa-solid' ], 'card_title' => 'پرسش و پاسخ شرعی',      'card_desc' => 'ارسال مستقیم سؤالات و دریافت پاسخ معتبر' ],
				[ 'card_icon' => [ 'value' => 'fas fa-calendar-alt',     'library' => 'fa-solid' ], 'card_title' => 'تقویم مناسبت‌ها',       'card_desc' => 'یادآور سخنرانی‌ها و رویدادهای مهم مذهبی' ],
			],
			'title_field' => '{{{ card_title }}}',
		] );
		$this->end_controls_section();

		// ── Features ─────────────────────────────────────────────
		$this->start_controls_section( 'sec_features', [
			'label' => '⭐ مزایا',
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		] );
		$this->add_control( 'feat_tag',  [ 'label' => 'برچسب بخش', 'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'مزایای نرم‌افزار' ] );
		$this->add_control( 'feat_h3',   [ 'label' => 'عنوان',      'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'چرا این اپلیکیشن؟' ] );
		$this->add_control( 'feat_desc', [ 'label' => 'توضیح',      'type' => \Elementor\Controls_Manager::TEXTAREA, 'rows' => 2,
			'default' => 'ویژگی‌هایی که تجربهٔ مطالعه و استفاده از محتوای دینی را برای شما ساده، سریع و دلپذیر می‌سازد.',
		] );

		$feat_rep = new \Elementor\Repeater();
		$feat_rep->add_control( 'feat_icon',  [ 'label' => 'آیکون', 'type' => \Elementor\Controls_Manager::ICONS, 'default' => [ 'value' => 'fas fa-star', 'library' => 'fa-solid' ] ] );
		$feat_rep->add_control( 'feat_title', [ 'label' => 'عنوان', 'type' => \Elementor\Controls_Manager::TEXT,  'default' => 'ویژگی' ] );
		$feat_rep->add_control( 'feat_text',  [ 'label' => 'توضیح', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'rows' => 2, 'default' => '' ] );
		$this->add_control( 'feat_items', [
			'label'       => 'کارت‌های مزایا',
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $feat_rep->get_controls(),
			'default'     => [
				[ 'feat_icon' => [ 'value' => 'fas fa-moon',       'library' => 'fa-solid' ], 'feat_title' => 'کاملاً آفلاین',             'feat_text' => 'پس از دانلود، کتاب‌ها و محتوای صوتی بدون نیاز به اینترنت همیشه در دسترس‌اند.' ],
				[ 'feat_icon' => [ 'value' => 'fas fa-book-open',   'library' => 'fa-solid' ], 'feat_title' => 'کتابخانهٔ غنی',             'feat_text' => 'تفسیر هادی، رسالهٔ توضیح‌المسائل، مناسک حج، احکام بانوان و ده‌ها عنوان دیگر.' ],
				[ 'feat_icon' => [ 'value' => 'fas fa-play-circle', 'library' => 'fa-solid' ], 'feat_title' => 'پخش صوت و ویدئو',           'feat_text' => 'صدها ساعت سخنرانی با کیفیت‌های متنوع، قابل دانلود و پخش پیوسته.' ],
				[ 'feat_icon' => [ 'value' => 'fas fa-search',      'library' => 'fa-solid' ], 'feat_title' => 'جستجوی پیشرفته',            'feat_text' => 'جستجو در متن کتاب‌ها و آرشیو سخنرانی‌ها برای رسیدن سریع به مطلب موردنظر.' ],
				[ 'feat_icon' => [ 'value' => 'fas fa-heart',       'library' => 'fa-solid' ], 'feat_title' => 'نشانه‌گذاری و علاقه‌مندی', 'feat_text' => 'نشانه‌گذاری صفحات، علامت‌گذاری محتوای محبوب و ادامهٔ مطالعه از همان نقطه.' ],
				[ 'feat_icon' => [ 'value' => 'fas fa-headset',     'library' => 'fa-solid' ], 'feat_title' => 'پشتیبانی و پاسخ‌گویی',     'feat_text' => 'کانال مستقیم برای ارتباط با ما، طرح پرسش‌های شرعی و دریافت پاسخ معتبر.' ],
			],
			'title_field' => '{{{ feat_title }}}',
		] );
		$this->end_controls_section();

		// ── Screenshots ──────────────────────────────────────────
		$this->start_controls_section( 'sec_shots', [
			'label' => '📱 تصاویر',
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		] );
		$this->add_control( 'shots_tag',      [ 'label' => 'برچسب بخش',  'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'تصاویر نرم‌افزار' ] );
		$this->add_control( 'shots_h3',       [ 'label' => 'عنوان',       'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'نگاهی به محیط برنامه' ] );
		$this->add_control( 'shots_desc',     [ 'label' => 'توضیح',       'type' => \Elementor\Controls_Manager::TEXTAREA, 'rows' => 2,
			'default' => 'طراحی ساده، فارسی و الهام‌گرفته از هنر ایرانی‌اسلامی — هر بخش با ذوق و دقت چیده شده است.',
		] );
		$this->add_control( 'shots_autoplay', [ 'label' => 'فاصله چرخش خودکار (ms)', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 5500, 'min' => 1000, 'max' => 20000, 'step' => 500 ] );

		$shot_rep = new \Elementor\Repeater();
		$shot_rep->add_control( 'shot_image',  [ 'label' => 'تصویر',    'type' => \Elementor\Controls_Manager::MEDIA ] );
		$shot_rep->add_control( 'shot_tab',    [ 'label' => 'تب',        'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'صفحه' ] );
		$shot_rep->add_control( 'shot_title',  [ 'label' => 'عنوان',     'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'عنوان صفحه' ] );
		$shot_rep->add_control( 'shot_desc',   [ 'label' => 'توضیح',     'type' => \Elementor\Controls_Manager::TEXTAREA, 'rows' => 2, 'default' => '' ] );
		$shot_rep->add_control( 'shot_list_1', [ 'label' => 'آیتم ۱',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => '' ] );
		$shot_rep->add_control( 'shot_list_2', [ 'label' => 'آیتم ۲',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => '' ] );
		$shot_rep->add_control( 'shot_list_3', [ 'label' => 'آیتم ۳',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => '' ] );
		$this->add_control( 'shots_items', [
			'label'       => 'اسکرین‌شات‌ها',
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $shot_rep->get_controls(),
			'default'     => [
				[ 'shot_tab' => 'خانه',       'shot_title' => 'صفحهٔ خانه',       'shot_desc' => 'دسترسی سریع به همهٔ بخش‌های اصلی نرم‌افزار از یک صفحه.',         'shot_list_1' => 'اسلایدر بیانات روز',           'shot_list_2' => 'دسترسی به ۸ بخش اصلی',       'shot_list_3' => 'ادامهٔ مطالعهٔ آخرین کتاب' ],
				[ 'shot_tab' => 'کتابخانه',   'shot_title' => 'کتابخانهٔ دیجیتال','shot_desc' => '۴۰ عنوان کتاب از تفسیر هادی تا رسالهٔ توضیح‌المسائل.',             'shot_list_1' => 'دانلود کتاب برای مطالعهٔ آفلاین','shot_list_2' => 'نمایش پیشرفت مطالعه',          'shot_list_3' => 'دسته‌بندی موضوعی' ],
				[ 'shot_tab' => 'خوانندهٔ متن','shot_title' => 'خوانندهٔ متن',    'shot_desc' => 'تجربهٔ مطالعهٔ روان فارسی با کنترل کامل بر اندازهٔ متن.',           'shot_list_1' => 'نوار پیشرفت ۲۷۳ صفحه‌ای',      'shot_list_2' => 'تنظیم فونت و فاصلهٔ خطوط',    'shot_list_3' => 'جستجو در متن کتاب' ],
				[ 'shot_tab' => 'ویدئو',       'shot_title' => 'آرشیو ویدئو',      'shot_desc' => 'دسترسی به سخنرانی‌های تصویری در دسته‌بندی‌های متنوع.',              'shot_list_1' => 'سخنرانی‌های رمضان و محرم',       'shot_list_2' => 'تفسیر قرآن تصویری',           'shot_list_3' => 'کلیپ‌ها و ویدئوهای کوتاه' ],
				[ 'shot_tab' => 'صوت',         'shot_title' => 'آرشیو صوت',        'shot_desc' => 'ساعت‌ها سخنرانی صوتی برای گوش‌دادن در هر زمان.',                   'shot_list_1' => 'پخش پیوسته و دانلود',           'shot_list_2' => 'گزیدهٔ سخنرانی‌های منتخب',    'shot_list_3' => 'کنترل سرعت پخش' ],
				[ 'shot_tab' => 'عکس‌نوشته',  'shot_title' => 'گالری عکس‌نوشته',  'shot_desc' => 'عکس‌نوشته‌های موضوعی برای اشتراک‌گذاری.',                          'shot_list_1' => 'مجموعه‌های ماه محرم',            'shot_list_2' => 'قابلیت ذخیره در گوشی',         'shot_list_3' => 'علاقه‌مندی و نشانه‌گذاری' ],
				[ 'shot_tab' => 'سخنرانی‌ها', 'shot_title' => 'سخنرانی‌ها',       'shot_desc' => 'دسته‌بندی هوشمند سخنرانی‌ها بر اساس مناسبت.',                      'shot_list_1' => 'رمضان المبارک',                  'shot_list_2' => 'محرم الحرام',                  'shot_list_3' => 'تفسیر قرآن و مناسبت‌ها' ],
				[ 'shot_tab' => 'پرسش و پاسخ','shot_title' => 'پرسش و پاسخ شرعی', 'shot_desc' => 'ارسال پرسش‌های شرعی و دریافت پاسخ معتبر.',                         'shot_list_1' => 'ثبت‌نام آسان و کاربرپسند',       'shot_list_2' => 'تاریخچهٔ پرسش‌های شما',        'shot_list_3' => 'پاسخ مستقیم از دفتر' ],
			],
			'title_field' => '{{{ shot_tab }}}',
		] );
		$this->end_controls_section();

		// ── Download ─────────────────────────────────────────────
		$this->start_controls_section( 'sec_download', [
			'label' => '⬇️ دانلود',
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		] );
		$this->add_control( 'dl_tag',          [ 'label' => 'برچسب بخش',         'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'دانلود نرم‌افزار' ] );
		$this->add_control( 'dl_h3_pre',       [ 'label' => 'عنوان — بخش اول',   'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'همین حالا' ] );
		$this->add_control( 'dl_h3_accent',    [ 'label' => 'عنوان — رنگی',       'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'دانلود کنید' ] );
		$this->add_control( 'dl_h3_post',      [ 'label' => 'عنوان — بخش سوم',   'type' => \Elementor\Controls_Manager::TEXT,     'default' => 'و سفر معنوی خود را آغاز کنید.' ] );
		$this->add_control( 'dl_desc',         [ 'label' => 'توضیح',              'type' => \Elementor\Controls_Manager::TEXTAREA, 'rows' => 2,
			'default' => 'برای دستگاه‌های اندروید، آی‌اواس و همچنین نسخهٔ تحت وب (PWA) در دسترس است. کاملاً رایگان و بدون تبلیغات.',
		] );
		$this->add_control( 'dl_ios_text',     [ 'label' => 'iOS — متن',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'iOS / iPhone' ] );
		$this->add_control( 'dl_ios_url',      [ 'label' => 'iOS — لینک',   'type' => \Elementor\Controls_Manager::URL,  'default' => [ 'url' => '#' ] ] );
		$this->add_control( 'dl_android_text', [ 'label' => 'Android — متن','type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Android' ] );
		$this->add_control( 'dl_android_url',  [ 'label' => 'Android — لینک','type' => \Elementor\Controls_Manager::URL, 'default' => [ 'url' => '#' ] ] );
		$this->add_control( 'dl_pwa_text',     [ 'label' => 'PWA — متن',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'PWA — نسخهٔ وب' ] );
		$this->add_control( 'dl_pwa_url',      [ 'label' => 'PWA — لینک',   'type' => \Elementor\Controls_Manager::URL,  'default' => [ 'url' => '#' ] ] );
		$this->add_control( 'dl_size_note',    [ 'label' => 'نکته حجم',      'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'حجم تقریبی: ۳۸ مگابایت — حداقل اندروید ۶ / iOS 13' ] );
		$this->add_control( 'qr_title',        [ 'label' => 'QR — عنوان',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'اسکن برای دانلود' ] );
		$this->add_control( 'qr_desc',         [ 'label' => 'QR — توضیح',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'با دوربین گوشی خود کد را اسکن کنید تا به صفحهٔ نصب هدایت شوید.' ] );
		$this->add_control( 'qr_seed',         [ 'label' => 'QR — رشته ژنراتور','type' => \Elementor\Controls_Manager::TEXT, 'default' => 'DastgheibQoba.info-app' ] );
		$this->end_controls_section();

		// ── Footer ───────────────────────────────────────────────
		$this->start_controls_section( 'sec_footer', [
			'label' => '🔻 فوتر',
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		] );
		$this->add_control( 'footer_desc',       [ 'label' => 'توضیح برند', 'type' => \Elementor\Controls_Manager::TEXTAREA, 'rows' => 3,
			'default' => 'پایگاه نشر آثار و بیانات حضرت آیت‌الله سید علی‌محمد دستغیب شیرازی، با هدف ترویج معارف ناب اسلامی و قرآنی.',
		] );
		$this->add_control( 'footer_telegram',   [ 'label' => 'تلگرام',   'type' => \Elementor\Controls_Manager::URL, 'default' => [ 'url' => '#' ] ] );
		$this->add_control( 'footer_instagram',  [ 'label' => 'اینستاگرام','type' => \Elementor\Controls_Manager::URL, 'default' => [ 'url' => '#' ] ] );
		$this->add_control( 'footer_youtube',    [ 'label' => 'یوتیوب',   'type' => \Elementor\Controls_Manager::URL, 'default' => [ 'url' => '#' ] ] );
		$this->add_control( 'footer_email',      [ 'label' => 'ایمیل',    'type' => \Elementor\Controls_Manager::TEXT, 'default' => '#' ] );
		$this->add_control( 'footer_copyright',  [ 'label' => 'کپی‌رایت', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '© ۱۴۰۵ — کلیه حقوق متعلق به دفتر نشر آثار آیت‌الله دستغیب می‌باشد.' ] );
		$this->add_control( 'footer_tagline',    [ 'label' => 'تگ‌لاین',  'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'طراحی شده با احترام و دقت ✦' ] );

		// Footer columns (3 repeaters)
		foreach ( [ ['col1','بخش‌های نرم‌افزار'], ['col2','دسترسی سریع'], ['col3','تماس و پشتیبانی'] ] as [$key, $def_title] ) {
			$this->add_control( "footer_{$key}_title", [ 'label' => "ستون: عنوان", 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $def_title ] );
			$col_rep = new \Elementor\Repeater();
			$col_rep->add_control( 'link_label', [ 'label' => 'عنوان لینک', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'لینک' ] );
			$col_rep->add_control( 'link_url',   [ 'label' => 'آدرس',       'type' => \Elementor\Controls_Manager::URL,  'default' => [ 'url' => '#' ] ] );
			$defaults_map = [
				'col1' => [ ['link_label'=>'کتابخانه','link_url'=>['url'=>'#']], ['link_label'=>'سخنرانی‌ها','link_url'=>['url'=>'#']], ['link_label'=>'رسانه','link_url'=>['url'=>'#']], ['link_label'=>'پرسش و پاسخ','link_url'=>['url'=>'#']], ['link_label'=>'تقویم مناسبت‌ها','link_url'=>['url'=>'#']] ],
				'col2' => [ ['link_label'=>'معرفی','link_url'=>['url'=>'#about']], ['link_label'=>'مزایا','link_url'=>['url'=>'#features']], ['link_label'=>'تصاویر','link_url'=>['url'=>'#screens']], ['link_label'=>'دانلود','link_url'=>['url'=>'#download']] ],
				'col3' => [ ['link_label'=>'ارتباط با ما','link_url'=>['url'=>'#']], ['link_label'=>'مسجد قبا','link_url'=>['url'=>'#']], ['link_label'=>'حمایت مالی','link_url'=>['url'=>'#']], ['link_label'=>'گزارش خطا','link_url'=>['url'=>'#']] ],
			];
			$this->add_control( "footer_{$key}_links", [
				'label'       => 'لینک‌ها',
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $col_rep->get_controls(),
				'default'     => $defaults_map[ $key ],
				'title_field' => '{{{ link_label }}}',
			] );
		}
		$this->end_controls_section();

		/* ── STYLE TAB ────────────────────────────────────────── */

		// ── Colors ───────────────────────────────────────────────
		$this->start_controls_section( 'sec_colors', [
			'label' => '🎨 رنگ‌ها',
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		] );
		$colors = [
			[ 'color_primary',  'رنگ اصلی (سبز)',        '#1CA088' ],
			[ 'color_primary2', 'رنگ اصلی تیره',          '#138875' ],
			[ 'color_navy',     'سرمه‌ای',                '#0E1A4C' ],
			[ 'color_cream',    'کرم',                     '#F7F1E4' ],
			[ 'color_bg',       'پس‌زمینه صفحه',          '#FBF8F1' ],
			[ 'color_ink',      'متن اصلی (تیره)',         '#0F1419' ],
			[ 'color_ink2',     'متن ثانوی',               '#2A2F3A' ],
			[ 'color_muted',    'متن کم‌رنگ',              '#6B7280' ],
			[ 'color_line',     'خط جداکننده',             '#E7E2D4' ],
			[ 'color_gold',     'طلایی',                   '#B89557' ],
		];
		foreach ( $colors as [$id, $label, $default] ) {
			$this->add_control( $id, [ 'label' => $label, 'type' => \Elementor\Controls_Manager::COLOR, 'default' => $default ] );
		}
		$this->end_controls_section();

		// ── Typography ───────────────────────────────────────────
		$this->start_controls_section( 'sec_typo', [
			'label' => '🔤 تایپوگرافی',
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		] );
		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'typo_heading',
			'label'    => 'فونت عنوان‌ها',
			'selector' => '{{WRAPPER}} .dgl-hero-h2, {{WRAPPER}} .dgl-section-h3, {{WRAPPER}} .dgl-intro-h3, {{WRAPPER}} .dgl-dl-h3',
		] );
		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'typo_body',
			'label'    => 'فونت متن بدنه',
			'selector' => '{{WRAPPER}} p, {{WRAPPER}} li, {{WRAPPER}} .dgl-feat-text, {{WRAPPER}} .dgl-card-desc',
		] );
		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'typo_lead',
			'label'    => 'فونت متن لید',
			'selector' => '{{WRAPPER}} .dgl-hero-lead',
		] );
		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
			'name'     => 'typo_btn',
			'label'    => 'فونت دکمه‌ها',
			'selector' => '{{WRAPPER}} .dgl-btn, {{WRAPPER}} .dgl-dl-btn, {{WRAPPER}} .dgl-cta-mini',
		] );
		$this->end_controls_section();
	}

	// =========================================================
	// RENDER
	// =========================================================
	protected function render() {
		$s  = $this->get_settings_for_display();
		$id = 'dgl-' . $this->get_id();

		// Build CSS custom properties from style controls
		$css_vars = [
			'--primary'      => $s['color_primary']  ?: '#1CA088',
			'--primary-2'    => $s['color_primary2'] ?: '#138875',
			'--primary-soft' => $this->hex_to_rgba( $s['color_primary'] ?: '#1CA088', 0.12 ),
			'--navy'         => $s['color_navy']     ?: '#0E1A4C',
			'--navy-2'       => '#162160',
			'--cream'        => $s['color_cream']    ?: '#F7F1E4',
			'--cream-2'      => '#EFE6D2',
			'--ink'          => $s['color_ink']      ?: '#0F1419',
			'--ink-2'        => $s['color_ink2']     ?: '#2A2F3A',
			'--muted'        => $s['color_muted']    ?: '#6B7280',
			'--line'         => $s['color_line']     ?: '#E7E2D4',
			'--gold'         => $s['color_gold']     ?: '#B89557',
			'--bg'           => $s['color_bg']       ?: '#FBF8F1',
			'--red'          => '#C9483A',
		];
		$css_str = implode( ';', array_map( fn($k,$v) => "$k:$v", array_keys($css_vars), $css_vars ) );

		// Build shots JSON for JS
		$shots_data = [];
		foreach ( $s['shots_items'] as $item ) {
			$list = array_filter( [ $item['shot_list_1'], $item['shot_list_2'], $item['shot_list_3'] ] );
			$shots_data[] = [
				'src'   => esc_url( $item['shot_image']['url'] ?? '' ),
				'tab'   => esc_html( $item['shot_tab'] ),
				'title' => esc_html( $item['shot_title'] ),
				'desc'  => esc_html( $item['shot_desc'] ),
				'list'  => array_values( array_map( 'esc_html', $list ) ),
			];
		}
		?>
		<div class="dastgheib-landing" id="<?php echo esc_attr( $id ); ?>" style="<?php echo esc_attr( $css_str ); ?>">

		<!-- ============= HEADER ============= -->
		<header class="dgl-header">
			<div class="dgl-nav">
				<div class="dgl-brand">
					<div class="dgl-brand-mark" aria-hidden="true"><?php echo $this->mosque_icon(); ?></div>
					<div class="dgl-brand-text">
						<h1><?php echo esc_html( $s['brand_title'] ); ?></h1>
						<p><?php echo esc_html( $s['brand_sub'] ); ?></p>
					</div>
				</div>
				<nav class="dgl-links">
					<a href="#dgl-about-<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $s['nav_about'] ); ?></a>
					<a href="#dgl-features-<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $s['nav_features'] ); ?></a>
					<a href="#dgl-screens-<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $s['nav_screens'] ); ?></a>
					<a href="#dgl-download-<?php echo esc_attr( $this->get_id() ); ?>"><?php echo esc_html( $s['nav_download'] ); ?></a>
				</nav>
				<a href="#dgl-download-<?php echo esc_attr( $this->get_id() ); ?>" class="dgl-cta-mini">
					<?php echo esc_html( $s['header_cta'] ); ?>
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12"/><path d="m6 9 6 6 6-6"/><path d="M5 21h14"/></svg>
				</a>
			</div>
		</header>

		<!-- ============= HERO ============= -->
		<section class="dgl-hero">
			<div class="dgl-hero-blob"></div>
			<div class="dgl-hero-blob dgl-b2"></div>
			<div class="dgl-hero-inner">
				<div>
					<div class="dgl-eyebrow"><span class="dgl-dot"></span> <?php echo esc_html( $s['eyebrow_text'] ); ?></div>
					<h2 class="dgl-hero-h2">
						<?php echo esc_html( $s['hero_h2_pre'] ); ?><br/>
						با <span class="dgl-accent"><?php echo esc_html( $s['hero_h2_accent'] ); ?></span><br/>
						<?php echo esc_html( $s['hero_h2_post'] ); ?>
					</h2>
					<p class="dgl-hero-lead"><?php echo esc_html( $s['hero_lead'] ); ?></p>
					<div class="dgl-hero-cta">
						<a class="dgl-btn dgl-btn-primary" href="<?php echo esc_url( $s['btn_ios_link']['url'] ?? '#' ); ?>">
							<?php echo $this->apple_icon(); ?>
							<div class="dgl-btn-text"><small>دانلود برای</small><b><?php echo esc_html( $s['btn_ios_label'] ); ?></b></div>
						</a>
						<a class="dgl-btn dgl-btn-ghost" href="<?php echo esc_url( $s['btn_android_link']['url'] ?? '#' ); ?>">
							<?php echo $this->android_icon(); ?>
							<div class="dgl-btn-text"><small>دانلود برای</small><b><?php echo esc_html( $s['btn_android_label'] ); ?></b></div>
						</a>
					</div>
					<?php if ( ! empty( $s['hero_stats'] ) ) : ?>
					<div class="dgl-hero-stats">
						<?php foreach ( $s['hero_stats'] as $stat ) : ?>
						<div class="dgl-stat">
							<b><?php echo esc_html( $stat['stat_value'] ); ?></b>
							<span><?php echo esc_html( $stat['stat_label'] ); ?></span>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="dgl-phone-stack">
					<div class="dgl-phone dgl-phone-back2"><div class="dgl-screen"><img src="<?php echo esc_url( $s['phone_back2']['url'] ?? '' ); ?>" alt="" loading="lazy"/></div></div>
					<div class="dgl-phone dgl-phone-back"><div class="dgl-screen"><img src="<?php echo esc_url( $s['phone_back']['url'] ?? '' ); ?>" alt="" loading="lazy"/></div></div>
					<div class="dgl-phone dgl-phone-main"><div class="dgl-screen"><img src="<?php echo esc_url( $s['phone_main']['url'] ?? '' ); ?>" alt="صفحهٔ خانه نرم‌افزار"/></div></div>
				</div>
			</div>
		</section>

		<!-- ============= ABOUT ============= -->
		<section id="dgl-about-<?php echo esc_attr( $this->get_id() ); ?>" class="dgl-intro dgl-section-pad">
			<div class="dgl-wrap dgl-intro-grid">
				<div class="dgl-intro-text">
					<span class="dgl-section-tag"><?php echo esc_html( $s['about_tag'] ); ?></span>
					<h3 class="dgl-intro-h3"><?php echo esc_html( $s['about_h3'] ); ?> <em><?php echo esc_html( $s['about_h3_em'] ); ?></em></h3>
					<?php if ( $s['about_para1'] ) : ?><p><?php echo esc_html( $s['about_para1'] ); ?></p><?php endif; ?>
					<?php if ( $s['about_para2'] ) : ?><p><?php echo esc_html( $s['about_para2'] ); ?></p><?php endif; ?>
				</div>
				<div class="dgl-intro-visual">
					<div class="dgl-intro-card">
						<?php foreach ( $s['about_card_items'] as $item ) : ?>
						<div class="dgl-row">
							<div class="dgl-ic"><?php \Elementor\Icons_Manager::render_icon( $item['card_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
							<div class="dgl-ic-info">
								<b><?php echo esc_html( $item['card_title'] ); ?></b>
								<span><?php echo esc_html( $item['card_desc'] ); ?></span>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>

		<!-- ============= FEATURES ============= -->
		<section id="dgl-features-<?php echo esc_attr( $this->get_id() ); ?>" class="dgl-features">
			<div class="dgl-wrap">
				<div class="dgl-section-head">
					<span class="dgl-section-tag"><?php echo esc_html( $s['feat_tag'] ); ?></span>
					<h3 class="dgl-section-h3"><?php echo esc_html( $s['feat_h3'] ); ?></h3>
					<p><?php echo esc_html( $s['feat_desc'] ); ?></p>
				</div>
				<div class="dgl-feat-grid">
					<?php foreach ( $s['feat_items'] as $item ) : ?>
					<div class="dgl-feat">
						<div class="dgl-feat-icon"><?php \Elementor\Icons_Manager::render_icon( $item['feat_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
						<h4><?php echo esc_html( $item['feat_title'] ); ?></h4>
						<p class="dgl-feat-text"><?php echo esc_html( $item['feat_text'] ); ?></p>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ============= SCREENSHOTS ============= -->
		<section id="dgl-screens-<?php echo esc_attr( $this->get_id() ); ?>" class="dgl-shots"
			data-shots="<?php echo esc_attr( wp_json_encode( $shots_data ) ); ?>"
			data-autoplay="<?php echo esc_attr( absint( $s['shots_autoplay'] ) ?: 5500 ); ?>">
			<div class="dgl-decor" aria-hidden="true">۞</div>
			<div class="dgl-wrap">
				<div class="dgl-section-head">
					<span class="dgl-section-tag"><?php echo esc_html( $s['shots_tag'] ); ?></span>
					<h3 class="dgl-section-h3"><?php echo esc_html( $s['shots_h3'] ); ?></h3>
					<p><?php echo esc_html( $s['shots_desc'] ); ?></p>
				</div>
				<div class="dgl-shot-tabs"></div>
				<div class="dgl-shot-stage">
					<div class="dgl-shot-info"></div>
					<div class="dgl-shot-frames"></div>
				</div>
				<div class="dgl-shot-nav">
					<button class="dgl-prev-btn" aria-label="قبلی">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
					</button>
					<div class="dgl-shot-dots"></div>
					<button class="dgl-next-btn" aria-label="بعدی">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
					</button>
				</div>
			</div>
		</section>

		<!-- ============= DOWNLOAD ============= -->
		<section id="dgl-download-<?php echo esc_attr( $this->get_id() ); ?>" class="dgl-download">
			<div class="dgl-dl-card">
				<div class="dgl-dl-pattern"></div>
				<div class="dgl-dl-grid">
					<div class="dgl-dl-content">
						<span class="dgl-section-tag dgl-tag-light"><?php echo esc_html( $s['dl_tag'] ); ?></span>
						<h3 class="dgl-dl-h3" style="margin-top:14px">
							<?php echo esc_html( $s['dl_h3_pre'] ); ?> <span><?php echo esc_html( $s['dl_h3_accent'] ); ?></span><br/>
							<?php echo esc_html( $s['dl_h3_post'] ); ?>
						</h3>
						<p><?php echo esc_html( $s['dl_desc'] ); ?></p>
						<div class="dgl-dl-buttons">
							<a href="<?php echo esc_url( $s['dl_ios_url']['url'] ?? '#' ); ?>" class="dgl-dl-btn">
								<?php echo $this->apple_icon( 30 ); ?>
								<div><small>دانلود برای</small><b><?php echo esc_html( $s['dl_ios_text'] ); ?></b></div>
							</a>
							<a href="<?php echo esc_url( $s['dl_android_url']['url'] ?? '#' ); ?>" class="dgl-dl-btn">
								<?php echo $this->android_icon( 30 ); ?>
								<div><small>دانلود فایل APK</small><b><?php echo esc_html( $s['dl_android_text'] ); ?></b></div>
							</a>
							<a href="<?php echo esc_url( $s['dl_pwa_url']['url'] ?? '#' ); ?>" class="dgl-dl-btn dgl-dl-btn-pwa">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="30" height="30"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
								<div><small>نصب در مرورگر</small><b><?php echo esc_html( $s['dl_pwa_text'] ); ?></b></div>
							</a>
						</div>
						<?php if ( $s['dl_size_note'] ) : ?>
						<p style="margin-top:24px;font-size:13px;opacity:.55"><?php echo esc_html( $s['dl_size_note'] ); ?></p>
						<?php endif; ?>
					</div>
					<div class="dgl-qr-card">
						<div class="dgl-qr">
							<div class="dgl-qr-grid" data-seed="<?php echo esc_attr( $s['qr_seed'] ); ?>"></div>
							<div class="dgl-qr-logo"><div>د</div></div>
						</div>
						<b><?php echo esc_html( $s['qr_title'] ); ?></b>
						<span class="dgl-qr-sub"><?php echo esc_html( $s['qr_desc'] ); ?></span>
					</div>
				</div>
			</div>
		</section>

		<!-- ============= FOOTER ============= -->
		<footer class="dgl-footer">
			<div class="dgl-footer-pattern"></div>
			<div class="dgl-foot-grid">
				<div class="dgl-foot-brand">
					<div class="dgl-brand">
						<div class="dgl-brand-mark"><?php echo $this->mosque_icon(); ?></div>
						<div class="dgl-brand-text"><h1><?php echo esc_html( $s['brand_title'] ); ?></h1><p><?php echo esc_html( $s['brand_sub'] ); ?></p></div>
					</div>
					<p><?php echo esc_html( $s['footer_desc'] ); ?></p>
					<div class="dgl-socials">
						<a href="<?php echo esc_url( $s['footer_telegram']['url'] ?? '#' ); ?>" aria-label="Telegram"><?php echo $this->telegram_icon(); ?></a>
						<a href="<?php echo esc_url( $s['footer_instagram']['url'] ?? '#' ); ?>" aria-label="Instagram"><?php echo $this->instagram_icon(); ?></a>
						<a href="<?php echo esc_url( $s['footer_youtube']['url'] ?? '#' ); ?>" aria-label="YouTube"><?php echo $this->youtube_icon(); ?></a>
						<a href="mailto:<?php echo esc_attr( $s['footer_email'] ); ?>" aria-label="Email"><?php echo $this->email_icon(); ?></a>
					</div>
				</div>
				<?php foreach ( [ 'col1', 'col2', 'col3' ] as $col ) : ?>
				<div class="dgl-foot-col">
					<h5><?php echo esc_html( $s[ "footer_{$col}_title" ] ); ?></h5>
					<ul>
						<?php foreach ( $s[ "footer_{$col}_links" ] as $link ) : ?>
						<li><a href="<?php echo esc_url( $link['link_url']['url'] ?? '#' ); ?>"><?php echo esc_html( $link['link_label'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="dgl-foot-bottom">
				<span><?php echo esc_html( $s['footer_copyright'] ); ?></span>
				<span><?php echo esc_html( $s['footer_tagline'] ); ?></span>
			</div>
		</footer>

		</div><!-- .dastgheib-landing -->
		<?php
	}

	// =========================================================
	// HELPERS
	// =========================================================
	private function hex_to_rgba( string $hex, float $alpha ): string {
		$hex = ltrim( $hex, '#' );
		if ( strlen( $hex ) === 3 ) $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
		[ $r, $g, $b ] = array_map( 'hexdec', str_split( $hex, 2 ) );
		return "rgba($r,$g,$b,$alpha)";
	}

	private function mosque_icon(): string {
		return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2c1.2 1.5 1.2 3 0 4.5"/><path d="M4 21V11c0-3 3.5-5 8-5s8 2 8 5v10"/><path d="M4 21h16"/><path d="M10 21v-5a2 2 0 0 1 4 0v5"/><path d="M7 14v4M17 14v4"/></svg>';
	}

	private function apple_icon( int $size = 22 ): string {
		return '<svg viewBox="0 0 384 512" fill="currentColor" width="'.$size.'" height="'.$size.'"><path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zM248.1 122.6c20.6-24.4 19.7-46.7 19.4-54.7-19.5 1.1-42.1 13.2-55 28.3-14.2 16.2-22.5 36.2-20.7 56.2 21 1.6 40.2-9.2 56.3-29.8z"/></svg>';
	}

	private function android_icon( int $size = 22 ): string {
		return '<svg viewBox="0 0 576 512" fill="currentColor" width="'.$size.'" height="'.$size.'"><path d="M420.6 301.9a24 24 0 1 1 24-24 24 24 0 0 1-24 24m-265.1 0a24 24 0 1 1 24-24 24 24 0 0 1-24 24m273.7-144.5 47.9-83a10 10 0 1 0-17.3-10l-48.5 84.1a301.2 301.2 0 0 0-246.6 0L116.2 64.5a10 10 0 1 0-17.3 10l47.9 83C64.5 202.6 8.2 285.5 0 384h576c-8.2-98.5-64.5-181.4-146.8-226.6"/></svg>';
	}

	private function telegram_icon(): string  { return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"><path d="M22 3 2 10l6 2 2 7 4-5 6 5 2-16z"/></svg>'; }
	private function instagram_icon(): string { return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".8" fill="currentColor"/></svg>'; }
	private function youtube_icon(): string   { return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="4"/><polygon points="10 9 15 12 10 15 10 9" fill="currentColor"/></svg>'; }
	private function email_icon(): string     { return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22 6 12 13 2 6"/></svg>'; }
}

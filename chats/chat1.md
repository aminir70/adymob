# طراحی ADYMOB - پلتفرم اعتماد درآمد

_Started 2026-04-30 05:59 UTC_

---

## User

یه سایت دارم به اسم ادی موب ADYMOB
کارش نقد کردن درامد لاری هست و این بخش ها رو داره
نقد درآمد AdMob
نقد درآمد YouTube
نقد درآمد AdSense
شارژ Google Ads
مدیریت کمپین Google Ads
حواله ارزی
پرداخت بین‌المللی

آدرس سایت اینه

https://adymob.com/

میخام طراحی یه حس اعتماد به مشتری بده 
لحن باید مستقیم، کاربردی و اطمینان‌بخش باشد:

یعنی پیام اصلی سایت باید این باشد:

«درآمد ارزی، تبلیغات گوگل و پرداخت‌های بین‌المللی شما را امن، سریع و شفاف مدیریت می‌کنیم.»

ماشین حساب درامد یوتیوب و هزینه گوگل ادز داشته باشه مثل خود سایت
تمام ۵ صفحه اصلی (نقد درآمد AdMob
نقد درآمد YouTube
نقد درآمد AdSense
شارژ Google Ads
مدیریت کمپین Google Ads)+ صفحه درباره ما و تماس با ما و وبلاگ  طراحی بشه

رقبا هم اینا هستن
افراک
ایرانی کارت
یوبر

## Assistant

سلام! قبل از شروع طراحی، چند سوال مهم دارم تا بتونم بهترین طراحی رو برات بسازم.

_[tool: questions_v2]_

## User

Questions answered:
- logo_file: uploads/logo_file-1777529169018.png
- design_context: بله، لوگو و رنگ برند دارم (بعد از این فرم آپلود می‌کنم)
- visual_style: گرم و دوستانه (مثل ایرانی‌کارت)
- color_direction: نارنجی رنگ لوگو
- typography: ایران‌سنس / IranSans
- pages_priority: همه به یک اندازه
- calculators: ماشین‌حساب YouTube: تعداد ویو + کشور → درآمد دلاری و تومانی, ماشین‌حساب Google Ads: بودجه تومانی → اعتبار دلاری Google Ads, ماشین‌حساب YouTube: درآمد دلاری → مبلغ نهایی تومانی بعد کارمزد, ماشین‌حساب AdMob: تعداد ایمپرشن → درآمد و نقدی
- trust_elements: آمار: تعداد مشتری، حجم تراکنش، سال فعالیت, گواهی‌نامه‌ها و مجوزها, نظرات و رضایت مشتریان, گارانتی برگشت پول / تضمین زمان نقد
- interactions: ماشین‌حساب کاملاً تعاملی با تغییر لحظه‌ای, چت آنلاین/پشتیبانی شناور
- homepage_sections: نحوه کار (3-4 مرحله), نمایش 7 سرویس به صورت کارت, نظرات مشتریان, چرا AdyMob؟ (مزایا), Hero با CTA و ماشین‌حساب, وبلاگ / آخرین مقالات, آمار و دستاوردها
- competitors_takeaway: مینیمال بودن
حس قابل اعتماد بودن
دسترسی پذیری راحت
- variations: 3 طراحی با جهت‌های متفاوت بصری
- tweaks: رنگ اصلی برند, حالت تاریک/روشن, چیدمان Hero, سبک کارت‌های سرویس, فونت

## Assistant

عالی! ممنون از پاسخ‌ها. الان لوگو رو می‌بینم و یه طراحی کامل با ۸ صفحه و ۳ variation برای صفحه اصلی می‌سازم.

_[tool: view_image]_

_[tool: image_metadata]_

_[tool: copy_files]_

_[tool: update_todos]_

طراحی رو شروع می‌کنم. سیستم طراحی:

**رنگ‌ها** (الهام از لوگو - نارنجی گرم):
- Primary: `#F59E0B` (نارنجی برند)
- Primary Deep: `#D97706` (نارنجی تیره)
- Accent: `#FBBF24` (زرد طلایی)
- Background warm: `#FFFBF5` (کرم گرم)
- Text: `#1A1A1A`

**فونت**: Vazirmatn (جایگزین IranSans و رایگان از Google Fonts)

**سیستم بصری**: کارت‌های گرم با گوشه‌های نرم، سایه‌های ملایم، آیکون‌های ساده SVG، بدون گرادینت اغراق‌شده.

اول tweaks panel رو بگیرم:

_[tool: copy_starter_component]_

حالا فایل‌های مشترک رو می‌سازم. اول استایل‌ها و کامپوننت‌های مشترک:

_[tool: write_file]_

## Assistant

_[tool: read_file]_

خوب، حالا فایل اصلی رو میسازم. شروع می‌کنم با ساختار:

_[tool: write_file]_

## Assistant

_[tool: snip]_

حالا فایل اصلی رو می‌سازم. ساختار:
- `index.html` (همه چی توی یک SPA با routing)
- اجزای React جدا

_[tool: write_file]_

حالا اجزای مشترک (Header, Footer, Logo) و آیکون‌ها:

_[tool: write_file]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

_[tool: snip]_

_[tool: write_file]_

_[tool: write_file]_

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## User

نزدیک به ۲۰ بار این ارور رو دادی

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## User

ادامه بده

## Assistant

من باید رویکرد رو تغییر بدم. به جای فایل‌های بزرگ JSX، یه فایل HTML تک و فشرده می‌سازم که همه چیز توش هست.

_[tool: snip]_

_[tool: list_files]_

بذار رویکرد رو ساده کنم و یه فایل HTML واحد بسازم که همه چیز توش باشه.

_[tool: list_files]_

_[tool: read_file]_

_[tool: snip]_

_[tool: delete_file]_

_[tool: snip]_

_[tool: write_file]_

_[tool: snip]_

_[tool: write_file]_

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## User

ادامه بده

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

## User

مرتب این ارورو میدی . خسته شدم
[unknown] missing EndStreamResponse

## Assistant

_[tool: snip]_

_[tool: write_file]_

## Assistant

_[tool: snip]_

_[tool: write_file]_

_[tool: snip]_

Now let me check what other files exist and create the index.html and styles:

_[tool: list_files]_

_[tool: read_file]_

_[tool: read_file]_

_[tool: snip]_

_[tool: done]_

_[tool: fork_verifier_agent]_

_[tool: snip]_

سایت AdyMob آماده شد ✅

**۸ صفحه کامل:**
- صفحه اصلی با ۳ variation در Hero (دو ستونه / مرکزی / مجله‌ای تیره)
- ۵ صفحه سرویس (AdMob, YouTube, AdSense, شارژ Google Ads, مدیریت Google Ads, حواله ارزی, پرداخت بین‌المللی)
- درباره ما، وبلاگ، تماس

**ویژگی‌های کلیدی:**
- ماشین‌حساب درآمد لحظه‌ای (YouTube/AdMob/AdSense) با کارمزد شفاف
- فرم سفارش با وضعیت موفقیت
- منوی dropdown سرویس‌ها در هدر
- آمار، نظر مشتریان، FAQ آکاردئونی
- Tweaks: تغییر چیدمان Hero، استایل کارت، حالت تاریک، رنگ اصلی

**سیستم طراحی:**
- پالت گرم نارنجی الهام‌گرفته از لوگو (#F59E0B) با پس‌زمینه کرم
- فونت Vazirmatn، اعداد فارسی، RTL کامل
- shadow های گرم با تینت نارنجی، گردی ۱۲–۲۴px

برای تغییر variation ها، روی Tweaks در نوار ابزار کلیک کنید.

## User

Verifier agent check completed

## Assistant

_[tool: str_replace_edit]_

_[tool: snip]_

_[tool: done]_

_[tool: fork_verifier_agent]_

_[tool: snip]_

باگ رفع شد ✅ سایت حالا بدون خطا اجرا می‌شه. اگه نیاز به تغییری دارید بفرمایید.

## User

میخام این طرح رو توی وردپرس با المنتور پیاده سازی کنم چیکار کنم؟

## Assistant

برای پیاده‌سازی این طرح در WordPress + Elementor، اینها رو دنبال کنید:

## ۱. آماده‌سازی WordPress

**هاست + نصب:**
- هاست ایرانی با PHP 8.1+ و MySQL 5.7+ (مثل ایران‌سرور، پارس‌پک)
- نصب WordPress فارسی از `fa.wordpress.org`
- SSL فعال

**افزونه‌های ضروری:**
- **Elementor Pro** (نسخه Pro برای Form, Theme Builder, Popup)
- **Persian Elementor** یا **Royal Elementor Addons** (ویجت‌های فارسی)
- **WP Rocket** یا **LiteSpeed Cache** (سرعت)
- **Rank Math SEO**
- **Loco Translate** (ترجمه)
- **Contact Form 7** یا فرم خود Elementor

**قالب پیشنهادی:**
- **Hello Elementor** (سبک، رسمی Elementor)
- یا **Astra** / **GeneratePress** + سفارشی‌سازی

## ۲. تنظیمات RTL و فونت

**فونت Vazirmatn:**
```
Elementor → Site Settings → Typography
Primary Font: Vazirmatn
Secondary Font: Vazirmatn
```
- فونت رو از `fonts.google.com/specimen/Vazirmatn` دانلود و با افزونه **Custom Fonts** (در Elementor Pro) آپلود کنید
- یا با Custom CSS:
```css
@import url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css');
body { font-family: 'Vazirmatn', sans-serif !important; direction: rtl; }
```

## ۳. تنظیم رنگ‌های برند

`Elementor → Site Settings → Global Colors`:
| نقش | کد |
|---|---|
| Primary | `#F59E0B` |
| Secondary | `#D97706` |
| Accent | `#FBBF24` |
| Text | `#1A1408` |
| Background | `#FFFBF5` |

## ۴. ساختار صفحات (Theme Builder)

**Header (سراسری):**
- Elementor → Templates → Theme Builder → Header
- لوگو + منو + دکمه «ثبت سفارش» (نارنجی)
- Sticky on scroll

**Footer:**
- ۴ ستون: لوگو/توضیح، سرویس‌ها، شرکت، تماس

**صفحات:**
1. **Home** - Hero + Stats + Services + How it works + Testimonials + CTA
2. **هر سرویس** (۷ صفحه): از یک Template مشترک کپی کنید و فقط محتوا عوض کنید
3. **About / Blog / Contact**

## ۵. ویجت‌های کلیدی

| بخش طرح | ویجت Elementor |
|---|---|
| Hero | Section + Heading + Text + Button + Image |
| ماشین‌حساب درآمد | **HTML Widget** (کد JS سفارشی) — Elementor Form این کارو نمی‌کنه |
| کارت سرویس | Icon Box / Image Box + Hover Effects |
| آمار | Counter Widget |
| FAQ | Accordion |
| Testimonials | Testimonial Carousel |
| فرم تماس | Form Widget (Elementor Pro) |

## ۶. ماشین‌حساب درآمد (مهم)

این بخش با ویجت‌های پیش‌فرض ساختنی نیست. دو راه:

**راه A — HTML Widget:** کد ماشین‌حساب رو از فایل `app.jsx` به HTML/JS تبدیل کنید و در ویجت HTML بذارید.

**راه B — افزونه Calculated Fields Form** یا **Stylish Cost Calculator**: راحت‌تر، با درگ‌اند‌دراپ.

می‌تونم کد آماده ماشین‌حساب رو به‌صورت HTML تک‌فایل (که مستقیم در ویجت HTML پیست بشه) براتون بسازم — اگه می‌خواید بگید.

## ۷. نقشه راه پیشنهادی

1. هاست + WP + Elementor Pro نصب → ۱ روز
2. Header/Footer سراسری → ۱ روز
3. صفحه اصلی با همه بخش‌ها → ۲ روز
4. ۷ صفحه سرویس از قالب مشترک → ۲ روز
5. About/Blog/Contact → ۱ روز
6. ماشین‌حساب + فرم سفارش → ۱ روز
7. SEO + سرعت + تست موبایل → ۱ روز

**جمع: ~۸-۱۰ روز کاری**

---

می‌خواید یکی از این کارها رو براتون انجام بدم؟
- 🔧 ساخت **HTML تک‌فایل ماشین‌حساب** برای ویجت HTML المنتور
- 📋 تهیه **متن کامل تمام صفحات** (محتوای فارسی برای کپی به المنتور)
- 🎨 ساخت **Style Guide PDF** با همه رنگ‌ها، فونت‌ها، spacing برای رفرنس
- 📐 خروجی **Figma-ready** از طرح برای استفاده در Elementor


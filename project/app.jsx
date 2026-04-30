const { useState, useEffect, useMemo } = React;

// ===== Data =====
const USD_RATE = 89500;
const SERVICES = [
  { id: 'admob',    name: 'نقد درآمد AdMob',    icon: 'admob',    color: '#FBC02D', desc: 'تبدیل سریع درآمد دلاری AdMob به تومان با کمترین کارمزد بازار.' },
  { id: 'youtube',  name: 'نقد درآمد YouTube',  icon: 'youtube',  color: '#FF0000', desc: 'دریافت درآمد یوتیوب از Google AdSense و واریز مستقیم به حساب.' },
  { id: 'adsense',  name: 'نقد درآمد AdSense',  icon: 'adsense',  color: '#34A853', desc: 'نقد درآمد سایت‌ها و وبلاگ‌های دارای AdSense با تضمین قیمت.' },
  { id: 'gads-charge', name: 'شارژ Google Ads', icon: 'charge',   color: '#4285F4', desc: 'شارژ سریع اکانت گوگل ادز با ارز معادل دلار، یورو یا پوند.' },
  { id: 'gads-mng', name: 'مدیریت Google Ads',  icon: 'manage',   color: '#9333EA', desc: 'راه‌اندازی، بهینه‌سازی و مدیریت کمپین‌های گوگل ادز توسط متخصصان.' },
  { id: 'wire',     name: 'حواله ارزی',          icon: 'wire',     color: '#06B6D4', desc: 'ارسال و دریافت ارز به/از کشورهای مختلف با نرخ روز و کارمزد شفاف.' },
  { id: 'paypal',   name: 'پرداخت بین‌المللی',   icon: 'paypal',   color: '#0EA5E9', desc: 'پرداخت سرویس‌های آنلاین، خرید نرم‌افزار و پلتفرم‌های خارجی.' },
];

const TWEAK_DEFAULTS = /*EDITMODE-BEGIN*/{
  "heroLayout": "split",
  "cardStyle": "warm",
  "dark": false,
  "primary": "#F59E0B",
  "showRates": true
}/*EDITMODE-END*/;

// ===== Format =====
const fmt = {
  toman: (n) => Math.round(n).toLocaleString('fa-IR'),
  usd: (n) => '$' + Math.round(n).toLocaleString('en-US'),
};

// ===== Icons =====
const I = {
  Sparkle: (p) => <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M12 3l1.9 5.6L19 10l-5.1 1.4L12 17l-1.9-5.6L5 10l5.1-1.4z"/></svg>,
  ArrowLeft: (p) => <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M19 12H5M12 19l-7-7 7-7"/></svg>,
  ArrowRight: (p) => <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M5 12h14M12 5l7 7-7 7"/></svg>,
  Check: (p) => <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M20 6L9 17l-5-5"/></svg>,
  Bolt: (p) => <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>,
  Shield: (p) => <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>,
  Eye: (p) => <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>,
  Phone: (p) => <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.13 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.37 1.9.72 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.59 2.81.72a2 2 0 0 1 1.72 2z"/></svg>,
  Mail: (p) => <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>,
  Doc: (p) => <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8"/></svg>,
  Calc: (p) => <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="16" y1="14" x2="16" y2="18"/><path d="M8 14h.01M12 14h.01M8 18h.01M12 18h.01"/></svg>,
  Clock: (p) => <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>,
  Users: (p) => <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>,
  Trend: (p) => <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>,
  Star: (p) => <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" {...p}><polygon points="12 2 15.1 8.6 22 9.3 17 14.1 18.2 21 12 17.8 5.8 21 7 14.1 2 9.3 8.9 8.6"/></svg>,
  Menu: (p) => <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" {...p}><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>,
  Close: (p) => <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" {...p}><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>,
  // service icons (filled colorful)
  admob: (p) => <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" {...p}><path d="M12 2L2 22h20L12 2zm0 5l6.5 13H5.5L12 7z"/></svg>,
  youtube: (p) => <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" {...p}><path d="M23 7s-.2-1.6-.9-2.3c-.8-.9-1.7-.9-2.2-1C16.6 3.4 12 3.4 12 3.4s-4.6 0-7.9.3c-.5.1-1.4.1-2.2 1C1.2 5.4 1 7 1 7S.8 8.9.8 10.8v1.5C.8 14.2 1 16 1 16s.2 1.6.9 2.3c.8.9 1.9.9 2.4 1 1.7.2 7.7.3 7.7.3s4.6 0 7.9-.3c.5-.1 1.4-.1 2.2-1 .7-.7.9-2.3.9-2.3s.2-1.9.2-3.7v-1.6C23.2 8.9 23 7 23 7zM9.7 14.6V8.4l6 3.1-6 3.1z"/></svg>,
  adsense: (p) => <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" {...p}><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-1 15h-2v-6h2v6zm0-8h-2V7h2v2zm5 8h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>,
  charge: (p) => <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><rect x="2" y="6" width="20" height="12" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/><line x1="6" y1="14" x2="10" y2="14"/></svg>,
  manage: (p) => <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>,
  wire: (p) => <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>,
  paypal: (p) => <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" {...p}><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>,
};

// ===== Logo =====
function Logo({ size = 32 }) {
  return (
    <div style={{ display: 'flex', alignItems: 'center', gap: 10 }}>
      <img src="assets/logo.png" alt="AdyMob" style={{ height: size, width: 'auto' }}/>
      <span style={{ fontWeight: 800, fontSize: size * 0.55, letterSpacing: '-0.02em', color: 'var(--text)' }}>AdyMob</span>
    </div>
  );
}

// ===== Header =====
function Header({ route, setRoute }) {
  const [open, setOpen] = useState(false);
  const links = [
    { id: 'home', label: 'صفحه اصلی' },
    { id: 'admob', label: 'سرویس‌ها', dropdown: SERVICES },
    { id: 'about', label: 'درباره ما' },
    { id: 'blog', label: 'وبلاگ' },
    { id: 'contact', label: 'تماس' },
  ];
  return (
    <header style={{ position: 'sticky', top: 0, zIndex: 50, background: 'rgba(255,251,245,0.85)', backdropFilter: 'blur(12px)', borderBottom: '1px solid var(--border)' }}>
      <div className="container" style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', padding: '14px 24px', gap: 24 }}>
        <a href="#" onClick={(e) => { e.preventDefault(); setRoute('home'); }} style={{ textDecoration: 'none' }}>
          <Logo size={36}/>
        </a>
        <nav style={{ display: 'flex', alignItems: 'center', gap: 4 }} className="nav-desktop">
          {links.map(l => (
            <div key={l.id} style={{ position: 'relative' }} className="nav-item">
              <button onClick={() => setRoute(l.id)} style={{
                background: 'transparent', border: 'none', fontFamily: 'var(--font)',
                fontSize: 14, fontWeight: 600, padding: '8px 14px', borderRadius: 8,
                color: route === l.id ? 'var(--primary-deep)' : 'var(--text-soft)',
                cursor: 'pointer',
              }}>{l.label}</button>
              {l.dropdown && (
                <div className="dropdown" style={{
                  position: 'absolute', top: '100%', right: 0, marginTop: 8,
                  background: 'var(--bg-card)', border: '1px solid var(--border)',
                  borderRadius: 16, padding: 8, boxShadow: 'var(--shadow-lg)', minWidth: 280,
                  display: 'none', zIndex: 100,
                }}>
                  {l.dropdown.map(s => {
                    const Ic = I[s.icon];
                    return (
                      <a key={s.id} onClick={(e) => { e.preventDefault(); setRoute(s.id); }} href="#" style={{
                        display: 'flex', alignItems: 'center', gap: 12, padding: '10px 12px',
                        borderRadius: 10, textDecoration: 'none', color: 'var(--text)',
                      }} onMouseEnter={(e) => e.currentTarget.style.background = 'var(--bg-soft)'}
                         onMouseLeave={(e) => e.currentTarget.style.background = 'transparent'}>
                        <span style={{ width: 36, height: 36, borderRadius: 10, background: s.color + '22', color: s.color, display: 'flex', alignItems: 'center', justifyContent: 'center' }}><Ic/></span>
                        <span style={{ fontSize: 13.5, fontWeight: 600 }}>{s.name}</span>
                      </a>
                    );
                  })}
                </div>
              )}
            </div>
          ))}
        </nav>
        <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
          <button className="btn btn-ghost" onClick={() => setRoute('contact')}>ورود</button>
          <button className="btn btn-primary" onClick={() => setRoute('contact')}>ثبت سفارش</button>
          <button className="btn-mobile" style={{ display: 'none', background: 'transparent', border: 'none', cursor: 'pointer' }} onClick={() => setOpen(!open)}>
            {open ? <I.Close/> : <I.Menu/>}
          </button>
        </div>
      </div>
      {open && (
        <div style={{ padding: 16, borderTop: '1px solid var(--border)', background: 'var(--bg-card)' }} className="mobile-menu">
          {links.map(l => (
            <a key={l.id} href="#" onClick={(e) => { e.preventDefault(); setRoute(l.id); setOpen(false); }} style={{ display: 'block', padding: 12, fontWeight: 600, textDecoration: 'none', color: 'var(--text)' }}>{l.label}</a>
          ))}
        </div>
      )}
      <style>{`
        .nav-item:hover .dropdown { display: block !important; }
        @media (max-width: 920px) {
          .nav-desktop { display: none !important; }
          .btn-mobile { display: inline-flex !important; }
        }
      `}</style>
    </header>
  );
}

// ===== Footer =====
function Footer({ setRoute }) {
  return (
    <footer style={{ background: 'var(--bg-soft)', borderTop: '1px solid var(--border)', marginTop: 64 }}>
      <div className="container" style={{ padding: '56px 24px 32px' }}>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: 32, marginBottom: 40 }}>
          <div>
            <Logo size={32}/>
            <p style={{ fontSize: 13.5, color: 'var(--text-mute)', lineHeight: 1.8, marginTop: 14, maxWidth: 280 }}>
              پلتفرم تخصصی نقد درآمد ارزی، شارژ Google Ads و حواله ارزی در ایران.
            </p>
          </div>
          <div>
            <div style={{ fontSize: 13, fontWeight: 700, color: 'var(--text)', marginBottom: 14 }}>سرویس‌ها</div>
            {SERVICES.slice(0, 5).map(s => (
              <a key={s.id} href="#" onClick={(e) => { e.preventDefault(); setRoute(s.id); }} style={{ display: 'block', padding: '4px 0', fontSize: 13, color: 'var(--text-mute)', textDecoration: 'none' }}>{s.name}</a>
            ))}
          </div>
          <div>
            <div style={{ fontSize: 13, fontWeight: 700, color: 'var(--text)', marginBottom: 14 }}>شرکت</div>
            {[
              { id: 'about', l: 'درباره ما' },
              { id: 'blog', l: 'وبلاگ' },
              { id: 'contact', l: 'تماس با ما' },
              { id: 'about', l: 'سوالات متداول' },
            ].map((x, i) => (
              <a key={i} href="#" onClick={(e) => { e.preventDefault(); setRoute(x.id); }} style={{ display: 'block', padding: '4px 0', fontSize: 13, color: 'var(--text-mute)', textDecoration: 'none' }}>{x.l}</a>
            ))}
          </div>
          <div>
            <div style={{ fontSize: 13, fontWeight: 700, color: 'var(--text)', marginBottom: 14 }}>تماس</div>
            <div style={{ fontSize: 13, color: 'var(--text-mute)', lineHeight: 2 }}>
              <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}><I.Phone/> ۰۲۱-۹۱۰۰۰۰۰۰</div>
              <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}><I.Mail/> info@adymob.com</div>
              <div style={{ marginTop: 10 }}>پشتیبانی ۲۴/۷</div>
            </div>
          </div>
        </div>
        <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', paddingTop: 24, borderTop: '1px solid var(--border)', flexWrap: 'wrap', gap: 12 }}>
          <span style={{ fontSize: 12.5, color: 'var(--text-mute)' }}>© ۱۴۰۴ AdyMob — تمامی حقوق محفوظ است.</span>
          <div style={{ display: 'flex', gap: 8 }}>
            <span style={{ fontSize: 11, padding: '4px 10px', background: 'var(--bg-card)', borderRadius: 6, border: '1px solid var(--border)', color: 'var(--text-mute)' }}>نماد اعتماد</span>
            <span style={{ fontSize: 11, padding: '4px 10px', background: 'var(--bg-card)', borderRadius: 6, border: '1px solid var(--border)', color: 'var(--text-mute)' }}>ساماندهی</span>
          </div>
        </div>
      </div>
    </footer>
  );
}

// ===== Calculator =====
function Calculator({ defaultTab = 'youtube' }) {
  const [tab, setTab] = useState(defaultTab);
  const [val, setVal] = useState(1000);
  const calc = useMemo(() => {
    const fee = tab === 'youtube' ? 0.04 : tab === 'admob' ? 0.05 : 0.06;
    const usd = val;
    const tomanGross = usd * USD_RATE;
    const feeAmount = tomanGross * fee;
    const net = tomanGross - feeAmount;
    return { usd, gross: tomanGross, fee: feeAmount, net, feePct: fee * 100 };
  }, [val, tab]);
  return (
    <div className="card" style={{ padding: 24, boxShadow: 'var(--shadow-lg)' }}>
      <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', marginBottom: 16 }}>
        <h3 style={{ fontSize: 17, fontWeight: 700, margin: 0 }}>محاسبه درآمد</h3>
        <div style={{ display: 'inline-flex', alignItems: 'center', gap: 6, padding: '4px 10px', background: 'var(--primary-bg)', color: 'var(--primary-deep)', borderRadius: 999, fontSize: 12, fontWeight: 600 }}>
          <span style={{ width: 6, height: 6, background: 'var(--green)', borderRadius: '50%' }}/>
          نرخ زنده
        </div>
      </div>
      <div className="tabs" style={{ marginBottom: 18 }}>
        <button className={`tab ${tab === 'youtube' ? 'active' : ''}`} onClick={() => setTab('youtube')}>YouTube</button>
        <button className={`tab ${tab === 'admob' ? 'active' : ''}`} onClick={() => setTab('admob')}>AdMob</button>
        <button className={`tab ${tab === 'adsense' ? 'active' : ''}`} onClick={() => setTab('adsense')}>AdSense</button>
      </div>
      <label style={{ fontSize: 13, color: 'var(--text-mute)', marginBottom: 6, display: 'block' }}>مبلغ (دلار)</label>
      <div style={{ position: 'relative', marginBottom: 8 }}>
        <input type="number" value={val} onChange={(e) => setVal(+e.target.value || 0)} className="input num" style={{ paddingLeft: 56, fontSize: 18, fontWeight: 700 }}/>
        <span style={{ position: 'absolute', left: 16, top: '50%', transform: 'translateY(-50%)', fontSize: 14, color: 'var(--text-mute)', fontWeight: 600 }}>USD</span>
      </div>
      <input type="range" min="100" max="20000" step="100" value={val} onChange={(e) => setVal(+e.target.value)} style={{ width: '100%', accentColor: 'var(--primary)' }}/>
      <div style={{ display: 'flex', justifyContent: 'space-between', fontSize: 11, color: 'var(--text-faint)', marginBottom: 18 }}>
        <span>$۱۰۰</span><span>$۲۰٬۰۰۰</span>
      </div>
      <div style={{ background: 'var(--bg-soft)', borderRadius: 14, padding: 16, marginBottom: 16 }}>
        <Row label="معادل تومانی" value={fmt.toman(calc.gross) + ' ت'}/>
        <Row label={`کارمزد (${calc.feePct}٪)`} value={'− ' + fmt.toman(calc.fee) + ' ت'} muted/>
        <div style={{ height: 1, background: 'var(--border)', margin: '12px 0' }}/>
        <Row label="مبلغ نهایی واریزی" value={fmt.toman(calc.net) + ' تومان'} bold large/>
      </div>
      <button className="btn btn-primary" style={{ width: '100%' }}>
        ثبت سفارش با این مبلغ <I.ArrowLeft/>
      </button>
    </div>
  );
}

function Row({ label, value, muted, bold, large }) {
  return (
    <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', padding: '4px 0' }}>
      <span style={{ fontSize: 13, color: muted ? 'var(--text-mute)' : 'var(--text-soft)' }}>{label}</span>
      <span className="num" style={{ fontSize: large ? 20 : 14, fontWeight: bold ? 800 : 600, color: bold ? 'var(--primary-deep)' : 'var(--text)' }}>{value}</span>
    </div>
  );
}

// ===== Hero variants =====
function HeroSplit({ setRoute }) {
  return (
    <section style={{ position: 'relative', overflow: 'hidden', padding: '60px 0 40px' }}>
      <div className="container" style={{ display: 'grid', gridTemplateColumns: '1.05fr 1fr', gap: 56, alignItems: 'center' }} className2="hero-grid">
        <div className="hero-grid-inner">
          <div className="fade-up">
            <span className="eyebrow"><I.Sparkle/> پلتفرم نقد درآمد ارزی شماره ۱ ایران</span>
            <h1 className="h1" style={{ marginTop: 18, marginBottom: 18 }}>
              درآمد ارزی شما را<br/>
              <span style={{ background: 'linear-gradient(120deg, #F59E0B, #D97706)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent' }}>امن، سریع و شفاف</span><br/>
              مدیریت می‌کنیم.
            </h1>
            <p className="lead" style={{ maxWidth: 520, marginBottom: 28 }}>
              نقد درآمد AdMob، YouTube، AdSense؛ شارژ Google Ads، حواله ارزی و پرداخت‌های بین‌المللی — همه در یک پلتفرم.
            </p>
            <div style={{ display: 'flex', gap: 12, flexWrap: 'wrap' }}>
              <button className="btn btn-primary btn-lg" onClick={() => setRoute('contact')}>
                ثبت سفارش رایگان <I.ArrowLeft/>
              </button>
              <button className="btn btn-ghost btn-lg" onClick={() => setRoute('about')}>درباره AdyMob</button>
            </div>
            <div style={{ display: 'flex', gap: 24, marginTop: 32, flexWrap: 'wrap' }}>
              {[
                { i: 'Bolt', t: 'واریز در ۲ ساعت' },
                { i: 'Shield', t: 'تضمین بازگشت وجه' },
                { i: 'Eye', t: 'بدون کارمزد پنهان' },
              ].map(b => {
                const Ic = I[b.i];
                return (
                  <div key={b.t} style={{ display: 'flex', alignItems: 'center', gap: 8, fontSize: 13.5, color: 'var(--text-soft)', fontWeight: 500 }}>
                    <span style={{ width: 32, height: 32, borderRadius: 8, background: 'var(--primary-bg)', color: 'var(--primary-deep)', display: 'flex', alignItems: 'center', justifyContent: 'center' }}><Ic/></span>{b.t}
                  </div>
                );
              })}
            </div>
          </div>
        </div>
        <div className="fade-up" style={{ animationDelay: '0.1s' }}>
          <Calculator/>
        </div>
      </div>
      <div style={{ position: 'absolute', top: -100, left: -100, width: 360, height: 360, borderRadius: '50%', background: 'radial-gradient(circle, rgba(251,191,36,0.18), transparent 70%)', pointerEvents: 'none', zIndex: -1 }}/>
      <div style={{ position: 'absolute', bottom: -120, right: -100, width: 320, height: 320, borderRadius: '50%', background: 'radial-gradient(circle, rgba(245,158,11,0.12), transparent 70%)', pointerEvents: 'none', zIndex: -1 }}/>
    </section>
  );
}

function HeroCentered({ setRoute }) {
  return (
    <section style={{ position: 'relative', overflow: 'hidden', padding: '80px 0 50px', textAlign: 'center' }}>
      <div className="dot-grid" style={{ position: 'absolute', inset: 0, opacity: 0.3, maskImage: 'radial-gradient(ellipse at center, black, transparent 70%)' }}/>
      <div className="container" style={{ position: 'relative', maxWidth: 880 }}>
        <span className="eyebrow"><I.Star/> اعتماد بیش از ۱۲٬۰۰۰ یوتیوبر و توسعه‌دهنده</span>
        <h1 className="h1" style={{ marginTop: 22, marginBottom: 22 }}>
          درآمد ارزی، تبلیغات گوگل و پرداخت‌های<br/>
          بین‌المللی شما را{' '}
          <span style={{ background: 'linear-gradient(120deg, #F59E0B, #D97706)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent' }}>به‌سادگی</span> مدیریت می‌کنیم
        </h1>
        <p className="lead" style={{ maxWidth: 640, margin: '0 auto 32px' }}>
          از نقد درآمد یوتیوب و AdMob تا شارژ Google Ads و حواله ارزی — همه در یک سامانه مطمئن، با کارمزد شفاف.
        </p>
        <div style={{ display: 'flex', gap: 12, justifyContent: 'center', flexWrap: 'wrap', marginBottom: 48 }}>
          <button className="btn btn-primary btn-lg" onClick={() => setRoute('contact')}>ثبت سفارش رایگان <I.ArrowLeft/></button>
          <button className="btn btn-outline btn-lg" onClick={() => setRoute('about')}>درباره ما</button>
        </div>
        <div style={{ maxWidth: 720, margin: '0 auto' }}><Calculator/></div>
      </div>
    </section>
  );
}

function HeroEditorial({ setRoute }) {
  return (
    <section style={{ padding: '40px 0' }}>
      <div className="container">
        <div style={{ background: 'linear-gradient(135deg, #1A1408 0%, #2E1F08 100%)', borderRadius: 32, padding: 48, color: '#FFF7E6', position: 'relative', overflow: 'hidden' }}>
          <div style={{ position: 'absolute', top: -80, left: -80, width: 320, height: 320, borderRadius: '50%', background: 'radial-gradient(circle, rgba(251,191,36,0.3), transparent 70%)' }}/>
          <div style={{ position: 'absolute', bottom: -60, right: -60, width: 280, height: 280, borderRadius: '50%', background: 'radial-gradient(circle, rgba(245,158,11,0.18), transparent 70%)' }}/>
          <div style={{ position: 'relative', display: 'grid', gridTemplateColumns: '1.2fr 1fr', gap: 40, alignItems: 'center' }} data-hero-grid>
            <div>
              <div style={{ display: 'inline-flex', alignItems: 'center', gap: 8, padding: '6px 14px', background: 'rgba(251,191,36,0.15)', border: '1px solid rgba(251,191,36,0.3)', borderRadius: 999, fontSize: 12.5, color: '#FBBF24', marginBottom: 22 }}>
                <span style={{ width: 6, height: 6, background: '#10B981', borderRadius: '50%' }}/>
                از ۱۳۹۷ — اعتماد ۱۲٬۰۰۰+ مشتری
              </div>
              <h1 style={{ fontSize: 'clamp(40px, 5.5vw, 60px)', fontWeight: 800, lineHeight: 1.1, letterSpacing: '-0.02em', marginBottom: 22 }}>
                درآمد ارزی،<br/>
                <span style={{ color: '#FBBF24' }}>به‌سادگی</span> یک کلیک.
              </h1>
              <p style={{ fontSize: 17, lineHeight: 1.7, color: '#E8DBBE', maxWidth: 480, marginBottom: 28 }}>
                AdyMob درآمد ارزی، تبلیغات گوگل و پرداخت‌های بین‌المللی شما را امن، سریع و شفاف مدیریت می‌کند.
              </p>
              <div style={{ display: 'flex', gap: 12, flexWrap: 'wrap' }}>
                <button className="btn btn-primary btn-lg" onClick={() => setRoute('contact')}>شروع کنید <I.ArrowLeft/></button>
                <button className="btn btn-lg" style={{ background: 'rgba(255,255,255,0.1)', color: '#FFF7E6', border: '1px solid rgba(255,255,255,0.2)' }} onClick={() => setRoute('about')}>درباره ما</button>
              </div>
              <div style={{ marginTop: 36, paddingTop: 24, borderTop: '1px solid rgba(255,255,255,0.1)', display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: 16 }}>
                {[
                  { v: '۱۲هزار+', l: 'مشتری فعال' },
                  { v: '۹۹.۸٪', l: 'تسویه به‌موقع' },
                  { v: '<۲ ساعت', l: 'زمان واریز' },
                ].map(s => (
                  <div key={s.l}>
                    <div className="num" style={{ fontSize: 22, fontWeight: 800, color: '#FBBF24' }}>{s.v}</div>
                    <div style={{ fontSize: 12, color: '#A89779' }}>{s.l}</div>
                  </div>
                ))}
              </div>
            </div>
            <div><Calculator/></div>
          </div>
        </div>
      </div>
    </section>
  );
}

// ===== Stats Bar =====
function StatsBar() {
  const stats = [
    { v: '۱۲٬۴۰۰+', l: 'مشتری فعال', i: 'Users' },
    { v: '۸۵۰ میلیارد', l: 'تومان تراکنش', i: 'Trend' },
    { v: '۸ سال', l: 'سابقه فعالیت', i: 'Clock' },
    { v: '۹۸٪', l: 'رضایت مشتریان', i: 'Star' },
  ];
  return (
    <section style={{ padding: '32px 0' }}>
      <div className="container">
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))', gap: 16, padding: 24, background: 'var(--bg-card)', borderRadius: 24, border: '1px solid var(--border)', boxShadow: 'var(--shadow-sm)' }}>
          {stats.map((s, idx) => {
            const Ic = I[s.i];
            return (
              <div key={s.l} style={{ display: 'flex', alignItems: 'center', gap: 14, paddingRight: idx > 0 ? 16 : 0, borderRight: idx > 0 ? '1px solid var(--border)' : 'none' }}>
                <div style={{ width: 48, height: 48, borderRadius: 12, background: 'var(--primary-bg)', color: 'var(--primary-deep)', display: 'flex', alignItems: 'center', justifyContent: 'center' }}><Ic/></div>
                <div>
                  <div className="num" style={{ fontSize: 22, fontWeight: 800, lineHeight: 1.1 }}>{s.v}</div>
                  <div style={{ fontSize: 12.5, color: 'var(--text-mute)' }}>{s.l}</div>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}

// ===== Services Section =====
function Services({ setRoute, cardStyle }) {
  return (
    <section style={{ padding: '64px 0' }}>
      <div className="container">
        <div style={{ textAlign: 'center', marginBottom: 48 }}>
          <span className="eyebrow">سرویس‌های ما</span>
          <h2 className="h2" style={{ marginTop: 16, marginBottom: 12 }}>هر آنچه برای کسب‌وکار ارزی لازم دارید</h2>
          <p className="lead" style={{ maxWidth: 580, margin: '0 auto' }}>
            هفت سرویس تخصصی، طراحی‌شده برای کسب‌وکارهای دیجیتال ایرانی.
          </p>
        </div>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))', gap: 16 }}>
          {SERVICES.map((s, i) => <ServiceCard key={s.id} s={s} variant={cardStyle} idx={i} onClick={() => setRoute(s.id)}/>)}
        </div>
      </div>
    </section>
  );
}

function ServiceCard({ s, variant, idx, onClick }) {
  const Ic = I[s.icon];
  if (variant === 'minimal') {
    return (
      <div className="card card-hover" onClick={onClick} style={{ cursor: 'pointer' }}>
        <div style={{ width: 44, height: 44, borderRadius: 12, background: s.color + '18', color: s.color, display: 'flex', alignItems: 'center', justifyContent: 'center', marginBottom: 16 }}><Ic/></div>
        <h3 className="h4" style={{ marginBottom: 8 }}>{s.name}</h3>
        <p style={{ fontSize: 13.5, color: 'var(--text-mute)', lineHeight: 1.7, margin: 0 }}>{s.desc}</p>
        <div style={{ marginTop: 16, fontSize: 13, fontWeight: 600, color: 'var(--primary-deep)', display: 'flex', alignItems: 'center', gap: 4 }}>
          مشاهده <I.ArrowLeft/>
        </div>
      </div>
    );
  }
  if (variant === 'gradient') {
    return (
      <div onClick={onClick} className="card-hover" style={{
        cursor: 'pointer', padding: 24, borderRadius: 20, position: 'relative', overflow: 'hidden',
        background: `linear-gradient(135deg, ${s.color}18, ${s.color}06)`,
        border: `1px solid ${s.color}40`, transition: 'all 0.2s',
      }}>
        <div style={{ width: 52, height: 52, borderRadius: 14, background: s.color, color: '#fff', display: 'flex', alignItems: 'center', justifyContent: 'center', marginBottom: 16, boxShadow: `0 8px 20px ${s.color}40` }}><Ic/></div>
        <h3 className="h4" style={{ marginBottom: 8 }}>{s.name}</h3>
        <p style={{ fontSize: 13.5, color: 'var(--text-mute)', lineHeight: 1.7, margin: 0 }}>{s.desc}</p>
      </div>
    );
  }
  // warm (default)
  return (
    <div className="card card-hover" onClick={onClick} style={{ cursor: 'pointer', padding: 0, overflow: 'hidden' }}>
      <div style={{ height: 4, background: s.color }}/>
      <div style={{ padding: 24 }}>
        <div style={{ display: 'flex', alignItems: 'center', gap: 12, marginBottom: 14 }}>
          <div style={{ width: 44, height: 44, borderRadius: 12, background: s.color + '18', color: s.color, display: 'flex', alignItems: 'center', justifyContent: 'center' }}><Ic/></div>
          <h3 className="h4">{s.name}</h3>
        </div>
        <p style={{ fontSize: 13.5, color: 'var(--text-mute)', lineHeight: 1.7, margin: 0 }}>{s.desc}</p>
      </div>
    </div>
  );
}

// ===== How It Works =====
function HowItWorks() {
  const steps = [
    { n: '۰۱', t: 'ثبت سفارش', d: 'فرم ساده را پر کنید — کمتر از ۲ دقیقه.' },
    { n: '۰۲', t: 'تأیید نرخ', d: 'نرخ نهایی ظرف چند دقیقه به شما اعلام می‌شود.' },
    { n: '۰۳', t: 'انجام تراکنش', d: 'تیم تخصصی ما عملیات را با امنیت کامل انجام می‌دهد.' },
    { n: '۰۴', t: 'دریافت نتیجه', d: 'مبلغ نهایی به حساب شما در کمتر از ۲ ساعت کاری.' },
  ];
  return (
    <section style={{ padding: '64px 0', background: 'var(--bg-soft)' }}>
      <div className="container">
        <div style={{ textAlign: 'center', marginBottom: 48 }}>
          <span className="eyebrow">مراحل کار</span>
          <h2 className="h2" style={{ marginTop: 16 }}>در ۴ مرحله ساده</h2>
        </div>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))', gap: 16 }}>
          {steps.map((s, i) => (
            <div key={s.n} className="card" style={{ position: 'relative' }}>
              <div className="num" style={{ fontSize: 28, fontWeight: 800, color: 'var(--primary)', marginBottom: 10 }}>{s.n}</div>
              <h3 className="h4" style={{ marginBottom: 6 }}>{s.t}</h3>
              <p style={{ fontSize: 13.5, color: 'var(--text-mute)', lineHeight: 1.7, margin: 0 }}>{s.d}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

// ===== Why Us =====
function WhyUs() {
  const points = [
    { i: 'Shield', t: 'امنیت تضمین‌شده', d: 'تمام تراکنش‌ها با پروتکل‌های امن انجام می‌شود و شامل ضمانت بازگشت وجه است.' },
    { i: 'Bolt', t: 'سرعت بالا', d: 'میانگین زمان واریز از ثبت سفارش تا دریافت تومان، کمتر از ۲ ساعت کاری است.' },
    { i: 'Eye', t: 'شفافیت کامل', d: 'نرخ تبدیل و کارمزد قبل از تأیید سفارش به‌طور دقیق به شما اعلام می‌شود.' },
    { i: 'Users', t: 'پشتیبانی ۲۴/۷', d: 'تیم متخصص ما به‌صورت شبانه‌روزی پاسخگوی سؤالات شماست.' },
  ];
  return (
    <section style={{ padding: '64px 0' }}>
      <div className="container">
        <div style={{ textAlign: 'center', marginBottom: 48 }}>
          <span className="eyebrow">چرا AdyMob</span>
          <h2 className="h2" style={{ marginTop: 16 }}>چرا هزاران مشتری ما را انتخاب کرده‌اند</h2>
        </div>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(240px, 1fr))', gap: 20 }}>
          {points.map(p => {
            const Ic = I[p.i];
            return (
              <div key={p.t} style={{ textAlign: 'center', padding: 20 }}>
                <div style={{ width: 60, height: 60, borderRadius: 16, background: 'var(--primary-bg)', color: 'var(--primary-deep)', display: 'flex', alignItems: 'center', justifyContent: 'center', margin: '0 auto 14px' }}><Ic/></div>
                <h3 className="h4" style={{ marginBottom: 8 }}>{p.t}</h3>
                <p style={{ fontSize: 13.5, color: 'var(--text-mute)', lineHeight: 1.7, margin: 0 }}>{p.d}</p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}

// ===== Testimonials =====
function Testimonials() {
  const items = [
    { name: 'مهدی رضایی', role: 'یوتیوبر • ۲.۴M سابسکرایبر', text: 'بعد از ۲ سال کار با AdyMob، تنها سرویسی هست که هیچ‌وقت ناامیدم نکرده. سریع، دقیق، شفاف.' },
    { name: 'سارا محمدی', role: 'توسعه‌دهنده اپ', text: 'برای نقد درآمد AdMob از پلتفرم‌های مختلف استفاده کرده بودم. تجربه AdyMob واقعاً متفاوته.' },
    { name: 'علی کریمی', role: 'مدیر آژانس دیجیتال', text: 'برای شارژ گوگل ادز کلاینت‌هامون، نرخ AdyMob رقابتی‌ترین بود و هیچ‌وقت تأخیر نداشتیم.' },
  ];
  return (
    <section style={{ padding: '64px 0', background: 'var(--bg-soft)' }}>
      <div className="container">
        <div style={{ textAlign: 'center', marginBottom: 48 }}>
          <span className="eyebrow">نظر مشتریان</span>
          <h2 className="h2" style={{ marginTop: 16 }}>صدای کسانی که با ما کار می‌کنند</h2>
        </div>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))', gap: 20 }}>
          {items.map((t, i) => (
            <div key={i} className="card">
              <div style={{ display: 'flex', gap: 2, color: 'var(--primary)', marginBottom: 12 }}>
                {[1,2,3,4,5].map(n => <I.Star key={n}/>)}
              </div>
              <p style={{ fontSize: 14, color: 'var(--text-soft)', lineHeight: 1.8, marginBottom: 18 }}>«{t.text}»</p>
              <div style={{ display: 'flex', alignItems: 'center', gap: 12, paddingTop: 14, borderTop: '1px solid var(--border)' }}>
                <div style={{ width: 40, height: 40, borderRadius: '50%', background: 'var(--primary-bg)', color: 'var(--primary-deep)', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700, fontSize: 14 }}>{t.name[0]}</div>
                <div>
                  <div style={{ fontSize: 13.5, fontWeight: 700 }}>{t.name}</div>
                  <div style={{ fontSize: 12, color: 'var(--text-mute)' }}>{t.role}</div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

// ===== Blog Teaser =====
function BlogTeaser({ setRoute }) {
  const posts = [
    { t: 'چطور درآمد یوتیوب را به تومان تبدیل کنیم؟', cat: 'راهنما', date: '۱۵ فروردین ۱۴۰۵' },
    { t: 'تفاوت AdMob و AdSense در درآمدزایی', cat: 'تحلیل', date: '۲ فروردین ۱۴۰۵' },
    { t: '۱۰ نکته برای کاهش هزینه کمپین گوگل ادز', cat: 'تبلیغات', date: '۱۸ اسفند ۱۴۰۴' },
  ];
  return (
    <section style={{ padding: '64px 0' }}>
      <div className="container">
        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-end', marginBottom: 40, flexWrap: 'wrap', gap: 16 }}>
          <div>
            <span className="eyebrow">وبلاگ</span>
            <h2 className="h2" style={{ marginTop: 12 }}>تازه‌ترین مقالات</h2>
          </div>
          <button className="btn btn-outline" onClick={() => setRoute('blog')}>مشاهده همه <I.ArrowLeft/></button>
        </div>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))', gap: 20 }}>
          {posts.map((p, i) => (
            <article key={i} className="card card-hover" style={{ cursor: 'pointer', padding: 0, overflow: 'hidden' }} onClick={() => setRoute('blog')}>
              <div style={{ height: 160, background: `linear-gradient(135deg, ${['#FEF3C7','#FDE68A','#FCD34D'][i]}, ${['#FBBF24','#F59E0B','#D97706'][i]})`, position: 'relative' }}>
                <span style={{ position: 'absolute', top: 14, right: 14, background: 'rgba(255,255,255,0.9)', color: 'var(--primary-deep)', fontSize: 11, fontWeight: 700, padding: '4px 10px', borderRadius: 999 }}>{p.cat}</span>
              </div>
              <div style={{ padding: 20 }}>
                <h3 className="h4" style={{ marginBottom: 10, lineHeight: 1.4 }}>{p.t}</h3>
                <div style={{ fontSize: 12, color: 'var(--text-mute)' }}>{p.date}</div>
              </div>
            </article>
          ))}
        </div>
      </div>
    </section>
  );
}

// ===== CTA Band =====
function CTABand({ setRoute }) {
  return (
    <section style={{ padding: '40px 0 0' }}>
      <div className="container">
        <div style={{ background: 'linear-gradient(135deg, #F59E0B, #D97706)', borderRadius: 32, padding: '48px 40px', color: '#fff', textAlign: 'center', position: 'relative', overflow: 'hidden' }}>
          <div style={{ position: 'absolute', top: -60, left: -60, width: 200, height: 200, borderRadius: '50%', background: 'rgba(255,255,255,0.1)' }}/>
          <div style={{ position: 'absolute', bottom: -80, right: -40, width: 240, height: 240, borderRadius: '50%', background: 'rgba(255,255,255,0.08)' }}/>
          <div style={{ position: 'relative', zIndex: 1 }}>
            <h2 style={{ fontSize: 32, fontWeight: 800, marginBottom: 14 }}>آماده شروع هستید؟</h2>
            <p style={{ fontSize: 17, opacity: 0.95, maxWidth: 540, margin: '0 auto 28px' }}>
              همین الان حساب رایگان بسازید و در کمتر از ۲ ساعت اولین درآمدتان را به تومان تبدیل کنید.
            </p>
            <div style={{ display: 'flex', gap: 12, justifyContent: 'center', flexWrap: 'wrap' }}>
              <button onClick={() => setRoute('contact')} style={{ padding: '14px 28px', background: '#fff', color: 'var(--primary-deep)', border: 'none', borderRadius: 999, fontFamily: 'var(--font)', fontSize: 15, fontWeight: 700, cursor: 'pointer' }}>ثبت سفارش رایگان</button>
              <button onClick={() => setRoute('about')} style={{ padding: '14px 28px', background: 'rgba(255,255,255,0.15)', color: '#fff', border: '1px solid rgba(255,255,255,0.3)', borderRadius: 999, fontFamily: 'var(--font)', fontSize: 15, fontWeight: 700, cursor: 'pointer' }}>تماس با ما</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

// ===== HomePage =====
function HomePage({ tweaks, setRoute }) {
  return (
    <main>
      {tweaks.heroLayout === 'split' && <HeroSplit setRoute={setRoute}/>}
      {tweaks.heroLayout === 'centered' && <HeroCentered setRoute={setRoute}/>}
      {tweaks.heroLayout === 'editorial' && <HeroEditorial setRoute={setRoute}/>}
      <StatsBar/>
      <Services setRoute={setRoute} cardStyle={tweaks.cardStyle}/>
      <HowItWorks/>
      <WhyUs/>
      <Testimonials/>
      <BlogTeaser setRoute={setRoute}/>
      <CTABand setRoute={setRoute}/>
    </main>
  );
}

// ===== Service Page =====
function ServicePage({ id, setRoute }) {
  const s = SERVICES.find(x => x.id === id);
  if (!s) return null;
  const Ic = I[s.icon];
  const features = [
    { i: 'Bolt', t: 'سرعت بالا', d: 'میانگین انجام عملیات: کمتر از ۲ ساعت کاری' },
    { i: 'Shield', t: 'امنیت کامل', d: 'تمام تراکنش‌ها با پروتکل‌های امن و رسمی انجام می‌شود' },
    { i: 'Eye', t: 'نرخ شفاف', d: 'کارمزد و نرخ تبدیل قبل از تأیید نهایی به شما اعلام می‌شود' },
    { i: 'Users', t: 'پشتیبانی اختصاصی', d: 'کارشناس مخصوص پاسخگوی سؤالات شما در تمام مراحل' },
  ];
  const faqs = [
    { q: `چقدر طول می‌کشد ${s.name} انجام شود؟`, a: 'به‌طور میانگین کمتر از ۲ ساعت کاری از زمان تأیید سفارش.' },
    { q: 'حداقل و حداکثر مبلغ چقدر است؟', a: 'حداقل ۱۰۰ دلار و حداکثر بدون محدودیت — برای مبالغ بالا با پشتیبانی هماهنگ کنید.' },
    { q: 'چه مدارکی نیاز است؟', a: 'تنها مدارک هویتی استاندارد و اطلاعات حساب بانکی مقصد. تمام فرآیند آنلاین است.' },
    { q: 'کارمزد چقدر است؟', a: 'کارمزد ما بین ۴٪ تا ۶٪ متغیر است و قبل از تأیید سفارش به شما اعلام می‌شود.' },
  ];
  return (
    <main>
      <section style={{ padding: '48px 0 32px', background: `linear-gradient(180deg, ${s.color}10, transparent)` }}>
        <div className="container">
          <div style={{ display: 'flex', alignItems: 'center', gap: 6, fontSize: 13, color: 'var(--text-mute)', marginBottom: 20 }}>
            <a href="#" onClick={(e) => { e.preventDefault(); setRoute('home'); }} style={{ color: 'inherit', textDecoration: 'none' }}>صفحه اصلی</a>
            <span>›</span>
            <span>سرویس‌ها</span>
            <span>›</span>
            <span style={{ color: 'var(--text)' }}>{s.name}</span>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 48, alignItems: 'center' }} className="hero-grid">
            <div>
              <div style={{ width: 64, height: 64, borderRadius: 18, background: s.color, color: '#fff', display: 'flex', alignItems: 'center', justifyContent: 'center', marginBottom: 20, boxShadow: `0 12px 32px ${s.color}50` }}>
                <Ic style={{ width: 32, height: 32 }}/>
              </div>
              <h1 className="h1" style={{ marginBottom: 16 }}>{s.name}</h1>
              <p className="lead" style={{ marginBottom: 28, maxWidth: 540 }}>{s.desc}</p>
              <div style={{ display: 'flex', gap: 12, flexWrap: 'wrap' }}>
                <button className="btn btn-primary btn-lg" onClick={() => setRoute('contact')}>ثبت سفارش <I.ArrowLeft/></button>
                <button className="btn btn-outline btn-lg" onClick={() => setRoute('contact')}>مشاوره رایگان</button>
              </div>
            </div>
            <div><Calculator defaultTab={id === 'admob' ? 'admob' : id === 'adsense' ? 'adsense' : 'youtube'}/></div>
          </div>
        </div>
      </section>
      <section style={{ padding: '48px 0' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: 36 }}>
            <h2 className="h2">چرا {s.name} با AdyMob؟</h2>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))', gap: 16 }}>
            {features.map(f => {
              const Fi = I[f.i];
              return (
                <div key={f.t} className="card">
                  <div style={{ width: 48, height: 48, borderRadius: 12, background: s.color + '18', color: s.color, display: 'flex', alignItems: 'center', justifyContent: 'center', marginBottom: 14 }}><Fi/></div>
                  <h3 className="h4" style={{ marginBottom: 6 }}>{f.t}</h3>
                  <p style={{ fontSize: 13.5, color: 'var(--text-mute)', lineHeight: 1.7, margin: 0 }}>{f.d}</p>
                </div>
              );
            })}
          </div>
        </div>
      </section>
      <section style={{ padding: '48px 0', background: 'var(--bg-soft)' }}>
        <div className="container" style={{ maxWidth: 720 }}>
          <div style={{ textAlign: 'center', marginBottom: 36 }}>
            <span className="eyebrow">سوالات متداول</span>
            <h2 className="h2" style={{ marginTop: 14 }}>سوالی دارید؟</h2>
          </div>
          {faqs.map((f, i) => <FAQ key={i} q={f.q} a={f.a}/>)}
        </div>
      </section>
      <CTABand setRoute={setRoute}/>
    </main>
  );
}

function FAQ({ q, a }) {
  const [open, setOpen] = useState(false);
  return (
    <div className="card" style={{ marginBottom: 12, padding: 0, overflow: 'hidden' }}>
      <button onClick={() => setOpen(!open)} style={{ width: '100%', padding: '18px 20px', background: 'transparent', border: 'none', display: 'flex', alignItems: 'center', justifyContent: 'space-between', cursor: 'pointer', fontFamily: 'var(--font)', textAlign: 'right' }}>
        <span style={{ fontSize: 15, fontWeight: 700, color: 'var(--text)' }}>{q}</span>
        <span style={{ fontSize: 24, color: 'var(--primary)', fontWeight: 300, transform: open ? 'rotate(45deg)' : 'none', transition: 'transform 0.2s' }}>+</span>
      </button>
      {open && <div style={{ padding: '0 20px 18px', fontSize: 14, color: 'var(--text-soft)', lineHeight: 1.8 }}>{a}</div>}
    </div>
  );
}

// ===== About Page =====
function AboutPage({ setRoute }) {
  return (
    <main>
      <section style={{ padding: '60px 0 32px', textAlign: 'center', position: 'relative', overflow: 'hidden' }}>
        <div className="container" style={{ maxWidth: 720, position: 'relative' }}>
          <span className="eyebrow"><I.Sparkle/> داستان ما</span>
          <h1 className="h1" style={{ marginTop: 18, marginBottom: 18 }}>
            از ۱۳۹۷، در کنار کسب‌وکار <span style={{ color: 'var(--primary-deep)' }}>دیجیتال</span> ایران
          </h1>
          <p className="lead">AdyMob با هدف ساده‌سازی فرآیند نقد درآمد ارزی برای یوتیوبرها، توسعه‌دهندگان اپ و آژانس‌های دیجیتال ایرانی متولد شد.</p>
        </div>
      </section>
      <section style={{ padding: '32px 0' }}>
        <div className="container" style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 40, alignItems: 'center' }} className="hero-grid">
          <div>
            <h2 className="h2" style={{ marginBottom: 18 }}>مأموریت ما</h2>
            <p style={{ fontSize: 16, color: 'var(--text-soft)', lineHeight: 1.9, marginBottom: 16 }}>
              ما باور داریم درآمد ارزی نباید دغدغه باشد. مأموریت AdyMob این است که با شفافیت کامل، سرعت بالا و کارمزد منصفانه، پل ارتباطی امنی بین درآمد دلاری شما و حساب بانکی‌تان باشد.
            </p>
            <p style={{ fontSize: 16, color: 'var(--text-soft)', lineHeight: 1.9, margin: 0 }}>
              با تکیه بر تیم متخصص و زیرساخت‌های مالی پیشرفته، توانسته‌ایم اعتماد بیش از ۱۲٬۰۰۰ مشتری را جلب کنیم.
            </p>
          </div>
          <div className="card" style={{ padding: 32, background: 'linear-gradient(135deg, var(--primary-bg), #FFFBF5)', border: '1px solid var(--primary-light)' }}>
            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 24 }}>
              {[
                { v: '۱۲٬۴۰۰+', l: 'مشتری فعال' },
                { v: '۸۵۰میلیارد ت', l: 'حجم تراکنش' },
                { v: '۸ سال', l: 'سابقه' },
                { v: '۹۸٪', l: 'رضایت' },
              ].map(s => (
                <div key={s.l}>
                  <div className="num" style={{ fontSize: 28, fontWeight: 800, color: 'var(--primary-deep)', marginBottom: 4 }}>{s.v}</div>
                  <div style={{ fontSize: 13, color: 'var(--text-mute)' }}>{s.l}</div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>
      <section style={{ padding: '48px 0' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: 36 }}>
            <h2 className="h2">ارزش‌های ما</h2>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(240px, 1fr))', gap: 20 }}>
            {[
              { i: 'Shield', t: 'امانت‌داری', d: 'پول مشتری، امانت ماست. هیچ تراکنشی بدون اطلاع‌رسانی شفاف انجام نمی‌شود.' },
              { i: 'Bolt', t: 'سرعت', d: 'وقت طلاست. تمام فرآیندهای ما با حداکثر سرعت ممکن طراحی شده‌اند.' },
              { i: 'Eye', t: 'شفافیت', d: 'هیچ کارمزد پنهانی، هیچ نرخ غیرواقعی. همه چیز قبل از تأیید روشن است.' },
            ].map(v => {
              const Ic = I[v.i];
              return (
                <div key={v.t} className="card" style={{ textAlign: 'center', padding: 28 }}>
                  <div style={{ width: 64, height: 64, borderRadius: 18, background: 'var(--primary-bg)', color: 'var(--primary-deep)', display: 'flex', alignItems: 'center', justifyContent: 'center', margin: '0 auto 14px' }}><Ic/></div>
                  <h3 className="h4" style={{ marginBottom: 8 }}>{v.t}</h3>
                  <p style={{ fontSize: 13.5, color: 'var(--text-mute)', lineHeight: 1.8, margin: 0 }}>{v.d}</p>
                </div>
              );
            })}
          </div>
        </div>
      </section>
      <CTABand setRoute={setRoute}/>
    </main>
  );
}

// ===== Blog Page =====
function BlogPage({ setRoute }) {
  const posts = [
    { t: 'چطور درآمد یوتیوب را به تومان تبدیل کنیم؟', cat: 'راهنما', date: '۱۵ فروردین ۱۴۰۵', read: '۸ دقیقه' },
    { t: 'تفاوت AdMob و AdSense در درآمدزایی', cat: 'تحلیل', date: '۲ فروردین ۱۴۰۵', read: '۶ دقیقه' },
    { t: '۱۰ نکته برای کاهش هزینه کمپین گوگل ادز', cat: 'تبلیغات', date: '۱۸ اسفند ۱۴۰۴', read: '۱۲ دقیقه' },
    { t: 'راهنمای کامل CPM و RPM در یوتیوب', cat: 'راهنما', date: '۱۰ اسفند ۱۴۰۴', read: '۱۰ دقیقه' },
    { t: 'بهترین زمان نقد درآمد دلاری', cat: 'تحلیل', date: '۲۸ بهمن ۱۴۰۴', read: '۵ دقیقه' },
    { t: 'مالیات درآمد ارزی در ایران: راهنمای جامع', cat: 'حقوقی', date: '۱۵ بهمن ۱۴۰۴', read: '۱۵ دقیقه' },
  ];
  const [filter, setFilter] = useState('همه');
  const cats = ['همه', 'راهنما', 'تحلیل', 'تبلیغات', 'حقوقی'];
  const filtered = filter === 'همه' ? posts : posts.filter(p => p.cat === filter);
  const colors = ['#FBBF24', '#F59E0B', '#D97706', '#FCD34D', '#FEF3C7', '#FDE68A'];
  return (
    <main>
      <section style={{ padding: '48px 0 32px', textAlign: 'center' }}>
        <div className="container">
          <span className="eyebrow">وبلاگ AdyMob</span>
          <h1 className="h1" style={{ marginTop: 16, marginBottom: 14 }}>دانش، تجربه، راهکار</h1>
          <p className="lead" style={{ maxWidth: 580, margin: '0 auto' }}>راهنماها و تحلیل‌های تخصصی برای کسب‌وکارهای دیجیتال</p>
        </div>
      </section>
      <section style={{ padding: '24px 0' }}>
        <div className="container">
          <div style={{ display: 'flex', gap: 8, justifyContent: 'center', flexWrap: 'wrap', marginBottom: 32 }}>
            {cats.map(c => (
              <button key={c} onClick={() => setFilter(c)} className={filter === c ? 'btn btn-primary' : 'btn btn-ghost'}>{c}</button>
            ))}
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: 20 }}>
            {filtered.map((p, i) => (
              <article key={i} className="card card-hover" style={{ padding: 0, overflow: 'hidden', cursor: 'pointer' }}>
                <div style={{ height: 180, background: `linear-gradient(135deg, ${colors[i % colors.length]}, ${colors[(i + 2) % colors.length]})`, position: 'relative' }}>
                  <span style={{ position: 'absolute', top: 14, right: 14, background: 'rgba(255,255,255,0.95)', color: 'var(--primary-deep)', fontSize: 11, fontWeight: 700, padding: '4px 12px', borderRadius: 999 }}>{p.cat}</span>
                </div>
                <div style={{ padding: 22 }}>
                  <h3 className="h4" style={{ marginBottom: 14, lineHeight: 1.4 }}>{p.t}</h3>
                  <div style={{ display: 'flex', alignItems: 'center', gap: 14, fontSize: 12, color: 'var(--text-mute)' }}>
                    <span>{p.date}</span>
                    <span>•</span>
                    <span>{p.read} مطالعه</span>
                  </div>
                </div>
              </article>
            ))}
          </div>
        </div>
      </section>
      <CTABand setRoute={setRoute}/>
    </main>
  );
}

// ===== Contact Page =====
function ContactPage() {
  const [form, setForm] = useState({ name: '', phone: '', service: 'youtube', amount: '' });
  const [sent, setSent] = useState(false);
  return (
    <main>
      <section style={{ padding: '48px 0' }}>
        <div className="container" style={{ display: 'grid', gridTemplateColumns: '1fr 1.2fr', gap: 48 }} className="hero-grid">
          <div>
            <span className="eyebrow"><I.Phone/> در تماس باشیم</span>
            <h1 className="h1" style={{ marginTop: 16, marginBottom: 16 }}>سؤال، سفارش، مشاوره</h1>
            <p className="lead" style={{ marginBottom: 32 }}>تیم پشتیبانی ما به‌صورت ۲۴/۷ آماده پاسخگویی است. سریع‌ترین راه: تلفن یا تلگرام.</p>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 14 }}>
              {[
                { i: 'Phone', t: 'تلفن', d: '۰۲۱-۹۱۰۰۰۰۰۰', sub: 'شنبه تا پنجشنبه — ۹ صبح تا ۹ شب' },
                { i: 'Mail', t: 'ایمیل', d: 'info@adymob.com', sub: 'پاسخ در کمتر از ۲ ساعت کاری' },
                { i: 'Clock', t: 'پشتیبانی آنلاین', d: 'تلگرام: @adymob_support', sub: '۲۴ ساعته' },
              ].map(c => {
                const Ic = I[c.i];
                return (
                  <div key={c.t} className="card" style={{ display: 'flex', alignItems: 'center', gap: 16 }}>
                    <div style={{ width: 48, height: 48, borderRadius: 12, background: 'var(--primary-bg)', color: 'var(--primary-deep)', display: 'flex', alignItems: 'center', justifyContent: 'center', flexShrink: 0 }}><Ic/></div>
                    <div>
                      <div style={{ fontSize: 13, color: 'var(--text-mute)', marginBottom: 2 }}>{c.t}</div>
                      <div style={{ fontSize: 15, fontWeight: 700, marginBottom: 2 }}>{c.d}</div>
                      <div style={{ fontSize: 12, color: 'var(--text-mute)' }}>{c.sub}</div>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
          <div className="card" style={{ padding: 28 }}>
            {sent ? (
              <div style={{ textAlign: 'center', padding: '40px 20px' }}>
                <div style={{ width: 72, height: 72, borderRadius: '50%', background: '#DCFCE7', color: '#16A34A', display: 'flex', alignItems: 'center', justifyContent: 'center', margin: '0 auto 18px' }}>
                  <I.Check style={{ width: 32, height: 32 }}/>
                </div>
                <h3 className="h3" style={{ marginBottom: 10 }}>سفارش شما ثبت شد</h3>
                <p style={{ fontSize: 14, color: 'var(--text-mute)' }}>تیم ما طی چند دقیقه با شما تماس می‌گیرد.</p>
                <button className="btn btn-outline" style={{ marginTop: 20 }} onClick={() => setSent(false)}>ثبت سفارش جدید</button>
              </div>
            ) : (
              <form onSubmit={(e) => { e.preventDefault(); setSent(true); }}>
                <h3 className="h3" style={{ marginBottom: 18 }}>ثبت سفارش رایگان</h3>
                <Field label="نام و نام خانوادگی" value={form.name} onChange={(v) => setForm({...form, name: v})} placeholder="نام شما"/>
                <Field label="شماره تماس" value={form.phone} onChange={(v) => setForm({...form, phone: v})} placeholder="۰۹۱۲۳۴۵۶۷۸۹"/>
                <div style={{ marginBottom: 14 }}>
                  <label style={{ display: 'block', fontSize: 13, fontWeight: 600, marginBottom: 6, color: 'var(--text-soft)' }}>سرویس مورد نظر</label>
                  <select className="input" value={form.service} onChange={(e) => setForm({...form, service: e.target.value})} style={{ fontFamily: 'var(--font)' }}>
                    {SERVICES.map(s => <option key={s.id} value={s.id}>{s.name}</option>)}
                  </select>
                </div>
                <Field label="مبلغ تقریبی (دلار)" value={form.amount} onChange={(v) => setForm({...form, amount: v})} placeholder="۱۰۰۰" type="number"/>
                <button type="submit" className="btn btn-primary btn-lg" style={{ width: '100%', marginTop: 8 }}>ارسال درخواست <I.ArrowLeft/></button>
                <p style={{ fontSize: 12, color: 'var(--text-mute)', marginTop: 12, textAlign: 'center' }}>اطلاعات شما کاملاً محرمانه باقی می‌ماند.</p>
              </form>
            )}
          </div>
        </div>
      </section>
    </main>
  );
}

function Field({ label, value, onChange, placeholder, type = 'text' }) {
  return (
    <div style={{ marginBottom: 14 }}>
      <label style={{ display: 'block', fontSize: 13, fontWeight: 600, marginBottom: 6, color: 'var(--text-soft)' }}>{label}</label>
      <input className="input" type={type} value={value} onChange={(e) => onChange(e.target.value)} placeholder={placeholder}/>
    </div>
  );
}

// ===== App =====
function App() {
  const [tweaks, setTweak] = useTweaks(TWEAK_DEFAULTS);
  const [route, setRoute] = useState('home');
  useEffect(() => {
    document.documentElement.dataset.theme = tweaks.dark ? 'dark' : 'light';
    document.documentElement.style.setProperty('--primary', tweaks.primary);
    document.documentElement.style.setProperty('--primary-deep', shade(tweaks.primary, -0.15));
  }, [tweaks.dark, tweaks.primary]);
  useEffect(() => { window.scrollTo(0, 0); }, [route]);
  return (
    <div>
      <Header route={route} setRoute={setRoute}/>
      {route === 'home' && <HomePage tweaks={tweaks} setRoute={setRoute}/>}
      {route === 'about' && <AboutPage setRoute={setRoute}/>}
      {route === 'blog' && <BlogPage setRoute={setRoute}/>}
      {route === 'contact' && <ContactPage/>}
      {SERVICES.map(s => s.id).includes(route) && <ServicePage id={route} setRoute={setRoute}/>}
      <Footer setRoute={setRoute}/>
      <TweaksPanel title="Tweaks">
        <TweakSection title="ظاهر">
          <TweakRadio label="چیدمان Hero" value={tweaks.heroLayout} onChange={(v) => setTweak('heroLayout', v)} options={[
            { value: 'split', label: 'دو ستونه' },
            { value: 'centered', label: 'مرکزی' },
            { value: 'editorial', label: 'مجله‌ای' },
          ]}/>
          <TweakRadio label="استایل کارت سرویس" value={tweaks.cardStyle} onChange={(v) => setTweak('cardStyle', v)} options={[
            { value: 'warm', label: 'گرم' },
            { value: 'minimal', label: 'مینیمال' },
            { value: 'gradient', label: 'گرادیان' },
          ]}/>
          <TweakToggle label="حالت تاریک" value={tweaks.dark} onChange={(v) => setTweak('dark', v)}/>
          <TweakColor label="رنگ اصلی" value={tweaks.primary} onChange={(v) => setTweak('primary', v)}/>
        </TweakSection>
      </TweaksPanel>
    </div>
  );
}

function shade(hex, percent) {
  const h = hex.replace('#', '');
  const r = parseInt(h.substring(0, 2), 16);
  const g = parseInt(h.substring(2, 4), 16);
  const b = parseInt(h.substring(4, 6), 16);
  const f = (x) => Math.max(0, Math.min(255, Math.round(x + x * percent)));
  return '#' + [f(r), f(g), f(b)].map(x => x.toString(16).padStart(2, '0')).join('');
}

ReactDOM.createRoot(document.getElementById('root')).render(<App/>);

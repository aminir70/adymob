/* AdyMob Elementor Widgets — front-end JS v1.0.0 */
(function () {
	'use strict';

	/* ── Calculator ─────────────────────────────────────────────────── */
	function initCalculator(el) {
		var rate = parseFloat(el.dataset.usdRate)      || 89500;
		var fees = {
			youtube: (parseFloat(el.dataset.feeYoutube) || 4)  / 100,
			admob:   (parseFloat(el.dataset.feeAdmob)   || 5)  / 100,
			adsense: (parseFloat(el.dataset.feeAdsense) || 6)  / 100,
		};

		var activeTab = el.dataset.defaultTab || 'youtube';
		var amount    = parseFloat(el.dataset.defaultAmount) || 1000;

		var tabs      = el.querySelectorAll('.adm-calc-tab');
		var numInput  = el.querySelector('.adm-calc-input');
		var rangeInput= el.querySelector('.adm-calc-range');
		var outGross  = el.querySelector('.adm-calc-gross');
		var outFeeRow = el.querySelector('.adm-calc-fee-row');
		var outFeeL   = el.querySelector('.adm-calc-fee-label');
		var outFee    = el.querySelector('.adm-calc-fee');
		var outNet    = el.querySelector('.adm-calc-net');

		function toFa(n) {
			return Math.round(n).toLocaleString('fa-IR');
		}

		function update() {
			var fee   = fees[activeTab] || 0.04;
			var gross = amount * rate;
			var feeAmt= gross * fee;
			var net   = gross - feeAmt;

			if (outGross) outGross.textContent = toFa(gross) + ' ت';
			if (outFee)   outFee.textContent   = '− ' + toFa(feeAmt) + ' ت';
			if (outFeeL)  outFeeL.textContent  = 'کارمزد (' + Math.round(fee * 100) + '٪)';
			if (outNet)   outNet.textContent   = toFa(net) + ' تومان';
		}

		tabs.forEach(function (tab) {
			if (tab.dataset.tab === activeTab) tab.classList.add('adm-active');
			tab.addEventListener('click', function () {
				tabs.forEach(function (t) { t.classList.remove('adm-active'); });
				tab.classList.add('adm-active');
				activeTab = tab.dataset.tab;
				update();
			});
		});

		if (numInput) {
			numInput.value = amount;
			numInput.addEventListener('input', function () {
				amount = parseFloat(this.value) || 0;
				if (rangeInput) rangeInput.value = amount;
				update();
			});
		}
		if (rangeInput) {
			rangeInput.value = amount;
			rangeInput.addEventListener('input', function () {
				amount = parseFloat(this.value) || 0;
				if (numInput) numInput.value = amount;
				update();
			});
		}

		update();
	}

	/* ── Contact / Order Form ───────────────────────────────────────── */
	function initContactForm(el) {
		var form    = el.querySelector('.adm-contact-form');
		var success = el.querySelector('.adm-contact-success');
		var errEl   = el.querySelector('.adm-contact-error');
		if (!form) return;

		form.addEventListener('submit', function (e) {
			e.preventDefault();

			var btn = form.querySelector('[type="submit"]');
			var origText = btn ? btn.textContent : '';
			if (btn) { btn.disabled = true; btn.textContent = 'در حال ارسال…'; }

			var fd = new FormData(form);
			fd.append('action', 'adymob_order');
			fd.append('nonce',  (window.admobData && window.admobData.nonce) || '');

			fetch((window.admobData && window.admobData.ajaxUrl) || '/wp-admin/admin-ajax.php', {
				method: 'POST',
				body: fd,
			})
				.then(function (r) { return r.json(); })
				.then(function (d) {
					if (d.success) {
						if (form)    form.style.display    = 'none';
						if (success) success.style.display = 'block';
						if (errEl)   errEl.style.display   = 'none';
					} else {
						if (errEl) {
							errEl.textContent  = (d.data && d.data.message) ? d.data.message : 'خطایی رخ داد.';
							errEl.style.display = 'block';
						}
						if (btn) { btn.disabled = false; btn.textContent = origText; }
					}
				})
				.catch(function () {
					if (errEl) {
						errEl.textContent  = 'خطا در ارتباط با سرور. لطفاً دوباره تلاش کنید.';
						errEl.style.display = 'block';
					}
					if (btn) { btn.disabled = false; btn.textContent = origText; }
				});
		});
	}

	/* ── Init ───────────────────────────────────────────────────────── */
	function initAll(root) {
		root = root || document;
		root.querySelectorAll('.adm-calculator').forEach(initCalculator);
		root.querySelectorAll('.adm-contact-widget').forEach(initContactForm);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', function () { initAll(); });
	} else {
		initAll();
	}

	/* Re-init inside Elementor editor/preview */
	window.addEventListener('elementor/frontend/init', function () {
		if (window.elementorFrontend) {
			elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
				initAll($scope[0]);
			});
		}
	});
}());

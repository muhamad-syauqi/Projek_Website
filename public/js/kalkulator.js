document.addEventListener('DOMContentLoaded', () => {
    const data = window.KALKULATOR;
    const form = document.getElementById('kalk-form');

    if (!data || !form) {
        return;
    }

    const guestsInput = document.getElementById('guests');
    const guestsRange = document.getElementById('guests-range');
    const rowsEl = document.getElementById('kalk-rows');
    const metaEl = document.getElementById('kalk-meta');
    const totalEl = document.getElementById('kalk-total');
    const waEl = document.getElementById('kalk-wa');
    const recoEl = document.getElementById('kalk-reco');

    const rupiah = (value) =>
        'Rp ' + new Intl.NumberFormat('id-ID').format(value);

    const clampGuests = (value) => {
        const number = parseInt(value, 10);

        if (Number.isNaN(number)) {
            return data.min_guests;
        }

        return Math.min(data.max_guests, Math.max(data.min_guests, number));
    };

    const checkedLabel = (name) => {
        const input = form.querySelector(`input[name="${name}"]:checked`);

        return input ? input.nextElementSibling.textContent.trim() : '-';
    };

    const readState = () => {
        const tiers = {};

        Object.keys(data.services).forEach((key) => {
            const input = form.querySelector(`input[name="tier[${key}]"]:checked`);
            tiers[key] = input ? input.value : data.services[key].default;
        });

        const addons = Array.from(
            form.querySelectorAll('input[name="addons[]"]:checked')
        ).map((input) => input.value);

        return {
            guests: clampGuests(guestsInput.value),
            tiers,
            addons,
        };
    };

    const calculate = (state) => {
        const lines = [];
        let total = 0;

        Object.entries(data.services).forEach(([key, service]) => {
            const tier = state.tiers[key];
            const unit = service.prices[tier];
            const amount = service.per_guest ? unit * state.guests : unit;

            lines.push({
                key,
                label: service.label,
                tier: data.tiers[tier],
                detail: service.per_guest
                    ? `${state.guests} × ${rupiah(unit)}`
                    : '',
                amount,
            });

            total += amount;
        });

        let addonsTotal = 0;
        const addonNames = [];

        state.addons.forEach((key) => {
            const addon = data.addons[key];

            if (addon) {
                addonsTotal += addon.price;
                addonNames.push(addon.label);
            }
        });

        total += addonsTotal;

        return { lines, addonsTotal, addonNames, total };
    };

    const makeRow = (title, note, amount) => {
        const row = document.createElement('div');
        row.className = 'kalk-row';

        const left = document.createElement('span');
        left.textContent = title;

        if (note) {
            const small = document.createElement('small');
            small.textContent = note;
            left.appendChild(small);
        }

        const right = document.createElement('b');
        right.textContent = rupiah(amount);

        row.append(left, right);

        return row;
    };

    const renderRecommendation = (total) => {
        if (!recoEl || !data.packages.length) {
            return;
        }

        const affordable = data.packages.filter((item) => item.price <= total);
        const pick = affordable.length
            ? affordable[affordable.length - 1]
            : data.packages[0];

        recoEl.replaceChildren();

        const label = document.createElement('small');
        label.textContent = 'Paket terdekat';

        const link = document.createElement('a');
        link.href = pick.url;
        link.textContent = pick.name;

        recoEl.append(
            label,
            link,
            document.createTextNode(` (${rupiah(pick.price)})`)
        );
        recoEl.hidden = false;
    };

    const update = () => {
        const state = readState();
        const result = calculate(state);

        // Harga tiap layanan di kartu pilihan
        result.lines.forEach((line) => {
            const cell = form.querySelector(`[data-price-for="${line.key}"]`);

            if (!cell) {
                return;
            }

            cell.textContent = rupiah(line.amount);

            if (line.detail) {
                const small = document.createElement('small');
                small.textContent = line.detail;
                cell.appendChild(small);
            }
        });

        // Ringkasan di sisi kanan
        metaEl.replaceChildren();
        [
            `${state.guests} tamu`,
            checkedLabel('concept'),
            checkedLabel('venue'),
            checkedLabel('duration'),
        ].forEach((text) => {
            const chip = document.createElement('span');
            chip.textContent = text;
            metaEl.appendChild(chip);
        });

        rowsEl.replaceChildren();
        result.lines.forEach((line) => {
            const note = line.detail
                ? `${line.tier} · ${line.detail}`
                : line.tier;

            rowsEl.appendChild(makeRow(line.label, note, line.amount));
        });

        if (result.addonNames.length) {
            rowsEl.appendChild(
                makeRow(
                    'Layanan tambahan',
                    result.addonNames.join(', '),
                    result.addonsTotal
                )
            );
        }

        totalEl.textContent = rupiah(result.total);
        renderRecommendation(result.total);

        // Slider mengikuti jumlah tamu
        const rangeMin = Number(guestsRange.min);
        const rangeMax = Number(guestsRange.max);
        const rangeValue = Math.min(rangeMax, Math.max(rangeMin, state.guests));

        guestsRange.value = rangeValue;
        guestsRange.style.setProperty(
            '--pct',
            `${((rangeValue - rangeMin) / (rangeMax - rangeMin)) * 100}%`
        );

        // Tautan WhatsApp
        if (waEl) {
            const message = [
                'Halo Fahira Wedding, saya sudah mencoba Wedding Calculator.',
                `Jumlah tamu: ${state.guests}`,
                `Konsep: ${checkedLabel('concept')}`,
                `Total estimasi: ${rupiah(result.total)}`,
                'Mohon info lebih lanjut.',
            ].join('\n');

            waEl.href =
                `https://wa.me/${data.whatsapp}?text=${encodeURIComponent(message)}`;
        }
    };

    // Jumlah tamu: tombol +/-, kolom angka, dan slider
    form.querySelectorAll('[data-guest-step]').forEach((button) => {
        button.addEventListener('click', () => {
            guestsInput.value = clampGuests(
                clampGuests(guestsInput.value) + Number(button.dataset.guestStep)
            );
            update();
        });
    });

    guestsInput.addEventListener('input', update);
    guestsInput.addEventListener('blur', () => {
        guestsInput.value = clampGuests(guestsInput.value);
        update();
    });

    guestsRange.addEventListener('input', () => {
        guestsInput.value = guestsRange.value;
        update();
    });

    form.addEventListener('change', update);

    // Enter di kolom jumlah tamu tidak langsung mengirim form
    guestsInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            guestsInput.blur();
        }
    });

    form.addEventListener('submit', () => {
        guestsInput.value = clampGuests(guestsInput.value);
    });

    // Indikator langkah mengikuti bagian yang sedang dilihat
    const stepEls = Array.from(document.querySelectorAll('.kalk-step'));
    const stepLines = Array.from(document.querySelectorAll('.kalk-step-line'));
    const sections = stepEls
        .map((step) => document.querySelector(step.getAttribute('href')))
        .filter(Boolean);

    const setStep = (index) => {
        stepEls.forEach((step, i) => {
            step.classList.toggle('is-done', i < index);
            step.classList.toggle('is-current', i === index);
        });

        stepLines.forEach((line, i) => {
            line.classList.toggle('is-done', i < index);
        });
    };

    if ('IntersectionObserver' in window && sections.length) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        setStep(sections.indexOf(entry.target));
                    }
                });
            },
            { rootMargin: '-35% 0px -55% 0px' }
        );

        sections.forEach((section) => observer.observe(section));
    }

    setStep(0);
    update();
});
document.addEventListener('DOMContentLoaded', () => {
    const data = window.KALKULATOR;
    const form = document.getElementById('kw-form');

    if (!data || !form) {
        return;
    }

    const rupiah = (value) =>
        'Rp ' + new Intl.NumberFormat('id-ID').format(value);

    const clampGuests = (value) => {
        const number = parseInt(value, 10);

        if (Number.isNaN(number)) {
            return data.min_guests;
        }

        return Math.min(data.max_guests, Math.max(data.min_guests, number));
    };

    // Total dihitung dari pilihan tersimpan, lalu ditimpa pilihan di form ini
    const calculate = () => {
        const saved = data.state;
        const guestsInput = document.getElementById('guests');

        const guests = guestsInput
            ? clampGuests(guestsInput.value)
            : Number(saved.guests);

        let total = 0;

        Object.entries(data.services).forEach(([key, service]) => {
            const checked = form.querySelector(`input[name="tier[${key}]"]:checked`);
            const tier = checked ? checked.value : saved.tier[key];
            const unit = service.prices[tier];

            total += service.per_guest ? unit * guests : unit;
        });

        const boxes = form.querySelectorAll('input[name="addons[]"]');
        const addons = boxes.length
            ? Array.from(boxes).filter((box) => box.checked).map((box) => box.value)
            : saved.addons;

        let addonsTotal = 0;

        addons.forEach((key) => {
            if (data.addons[key]) {
                addonsTotal += data.addons[key].price;
            }
        });

        return { guests, total: total + addonsTotal, addons, addonsTotal };
    };

    const setText = (id, text) => {
        const element = document.getElementById(id);

        if (element) {
            element.textContent = text;
        }
    };

    const checkedValue = (name) => {
        const input = form.querySelector(`input[name="${name}"]:checked`);

        return input ? input.value : '';
    };

    // ---------- Langkah 1 ----------
    const guestsInput = document.getElementById('guests');
    const guestsRange = document.getElementById('guests-range');

    if (guestsInput && guestsRange) {
        const syncGuests = () => {
            const guests = clampGuests(guestsInput.value);
            const min = Number(guestsRange.min);
            const max = Number(guestsRange.max);
            const position = Math.min(max, Math.max(min, guests));

            guestsRange.value = position;
            guestsRange.style.setProperty(
                '--pct',
                `${((position - min) / (max - min)) * 100}%`
            );

            setText(
                'kw-summary',
                [
                    `${guests} tamu`,
                    data.concepts[checkedValue('concept')],
                    data.venues[checkedValue('venue')],
                ].join(' · ')
            );
        };

        form.querySelectorAll('[data-guest-step]').forEach((button) => {
            button.addEventListener('click', () => {
                guestsInput.value = clampGuests(
                    clampGuests(guestsInput.value) + Number(button.dataset.guestStep)
                );
                syncGuests();
            });
        });

        guestsInput.addEventListener('input', syncGuests);
        guestsInput.addEventListener('blur', () => {
            guestsInput.value = clampGuests(guestsInput.value);
            syncGuests();
        });

        guestsInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                guestsInput.blur();
            }
        });

        guestsRange.addEventListener('input', () => {
            guestsInput.value = guestsRange.value;
            syncGuests();
        });

        form.addEventListener('change', syncGuests);
        form.addEventListener('submit', () => {
            guestsInput.value = clampGuests(guestsInput.value);
        });

        syncGuests();
    }

    // ---------- Langkah 2 dan 3 ----------
    if (document.getElementById('kw-total')) {
        const update = () => {
            const result = calculate();

            setText('kw-total', rupiah(result.total));
            setText('kw-addon-count', `${result.addons.length} dipilih`);
            setText('kw-addon-total', rupiah(result.addonsTotal));
        };

        form.addEventListener('change', update);
        update();
    }
});
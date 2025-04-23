function getCurrentTimeInNetherlands() {
    const now = new Date();
    const amsterdamTimeZone = 'Europe/Amsterdam';
    const amsterdamTime = new Date(now.toLocaleString('en-US', { timeZone: amsterdamTimeZone }));

    const options = {
        hour: 'numeric',
        minute: 'numeric',
        hour12: false,
    };

    const formattedTime = amsterdamTime.toLocaleString('nl-NL', options);

    return formattedTime;
}

document.onload = changeCurrentDateOnDateInput();

function changeCurrentDateOnDateInput() {
    const now = new Date()
    document.getElementById('date').value = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
}

document.addEventListener('DOMContentLoaded', async () => {
    document.getElementById('date').value = (new Date()).toISOString().split('T')[0];

    if(typeof Storage === 'undefined') return;

    const user = localStorage.getItem('name_id');
    if(user) {
        document.getElementById('name').value = user;
    }
});

function changeStartTime() {
    document.getElementById('start_time').value = getCurrentTimeInNetherlands();
}

function changeEndTime() {
    document.getElementById('end_time').value = getCurrentTimeInNetherlands();
}

function isNightTime(time) {
    const [hours, minutes] = time.split(':').map(Number);

    return hours >= 0o0 || hours < 6;
}

function onFormSubmit(event) {
    if (document.getElementById('start_time').value === document.getElementById('end_time').value) {
        document.getElementById('toastBodyError').textContent = 'Start tijd en eind tijd mag niet hetzelfde zijn!';
        (new bootstrap.Toast(document.getElementById('liveToastError'))).show();

        event.preventDefault();
    }

    if (document.getElementById('start_time').value > document.getElementById('end_time').value) {
        document.getElementById('toastBodyError').textContent = 'Start tijd mag niet later zijn dan de eind tijd!';
        (new bootstrap.Toast(document.getElementById('liveToastError'))).show();

        event.preventDefault();
    }

    if (isNightTime(document.getElementById('start_time').value)) {
        document.getElementById('toastBodyError').textContent = 'Start tijd mag niet in de nacht zijn!';
        (new bootstrap.Toast(document.getElementById('liveToastError'))).show();

        event.preventDefault();
    }

    localStorage.setItem('name', document.getElementById('name').value);
}

document.addEventListener('DOMContentLoaded', async () => {
    document.getElementById('name').value = localStorage.getItem('name');

    if (localStorage.getItem('name')) {
        document.getElementById('nameHelp').hidden = true;
    }

    if (localStorage.getItem('validatedUser')) {
        document.getElementById('rechapcha_custom').value = Number(localStorage.getItem('validatedUser'));
        document.getElementById('rechapcha').hidden = true;
    } else {
        document.getElementById('rechapcha').hidden = false;
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const modelTypeSelect = document.getElementById('model_type');
    const powerTypeSelect = document.getElementById('power_type');
    const zeroWOption = powerTypeSelect.querySelector('option[value="4"]');

    modelTypeSelect.addEventListener('change', function () {
        if (modelTypeSelect.value === '2') {
            zeroWOption.hidden = false;
        } else {
            zeroWOption.hidden = true;
        }
    });
});

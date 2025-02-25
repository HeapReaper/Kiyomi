if (document.body.dataset.sessionSuccess) {
    localStorage.setItem('validatedUser', '4');
}

function getCurrentTimeInNetherlands() {
    const now = new Date();
    const amsterdamTimeZone = 'Europe/Amsterdam';
    const amsterdamTime = new Date(now.toLocaleString('en-US', { timeZone: amsterdamTimeZone }));

    const options = {
        hour: 'numeric',
        minute: 'numeric',
        hour12: false,
    };

    return amsterdamTime.toLocaleString('nl-NL', options);
}

function changeCurrentDateOnDateInput() {
    const now = new Date();
    document.getElementById('date').value = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
}

// Set date input value on page load
// Manage ReCaptcha
// Hide name help text if name is filled in
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('date').value = (new Date()).toISOString().split('T')[0];

    if (typeof Storage !== 'undefined') {
        const user = localStorage.getItem('name_id');
        if(user) {
            document.getElementById('name').value = user;
        }
    }

    // Manage ReCaptcha behavior
    if (localStorage.getItem('validatedUser')) {
        document.getElementById('rechapcha_custom').value = Number(localStorage.getItem('validatedUser'));
        document.getElementById('rechapcha').hidden = true;
    } else {
        document.getElementById('rechapcha').hidden = false;
    }

    if (localStorage.getItem('name')) {
        document.getElementById('nameHelp').style.display = 'none';
    }
});

function changeStartTime() {
    document.getElementById('start_time').value = getCurrentTimeInNetherlands();
}

function changeEndTime() {
    document.getElementById('end_time').value = getCurrentTimeInNetherlands();
}

// Function to store name in localStorage
function setName() {
    localStorage.setItem('name', document.getElementById('name').value);
}

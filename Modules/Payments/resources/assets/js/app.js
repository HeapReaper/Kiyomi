document.addEventListener('DOMContentLoaded', () => {
    console.log('Changing current date...');
    document.getElementById('date').value = (new Date()).toISOString().split('T')[0];
});

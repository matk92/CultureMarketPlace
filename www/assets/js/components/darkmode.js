const selectors = ['body', 'footer', 'nav', '.dropdown-content.show, .card'];

function toggleDarkMode() {
    selectors.forEach((selector) => {
        const element = document.querySelector(selector);
        if (element) {
            element.classList.toggle('dark-mode');
        }
    });
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}

function loadDarkMode() {
    if (localStorage.getItem('darkMode') === 'true') {
        selectors.forEach((selector) => {
            const element = document.querySelector(selector);
            if (element) {
                element.classList.add('dark-mode');
            }
        });
    }
}

document.getElementById('toggle-dark-mode').addEventListener('click', toggleDarkMode);
window.addEventListener('load', loadDarkMode);
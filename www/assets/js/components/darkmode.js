const selectors = ['body', 'footer', 'nav', '.dropdown-content', '.card','.viewProductAdmin','.comment_card','.table-users-list tr:nth-child(even)', '.homepage-content',];

function toggleDarkMode() {
    selectors.forEach((selector) => {
        const elements = document.querySelectorAll(selector);
        elements.forEach((element) => {
            element.classList.toggle('dark-mode');
        });
    });
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}

function loadDarkMode() {
    if (localStorage.getItem('darkMode') === 'true') {
        selectors.forEach((selector) => {
            const elements = document.querySelectorAll(selector);
            elements.forEach((element) => {
                element.classList.add('dark-mode');
            });
        });
    }
}

document.getElementById('toggle-dark-mode').addEventListener('click', toggleDarkMode);
window.addEventListener('load', loadDarkMode);
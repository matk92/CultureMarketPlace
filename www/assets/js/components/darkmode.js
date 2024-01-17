const toggleDarkMode = document.querySelector('#toggle-dark-mode');
const icon = toggleDarkMode.querySelector('i');


if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
    icon.classList.remove('fa-sun');
    icon.classList.add('fa-moon');
}

toggleDarkMode.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');


    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    } else {
        localStorage.setItem('darkMode', 'disabled');
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    }
});
const links = document.querySelectorAll('nav a');

links.forEach(link => {
  if (link.href === window.location.href) {
    link.classList.add('active');
  }
});

document.querySelector('.chevron-double-home a').addEventListener('click', function(event) {
  event.preventDefault();
  document.querySelector('#title-homepage').scrollIntoView({ behavior: 'smooth' });
});
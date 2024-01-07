<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>CulturalMarketPlace - Security</title>
  <link rel="stylesheet" href="assets/scss/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/ba814b6b43.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="security">
  <main>
    <?php include $this->view; ?>
  </main>

  <script>
    const links = document.querySelectorAll('nav a');

    links.forEach(link => {
      if (link.href === window.location.href) {
        link.classList.add('active');
      }
    });
  </script>
</body>
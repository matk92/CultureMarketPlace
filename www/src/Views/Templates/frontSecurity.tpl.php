<?php $json = file_get_contents(__DIR__ . '/../Main/home.json');
$data = json_decode($json, true); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title><?php echo $data['site-name']?> - Security</title>
  <link rel="stylesheet" href="/dist/css/style.css">
  <link rel="icon" href="/assets/images/<?php echo htmlspecialchars($data['site-favicon'])?>">
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
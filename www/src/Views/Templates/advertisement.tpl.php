<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Hey !</title>
    <link rel="stylesheet" href="/dist/css/style.css">
    <link rel="icon" href="/assets/images/<?php echo $data['site-favicon']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="advertisement-body">
    <main class="advertisement">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="120px" height="120px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        <?php include $this->view; ?>
    </main>
</body>

</html>
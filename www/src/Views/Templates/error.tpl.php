<?php $json = file_get_contents(__DIR__ . '/../Main/home.json');
$data = json_decode($json, true); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($data['site-name'])?> - Error 404</title>
    <link rel="stylesheet" href="/dist/css/style.css">
    <link rel="icon" href="/assets/images/<?php echo $data['site-favicon']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="error">
    <main>
        <section>
	        <div class="content-error">
		        <h2>404</h2>
		        <h2>404</h2>
	        </div>
        </section>
    </main>
</body>
</html>

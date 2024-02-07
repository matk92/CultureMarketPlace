<?php if (isset($_SESSION['settings_success'])): ?>
    <div id="alert" class="alert alert-success">
        <p><?php echo $_SESSION['settings_success']; ?></p>
    </div>
    <?php unset($_SESSION['settings_success']); ?>
<?php endif; ?>

<h1>settings</h1>

<form action="frameworksettings" method="post" id="settingsForm" enctype="multipart/form-data" class="form-settings">
    <h2>Informations générales</h2>

    <label for="site-name">Nom du site</label>
    <input type="text" id="site-name" name="site-name" class="input" value="<?php echo $data['site-name']?>">

    <label for="site-subtitle">Sous-titre du site</label>
    <input type="text" id="site-subtitle" name="site-subtitle" class="input" value="<?php echo $data['site-subtitle']?>">

    <label for="site-favicon">Favicon</label>
    <img id="faviconPreview" src="/assets/images/<?php echo $data['site-favicon']; ?>" alt="Image" style="max-width: 50px; height: auto; margin-bottom: 5px;">
    <input type="file" id="site-favicon" name="site-favicon" accept=".ico, .png, .jpg, .jpeg">

    <label for="site-background-image">Image du header</label>
    <img src="/assets/images/<?php echo $data['site-background-image']; ?>" alt="Image" style="max-width: 300px; height: auto; margin-bottom: 5px;">
    <input type="file" id="site-background-image" name="site-background-image" accept=".png, .jpg, .jpeg">
    
    <h2>Couleurs</h2>

    <label for="background-color">Couleur principale</label>
    <input type="color" id="background-color" name="background-color" value="#000000">

    <label for="background-color2">Couleur secondaire</label>
    <input type="color" id="background-color2" name="background-color2" value="#000000">

    <label for="title-color">Couleur du titre home</label>
    <input type="color" id="title-color" name="title-color" value="#000000">

    <label for="subtitle-color">Couleur du sous-titre home</label>
    <input type="color" id="subtitle-color" name="subtitle-color" value="#000000">

    <label for="nav-color">Couleur de la navbar</label>
    <input type="color" id="nav-color" name="nav-color" value="#000000">

    <h2>Footer</h2>

    <label for="footer-text">Texte du footer</label>
    <textarea id="footer-text" name="footer-text"><?php echo $data['footer-text']?></textarea>
        
    <label for="footer-color">Couleur du footer</label>
    <input type="color" id="footer-color" name="footer-color" value="#000000">
    
    <h2>Réseaux sociaux</h2>

    <label for="facebook-url">URL de Facebook</label>
    <input type="url" id="facebook-url" name="facebook-url" class="input" value="<?php echo $data['footer-facebook']?>">

    <label for="twitter-url">URL de Twitter</label>
    <input type="url" id="twitter-url" name="twitter-url" class="input" value="<?php echo $data['footer-twitter']?>">

    <label for="instagram-url">URL de Instagram</label>
    <input type="url" id="instagram-url" name="instagram-url" class="input" value="<?php echo $data['footer-facebook']?>">

    <h2>Page home</h2>

    <label for="home-text1">Texte image "Passez votre commande"</label>
    <textarea id="home-text1" name="home-text1"><?php echo $data['home-text1']?></textarea>

    <label for="home-text2">Texte image "Faites vous livrez"</label>
    <textarea id="home-text2" name="home-text2"><?php echo $data['home-text2']?></textarea>

    <label for="home-text3">Texte image "Recevez votre commande"</label>
    <textarea id="home-text3" name="home-text3"><?php echo $data['home-text3']?></textarea>
    
    <label for="home-discover-image">Image "Découvrir"</label>
    <img src="/assets/images/<?php echo $data['home-discover-image']; ?>" alt="Image" style="max-width: 300px; height: auto; margin-bottom: 5px;">
    <input type="file" id="home-discover-image" name="home-discover-image" accept=".ico, .png, .jpg, .jpeg">
    
    <label for="home-discover-text">Texte image "Découvrir"</label>
    <textarea id="home-discover-text" name="home-discover-text"><?php echo $data['home-discover-text']?></textarea>

    <label for="home-discover-color">Couleur du texte "Découvrir"</label>
    <input type="color" id="home-discover-color" name="home-discover-color" value="#000000">

    <input type="submit" class="button button-primary" style="width: 250px;" value="Enregistrer">
    <button class="button button-secondary" id="cancelButton" style="width: 250px; margin-top: 10px;"><i class="fa-solid fa-rotate-left"></i> Annuler les changements</button>
</form>

<script>
    document.getElementById('cancelButton').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('settingsForm').reset();
    });
    
    setTimeout(function() {
        var alert = document.getElementById('alert');
        if (alert) alert.parentNode.removeChild(alert);
    }, 5000);
</script>
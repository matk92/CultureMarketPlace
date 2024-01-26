<h1>settings</h1>

<form action="path_to_your_controller_method" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Informations générales</legend>

        <label for="site-name">Nom du site :</label>
        <input type="text" id="site-name" name="site-name" value="<?php echo $data['site-name']?>">

        <label for="header-image">Image du header :</label>
        <input type="file" id="header-image" name="header-image">
    </fieldset>

    <fieldset>
        <legend>Couleurs</legend>

        <label for="primary-color">Couleur principale :</label>
        <input type="color" id="primary-color" name="primary-color" value="#000000">

        <label for="secondary-color">Couleur secondaire :</label>
        <input type="color" id="secondary-color" name="secondary-color" value="#000000">

        <label for="title-color">Couleur du titre home :</label>
        <input type="color" id="title-color" name="title-color" value="#000000">

        <label for="subtitle-color">Couleur du sous-titre home :</label>
        <input type="color" id="subtitle-color" name="subtitle-color" value="#000000">


    </fieldset>

    <fieldset>
        <legend>Footer</legend>

        <label for="footer-text">Texte du footer :</label>
        <textarea id="footer-text" name="footer-text"><?php echo $data['footer-text']?></textarea>
        
        <label for="footer-color">Couleur du footer :</label>
        <input type="color" id="footer-color" name="footer-color" value="#000000">
    
    </fieldset>

    <fieldset>
        <legend>Réseaux sociaux</legend>

        <label for="facebook-url">URL de Facebook :</label>
        <input type="url" id="facebook-url" name="facebook-url" value="<?php echo $data['footer-facebook']?>">

        <label for="twitter-url">URL de Twitter :</label>
        <input type="url" id="twitter-url" name="twitter-url" value="<?php echo $data['footer-twitter']?>">

        <label for="instagram-url">URL de Instagram :</label>
        <input type="url" id="instagram-url" name="instagram-url" value="<?php echo $data['footer-facebook']?>">

    </fieldset>
    
    <fieldset>
        <legend>Page home</legend>

        <label for="home-text1">Texte image "Passez votre commande" :</label>
        <textarea id="home-text1" name="home-text1"><?php echo $data['home-text1']?></textarea><br />

        <label for="home-text2">Texte image "Passez votre commande" :</label>
        <textarea id="home-text2" name="home-text2"><?php echo $data['home-text2']?></textarea><br />

        <label for="home-text3">Texte image "Passez votre commande" :</label>
        <textarea id="home-text3" name="home-text3"><?php echo $data['home-text3']?></textarea><br />

        <label for="home-discover-image">Image du header :</label>
        <input type="file" id="home-discover-image" name="home-discover-image"><br />

        <label for="home-discover-text">Texte image "Passez votre commande" :</label>
        <textarea id="home-discover-text" name="home-discover-text"><?php echo $data['home-discover-text']?></textarea><br />

    </fieldset>

    <input type="submit" class="button button-primary" value="Enregistrer">
</form>
<h1>settings</h1>

<form action="path_to_your_controller_method" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Informations générales</legend>

        <label for="site-name">Nom du site :</label>
        <input type="text" id="site-name" name="site-name" value="Nom actuel du site">

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
        <textarea id="footer-text" name="footer-text">Texte actuel du footer</textarea>
        
        <label for="footer-color">Couleur du footer :</label>
        <input type="color" id="footer-color" name="footer-color" value="#000000">
    
    </fieldset>

    <fieldset>
        <legend>Réseaux sociaux</legend>

        <label for="facebook-url">URL de Facebook :</label>
        <input type="url" id="facebook-url" name="facebook-url" value="https://www.facebook.com/">

        <label for="twitter-url">URL de Twitter :</label>
        <input type="url" id="twitter-url" name="twitter-url" value="https://twitter.com/">

        <label for="instagram-url">URL de Instagram :</label>
        <input type="url" id="instagram-url" name="instagram-url" value="https://www.instagram.com/">

    </fieldset>

    <input type="submit" class="button button-primary" value="Enregistrer">
</form>
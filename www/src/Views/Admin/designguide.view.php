<h1>Design Guide</h1>

<section>
    <h2>Boutons</h2>
    <button type="button" class="button">Bouton par défaut</button>
    <button type="button" class="button button-primary">Bouton primaire</button>
    <button type="button" class="button button-secondary">Bouton secondaire</button>
    <button type="button" class="button button-danger">Bouton danger</button>
    <button type="button" class="button button-outline" style="border-color: black;color: black;">Bouton outline</button>
</section>

<section>
    <h2>Bannières</h2>
    <div class="banner banner--text" style="background-image: url('../../assets/images/<?php echo ($data['site-background-image']) ?>')">
	</div>
</section>

<section>
    <h2>Cartes</h2>
    <div class="card ">
        <img src="../../assets/images/cerveza.png" alt="Description de l'image">
        <h1>Product</h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
            standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        <div class="card-bottom">
            <p>7€</p>
            <a href="#">Voir plus</a>
        </div>
    </div>
</section>

<section>
    <h2>Alertes</h2>
    <div class="alert alert-danger">
        <p>Ceci est une alerte de type danger</p>
    </div>
    <div class="alert alert-success">
        <p>Ceci est une alerte de type succès</p>
    </div>
    <div class="alert alert-info">
        <p>Ceci est une alerte de type info</p>
    </div>
</section>

<section>
    <h2>Inputs</h2>
    <input type="text" class="input" placeholder="Input texte">
    <input type="file" class="input">
    <input type="color" class="input">
</section>

<section>
    <h2>Barre de recherche</h2>
    <input type="search" class="searchbar" style="height: 50px"placeholder="Recherche...">
</section>

<section>
    <h2>Spinner</h2>
    <div class="spinner"></div>
</section>

<section>
    <h2>Font</h2>
    <div style="font-family: 'Inter', sans-serif; font-size: 2rem;">Ceci est un texte avec la police Inter</div>
    <div style="font-family: 'Poppins', sans-serif; font-size: 2rem;">Ceci est un texte avec la police Poppins</div>
    <div style="font-family: 'Raleway', sans-serif; font-size: 2rem;">Ceci est un texte avec la police Raleway</div>
    <div style="font-family: 'Arvo', sans-serif; font-size: 2rem;">Ceci est un texte avec la police Arvo</div>
</section>    
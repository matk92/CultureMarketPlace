<style> 
    body {
        background-color: <?php echo $data['background-color']?>;
    }
</style>

<div class="homepage-content">
    <h1 class="homepage" id="title-homepage">Découvrez qui nous sommes</h1>
    <div class="homepage-content-text">
        <p>Le site de la société <strong><?php echo $data['site-name']?></strong> a été créé dans le cadre d'un projet de formation. Il a pour but de présenter les produits de la société et de permettre aux utilisateurs de les acheter.</p>
        <p>La société <strong><?php echo $data['site-name']?></strong> est une entreprise fictive ainsi que les produits présentés sur le site.</p>
    </div>
    <div class="homepage-content-img">
        <div class="img-text">
            <img src="/assets/images/order.png" alt="order">
            <h2>Passez votre commande</h2>
            <p><?php echo $data['home-text1']?></p>
        </div>
        <div class="img-text">
            <img src="assets/images/delivery.png" alt="delivery">
            <h2>Faites vous livrez</h2>
            <p><?php echo $data['home-text2']?></p>
        </div>
        <div class="img-text">
            <img src="assets/images/receive.png" alt="receive">
            <h2>Recevez votre commande</h2>
            <p><?php echo $data['home-text3']?></p>
        </div>
    </div>
    <div class="discover-products">
        <img src="assets/images/<?php echo $data['home-discover-image']; ?>" alt="discover products">
        <div class="discover-products-text">
            <h2>Découvrez nos produits</h2>
            <p><?php echo $data['home-discover-text']?></p>
            <div class="button button-outline">
                <a href="products">Découvrir</a>
            </div>
        </div>
    </div>
</div>
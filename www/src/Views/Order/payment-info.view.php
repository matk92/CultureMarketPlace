<div class="billing-details">
    <div class="section-title">
        <h2 class="title-order">Procédure de paiement</h2>
    </div>
    <hr>
    <div class="stepper-order">
        <div class="previous-button">
            <a href="/orders" class="button-order-previous">Mon panier</a>
        </div>
        <div class="step">
            <div class="step-number">
                <p>1</p>
            </div>
            <div class="step-title">
                <p>Mon panier</p>
            </div>
        </div>
        <div class="step">
            <div class="step-number active">
                <p>2</p>
            </div>
            <div class="step-title">
                <p>Méthode de paiement</p>
            </div>
        </div>
        <div class="step">
            <div class="step-number">
                <p>3</p>
            </div>
            <div class="step-title">
                <p>Récapitulatif de la commande</p>
            </div>
        </div>
        <div class="next-button">
            <a href="/orders/summary" class="button-order-next">Valider la commande</a>
        </div>
    </div>
</div>
<main class="main-order">
    <div class="left-order">
        <?php $this->modal("form", $form) ?>

        <div class="fast-payment">
            <h2>Paiement rapide</h2>
            <input type="image" id="shoppay" name="payment_method" class="payment_image" src="../assets/images/shoppay.jpg" alt="ShopPay">
            <input type="image" id="applepay" name="payment_method" class="payment_image" src="../assets/images/applepay.png" alt="Apple Pay">
            <input type="image" id="paypal" name="payment_method" class="payment_image" src="../assets/images/paypal.png" alt="PayPal">
        </div>
    </div>

</main>
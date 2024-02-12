<div class="billing-details">
    <div class="section-title">
        <h2 class="title-order">Procédure de paiement</h2>
    </div>
    <hr>
    <div class="stepper-order">
        <a href="/orders" class="step">
            <div class="step-number">
                <p>1</p>
            </div>
            <div class="step-title">
                <p>Mon panier</p>
            </div>
        </a>
        <a href="/orders/payment-info" class="step">
            <div class="step-number active">
                <p>2</p>
            </div>
            <div class="step-title">
                <p>Méthode de paiement</p>
            </div>
        </a>
        <a href="/orders/summary" class="step">
            <div class="step-number">
                <p>3</p>
            </div>
            <div class="step-title">
                <p>Récapitulatif de la commande</p>
            </div>
        </a>
    </div>
</div>
<div class="main-order">
    <div class="left-order">
        <?php isset($form) && $this->modal("form", $form) ?>

        <div class="fast-payment">
            <h2>Paiement rapide</h2>
            <input type="image" id="shoppay" name="payment_method" class="payment_image" src="../assets/images/shoppay.jpg" alt="ShopPay">
            <input type="image" id="applepay" name="payment_method" class="payment_image" src="../assets/images/applepay.png" alt="Apple Pay">
            <input type="image" id="paypal" name="payment_method" class="payment_image" src="../assets/images/paypal.png" alt="PayPal">
        </div>
    </div>

</div>

<hr />
<div class="row">
    <a class="button button-secondary" href="/orders">
        Précédent
    </a>
</div>
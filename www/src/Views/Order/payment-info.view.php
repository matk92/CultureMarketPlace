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
        <form class="delivery-payment-address-form">
            <h2>Adresse de livraison</h2>
            <label for="last_name">Nom</label>
            <input type="text" id="last_name" name="last_name" required>
            <label for="first_name">Prénom</label>
            <input type="text" id="first_name" name="first_name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" required>
            <label for="country">Pays</label>
            <input type="text" id="country" name="country" required>
            <label for="city">Ville</label>
            <input type="text" id="city" name="city" required>
            <label for="postal_code">Code postal</label>
            <input type="text" id="postal_code" name="postal_code" required>
            <label for="phone">Téléphone</label>
            <input type="text" id="phone" name="phone" required>
            <h2>Méthode de paiement</h2>
            <label for="card_number">Numéro de carte</label>
            <input type="text" id="card_number" name="card_number" required>
            <label for="card_holder">Nom du titulaire</label>
            <input type="text" id="card_holder" name="card_holder" required>
            <label for="expiration_date">Date d'expiration</label>
            <input type="text" id="expiration_date" name="expiration_date" required>
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" required>
        </form>

        <div class="fast-payment">
            <h2>Paiement rapide</h2>
            <input type="image" id="shoppay" name="payment_method" class="payment_image" src="../assets/images/shoppay.jpg" alt="ShopPay">
            <input type="image" id="applepay" name="payment_method" class="payment_image" src="../assets/images/applepay.png" alt="Apple Pay">
            <input type="image" id="paypal" name="payment_method" class="payment_image" src="../assets/images/paypal.png" alt="PayPal">
        </div>
    </div>

    <div class="order-summary">
        <h2>Récapitulatif de la commande</h2>
        <div class="product-order">
            <img src="../assets/images/cerveza.png" alt="product-1">
                <p>Cerveza espanol</p>
                <p>Quantité : 2</p>
                <p>Prix unité : 7€</p>
                <p>Prix total : 14€</p>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357
                     15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 
                     1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05
                     6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75
                     0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                </svg>

        </div>
        <hr>
        <div class="discount-code">
            <input type="text" id="discount_code" name="discount_code" placeholder="Code promo">
            <button type="submit" class="button button-primary">Appliquer</button>
        </div>
        <hr>
        <div class="total-order">
            <p>Sous-total : 14€</p>
            <p>Remise : 2€</p>
            <p>Frais de livraison : 1€</p>
            <hr>
            <h3>Montant total : 17€</h3>
        </div>
        <button type="submit" class="button">Valider la commande</button>
    </div>

</main>
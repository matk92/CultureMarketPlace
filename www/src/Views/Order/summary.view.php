<div class="billing-details">
    <div class="section-title">
        <h2 class="title-order">Récapitulatif de la commande</h2>
    </div>
    <hr>
    <div class="stepper-order">
        <div class="previous-button">
            <a href="/orders/payment-info" class="button-order-previous">Méthode de paiement</a>
        </div>
        <div class="step">
            <div class="step-number">
                <p>1</p>
            </div>
            <div class="step-title">
                <p>Adresse de livraison</p>
            </div>
        </div>
        <div class="step">
            <div class="step-number">
                <p>2</p>
            </div>
            <div class="step-title">
                <p>Méthode de paiement</p>
            </div>
        </div>
        <div class="step">
            <div class="step-number active">
                <p>3</p>
            </div>
            <div class="step-title">
                <p>Récapitulatif de la commande</p>
            </div>
        </div>
        <div class="next-button">
            <button type="submit" class="button">Valider la commande</button>
        </div>
    </div>
</div>
<div class="main-summary">
    <div class="summary">
        <h1>Tout est prêt pour votre commande !</h1>
        <hr />
        <div class="summary-order">
            <div class="summary-order-left">
                <h2>Veuilez confirmer les produits de votre achat:</h2>
                <div class="summary-order-details">
                    <p>Nom</p>
                    <p>Total</p>
                </div>
                <hr>
                <p>Pour continuer avec votre achat veuillez lire et accepter les <a href="/">politiques de remboursement</a> et les <a href="/">conditions généraux de vente</a></p>
                <input type="checkbox" id="refund" name="refund" required>
                <label for="policies">J’a lu et j’accepte les politiques de remboursement</label>
                <br />
                <input type="checkbox" id="sales" name="sales" required>
                <label for="policies">J’a lu et j’accepte les conditions générales de vente</label>
                <br />
                <button type="submit" class="button">Valider la commande</button>
            </div>
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
    </div>
</div>


<div class="billing-details">
    <div class="section-title">
        <h2 class="title-order">Récapitulatif</h2>
    </div>
    <hr>
    <div class="stepper-order">
        <div class="previous-button">
            <a href="/orders/payment-info" class="button-order-previous">Précédent</a>
        </div>
            <div class="stepper-wrapper">
                <div class="stepper-item active">
                    <div class="step-counter">1</div>
                    <div class="step-name">Mon panier</div>
                </div>
                <div class="stepper-item completed">
                    <div class="step-counter">2</div>
                    <div class="step-name">Procédure de paiement</div>
                </div>
                <div class="stepper-item active">
                    <div class="step-counter">3</div>
                    <div class="step-name">Récapitulatif</div>
                </div>
            </div>
        <div class="next-button">
            <a href="/products" class="button-order-next">Continuer mes achats</a>
        </div>
    </div>
</div>
<main class="main-order">
    <div class="summary">
        <h1>Tout est prêt pour votre commande !</h1>
        <div class="summary-order">
            <div class="summary-order-left">
                <h2>Veuilez confirmer les produits de votre achat:</h2>
                <div class="summary-order-details">
                    <p>Nom</p>
                    <p>Total</p>
                </div>
                <div class="policies-order">
                    <p>Pour continuer avec votre achat veuillez lire et accepter les politiques de remboursement et les conditionnes généraux de vente</p>
                    <input type="checkbox" id="refund" name="refund" required>
                    <label for="policies">J’a lu et j’accepte les politiques de remboursement</label>
                    <input type="checkbox" id="sales" name="sales" required>
                    <label for="policies">J’a lu et j’accepte les conditionnes générales de vente/label>
                </div>                
            </div>
        </div>
    </div>
</main>
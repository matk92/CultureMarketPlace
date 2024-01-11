<div class="billing-details">
    <form class="policies-order" action="/orders/confirm" method="post" >
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
    <main class="main-summary">
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
    </main>
    </form>
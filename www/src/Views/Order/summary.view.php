<div class="billing-details">
    <div class="section-title">
        <h2 class="title-order">Récapitulatif de la commande</h2>
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
            <div class="step-number">
                <p>2</p>
            </div>
            <div class="step-title">
                <p>Méthode de paiement</p>
            </div>
        </a>
        <a href="/orders/summary" class="step">
            <div class="step-number active">
                <p>3</p>
            </div>
            <div class="step-title">
                <p>Récapitulatif de la commande</p>
            </div>
        </a>
    </div>
</div>
<div class="main-summary">
    <div class="summary">
        <div>
            <h1>Tout est prêt pour votre commande !</h1>
            <hr />
            <h4>Vous avez choisi de vous faire livrer à l’adresse suivante :</h4>
            <div class="adress-recap">
                <p><?= $payment->getPaymentMethod()->getCardHolderName() ?></p>
                <p><?= $payment->getPaymentMethod()->getCardHolderAddress() ?></p>
                <p><?= $payment->getPaymentMethod()->getCardHolderZipCode() ?> <?= $payment->getPaymentMethod()->getCardHolderCity() ?></p>
                <p><?= $payment->getPaymentMethod()->getCardHolderCountry() ?></p>
            </div>
        </div>
        <div class="summary-order">
            <p>Pour continuer avec votre achat veuillez lire et accepter les <a href="/">politiques de remboursement</a> et les <a href="/">conditions généraux de vente</a></p>
            <hr />
            <?php isset($form) && $this->modal("form", $form) ?>
        </div>
    </div>
    <div class="order-summary">
        <h2>Récapitulatif de la commande</h2>
        <?php foreach ($order->getOrderSlots() as $product) : ?>
            <div class="product-order" id="product-<?= $product->getId() ?>">
                <img class="product-img" src="/<?= $product->getProduct()->getImage() ?>" alt="Image de <?= $product->getProduct()->getName() ?>">
                <div>
                    <h3><?= $product->getProduct()->getName() ?></h3>
                    <p>Quantité : <?= $product->getQuantity() ?>€</p>
                    <p>Prix unité : <?= round($product->getProduct()->getPrice(), 2) ?>€</p>
                    <p>Prix total : <?= round($product->getTotal(), 2) ?>€</p>
                </div>
            </div>
        <?php endforeach; ?>
        <hr>
        <div class="total-order">
            <p>Sous-total : <?= round($order->getTotal(), 2) ?>€</p>
            <p>Remise : <?= round($order->getTotal() * 0.05, 2) ?>€</p>
            <p>Frais de livraison : <?= round($order->getTotal() * 0.1, 2) ?>€</p>
            <hr>
            <h3>Montant total : <?= round($order->getTotal() * 1.05 + $order->getTotal() * 0.1, 2) ?>€</h3>
        </div>
    </div>
</div>

<hr />
<div class="row">
    <a class="button button-secondary" href="/orders">
        Précédent
    </a>
</div>
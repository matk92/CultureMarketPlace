<?php if (!isset($order)) : ?>
    <div class="empty-cart">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="128px" height="128px">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
        </svg>
        <h2>Coucou !<br />Votre panier est vide :(</h2>
        <p>Quoi de mieux que de le remplir avec la mellieur sélection de produits ?</p>
        <a href="/products" class="button button-primary">Découvrir les produits</a>
    </div>
<?php else : ?>
    <div class="billing-details">
        <div class="section-title">
            <h2 class="title-order">Mon panier</h2>
        </div>
        <hr>
        <div class="stepper-order">
            <div class="previous-button">
                <a href="/products" class="button-order-previous">Continuer mes achats</a>
            </div>
            <div class="step">
                <div class="step-number active">
                    <p>1</p>
                </div>
                <div class="step-title">
                    <p>Mon panier</p>
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
                <div class="step-number">
                    <p>3</p>
                </div>
                <div class="step-title">
                    <p>Récapitulatif de la commande</p>
                </div>
            </div>
            <div class="next-button">
                <a href="/orders/payment-info" class="button-order-next">Méthode de paiement</a>
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order->getOrderSlots() as $slot) : ?>
                <tr>
                    <td>
                        <img class="image-product-cart" src="/<?= $slot->getProduct()->getImage() ?>" alt="Image de <?= $slot->getProduct()->getName() ?>">
                        <?= $slot->getProduct()->getName() ?>
                    </td>
                    <td>
                        <div class="row">
                            <button id="btn_decrement_<?= $slot->getId() ?>" onclick="modificateQuantity(<?= $slot->getId() ?>, <?= $slot->getQuantity() - 1 ?>)" <?= $slot->getQuantity() == 1 ? 'disabled' : '' ?>>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24px" height="24px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>
                            </button>
                            <?= $slot->getQuantity() ?>
                            <button id="btn_increment_<?= $slot->getId() ?>" onclick="modificateQuantity(<?= $slot->getId() ?>, <?= $slot->getQuantity() + 1 ?>)" <?= $slot->getQuantity() >= $slot->getProduct()->getStock() ? 'disabled' : '' ?>>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24px" height="24px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                            <div class="spinner hidden" id="spinner_modal_<?= $slot->getId() ?>"></div>
                        </div>
                    </td>
                    <td><?= $slot->getTotal() ?></td>
                    <td>
                        <button id="btn_remove_<?= $slot->getId() ?>" onclick="removeProduct(<?= $slot->getId() ?>)" class="button button-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24px" height="24px">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<script>
    function showSpinner(id, show = true) {
        document.getElementById('btn_increment_' + id).disabled = show;
        document.getElementById('btn_decrement_' + id).disabled = show;
        document.getElementById('btn_remove_' + id).disabled = show;
        if (show)
            document.getElementById('spinner_modal_' + id).classList.remove('hidden');
        else
            document.getElementById('spinner_modal_' + id).classList.add('hidden');
    }

    function removeProduct(id) {
        showSpinner(id)
        fetch('/order-slot?id=' + id, {
            method: 'DELETE'
        }).then(response => {
            if (response.status === 200) {
                window.location.reload();
            }
        }).catch(error => {
            showSpinner(id, false)
        }).catch(error => {
            showSpinner(id, false)
        });
    }

    function modificateQuantity(id, quantity) {
        showSpinner(id)
        fetch('/order-slot', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                quantity: quantity
            })
        }).then(response => {
            if (response.ok) {
                window.location.reload();
            }
        }).catch(error => {
            showSpinner(id, false)
        });
    }
</script>
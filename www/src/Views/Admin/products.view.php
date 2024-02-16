<?php if (isset($added) && $added == true) : ?>
    <div id="success-alert" class="alert alert-success" style="position: fixed; top: 0;">
        <p>Produit ajouté avec succès !</p>
    </div>
<?php endif; ?>
<script>
    function deleteProduct(id) {
        if (confirm("Voulez-vous vraiment supprimer ce produit ?")) {
            document.getElementById('spinner').classList.remove('hidden');
            document.getElementById('product_section').classList.remove('allProductsAdmin');
            document.getElementById('product_section').classList.add('hidden');

            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', "/admin/products/delete?id=" + id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('spinner').classList.add('hidden');
                    document.getElementById('product_section').classList.add('allProductsAdmin');
                    document.getElementById('product_section').classList.remove('hidden');
                    document.getElementById('product_' + id).remove();
                } else {
                    alert("Une erreur est survenue lors de la suppression du produit");
                }
            };
            xhr.send();
        }
    }

    function editProduct(id) {
        document.getElementById('spinner').classList.remove('hidden');
        window.location.href = "/admin/product/edit?id=" + id;
    }
</script>
<section id="sectionTopAdmin">
    <input class="searchbar" id="search_products" type="search" placeholder="Rechercher...">
    <?php if ($_SESSION['user']['role'] >= 10) : ?>
        <button class="button button-primary btnAddAdmin">
            <i class="fa-solid fa-plus"></i>
            Ajouter un produit
        </button>

    <?php endif; ?>
</section>
<div class="spinner hidden" id="spinner"></div>
<div class="allProductsAdmin" id="product_section">
    <?php foreach ($products as $key => $product) : ?>
        <article id="product_<?= $product->getId() ?>" class="viewProductAdmin">
            <img class="imgProduct" src="/<?= $product->getImage() ?>" alt="Image de <?= $product->getName() ?>">
            <h3><?= $product->getName() ?></h3>
            <p><?= $product->getDescription() ?></p><br>
            <hr>
            <div class="priceAdmin"><?= $product->getPrice() ?>€ / <?= $product->categoryunit ?></div>
            <div class="btnProductAdmin">
                <button class="button button-primary button-esm">
                    <i class="fa-solid fa-eye"></i>
                    Visualiser
                </button>
                <button class="button button-secondary button-esm" onclick="editProduct(<?= $product->getId() ?>)">
                    <i class="fa-solid fa-pencil"></i>
                    Editer
                </button>
                <?php if ($_SESSION['user']['role'] >= 10) : ?>
                    <button class="button button-danger button-esm" onclick="deleteProduct(<?= $product->getId() ?>)">
                        <i class="fa-solid fa-trash"></i>
                        Supprimer
                    </button>
                <?php endif; ?>
            </div>
        </article>
    <?php endforeach; ?>
</div>
<div id="productForm" class="modal-admin_products" <?= (isset($_GET['id']) || (isset($form["errors"]) && count($form["errors"]) > 0))  ? 'style="display: block;"' : '' ?>>
    <div class="modal-content-admin_products">
        <div class="row row-between">
            <h2><?= isset($_GET['id']) ? "Edition d'un produit" : "Ajouter un nouveau produit" ?></h2>
            <span class="close">&times;</span>
        </div>
        <?php $this->modal("form", $form) ?>
    </div>
</div>
<script src="../assets/js/admin.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search_products').on('input', function() {
            var searchValue = $(this).val().toLowerCase();
            $('.viewProductAdmin').each(function() {
                var productName = $(this).find('h3').text();
                if (productName.toLowerCase().includes(searchValue)) {
                    var regex = new RegExp(searchValue, 'gi');
                    var highlightedText = productName.replace(regex, '<span style="background-color: #80c5ff">$&</span>');
                    $(this).find('h3').html(highlightedText);
                    $(this).removeClass('hidden');
                } else {
                    $(this).find('h3').html(productName);
                    $(this).addClass('hidden');
                }
            });
        });
    });
</script>
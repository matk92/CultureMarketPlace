<section id="sectionTopAdmin">
    <input class="searchbar" id="search_products" type="search" placeholder="Rechercher...">
    <button class="button button-primary btnAddAdmin"><i class="fa-solid fa-plus"></i> Ajouter un produit</button>
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
                <button class="button button-secondary button-esm">
                    <i class="fa-solid fa-pencil"></i>
                    Editer
                </button>
                <button class="button button-danger button-esm" onclick="deleteProduct(<?= $product->getId() ?>)">
                    <i class="fa-solid fa-trash"></i>
                    Supprimer
                </button>
            </div>
        </article>
    <?php endforeach; ?>
</div>
<div id="productForm" class="modal-admin_products">
    <div class="modal-content-admin_products">
        <span class="close">&times;</span>
        <form enctype="multipart/form-data">
            <h2>Ajouter un nouveau produit</h2>
            <label for="productName">Nom du produit:</label><br>
            <input type="text" id="productName" name="productName"><br>
            <label for="productPrice">Prix du produit:</label><br>
            <input type="text" id="productPrice" name="productPrice"><br>
            <label for="productDescription">Description du produit:</label><br>
            <input type="text" id="productDescription" name="productDescription"><br>
            <label for="productStock">Quantité du produit:</label><br>
            <input type="text" id="productStock" name="productStock"><br>
            <label for="productCategoryid">Catégorie du produit:</label><br>
            <input type="text" id="productCategoryid" name="productCategoryid"><br>
            <label for="productImage">Image du produit:</label><br>
            <input type="file" id="productImage" name="productImage" accept="image/*"><br>
            <input class="button button-primary" type="submit" value="Submit">
        </form>
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

    function deleteProduct(id) {
        if (confirm("Voulez-vous vraiment supprimer ce produit ?")) {
            document.getElementById('spinner').classList.remove('hidden');
            document.getElementById('product_section').classList.remove('allProductsAdmin');
            document.getElementById('product_section').classList.add('hidden');
            
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', "/admin/products/delete?id=" + id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    window.location.reload();
                } else {
                    alert("Une erreur est survenue lors de la suppression du produit");
                }
            };
            xhr.send();
        }
    }
</script>
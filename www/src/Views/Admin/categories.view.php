<?php if (isset($added) && $added == true) : ?>
    <div id="success-alert" class="alert alert-success" style="position: fixed; top: 0;">
        <p>Categorie ajouté avec succès !</p>
    </div>
<?php endif; ?>
<script>
    function deleteCategory(id) {
        if (confirm("Voulez-vous vraiment supprimer cette categorie ?")) {
            document.getElementById('spinner').classList.remove('hidden');
            document.getElementById('categories_section').classList.remove('allCategoriesAdmin');
            document.getElementById('categories_section').classList.add('hidden');

            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', "/admin/category/delete?id=" + id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('spinner').classList.add('hidden');
                    document.getElementById('categories_section').classList.add('allCategoriesAdmin');
                    document.getElementById('categories_section').classList.remove('hidden');
                    document.getElementById('category_' + id).remove();
                } else {
                    alert("Une erreur est survenue lors de la suppression de la categorie");
                }
            };
            xhr.send();
        }
    }
</script>
<div class="spinner hidden" id="spinner"></div>
<div class="allCategoriesAdmin" id="categories_section">
    <?php foreach ($categories as $key => $category) : ?>
        <article class="row row-between category_card" id="category_<?= $category->getId() ?>">
            <div class="row row-start">
                <h2 class="text-lg"><?= $category->getName() ?></h2>
                <p class="text-sm"><?= $category->getAmount() ?><?= $category->getUnit() ?></p>
            </div>
            <?php if ($_SESSION['user']['role'] >= 10) : ?>
                <button class="button button-danger button-esm" onclick="deleteCategory(<?= $category->getId() ?>)">
                    <i class="fa-solid fa-trash"></i>
                    Supprimer
                </button>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</div>
<section class="add-product-section">
    <?php $this->modal("form", $form) ?>
</section>
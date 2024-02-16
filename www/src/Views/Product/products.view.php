<?php if (array_key_exists('errorComment', $_GET) && $_GET['errorComment'] === 'true') : ?>
    <div id="danger-alert" class="alert alert-danger" style="position: fixed; top: 0;">
        <p>Erreur lors de l'ajout du commentaire</p>
    </div>
<?php endif; ?>

<div class="main-products">
    <section class="products-header">
        <h1 id="products_title">Produits</h1>
        <div class="content-header-products">
            <div class="filter">
                <label for="filter">Filtrer</label>
                <select id="category_filter" name="filter" id="filter">
                    <option value="0">Tous</option>
                    <?php foreach ($filters as $filter) : ?>
                        <option value=<?= $filter->getId() ?> <?= $filter->getId() == $_GET['filter'] ? 'selected' : '' ?>>
                            <?= $filter->getName() ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input class="searchbar" id="search_products" type="search" placeholder="Rechercher...">
        </div>
    </section>
    <hr />
    <div class="spinner hidden" id="spinner"></div>
    <div class="products-section" id="product_section">
        <?php foreach ($products as $key => $product) : ?>
            <div class="card" key="<?= $product->getId() ?>">
                <img src="/<?= $product->getImage() ?>" alt="Image de <?= $product->getName() ?>">
                <div class="card-header">
                    <h2><?= $product->getName() ?></h2>
                    <div class="row">
                        <?php for ($i = 0; $i < 5; $i++) :
                            $rating = ($product->getRating() - $i < 0 ? 0 : ($product->getRating() - $i > 1 ? 100 : ($product->getRating() - $i) * 100));
                            $gradientOffset = $rating . '%';
                        ?>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="grad_<?= $key ?>_<?= $i ?>" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" style="stop-color:#E3D027;stop-opacity:1" />
                                        <stop offset="<?= $gradientOffset ?>" style="stop-color:#E3D027;stop-opacity:1" />
                                        <stop offset="<?= $gradientOffset ?>" style="stop-color:#505050;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#505050;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                                <path id="Vector" fill-rule="evenodd" clip-rule="evenodd" d="M10.7856 3.20997C11.2336 2.13297 12.7616 2.13297 13.2096 
                                3.20997L15.2916 8.21697L20.6956 8.64997C21.8596 8.74297 22.3316 10.195 21.4446 10.955L17.3276 14.482L18.5846 19.755C18.8556
                                20.891 17.6206 21.788 16.6246 21.18L11.9976 18.354L7.37056 21.18C6.37456 21.788 5.13956 20.89 5.41056 19.755L6.66756 14.482L2.55056
                                10.955C1.66356 10.195 2.13556 8.74297 3.29956 8.64997L8.70356 8.21697L10.7856 3.20997Z" fill="url(#grad_<?= $key ?>_<?= $i ?>)" />
                            </svg>
                        <?php endfor; ?>
                    </div>
                </div>
                <p><?= $product->getDescription() ?></p>
                <div class="card-bottom">
                    <p><?= $product->getPrice() ?>€</p>
                    <a href="?pid=<?= $product->getId() ?>" onclick="displayModal(<?= $product->getId() ?>)">Voir plus</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div id="background_modal" class="background-modal" style="<?= isset($displayProduct) ? 'display: block;' : 'display: none;' ?>">
    <div class="modal_body">
        <div class="spinner <?= isset($displayProduct) ? 'hidden' : '' ?>" id="spinner_modal"></div>
        <?php if (isset($displayProduct) && $displayProduct->getId()) : ?>
            <div class="" id="modal_content">
                <div class="row row-between">
                    <h2><?= $displayProduct->getName() ?></h2>
                    <button id="fermer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24" height="24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <p>Stock disponible : <?= $displayProduct->getStock() ?><?= $displayProduct->getCategory()->getUnit() ?></p>
                <img src="/<?= $displayProduct->getImage() ?>" alt="Image de <?= $displayProduct->getName() ?>">
                <div class="row">
                    <p><?= $displayProduct->getDescription() ?></p>
                    <p id="product_price"><?= $displayProduct->getPrice() ?>€</p>
                    <?php if (isset($form)) $this->modal("form", $form) ?>
                </div>
                <hr />
                <div>
                    <h3>Commentaires</h3>
                    <?php foreach ($comments as $comment) : ?>
                        <div class="comment_card">
                            <p class="comment"><?= $comment->getComment() ?></p>
                            <div class="row">
                                <?php for ($i = 0; $i < 5; $i++) :
                                    $rating = ($comment->getRating() - $i < 0 ? 0 : ($comment->getRating() - $i > 1 ? 100 : ($comment->getRating() - $i) * 100));
                                    $gradientOffset = $rating . '%';
                                ?>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <linearGradient id="comment_<?= $i ?>_<?= $comment->getId() ?>" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" style="stop-color:#E3D027;stop-opacity:1" />
                                                <stop offset="<?= $gradientOffset ?>" style="stop-color:#E3D027;stop-opacity:1" />
                                                <stop offset="<?= $gradientOffset ?>" style="stop-color:#505050;stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:#505050;stop-opacity:1" />
                                            </linearGradient>
                                        </defs>
                                        <path id="Vector" fill-rule="evenodd" clip-rule="evenodd" d="M10.7856 3.20997C11.2336 2.13297 12.7616 2.13297 13.2096 
                                3.20997L15.2916 8.21697L20.6956 8.64997C21.8596 8.74297 22.3316 10.195 21.4446 10.955L17.3276 14.482L18.5846 19.755C18.8556
                                20.891 17.6206 21.788 16.6246 21.18L11.9976 18.354L7.37056 21.18C6.37456 21.788 5.13956 20.89 5.41056 19.755L6.66756 14.482L2.55056
                                10.955C1.66356 10.195 2.13556 8.74297 3.29956 8.64997L8.70356 8.21697L10.7856 3.20997Z" fill="url(#comment_<?= $i ?>_<?= $comment->getId() ?>)" />
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <p>Par <?= $comment->firstname ?> <?= $comment->lastname ?></p>
                        </div>
                    <?php endforeach; ?>
                    <?php if (isset($_SESSION['user']) && isset($formComment)) : ?>
                        <hr />
                        <?= $this->modal("form", $formComment) ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    var fermer = document.getElementById('fermer');

    function displayModal(id) {
        document.getElementById('background_modal').style.display = 'block';
        document.getElementById('spinner_modal').classList.remove('hidden');
        document.getElementById('modal_content').classList.add('hidden');
    }

    function updatePrice(value) {
        var price = <?= isset($displayProduct) ? $displayProduct->getPrice() : 0 ?>;
        document.getElementById('product_price').innerText = price * value + '€';
    }

    if (document.getElementById('form-oreder-add-product-quantity')) {
        document.getElementById('form-oreder-add-product-quantity').addEventListener('change', function() {
            updatePrice(this.value);
        });
    }

    // Fermer la popup quand on clique sur le bouton "fermer"
    fermer.onclick = function() {
        document.getElementById('background_modal').style.display = 'none';
    }

    // Fermer la popup quand on clique en dehors de la popup
    window.onclick = function(event) {
        if (event.target == document.getElementById('background_modal')) {
            document.getElementById('background_modal').style.display = 'none';
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#category_filter').change(function() {
            var selectedValue = $(this).val();
            var url = window.location.href.split('?')[0]; // remove existing query parameters
            window.location.href = url + '?filter=' + selectedValue + '#products_title';
            document.getElementById('spinner').classList.remove('hidden');
            document.getElementById('product_section').classList.remove('products-section');
            document.getElementById('product_section').classList.add('hidden');
        });
        $('#search_products').on('input', function() {
            var searchValue = $(this).val().toLowerCase();
            $('.card').each(function() {
                var productName = $(this).find('.card-header h2').text();
                if (productName.toLowerCase().includes(searchValue)) {
                    var regex = new RegExp(searchValue, 'gi');
                    var highlightedText = productName.replace(regex, '<span style="background-color: #80c5ff">$&</span>');
                    $(this).find('.card-header h2').html(highlightedText);
                    $(this).removeClass('hidden');
                } else {
                    $(this).find('.card-header h2').html(productName);
                    $(this).addClass('hidden');
                }
            });
        });
    });
</script>
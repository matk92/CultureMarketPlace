<main class="main-products">
    <section class="products-header">
        <h1>Produits</h1>
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
    </section>
    <hr >
    <div class="spinner hidden" id="spinner"></div>
    <div class="products-section" id="product_section">
        <?php foreach ($products as $key => $product) : ?>
            <div class="card">
                <img src=<?= $product->getImage() ?> alt="Image de <?= $product->getName() ?>">
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
                    <a href="#">Voir plus</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category_filter').change(function() {
            var selectedValue = $(this).val();
            var url = window.location.href.split('?')[0]; // remove existing query parameters
            window.location.href = url + '?filter=' + selectedValue;
            document.getElementById('spinner').classList.remove('hidden');
            document.getElementById('product_section').classList.remove('products-section');
            document.getElementById('product_section').classList.add('hidden');
        });
        $('#search_products').on('input', function() {
            var searchValue = $(this).val().toLowerCase();
            $('.card').each(function() {
                var productName = $(this).find('.card-header h1').text();
                if (productName.toLowerCase().includes(searchValue)) {
                    var regex = new RegExp(searchValue, 'gi');
                    var highlightedText = productName.replace(regex, '<span style="background-color: #80c5ff">$&</span>');
                    $(this).find('.card-header h1').html(highlightedText);
                    $(this).removeClass('hidden');
                } else {
                    $(this).find('.card-header h1').html(productName);
                    $(this).addClass('hidden');
                }
            });
        });
    });
</script>
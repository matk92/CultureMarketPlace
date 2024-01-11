<section id="sectionTopAdmin">
    <input class="searchbar" type="search" placeholder="Rechercher...">
    <button class="button button-primary btnAddAdmin"><i class="fa-solid fa-plus"></i> Ajouter un produit</button>
</section>

<div class="allProductsAdmin">
    
<article class="viewProductAdmin">
        <img clas="imgProduct" src='../assets/images/paella.png'>
        <h3>Titre du produit</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
             when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br>
        <hr>
        <div class="priceAdmin">24.99€</>
        <div class="btnProductAdmin">
            <button class="button button-primary button-esm"><i class="fa-solid fa-eye"></i> Visualiser</button>
            <button class="button button-secondary button-esm"><i class="fa-solid fa-pencil"></i> Editer</button>
            <button class="button button-danger button-esm"><i class="fa-solid fa-trash"></i> Supprimer</button>
        </div>
    </article>
    <article class="viewProductAdmin">
        <img clas="imgProduct" src='../assets/images/paella.png'>
        <h3>Titre du produit</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
             when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br>
        <hr>
        <div class="priceAdmin">24.99€</>
        <div class="btnProductAdmin">
            <button class="button button-primary button-esm"><i class="fa-solid fa-eye"></i> Visualiser</button>
            <button class="button button-secondary button-esm"><i class="fa-solid fa-pencil"></i> Editer</button>
            <button class="button button-danger button-esm"><i class="fa-solid fa-trash"></i> Supprimer</button>
        </div>
    </article>
    <article class="viewProductAdmin">
        <img clas="imgProduct" src='../assets/images/paella.png'>
        <h3>Titre du produit</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
             when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br>
        <hr>
        <div class="priceAdmin">24.99€</>
        <div class="btnProductAdmin">
            <button class="button button-primary button-esm"><i class="fa-solid fa-eye"></i> Visualiser</button>
            <button class="button button-secondary button-esm"><i class="fa-solid fa-pencil"></i> Editer</button>
            <button class="button button-danger button-esm"><i class="fa-solid fa-trash"></i> Supprimer</button>
        </div>
    </article>
    <article class="viewProductAdmin">
        <img clas="imgProduct" src='../assets/images/paella.png'>
        <h3>Titre du produit</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
             when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br>
        <hr>
        <div class="priceAdmin">24.99€</>
        <div class="btnProductAdmin">
            <button class="button button-primary button-esm"><i class="fa-solid fa-eye"></i> Visualiser</button>
            <button class="button button-secondary button-esm"><i class="fa-solid fa-pencil"></i> Editer</button>
            <button class="button button-danger button-esm"><i class="fa-solid fa-trash"></i> Supprimer</button>
        </div>
    </article>
    <article class="viewProductAdmin">
        <img clas="imgProduct" src='../assets/images/paella.png'>
        <h3>Titre du produit</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
             when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br>
        <hr>
        <div class="priceAdmin">24.99€</>
        <div class="btnProductAdmin">
            <button class="button button-primary button-esm"><i class="fa-solid fa-eye"></i> Visualiser</button>
            <button class="button button-secondary button-esm"><i class="fa-solid fa-pencil"></i> Editer</button>
            <button class="button button-danger button-esm"><i class="fa-solid fa-trash"></i> Supprimer</button>
        </div>
    </article>
    <article class="viewProductAdmin">
        <img clas="imgProduct" src='../assets/images/paella.png'>
        <h3>Titre du produit</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
             when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><br>
        <hr>
        <div class="priceAdmin">24.99€</>
        <div class="btnProductAdmin">
            <button class="button button-primary button-esm"><i class="fa-solid fa-eye"></i> Visualiser</button>
            <button class="button button-secondary button-esm"><i class="fa-solid fa-pencil"></i> Editer</button>
            <button class="button button-danger button-esm"><i class="fa-solid fa-trash"></i> Supprimer</button>
        </div>
    </article>
    
    
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
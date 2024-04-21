<div class="container-mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" name="product_title" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label">Product Description</label>
            <input type="text" id="product_desc" name="product_desc" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" name="product_keywords" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <select name="product_category" class="form-select">
                <label for="product_category" class="form-label">Product Category</label>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">image 1</label>
            <input type="file" id="product_image1" name="product_image1" class="form-control" required="required">
        </div>
</div>
<div class="form-outline w-50 m-auto mb-4">
    <label for="product_image2" class="form-label">image 2</label>
    <input type="file" id="product_image2" name="product_image2" class="form-control" required="required">
</div>
<div class="form-outline w-50 m-auto mb-4">
    <label for="product_price" class="form-label">Product Price</label>
    <input type="text" id="product_price" name="product_price" class="form-control" required="required">
</div>
<div class="text-center">
    <input type="submit" name="edit_product" value="Update Product" class="btn btn-info px-3 mb-3">
</div>
</form>

</div>
<?php require_once('../Views/layouts/navbar/navbar.php') ?>
<?php require_once('input.php') ?>
<?php require_once('validator.php') ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="product_form" class="py-4">
        <div class="container">
            <div class="row justify-content-center justify-content-md-start">
                <div class="col-lg-4 col-md-7 col-9">
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" class="form-control" name="sku" id="sku"
                               value="<?php echo htmlspecialchars(Input::GetInput('sku')); ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="<?php echo htmlspecialchars(Input::GetInput('name')); ?>">
                        </div>
                        <div class=" form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" id="price"
                                   value="<?php echo htmlspecialchars(Input::GetInput('price')); ?>">
                        </div>
                        <label for=" productType">Product Type</label>
                        <select name="type" class="custom-select" id="productType">
                            <option selected disabled
                                    value=""><?php echo htmlspecialchars(Input::GetInput('type')); ?></option>
                            <option value="DVD" name="DVD" id="DVD">DVD-disc</option>
                            <option value="Furniture" name="Furniture" id="Furniture">Furniture</option>
                            <option value="Book" name="Book" id="Book">Book</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-7 col-9 offset-lg-2">
                        <div class="form-group d-none" id="dvd-form">
                            <label for="size">Size (MB)</label>
                            <input type="text" class="form-control" id="size" name="size"
                                   value="
                                   <?php
                                   if (Input::GetInput('type') == 'DVD') {
                                       echo htmlspecialchars(Input::GetInput('size'));
                                   } ?>">
                            <p class="my-2 text-secondary">
                                Please provide DVD size in mega bytes
                            </p>
                        </div>
                        <div class="form-group d-none" id="book-form">
                            <label for="weight">Weight (KG)</label>
                            <input type="text" class="form-control" id="weight">
                            <p class="my-2 text-secondary">
                                Please provide book weight in kilo grams
                            </p>
                        </div>
                        <div class="form-group d-none" id="furniture-form">
                            <div class="form-group">
                                <label for="height">Height (CM)</label>
                                <input type="text" class="form-control" id="height">
                            </div>
                            <div class="form-group">
                                <label for="width">Width (CM)</label>
                                <input type="text" class="form-control" id="width">
                            </div>
                            <div class="form-group">
                                <label for="length">Length (CM)</label>
                                <input type="text" class="form-control" id="length">
                            </div>
                            <p class="my-2 text-secondary">
                                Please provide dimensions in HxWxL format
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="error text-danger">
                <?php require_once('rules.php'); ?>
            </div>
    </form>

<?php require_once('../Views/layouts/scripts/scripts.php') ?>
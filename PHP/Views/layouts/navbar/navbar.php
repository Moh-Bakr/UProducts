<head>
    <?php require_once(__DIR__ . '/../cdn.php') ?>
    <title>Scandiweb-Task</title>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <?php if ($_SERVER['REQUEST_URI'] == '/') { ?>
            <a href='/' class="navbar-brand mb-0 h1">
                <img src="https://yt3.ggpht.com/ytc/AKedOLQ4c6V1SB6BxHWYjRIPs8uVi3Kyb7Xb-hs-xw6I=s900-c-k-c0x00ffffff-no-rj"
                     alt="" width="40" height="24"> Product List</a>
            <div>
                <a href="add-product" class="btn btn-primary ml-4">ADD</a>
                <button form="products_form" type="submit" class="btn btn-danger my-2 my-sm-0 mx-1"
                        id="delete-product-btn">MASS DELETE
                </button>
                <?php } ?>
                <?php if ($_SERVER['REQUEST_URI'] == '/add-product') { ?>
                <a href='/add-product' class="navbar-brand mb-0 h1">
                    <img src="https://yt3.ggpht.com/ytc/AKedOLQ4c6V1SB6BxHWYjRIPs8uVi3Kyb7Xb-hs-xw6I=s900-c-k-c0x00ffffff-no-rj"
                         alt="" width="40" height="24"> Product Add</a>
                <div>
                    <input form="product_form" href="add-product" type="submit" name="submit" value="Save"
                           class="btn btn-primary ml-4" id="save">
                    <a href="/" class="btn btn-danger my-2 my-sm-0 mx-1">Cancel</a>
                    <?php } ?>
                </div>
            </div>
    </nav>
</head>
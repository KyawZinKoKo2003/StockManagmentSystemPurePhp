<?php 
include '../init.php';
include '../includes/header.php';
$image_path="image";
if(isset($_GET['slug']) and (!empty($_GET['slug']))){
    $slug=($_GET['slug']);
    $r_product=getOne('select * from product where slug=?',[$slug]);
    if(!$r_product){
        setError('Wrong slug');
        go('index.php');
        die();
    }
    else{
        $product=getOne("select product.*, category.name as category_name, (select count(id) from product_sale where product.id=product_sale.product_id)as sale_count from product left join category on category.id=product.category_id where product.slug=?",[$slug]);
        if(!$product){
            setError('wring slug');
            go('index.php');
            die();
        }
    }
}
else{
    setError('wring slug');
    go('index.php');
    die();
}

?>
<div class="container">
    <div class="row mt-4">
    <div class="col-md-4">
        <img src="<?php echo "https://localhost/stock_managment/image/".$product->image;  ?>" class="img-fluid img-thumbnail">
    </div>
    <div class="col-md-8">
    <div class="card  p-3 bg-cyan-400 shadow">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <td>SaleCount</td>
                    <td>SalePrice</td>
                    <td>RemainQuantity</td>
                </tr>
                <tr>
                    <td><?php echo $product->sale_count; ?></td>
                    <td><?php echo $product->sale_price; ?></td>
                    <td><?php echo $product->total_quantity; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card mt-2 bg-cyan-400">
        <div class="card-body p-3">
                <?php echo $product->description; ?>
        </div>
    </div>
    </div>
    
    </div>
    
</div>
<?php
include '../includes/footer.php';
?>
<?php
include '../init.php';
include '../includes/header.php';
if(isset($_GET['delete'])){
    $sale_id=$_GET['id'];
    $product_sale=getOne('select * from product_sale');
    $product=getOne('select * from product where id=?',[$product_sale->id]);
    query('delete from product_sale where id=?',[$sale_id]);
    query('update product set total_quantity=total_quantity - 1 where id=?',[$product->id]);
    setMsg('Sale deleted successfully');
}
if(isset($_GET['slug']) && !empty($_GET['slug'])){
    $slug=$_GET['slug'];
    $product=getOne('select * from product where slug=?',[$slug]);
    $sale_info=getAll('select * from product_sale where product_id=?',[$product->id]);
}
else{
    setError('slug must be');
    go('../product/index.php');
}
?>
<div class="container mt-3">
    <div class="col">
        <div class="card p-3 bg-info">
            <div class="card-body">
                <h2 class="text-3xl font-bold text-white mb-2">Sale-list</h2>
                <?php showMsg(); showError(); ?>
                <table class="table tabel-striped">
                    <tr>
                        <td>
                            Sale Price
                        </td>
                        <td>
                            Date
                        </td>
                        <td>
                            Option
                        </td>
                    </tr>
                        <?php foreach($sale_info as $sp){ ?>
                    <tr>
                        <td> <?php echo $sp->sale_price; ?></td>
                        <td> <?php echo $sp->date; ?></td>
                        <td><a class="btn btn-danger btn-sm shadow" onclick="return confirm('Sure?')" href="sale-list.php?id=<?php echo $sp->id; ?>&slug=<?php echo $slug;?>&delete=true"><span class="fas fa-trash"></span> Delete</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php';
<?php
include '../init.php';
include '../includes/header.php';
if(isset($_GET['sale']) && !empty($_GET['sale'])){
    $slug=$_GET['slug'];
    $product=getOne('select * from product where slug=?',[$slug]);
    $update_total_quantity=$product->total_quantity - 1;
    $date=date('Y-m-d');
    query('update product set total_quantity=? where slug=?',[$update_total_quantity,$slug]);
    query('insert into product_sale (product_id,sale_price,date) value (? , ? , ? )',[$product->id,$product->sale_price,$date]);
    setMsg('Sole product');
}
if(!$_SESSION['user']){
    setError('Please login first.');
    go('../login.php');
}
if(isset($_GET['search'])){
    $search=$_GET['search'];
    $product=getAll("select * from product where name like '%$search%' order by id desc limit 2");
}
else{
    $product=getAll('select * from product');
}
?>
<div class="container">
    <h3 class=' font-bold text-center mt-3'>Product Info</h3>
    <div class="card text-white bg-info bg-gradient p-3  mt-3 shadow">
        <div class="card-body">
        <a href="create.php" class="btn mb-2 btn-warning rounded" >Create </a>
        <?php showMsg(); showError(); ?>
        <form class="mt-3" action="" method="get">
            <input type="text" class=" border rounded-md h-8 w-25" mb-2 name="search">
            <button type="submit" class="btn btn-secondary mb-2 btn-sm  rounded">
                <span class="fa fa-search"></span>
            </button>
        </form>
        <table class="table table-striped ">
            <tr>
                <td>Name</td>
                <td>Quantity</td>
                <td>Sale Price</td>
                <td>Option</td>
            </tr>
            <?php foreach($product as $p){ ?>
            <tr>
                <td><?php echo $p->name; ?></td>
                <td><?php echo $p->total_quantity; ?></td>
                <td><?php echo $p->sale_price; ?></td>
                <td>
                    <a href="detail.php?slug=<?php echo $p->slug; ?>" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> view</a>
                    <a href="edit.php?slug=<?php echo $p->slug; ?>" class="btn btn-sm btn-warning shadow"><span class="fas fa-edit"></span> Edit</a>
                    <a href="delete.php?slug=<?php echo $p->slug; ?>" onclick="return confirm('sure')" class="btn btn-sm btn-danger shadow"><span class="fas fa-trash"></span> Delete</a> |
                    <a href="<?php echo $root.'/product-buy/index.php?slug='.$p->slug;?>" class="btn btn-sm btn-outline-warning shadow ">Buy</a>
                    <a href="<?php echo $root.'/product/index.php?slug='.$p->slug;?>&sale=true " class="btn btn-sm btn-outline-warning "> Sell</a> 
                    <a href="<?php echo $root.'./product-buy/sale-list.php?slug='.$p->slug;?>" class="btn btn-sm btn-info  ">SaleList</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
        </div>

<?php
include '../includes/footer.php';
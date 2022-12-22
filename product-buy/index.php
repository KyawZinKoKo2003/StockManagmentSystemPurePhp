<?php
include '../init.php';
include '../includes/header.php';
if(isset($_GET['action'])){
    $product_slug=$_GET['slug'];
    $product_id=$_GET['id'];
    $product_buy=getOne('select * from product_buy where product_id=?',[$product_id]);
    $product_data=getOne('select * from product where slug=?',[$product_slug]);
    if(!$product_buy && !$product_data){
        setError('wrong something');
        go('index.php');
    }
    $update_total_quantity=$product_data->total_quantity - $product_buy->total_quantity;
    $res=query('delete from product_buy where id=?',[$product_id]);
    query('update product set total_quantity=? where slug=?',[$update_total_quantity,$product_slug]);
    if($res){
        setMsg('Record Deleted');
    }
    else{
        setError('Error in Deleting');
    }
}
$slug=$_GET['slug'];
$product=getOne('select * from product where slug=?',[$slug]);
if(!$product){
    go('../product/index.php');
    setError('wrong something');
}
$buy=getAll('select * from product_buy where product_id=?',[$product->id]);
?>
<div class="container">
    <div class="card p-3 bg-info shadow">
        <div class="card-body mt-2">
            <p class="text-3xl font-bold mt-3 mb-2">Product_buy info</p>
            <?php showError(); showMsg();?>
            <a href="create.php?slug=<?php echo $slug;?>" class=" mb-2 btn btn-warning">Create</a>
                <table class="table table-striped">
                    <tr>
                        <td>Buy price</td>
                        <td>Buy quantity</td>
                        <td>Buy date</td>
                        <td>Option</td>
                    </tr>
                    <?php foreach($buy as $p){ ?>
                    <tr>
                        <td><?php echo $p->buy_price ;?></td>
                        <td><?php echo $p->total_quantity ;?></td>
                        <td><?php echo $p->buy_date ;?></td>
                        <td><a href="index.php?action=delete&slug=<?php echo $slug;?>&id=<?php echo $p->id;?>" class="btn btn-sm btn-danger" onclick=confirm('sure?')><span class="fas fa-trash"></span> delete</td>
                    </tr>
                    <?php } ?>
                </table>
        </div>
    </div>
</div>
<?php 
include '../includes/footer.php';
?>
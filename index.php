<?php 
include 'init.php';
if(!$_SESSION['user']){
    setError('Please login first.');
    go('login.php');
}
$date=date('Y-m-d');
$total_sale=getOne('
    select sum(sale_price) as price from product_sale where date=?
',[$date])->price;
$total_buy=getOne('
    select sum(buy_price) as price from product_buy where buy_date=?
',[$date])->price;
$latest_sale=getAll('
    select product_sale.*,product.name as product_name from product_sale
    left join product on product.id=product_sale.product_id
    where product_sale.date=?
    order by product_sale.id desc limit 5
',[$date]);
$latest_buy=getAll('
    select product_buy.*,product.name as product_name from product_buy
    left join product on product.id=product_buy.product_id 
    where product_buy.buy_date=?
    order by product_buy.id desc limit 5
',[$date]);
include 'includes/header.php';
?>
<div class="container ">
    <div class="card p-2 ">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card h-32 bg-info p-2">
                        <div class="card-body">
                            <div class="text-center">
                            <h3 class="text-white text-3xl ">Total Sale</h3>
                            <p class="text-center  bg-yellow-500 mt-2 btn-sm btn text-white center"><?php echo $total_sale; ?> ks</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-32 bg-warning p-2">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="text-white  text-3xl ">Total Buy</h3>
                             <p class="text-white btn mt-2 btn-sm bg-cyan-500"><?php echo $total_buy; ?> ks</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-32 bg-primary p-2">
                        <div class="card-body">
                        <div class="text-center">
                            <h3 class="text-white  text-3xl ">Net Income</h3>
                             <p class="text-white btn mt-2 btn-sm "><?php echo $total_sale - $total_buy; ?> ks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-4 bg-slate-500">
            <div class="row mt-4">
                <div class="col-md-6">
                    <h2 class="text-4xl font-bold text-info mt-3">Latest Sale list</h2>
                    <table class="mt-3 table table-striped">
                        <tr>
                            <td>Name</td>
                            <td>Qty</td>
                        </tr>
                        <?php foreach($latest_sale as $ls){ ?>
                        <tr>
                            <td><?php echo $ls->product_name;?></td>
                            <td><?php echo $ls->sale_price;?></td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
                <div class="col-md-6">
                <h2 class="text-4xl font-bold text-info mt-3">Latest buy list</h2>
                <table class="mt-3 table table-striped">
                        <tr>
                            <td>Name</td>
                            <td>Qty</td>
                        </tr>
                        <?php foreach($latest_buy as $lb){ ?>
                        <tr>
                            <td><?php echo $lb->product_name;?></td>
                            <td><?php echo $lb->buy_price;?></td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php';
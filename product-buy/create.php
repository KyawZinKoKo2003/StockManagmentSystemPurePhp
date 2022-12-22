<?php
include '../init.php';
include '../includes/header.php';
$product_slug=$_GET['slug'];
    $product=getOne('select id,total_quantity from product where slug=?',[$product_slug]);
    if(isset($_POST['submit'])){
        $buy_price=$_POST['buy_price'];
        $total_quantity=$_POST['total_quantity'];
        $date=$_POST['date'];
        query('
            insert into product_buy (product_id,buy_price,total_quantity,buy_date) value(?, ? , ? ,?)',[$product->id, $buy_price, $total_quantity,$date]
        );
        $rel_quantity=$product->total_quantity + $total_quantity;
    $test=query("update product set total_quantity=? where slug='$product_slug'",[$rel_quantity]);
    if(!$test){
        setError('Wrong something');

    }
    else{
    setMsg('product buy created');
    go('index.php?slug='.$product_slug);
    die();
    }
    }

?>
<div class="container">
    <div class="card bg-cyan-300 shadow p-3">
        <div class="card-body">
            <p class="text-3xl  font-bold">Buy product</p>
            <form action="" method="post" class="form-group">
                <label for="">Enter buy price</label>
                <input type="text" class="form-control" name="buy_price">
                <label for="">Enter total quantity</label>
                <input type="text" class="form-control" name="total_quantity">
                <label for="Buy Date">Buy date</label>
                <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date">
                <button type="submit" name="submit" class="btn btn-warning mt-2">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include '../includes/footer.php';
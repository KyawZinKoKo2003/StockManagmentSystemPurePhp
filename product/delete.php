<?php
include '../init.php';
if(isset($_GET['slug'])){
    $slug=$_GET['slug'];
    $product=getOne('select * from product where slug=?',[$slug]);
    $result=query("delete from product where slug=?",[$slug]);
    query('delete from product_buy where product_id=?',[$product->id]);
    if($result){
        setMsg('Record deleted');
        go('index.php');
    }
}
?>
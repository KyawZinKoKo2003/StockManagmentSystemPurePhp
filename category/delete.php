<?php 
include '../init.php';
$slug=$_GET['slug'];
$res=query('delete from category where slug=?',[$slug]);
if($res){
    setMsg('Recorded Deleted.');
    go('index.php');
    die();
}

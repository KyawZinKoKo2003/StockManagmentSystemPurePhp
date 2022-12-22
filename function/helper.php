<?php
function setError($message){
    $_SESSION['errors']= [];
    $_SESSION['errors'][]=$message;
}
function showError(){
    $errors=$_SESSION['errors'];
    $_SESSION['errors']=[];
    if(count($errors)){
        foreach($errors as $e){
            echo "<div class='alert alert-danger'> $e </div>";
        }
    }
}
function hasError(){
    $errors=$_SESSION['errors'];
    if(count($errors)){
        return TRUE;
    }
    return FALSE;
}
function go($path){
    header("location: $path");
}
function slug($str){
    return uniqid().'-'.str_replace(' ','-',$str);
}
function setMsg($msg){
    $_SESSION['msg']=[];
    $_SESSION['msg'][]=$msg;
}
function showMsg(){
    $msg=$_SESSION['msg'];
    $_SESSION['msg']=[];
    if(count($msg)){
    foreach($msg as $m){
        echo "<div class='alert alert-success'> $m </div>";
    }
}
}
function paginateCategory( $number_per_page= 5){
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }
    else{
        $page=2;
    }
    if($page<= 0){
        $page=2;
    }
    $start=($page - 1) * $number_per_page;
    $limit= "$start , $number_per_page" ;
    $sql="select * from category order by id desc limit $limit";
    $res=getAll($sql);
    echo json_encode($res);
}

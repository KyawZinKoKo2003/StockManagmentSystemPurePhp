<?php
include '../includes/header.php';
include '../init.php';
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    if(empty($name)){
        setError('Please Enter Category Name');
    }
    if(!hasError()){
        $res=query('insert into category (slug,name) value ( ? , ? )',
        [slug($name),$name]);
        if($res){
            setMsg('Record added successfully');
        }
    }
}
?>
<div class="container">
<h1 class=" text-bold ">Category</h1> 
        <div class="card mt-3  bg-primary p-3">
            <div class="card-body">
                <?php showMsg();showError(); ?>
                <a href="index.php" class="btn btn-sm btn-dark mb-2" >Back </a>
                <form action="" class="form-group" method="post">
                 <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                 <button type="submit" name="submit" class="btn btn-info mt-3 "> Create </button>
                </form>
            </div>
        </div>
</div>


<?php
include '../includes/footer.php';
?>
<?php
include '../includes/header.php';
include '../init.php';
if(!$_SESSION['user']){
    setError('Please login first.');
    go('login.php');
}
    $slug=$_GET['slug'];
    $category=getOne('select * from category where slug=?',[$slug]);
    if(!$category){
        setError('category not found.');
        go('index.php');
        die();
    }
if(isset($_POST['submit'])){
    $cat=$_POST['name'];
    if(empty($cat)){
        setError('Please Enter Category Name');
    }
    if(!hasError()){
        $res=query('update category set slug=?,name=? where slug=?',[slug($cat),$cat,$slug]);
        if($res){
            setMsg('Recorded Updated successfully.');
            go('index.php');
            die();
        }
    }
}
?>
<div class="container">
<h1 class="text-3xl text-bold text-white">Category</h1>
        <div class="card mt-3  bg-blue-500 shadow p-3">
            <div class="card-body">
                <?php showError();showMsg(); ?>
                <a href="index.php" class="btn btn-sm bg-purple-400 hover:bg-purple-600 mb-2" >Back </a>
                <form action="" method="post" class="form-group">
                    <?php $data=getOne('select * from category where slug=?',[$slug])  ?>
                <input type="text" name="name" value="<?php echo $data->name; ?>"  class="text-bold form-control">
                <button type="submit" name="submit" class="mt-2 rounded btn btn-sm bg-cyan-400 hover:bg-cyan-700">Update</button>
                </form>
            </div>
        </div>
</div>
<?php include '../includes/footer.php';
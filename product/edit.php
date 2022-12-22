<?php
include '../init.php';
include '../includes/header.php';
if(isset($_GET['slug']) && (!empty($_GET['slug']))){
    $slug=$_GET['slug'];
    $product=getOne('select * from product where slug=?',[$slug]);
    if(!$product){
        setError('Wrong slug');
        go('index.php');
        die();
    }
    else{
        if(isset($_POST['submit'])){
            $name=$_POST['name'];
            $image=$_FILES['image'];
            $description=$_POST['description'];
            $sale_price=$_POST['sale_price'];
            $category_id=$_POST['category_id'];
            $image_name=slug($image['name']);
            //extansion
            $extansion=pathinfo($image_name,PATHINFO_EXTENSION);    
            $allowed=array('png','jpg','jpeg','gif');
            if(empty($image['name'])){
                setError('please choose one photo');
                
            }
            else{
            if($image['size'] > 10485760){
                        setError('file size too large');
                    }
            elseif( in_array($image_name,$allowed)){
                        setError('extansion not allowed');
                    }
            elseif(file_exists('../image/'.$product->image))
                    {
                        unlink('../image/'.$product->image);
                    }
            else{
                    $path='../image/'.$image_name;
                    $tmp=$image['tmp_name'];
                    move_uploaded_file($tmp,$path);
                    $sql=query("
                        update product set name=?, category_id=?, image=?, description=?, sale_price=? where slug='$slug'
                    ",[$name,$category_id,$image_name,$description,$sale_price]);
    
                    if($sql){
                        setMsg('updated successfully');
                        go('index.php');
                     }
                    }
                    }
                }
                }
            }
            

else{
    setError('Wrong slug');
    go('index.php');
    die();
}
$category=getAll('select * from category');
?>
<div class="container">
    <form class="form-group" action="" enctype="multipart/form-data" method="post">
        <a href="index.php" class="btn btn-dark">Back</a>
        <div class="form-row mt-4 ">
                <div class="col-md-12">
                    <div class="card bg-info p-3">
                        <h2 class="text-3xl text-white font-bold">Product info</h2>
                    <label class="mt-2" for="Category" >Category</label>

                    <?php showError(); showMsg(); ?>
                    <select name="category_id" class="form-control">
                        <?php foreach($category as $c ) {
                            $selected= $c->id == $product->category_id ? 'selected' : ''; ?>
                        <option value="<?php echo $c->id ?>" $selected class="form-control"><?php echo $c->name ?></option>
                        <?php  } ?>
                    </select>
                    <label for="name">Enter product name</label>
                    <input type="text" name="name" value="<?php echo $product->name; ?>" class="form-control">
                    <label for="image">Choose image</lael>
                    <input type="file" name="image" class="form-control">
                    <img src="<?php echo'http://localhost/stock_managment/image/'.$product->image; ?>" class="img-fluid img-thumbnail" height="200" width="200">
                    <br>
                    <label for="desc">Description</label>
                    <textarea name="description" class="form-control"><?php echo $product->description; ?> </textarea>
                    <label for="">Sale price</label>
                        <input type="text" value="<?php echo $product->sale_price; ?>" class="form-control" name="sale_price">
                    </div>
                </div>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn btn-warning" type="submit" name="submit">Update</button>
                </div>
        </div>
</form>
</div>

<?php
include '../includes/footer.php';
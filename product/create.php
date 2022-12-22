<?php
require '../includes/header.php';
require '../init.php';
if(!$_SESSION['user']){
    setError('Please login first.');
    go('../login.php');
}
$category=getAll('select * from category');
if(isset($_POST['submit'])){
    $category_id=$_POST['category_id'];
    $slug=slug($_POST['name']);
    $name=$_POST['name'];
    $image=$_FILES['image'];
    $image_name=slug($image['name']);
    $description=$_POST['description'];
    $sale_price=$_POST['sale_price'];
    $total_quantity=$_POST['total_quantity'];
    $buy_price=$_POST['buy_price'];
    $date=$_POST['date'];
    $extansion=pathinfo($image_name,PATHINFO_EXTENSION);
    $allow=array('img','png','jpeg','jpg','gif','webp');
   if(empty($name) || empty($image) || empty($description) || empty($sale_price) || empty($total_quantity) || empty($buy_price)){
    setError('Please fill out all requirement');
   }
   else{
    if( $image['size'] > 10485760 ){
        setError('Image size too large to upload');
    }
    elseif( !in_array($extansion,$allow)){
        setError('Extansion not allowed');
    }
    else{
        $path='../image/'.$image_name;
        $tmp=$image['tmp_name'];
        move_uploaded_file($tmp,$path);
        query('
        insert into product (category_id,slug,name,description,image,total_quantity,sale_price) value (?,?,?,?,?,?,?)
        ',[$category_id,$slug,$name,$description,$image_name,$total_quantity,$sale_price]);
        $product_id=$conn->lastInsertId();
        query('
            insert into product_buy(product_id,buy_price,total_quantity,buy_date)value(?,?,?,?)
        ',[$product_id,$buy_price,$total_quantity,$date]);
        setMsg('Product created successfully');
        go('index.php');
    }
   }

}
?>
<div class="container">
<a href="index.php" class="btn btn-sm bg-purple-300 hover:bg-purple-600">Back</a>
    <form class="form-group" action="" enctype="multipart/form-data" method="post">
        <div class="form-row mt-4 ">
                <div class="col-md-6">
                    <div class="card bg-blue-500 shadow p-3">
                    <?php showError();  ?>
                        <p class="text-3xl text-white font-bold">Product info</p>
                    <label class="mt-2" for="Category" >Category</label>
                    <select name="category_id" class="form-control">
                        <?php foreach($category as $c ) { ?>
                        <option value="<?php echo $c->id ?>" class="form-control"><?php echo $c->name ?></option>
                        <?php  } ?>
                    </select>
                    <label for="name">Enter product name</label>
                    <input type="text" name="name" class="form-control">
                    <label for="image">Choose image</label>
                    <input type="file" name="image" class="form-control">
                    <label for="desc">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="card bg-blue-500 shadow p-3">
                        <p class="text-3xl font-bold text-white">Invontery</p>
                        <span class="mt-3 text-yellow-200">
                        <span class="fa fa-info-circle"></span>For sale info
                        </span>
                        <label for="">Sale price</label>
                        <input type="text" class="form-control" name="sale_price">
                        <span class="text-yellow-200">
                        <span class="fa fa-info-circle"></span>For buy info
                        </span>
                        <label for="">Total quantity</label>
                        <input type="text" class="form-control" name="total_quantity">
                        <label for="">By price</label>
                        <input type="text" class="form-control" name="buy_price">
                        <label for="">Date</label>
                        <input type="date" value="<?php echo date('Y-m-d');  ?>" class="form-control" name="date">
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-success shadow" type="submit" name="submit">Create</button>
                </div>
        </div>
</form>
</div>
<?php
require '../includes/footer.php';
?>
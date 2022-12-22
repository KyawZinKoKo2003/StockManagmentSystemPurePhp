<?php
include '../includes/header.php';
include '../init.php';
if(!$_SESSION['user']){
    setError('Please login first.');
    go('login.php');
}
if(isset($_GET['page'])){
    paginateCategory(1);
    die();
}
?>
    <div class="container px-4">
        <h1 class=" text-bold">Category</h1>
            <div class="card bg-info  mt-3">
                <div class="card-body">
                <?php showMsg();showError(); ?>
            <a href="create.php" class='btn btn-warning  mb-2 shadow '>Create</a>
            <table class="table table-striped text-white">
                <tr>
                    <td>Category</td>
                    <td>Option</td>
                </tr>
                <tr id="tbldata">
                <?php $data=getAll('select * from category order by id desc limit 2');
                foreach($data as $d){ ?>
                    <td><?php echo $d->name ?> </td>
                    <td>
                        <a href="edit.php?slug=<?php echo $d->slug ?>" class="btn btn-sm btn-outline-warning " > <span class="fa fa-edit"></span>Edit</a>
                        <a href="delete.php?slug=<?php echo $d->slug ?>" class="btn btn-sm btn-outline-danger  "><span class="fa fa-trash"></span>Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <div class="text-center">
                <div class="btn bg-purple-400 hover:bg-purple-900" id="fetchData"><span class="fa fa-arrow-down"></span></div>
            </div>
                </div>
            </div>
    </div>
   
<?php include '../includes/footer.php'; ?>
<script>
$(function(){
    page=2;
    var btn=$('#fetchData');
    var tblData=$('#tblData');
    btn.click( () =>{
        page +=1;
        $.get(`index.php?page=${page}`)
        .then( data =>{
        const d=jQuery.parseJSON(data);
        console.log(d);
    })
    .catch( err=>{
        console.log(err)
    })
    })
    })

</script>
 
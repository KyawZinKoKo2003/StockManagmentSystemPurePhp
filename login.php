<?php
include('init.php');
if(isset($_SESSION['user'])){
    go('index.php');
}
    $errors=[];
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    if(empty($email)){
        setError('please enter email');
    }
    if(empty($password)){
        setError('please enter password');
    }
    $user=getOne('select * from users where email=?',
        [$email]);
        if(!$user){
            setError('Email not found');
        }
        if($user){
            $var=password_verify($password,$user->password);
            if(!$var){ 
                setError('Wrong pasword');
            }
        }
    if(!hasError()){
        $_SESSION['user']= $user;
        go('index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Stock Managment</title>
</head>
<div class="container">
    <div class="card shadow-md p-3 my-3 w-25 mx-auto">
        <div class="card-title text-center text-3xl  ">Login</div>
        <?php showError(); ?>
        <form action="" method="post" class='form-group'>
            <label for="">Email</label>
            <input type="text" name="email" class='form-control' placeholder="Enter email">
            <label for="">Password</label>
            <input type="text" name="password" class='form-control' placeholder="Enter password">
            <button type="submit" name="submit" class="form-control btn bg-cyan-500 btn-block my-2">Login</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>
</html>
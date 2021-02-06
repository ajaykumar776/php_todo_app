<?php include "config.php"  ?>

<?php
$error="";
$message="";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    try{
        $username= trim($_POST['name']);
        $useremail= trim($_POST['email']);
        $userpass= trim($_POST['password']);
        $confmpass= trim($_POST['confirmpass']);

        if(!$username) throw new Exception ("Name is required");
        if(!$useremail) throw new Exception ("Email is Reqired");
        if(!$userpass) throw new Exception ("password is required");
        if(!$confmpass) throw new Exception ("confirm_password is Reqired");

        $result =  mysqli_query($con, "select * from users where user_email = '$useremail'");
        $user = mysqli_fetch_assoc($result);

        if($user) throw new Exception ("email has already taken");

        if($userpass!=$confmpass) throw new Exception("password does not matched.");

        $query= "insert into users values(null,'$username','$useremail','$userpass')";
        $query_run = mysqli_query($con,$query);
        $_SESSION['id'] = $query['id'];

        if($query_run)
        {
            header('location:login.php');
        }else
        {
            $error = "Something Went Wrong.";
        }
    }catch(Exception $e){
        $error= $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
   <div class="conatiner">
       <div class="col-sm-4 col-sm-4"></div>
       <div class="col-sm-4 col-sm-4">
           <form method="POST" style="margin-top:115px">
                <a href="google_api_login/index.php" class="google btn btn-block form-control"><i class="fa fa-google fa-fw">login with google account</i></a>                
                <h1 style="text-align: center;" >Sign-up</h1><br>
                <label for="Name">Name</label>
                <input type="text" name="name"id="" class="form-control"required>
                <label for="email">Email</label>
                <input type="text" name="email" id="" class="form-control"required> 
                <label for="Name">password</label>
                <input type="password" name="password"id="" class="form-control"required>
                <label for="Name">confirm-password</label>
                <input type="password" name="confirmpass"id="" class="form-control"required>
                <input type="submit" name="btn" id="sbtn" class=" btn btn-success">
                <p style="color:black">if you have already register : <a href="login.php">click here to login</a></p>
           </form>
           <?php if($error){
               echo '<div  class="alert alert-danger">'.$error.'</div>';
           }?>
           <?php if($message){
            echo '<div class="alert alert-success">'.$message.'</div>';
           }?>
       </div>
       <div class="col-sm-4 col-sm-4"></div>
   </div> 
</body>
</html>
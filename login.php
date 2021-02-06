<?php
include "config.php";
$error   = "";
$message = "";
if($_SERVER['REQUEST_METHOD']=="POST")
{
    try{
        $useremail = trim($_POST['email']);
        $userpass  = trim($_POST['password']);
        if(!$useremail) throw new Exception("email is required");
        if(!$userpass) throw new Exception("password is required");
        
        $result = mysqli_query($con,"select * from users where user_email = '$useremail' and user_password = '$userpass'");
        $user = mysqli_fetch_assoc($result);
        // echo json_encode($user);die;
        $_SESSION['name']  = $user['user_name'];
        $_SESSION['email'] = $user['user_email'];
        $_SESSION['id']    =  $user['id'];
        

        if(!$user) throw new Exception("Correct Email is required !");
        if($user)
        {
            header('Location: index1.php');

        }else
        {
            $error = "database error .....";
        }

    }catch(Exception $e){
        $error = $e->getmessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <div class="container">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <?php if($error){
                echo '<div class ="alert alert-danger">'.$error.'</div>';
            }?>
            <?php if($message):?>
                <div class="alert alert-success"><?php echo $message ?></div>
                <?php endif;?>
            <form action="" style="margin-top:150px"method="post">
                <h1 style="text-align: center;">Sign-In</h1>
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
                <label for="password">password</label>
                <input type="password" name= "password" id="" class="form-control">
                <input type="submit" name="sbtn" id="sbtn" class="btn btn-success">
                <p>if you have not registered <a href="index.php"> click here to Register </a></p>
            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>
</body>
</html>
<?php
include "config.php";
        $query= "select *from tasks where id = $_GET[id]";
        $query_run = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($query_run);


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = trim($_POST["id"]);
        $updated_task = trim($_POST["new_task"]);
        $query = "update tasks set task = '$updated_task'where id ='$id'";
        $query_run = mysqli_query($con,$query);
        if($query_run){
            header('location: index1.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update_task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"id="etask" style="margin-top:120px">
                <form action="" method="post">
                    <div class="form-group">
                        <label>ID:</label>
                        <input type="text" class="form-control" name="id" value="<?php echo $data['id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="pwd">TASK:</label>
                        <input type="text" class="form-control" name="new_task" value="<?php echo $data['task']; ?>"required>
                    </div>
                    
                    <button type="submit" class="btn btn-info">update</button>
                </form> 
            </div>
            <div class="col-xm-4"></div>
        </div>
    </div>
</body>
</html>
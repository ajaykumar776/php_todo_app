<?php include "config.php"?>
<?php 
    $message = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            $todo = trim($_POST['task']);
            $sql = "insert into tasks value(null, '$_SESSION[id]','$todo')";
            $message = mysqli_query($con,$sql);

        }catch(Exception $e){		
        $error = $e->getMessage();
        }		/*we will store the error in variable*/
	}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
   <div class="container-fluid">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Solution.com</a>
            </div>
            <center ><font style="color:white;text-align:center"><span><strong >welcome:<span style="color:yellow;"><?php echo $_SESSION['name'];?></span></strong></span></font></center>
            <center ><font style="color:white;text-align:center"><span><strong >Email:<span style="color:green;"><?php echo $_SESSION['email'];?></span></strong></span></font></center>
        </nav>
        <div clsss="row">
            <div class="col-xm-2 col-sm-3"id="col1"></div>
            <div class="col-xm-8 col-sm-6">
                <div class="row">
                    <nav class="navbar navbar-inverse">
                        <a href="index.php"id="todo"class="navbar-brand"><p>TO DO APP</p></a>
                    </nav>
                </div>
                <!-- form -->
                <div class="row">
                    <form method="post">
                        <input type="text"name="task"class="form-control" id="task" required>
                        <input type="submit" name="btn" class="btn btn-success form-control"id="subbtn">
                    </form>
                </div> 
                <div class="row" id="td">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.no.</th>
                                <!-- <th>Id</th> -->
                                <th>Task</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                            $query="select *from tasks where '$_SESSION[id]' = user_id ";
                            $query_run= mysqli_query($con,$query);
                            while($row= mysqli_fetch_assoc($query_run))
                            {
                        ?>
                        <tr>
                            <td class="counterCell"></td>
                            <td><?php echo $row['task'];?></td>
                            <td><?php echo date("d-m-y");?></td>
                            <td><?php echo date("h:i:sa");?></td>
                            <td>
                                <button class="btn btn-default" name=""><a href="update.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil"></i></a></button>
                                <button class="btn btn-default" name=""><a href="delete.php?id=<?php echo $row['id'];?>"><i class="fa fa-trash-o"></i></a></button>
                            </td>
                        </tr>  
                          <?php
                        }
                        ?>
                    </table>
                </div>  
            </div>
            <div class="col-xm-2 col-sm-3"></div>
        </div>
   </div> 
</body>
</html>
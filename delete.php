<!--Name and Surname: Abdulla Ydyrys;
	Date end: 14.09.2019;
	Email: 170103125@stu.sdu.edu.kz;
	Description: Delete.php to delete an User account
-->

<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){
    //connect.php
    require_once "connect.php";
    
    // Delete statement
    $sql = "DELETE FROM Users WHERE ID = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            // Deleted successfully
            header("location: index.php");
            exit();
        } else{
            echo "An error occurred. Please try again later!";
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);   
    // Close connection
    mysqli_close($conn);
} 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .container{
            width: 500px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header text-info">
                        <h1>Delete User</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-info fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this User?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
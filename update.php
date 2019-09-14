<!--Name and Surname: Abdulla Ydyrys;
	Date end: 14.09.2019;
	Email: 170103125@stu.sdu.edu.kz;
	Description: Update.php to update an User account
-->

<?php
//connect.php
require_once "connect.php";
 
// Define variables
$name = $surname = $email = "";
$name_err = $surname_err = $email_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get id from User
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name";
    } else{
        $name = $input_name;
    }
    
    // Validate surname
    $input_surname = trim($_POST["surname"]);
    if(empty($input_surname)){
        $surname_err = "Please enter a surname";     
    } elseif(!filter_var($input_surname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $surname_err = "Please enter a valid surname";
    }else{
        $surname = $input_surname;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email";     
    } else{
        $email = $input_email;
    }
    
    if(empty($name_err) && empty($surname_err) && empty($email_err)){
        // update statement
        $sql = "UPDATE Users SET Name=?, Surname=?, Email=? WHERE ID=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_surname, $param_email, $param_id);
            // Set parameters
            $param_name = $name;
            $param_surname = $surname;
            $param_email = $email;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                // Updated successfully
                header("location: index.php");
                exit();
            } else{
                echo "An error occurred. Please try again later!";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    } 
    // Close connection
    mysqli_close($conn);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get id from URL
        $id =  trim($_GET["id"]);
        
        //select statement
        $sql = "SELECT * FROM Users WHERE ID = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            // Set parameters
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    // Retrieve value
                    $name = $row["Name"];
                    $surname = $row["Surname"];
                    $email = $row["Email"];
                }
            } else{
                echo "An error occurred. Please try again later!";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    } 
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
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
                        <h2>Update User</h2>
                    </div>
                    <p class="text-danger">Please edit and submit to update the User.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="help-block">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="text-danger"><?php echo $name_err;?></span>
                        </div>
                        <div class="help-block">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" value="<?php echo $surname; ?>">
                            <span class="text-danger"><?php echo $surname_err;?></span>
                        </div>
                        <div class="help-block">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="text-danger"><?php echo $email_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-info" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
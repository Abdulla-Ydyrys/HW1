<!--Name and Surname: Abdulla Ydyrys;
	Date end: 14.09.2019;
	Email: 170103125@stu.sdu.edu.kz;
	Description: Create.php to create a new User account
-->
<?php
//connect.php
require_once "connect.php";
 
// Define variables
$name = $surname = $email = "";
$name_err = $surname_err = $email_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name";
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
    } else{
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
        // insert statement
        $sql = "INSERT INTO Users (Name, Surname, Email) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "sss",  $param_name, $param_surname, $param_email); 
            // Set parameters
            $param_name = $name;
            $param_surname = $surname;
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt)){
                //Created successfully
                header("location: index.php");
                exit();
            } else{
                echo "An error occurred. Please try again later!";
            }
        }   
        //Close statement
        mysqli_stmt_close($stmt);
    }
    //Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
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
                        <h2>Create User</h2>
                    </div>
                    <p class="text-danger">Please fill out the following form completely.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="help-block">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control " value="<?php echo $name; ?>">
                            <span class="text-danger"><?php echo $name_err;?></span>
                        </div>
                        <div class="help-block">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" value="<?php echo $surname; ?>">
                            <span class="text-danger"><?php echo $surname_err;?></span>
                        </div>
                        <div class="help-block">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="text-danger"><?php echo $email_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-info" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
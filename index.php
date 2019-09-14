<!--Name and Surname: Abdulla Ydyrys;
	Date end: 14.09.2019;
	Email: 170103125@stu.sdu.edu.kz;
	Description: Main page
-->

<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
        .container{
            width: 650px;
        }
        .header h1{
            margin-top: 60px;
        }
        table tr td:last-child a{
            margin-right: 18px;
        }
        .text-right {
        	 margin-top: -45px;
        	 margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="header page-header text-left text-info">
                        <h1>User details</h2> 
                     <div class="text-right">
                        <a href="create.php" class="btn btn-info">Create New User</a>
                    </div>                       
                </div>
                    <?php
                    // connect.php
                    require_once "connect.php";               
                    //select query
                    $sql = "SELECT * FROM Users";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                  		echo "<th>ID</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Surname</th>";
                                        echo "<th>Email</th>";
                              			echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID'] . "</td>";
                                        echo "<td>" . $row['Name'] . "</td>";
                                  		echo "<td>" . $row['Surname'] . "</td>";
                                        echo "<td>" . $row['Email'] . "</td>";
                                        echo "<td>";                                      
                                            echo "<a href='update.php?id=". $row['ID'] ."' title='Update User' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['ID'] ."' title='Delete User' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                        } else{
                            echo "<p class='lead'><em>Users not found</em></p>";
                        }
                    } else{
                        echo "ERROR: Connection failed: " . mysqli_error($conn);
                    }
                    //Close connection
                    mysqli_close($conn);
                    ?>
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
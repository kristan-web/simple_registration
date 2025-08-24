<?php include('header.php');

$alert="";
function checkPassLength($password){
    $length = strlen($password);
    if($length<8){
        return true;
    }
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $check_sql = "SELECT * FROM tbl_users WHERE username='$username'";
    $result=$myConn->query($check_sql);

    if($result->num_rows>0){
        echo "<script>alert('The Username has already been taken')</script>";
    }
    else{
        if(empty($username) || empty($password) || empty($confirm_password)){
            echo "<script>alert('All fields is required!')</script>";
        }
        else if($password!=$confirm_password){
            echo "<script>alert('Password does not match!')</script>";
        }
        else if(checkPassLength($password)){  
            echo "<script>alert('Password must be longer than 8 characters!')</script>";
         }
        else{
            $sql="INSERT INTO tbl_users(username,password) VALUES ('$username','$password')";
            $result=$myConn->query($sql);

            if($result==true){
                echo "<script>alert('Register successful')</script>";
            }
            
        }

    }
}
?> 
<div class="container">
    <div class="card text-center mt-5">
        <div class="card-header">Registration</div>
        <div class="card-body text-center">
            <form method="POST">
                <label class="form-label">Username: </label>
                <input class="form-control" type ="text" name="username"><br><br>
                <label class="form-label">Password: </label>
                <input class="form-control" type ="password" name="password"><br><br>
                <label class="form-label">Confirm Password: </label>
                <input class="form-control" type ="password" name="confirm_password"><br><br>
                <button class="btn btn-primary">submit</button>
            </form>
        </div>
    </div>
</div>


<?php include('footer.php');?> 
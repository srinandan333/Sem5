<?php      
    include('conn.php');  
    $email = $_POST['email'];  
    $password = $_POST['password'];  
       
    $email = stripcslashes($email);  
    $password = stripcslashes($password);  
    $email = mysqli_real_escape_string($conn, $email);  
    $password = mysqli_real_escape_string($conn, $password);  
    
    $sql = "select * from admin where email = '$email' and password = '$password'";  
    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);
	if($count == 1)
	{  
        header('location:home.html');
    }
    else
	{  
        header('location:index.html');  
    }   
?> 
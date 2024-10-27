<?php include 'server.php';
    session_start();
    $username = $_SESSION['username'];
    $sql = "SELECT* FROM customers WHERE username = '$username'";
    $query = mysqli_query($conn, $sql);
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['UserID'] = $row['UserID'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['email'] = $row['email'];
    }else{
    }
?>
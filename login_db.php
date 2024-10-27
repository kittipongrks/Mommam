<?php 
    session_start();
    include('server.php');

    $errors = array();

    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);

        if (empty($username)) {
            array_push($errors, "* Username is required");
        }

        if (empty($password)) {
            array_push($errors, "* Password is required");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM customers WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Your are now logged in";

                $user = mysqli_fetch_assoc($result);
                $User_status = $user['User_status'];

                if ($User_status == 'ADMIN') {
                    $_SESSION['username'];
                    $_SESSION['role'] = 'ADMIN' ;
                    header("location: adminpage1.php"); // ไปหน้า adminpage.php ถ้า status เป็น admin
                }elseif ($User_status == 'USER') {
                    $_SESSION['username'];
                    $_SESSION['role'] = 'USER' ;
                    header("location: profile.php"); // ไปหน้า profile.php ถ้า status เป็น user
                }
                
            } else {
                array_push($errors, "!!! Wrong Username or Password");
                $_SESSION['error'] = "!!! Wrong Username or Password!";
                header("location: login.php");
            }
        } else {
            array_push($errors, "* Username & Password is required");
            $_SESSION['error'] = "* Username & Password is required";
            header("location: login.php");
        }
    }

?>

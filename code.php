<?php
session_start();
include('config/dbcon.php');

// User login code
if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM users where email='$email' AND password='$password' LIMIT 1";
    $query_run = mysqli_query($con, $query); 
    foreach($query_run as $row)
    {
        $user_id = $row['id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
    }
    $check_row = mysqli_num_rows($query_run) > 0;
    if($check_row)
    {
        if(isset($_SESSION['admin']) && isset($_SESSION['adminlogin']))
        {
            unset($_SESSION['admin']);
            unset($_SESSION['adminlogin']);
        }
        $_SESSION['auth'] = [
            'auth_id' => $user_id,
            'email' => $email,
            'fname' => $fname,
            'lname' => $lname,
        ];
        $_SESSION['login'] = "true";
        $_SESSION['status'] = "Logged In Successfully";
        header('location: index.php');
    }
    else
    {
        $_SESSION['status'] = "Invalid credentials";
        header('location: login.php');
    }
}

// User register code
if(isset($_POST['reg_btn']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $check_email = "SELECT * FROM users where email='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email); 

    if(mysqli_num_rows($check_email_run) > 0)
    {
        redirect("register.php","Email already registered");
    }
    else
    {
        if($password != $cpassword)
        {
            $_SESSION['status'] = "Passords do not match";
            header('location: register.php');
        }
        else
        {
            $query = "INSERT INTO users (fname,lname,phone,gender,email,password) 
            VALUES ('$fname','$lname','$phone','$gender','$email','$password')"; 
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                $_SESSION['status'] = "You have registered Successfully";
                header('location: login.php');
            } 
            else{
                echo "Something went wrong";
            }
        }
    }
}

// Confirm room booking
if(isset($_POST['confirm_book_btn']))
{
    if($_POST['confirm_book_btn'] == "1")
    {
        $paymentmode = "Cash";
    }
    else if($_POST['confirm_book_btn'] == "2")
    {
        $paymentmode = "Online Payment";
    }
    $roomid = $_POST['bookroomid'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $userid = $_SESSION['auth']['auth_id'];
    $roomprice = $_POST['totalprice'];
    if(isset($_SESSION['login']))
    {
        $userid = $_SESSION['auth']['auth_id'];
    }
    else
    {
        redirect("login.php","Login to continue your booking");
        exit(0);
    }

    $chk_aval ="SELECT room_id FROM bookings WHERE room_id='$roomid'AND( 
    (checkin <= '$checkin' AND checkout >='$checkout') OR 
    (checkin >= '$checkin' AND checkin <='$checkout') OR 
    (checkin <= '$checkin' AND checkout >='$checkin')  )";


    $chk_aval_run = mysqli_query($con, $chk_aval);

    $roomqty_query = "SELECT * FROM rooms WHERE id='$roomid' LIMIT 1";
    $roomqty_query_run = mysqli_query($con, $roomqty_query);
    $omrow = mysqli_fetch_array($roomqty_query_run);
    $roomqty = $omrow['room_qty'];

    if(mysqli_num_rows($chk_aval_run) < $roomqty)
    {
        $conf_book_query = "INSERT INTO bookings (room_id, user_id, checkin, checkout, price, payment_mode)
        VALUES ('$roomid','$userid','$checkin','$checkout','$roomprice','$paymentmode')";

        $conf_book_query_run = mysqli_query($con, $conf_book_query);

        if($conf_book_query_run)
        {
            redirect("bookings.php","Your room has been successfully booked");
        }
        else{
            redirect("index.php","Something went Wrong!");
        }       
    }
    else
    {
        redirect("index.php","Something went Wrong!");
    }
}

// Update User Profile
if(isset($_POST['update_profile_btn']))
{
    $uid = $_SESSION['auth']['auth_id']; 
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $update_query = "UPDATE users SET fname='$fname', lname='$lname', phone='$phone', gender='$gender' WHERE id='$uid' ";
    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        redirect("profile.php","Profile Updated Successfully");
    } 
    else{
        redirect("profile.php","Something went Wrong");
    }
}

?>


<?php
include('../config/dbcon.php');
session_start();

// Ban/Unban the user
if(isset($_POST['ban_user']))
{
    $uid = $_POST['ban_user'];
    $ban_query = "UPDATE users SET status='1' WHERE id='$uid'";
    $ban_query_run =  mysqli_query($con, $ban_query);
    if($ban_query_run)
    {
        redirect("users.php","User banned Successfully");
    }
    else
    {
        redirect("users.php","Something Went wrong");
    }
}

// Unban/ Unblock the user
if(isset($_POST['unban_user']))
{
    $uid = $_POST['unban_user'];
    $ban_query = "UPDATE users SET status='0' WHERE id='$uid'";
    $ban_query_run =  mysqli_query($con, $ban_query);
    if($ban_query_run)
    {
        redirect("users.php","User unbanned Successfully");
    }
    else
    {
        redirect("users.php","Something Went wrong");
    }
}

// Adding new room
if(isset($_POST['add_room_btn']))
{
    if($_FILES['room_image']['name'] != '')
    {
        $roomname = $_POST['room_name'];
        $doorno = $_POST['door_no'];
        $roomqty = $_POST['noofrooms'];
        $capacity = $_POST['capacity'];
        $price = $_POST['price']; // Capture the price
        $desc = $_POST['description'];

        if(isset($_POST['visibility']))
        {
            $status = "1"; 
        }
        else
        {
            $status = "0";
        }

        $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
        $filename = $_FILES['room_image']['name'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($file_extension, $allowed_extension)) 
        {
            $_SESSION['status'] = "You are allowed to upload only jpg, png, jpeg, and gif";
            header('Location: add.php');
        }
        else
        {
            if(file_exists("../uploads/" . $_FILES['room_image']['name']))
            {
                $filename = $_FILES['room_image']['name'];
                $_SESSION['status'] = "Image already exists: ".$filename;
                header('Location: add.php');
            }
            else
            {
                $add_query = "INSERT INTO rooms (room_name, door_no, capacity, room_qty, description, price, room_image, status) 
                              VALUES ('$roomname', '$doorno', '$capacity', '$roomqty', '$desc', '$price', '$filename', '$status')";
                $add_query_run = mysqli_query($con, $add_query);
            
                if($add_query_run)
                {
                    move_uploaded_file($_FILES["room_image"]["tmp_name"], "../uploads/".$filename);
                    $_SESSION['status'] = "Room added successfully";
                    header('Location: add.php');
                }
                else
                {
                    $_SESSION['status'] = "Something went wrong";
                    header('Location: add.php');
                }
            }
        }
    }
    else
    {
        redirect("add.php", "Image field cannot be empty");
    }
}

// updating the room details
if(isset($_POST['update_room_btn']))
{
    $room_id = $_POST['room_id'];
    $roomname = $_POST['room_name'];
    $doorno = $_POST['door_no'];
    $roomqty = $_POST['noofrooms'];
    $capacity = $_POST['capacity'];
    if(isset($_POST['visibility']))
    {
        $status = "1"; 
    }
    else{
        $status = "0";
    }
    $desc = $_POST['description'];

    $new_image = $_FILES['room_image']['name'];
    $old_image = $_POST['room_image_old'];

    if($new_image != '')
    {
        $update_filename = $new_image;
    }
    else
    {
        $update_filename = $old_image;
    }

    if($new_image !='')
    {
        if(file_exists("../uploads/" . $new_image))
        {
            $filename = $new_image;
            redirect("rooms.php","Image already Exists ".$filename);
        }
    }
    $query = "UPDATE rooms SET room_name='$roomname', door_no='$doorno', capacity='$capacity', room_qty='$roomqty', description='$desc', room_image='$update_filename', status='$status' WHERE id='$room_id' ";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        if($new_image !='')
        {
            move_uploaded_file($_FILES["room_image"]["tmp_name"], "../uploads/".$_FILES["room_image"]["name"]);
            unlink("../uploads/".$old_image);
        }
        redirect("rooms.php", "Data Updated Successfully");
    }
    else
    {
        redirect("rooms.php","Data NOT Updated.!");
    }
}

// delete rooms 
if(isset($_POST['delete_room']))
{
    $room_id = $_POST['delete_room'];
    $delquery = "DELETE FROM rooms WHERE id='$room_id' ";
    $delquery_run = mysqli_query($con, $delquery);

    if($delquery_run)
    {
        redirect("rooms.php","Room Deleted Successfully");
    }
}

// delete bookings 
if(isset($_POST['delete_booking']))
{
    echo "Booking ID to delete: " . $_POST['delete_booking'];
    $booking_id = $_POST['delete_booking'];
    $delquery = "DELETE FROM bookings WHERE id='$booking_id' ";
    $delquery_run = mysqli_query($con, $delquery);

    if($delquery_run)
    {
        redirect("bookings.php","Booking canceled Successfully");
    }
}
// Update Booking Status Deny
if(isset($_POST['Deny_bookingst_btn']))
{
    $booking_id = $_POST['Deny_bookingst_btn'];
    $update_query = "UPDATE bookings SET Status='Denied' WHERE id='$booking_id' ";
    $delquery_run = mysqli_query($con, $update_query);

    if($delquery_run)
    {
        redirect("bookings.php","Booking Denied Successfully");
    } 
}
// Update Booking Status Approve
if(isset($_POST['Approve_bookingst_btn']))
{
    $booking_id = $_POST['Approve_bookingst_btn'];
    $update_query = "UPDATE bookings SET Status='Approved' WHERE id='$booking_id' ";
    $delquery_run = mysqli_query($con, $update_query);

    if($delquery_run)
    {
        redirect("bookings.php","Booking Approved Successfully");
    } 
}

// Admin login
if(isset($_POST['admin_login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM admins where email='$email' AND password='$password' AND status='0' LIMIT 1";
    $query_run = mysqli_query($con, $query); 
    $rowom = mysqli_fetch_array($query_run);
    $name = $rowom['name'];
    $super_admin = $rowom['super_admin'];

    $check_row = mysqli_num_rows($query_run) > 0;
    if($check_row)
    {
        if(isset($_SESSION['auth']) && isset($_SESSION['login']))
        {
            unset($_SESSION['auth']);
            unset($_SESSION['login']);
        }
        $_SESSION['admin'] = [
            'email' => $email,
            'name' => $name,
            'role' => $super_admin,
        ];
        $_SESSION['adminlogin'] = "true";
        $_SESSION['status'] = "Admin Logged In Successfully";
        header('location: dashboard.php');
    }
    else
    {
        $_SESSION['status'] = "Invalid credentials";
        
        header('location: login.php');
    }
}

// Update admin details || Only super admin will have this privilage
if(isset($_POST['update_admin_details']))
{   
    $id = $_POST['admin_id'];
    $name = $_POST['admin_name'];
    $email = $_POST['admin_email'];
    $phone = $_POST['admin_phone'];

    $update_query = "UPDATE admins SET name='$name', email='$email', phone='$phone' WHERE id='$id' ";
    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run) 
    {
        redirect("admins.php","Details updated Successfully for $name");
    }
    else
    {
        redirect("admins.php","Something went Wrong");
    }
}

// Add admin || Only super admin will have this privilage
if(isset($_POST['add_admin']))
{   
    $name = $_POST['admin_name'];
    $email = $_POST['admin_email'];
    $phone = $_POST['admin_phone'];
    $password = $_POST['admin_password'];
    
    $check_email = "SELECT * FROM admins where email='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email); 

    if(mysqli_num_rows($check_email_run) > 0)
    {
        redirect("admins.php","Email already exists");
    }
    else
    {
        $add_query = " INSERT INTO admins (name,email,phone,password) VALUES ('$name','$email','$phone','$password') ";
        $add_query_run = mysqli_query($con, $add_query);

        if($add_query_run) 
        {
            redirect("admins.php","$name has been Added as Admin");
        }
        else
        {
            redirect("admins.php","Something went Wrong");
        }
    }
}

// Ban admin || Only super admin will have this privilage
if(isset($_POST['ban_admin']))
{
    $uid = $_POST['ban_admin'];
    $ban_query = "UPDATE admins SET status='1' WHERE id='$uid'";
    $ban_query_run =  mysqli_query($con, $ban_query);
    if($ban_query_run)
    {
        redirect("admins.php","User banned Successfully");
    }
    else
    {
        redirect("admins.php","Something Went wrong");
    }
}

// Unban admin || Only super admin will have this privilage
if(isset($_POST['unban_admin']))
{
    $uid = $_POST['unban_admin'];
    $ban_query = "UPDATE admins SET status='0' WHERE id='$uid'";
    $ban_query_run =  mysqli_query($con, $ban_query);
    if($ban_query_run)
    {
        redirect("admins.php","User unbanned Successfully");
    }
    else
    {
        redirect("admins.php","Something Went wrong");
    }
}

?>
<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Max-Age: 1728000');
header("Content-Length: 0");
header("Content-Type: text/plain"); 

   $conn = new mysqli("localhost", "root", "", "vue_crud");
   if($conn->connect_error){
       die("connection failded".$conn->connect_error);
   }
   $result = array('error' => false);
   $action = '';

   if(isset($_GET['action'])){
       $action = $_GET['action'];
   }

   if($action == 'read'){
       $sql = $conn->query("SELECT * FROM users");
       $users = array();
       while($row = $sql->fetch_assoc()){
           array_push($users, $row);
       }
       $result['users'] = $users;
   }

      //to insert user into users table
   if($action == 'create'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = $conn->query("INSERT INTO users (name, email, phone)  VALUES('$name', '$email', '$phone')");

    if($sql){
        $result['message'] = "User is added successfully";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to add user";
    }
}

      //to update user into users table
   if($action == 'update'){
    $id = $_POST['id'];   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = $conn->query("UPDATE users SET name='$name',email='$email',phone='$phone' WHERE id='$id'");

    if($sql){
        $result['message'] = "User is updated successfully";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to update user";
    }
}
   //to delete user into users table
   if($action == 'delete'){
    $id = $_POST['id'];   
    $sql = $conn->query("DELETE FROM users WHERE id='$id'");

    if($sql){
        $result['message'] = "User is deleted successfully";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to delete user";
    }
}


$conn->close();
   echo json_encode($result);
   
?>
<?php 
$fname=$_GET['fname'];
$email=$_GET['email'];
$pass=$_GET['pass'];
$cpass=$_GET['cpass'];

$servername='localhost';
$username='root';
$password='';
$dbname='bookdb';

$conn= new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die( "connection failed");
}
else{
    $sql = "SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1";
    $result= $conn->query($sql);
    $row= $result->fetch_assoc();
    $nextUserId= $row? $row['user_id'] +1: 1;
    $hashPassword= password_hash($pass,PASSWORD_DEFAULT);
    $sql1="INSERT INTO users(user_id,user_name,password,email) VALUES($nextUserId,'$fname', '$hashPassword', '$email')";
    $result1= $conn-> query($sql1);
    if($result1==true){
        echo "Registered successfully";
    }
    else{
        echo "Not registered";
    }
}
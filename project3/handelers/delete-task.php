<?php 
// session_start();
require_once("../oop/Sessions.php");
if(isset($_GET['id'])){
    $conn = mysqli_connect("localhost","root","","todoapp");
    if(!$conn){
        $session = new Sessions;
        $session->setvel(
            'errors',"connect error " . mysqli_connect_error($conn)
        );

        // $_SESSION['errors']=  "connect error " . mysqli_connect_error($conn);
    }
    
    $id = $_GET['id'];

    $sql = "SELECT * FROM `tasks`  WHERE `id` = '$id' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_row($result);
  
    if(!$row){

        $session = new Sessions;
        $session->setvel(
            'errors',"data not exists"
        );

        // $_SESSION['errors'] = "data not exists";
    }else{
        $sql = "DELETE FROM `tasks`  WHERE `id` = '$id' ";
        $result = mysqli_query($conn,$sql);
        
        $session = new Sessions;
        $session->setvel('success',"data deleted succesfully");

        // $_SESSION['success'] = "data deleted succesfully";

    }




    // redirection 
    header("location:../index.php");
}
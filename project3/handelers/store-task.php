<?php 
session_start();
require_once("../oop/Sessions.php");
$errors = [];
$conn = mysqli_connect("localhost","root","","todoapp");
if(!$conn){
    echo "connect error " . mysqli_connect_error($conn);
}



if($_SERVER['REQUEST_METHOD']  == "POST" && isset($_POST['title'])){

    $title = trim(htmlspecialchars(htmlentities($_POST['title'])));

    // echo $title;

    if(strlen($title) < 3){
        $session = new Sessions;
        $session->setvel(
            'errors',"title of task must be greater than 3 chars"
        );
        // $_SESSION['errors'] = "title of task must be greater than 3 chars "; 
    }


    if(empty($_SESSION['errors'])){
        $sql = "INSERT INTO `tasks`(`title`) VALUES('$title')";
        $result = mysqli_query($conn,$sql);
        // echo mysqli_affected_rows($conn);
        if(mysqli_affected_rows($conn) == 1){

            $session = new Sessions;
            $session->setvel(
                'success',"data inserted succefully"
            );

            // $_SESSION['success'] = "data inserted succefully";
        }
    }
    


    // redirection 
    header("location:../index.php");

}
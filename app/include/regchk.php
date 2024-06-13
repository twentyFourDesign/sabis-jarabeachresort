<?php
if(isset($_SESSION['memname']) && !empty($_SESSION['memname'])) {
} else {
    if($_REQUEST['fname']!='') {
        $_SESSION['tabno']=$_REQUEST['tabno'];
        $_SESSION['noofg']=$_REQUEST['noofg'];
        $_SESSION['memname']=$_REQUEST['fname'];
        $_SESSION['lname']=$_REQUEST['lname'];
        $_SESSION['femail']=$_REQUEST['femail'];
        $_SESSION['fphon']=$_REQUEST['fphone'];
        $_SESSION['dobirth']=$_REQUEST['dob'];
    } else {
        header("Location: table_details.php");
    }
}
?>
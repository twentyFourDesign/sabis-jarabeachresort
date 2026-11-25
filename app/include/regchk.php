<?php
if(isset($_SESSION['memname']) && !empty($_SESSION['memname'])) {
} else {
    if($_REQUEST['fname']!='') {
        include_once __DIR__.'/rooms.php';
        $_SESSION['tabno']=jara_clean_selection($_REQUEST['tabno'], get_value('Con_TableNo','configure','Con_Id',1));
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
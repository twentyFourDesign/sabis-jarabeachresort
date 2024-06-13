<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, X-Auth-Token, Origin, Application");

require "admintool/system/config/configure.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<body>
    <div class="spalsh"></div>
<?php include "include/footer.php"; ?>
</body>
<?php if(isset($_SESSION['memname']) && !empty($_SESSION['memname'])) { ?>
<Script>
window.setTimeout(function() {
    window.location.href = 'table_details.php';
}, 3000);
</Script>
<?php } else { ?>
<Script>
window.setTimeout(function() {
    window.location.href = 'table_details.php';
}, 3000);
</Script>
<?php } ?>
</html>
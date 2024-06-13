<?php require "system/config/configure.php";
include "include/checklogin.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Dashboard
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/material-dashboard.css?v=2.0.0">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="">
<div class="wrapper">
    <?php include "include/left.php";?>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo">Welcome to Food Ordering System</a>
                </div>
                <?php include "include/top.php";?>

            </div>
        </nav>
        <!-- End Navbar -->
        <?php  
        $query2 = "select count(*) as tot from menu_category where MC_Status='Active'";
        $xyz2 = $dbobj->select($query2);
        $query3 = "select count(*) as tot from menu_item where MI_Status='Active'";
        $xyz3 = $dbobj->select($query3);
        $query4 = "select count(*) as tot from orders where Ord_Status='Active'";
        $xyz4 = $dbobj->select($query4);
		
        $query5 = "select count(*) as tot from user where Usr_Status='Active'";
        $xyz = $dbobj->select($query5);
        
    
        ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row pt-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-0 pr-0 pb-3">
                        <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="dashcard_outer">
                                <div class="mtic_outer"><i class="material-icons">settings</i></div>
                                <h4>Menu Category</h4>
                                <h3><?php echo $xyz2[0]["tot"]?></h3>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="dashcard_outer">
                                <div class="mtic_outer"><i class="material-icons">settings</i></div>
                                <h4>Menu Item</h4>
                                <h3><?php echo $xyz3[0]["tot"]?></h3>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="dashcard_outer">
                                <div class="mtic_outer"><i class="material-icons">group</i></div>
                                <h4>Order</h4>
                                <h3><?php echo $xyz4[0]["tot"]?></h3>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="dashcard_outer">
                                <div class="mtic_outer"><i class="material-icons">group</i></div>
                                <h4>User</h4>
                                <h3><?php echo $xyz[0]["tot"]?></h3>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 pb-5">
                        <div class="row">
                           <div class="col-sm-12 col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
								  <?php
									$amountstring2=""; 
								$monthstring2="";
									 $dt1=date('Y-m-d');
									 $dt2=date('Y-m-d', strtotime('-1 days'));
									$dt3=date('Y-m-d', strtotime('-2 days'));
									$dt4=date('Y-m-d', strtotime('-3 days'));
									$dt5=date('Y-m-d', strtotime('-4 days'));
									$dt6=date('Y-m-d', strtotime('-5 days'));
									$dt7=date('Y-m-d', strtotime('-6 days'));
									$dt8=date('Y-m-d', strtotime('-7 days'));
									$dt9=date('Y-m-d', strtotime('-8 days'));
									$dt10=date('Y-m-d', strtotime('-9 days'));
									$dtthis=array($dt1,$dt2,$dt3,$dt4,$dt5,$dt6,$dt7,$dt8,$dt9,$dt10);
									
								for($i=0;$i<count($dtthis);$i++){
							
								$q="select *  from orders where Ord_Date='".$dtthis[$i]."' "; 
									$result=$dbobj->select($q); 
									 if(count($result)==0) {$tot=0;}
									if($amountstring!='') {
                                    $amountstring.=",".count($result);
									 $monthstring.=",'".date("d-m-Y", strtotime($dtthis[$i]))."'";
									}
									else {
                                    $amountstring.=",".count($result);
                                  $monthstring.=",'".date("d-m-Y",strtotime($dtthis[$i]))."'";
                               }
                            }
									?>
									 <canvas id="myChart3" width="400" height="200"></canvas>
									 
								</div>
							</div>
						</div>
                        </div>
                    </div>
                 
                    
                    
                </div>



                <?php include "include/footer.php";?>
            </div>
        </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/bootstrap-material-design.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/js/plugins/chartist.min.js"></script>
<script src="assets/js/plugins/arrive.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/material-dashboard.js?v=2.0.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="assets/js/plugins/demo.js"></script>
<script>
    var ctx = document.getElementById('myChart3').getContext('2d');
    var array=['JAN','FEB'];
    var myChart = new Chart(ctx, {
		
        type: 'bar',
        data: {
            labels: [<?=trim($monthstring,',')?>],
			datasets: [{
                label: 'Orders of last 10 days',
                data: [<?=trim($amountstring,',');?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                    
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                    
                ],
                borderWidth: 1
            }]
        },
		
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
						
                    },
					
					scaleLabel:{
						display: true,
						labelString: 'No. Of Orders'
					}
                }],
			xAxes: [{
                    /*ticks: {
                        beginAtZero: true
						
                    }*/
					
					scaleLabel:{
						display: true,
						labelString: 'Date'
					}
                }]
            }
        }
		
    });
	
</script>
</html>
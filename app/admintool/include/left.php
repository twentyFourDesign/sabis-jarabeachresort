<?php $array=explode('?',$_SERVER['REQUEST_URI']); 
$file=basename($array[0]);?>
<style>
    .sidebar .nav p {font-size:16px;}
</style>
<div class="sidebar" data-color="purple" data-background-color="black">
    <div class="logo" style="text-align: left; background: #c8c8c8; border-bottom:3px solid #f7f7f7; -webkit-border-top-right-radius: 30px; -moz-border-radius-topright: 30px; border-top-right-radius: 30px;">
        <img src="assets/img/logoleft.png" style="width: 52%; padding: 3px 0;" />
    </div>
	<?php $filearray = explode(",",$_SESSION['sess_file']); ?>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <?php if('Biller'!=get_value('UT_Title','usertype','UT_Id', get_value('Usr_Type','user','Usr_Id',$_SESSION['adminuser']))) { ?>
            <li class="nav-item <?php if($file=='dashboard.php') {?>active<?php }?>">
                <a class="nav-link" href="dashboard.php">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <?php } ?>
            <?php if(in_array('configure_listing',$filearray) || in_array('user_listing',$filearray) || in_array('user_type_listing',$filearray)){ ?>
            <li class="nav-item <?php if($file=='configure_listing.php' || $file=='user_listing.php' || $file=='user_type_listing.php' || $file=='unit_listing.php' || $file=='plan_listing.php' || $file=='material_listing.php' || $file=='motor_listing.php' || $file=='cable_listing.php') {?>active<?php } ?>">
                <a class="nav-link" href="#homeSubmenu2" data-toggle="collapse" ><i class="material-icons">settings</i> <p>Configuration <b class="caret"></b></p></a>
                <ul class="collapse list-unstyled" id="homeSubmenu2">
					<?php if(in_array('configure_listing',$filearray)){ ?> <li class="<?php if($file=='configure_listing.php') {?>active<?php }?>"><a href="configure_listing.php" style="font-size: 15px">Configure</a></li><?php }?>
					<?php if(in_array('user_listing',$filearray)){ ?><li class="<?php if($file=='user_listing.php') {?>active<?php }?>"><a href="user_listing.php" style="font-size: 15px">User</a></li><?php }?>
					<?php if(in_array('user_type_listing',$filearray)){ ?><li class="<?php if($file=='user_type_listing.php') {?>active<?php }?>"><a href="user_type_listing.php" style="font-size: 15px">User Type</a></li><?php }?>
					<?php if(in_array('unit_listing',$filearray)){ ?><li class="<?php if($file=='unit_listing.php') {?>active<?php }?>"><a href="unit_listing.php" style="font-size: 15px">Unit</a></li><?php }?>
					<?php if(in_array('plan_listing',$filearray)){ ?><li class="<?php if($file=='plan_listing.php') {?>active<?php }?>"><a href="plan_listing.php" style="font-size: 15px">Subscription Plan</a></li><?php }?>
					<?php if(in_array('material_listing',$filearray)){ ?><li class="<?php if($file=='material_listing.php') {?>active<?php }?>"><a href="material_listing.php" style="font-size: 15px">Material</a></li><?php }?>
					<?php if(in_array('motor_listing',$filearray)){ ?><li class="<?php if($file=='motor_listing.php') {?>active<?php }?>"><a href="motor_listing.php" style="font-size: 15px">Motor</a></li><?php }?>
					<?php if(in_array('cable_listing',$filearray)){ ?><li class="<?php if($file=='cable_listing.php') {?>active<?php }?>"><a href="cable_listing.php" style="font-size: 15px">Cable</a></li><?php }?>
					<?php if(in_array('dg_listing',$filearray)){ ?><li class="<?php if($file=='dg_listing.php') {?>active<?php }?>"><a href="dg_listing.php" style="font-size: 15px">DG</a></li><?php }?>
					<?php if(in_array('switchgear_panel_listing',$filearray)){ ?><li class="<?php if($file=='switchgear_panel_listing.php') {?>active<?php }?>"><a href="switchgear_panel_listing.php" style="font-size: 15px">Switchgear Panel</a></li><?php }?>
					<?php if(in_array('automation_listing',$filearray)){ ?><li class="<?php if($file=='automation_listing.php') {?>active<?php }?>"><a href="automation_listing.php" style="font-size: 15px">SAS/Automation</a></li><?php }?>
					<?php if(in_array('lighting_boards_listing',$filearray)){ ?><li class="<?php if($file=='lighting_boards_listing.php') {?>active<?php }?>"><a href="lighting_boards_listing.php" style="font-size: 15px">Lighting Dist. Boards</a></li><?php }?>
					<?php if(in_array('power_distribution_boards_listing',$filearray)){ ?><li class="<?php if($file=='power_distribution_boards_listing.php') {?>active<?php }?>"><a href="power_distribution_boards_listing.php" style="font-size: 15px">Power Distribution Boards</a></li><?php }?>
					<?php if(in_array('lugs_listing',$filearray)){ ?><li class="<?php if($file=='lugs_listing.php') {?>active<?php }?>"><a href="lugs_listing.php" style="font-size: 15px">Lugs</a></li><?php }?>
					<?php if(in_array('cable_glands_listing',$filearray)){ ?><li class="<?php if($file=='cable_glands_listing.php') {?>active<?php }?>"><a href="cable_glands_listing.php" style="font-size: 15px">Cable Glands</a></li><?php }?>
					<?php if(in_array('lighting_fixture_listing',$filearray)){ ?><li class="<?php if($file=='lighting_fixture_listing.php') {?>active<?php }?>"><a href="lighting_fixture_listing.php" style="font-size: 15px">Lighting Fixture</a></li><?php }?>
					<?php if(in_array('cable_trays_listing',$filearray)){ ?><li class="<?php if($file=='cable_trays_listing.php') {?>active<?php }?>"><a href="cable_trays_listing.php" style="font-size: 15px">Cable Trays</a></li><?php }?>
					<?php if(in_array('lighting_poles_listing',$filearray)){ ?><li class="<?php if($file=='lighting_poles_listing.php') {?>active<?php }?>"><a href="lighting_poles_listing.php" style="font-size: 15px">Lighting Poles</a></li><?php }?>
					<?php if(in_array('junction_box_listing',$filearray)){ ?><li class="<?php if($file=='junction_box_listing.php') {?>active<?php }?>"><a href="junction_box_listing.php" style="font-size: 15px">Junction Box</a></li><?php }?>
					<?php if(in_array('local_control_station_listing',$filearray)){ ?><li class="<?php if($file=='local_control_station_listing.php') {?>active<?php }?>"><a href="local_control_station_listing.php" style="font-size: 15px">Local Control Station</a></li><?php }?>
					<?php if(in_array('safety_equipment_listing',$filearray)){ ?><li class="<?php if($file=='safety_equipment_listing.php') {?>active<?php }?>"><a href="safety_equipment_listing.php" style="font-size: 15px">Safety Equipment</a></li><?php }?>
					<?php if(in_array('tools_and_tackles_listing',$filearray)){ ?><li class="<?php if($file=='tools_and_tackles_listing.php') {?>active<?php }?>"><a href="tools_and_tackles_listing.php" style="font-size: 15px">Tools and Tackles</a></li><?php }?>
					<?php if(in_array('commissioning_spares_listing',$filearray)){ ?><li class="<?php if($file=='commissioning_spares_listing.php') {?>active<?php }?>"><a href="commissioning_spares_listing.php" style="font-size: 15px">Commissioning Spares</a></li><?php }?>
					<?php if(in_array('miscellaneous_items_listing',$filearray)){ ?><li class="<?php if($file=='miscellaneous_items_listing.php') {?>active<?php }?>"><a href="miscellaneous_items_listing.php" style="font-size: 15px">Miscellaneous Items</a></li><?php }?>
					<?php if(in_array('switch_socket_listing',$filearray)){ ?><li class="<?php if($file=='switch_socket_listing.php') {?>active<?php }?>"><a href="switch_socket_listing.php" style="font-size: 15px">Switch Socket</a></li><?php }?>
					<?php if(in_array('welding_socket_listing',$filearray)){ ?><li class="<?php if($file=='welding_socket_listing.php') {?>active<?php }?>"><a href="welding_socket_listing.php" style="font-size: 15px">Welding Socket</a></li><?php }?>
					<?php if(in_array('socket_listing',$filearray)){ ?><li class="<?php if($file=='socket_listing.php') {?>active<?php }?>"><a href="socket_listing.php" style="font-size: 15px">Socket</a></li><?php }?>
					<?php if(in_array('capacitor_sizing_listing',$filearray)){ ?><li class="<?php if($file=='capacitor_sizing_listing.php') {?>active<?php }?>"><a href="capacitor_sizing_listing.php" style="font-size: 15px">Capacitor Sizing</a></li><?php }?>
					<?php if(in_array('transformer_sizing_listing',$filearray)){ ?><li class="<?php if($file=='transformer_sizing_listing.php') {?>active<?php }?>"><a href="transformer_sizing_listing.php" style="font-size: 15px">Transformer Sizing</a></li><?php }?>
			<?php if(in_array('item_option_listing',$filearray)){ ?><li class="<?php if($file=='item_option_listing.php') {?>active<?php }?>"><a href="item_option_listing.php" style="font-size: 15px">Item Option</a></li><?php }?>

                    <?php if(in_array('allergens_listing',$filearray)){ ?><li class="<?php if($file=='allergens_listing.php') {?>active<?php }?>"><a href="allergens_listing.php" style="font-size: 15px">Allergens</a></li><?php }?>

                    <?php if(in_array('order_status_listing',$filearray)){ ?><li class="<?php if($file=='order_status_listing.php') {?>active<?php }?>"><a href="order_status_listing.php" style="font-size: 15px">Order Status</a></li><?php }?>
					<?php if(in_array('item_pin_listing',$filearray)){ ?><li class="<?php if($file=='item_pin_listing.php') {?>active<?php }?>"><a href="item_pin_listing.php" style="font-size: 15px">Item Pin</a></li><?php }?>
          
                </ul>
            </li>
            <?php }?>

			
			<?php if(in_array('voucher_listing',$filearray)){ ?>
			<li class="nav-item <?php if($file=='voucher_listing.php') {?>active<?php }?>">
                <a class="nav-link" href="voucher_listing.php">
                    <i class="material-icons">settings</i>
                    <p>Voucher</p>
                </a>
            </li>
			<?php } ?>
			
			<?php if(in_array('discount_code_listing',$filearray)){ ?>
			<li class="nav-item <?php if($file=='discount_code_listing.php') {?>active<?php }?>">
                <a class="nav-link" href="discount_code_listing.php">
                    <i class="material-icons">settings</i>
                    <p>Discount Code</p>
                </a>
            </li>
			<?php } ?>
			
			
			
			<?php if(in_array('menu_category_listing',$filearray)){ ?>
			<li class="nav-item <?php if($file=='menu_category_listing.php') {?>active<?php }?>">
                <a class="nav-link" href="menu_category_listing.php">
                    <i class="material-icons">settings</i>
                    <p>Menu Category</p>
                </a>
            </li>
			<?php } ?>
			
			<?php if(in_array('menu_item_listing',$filearray)){ ?>
			<li class="nav-item <?php if($file=='menu_item_listing.php') {?>active<?php }?>">
                <a class="nav-link" href="menu_item_listing.php">
                    <i class="material-icons">settings</i>
                    <p>Menu Item</p>
                </a>
            </li>
			<?php } ?>
			
			<?php if(in_array('order_listing',$filearray)){ ?>
			<li class="nav-item <?php if($file=='order_listing.php') {?>active<?php }?>">
                <a class="nav-link" href="order_listing.php">
                    <i class="material-icons">settings</i>
                    <p>Orders</p>
                </a>
            </li>
			<?php } ?>
			
			<?php if(in_array('report_listing',$filearray)){ ?>
			<li class="nav-item <?php if($file=='report_listing.php') {?>active<?php }?>">
                <a class="nav-link" href="report_listing.php">
                    <i class="material-icons">settings</i>
                    <p>Report</p>
                </a>
            </li>
			<?php } ?>
			
			<?php if(in_array('order_bar_listing',$filearray)){ ?>
			<li class="nav-item <?php if($file=='order_bar_listing.php') {?>active<?php }?>">
                <a class="nav-link" href="order_bar_listing.php">
                    <i class="material-icons">settings</i>
                    <p>Orders</p>
                </a>
            </li>
			<?php } ?>
        </ul>
    </div>
</div>
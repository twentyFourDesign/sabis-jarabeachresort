<?php require "../admintool/system/config/configure.php";
$rs_main = $dbobj -> select("SELECT Con_CurrencySym FROM configure where Con_Id=1");
$curr = $rs_main[0]['Con_CurrencySym'];
    $cat=$_REQUEST['cat'];
	$align = get_value('MC_Align','menu_category','MC_Id',$cat);

    $row = $dbobj -> select("SELECT * FROM menu_item where find_in_set('".$_REQUEST['cat']."',MI_CategoryId)!=0  and MI_Status='Active' order by MI_Sort ASC");
    if(count($row)>0){ 
    	for($t=0;$t<count($row);$t++) {
    	    if (is_array($_SESSION['cart'])) {
        	    $pkey = array_search($row[$t]['MI_Id'],array_column($_SESSION['cart'], 'product_id'),true);
        	    if($pkey !== false) {
        	        $miqty = $_SESSION['cart'][$pkey]['quantity'];
					$miopt = $_SESSION['cart'][$pkey]['option'];
        	    } else {
        	        $miqty = 0;
					$miopt =0;
        	    }
    	    } else {
    	        $miqty = 0;
    	    }
    	    $cmiqty='';
			if($align=='Yes'){
				for ($x1 = 0; $x1 <= (int)$_SESSION['noofg']; $x1++) {
    	            if($miqty==$x1) {
    	                $cmiqty .= '<option selected value="'.$x1.'">'.$x1.'</option>';   
    	            } else {
    	                $cmiqty .= '<option value="'.$x1.'">'.$x1.'</option>';
    	            }
    	        }
			} else if($row[$t]['MI_Qty']!='') {
                if($row[$t]['MI_Qty']>20) {
                    $rwqty=20;
                } else {
                    $rwqty=$row[$t]['MI_Qty'];
                }                
    	        for ($x1 = 0; $x1 <= $rwqty; $x1++) {
    	            if($miqty==$x1) {
    	                $cmiqty .= '<option selected value="'.$x1.'">'.$x1.'</option>';   
    	            } else {
    	                $cmiqty .= '<option value="'.$x1.'">'.$x1.'</option>';
    	            }
    	        }
    	    } else {
    	        for ($x = 0; $x <= 10; $x++) {
    	            if($miqty==$x) {
    	                $cmiqty .= '<option selected value="'.$x.'">'.$x.'</option>';
    	            } else {
    	                $cmiqty .= '<option value="'.$x.'">'.$x.'</option>';
    	            }
    	        }
    	    }
			
			$optionstr='';
			if(!empty($row[$t]['MI_Item_option'])){
				$optionstr.='<select style="width:50%;" name="mioption" id="mioption-'.$row[$t]['MI_Id'].'" class="miqty" data-option="'.$row[$t]['MI_Id'].'"><option value=" ">Select Option</option>';
				$iodata = $dbobj -> select("SELECT * FROM item_option where io_status='Active' and io_id IN (".$row[$t]['MI_Item_option'].") order by io_title ");
				for($i = 0;$i < count($iodata);$i++) {
					if($miopt==$iodata[$i]['io_id']) {
    	                $optionstr.= '<option selected value="'.$iodata[$i]['io_id'].'">'.$iodata[$i]['io_title'].' - '.$curr.number_format($iodata[$i]['io_price'],2).'</option>';
    	            } else {
    	                $optionstr.= '<option value="'.$iodata[$i]['io_id'].'">'.$iodata[$i]['io_title'].' - '.$curr.number_format($iodata[$i]['io_price'],2).'</option>';
    	            }
					
				}
				
				$optionstr.='</select>';	
			}
			
    	    if($row[$t]['MI_Qty']!='0') {
        	    if($row[$t]['MI_Img']!='') {
        	        $path='admintool/upload/mi/'.$row[$t]['MI_Id'].'_'.$row[$t]['MI_Img'];
        	        $html.='<div class="mi_inner"><div class="mi_left"><img src="'.$path.'" /></div><div class="mi_rgt"><h4 class="mititle">'.$row[$t]['MI_Title'].'</h4><p class="midesc">'.$row[$t]['MI_Desc'].'</p><p class="miprice">'.$curr.number_format($row[$t]['MI_Cost'],2).'</p><div class="qtybox"><select name="miqty" id="miqty-'.$row[$t]["MI_Id"].'" class="miqty" data-id="'.$row[$t]['MI_Id'].'">'.$cmiqty.'</select></div><div class="clear"></div><p style="margin-top: 5px;">'.$optionstr.'</p></div><div class="clear"></div></div>';
        	    } else {
        	        $html.='<div class="mi_inner"><div class="mi_full"><h4 class="mititle">'.$row[$t]['MI_Title'].'</h4><p class="midesc">'.$row[$t]['MI_Desc'].'</p><p class="miprice">'.$curr.number_format($row[$t]['MI_Cost'],2).'</p><div class="qtybox"><select name="miqty" id="miqty-'.$row[$t]['MI_Id'].'" class="miqty" data-id="'.$row[$t]['MI_Id'].'">'.$cmiqty.'</select></div><div class="clear"></div><p class="" style="margin-top: 5px;">'.$optionstr.'</p><div class="clear"></div></div></div>';
        	    }
    	    }
    	}
    	echo $html;
    } else {
        echo 'No items currently. Please check back soon.';
    }
?>
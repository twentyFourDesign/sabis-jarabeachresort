<?php
function getconfigure() {
	global $dbobj;
	$consql = array();
	$conquery = "SELECT * FROM configure where Con_Id=1";
	$consql = $dbobj->select($conquery); 
	define('CONF_ID', $consql[0]['Con_Id']);
	define('SITE_TITLE', $consql[0]['Con_Title']);
	define('CONF_NAME', $consql[0]['Con_from_Email_name']);
	define('CONF_EMAIL', $consql[0]['Con_from_Email']);
	define('CONF_MNO', $consql[0]['Con_Mobile']);
	define('CONF_ADRS', $consql[0]['Con_Address']);
	define('CONF_IMG', $consql[0]['Con_Image']);
	define('CONF_TAC', $consql[0]['Con_TAC']);
	define('CONF_METATITLE', $consql[0]['Con_StoreName']);
	define('CONF_METADESC', $consql[0]['Con_MetaDescription']);
	define('CONF_METAKEYWORD', $consql[0]['Con_MetaKeyword']); 
	define('CONF_CURRENCY', $consql[0]['Con_CurrencySym']);
    define('CONF_USE_SMTP', true);
    define('CONF_USE_SMTP_USERNAME', 'apikey');
    define('CONF_USE_SMTP_PASSWORD', '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');
    define('CONF_USE_SMTP_HOST', 'smtp.sendgrid.net');
}
function showprice($price){
	return CONF_CURRENCY.number_format($price,2);
}
function getName($n) { 
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	$randomString = ''; 
  
	for ($i = 0; $i < $n; $i++) { 
		$index = rand(0, strlen($characters) - 1); 
		$randomString .= $characters[$index]; 
	} 
  
	return $randomString; 
}

function MailConfig() {
    require_once __DIR__."/../../system/class/class.phpmailer.php";
    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = CONF_USE_SMTP_HOST;
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = CONF_USE_SMTP_USERNAME;
    $phpmailer->From = "bookings@jollofbyjara.com";
    $phpmailer->AddReplyTo("jollofbyjara2023@gmail.com");
    $phpmailer->FromName = "SABIS";
    $phpmailer->Password = CONF_USE_SMTP_PASSWORD;
    $phpmailer->Port = 587;
    $phpmailer->SMTPSecure = 'tls';
    return $phpmailer;
    
}

function SendMail($to, $from, $subject, $message, $headers, $Other  = [] ) {
    if (CONF_USE_SMTP) {
        try {
            $phpmailer = MailConfig();
//            $phpmailer->From = $from; // sendgrid only allow verified from mail
            $phpmailer->addAddress($to, "Jollof by Jara");
            $phpmailer->isHTML(true);
            $phpmailer->Subject = $subject;
            $phpmailer->Body = $message;
            return $phpmailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }

    }
    return mail($to, $subject, $message, $headers);
}

function getOTP() { 
	$characters = '0123456789'; 
	$randomString = ''; 
  
	for ($i = 0; $i < 6; $i++) { 
		$index = rand(0, strlen($characters) - 1); 
		$randomString .= $characters[$index]; 
	} 
  
	return $randomString; 
} 

function usertypecombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from usertype order by UT_Title";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selut\" id=\"selut\" class=form-control>";
	//$flatstr .= '<option value="">Select Flat No</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function membertypecombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from member where m_stat='Active' order by m_uname";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"memid\" id=\"memid\" class=form-control>";
	
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function memcombo($selectedut="") {
    global $dbobj;
    $utquery = "select * from member where m_stat='Active' order by m_fn ASC";
    $utsql = $dbobj->select($utquery);
    $utstr = "<select name=\"mem\" id=\"mem\" class=form-control>";
    $utstr .= '<option value="0">ALL</option>';
    for($c=0; $c<count($utsql); $c++) {
        if($utsql[$c][0]==$selectedut) {
            $utstr .= '<option value="'.$utsql[$c]['m_id'].'" selected>'.$utsql[$c]['m_fn']."  ".$utsql[$c]['m_ln'].'</option>';
        } else {
            $utstr .= '<option value="'.$utsql[$c]['m_id'].'">'.$utsql[$c]['m_fn']."  ".$utsql[$c]['m_ln'].'</option>';
        }
    }
    $utstr .= '</select>';
    return $utstr;
}

function prodtypecombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from menu_item where MI_Status='Active' order by MI_Title ASC";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"prodid\" id=\"prodid\" class=form-control>";
	 $utstr .= '<option value=" ">Select Item</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}
function productcombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from product where p_stat='Active' order by p_title";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selproduct\" id=\"selproduct\" class=form-control>";
	$utstr .= '<option value="" selected>Select Product</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function produviin($selectedut="",$iid="") {
	global $dbobj;
	$utquery = "select DISTINCT ip_pro, p_title from inquiry_product join product on inquiry_product.ip_pro=product.p_id where p_stat='Active' and ip_iid='".$iid."' order by p_title";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selproduct\" id=\"selproduct\" class=form-control>";
	$utstr .= '<option value="" selected>Select Product</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function produvcin($selectedut="",$iid="") {
	global $dbobj;
	$utquery = "select DISTINCT ip_pro, p_title from c_inquiry_product join product on c_inquiry_product.ip_pro=product.p_id where p_stat='Active' and ip_iid='".$iid."' order by p_title";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selproduct\" id=\"selproduct\" class=form-control>";
	$utstr .= '<option value="" selected>Select Product</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function inquirystatuscombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from inquiry_status where i_stat='Active' order by i_id ASC";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selinquiry\" id=\"selinquiry\" class=form-control>";
	//$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function inquirystagecombo($selectedut="") {
    global $dbobj;
	$utquery = "select * from inquiry_stage where i_stat='Active' order by i_title ASC";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selinquirystg\" id=\"selinquirystg\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function statecombon($selectedut="") {
	global $dbobj;
	$utquery = "select * from state where s_stat='Active' order by s_title ASC";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selstate\" id=\"selstate\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function countrycombon($selectedut="") {
	global $dbobj;
	$utquery = "select * from country where c_stat='Active' order by c_title ASC";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selcountry\" id=\"selcountry\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function inquirycombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from inquiry where i_stat='Active' and i_istatus!=2 order by i_title ASC";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selinquiry\" id=\"selinquiry\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].' '.$utsql[$c][2].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].' '.$utsql[$c][2].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function sales_personcombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from user where Usr_Status='Active' and Usr_Type='5' order by Usr_FirstName, Usr_LastName";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selsales\" id=\"selsales\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['Usr_Id'].'" selected>'.$utsql[$c]['Usr_FirstName'].' '.$utsql[$c]['Usr_LastName'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['Usr_Id'].'">'.$utsql[$c]['Usr_FirstName'].' '.$utsql[$c]['Usr_LastName'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function productpartcombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from part where part_stat='Active' order by part_title";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selpart\" id=\"selpart\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function partcategorycombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from category where cat_stat='Active' order by cat_title";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selcategory\" id=\"selcategory\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c][0].'" selected>'.$utsql[$c][1].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c][0].'">'.$utsql[$c][1].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function parentcategorycombo($selectedut="",$parent=0,$sub='') {
	global $dbobj;
	$utquery = "select * from category where cat_stat='Active' AND cat_par='".$parent."' order by cat_id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"par\" id=\"par\" class=form-control>";
    $utstr .= '<option value="0">Top</option>';

    for($c=0; $c<count($utsql); $c++){
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['cat_id'].'" selected>'.$sub.$utsql[$c]['cat_title'].'</option>';
            parentcategorycombo($selectedut="",$utsql[$c]['cat_id'],$sub=' > ');
		} else {
            $utstr .= '<option value="'.$utsql[$c]['cat_id'].'" >'.$sub.$utsql[$c]['cat_title'].'</option>';
            parentcategorycombo($selectedut="",$utsql[$c]['cat_id'],$sub=' > ');

		}

	}


	$utstr .= '</select>';

	return $utstr;

}

function prodschkcl($cid) { 
    global $dbobj;
    $utquery = "select SUM(ip_qty) from c_inquiry_product where ip_iid='".$cid."' AND ip_status='Active' order by ip_pro ASC";
    $utquery2 = "select count(*) from c_inspection where ins_iid='".$cid."'";
    $utsql=$dbobj->select($utquery);
    $utsql2=$dbobj->select($utquery2);
    if($utsql2[0][0]>=$utsql[0][0]) {
        return 'false';
    } else {
        return 'true';
    }
}

function prodschkinq($iid) { 
    global $dbobj;
    $utquery = "select SUM(ip_qty) from inquiry_product where ip_iid='".$iid."' AND ip_status='Active' order by ip_pro ASC";
    $utquery2 = "select count(*) from inspection where ins_iid='".$iid."'";
    $utsql=$dbobj->select($utquery);
    $utsql2=$dbobj->select($utquery2);
    if($utsql2[0][0]>=$utsql[0][0]) {
        return 'false';
    } else {
        return 'true';
    }
}

function prodschkclbreaker($cid) { 
    global $dbobj;
    $utquery = "select SUM(ip_qty) from c_inquiry_product where ip_iid='".$cid."' AND ip_status='Active' order by ip_pro ASC";
    $utquery2 = "select count(*) from bracker where b_client='".$cid."'";
    $utsql=$dbobj->select($utquery);
    $utsql2=$dbobj->select($utquery2);
    if($utsql2[0][0]>=$utsql[0][0]) {
        return 'false';
    } else {
        return 'true';
    }
}

function f1($select="",$parent=0,$sub=''){
    global $dbobj;
    $utquery = "select * from category where cat_par='".$parent."' AND cat_stat='Active' order by cat_title ASC";
    $utsql=$dbobj->select($utquery);
    for($c=0; $c<count($utsql); $c++){
        if ($utsql[$c][0]==$select) {
            echo '<option value="' . $utsql[$c]['cat_id'] . '" selected >' . $sub . $utsql[$c]['cat_title'] . '</option>';
            f1($select, $utsql[$c]['cat_id'], $sub . '--');
        }
        else{
            echo '<option value="' . $utsql[$c]['cat_id'] . '"  >' . $sub . $utsql[$c]['cat_title'] . '</option>';
            f1($select, $utsql[$c]['cat_id'], $sub . '--');
        }
    }
}

function prcombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from product where p_stat='Active' order by p_title ASC";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"pid\" id=\"pid\" class=form-control>";
    $utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
	    $pric=$utsql[$c]['p_sell_price'];
	    if($utsql[$c][0]==$selectedut) {
            $utstr .= '<option value="'.$utsql[$c]['p_id'].'" selected>'.$utsql[$c]['p_title']."  ". $utsql[$c]['p_size']." - ".$utsql[$c]['p_part_no'].'</option>';
        } else {
            $utstr .= '<option value="'.$utsql[$c]['p_id'].'" >'.$utsql[$c]['p_title']."  ". $utsql[$c]['p_size']." - ".$utsql[$c]['p_part_no'].'</option>';
        }
	}
	$utstr .= '</select>';
	return $utstr;
}
function prcomboserc($selectedut="",$disable="") {
    global $dbobj;
    $utquery = "select * from product where p_stat='Active'  order by p_title ASC";
    $utsql = $dbobj->select($utquery);
    if($disable=='true') {
        $utstr = "<select name=\"prd\" id=\"prd\" disabled class=form-control>";
    } else { 
        $utstr = "<select name=\"prd\" id=\"prd\" class=form-control>";
    }
    $utstr .= '<option value="0">Select</option>';
    for($c=0; $c<count($utsql); $c++) {
	   $pric=$utsql[$c]['p_sell_price'];
        if($utsql[$c][0]==$selectedut) {
            $utstr .= '<option value="'.$utsql[$c]['p_id'].'" selected>'.trim(preg_replace('/\s+/', '', $utsql[$c]['p_title']))."  ".trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_size']))." - ".trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_part_no'])).'</option>';
        } else {
            $utstr .= '<option value="'.$utsql[$c]['p_id'].'" >'.trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_title']))."  ".trim(preg_replace('/\s+/', ' ',$utsql[$c]['p_size']))." - ".trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_part_no'])).'</option>';
        }
    }
    $utstr .= '</select>';
    return $utstr;
}
function prcombo1($selectedut="",$disable="") {
    global $dbobj;
    $utquery = "select * from product where p_stat='Active' order by p_title ASC";
    $utsql = $dbobj->select($utquery);
    if($disable=='true') {
        $utstr = "<select name=\"prd[]\" id=\"prd\" disabled class=form-control>";
    } else { 
        $utstr = "<select name=\"prd[]\" id=\"prd\" onchange=\"productchange(this)\" class=form-control>";
    }
    $utstr .= '<option value="0">Select</option>';
    for($c=0; $c<count($utsql); $c++) {
	   $pric=$utsql[$c]['p_sell_price'];
       if($utsql[$c][0]==$selectedut) {
            $utstr .= '<option value="'.$utsql[$c]['p_id'].'" selected>'.trim(preg_replace('/\s+/', '', $utsql[$c]['p_title']))."  ".trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_size']))." - ".trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_part_no'])).'</option>';
        } else {
            $utstr .= '<option value="'.$utsql[$c]['p_id'].'" >'.trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_title']))."  ".trim(preg_replace('/\s+/', ' ',$utsql[$c]['p_size']))." - ".trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_part_no'])).'</option>';
        }
    }
    $utstr .= '</select>';
    return $utstr;
}
function prcombobill($selectedut="",$barcode="") {
    global $dbobj;
    $utquery = "select * from product where p_stat='Active' order by p_title ASC";
    $utsql = $dbobj->select($utquery);
    $utstr = "<select name=\"prd[]\" id=\"prd\" onchange=\"productchange(this)\" class=form-control>";
    $utstr .= '<option value="0">Select</option>';
    for($c=0; $c<count($utsql); $c++) {
        if($utsql[$c][0]==$selectedut) {
             $utstr .= '<option value="'.$utsql[$c]['p_id'].'" selected>'.trim(preg_replace('/\s+/', '', $utsql[$c]['p_title'])).'</option>';
        } else {
            $utstr .= '<option value="'.$utsql[$c]['p_id'].'" >'.trim(preg_replace('/\s+/', '', $utsql[$c]['p_title'])).'</option>';
        }
    }
    $utstr .= '</select>';
    return $utstr;
}
function agecombobill($selectedut="") {
    $utstr = "<select name=\"selage[]\" id=\"selage\" onchange=\"agechange(this)\" class=form-control>";
    $utstr .= '<option value="0">Select</option>';
    
    if('1to5'==$selectedut) {
         $utstr .= '<option value="1to5" selected>1 - 5</option>';
    } else {
        $utstr .= '<option value="1to5" >1 - 5</option>';
    }
    if('6to10'==$selectedut) {
         $utstr .= '<option value="6to10" selected>6 - 10</option>';
    } else {
        $utstr .= '<option value="6to10" >6 - 10</option>';
    }
    if('10+'==$selectedut) {
         $utstr .= '<option value="10+" selected>10+</option>';
    } else {
        $utstr .= '<option value="10+" >10+</option>';
    }
    
    $utstr .= '</select>';
    return $utstr;
}
function prcombo2($selectedut="") {
    global $dbobj;
    $utquery = "select * from product where p_stat='Active' order by p_title ASC";
    $utsql = $dbobj->select($utquery);

    $utstr = '<option value="0">Select</option>';
    for($c=0; $c<count($utsql); $c++) {
	   $pric=$utsql[$c]['p_sell_price'];
        if($utsql[$c][0]==$selectedut) {
             $utstr .= '<option value="'.$utsql[$c]['p_id'].'" selected>'.trim(preg_replace('/\s+/', '', $utsql[$c]['p_title']))."  ".trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_size']))." - ".trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_part_no'])).'</option>';
        } else {
            $utstr .= '<option value="'.$utsql[$c]['p_id'].'" >'.trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_title']))."  ".trim(preg_replace('/\s+/', ' ',$utsql[$c]['p_size']))." - ".trim(preg_replace('/\s+/', ' ', $utsql[$c]['p_part_no'])).'</option>';
        }
    }

    return $utstr;
}
function unitcombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from unit where u_stat='Active'  order by u_id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"unit\" id=\"unit\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['0'].'" selected>'.$utsql[$c]['1'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['0'].'">'.$utsql[$c]['1'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function cattypecombo($selectedut="") {
    global $dbobj;
    $utquery = "select * from category where cat_stat='Active'  order by cat_title";
    $utsql = $dbobj->select($utquery);
    $utstr = "<select name=\"catid\" id=\"catid\" class=form-control>";
    $utstr .= '<option value="0">Select</option>';
    for($c=0; $c<count($utsql); $c++) {
        if($utsql[$c][0]==$selectedut) {
            $utstr .= '<option value="'.$utsql[$c]['0'].'" selected>'.$utsql[$c]['1'].'</option>';
        } else {
            $utstr .= '<option value="'.$utsql[$c]['0'].'">'.$utsql[$c]['1'].'</option>';
        }
    }
    $utstr .= '</select>';
    return $utstr;
}

function brandcombo($selectedut="") {
    global $dbobj;
    $utquery = "select * from brand where b_stat='Active'  order by b_title";
    $utsql = $dbobj->select($utquery);
    $utstr = "<select name=\"brand\" id=\"brand\" class=form-control>";
   /* $utstr .= '<option value="0">Select</option>';*/
    for($c=0; $c<count($utsql); $c++) {
        if($utsql[$c][0]==$selectedut) {
            $utstr .= '<option value="'.$utsql[$c]['0'].'" selected>'.$utsql[$c]['1'].'</option>';
        } else {
            $utstr .= '<option value="'.$utsql[$c]['0'].'">'.$utsql[$c]['1'].'</option>';
        }
    }
    $utstr .= '</select>';
    return $utstr;
}

function productsubcategorycombo($top,$selectedut="") {
	global $dbobj;
	$utquery = "select PC_Id,PC_Title from product_category where PC_Status='Active' and PC_Parent=".$top." order by PC_Title";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selsubcategory\" id=\"selsubcategory\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['PC_Id'].'" selected>'.$utsql[$c]['PC_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['PC_Id'].'">'.$utsql[$c]['PC_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function productcombo_warehouse($selectedut="") {
	global $dbobj;
	$utquery = "select * from product where Pro_Status='Active' order by Pro_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selproduct\" id=\"selproduct\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['Pro_Id'].'" selected>'.$utsql[$c]['Pro_SKU'].' - '.$utsql[$c]['Pro_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['Pro_Id'].'">'.$utsql[$c]['Pro_SKU'].' - '.$utsql[$c]['Pro_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function productcombo2($selectedut="") {
	global $dbobj;
	$utquery = "select * from product where Pro_Status='Active' order by Pro_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selproduct[]\" id=\"selproduct\" onchange=\"productchange(this)\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['Pro_Id'].'" selected>'.$utsql[$c]['Pro_SKU'].' - '.$utsql[$c]['Pro_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['Pro_Id'].'">'.$utsql[$c]['Pro_SKU'].' - '.$utsql[$c]['Pro_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function productattriburecombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from product_attribute where PA_Status='Active' order by PA_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selattribute\" id=\"selattribute\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['PA_Id'].'" selected>'.$utsql[$c]['PA_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['PA_Id'].'">'.$utsql[$c]['PA_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function storagekindcombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from storage_kind where S_Status='Active' order by S_Title";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selstoragekind\" id=\"selstoragekind\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['S_Id'].'" selected>'.$utsql[$c]['S_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['S_Id'].'">'.$utsql[$c]['S_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function marketplacecombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from market_place where M_Status='Active' order by M_Title";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selmarketplace\" id=\"selmarketplace\" class=form-control>";
	$utstr .= '<option value="">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['M_Id'].'" selected>'.$utsql[$c]['M_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['M_Id'].'">'.$utsql[$c]['M_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function colorcombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from product_color where PC_Status='Active' order by PC_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selcolor\" id=\"selcolor\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['PC_Id'].'" selected>'.$utsql[$c]['PC_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['PC_Id'].'">'.$utsql[$c]['PC_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function suppliercombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from supplier where S_Status='Active' order by S_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selsupplier\" id=\"selsupplier\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['S_Id'].'" selected>'.$utsql[$c]['S_Name'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['S_Id'].'">'.$utsql[$c]['S_Name'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function agentcombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from agent where A_Status='Active' order by A_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selagent\" id=\"selagent\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['A_Id'].'" selected>'.$utsql[$c]['A_Name'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['A_Id'].'">'.$utsql[$c]['A_Name'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function agentcombo2($selectedut="") {
	global $dbobj;
	$utquery = "select * from agent where A_Status='Active' order by A_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selagent\" id=\"selagent\" class=form-control>";
	$utstr .= '<option value="0">Select Agent</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['A_Id'].'" selected>'.$utsql[$c]['A_Name'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['A_Id'].'">'.$utsql[$c]['A_Name'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function currencycombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from currency where C_Status='Active' order by C_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selcurrency\" id=\"selcurrency\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['C_Id'].'" selected>'.$utsql[$c]['C_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['C_Id'].'">'.$utsql[$c]['C_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function currencycombo2($selectedut="") {
	global $dbobj;
	$utquery = "select * from currency where C_Status='Active' order by C_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selcurrency\" id=\"selcurrency\" class=form-control>";
	$utstr .= '<option value="0">Select Currency</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['C_Id'].'" selected>'.$utsql[$c]['C_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['C_Id'].'">'.$utsql[$c]['C_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function forwardercombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from forwarder where F_Status='Active' order by F_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selforwarder\" id=\"selforwarder\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['F_Id'].'" selected>'.$utsql[$c]['F_Name'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['F_Id'].'">'.$utsql[$c]['F_Name'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function forwardercombo2($selectedut="") {
	global $dbobj;
	$utquery = "select * from forwarder where F_Status='Active' order by F_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selforwarder\" id=\"selforwarder\" class=form-control>";
	$utstr .= '<option value="0">Forwarder</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['F_Id'].'" selected>'.$utsql[$c]['F_Name'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['F_Id'].'">'.$utsql[$c]['F_Name'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function countrycombo($selectedut="") {
	global $dbobj;
	$utquery = "select * from country where C_Status='Active' order by C_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selcountry\" id=\"selcountry\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['C_Id'].'" selected>'.$utsql[$c]['C_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['C_Id'].'">'.$utsql[$c]['C_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function countrycombo2($selectedut="") {
	global $dbobj;
	$utquery = "select * from country where C_Status='Active' order by C_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selcountry\" id=\"selcountry\" class=form-control>";
	$utstr .= '<option value="0">Select Country</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['C_Id'].'" selected>'.$utsql[$c]['C_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['C_Id'].'">'.$utsql[$c]['C_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function ordercombo($selectedut="") {
	global $dbobj;
        $orderarray=array();
        $sql="SELECT * FROM `po_product`";
        $utsql = $dbobj->select($sql);
        for($c=0; $c<count($utsql); $c++) {
            $sql2="SELECT sum(PP_Received) as PP_Received FROM `shipment_product` where PP_Product=".$utsql[$c]['PP_Product']." and PP_PO='".$utsql[$c]['PP_PO']."'";
            $utsql2 = $dbobj->select($sql2);
            if($utsql2[0]['PP_Received']<$utsql[0]['PP_Qty']) {
                if(!in_array($utsql[$c]['PP_PO'],$orderarray)) { $orderarray[]=$utsql[$c]['PP_PO'];}
            }
        }
	$utquery = "select * from purchase_order where (PO_Status='Open' || PO_Id=".$selectedut.") order by PO_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selpurchaseorder[]\" id=\"selpurchaseorder\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['PO_Id'].'" selected>'.$utsql[$c]['PO_Number'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['PO_Id'].'">'.$utsql[$c]['PO_Number'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function ordercombo2($selectedut="") {
	global $dbobj;
        $orderarray=array();
        $sql="SELECT * FROM `po_product`";
        $utsql = $dbobj->select($sql);
        for($c=0; $c<count($utsql); $c++) {
            $sql2="SELECT sum(PP_Received) as PP_Received FROM `shipment_product` where PP_Product=".$utsql[$c]['PP_Product']." and PP_PO='".$utsql[$c]['PP_PO']."'";
            $utsql2 = $dbobj->select($sql2);
            if($utsql2[0]['PP_Received']<$utsql[0]['PP_Qty']) {
                if(!in_array($utsql[$c]['PP_PO'],$orderarray)) { $orderarray[]=$utsql[$c]['PP_PO'];}
            }
        }
	$utquery = "select * from purchase_order where (PO_Status='Open' || PO_Id=".$selectedut.") order by PO_Id";
	$utsql = $dbobj->select($utquery);
	$utstr = "<select name=\"selpurchaseorder[]\" id=\"selpurchaseorder\" onchange=\"pochange(this)\" class=form-control>";
	$utstr .= '<option value="0">Select</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['PO_Id'].'" selected>'.$utsql[$c]['PO_Number'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['PO_Id'].'">'.$utsql[$c]['PO_Number'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function categorycombo($current,$selectedut="") {
	global $dbobj;
        if($current!='') {
            $utquery = "select * from product_category where PC_Status='Active' and PC_Id!=".$current." order by PC_Id";
        } else {
            $utquery = "select * from product_category where PC_Status='Active' order by PC_Id";
        }
	$utsql = $dbobj->select($utquery); //print_r($utsql);
	$utstr = "<select name=\"selcategory\" id=\"selcategory\" class=form-control>";
	$utstr .= '<option value="0">Top</option>';
	for($c=0; $c<count($utsql); $c++) {
		if($utsql[$c][0]==$selectedut) {
			$utstr .= '<option value="'.$utsql[$c]['PC_Id'].'" selected>'.$utsql[$c]['PC_Title'].'</option>';
		} else {
			$utstr .= '<option value="'.$utsql[$c]['PC_Id'].'">'.$utsql[$c]['PC_Title'].'</option>';
		}
	}
	$utstr .= '</select>';
	return $utstr;
}

function amt_format($num) {
	$explrestunits = "" ;
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return '<i class="fa fa-rupee"></i> '.$thecash.''; // writes the final format where $currency is the currency symbol.
}

function amt_format2($num) {
	$explrestunits = "" ;
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return 'Rs. '.$thecash.''; // writes the final format where $currency is the currency symbol.
}

function get_value($field_selected,$table_name,$field_name,$field_val) {
	global $dbobj;
		$query = "SELECT $field_selected FROM $table_name where $field_name='".$field_val."'";
		$sql = $dbobj->select($query);
		if(empty($sql)) {
			return '';
		} else {
			return $sql[0][$field_selected];
		}
}

function set_value($field_selected,$field_selected_val,$table_name,$field_name,$field_val) {
	global $dbobj;
		$query = "update $table_name set $field_selected='$field_selected_val' where $field_name='".$field_val."'";
		$dbobj->update($query);
}

function createYears($start_year, $end_year, $id='year_select', $selected=null, $para='') {

        /*** the current year ***/
        $selected = is_null($selected) ? date('Y') : $selected;

        /*** range of years ***/
        $r = range($start_year, $end_year);

        /*** create the select ***/
        $select = '<select name="'.$id.'" id="'.$id.'" class="textfield" "'.$para.'">';
        foreach( $r as $year )
        {
            $select .= "<option value=\"$year\"";
            $select .= ($year==$selected) ? ' selected="selected"' : '';
            $select .= ">$year</option>\n";
        }
        $select .= '</select>';
        return $select;
}

function getMonthname($id)  {
        /*** array of months ***/
        $months = array(
                1=>'January',
                2=>'February',
                3=>'March',
                4=>'April',
                5=>'May',
                6=>'June',
                7=>'July',
                8=>'August',
                9=>'September',
                10=>'October',
                11=>'November',
                12=>'December');
        
        return $months[$id];
}

function createMonths($id='month_select', $selected=null, $para='')  {
        /*** array of months ***/
        $months = array(
                1=>'January',
                2=>'February',
                3=>'March',
                4=>'April',
                5=>'May',
                6=>'June',
                7=>'July',
                8=>'August',
                9=>'September',
                10=>'October',
                11=>'November',
                12=>'December');

        /*** current month ***/
        $selected = is_null($selected) ? date('m') : $selected;

        $select = '<select name="'.$id.'" id="'.$id.'" class="form-control" "'.$para.'">'."\n";
        foreach($months as $key=>$mon)
        {
            $key_fin=(strlen($key)==1) ? '0'.$key : $key;
			$select .= "<option value=\"$key_fin\"";
            $select .= ($key==$selected) ? ' selected="selected"' : '';
            $select .= ">$mon</option>\n";
        }
        $select .= '</select>';
        return $select;
}

function createMonths_int($id='month_int_select', $selected=null)  {
        /*** array of months ***/
        $months = array(
                1=>'January',
                2=>'February',
                3=>'March',
                4=>'April',
                5=>'May',
                6=>'June',
                7=>'July',
                8=>'August',
                9=>'September',
                10=>'October',
                11=>'November',
                12=>'December');

        /*** current month ***/
        $selected = is_null($selected) ? date('m') : $selected;

        $select = '<select name="'.$id.'" id="'.$id.'" class="form-control">'."\n";
        foreach($months as $key=>$mon)
        {
            $key_fin=(strlen($key)==1) ? '0'.$key : $key;
			$select .= "<option value=\"$key_fin\"";
            $select .= ($key==$selected) ? ' selected="selected"' : '';
            $select .= ">$key</option>\n";
        }
        $select .= '</select>';
        return $select;
}

function getMonths_int($id='month_int_select')  {
        /*** array of months ***/
        $months = array(
                1=>'Jan',
                2=>'Feb',
                3=>'Mar',
                4=>'Apr',
                5=>'May',
                6=>'Jun',
                7=>'Jul',
                8=>'Aug',
                9=>'Sep',
                10=>'Oct',
                11=>'Nov',
                12=>'Dec');
        return $months[$id];
}
	
function createDays($id='day_select', $selected=null)
{
        /*** range of days ***/
        $r = range(1, 31);

        /*** current day ***/
        $selected = is_null($selected) ? date('d') : $selected;

        $select = "<select name=\"$id\" id=\"$id\">\n";
        foreach ($r as $day)
        {
            $day_fin=(strlen($day)==1) ? '0'.$day : $day;
			$select .= "<option value=\"$day_fin\"";
            $select .= ($day==$selected) ? ' selected="selected"' : '';
            $select .= ">$day</option>\n";
        }
        $select .= '</select>';
        return $select;
}	

function date_format_display($val) {
	if(!empty($val)) {
	$final=explode("-",$val);
	$final_display=$final[2]."-".$final[1]."-".$final[0];
	return $final_display;
	}
}

function date_format_db($val_db) {
	if(!empty($val_db)) {
	$final_bd=explode("-",$val_db);
	$final_display_db=$final_bd[2]."-".$final_bd[1]."-".$final_bd[0];
	return $final_display_db;
	}
}

function check_image_extension($image){
        $images_extentions = array("jpg","JPG","jpeg","JPEG","png","PNG");
        $image_parts = explode(".",$image);
        $image_end_part = end($image_parts);
        if(in_array($image_end_part,$images_extentions ) == true){
            return time() . "." . $image_end_part;
        }else{
            return false;
        }
}

function image_resize1($filename,$path,$width,$height) { 
	getimagesize($filename);
	list($width_orig, $height_orig) = getimagesize($filename);
	$ratio_orig = $width_orig/$height_orig;
	if ($width/$height > $ratio_orig) {
	   $width = $height*$ratio_orig;
	} else {
	   $height = $width/$ratio_orig;
	}

	$length=strlen($filename);
	$name=substr($filename,$length-3,$length);
	$name2=substr($filename,$length-4,$length);
	$image_p = imagecreatetruecolor($width, $height);

	if($name=='jpg' || $name=='JPG' || $name2=='jpeg' || $name2=='JPEG') {
		ini_set("memory_limit","48M");
		$image = imagecreatefromjpeg($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		imagejpeg($image_p, $path);
	} else {
		ini_set("memory_limit","48M");
		$image = imagecreatefromgif($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		imagegif($image_p, $path);
	}
}

function send_sms($mobile_no,$message)
{
	global $prefix;
	$mobileNumber = $mobile_no;
    $input_data = '<parent>
                        <child>
                            <user>MY1STUBE</user>
                            <key>600bfbb94cXX</key>
                            <mobile>'.$mobileNumber.'</mobile>
                            <message>'.$message.'</message>
                            <accusage>1</accusage>
                             <senderid>MYTUBE</senderid>
                        </child>
                    </parent>';
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://mobicomm.dove-sms.com/submitsms.jsp",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $input_data,
          CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/xml"
          ),
        ));

        $output = curl_exec($curl);
        curl_close($curl);

    return $output;
}

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
?>

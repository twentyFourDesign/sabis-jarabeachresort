function custuom_paging(vfilename){
	b=document.getElementById('n').value;
	a="index.php?file="+vfilename+"&n="+b;
	document.location.href=a;
}

function setchecked(elemName,status){
	elem = document.getElementsByName(elemName);
	for(i=0;i<elem.length;i++){
		elem[i].checked=status;
	}
}

function setaction(elename, actionval, actionmsg, formname) {
	vchkcnt=0;
	elem = document.getElementsByName(elename);
	for(i=0;i<elem.length;i++){
		if(elem[i].checked) vchkcnt++;	
	}
	if(vchkcnt==0) {
            jQuery.notify({
                icon: "notifications",
                message: "Please select record"

            }, {
                type: 'info',
                timer: 3000,
                placement: {
                    from: 'top',
                    align: 'center'
                }
            });
	} else {
                Confirm('', actionmsg, 'Ok', 'Cancel', actionval, formname,'');
		//document.getElementById('action').value=actionval;
		//document.getElementById(formname).submit();
	}
}

function setcopy(elename,actionmsg) {
	vchkcnt=0;
	elem = document.getElementsByName(elename);
	for(i=0;i<elem.length;i++){
		if(elem[i].checked) {
			vchkcnt++;
			vval = elem[i].value;
		}
	}
	if(vchkcnt==0) {
		alert('Please select record!!!');
	} else if(vchkcnt>1) {
		alert('Please select single record!!!');
	} else {
		alert(actionmsg);
		document.location.href="index.php?file=flat_detail&act=copy&txtflatid="+vval;
	}
}

function funcancel(filename) {
        Confirm('', 'Are you sure, you want to cancel?', 'Ok', 'Cancel', '', '',filename+".php");
	/*ans=confirm('Are you sure, you want to cancel?');
	if(ans) {
		document.location.href=""+filename+".php";
	} */
}

function funcancel2(filename) {
        Confirm('', 'Are you sure, you want to cancel?', 'Ok', 'Cancel', '', '',filename);
	/*ans=confirm('Are you sure, you want to cancel?');
	if(ans) {
		document.location.href=""+filename+".php";
	} */
}

function funcancel_front(filename) {
	ans=confirm('Are you sure, you want to cancel?');
	if(ans) {
		document.location.href=filename;
	} 
}

function LTrim(strText)
{
	while (strText.substring(0,1) == ' ')
			strText = strText.substring(1, strText.length);
	return strText;
} 

function RTrim(strText)
{
	while (strText.substring(strText.length-1,strText.length) == ' ')
			strText = strText.substring(0, strText.length-1);
	return strText;
}

function Trim(strText)
{
	return RTrim(LTrim(strText));
}

function validateBlank(formName,fieldName,msg){
	var	doc = "document."
	var input = eval("document."+formName+"."+fieldName+".value");
	var lenth = input.length ;
	var ctr=0 ;
	if(input==""){		
		alert(msg);
		eval(doc+formName+"."+fieldName+".focus()")
		return false;		
	}
	return true
}

function chkForm (frm) 
{
	for (var i=1; i<chkForm.arguments.length; i++)
	{
		fld=chkForm.arguments[i];
		i++;
		type=chkForm.arguments[i];
		i++;
 		txt=chkForm.arguments[i];
		switch (type) 
		{
			case 'validateblank' : 
			{	       
				if(Trim(document.forms[frm].elements[fld].value) == "")
				{ 
                                        jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					document.forms[frm].elements[fld].focus();
					return false;
				}
			 }
		     break;
			 case 'validatenonezero' : 
			{	       
				if(Trim(document.forms[frm].elements[fld].value) == "0")
				{ 
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					document.forms[frm].elements[fld].focus();
					return false;
				}
			 }
		     break;
			 case 'validateSelectmblank' :
			 {
				imselflg=false;
			 	for(imsel=0;imsel<document.forms[frm].elements[fld].length;imsel++)
				{
					if(document.forms[frm].elements[fld].options[imsel].selected && document.forms[frm].elements[fld].options[imsel].value!="")
					{
						imselflg=true;
						break; 
					}
				}
				if(imselflg==false)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					return false;
				}
			 }
			 break;
			 case 'validateCheckboxblank' :
			 {
			 	imselflg=false;
				elem = document.getElementsByName(fld);
				for(imsel=0;imsel<elem.length;imsel++)
				{
					if(elem[imsel].checked)
					{
						imselflg=true;
						break;
					}
				}
				if(!imselflg)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					return false;
				}
			 }
			 break;
			 case 'validateRadioblank' : 
			 {
				var a=1;
				for (j=0; j<document.forms[frm].elements[fld].length; j++) 
				{
						
					if (document.forms[frm].elements[fld][j].checked) 
						a=0;
				}
				if(a==1)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					return false;
				}	  
			}
			break;
			case 'validateemail' : 
	 		{
				var emailstring = document.forms[frm].elements[fld].value;
				var ampIndex = emailstring.indexOf("@");
				var afterAmp = emailstring.substring((ampIndex + 1), emailstring.length);
				var dotIndex = afterAmp.indexOf(".");
				dotIndex = dotIndex + ampIndex + 1;
				afterAmp = emailstring.substring((ampIndex + 1), dotIndex);
				var afterDot = emailstring.substring((dotIndex + 1), emailstring.length);
				var beforeAmp = emailstring.substring(0,(ampIndex));
				var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/ 
				if ((emailstring.indexOf("@") != "-1") && (emailstring.length > 5) && (afterAmp.length > 0) && (beforeAmp.length > 1) && (afterDot.length > 1) && (email_regex.test(emailstring)) ) {				  
				} else {
					if (txt != '')
					{
						jQuery.notify({
                                                    icon: "notifications",
                                                    message: txt

                                                }, {
                                                    type: 'info',
                                                    timer: 3000,
                                                    placement: {
                                                        from: 'top',
                                                        align: 'center'
                                                    }
                                                });
					}
					else
					{
                                            jQuery.notify({
                                                icon: "notifications",
                                                message: "Please check your email address!"

                                            }, {
                                                type: 'info',
                                                timer: 3000,
                                                placement: {
                                                    from: 'top',
                                                    align: 'center'
                                                }
                                            });
					}
					document.forms[frm].elements[fld].focus();
					return false;
			  }
		 }
		 break;
     	 case 'validateinteger' :
		 {
			if(!validateNumber(document.forms[frm].elements[fld].value))
			{
				jQuery.notify({
                                    icon: "notifications",
                                    message: txt

                                }, {
                                    type: 'info',
                                    timer: 3000,
                                    placement: {
                                        from: 'top',
                                        align: 'center'
                                    }
                                });
				document.forms[frm].elements[fld].focus();
				return false;
			}
			if(parseInt(document.forms[frm].elements[fld].value)<=0)
			{
				jQuery.notify({
                                    icon: "notifications",
                                    message: txt

                                }, {
                                    type: 'info',
                                    timer: 3000,
                                    placement: {
                                        from: 'top',
                                        align: 'center'
                                    }
                                });
				document.forms[frm].elements[fld].focus();
				return false;
			}
	 	}
	 	break;
     	case 'validatenumber':
	 	{
			if(document.forms[frm].elements[fld].disabled)
				continue;
			chk1="!@#$%^*()-+=|\~`{}[]: <>?/,abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			chk3="0123456789";
			for(k=0;k!=document.forms[frm].elements[fld].value.length;k++)
			{
				ch1= document.forms[frm].elements[fld].value.charAt(k);
				ch2= document.forms[frm].elements[fld].value.charAt(0);
				rtn1=chk1.indexOf(ch1);
				rtn3=chk3.indexOf(ch2);
				if(rtn3 < 0)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					document.forms[frm].elements[fld].focus();
					return false;
					break;
			 	}
				else if(rtn1!=-1)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					document.forms[frm].elements[fld].focus();
					return false;
					break;	
				}
			}
 	  	}
	 	break;
	 	case 'validateFloatNumber' :
	 	{
			if (document.forms[frm].elements[fld].value.length<1)
			{
				return true;
			}
			chk1="1234567890.";
			for(j=0;j!=document.forms[frm].elements[fld].value.length;j++)
			{
				ch1=document.forms[frm].elements[fld].value.charAt(j);
				rtn1=chk1.indexOf(ch1);
				if(rtn1==-1)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					document.forms[frm].elements[fld].focus();
					return false;
					break;
				}
			}
	 	}
	 	break;
	 	case 'validatealpha' :
	 	{
			chk1 = "#$%^*-+=|\~`{};<>?\'\"\\ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890:,./()[]@_";
	 		chk3="abcdefghijklmnopqrstuvwxyz";
			for(j=0;j!=document.forms[frm].elements[fld].value.length;j++)
			{
				ch1= document.forms[frm].elements[fld].value.charAt(j);
				ch2= document.forms[frm].elements[fld].value.charAt(0);
				rtn1=chk1.indexOf(ch1);
				rtn3=chk3.indexOf(ch2);
				if(rtn3 < 0)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					document.forms[frm].elements[fld].focus();
					return false;
					break;
				}
				else if(rtn1!=-1)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					document.forms[frm].elements[fld].focus();
					return false;
					break;	
				}			
			}
 		} 
		break;
		case 'validatealphanumeric' :
		{
			chk1 = "#$%^*-+=|\~`{};<>?\'\"\\ABCDEFGHIJKLMNOPQRSTUVWXYZ0:,./()[]@_";
			chk3="abcdefghijklmnopqrstuvwxyz123456789";
			for(j=0;j!=document.forms[frm].elements[fld].value.length;j++)
			{
				ch1= document.forms[frm].elements[fld].value.charAt(j);
				ch2= document.forms[frm].elements[fld].value.charAt(0);
				rtn1=chk1.indexOf(ch1);
				rtn3=chk3.indexOf(ch2);
				if(rtn3 < 0)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					document.forms[frm].elements[fld].focus();
					return false;
					break;
				}
				else if(rtn1!=-1)
				{
					jQuery.notify({
                                            icon: "notifications",
                                            message: txt

                                        }, {
                                            type: 'info',
                                            timer: 3000,
                                            placement: {
                                                from: 'top',
                                                align: 'center'
                                            }
                                        });
					document.forms[frm].elements[fld].focus();
					return false;
					break;	
				}			
			}
 		} 
		break;
		case 'validatepassword' :
		{ 
			if(document.forms[frm].elements[fld].value.length>0)
			{
				chk1 = " -+=|~{};<>?:,./()[]^\`\'\"\\";
				chk3="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890#$%*@";

				for(j=0;j!=document.forms[frm].elements[fld].value.length;j++)
				{
					ch1= document.forms[frm].elements[fld].value.charAt(j);
					ch2= document.forms[frm].elements[fld].value.charAt(0);
					rtn1=chk1.indexOf(ch1);
					rtn3=chk3.indexOf(ch2);
					if(rtn3 < 0)
					{
						jQuery.notify({
                                                    icon: "notifications",
                                                    message: txt

                                                }, {
                                                    type: 'info',
                                                    timer: 3000,
                                                    placement: {
                                                        from: 'top',
                                                        align: 'center'
                                                    }
                                                });
						document.forms[frm].elements[fld].focus();			
						return false;
						break;
					}
					else if(rtn1!=-1)
					{			
						jQuery.notify({
                                                    icon: "notifications",
                                                    message: txt

                                                }, {
                                                    type: 'info',
                                                    timer: 3000,
                                                    placement: {
                                                        from: 'top',
                                                        align: 'center'
                                                    }
                                                });
						document.forms[frm].elements[fld].focus();
						return false;
						break;	
					}
			  	}
		 	}
		 	else
		 	{
				jQuery.notify({
                                    icon: "notifications",
                                    message: txt

                                }, {
                                    type: 'info',
                                    timer: 3000,
                                    placement: {
                                        from: 'top',
                                        align: 'center'
                                    }
                                });
				document.forms[frm].elements[fld].focus();
				return false;
				break;
			}
		}
		break;
	}
}
return true;
}

function redirectsub()
{
	if(!chkForm("frmemail", "email", "validateblank", "Please enter your email address", "email", "validateemail", "Please enter a VALID email address"))
	{
	}
	else
	{
		var str="subscribe-to-newsletter.php?email="+document.forms['frmemail'].elements['email'].value;
		window.location=str;
	}
}

function randomString1() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 6;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	document.getElementById('randomfield1').innerHTML=randomstring;
	document.getElementById('code1').value = randomstring;
	
}

function frmsub(text){
	if(!chkForm("frmsubnews", "txtfname", "validateblank", "Please Enter First Name", "txtlname", "validateblank", "Please Enter Last Name", "txtemail", "validateblank", "Please Enter Email Address", "txtemail", "validateemail", "Please enter a VALID email address", "code", "validateblank", "Please Enter Code")) {
	} else {
		if(document.getElementById('code').value!=document.getElementById('code1').value){
			alert("Please enter a VALID code")
			document.getElementById('code').focus();
		} else {
			document.getElementById('action').value=text;
			document.frmsubnews.submit();
		}
	}
}

function Confirm(title, msg, $true, $false, actionvalue, formname, filename) {
    var $content =  "<div class='dialog-ovelay'>" +
                    "<div class='dialog'><header>" +
                     " <h3> " + title + " </h3> " +
                     "<i class='fa fa-close'></i>" +
                 "</header>" +
                 "<div class='dialog-msg'>" +
                     " <p> " + msg + " </p> " +
                 "</div>" +
                 "<footer>" +
                     "<div class='controls'>" +
                         " <button class='button button-danger doAction'>" + $true + "</button> " +
                         " <button class='button button-default cancelAction'>" + $false + "</button> " +
                     "</div>" +
                 "</footer>" +
              "</div>" +
            "</div>";
    $('body').prepend($content);
    $('.doAction').click(function () {
        if(filename!='') { //alert(filename);
            document.location.href=""+filename+"";
        } else {
            document.getElementById('action').value=actionvalue;
            document.getElementById(formname).submit();
        }
        $(this).parents('.dialog-ovelay').fadeOut(500, function () {
            $(this).remove();
        });
    });
    $('.cancelAction, .fa-close').click(function () {
      $(this).parents('.dialog-ovelay').fadeOut(500, function () {
        $(this).remove();
      });
    });
}
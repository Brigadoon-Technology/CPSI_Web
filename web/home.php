<?php 
    require_once('../Connections/connUserareas.php');
    session_start(); 
    require_once('restrictbylevel.php'); 
    $date = date('Y-m-d h:i:s');
    if (isset($_POST['custnum'])) {
        $_SESSION['CustNum'] = $_POST['custnum'];
	
    }

    $Key = $_SESSION['UserKey'];
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_rsNews = "SELECT * FROM news WHERE news.Archive = 0";
    $rsNews = mysql_query($query_rsNews, $connUserareas) or die(mysql_error());
    $row_rsNews = mysql_fetch_assoc($rsNews);
    $totalRows_rsNews = mysql_num_rows($rsNews);

    $colname_rsUsers = "-1";
    if (isset($_SESSION['CustNum'])) {
  	$colname_rsUsers = (get_magic_quotes_gpc()) ? $_SESSION['CustNum'] : addslashes($_SESSION['CustNum']);
    }
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_rsUsers = sprintf("SELECT * FROM companynames WHERE CustNum = %s", $colname_rsUsers);
    $rsUsers = mysql_query($query_rsUsers, $connUserareas) or die(mysql_error());
    $row_rsUsers = mysql_fetch_assoc($rsUsers);
    $totalRows_rsUsers = mysql_num_rows($rsUsers);

    //Support Type 
    $colname_rsSupportType = "-1";
    if (isset($_SESSION['CustNum'])) {
   	$colname_rsSupportType = (get_magic_quotes_gpc()) ? $_SESSION['CustNum'] : addslashes($_SESSION['CustNum']);
    }
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_rsSupportType = sprintf("SELECT CustNum, SupportNum FROM supportcust WHERE CustNum = %s", $colname_rsSupportType);
    $rsSupportType = mysql_query($query_rsSupportType, $connUserareas) or die(mysql_error());
    $row_rsSupportType = mysql_fetch_assoc($rsSupportType);
    $totalRows_rsSupportType = mysql_num_rows($rsSupportType);

    //Answering Service Support Type 
    $colname_rsASSupportType = "-1";
    if (isset($_SESSION['CustNum'])) {
      	$colname_rsASSupportType = (get_magic_quotes_gpc()) ? $_SESSION['CustNum'] : addslashes($_SESSION['CustNum']);
    }
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_rsASSupportType = sprintf("SELECT CustNum, SupportNum FROM ASsupportcust WHERE CustNum = %s", $colname_rsASSupportType);
    $rsASSupportType = mysql_query($query_rsASSupportType, $connUserareas) or die(mysql_error());
    $row_rsASSupportType = mysql_fetch_assoc($rsASSupportType);
    $totalRows_rsASSupportType = mysql_num_rows($rsASSupportType);

    $colname_rsMember = "-1";
    if (isset($_SESSION['Username'])) {
      	$colname_rsMember = (get_magic_quotes_gpc()) ? $_SESSION['Username'] : addslashes($_SESSION['Username']);
    }
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_rsMember = sprintf("SELECT Username, Userlevel FROM members WHERE Username = '%s' AND members.Userlevel = 2", $colname_rsMember);
    $rsMember = mysql_query($query_rsMember, $connUserareas) or die(mysql_error());
    $row_rsMember = mysql_fetch_assoc($rsMember);
    $totalRows_rsMember = mysql_num_rows($rsMember);

    $colname_rsCompanyLogin = "Greenco";
    if (isset($_SESSION['Username'])) {
 	 $colname_rsCompanyLogin = (get_magic_quotes_gpc()) ? $_SESSION['Username'] : addslashes($_SESSION['Username']);
    }
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_rsCompanyLogin = sprintf("SELECT Username, members.Userlevel FROM members WHERE Username = '%s' AND members.Userlevel = 1", $colname_rsCompanyLogin);
    $rsCompanyLogin = mysql_query($query_rsCompanyLogin, $connUserareas) or die(mysql_error());
    $row_rsCompanyLogin = mysql_fetch_assoc($rsCompanyLogin);
    $totalRows_rsCompanyLogin = mysql_num_rows($rsCompanyLogin);

    $colname2_Memberlevel3 = "-1";
    if (isset($_SESSION['Username'])) {
  	$colname2_Memberlevel3 = (get_magic_quotes_gpc()) ? $_SESSION['Username'] : addslashes($_SESSION['Username']);
    }
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_Memberlevel3 = sprintf("SELECT Username, Userlevel FROM members WHERE Username = '%s' AND members.Userlevel = 3", $colname2_Memberlevel3);



    $Memberlevel3 = mysql_query($query_Memberlevel3, $connUserareas) or die(mysql_error());
    $row_Memberlevel3 = mysql_fetch_assoc($Memberlevel3);
    $totalRows_Memberlevel3 = mysql_num_rows($Memberlevel3);

    $colname_rsAddress = "-1";
    if (isset($_SESSION['CustNum'])) {
  	$colname_rsAddress = (get_magic_quotes_gpc()) ? $_SESSION['CustNum'] : addslashes($_SESSION['CustNum']);
    }
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_rsAddress = sprintf("SELECT CustNum FROM companyaddress WHERE CustNum = %s", $colname_rsAddress);
    $rsAddress = mysql_query($query_rsAddress, $connUserareas) or die(mysql_error());
    $row_rsAddress = mysql_fetch_assoc($rsAddress);
    $totalRows_rsAddress = mysql_num_rows($rsAddress);

    $colname_confirmation = "-1";
    if (isset($_SESSION['CustNum'])) {
  	$colname_confirmation = (get_magic_quotes_gpc()) ? $_SESSION['CustNum'] : addslashes($_SESSION['CustNum']);
    }
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_confirmation = sprintf("SELECT * FROM usergrouproster WHERE CustNum = %s", $colname_confirmation);
    $confirmation = mysql_query($query_confirmation, $connUserareas) or die(mysql_error());
    $row_confirmation = mysql_fetch_assoc($confirmation);
    $totalRows_confirmation = mysql_num_rows($confirmation);

    $colname_EmailBulletin = "-1";
    if (isset($_SESSION['CustNum'])) {
  	$colname_EmailBulletin = (get_magic_quotes_gpc()) ? $_SESSION['CustNum'] : addslashes($_SESSION['CustNum']);
    }
    mysql_select_db($database_connUserareas, $connUserareas);
    $query_EmailBulletin = sprintf("SELECT DISTINCT    `members`.`CustNum`,   `emailaccounts`.`CustNum` FROM `members`   INNER JOIN `emailaccounts` ON (`members`.`CustNum` = `emailaccounts`.`CustNum`) WHERE members.CustNum = %s", $colname_EmailBulletin);
    $EmailBulletin = mysql_query($query_EmailBulletin, $connUserareas) or die(mysql_error());
    $row_EmailBulletin = mysql_fetch_assoc($EmailBulletin);
    $totalRows_EmailBulletin = mysql_num_rows($EmailBulletin);
  
    //WR: 0907131306 - hm1996
    $query_memberInfo = sprintf("SELECT DisplayName, Email, telephone, extension FROM members WHERE Username = '%s'", $colname_rsMember);
    $memberInfo = mysql_query($query_memberInfo, $connUserareas) or die(mysql_error());
    $row_memberInfo = mysql_fetch_assoc($memberInfo);
    $totalRows_rsMember = mysql_num_rows($memberInfo);

    $sql_update = "UPDATE members SET members.LastLogin = '$date' WHERE members.UserKey = '$Key'"; 
    //echo $sql_update;
    $result = mysql_query($sql_update) or die("Can't complete query ".mysql_error());
    mysql_free_result($rsMember);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/userareas.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
 
<!-- InstanceBeginEditable name="doctitle" -->
<title>CPSI: Userareas</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<style type="text/css">
a img {
    border: none
}
<!--
.style6 {font-size: 12px}
-->
</style>
<style type="text/css">
<!--
.style10 {color: #000000}
-->
</style>
<style type="text/css">
<!--
.style11 {color: #FF0000}
-->
</style>

<!-- InstanceEndEditable -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	/*font-size: 10px;*/
	font-family: Arial, Helvetica, sans-serif;
	color: #7C7C7C;
}


-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--

var b_timer = null; // blink timer
var b_on = true; // blink state
var blnkrs = null; // array of spans

function blink() {
    var tmp = document.getElementsByTagName("span");
    if (tmp) {
	blnkrs = new Array();
	var b_count = 0;
	for (var i = 0; i < tmp.length; ++i) {
	    if (tmp[i].className == "blink") {
		blnkrs[b_count] = tmp[i];
		++b_count;
	    }
	}
	// time in m.secs between blinks
	// 500 = 1/2 second
	blinkTimer(2000);
    }
}

function blinkTimer(ival) {
    if (b_timer) {
	window.clearTimeout(b_timer);
	b_timer = null;
    }
    blinkIt();
    b_timer = window.setTimeout('blinkTimer(' + ival + ')', ival);
}

function blinkIt() {
    for (var i = 0; i < blnkrs.length; ++i) {
    	if (b_on == true) {
 	    blnkrs[i].style.visibility = "hidden";
	} else {
	    blnkrs[i].style.visibility = "visible";
	}
    }
    b_on =!b_on;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>


<body onLoad="MM_preloadImages('images/barsandbuttons/onlinesystemdocov.gif','images/barsandbuttons/enhancementov.gif','images/barsandbuttons/educationov.gif','images/barsandbuttons/securityov.gif','images/barsandbuttons/micromedexov.gif','images/barsandbuttons/ispsevicesov.gif','images/barsandbuttons/newsletterov.gif','../images/BarsAndButtons/userareaov.gif','../images/BarsAndButtons/tophomeov.gif','images/barsandbuttons/usergroupsov.gif','images/barsandbuttons/usergroupdatabaseov.gif','images/barsandbuttons/cpsibbov.gif','images/barsandbuttons/visitorov.gif'); blink();">


<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#006666">
  <tr>
    <td width="75%" height="51" bgcolor="#3DB7E4"><a href="http://www.cpsi.com"><img src="../images/BarsAndButtons/cpsi_logo_800x137.jpg" name="cpLogo" width="800" height="137" border="0" id="cpLogo"></a></td>
    <td width="25%" background="../images/BarsAndButtons/topImage_new3.png" bgcolor="#FFFFFF"><div align="right"></div>    </td>
  </tr>
  <tr bordercolor="#D6D6CE" background="../images/topbg.gif">
<td height="18" colspan="3" align="right" valign="bottom" bgcolor="3DB7E4" class="dark">
    <a href="home.php" onMouseOver="MM_swapImage('Image2','','../images/userareas_name_change_ov.png',1)" onMouseOut="MM_swapImgRestore()"><img src="../images/userareas_name_change.png" name="Image2" width="106" height="16" border="0" id="Image2"></a><a href="https://userareas.cpsi.com/userareas/downloads/default.php" onMouseOver="MM_swapImage('Image11','','../images/DLNew_ov.png',1)" onMouseOut="MM_swapImgRestore()"><img src="../images/DLNew.png" name="Image11" width="100" height="16" border="0" id="Image11"></a>
</td>
  </tr>
  <tr>
    <td height="2" colspan="3" bgcolor="#AAAAAF"><img src="images/clearpixel.gif" width="1" height="1"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
     <td>
	<?php
	    include('menu/left_main.php');	
	?>
    </td>
    <td valign="top" background="../images/leftbg.gif" width="26">&nbsp;</td>
    <td valign="top" width="100%"><br>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="4" height="603">&nbsp;</td>
            <td valign="top"> <!-- InstanceBeginEditable name="text" -->
<!--	<div style="height: 155px;" >
		    <div  style="float: left; margin-right: 30px; ">
			<img src="images/importamt.jpeg"  alt="Important Message"  width="150px" height="150px"/>
		    </div>
		    <div>
			<br/><br/>
		<span style="color:red">
		<h2>New Phone Number:1-888-768-6961</h2> </span>
			Until further notice, please use this number: <strong>1-888-768-6961</strong> to contact CPSI or use the Internet Call Management System. 
				The issues with our toll free number have been resolved at this time.<br/>
				Please use this number:  1-800-711-2774 (CPSI) to contact CPSI or use the Internet Call Management System. 


		    </div>
		</div> -->
		<div style="clear:both"></div>

	    <?php if ($totalRows_rsMember > 0) { // Show if recordset not empty
	 	if($row_rsMember['Username'] != "") {
		     echo "<table width=\"100%\"  border=\"0\">\n<tr>\n<td><div align=\"left\"></div>";
		     echo "<div align=\"left\">You are logged in as " . $row_rsMember['Username'] . "</div></td>\n</tr>\n<tr>\n";
		     if($_SESSION['CustNum'] != 0) {
                     	echo "<td><a href=\"useradmin/updateuser.php\">update my information</a></td>\n";
		      }
		     
                     echo "\n</tr>\n</table>\n";
		}
 	    }
	    ?>
            <?php if ($totalRows_rsCompanyLogin > 0) { // Show if recordset not empty ?>
            <table width="100%"  border="0">
              <tr>
                <td>You are logged in as <?php echo $row_rsCompanyLogin['Username']; ?></td>
              </tr>
              <tr>
                <td><a href="useradmin/menu.php">View or add personal accounts</a> for <?php echo $row_rsUsers['CompanyName']; ?> </td>
              </tr>
            </table>
            <?php } // Show if recordset not empty ?>
            <?php if ($totalRows_Memberlevel3 > 0) { // Show if recordset not empty ?>
            <table width="100%"  border="0">
              <tr>
                <td colspan="2" class="Text">You are logged in as <?php echo $row_Memberlevel3['Username']; ?></td>

              </tr>
              <tr>
                <td class="Text"><a href="useradmin/updateuser.php">update my information</a></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="Text"><a href="Enhancements/selectdepartment.php">Enhancement Task Force</a></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <?php } // Show if recordset not empty ?>
            <p class="Text">Welcome <?php echo $row_rsUsers['CompanyName']; ?>  to the CPSI User Area.</p>
            <p>
	    <table width="90%">	
		<tr>
		  <td>
		  
<!--		<span style="color: red; font-size: 2em; font-weight: 700;"><p>
CPSI's User Area, including the Internet Call Management System (ICMS), will be down for scheduled maintenance
from 8:00 p.m. (Central) Thursday, 11/21/13, until approximately 8:00 a.m. Friday, 11/22/13.


</p></span>

--> 
	    <!-- Sit# 4916031 - hm1996
	    <a target="_blank" href="/corp_business_plan.pdf">Corporate DRBC Plan Summary<br>
	    -->
	    <a href="http://166.78.170.144/faq/top" target="_blank">Meaningful Use FAQ</a><br />
            <a href="http://166.78.170.144/" target="_blank">Meaningful Use Information</a><br>
<!--
            <a href="https://engage.vevent.com/index.jsp?eid=2896&seid=44" target="_blank">Meaningful Use Webcast</a><br />
-->
            <a href="https://engage.vevent.com/rt/cpsi~062614" target="_blank">Meaningful Use Webcast</a><br />
	     
            <!-- WR # - 1307031109 - kbw5089
	    <a href="Documentation/rfi.php" >RFI:Readiness for Hospitals to Electronically Report Inpatient Quality Data</a><br />
	    -->
            <a href="http://166.78.170.144/icd-10-information" target="_blank">ICD-10 Information</a><br />
	    
	    

	 

	    <!-- WR 1307031109 - kbw
 	    <a href="files/24_hour_Emergency_Support_Guide.pdf" target="_blank">24-hour Emergency Support Guide </a><br />
	    -->

		<!-- SIT 5418569 -kbw
	            <a href="files/After_Hours_Emergency_Support_Number_Update.pdf">After Hours Emergency Support Number Update</a><br />

		-->
		  </td>


		  <td>

		<!-- 	<a href="conferences/2014n_c.php"><img src="conferences/2014 National Conference logo.jpg" /></a>-->
			<span ><a href="conferences/2014_bestpractices.php"><img src="conferences/Best_Practices_4b.png" alt="2014 Best Practicies" height=110px; width=200px;/></a>
		   </td>

	<!--	<tr>

			<td colspan="2"><br/><span><font size="2" color="red"><strong>CPSI and TruBridge resume full support operations today. Thank you for your patience and support the past two days.</td>

		</tr>
-->

<!-- Sit 5930092 		    <td>
			<a href="conferences/national_users.php" target="_blank" ><img src="images/WEBSITE 200.jpg" width="170" height="130" alt="2013 National Users Conference"></a>
		    </td> 
		<tr>
-->
<!--	    <tr>
		<td colspan="2"><br /><span><font size="2" color="red"><strong>CPSI and TruBridge will be closed on Friday, July 4, 2014 in observance of Independence Day. We will reopen at 7am CST Monday, July 7, 2014.<strong></font></span></td>
	    </tr>
-->
<!--
	    <tr>
		<td colspan="2"><br /><span><font size="2" color="red"><strong>CPSI/TruBridge will be closed on Monday, May 26, 2014 in observance of the Memorial Day Holiday. We will reopen at 7am CST Tuesday, May 27, 2014.<strong></font></span></td>
	    </tr>
-->
<!--    <tr>
		<td colspan="2">
		    <br />
			<font size="2" color="red">
			    <strong>CPSI/Trubridge will be closing on Friday, November 29, 2013 in observance of Thanksgiving Day at 2 pm. We will reopen at 7 am CST Monday, December 2, 2013.<strong>
			</font>
		    </span>
		</td>
	    </tr>
-->
<!--
            <tr>
                <td colspan="2">
		    <br /><span class="blink">
			<font size="2" color="red">
			    <strong>CPSI and TruBridge will be closed on Thursday, July 4th in observance of Independence Day.  We will reopen at 7 am CST Friday, July 5th, 2013.<strong>
			</font>
		    </span>
		</td>
            </tr>
-->
<!-- <tr>
                <td colspan="2">
                    <br /><span class="blink">
                        <font size="2" color="red">
                            <strong>CPSI and TruBridge will be closed on Monday, September 02, 2013  in observance of Labor Day.  We will reopen at 7 am CST Tuesday, September 03, 2013.<strong>
                        </font>
                    </span>
                </td>
            </tr> -->
<!--
	    <tr>
                <td colspan="2">
                    <br />
                        <font size="2" color="red">
                            <strong>Important Update <br />The issues with our toll free number have been resolved at this time.  Please use this number:  1-800-711-2774 (CPSI) to contact CPSI or use the Internet Call Management System.<strong>
                        </font>
                </td>
            </tr> 
-->
<!--
            <tr>
                <td colspan="2">
                    <br />
                    <font size="2" color="red">
                        <strong>TruBridge Cloud Customers are currently experiencing intermittent connectivity issues, as our datacenter provider is currently working to resolve internet connectivity issues on their end.  We will update you as soon as operations have been fully restored.<strong>
                    </font>
                </td>
            </tr>
-->
<!--
            <tr>
                <td colspan="2">
                    <br />
                    <font size="2" color="red">
                        <strong>The issues experienced with the connection to the TruBridge Data Center provider have been resolved. TruBridge has confirmed connectivity and all user systems are available. Thank you for your patience.<strong>
                    </font>
                </td>
	    </tr>
-->
	</table> 
            </p>
            <table width="100%" border="0">
              <tr>
                <th colspan="2" bgcolor="#D6D6CE" scope="col"><div align="left">What's New  </div></th>
                </tr>
	        <tr>
                  <td valign="top" class="style5 style 10">August 25, 2014</td>
                  <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_ep_drug_formulary_checks/mu1_ep_drug_formulary_checks.html" target="_blank">Meaningful Use Stage 1 2014 Eligible Professionals Drug Formulary Checks</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_ep_drug_formulary_checks.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
                </tr>
                <tr>
	            <td valign="top" class="style5 style 10">August 15, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/Documentation/Ortho-ProVue Interface Critical Alert.pdf" target="_blank">Ortho-ProVue Interface Crtical Alert</a> - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">August 14, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Quality%20Measures%20-%20Employee%20Security/Quality%20Measures%20-%20Employee%20Security.html" target="_blank">Quality Measures: Employee Security Access</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Quality%20Measures%20-%20Employee%20Security/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Quality%20Measures%20-%20Employee%20Security.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">August 13, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Projects/beta_clindoc_documentation_reports/beta_clindoc_documentation_reports.html" target="_blank">Beta ClinDoc Documentation Reports</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Projects/beta_clindoc_documentation_reports/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Projects/beta_clindoc_documentation_reports.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">August 07, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Projects/Chart%20Communication/Chart%20Communication.html" target="_blank">Chart Communication</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Projects/Chart%20Communication/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Projects/Chart Communication.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">August 01, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_of_enabling_and_disabling/setup_of_enabling_and_disabling.html" target="_blank">Setup of Enabling and Disabling a Series Within Electronic Forms</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_of_enabling_and_disabling/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_of_enabling_and_disabling.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">August 01, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/muep_patient_list/muep_patient_list.html" target="_blank">Meaningful Use Stage 1 Patient List</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/muep_patient_list.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 24, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/newsletters/The CPSI Connection - Summer 2014.pdf" target="_blank">The CPSI Connection - Summer 2014</a> - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 18, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/MPEMR5%20vitals%20allergies/MPEMR5%20vitals%20allergies.html" target="_blank">MP-EMR5 Vitals, Allergies, and Patient History</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/MPEMR5%20vitals%20allergies/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/MPEMR5%20vitals%20allergies.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 17, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/IMS Translation Tables.pdf" target="_blank">Accessing and Updating the User-Maintained IMS Translation Tables</a> - <span class="style11">New!</span></td>
              </tr>
		  <tr>
	            <td valign="top" class="style5 style 10">July 15, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/usage_setup_of_vital_signs/usage_setup_of_vital_signs.html" target="_blank">Vital Signs Setup And Usage</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/usage_setup_of_vital_signs/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/usage_setup_of_vital_signs.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 14, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Patient%20Portal/Patient%20Portal.html" target="_blank">Meaningful Use Stage 2 Patient Portal: View, Download, and Transmit</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Financial/Patient%20Portal/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Patient%20Portal.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 09, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_usage_application_links_sig_areas_uploadimages/setup_usage_application_links_sig_areas_uploadimages.html" target="_blank">Electronic Forms Setup and Usage of Application Links, Signature Areas, and Uploading Images</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_usage_application_links_sig_areas_uploadimages/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_usage_application_links_sig_areas_uploadimages.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 08, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/MU2%20Physician%20Applications%20Objectives%20Overview/MU2%20Physician%20Applications%20Objectives%20Overview.html" target="_blank">Meaningful Use Stage 2 Physician Applications Objectives Overview</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/MU2%20Physician%20Applications%20Objectives%20Overview.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 08, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/poc_ipa/poc_ipa.html" target="_blank">Documenting The Initial Physical Assessment Via The Flow Chart Application</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/poc_ipa/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/poc_ipa.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 03, 2014</td>
	            <td><a href="http://cphelp.cpsi.com/v19/ptmgt/shared_profiles/index.html" target="_blank">Shared Profiles User Guide</a> - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 03, 2014</td>
	            <td><a href="correspondence/2014_Ohio_State_Tax_Tables.pdf" target="_blank">2014 Ohio State Tax Tables</a> - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 02, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_and_usage_of_image_and_help_areas/setup_and_usage_of_image_and_help_areas.html" target="_blank">Electronic Forms Setup and Usage of Image and Help Areas</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_and_usage_of_image_and_help_areas/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_and_usage_of_image_and_help_areas.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">July 01, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Clinical%20Decision%20Support%20(New%20Platform)/Clinical%20Decision%20Support%20(New%20Platform).html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Clinical Decision Support (New Platform)</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Clinical%20Decision%20Support%20(New%20Platform).zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 30, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Blood%20Administration/Blood%20Administration.html" target="_blank">Blood Administration</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Blood%20Administration/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Blood%20Administration.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 30, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_ep_clinic_lab_test_results_current_platform/mu1_ep_clinic_lab_test_results_current_platform.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Clinical Lab Test Results (Current Platform)</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_ep_clinic_lab_test_results_current_platform.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 30, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/usage_setup_of_markup_images_with_a_2_column%20format/usage_setup_of_markup_images_with_a_2_column%20format.html" target="_blank">Electronic Forms Usage and Setup of Markup Images With a Two Column Format</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/usage_setup_of_markup_images_with_a_2_column%20format/description.pdf" target="_blank">Description</a> (<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/usage_setup_of_markup_images_with_a_2_column%20format.zip"><strong>Desktop Download</strong></a>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 30, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/immunization_registries_data_submission/immunization_registries_data_submission.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals IRDS 2014 (Current Platform)</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/immunization_registries_data_submission.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 25, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/CPOE%20for%20Medication%20Orders/CPOE%20for%20Medication%20Orders.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals CPOE for Medication Orders (Current Platform)</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/CPOE%20for%20Medication%20Orders.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 24, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_ep_medication_reconciliation/mu_ep_medication_reconciliation.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Medication Reconciliation</a> (<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_ep_medication_reconciliation.zip"><strong>Desktop Download</strong></a>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 24, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/MU%20Clinical%20Summaries%20(Current)/MU%20Clinical%20Summaries%20(Current).html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Clinical Summaries (Current Platform)</a> (<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/MU%20Clinical%20Summaries%20(Current).zip"><strong>Desktop Download</strong></a>)- <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 24, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Electronic%20Prescribing%20MU/Electronic%20Prescribing.html" target="_blank">Meaningful Use Stage 2 Electronic Prescribing</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Electronic%20Prescribing%20MU.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 20, 2014</td>
	            <td><a href="http://cphelp.cpsi.com/v19/clinical/blood_admin/index.html" target="_blank">Blood Administration User Guide</a> - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 19, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_and_usage_dropdown_lists/setup_and_usage_dropdown_lists.html" target="_blank">Electronic Forms Setup and Usage of Dropdown Boxes</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_and_usage_dropdown_lists/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_and_usage_dropdown_lists.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 19, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/pt_reminders/pt_reminders.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Patient Reminders (Current Platform)</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/pt_reminders.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 17, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/check_boxes_radio_buttons/check_boxes_radio_buttons.html" target="_blank">Setup and Usage of Check Boxes, Radio Buttons and Mini-Columns</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/check_boxes_radio_buttons/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/check_boxes_radio_buttons.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 17, 2014</td>
	            <td><a href="http://us7.campaign-archive1.com/?u=9bda4c3dd47bc15e50badcafd&id=2ded337aec" target="_blank">CPSI eLearning Connection</a> - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 13, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_usage_text_labels_textbox_and_areas/setup_usage_text_labels_textbox_and_areas.html" target="_blank">Setup and Usage of Text Labels, Text Boxes and Text Areas</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_usage_text_labels_textbox_and_areas/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/setup_usage_text_labels_textbox_and_areas.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 12, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/Documentation/sat.php">Self Assessment Tools (SAT)</a> - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 12, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Medication%20Allergy%20List%20(New%20Platform)/Medication%20Allergy%20List%20(New%20Platform).html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Medication Allergy List (New Platform)</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Medication%20Allergy%20List%20(New%20Platform).zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 12, 2014</td>
	            <td><a href="correspondence/Redesign_of_CPSI_Development_and_Update_Process.pdf" target="_blank">Redesign of CPSI Development and Update Process</a> - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 10, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Physician_Documentation_Setup/Physician_Documentation_Setup.html" target="_blank">Physician Documentation Titles, Title Scripting,  Macros, Headers, and Report Distribution Setup</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Physician_Documentation_Setup/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Physician_Documentation_Setup.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 10, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/new_form_creation_and_master_setup/new_form_creation_and_master_setup.html" target="_blank">New Form Creation and Master Setup</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/new_form_creation_and_master_setup/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/new_form_creation_and_master_setup.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 10, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/phys_doc_template_builder/phys_doc_template_builder.html" target="_blank">Physician Documentation Template Setup</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/phys_doc_template_builder/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/phys_doc_template_builder.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 05, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Clinical%20Decision%20Support%20Rule/Clinical%20Decision%20Support%20Rule.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Clinical Decision Support Rule</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Clinical%20Decision%20Support%20Rule.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 05, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Record%20Vital%20Signs/Record%20Vital%20Signs.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Record Vital Signs (Current Platform)</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Record%20Vital%20Signs.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Record%20Vital%20Signs%20(New%20Platform)/Record%20Vital%20Signs%20(New%20Platform).html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Record Vital Signs (New Platform)</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Record%20Vital%20Signs%20(New%20Platform).zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Maintain%20Problem%20List/Maintain%20Problem%20List.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Maintain Problem List</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Maintain%20Problem%20List.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_pt_specific_edu_resources_mp_ehr/mu1_pt_specific_edu_resources_mp_ehr.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Patient Specific Education Resources</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_pt_specific_edu_resources_mp_ehr.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">June 02, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_physician_applications/mu1_physician_applications.html" target="_blank">Meaningful Use Stage 1 Physician Applications</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_physician_applications.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 29, 2014</td>
	            <td><a href="correspondence/2014_North_Dakota_State_Tax.pdf" target="_blank">2014 North Dakota State Tax Tables</a></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 29, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Identity Management/Identity Management.html" target="_blank">Identity Management</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Financial/Identity Management/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Identity%20Management.zip">Desktop Download</a></strong>)</td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 29, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Meaningful%20Use%20Security/Meaningful%20Use%20Security.html" target="_blank">Meaningful Use Security</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Meaningful%20Use%20Security.zip">Desktop Download</a></strong>)</td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 28, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/eforms_reflex_Functionality_and_setup/eforms_reflex_Functionality_and_setup.html" target="_blank">Electronic Forms Reflex Functionality and Setup</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/eforms_reflex_Functionality_and_setup/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/eforms_reflex_Functionality_and_setup.zip">Desktop Download</a></strong>)</td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 28, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/muep_active_med_list/muep_active_med_list.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Active Medication List</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/muep_active_med_list.zip">Desktop Download</a></strong>)</td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 27, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Electronic%20Prescribing/Electronic%20Prescribing.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Electronic Prescribing</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Electronic%20Prescribing.zip">Desktop Download</a></strong>)</td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 23, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Drug%20Interaction%20Checks/Drug%20Interaction%20Checks.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Drug Interaction Checks</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Drug%20Interaction%20Checks.zip">Desktop Download</a></strong>) </td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 23, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Active%20Medication%20Allergy%20List/Active%20Medication%20Allergy%20List.html" target="_blank">Meaningful Use Stage 1 Eligible Professionals Active Medication Allergy List</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Active%20Medication%20Allergy%20List.zip">Desktop Download</a></strong>) </td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 23, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/chartlink5_home_screen_and_whiteboard_list/chartlink5_home_screen_and_whiteboard_list.html" target="_blank">ChartLink5 Home Screen and Whiteboard List</a> -<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/chartlink5_home_screen_and_whiteboard_list/description.pdf" target="_blank"> Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/chartlink5_home_screen_and_whiteboard_list.zip">Desktop Download</a></strong>) </td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 21, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/files/3M_Core_Grouper_Upgrade_Webblast_052114.pdf" target="_blank">3M Core Grouper Upgrade Webblast</a></td>
              </tr>
	  	<tr>
	            <td valign="top" class="style5 style 10">May 21, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/electronic_forms_form_excel/electronic_forms_form_excel.html" target="_blank">Electronic Forms Form Database Code and AdHoc Setup Using Excel</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/electronic_forms_form_excel/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/electronic_forms_form_excel.zip">Desktop Download</a></strong>) </td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 12, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_Incorporate_clinical_lab_tests/mu2_Incorporate_clinical_lab_tests.html" target="_blank">Meaningful Use Stage 2 Incorporate Clinical Lab Tests Results Into Certified EHR Technology</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_Incorporate_clinical_lab_tests.zip">Desktop Download</a></strong>) </td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style 10">May 12, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_provide_structured_elec_lab_results/mu2_provide_structured_elec_lab_results.html" target="_blank">Meaningful Use Stage 2 Provide Structured Electronic Lab Results to Ambulatory Providers</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_provide_structured_elec_lab_results.zip">Desktop Download</a></strong>) </td>
              </tr>
	          <tr>

		<td valign="top" class="style5 style 10">May 6, 2014</td>
		<td><a href="http://us7.campaign-archive1.com/?u=9bda4c3dd47bc15e50badcafd&id=37de3f9e01&e=[UNIQID]" target="_blank" >The CPSI Connection - May 2014</a></td>
		</tr><tr>                
<td valign="top" class="style5 style10">May 01, 2014</td>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/required_question_setup_within_electronic_forms/required_question_setup_within_electronic_forms.html" target="_blank">Electronic Forms - Required Question Setup Within Electronic Forms</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/required_question_setup_within_electronic_forms/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/required_question_setup_within_electronic_forms.zip">Desktop Download</a></strong>) </td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 30, 2014</td>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/formless_and_multi_app_database_codes_usage_and_setup/formless_and_multi_app_database_codes_usage_and_setup.html" target="_blank">Electronic Forms - Formless and Multi-Application Database Code Usage and Setup</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/formless_and_multi_app_database_codes_usage_and_setup/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/formless_and_multi_app_database_codes_usage_and_setup.zip">Desktop Download</a></strong>) </td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 24, 2014</td>
                <td><a href="http://cphelp.cpsi.com/v19/phymod/trackingb/index.html" target="_blank">Tracking Board User Guide</a></td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 24, 2014</td>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_cds/mu_cds.html" target="_blank">Meaningful Use Stage 2 Clinical Decision Support</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_cds.zip">Desktop Download</a></strong>) </td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 24, 2014</td>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_med_rec/mu_med_rec.html" target="_blank">Meaningful Use Stage 2 Medication Reconciliation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_med_rec.zip">Desktop Download</a></strong>) </td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 23, 2014</td>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Electronic_forms_database_code_types/Electronic_forms_database_code_types.html" target="_blank">Electronic Forms - Database Code Types</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Electronic_forms_database_code_types/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Electronic_forms_database_code_types.zip">Desktop Download</a></strong>) </td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 22, 2014</td>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_lab_reportables/mu_lab_reportables.html" target="_blank">Meaningful Use Stage 2 Lab Reportables</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_lab_reportables.zip">Desktop Download</a></strong>) </td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 22, 2014</td>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_active_med_list/mu_active_med_list.html" target="_blank">Meaningful Use Stage 1 Active Medication List</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_active_med_list.zip"><strong>Desktop Download</strong></a>) </td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 22, 2014</td>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_summary_of_care/mu1_summary_of_care.html" target="_blank">Meaningful Use Stage 1 Summary of Care</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_summary_of_care.zip">Desktop Download</a></strong>) </td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 22, 2014</td>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_summary_of_care/mu2_summary_of_care.html" target="_blank">Meaningful Use Stage 2 Summary of Care</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_summary_of_care.zip">Desktop Download</a></strong>) </td>
              </tr>
              <tr>
                <td valign="top" class="style5 style10">April 10, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_patient_list/mu_patient_list.html" target="_blank">Meaningful Use Stage 2 Generate List of Patient Specific Conditions</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu_patient_list.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 10, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_imaging/mu2_imaging.html" target="_blank">Meaningful Use Stage 2 Imaging Results</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_imaging.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 10, 2014</td>
	            <td><a href="https://userareas.cpsi.com/add_doc.php" target="_blank">At-A-Glances</a></td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 10, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_amendments/mu_amendments.html" target="_blank">Meaningful Use Stage 2 Protect EHR - Amendment</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_amendments.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_data_port/mu_data_port.html" target="_blank">Meaningful Use Stage 2 Data Portability</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_data_port.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_submit_electronic_data_to_immunization_registries/mu2_submit_electronic_data_to_immunization_registries.html" target="_blank">Meaningful Use Stage 2 Submit Electronic Data to Immunization Registries</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_submit_electronic_data_to_immunization_registries.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_submit_electronic_data_to_immunization_registries/mu1_submit_electronic_data_to_immunization_registries.html" target="_blank">Meaningful Use Stage 1 Submit Electronic Data to Immunization Registries</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_submit_electronic_data_to_immunization_registries.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_record_chart_vital_signs/mu2_record_chart_vital_signs.html" target="_blank">Meaningful Use Stage 2 Record and Chart Vital Signs</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_record_chart_vital_signs.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_record_and_chart_vital_signs/mu1_record_and_chart_vital_signs.html" target="_blank">Meaningful Use Stage 1 Record and Chart Vital Signs</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_record_and_chart_vital_signs.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_patient_specific_edu_resources/mu2_patient_specific_edu_resources.html" target="_blank">Meaningful Use Stage 2 Patient Specific Education Resources</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_patient_specific_edu_resources.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_patient_specific_edu_resources/mu1_patient_specific_edu_resources.html" target="_blank">Meaningful Use Stage 1 Patient Specific Education Resources</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu1_patient_specific_edu_resources.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_electronic_medication_administration_record/mu2_electronic_medication_administration_record.html" target="_blank">Meaningful Use Stage 2 Electronic Medication Administration Record</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/mu2_electronic_medication_administration_record.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">April 04, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu2_Stats/mu2_Stats.html" target="_blank">Meaningful Use Stage 2 Statistics</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu2_Stats.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">March 27, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/ss_projects.php" target="_blank">Tracking Board Presentation</a><a href="https://userareas.cpsi.com/userareas/presentations/Projects/Tracking Board/description.pdf" target="_blank"> - Description</a></td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">March 21, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/MU_pharmacy/MU_pharmacy.html" target="_blank">Meaningful Use Stage 1 Objectives: Pharmacy</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/MU_pharmacy.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">March 07, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/PhysDocFunctionality/multiscreen.html" target="_blank">Physician Documentation Functionality </a><strong>Captivate!</strong> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/PhysDocFunctionality/physdoc_description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/PhysDocFunctionality.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">February 27, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_Wisconsin_State_Tax.pdf" target="_blank">2014 Wisconsin State Tax</a></td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">February 27, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_Daylight_Savings_Information.pdf" target="_blank">2014 Daylight Savings Information</a></td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">February 24, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/Documentation/add_docs/misc/Patient_Portal.pdf" target="_blank">Patient Portal</a></td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">February 24, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/CPOE5/CPOE5.html" target="_blank">CPOE5 Presentation</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/CPOE5/cpoe5_description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/CPOE5.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">February 20, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/CL5/CL5.html" target="_blank">ChartLink5 Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/CL5.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">February 18, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/newsletter/The_CPSI_Connection_Winter_2014" target="_blank">The CPSI Connection (Winter 2014)</a></td>
                </tr>


<tr>
                <td valign="top" class="style5 style10">February 07, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/CW5%20Grouper/CW5%20Grouper.html" target="_blank">CW5 Grouper Presentation</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Financial/CW5%20Grouper/description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/CW5%20Grouper.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">January 16, 2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/flowchart_setup/flowchart_setup.html" target="_blank">Flowchart Setup Presentation</a> - <a href="https://userareas.cpsi.com/userareas/presentations/Clinical/flowchart_setup/flow_description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/flowchart_setup.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">January 14,2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/3M_Core_Grouping_Software_Interface.pdf" target="_blank">3M Core Grouping Software Interface</a></td>
                </tr>


<tr>
                <td valign="top" class="style5 style10">January 13,2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_Missouri_State_Tax_Tables.pdf" target="_blank">Missouri State Tax Tables</a></td>
                </tr>


<tr>
                <td valign="top" class="style5 style10">January 10,2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_Oklahoma_State_Tax_Tables.pdf" target="_blank">Oklahoma State Tax Tables</a></td>
                </tr>


<tr>
                <td valign="top" class="style5 style10">January 09,2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_California_State_Tax_Tables.pdf" target="_blank">California State Tax Tables</a></td>
                </tr>


<tr>
                <td valign="top" class="style5 style10">January 06,2014</td>
	            <td><a href="http://cphelp.cpsi.com/v19/itech/identity_mgm/index.html" target="_blank">Identity Management User Guide</a></td>
                </tr>


<tr>
                <td valign="top" class="style5 style10">January 02,2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_Minnesota_State_Tax_Tables.pdf" target="_blank">Minnesota State Tax Tables</a></td>
                </tr>


<tr>
                <td valign="top" class="style5 style10">January 02,2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_New_York_State_Tax_Tables.pdf" target="_blank">New York State Tax Tables</a></td>
                </tr>


<tr>
                <td valign="top" class="style5 style10">January 02,2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_Kansas_State_Tax_Tables.pdf" target="_blank">Kansas State Tax Tables</a></td>
                </tr>


<tr>
                <td valign="top" class="style5 style10">January 02,2014</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/3M C R.pdf" target="_blank">3M C&R Interface Users</a></td>
                </tr>




	  <tr>
	            <td valign="top" class="style5 style10">December 27, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_Kentucky_State_Tax_Tables.pdf" target="_blank">Kentucky State Tax Tables</a></td>
        

		  <tr>
	            <td valign="top" class="style5 style10">December 27, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_Federal_Income_Tax_Withholding_Tables.pdf" target="_blank">2014 Federal Income Tax Withholding Tables</a></td>
          <tr>
	       


     <td valign="top" class="style5 style10">December 18, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/Quarterly_APCCPT_Update_Instructions.pdf" target="_blank">Quarterly APC/CPT Update Instructions</a></td>
                </tr>
	          <tr>
                <td valign="top" class="style5 style10">December 17, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu2_record_demographics/mu2_record_demographics.html" target="_blank">Meaningful Use Stage 2 Record Demographics Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu2_record_demographics.zip">Desktop Download</a></strong>) </td>
                </tr>
	          	 <tr>
	            <td valign="top" class="style5 style10">December 09, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/e-scribe_captivate/multiscreen.html" target="_blank">E-scribe Queue Presentation </a><strong>Captivate!</strong> - <a href="https://userareas.cpsi.com/userareas/presentations/escribe_description.pdf" target="_blank">Description</a> (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/e-scribe_captivate.zip">Desktop Download</a></strong>) </td>
                </tr>
	          <tr>
	            <td valign="top" class="style5 style10">December 04, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2013_W2_Instructions.pdf" target="_blank">2013 W2 Instructions</a></td>
                </tr>
	          <tr>
	            <td valign="top" class="style5 style10">December 04, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/correspondence/2014_North_Carolina_State_Tax.pdf" target="_blank">2014 North Carolina State Tax</a></td>
                </tr>
	          <tr>
	            <td valign="top" class="style5 style10">December 04, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu2_advanced_directive/mu2_advanced_directive.html" target="_blank">Meaningful Use Stage 2 Advance Directive Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu2_advanced_directive.zip">Desktop Download</a></strong>)</td>
                </tr>
	          <tr>
	            <td valign="top" class="style5 style10">November 29, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu2_smoking_status/mu2_smoking_status.html" target="_blank">Meaningful Use Stage 2 Smoking Status Objective Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu2_smoking_status.zip">Desktop Download</a></strong>)</td>
                </tr>
	    <!--      <tr>
	            <td valign="top" class="style5 style10">November 29, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/phar_acet_total/phar_acet_total.html" target="_blank">Acetaminophen Total Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/phar_acet_total.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
                </tr>
	          <tr>
	            <td valign="top" class="style5 style10">November 12, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/prescription_writer_captivate/multiscreen.html" target="_blank">Prescription Writer Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/prescription_writer_captivate.zip">Desktop Download</a></strong>) - <span class="style11">New!</span></td>
              </tr>
	       <tr>
	            <td valign="top" class="style5 style10">November 08, 2013</td>
	            <td><a href="./correspondence/Interfaces_and_Version_19.pdf" target="_blank">Interfaces and Version 19</a> - <span class="style11">New!</span></td>
              </tr>
	      
	       <tr>
	            <td valign="top" class="style5 style10">November 08, 2013</td>
	            <td><a href="http://us7.campaign-archive1.com/?u=9bda4c3dd47bc15e50badcafd&id=7bc27f2ca4" target="_blank">The CPSI Connection (November 2013)</a> - <span class="style11">New!</span></td>
              </tr>
	      </tr>
	          <tr>
	            <td valign="top" class="style5 style10">November 01, 2013</td>
	            <td><a href="correspondence/Escribe_and_Prescription_Entry_Changes.pdf" target="_blank">Escribe and Prescription Entry Changes</a> - <span class="style11">New!</span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">October 31, 2013</td>
	            <td><a href="correspondence/TruCode Version 19.pdf" target="_blank">TruCode Version 19</a><span class="style11"></span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">October 17, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Temporary%20Orders/multiscreen.html" target="_blank">Temporary Orders Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/Temporary%20Orders.zip">Desktop Download</a></strong>)<span class="style11"></span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">September 30, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/Documentation/add_docs/ins/Inpatient_Psych_PPS.pdf" target="_blank">Inpatient Psych PPS 2013</a><span class="style11"></span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">September 30, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/v19_bodpac_release_notes/v19_bodpac_release_notes.html" target="_blank">V19 Business Office, Data Processing, and Accounting Enhancements Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/v19_bodpac_release_notes.zip">Desktop Download</a></strong>)<span class="style11"></span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">September 24, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/v19_insurance_release_notes/v19_insurance_release_notes.html" target="_blank">V19 Insurance Enhancements Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/v19_insurance_release_notes.zip">Desktop Download</a></strong>)<span class="style11"></span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">September 23, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/V19_mr_release_notes/V19_mr_release_notes.html" target="_blank">V19 Medical Records Enhancements Presentation</a> - <strong>(<a href="https://userareas.cpsi.com/userareas/presentations/Financial/V19_mr_release_notes.zip">Desktop Download</a></strong>)<span class="style11"></span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">September 18, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Financial/V19_registration_release_notes/V19_registration_release_notes.html" target="_blank">V19 Registration Enhancements Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/V19_registration_release_notes.zip">Desktop Download</a></strong>)<span class="style11"></span></td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">September 12, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/v19_physapps_release_notes/v19_physapps_release_notes.html" target="_blank">V19 Physician Applications Enhancements Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/v19_physapps_release_notes.zip">Desktop Download</a></strong>)</td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">September 12, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/v19_phar_release_notes/v19_phar_release_notes.html" target="_blank">V19 Pharmacy Enhancements Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/v19_phar_release_notes.zip">Desktop Download</a></strong>)</td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">September 11, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/v19_poc_release_notes/v19_poc_release_notes.html" target="_blank">V19 Patient Documentation Enhancements Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/v19_poc_release_notes.zip"><strong>Desktop Download</strong></a>)</td>
              </tr>
	          <tr>
	            <td valign="top" class="style5 style10">September 09, 2013</td>
	            <td><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/v19_ancillary_release_notes/v19_ancillary_release_notes.html" target="_blank">V19 Ancillary Enhancements Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/v19_ancillary_release_notes.zip"><strong>Desktop Download</strong></a>)</td>
              </tr>
	          <tr>
		<td valign="top" class="style5 style10">September 03, 2013</td>
		<td><a href="https://userareas.cpsi.com/userareas/newsletter/The_CPSI_Connection_Q3_2013.pdf">The CPSI Connection (Q3 2013)</a></td>

		</tr>
               <tr> 
                 <td valign="top" class="style6 style10">August 13, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/rule_based_security/rule_based_security.html" target="_blank">Rule Based Security Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/rule_based_security.zip">Desktop Download</a></strong>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">July 30, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/narrative_transcript_workflow/narrative_transcript_workflow.html" target="_blank">Narrative and Transcription Workflow Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/narrative_transcript_workflow.zip"><strong>Desktop Download</strong></a>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">July 26, 2013</td>
                 <td valign="top" class="style6"><a href="release/v19/V19ReleaseNotes_111213.pdf" target="_blank">Version 19 Release Notes</a></td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">July 02, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/esign_scanned_images/esign_scanned_images.html" target="_blank">E-Signing Scanned Images Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/esign_scanned_images.zip">Desktop Download</a></strong>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">June 27, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_stg2/mu_stg2.html" target="_blank">Meaningful Use Stage 2 Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_stg2.zip">Desktop Download</a></strong>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">June 25, 2013</td>
                 <td valign="top" class="style6"><a href="correspondence/July_2013_APC_CPT_Update.pdf" target="_blank">July 2013 APC / CPT  Update</a></td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">June 24, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_stg1_yr_one/mu_stg1_yr_one.html" target="_blank">Meaningful Use Stage 1, Year 1 Changes Effective FFY 2014 Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_stg1_yr_one.zip"><strong>Desktop Download</strong></a>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">June 24, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_stg1_yr_two/mu_stg1_yr_two.html" target="_blank">Meaningful Use Stage 1, Year 2 Changes Effective FFY 2014 Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Financial/mu_stg1_yr_two.zip"><strong>Desktop Download</strong></a>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">May 31, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/quality_control_data%20entry_calc_archiving/quality_control_data%20entry_calc_archiving.html" target="_blank">Quality Control (Data Entry, Calculating &amp; Archiving)</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/quality_control_data%20entry_calc_archiving.zip">Desktop Download</a></strong>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">May 30, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/temp_reg/temp_reg.htm" target="_blank">Temporary Registration Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Financial/temp_reg.zip"><strong>Desktop Download</strong></a>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">May 24, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/quality_control_nonparrallel_parallel_setup/quality_control_nonparrallel_parallel_setup.html" target="_blank">Quality Control (Non Parallel and Parallel) Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/quality_control_nonparrallel_parallel_setup.zip">Desktop Download</a></strong>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">May 23, 2013</td>
                 <td valign="top" class="style6"><a href="correspondence/2013_Home_Health_Billing_Change_2.pdf" target="_blank">2013 Home Health Billing Change</a></td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">May 23, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/quality_control_setup/quality_control_setup.html" target="_blank">Quality Control Setup Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/quality_control_setup.zip">Desktop Download</a></strong>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">May 01, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Accts_Mgt/Accts_Mgt.html" target="_blank">Accounts Management Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Accts_Mgt.zip">Desktop Download</a></strong>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">April 26, 2013</td>
                 <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Report_Writer/Report_Writer.html" target="_blank">Report Writer Presentation</a> - (<strong><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Report_Writer.zip">Desktop Download</a></strong>)</td>
               </tr>
               <tr>
                 <td valign="top" class="style6 style10">April 18, 2013</td>
                 <td valign="top" class="style6"><a href="http://cphelp.cpsi.com/v18/phymod/chartlink5/index.html" target="_blank">ChartLink 5 User Guide</a></td>
               </tr> -->
              <!-- WR 1308300929 - kbw0589 <tr>
              	  <td valign="top" class="style6 style10">April 12, 2013</td>
              	  <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/newsletter/The_CPSI_Connection_April_2013.pdf" target="_blank">The CPSI Connection (April 2013)</a></td>
           	  </tr>
             <tr>
              	  <td valign="top" class="style6 style10">April 12, 2013</td>
              	  <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/newsletter/The_CPSI_Connection_March_2013.html" target="_blank">The CPSI Connection (March 2013)</a></td>
           	  </tr>-->

<!--
			  <tr>
			    <td valign="top" class="style6 style10">March 29, 2013</td>
			    <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Registration_Procedures/Registration_Procedures.html" target="_blank">Registration Procedures Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Financial/Registration_Procedures.zip"><strong>Desktop Download</strong></a>)</td>
		      </tr>
			  <tr>
			    <td valign="top" class="style6 style10">March 20, 2013</td>
			    <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/1850_Physician_Documentation/1850_Physician_Documentation.html" target="_blank">Physician Documentation 1850 Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Financial/1850_Physician_Documentation.zip"><strong>Desktop Download</strong></a>)</td>
		      </tr>
			  <tr>
			    <td valign="top" class="style6 style10">March 18, 2013</td>
			    <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/ChartLink5_1850/ChartLink5_1850.html" target="_blank">ChartLink5 1850 Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/ChartLink5_1850.zip"><strong>Desktop Download</strong></a>)</td>
		      </tr>
			  
		      <tr>
			    <td valign="top" class="style6 style10">March 14, 2013 </td>
			    <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/files/24_hour_Emergency_Support_Guide.pdf" target="_blank">24 Hour Emergency Support Guide</a></td>
		      </tr>  
			  
			  <tr>
			    <td valign="top" class="style6 style10">March 01, 2013</td>
			    <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/Anesthesia_Billing/Anesthesia_Billing.html" target="_blank">Anesthesia Billing Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Financial/Anesthesia_Billing.zip"><strong>Desktop Download</strong></a>)</td>
		      </tr>
			  <tr>
			    <td width="15%" valign="top" class="style6 style10">February 18, 2013</td>
			    <td width="85%" valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Clinical/1850_Clinical_Release/1850_Clinical_Release.html" target="_blank">V1850 Clinical Release Notes Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Clinical/1850_Clinical_Release.zip"><strong>Desktop Download</strong></a>)</td>
		      </tr>
			  <tr>
			    <td valign="top" class="style6 style10">February 12, 2013</td>
			    <td valign="top" class="style6"><a href="correspondence/2013_Home_Health_Billing_Change.pdf" target="_blank">2013 Home Health Billing Change</a></td>
		      </tr>
-->
	<!--	WR1304100830	  <tr>
              	  <td valign="top" class="style6 style10">February 08, 2013</td>
              	  <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/newsletter/The_CPSI_Connection_February_2013.html" target="_blank">The CPSI Connection (February 2013)</a> - <span class="style11">New!</span></td>
           	  </tr> 
              	<tr>
              	  <td valign="top" class="style6 style10">February 08, 2013</td>
              	  <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/presentations/Financial/1850_Release/1850_Release.html" target="_blank">V1850 Financial Release Notes Presentation</a> - (<a href="https://userareas.cpsi.com/userareas/presentations/Financial/1850_Release.zip"><strong>Desktop Download</strong></a>)</td>
           	  </tr>
              	<tr> -->
            <!--  WR1304100830 	<tr>
		        <td valign="top" class="style6 style10">January 09, 2013</td>
		        <td valign="top" class="style6"><a href="correspondence/Q1_2013_Newsletter.pdf" target="_blank">The CPSI Connection (January 2013)</a> - <span class="style11">New!</span></td>
	          </tr>
		<td valign="top" class="style6 style10">January 02, 2013</td>
		        <td valign="top" class="style6"><a href="correspondence/3M_Medical_Record_Coding_Interface.pdf" target="_blank">3M Medical Record Coding Interface Update</a></td>
	          </tr>
		      <tr>
			    <td valign="top" class="style6 style10">December 14, 2012</td>
			    <td valign="top" class="style6"><a href="release/v18/1850_Release_Notes_12-14-12.pdf" target="_blank">Version 1850 Release Notes</a></td>
		      </tr>
			  <tr> -->
			    
			    <!-- WR1304100830		    <tr>
                       <td valign="top" class="style6 style10">December 07, 2012</td>
                       <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/newsletter/The_CPSI_Connection_December_2012_web_2.1.13.html" target="_blank">The CPSI Connection (December 2012)</a></td>
                     </tr>-->
			    <!-- WR1304100830		    <tr>
                       <td valign="top" class="style6 style10">November 26, 2012</td>
                       <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/newsletter/The_CPSI_Connection_November_2012_FINAL.html" target="_blank">The CPSI Connection (November 2012)</a> </td>
                     </tr>
	      -->			    
               <!-- WR1304100830      <tr>
                       <td valign="top" class="style6 style10">September 20, 2012</td>
                       <td valign="top" class="style6"><a href="https://userareas.cpsi.com/userareas/newsletter/2012_Fall_newsletter.pdf" target="_blank">CPSI Newsletter (Fall 2012)</a></td>
                     </tr> -->              <!-- WR: 1203151105 - hm1996 
		      <tr>
                       <td valign="top" class="style6 style10">October 26, 2011 </td>
                       <td valign="top" class="style6"><a href="conferences/financial.php" target="_blank">2012 Financial Revenue Cycle and Executive Conference Registration</a></td>
              </tr>
-->
              <!-- deleted by hm1996
		      <tr>
		        <td valign="top" class="style6 style10">February 9, 2010 </td>
		        <td valign="top" class="style6"><a href="pocphyconf.php">2010 POC & PHY Spring Conference</a> </td>
	          </tr>
		  -->
	        </table>
            <br>
            <table width="100%" border="0">
              <tr>
                <th width="74%" bgcolor="#D6D6CE" scope="col"><div align="left">New Employee Information  </div></th>
                <th width="4%" bgcolor="#D6D6CE" scope="col">MPM Conversion </th>
                <th width="22%" bgcolor="#D6D6CE" scope="col"><p>Online Help </p>                </th>
              </tr>
              
              <tr>
                <td><a href="https://userareas.cpsi.com/add_doc.php" target="_blank">Best Practices</a></td>
                <td rowspan="6" valign="top"><div align="center"><a href="correspondence/2008_mpemr_packet.pdf" target="_blank">MPM Conversion Packet</a> </div></td>
                <td rowspan="6" valign="top"><div align="center"><a href="https://userareas.cpsi.com/userareas/release/v19.php" target="_blank"><img src="images/v19_LOGO.gif" width="100" height="51" alt="V19"></a><br>
                  <br>
                  As of 08/19/13 </p>
                </div></td>
              </tr>
              <tr>
                <td><a href="http://cphelp.cpsi.com/v19/index.html" target="_blank">V19 User Guides</a></td>
              </tr>
              <tr>
                <td><a href="http://cphelp.cpsi.com/v18/index.html" target="_blank">V18 User Guides</a> </td>
              </tr>
              <tr>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/fin/financial.html" target="_blank">Financial Online Training Presentations </a></td>
              </tr>
              <tr>
                <td><a href="https://userareas.cpsi.com/userareas/presentations/clin/clinical.html" target="_blank">Clinical Online Training Presentations </a> </td>
              </tr>
              <tr>
                <td><a href="https://userareas.cpsi.com/userareas/Education/online-ed-home.php">Webex Sign-Up</a> </td>
              </tr>
            </table>
             <p class="Text">
              <?php 
			$stype = $row_rsASSupportType['SupportNum']; 
			// echo "$stype <br>";
			switch ($stype) {
				case "1" :
					echo "<p class=\"requiredText\">*** New March 22, 2006 ***</p><p class=\"Text\"><a href=\"/userareas/answering_after_hours.php\">After Hours Support Services</a></p>";
					break;
				case "2" :
					echo "<p class=\"requiredText\">*** New March 22, 2006 ***</p><p class=\"Text\"><a href=\"/userareas/answering_tech_pharmacy.php\">After Hours Support Services</a></p>";
					break;
				case "3" :
					echo "<p class=\"requiredText\">*** New March 22, 2006 ***</p><p class=\"Text\"><a href=\"/userareas/answering_tech_poc.php\">After Hours Support Services</a></p>";
					break;
				case "4" :
					echo "<p class=\"requiredText\">*** New March 22, 2006 ***</p><p class=\"Text\"><a href=\"/userareas/answering_tech_pharmacy_poc.php\">After Hours Support Services</a></p>";
					break;

			} // end switch
			?>
            </p>
            <hr>
              <p>If you have any questions or problems with the userarea web site please feel free to <a href="mailto:wan@cpsi.com">email us</a>.</p>
              <p align="center"><strong>Confidentiality Notice </strong></p>
              All rights reserved. Information contained herein may be considered confidential by CPSI or the client hospital users. CPSI reserves the right to limit access for individuals and/or facilities who provide this information to or for the benefit of third parties<a href="http://userareas.cpsi.com/icms/mainmenujrm.cgi?login=<?php echo $_SESSION['Username']; ?>&custnum=<?php echo $_SESSION['CustNum']; ?>">.</a>
              <p>&nbsp;</p>
            <!-- InstanceEndEditable -->              </td>
          </tr>
          <tr>
            <td width="4">&nbsp;</td>
            <td align="center" class="smaller">
              <p class="smaller"><a href="#">home</a> | <a href="https://userareas.cpsi.com/about.php">about
                  us</a> | <a href="mailto:wan@cpsi.com">contact</a></p>
              <p class="smaller">&nbsp;</p>
            </td>
          </tr>
        </table>
    </td>
    <td width="135" align="center"" valign="top" bgcolor="#F7F7F4" class="TableBrownLeft" dark> <br>      
      <br>
        <table width="99%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><div align="left"><img src="../images/BarsAndButtons/loginsidetab.gif" name="cpsiuserlogin" width="130" height="17" id="cpsiuserlogin"></div>
            </td>
          </tr>
        </table>
        <table width="96%" border="0" cellpadding="0" cellspacing="0" class="cpBottomLeft">
          <tr>
            <td><div align="center"><br>
                <a href="../killsessions.php">logout</a><br>
                <br>
            </div></td>
          </tr>
          <tr>
            <td height="17" class="smaller"><div align="center"><img src="images/barsandbuttons/userareanews.gif" width="130" height="17"><br>
              </div>
                <div align="center"></div></td>
          </tr>
          <tr>
            <td height="38" class="smaller">              <div align="center"><br>
		  <a href="https://web1.zixmail.net/s/login?b=cpsinet" target="_blank">ZixCorp Email Encryption</a><br/><br/>
		  <a href="https://userareas.cpsi.com/onccomplaint.php" target="_blank">ONC Complaint</a><br/>
                  <a href="<?php echo $row_rsNews['NewsFile']; ?>" target="_blank"><?php echo $row_rsNews['NewsDescription']; ?></a><br>
                  <br>
                  <img src="../images/newsSpacer.gif" width="130" height="8"> </div></td>
          </tr>
        </table>
 <p> <br>
  <img src="../images/newsSpacer.gif" width="130" height="8">  </p>
<p class="style1">CPSI<br>
  6600 Wall St.<br>
  Mobile, AL 36695<br>
  (800) 711-CPSI <br>
  Fax: (251) 639-8214 </p>
<p><img src="../images/newsSpacer.gif" width="130" height="8"></p>
<p>&nbsp;</p></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
    require_once("../includes/widgets/widgets_end.php");
    mysql_free_result($rsNews);
    mysql_free_result($rsUsers);
    mysql_free_result($rsCompanyLogin);
    mysql_free_result($Memberlevel3);
    mysql_free_result($rsAddress);
    mysql_free_result($confirmation);
    mysql_free_result($EmailBulletin);
?>

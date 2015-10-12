<?php 
    require_once('../../Connections/connUserareas.php');
    session_start(); 
    require_once('../restrictbylevel.php'); 
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
<html><!-- InstanceBegin template="/Templates/Mainphp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

<!-- InstanceBeginEditable name="doctitle" -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<!-- InstanceBegin template="/Templates/Mainphp.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
   <!-- InstanceBeginEditable name="doctitle" -->
   <title>CPSI: Technical Application Support</title><!-- InstanceEndEditable -->
   <!-- InstanceBeginEditable name="head" -->
   <!-- InstanceEndEditable -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
   <link href="../../style.css" rel="stylesheet" type="text/css">
   <style type="text/css">
<!--

   -->
   </style>
   <script language="JavaScript" type="text/JavaScript">
<!--

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

   <!-- user login - press enter key to submit
   function submitenter(myfield,e)
   {
   var keycode;
   if (window.event) keycode = window.event.keyCode;
   else if (e) keycode = e.which;
   else return true;

   if (keycode == 13)
   {
   myfield.form.submit();
   return false;
   }
   else
   return true;
   }
   //-->

   </script>
   <style type="text/css">
div.islink {
   color: #003399;
   cursor: pointer;
   float:left;
   }
   div.islink :hover {
   color: #9B3242;
   }
   div.isnotlink {
   color: black;
   cursor: default;
   float: left;
   }
   .style1 {
        /*font-size: 10px;*/
        font-family: Arial, Helvetica, sans-serif;
        color: #7C7C7C;
   }
   </style>
</head>

<body onload=
"MM_preloadImages('../images/BarsAndButtons/tophomeov.gif','../images/BarsAndButtons/bncpsisystemov.gif','../images/BarsAndButtons/bntestimonialsov.gif','../images/BarsAndButtons/bnnewsov.gif','../images/BarsAndButtons/bnhipaaov.gif','../images/BarsAndButtons/bninvestorsov.gif','../images/BarsAndButtons/bnemploymentov.gif','../images/BarsAndButtons/topcontactov.gif','../images/BarsAndButtons/topaboutov.gif');clearOptions();addOption_list(cw_name,cw_val,cw_desc);menuSelected('cwlist');">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#006666">
      <tr>
         <!--
    <td width="75%" height="51" bgcolor="#FFFFFF"><a href="../default.htm"><img src="../images/BarsAndButtons/CPSIbanner.gif" name="cpLogo" width="618" height="51" border="0" id="cpLogo"></a></td>
    <td width="25%" background="../images/topImage.png" bgcolor="#FFFFFF"><div align="right"></div>    </td>
  </tr>
  <tr bordercolor="#D6D6CE" background="../images/topbg.gif">
    <td height="25" colspan="3" align="right" valign="bottom" bgcolor="007A7F" class="dark"><a href="../default.htm" onMouseOver="MM_swapImage('Image8','','../images/BarsAndButtons/tophomeov.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../images/BarsAndButtons/tophome.gif" name="Image8" width="80" height="16" border="0" id="Image8"></a><a href="../contact.php" onMouseOver="MM_swapImage('Image9','','../images/BarsAndButtons/topcontactov.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../images/BarsAndButtons/topcontact.gif" name="Image9" width="80" height="16" border="0" id="Image9"></a><a href="../about.php" onMouseOver="MM_swapImage('Image10','','../images/BarsAndButtons/topaboutov.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../images/BarsAndButtons/topabout.gif" name="Image10" width="80" height="16" border="0" id="Image10"></a> </td>
-->

         <td width="75%" height="51" bgcolor="#3DB7E4"><a href=
         "http://www.cpsi.com"><img src=
         "../../images/BarsAndButtons/cpsi_logo_800x137.jpg" name="cpLogo" width="800"
         height="137" border="0" id="cpLogo"></a></td>

         <td width="25%" background="../../images/BarsAndButtons/topImage_new3.png"
         bgcolor="#FFFFFF">
            <div align="right"></div>
         </td>
      </tr>

      <tr bordercolor="#D6D6CE" background="../images/topbg.gif">
         <td height="18" colspan="3" align="right" valign="bottom" bgcolor="#3DB7E4"
         class="dark"><a href="https://userareas.cpsi.com/userareas/home.php"
         onmouseover="MM_swapImage('Image2','','../downloads/images/userareas_name_change_ov.png',1)"
         onmouseout="MM_swapImgRestore()"><img src="../downloads/images/userareas_name_change.png"
         name="Image2" width="106" height="16" border="0" id="Image2"></a><a href=
         "https://userareas.cpsi.com/userareas/downloads/default.php" onmouseover=
         "MM_swapImage('Image11','','../downloads/images/DLNew_ov.png',1)" onmouseout=
         "MM_swapImgRestore()"><img src="../downloads/images/DLNew.png" name="Image11" width="100"
         height="16" border="0" id="Image11"></a></td>
      </tr>

      <tr>
         <td height="2" colspan="3" bgcolor="#AAAAAF"><img src="../images/clearpixel.gif"
         width="1" height="1"></td>
      </tr>
   </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
     <td>
	<?php
	    include('../menu/left_main.php');	
	?>
    </td>
    <td valign="top" background="../images/leftbg.gif" width="26">&nbsp;</td>
    <td valign="top" width="100%"><br>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
               <tr>
                  <td width="4" height="603">&nbsp;</td>

                  <td valign="top" width="100%">
                     <!-- InstanceBeginEditable name="text" -->

                     <table width="98%" border="0" cellspacing="2" cellpadding="2" align=
                     "center">
                        <tr>
                           <td height="63">
                              <p>&nbsp;</p>

                              <p class="Header">CPSI Technical Application Support</p>

                              <p>Using the options below, you may download CPSI
                              installers, add-ons and utilities. Please consult CPSI
                              Technical Application Support before utilizing any of these
                              downloads to ensure they are appropriate to your
                              configuration.</p><br>
                           </td>

                           <td align="right"><img src="images/nt_top.gif" width="135"
                           height="116"></td>
                        </tr>

                        <tr valign="top">
                           <td valign="top" colspan="2">
                              <script language="javascript" type="text/javascript">

                              // ClientWare list entries
                              var cw_name = new Array(
                              "ClientWare Installer (Version 18)",
                              "ClientWare Uninstaller"
                              );

                              // ClientWare filenames for download
                              var cw_val = new Array(
                              "../downloads/installers/cnCWSetup18.exe",
                              "../downloads/installers/cnCWRemove.exe"
                              );

                              // ClientWare descriptions for list entries
                              var cw_desc = new Array(
                              "This download will install the current Version 18 build of ClientWare (18.0.1).",
                              "This download will remove one or more existing ClientWare installations."
                              );

                              // CW5 list entries
                              var runner_name = new Array (
                              "CW Runner"
                              );

                              // CW5 filenames for download
                              var runner_val = new Array (
                              "../downloads/installers/clientware/cpsetup.exe"
                              );

                              // ClientWare descriptions for list entries
                              var runner_desc = new Array (
                              'This download will install the current build of CW Runner. <br /><br />Click here to read the <a href="docs/clientware_installation_procedures.pdf" target="blank">CW Runner Installation Procedures<\/a>.'
                              );

                              // Add-ons list entries
                              var add_name = new Array(
                              "Topaz Digital Signature Installer (64-bit Microsoft Office)",
                              "Office 2013 Topaz (32-bit) Digital Signature Macro",
                              "Topaz Digital Signature Installer (32-bit Microsoft Office)",
                              "DuraTrax Installer",
                              "CPSI Biovalidation Installer",
                              "CPSI Electronic Forms Installer",
                              "CPSI Electronic Signature Installer"
                              );

                              // Add-ons filenames for download
                              var add_val = new Array(
                              "../downloads/installers/sigplus64.exe",
                              "../downloads/installers/TopazSig3.dot",
                              "../downloads/installers/sigplus32.exe",
                              "../downloads/installers/DuraTrax.exe",
                              "../downloads/installers/bioval_installer.exe",
                              "../downloads/installers/cpsiefsetup.exe",
                              "../downloads/installers/ESignX.msi"
                              );

                              // Add-ons descriptions for list entries
                              var add_desc = new Array(
                              "This download will install the (64-bit Microsoft Office) Topaz Digital Signature driver and macros for Microsoft Word.","<br />(THIS IS CURRENTLY ONLY FOR USE WITH OFFICE 2013):<br /><br /> 1. Copy the TopazSig3.dot file to this location on your target computer: <br /> <br /> For 64-bit Windows:<br />C:\\Program Files (x86)\\Microsoft Office\\Office15\\Startup <br /> <br />for 32-bit Windows:<br />C:\\Program Files\\Microsoft Office\\Office15\\Startup <br /> <br /> 4. Once done, open MS Word 2013 and use the pencil and checkmark icons from the Add-Ins tab ",
                              "This download will install the (32-bit Microsoft Office) Topaz Digital Signature driver and macros for Microsoft Word.<br><br>This is required for use of CPSI's Digital Signature product.",
                              "This download will install CPSI DuraTrax driver files.<br><br>These files are required for use of a DuraTrax barcode scanner.",
                              "This download will install CPSI's biometric validation application on a client device.",
                              "This download will install the CPSI Electronic Forms software on a client device.",
                              "This download will install the CPSI Electronic Signature software on a client device."
                              );

                              // POC list entries
                              var poc_name = new Array(
                              "Symbol Mobile Companion 3.9 Drivers",
                              "Cisco Aironet 3.0 Driver",
                              "Cisco Aironet 2.6 Driver"
                              );

                              // POC filenames for download
                              var poc_val = new Array(
                              "../downloads/installers/poc/symbol_drivers_3_9.zip",
                              "../downloads/installers/poc/Cisco3.0.exe",
                              "../downloads/installers/poc/Cisco2.6.exe"
                              );

                              // POC descriptions for list entries
                              var poc_desc = new Array(
                              "This download will install version 3.9 of the Symbol Mobile Companion wireless adapter driver.",
                              "This download will install version 3.0 of the Cisco Aironet Client Adapter driver.",
                              "This download will install version 2.6 of the Cisco Aironet Client Adapter driver."
                              );

                              // Image Link entries
                              var il_name = new Array(
                              "IL Server Version 16.49",
                              "IL Viewer Version 16.130",
                              "IL Viewer Version 16.143",
                              "Install Anywhere(32-bit)",
                              "Install Anywhere(64-bit)",
                              "Multipath IBM 2003"
                              );

                              // Image Link filenames for download
                              var il_val = new Array(
                              "../downloads/installers/IL-s16.49_v16.136.exe",
                              "../downloads/installers/IL-s16.47_v16.130.exe",
                              "../downloads/installers/IL-s16.50_v16.143.exe",
                              "../downloads/installers/Install Anywhere Win_x86.zip",
                              "../downloads/installers/Install Anywhere Win_x64.zip",
                              "../downloads/isntallers/Multipath IBM 2003.zip"
                              );

                              // Image Link description for list entries
                              var il_desc = new Array(
                              'This download will install Image Link Server Version 16.49.<br /><br />Click here to read <a href="../downloads/docs/ImageLink Usage at a Glance.pdf" target="blank">ImageLink Usage at a Glance<\/a>.<br/><br/>Click here to read the <a href="http://cphelp.cpsi.com/v19/phymod/imagelink_ug/index.html" target="blank">ImageLink Users Guide<\/a><br/><br/>Click here to read <a href="../downloads/installers/cnPACS StorReq PC Installation Procedures_1.0.pdf" target="blank">cnPACS StorReq PC Installation Procedures<\/a><br/><br/>Click here to view the <a href="../downloads/docs/Tape Loading Cartridge Diagram" target="blank" ">Tape Loading Cartridge Diagram<\/a>',
                              'This download will install Image Link Viewer Version 16.130.<br /><br />Click here to read <a href="../downloads/docs/ImageLink Usage at a Glance.pdf" target="blank">ImageLink Usage at a Glance<\/a>.<br/><br/>Click here to read the <a href="http://cphelp.cpsi.com/v19/phymod/imagelink_ug/index.html" target="blank">ImageLink Users Guide<\/a><br/><br/>Click here to read <a href="../downloads/installers/cnPACS StorReq PC Installation Procedures_1.0.pdf" target="blank">cnPACS StorReq PC Installation Procedures<\/a><br/><br/>Click here to view the <a href="../downloads/docs/Tape Loading Cartridge Diagram" target="blank">Tape Loading Cartridge Diagram<\/a>',
                              'This download will install Image LInk Viewer Version 16.143.<br /><br />Click here to read <a href="../downloads/docs/ImageLink Usage at a Glance.pdf" target="blank">ImageLink Usage at a Glance<\/a>.<br/><br/>Click here to read the <a href="http://cphelp.cpsi.com/v19/phymod/imagelink_ug/index.html" target="blank">ImageLink Users Guide<\/a><br/><br/>Click here to read <a href="../downloads/installers/cnPACS StorReq PC Installation Procedures_1.0.pdf" target="blank">cnPACS StorReq PC Installation Procedures<\/a><br/><br/>Click here to view the <a href="../downloads/docs/Tape Loading Cartridge Diagram" target="blank">Tape Loading Cartridge Diagram<\/a>',
                              'This download will install the Install Anywhere (32-bit) software package.<br /><br />Click here to read <a href="../downloads/docs/ImageLink Usage at a Glance.pdf" target="blank">ImageLink Usage at a Glance<\/a>.<br/><br/>Click here to read the <a href="http://cphelp.cpsi.com/v19/phymod/imagelink_ug/index.html" target="blank">ImageLink Users Guide<\/a><br/><br/>Click here to read <a href="../downloads/installers/cnPACS StorReq PC Installation Procedures_1.0.pdf" target="blank">cnPACS StorReq PC Installation Procedures<\/a><br/><br/>Click here to view the <a href="../downloads/docs/Tape Loading Cartridge Diagram" target="blank">Tape Loading Cartridge Diagram<\/a>',
                              'This download will install the Install Anywhere (64-bit) software package.<br /><br />Click here to read <a href="../downloads/docs/ImageLink Usage at a Glance.pdf" target="blank">ImageLink Usage at a Glance<\/a>.<br/><br/>Click here to read the <a href="http://cphelp.cpsi.com/v19/phymod/imagelink_ug/index.html" target="blank">ImageLink Users Guide<\/a><br/><br/>Click here to read <a href="../downloads/installers/cnPACS StorReq PC Installation Procedures_1.0.pdf" target="blank">cnPACS StorReq PC Installation Procedures<\/a><br/><br/>Click here to view the <a href="../downloads/docs/Tape Loading Cartridge Diagram" target="blank">Tape Loading Cartridge Diagram<\/a>',
                              'This download will install Multipath IBM 2003.<br /><br />Click here to read <a href="../downloads/docs/ImageLink Usage at a Glance.pdf" target="blank">ImageLink Usage at a Glance<\/a>.<br/><br/>Click here to read the <a href="http://cphelp.cpsi.com/v19/phymod/imagelink_ug/index.html" target="blank">ImageLink Users Guide<\/a><br/><br/>Click here to read <a href="../downloads/installers/cnPACS StorReq PC Installation Procedures_1.0.pdf" target="blank">cnPACS StorReq PC Installation Procedures<\/a><br/><br/>Click here to view the <a href="../downloads/docs/Tape Loading Cartridge Diagram" target="blank">Tape Loading Cartridge Diagram<\/a>'
                              );

                              // Materials Management entries
                              var mv_name = new Array(
                              "Materials Management PDA Setup (Symbol)",
                              "Materials Management PDA Setup (Dolphin)"
                              );

                              // Materials Management filenames for download
                              var mv_val = new Array(
                              "../downloads/installers/cnPDASetup.exe",
                              "../downloads/isntallers/DOLPHINsetup.exe"
                              );

                              // Materials Management descriptions for list entries
                              var mv_desc = new Array(
                              "This download will configure a CPSI Medication Verification PDA.<br><br>Download this installation program for CPSI-issued Symbol PDA hardware.",
                              "This download will configure a CPSI Medication Verification PDA.<br><br>Download this installation program for CPSI-issued Handheld Products Dolphin PDA hardware."
                              );

                              // Server list entries
                              var srv_name = new Array(
                              "Linux Server Rescue Disk Image (IBM x3650 M4/IBM x3850 X5)",
                              "Linux Server Rescue Disk Image (legacy model servers)",
                              "WordServer Installer",
                              "STG Text Driver"
                              );

                              // Server filenames for download
                              var srv_val = new Array(
                              "../downloads/installers/CPSI_RESCUE_3650M4_X5.iso",
                              "../downloads/installers/Rescue_CD_newest.iso",
                              "../downloads/installers/cnInstallWordServer.exe",
                              "../downloads/isntallers/cnInstallFTS.exe"
                              );

                              // Server descriptions for list entries
                              var srv_desc = new Array(
                              "This download will install the Linux Server Rescue Disk Image for (IBM x3650 M4/IBM x3850 X5)",
                              "This download will install the Linux Server Rescue Disk Image for (legacy model servers)",
                              "This download will install the CPSI WordServer Service (formerly PrintRTF) and cpPrint.<br><br>cnWordServer is used to convert Microsoft Word documents for printing and viewing via ClientWare. cpPrint is used to convert Electronic Forms, Scanned Documents and Electronic File Managment attachments for printing, viewing and faxing.",
                              "This download will install the STG Text Conversion Driver on the server hosting CPSI WordServer.<br><br>This driver is required for certain text interfaces and should not be used unless deemed necessary to your configuration."
                              );

                              // Other list entries
                              var ot_name = new Array(
                              "AcuCorp ODBC Client",
                              "RFIdeas pcProx",
                              "PSadmin (for Printservers)",
                              "Cisco VPN Client",
                              "Cisco Vista VPN Client",
                              "Cisco 64-Bit VPN Client"
                              );

                              // Other filenames for download
                              var ot_val = new Array(
                              "../downloads/installers/Acucbl722.exe",
                              "../downloads/installers/pcProxConfig.exe",
                              "../downloads/installers/PSadmin_app_201.exe",
                              "../downloads/isntallers/cpsivpn.exe",
                              "../downloads/installers/vpnclient-win-msi-5.0.02.0090-k9.exe",
                              "../downloads/isntallers/vpnclient-winx64-msi-5.0.07.0290-k9.exe"
                              );

                              // Other descriptions for list entries
                              var ot_desc = new Array(
                              "This download will install version 7.2.2 of the AcuCorp ODBC Client.<br><br>This is required for querying ODBC data sources on the CPSI HIS Server.",
                              "This download will install the RFIdeas pcProx configuration utility.<br><br>This is required for devices utilizing the pcProx RFID reader.",
                              "This download will enable the end-user to program the Dlink DP101 and DP301 Printservers with the network information such as ip, subnet mask, gateway and hostname.",
                              "This download will install the Cisco VPN Client.<br><br>This download is provided only for convenience and is generally not supported by CPSI.",
                              "This download will install the Cisco Vista VPN Client.<br><br>This download is provided only for convenience and is generally not supported by CPSI.",
                              "This download will install the Cisco 64-Bit VPN Client.<br><br>This download is provided only for convenience and is generally not supported by CPSI."
                              );

                              // This function will remove all entries from the dropdown.
                              function clearOptions()
                              {
                              for(var i=document.drop_list.dl_list.options.length-1; i>=0; i--)
                              {
                              document.drop_list.dl_list.remove(i);
                              }
                              }

                              // This function will add an option to the dropdown.
                              function addOption(text,value,desc )
                              {
                              var optn = document.createElement("OPTION");
                              optn.text = text;
                              optn.value = value;
                              optn.desc = desc;
                              document.drop_list.dl_list.options.add(optn);
                              }

                              // This function will add options to the dropdown based on the specified list.
                              function addOption_list(lname,lval,ldesc){
                              document.getElementById('Description').innerHTML = ldesc[0];
                              for (var i=0; i < lname.length; ++i)
                              {
                              addOption(lname[i], lval[i], ldesc[i]);
                              }
                              }

                              // This function will bold the header for the selected dropdown list.
                              function menuSelected(selected)
                              {
                              var menu_list = new Array("cwlist", "cwrunner", "addlist", "poclist", "illist", "mvlist", "srvlist", "otlist");
                              for (var i=0; i < menu_list.length; ++i)
                              {
                              var id = menu_list[i]
                              document.getElementById(menu_list[i]).className = "islink";
                              }
                              document.getElementById(selected).className = "isnotlink";
                              }
                              </script>

                              <div id="cwlist" onclick=
                              " clearOptions(); addOption_list(cw_name,cw_val,cw_desc); menuSelected('cwlist'); return true;">
                              <b>ClientWare</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div>

                              <div id="cwrunner" onclick=
                              " clearOptions(); addOption_list(runner_name,runner_val,runner_desc); menuSelected('cwrunner'); return true;">
                              <b>CW
                              Runner</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div>

                              <div id="addlist" onclick=
                              " clearOptions(); addOption_list(add_name,add_val,add_desc); menuSelected('addlist'); return true;">
                              <b>Add-Ons</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div>

                              <div id="poclist" onclick=
                              " clearOptions(); addOption_list(poc_name,poc_val,poc_desc); menuSelected('poclist'); return true;">
                              <b>POC</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div>

                              <div id="illist" onclick=
                              " clearOptions(); addOption_list(il_name,il_val,il_desc); menuSelected('illist'); return true;">
                              <b>ImageLink</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div>

                              <div id="mvlist" onclick=
                              " clearOptions(); addOption_list(mv_name,mv_val,mv_desc); menuSelected('mvlist'); return true;">
                              <b>Materials
                              Management</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div>

                              <div id="srvlist" onclick=
                              " clearOptions(); addOption_list(srv_name,srv_val,srv_desc); menuSelected('srvlist'); return true;">
                              <b>Server</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div>

                              <div id="otlist" onclick=
                              " clearOptions(); addOption_list(ot_name,ot_val,ot_desc); menuSelected('otlist'); return true;">
                              <b>Other</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div><br>
                              <br>

                              <form name="drop_list" action="default.php" method="post">
                                 <select name="dl_list" onchange=
                                 "javascript:document.getElementById('Description').innerHTML = this.options[this.selectedIndex].desc;"
                                 style="width:380px">
                                    <option value="">
                                       Default
                                    </option>
                                 </select> <input type="button" value=" Download "
                                 onclick=
                                 " url=document.drop_list.dl_list[document.drop_list.dl_list.selectedIndex].value; window.location.href=url; return true;">

                                 <div id="Description">
                                    It appears that your browser does not permit
                                    JavaScript to run.
                                 </div>
                              </form>
                           </td>
                        </tr>

                        <tr>
                           <td width="50%"><br>
                           <a href="../downloads/docs/gpo.pdf" target="_blank">GPO Certificate
                           Installation</a></td>

                           <td><br>
                           <a href="../downloads/docs/cainstall.pdf" target="_blank">Certificate Authority
                           Installation</a></td>
                        </tr>
                     </table><!-- InstanceEndEditable --><br>
                  </td>

                  <td width="10">&nbsp;</td>
               </tr>

               <tr>
                  <td width="4">&nbsp;</td>

                  <td class="smaller" align="center">
                     <p class="smaller"><a href="download/cpsica.cer"></a><br>
                     <br>
                     <a href="https://userareas.cpsi.com/userareas/home">home</a> | <a href="https://userareas.cpsi.com/about.php">about
                     us</a> | <a href="mailto:wan@cpsi.com">contact</a></p>

                     <p class="smaller">&nbsp;</p>
                  </td>

                  <td width="10">&nbsp;</td>
               </tr>
            </table>
         </td>

         <td width="135" align="center" valign="top" bgcolor="#F7F7F4" class=
         "TableBrownLeft" dark="">
            <br>
            <br>

            <table width="99%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                  <td>
                     <div align="left"><img src=
                     "../../images/BarsAndButtons/loginsidetab.gif" name="cpsiuserlogin"
                     width="130" height="17" id="cpsiuserlogin"></div>
                  </td>
               </tr>

               <tr>
                  <td></td>
               </tr>
            </table>

            <table width="96%" border="0" cellpadding="0" cellspacing="0" class=
            "cpBottomLeft">
               <tr>
                  <td>
                     <div align="center">
                        <br>
                        <a href="../../killsessions.php">logout</a><br>
                        <br>
                     </div>
                  </td>
               </tr>

               <tr>
                  <td height="17" class="smaller">
                     <div align="center">
                        <img src="../../images/barsandbuttons/userareanews.gif" width="130"
                        height="17"><br>
                     </div>

                     <div align="center"></div>
                  </td>
               </tr>

               <tr>
                  <td height="38" class="smaller">
                     <div align="center"><br>
                     <a href="https://web1.zixmail.net/s/login?b=cpsinet" target=
                     "_blank">ZixCorp Email Encryption</a><br>
                     <br>
                     <a href="https://userareas.cpsi.com/onccomplaint.php" target=
                     "_blank">ONC Complaint</a><br>
                     <br>
                     <img src="../../images/newsSpacer.gif" width="130" height="8"></div>
                  </td>
               </tr>
            </table>

            <p><br>
            <img src="../../images/newsSpacer.gif" width="130" height="8"></p>

            <p class="style1">CPSI<br>
            6600 Wall St.<br>
            Mobile, AL 36695<br>
            (800) 711-CPSI<br>
            Fax: (251) 639-8214</p>

            <p><img src="../../images/newsSpacer.gif" width="130" height="8"></p>

            <p>&nbsp;</p>
         </td>
      </tr>
   </table>
</body>
</html>

<?php
mysql_free_result($rsNews);
?>


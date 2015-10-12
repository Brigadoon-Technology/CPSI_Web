<?php

    require('../2014_BPC/inc/validate.php');
    require_once('../2014_BPC/Connections/connUserareas.php');
    session_start();

    if(!isset($_SESSION['DisplayName'])){
	$_SESSION['DisplayName'] = $_SESSION['Username'];
	// WR 1406171109
        //session_destroy();
	//header('Location: http://www.cpsi.com');
    }
    
    mysql_select_db($database_connUserareas, $connUserareas);
  
    $query_memberInfo = sprintf("SELECT m.DisplayName, m.Email, m.telephone, m.extension, d.department  FROM members AS m, departments AS d WHERE m.Department = d.DepartmentKey and Username = '%s'", $_SESSION['Username']);
    $memberInfo = mysql_query($query_memberInfo, $connUserareas) or die(mysql_error());
    $row_memberInfo = mysql_fetch_assoc($memberInfo);
    $totalRows_rsMember = mysql_num_rows($memberInfo);
    $_SESSION['DisplayName'] = $row_memberInfo['DisplayName'];
    $_SESSION['Email'] = $row_memberInfo['Email'];
    $_SESSION['Telephone'] = $row_memberInfo['telephone'];
    $_SESSION['Extension'] = $row_memberInfo['extension'];
    $_SESSION['Department'] = $row_memberInfo['department'];
    
    /**  variables **/
    $err_list = array();
    $err = false;
    $err_msg = '';
    //used to track if tracks selected. Have to have at least one selected
    $tracks_selected = 0;
    $tracks_error = array();
    $tracks_error_msg = '';

   
    //form submission processing
    if(isset($_POST['submit'])){
	$data = $_POST ;
	$name = isset($data['name'])? $name = htmlspecialchars($data['name'] ): '';
	$title = isset($data['title'])? $title = $data['title'] : '' ;
	$department = isset($data['department']) ?  $department = $data['department'] : '' ;
	$facility = isset($data['facility'])? $facility = $data['facility']: '';
	$phone = isset($data['phone']) ? $phone = $data['phone'] : '';
	$email = isset($data['email']) ? $email = $data['email'] : '' ;
	$full_facility = isset($data['full_facility']) ? $full_facility = $data['full_facility'] : '';	
	$city = isset($data['city']) ? $city = getCity($full_facility): '';
	$state = isset($data['state']) ? $state = getstate($full_facility['state']): '';
	$tshirt = isset($data['tshirt']) ? $tshirt = $data['tshirt'] : '';
	$vegas = isset($data['vegas']) ? $vegas = $data['vegas'] : '' ;
	$chicago = isset($data['chicago']) ? $chicago = $data['chicago'] : '' ;
	$orlando = isset($data['orlando']) ? $orlando = $data['orlando'] : '' ;

	
	/**** Tracks Varaibles  ***/
	//Wednesday
	// Track 1
	$dataBackup_W = isset($data['dataBackup_W'])? $data['dataBackup_W'] : '';
	$cpoe5_W = isset($data['cpoe5_W'])? $data['cpoe5_W'] : '';
	$helpProviders_W = isset($data['helpProviders_W'])? $data['helpProviders_W'] : '';
	$importance_W = isset($data['importance_W'])? $data['importance_W'] : '';
	$pharm_W = isset($data['pharm_W'])? $data['pharm_W'] : '';
	$problemList_W = isset($data['problemList_W'])? $data['problemList_W'] : '';
	$welcomeRecep_W = isset($data['welcomeRecep_W'])? $data['welcomeRecep_W'] : '';
	// Track 2
	$doYou_W = isset($data['doYou_W'])? $data['doYou_W'] : '';
	$prepMU_W = isset($data['prepMU_W'])? $data['prepMU_W'] : '';
	$medicare_W = isset($data['medicare_W'])? $data['medicare_W'] : '';
	$electronic_W = isset($data['electronic_W'])? $data['electronic_W'] : '';
	$icd10_W = isset($data['icd10_W'])? $data['icd10_W'] : '';
	$welcomeT2_W = isset($data['welcomeT2_W'])? $data['welcomeT2_W'] : '';

	
	// Thursday
	// Track 1
	$dataBackup_T = isset($data['dataBackup_T'])? $data['dataBackup_T'] : '';
	$cpoe5_T = isset($data['cpoe5_T'])? $data['cpoe5_T'] : '';
	$helpProviders_T = isset($data['helpProviders_T'])? $data['helpProviders_T'] : '';
	$importance_T = isset($data['importance_T'])? $data['importance_T'] : '';
	$pharm_T = isset($data['pharm_T'])? $data['pharm_T'] : '';
	$problemList_T = isset($data['problemList_T'])? $data['problemList_T'] : '';
	// Track 2
	$doYou_T = isset($data['doYou_T'])? $data['doYou_T'] : '';
	$prepMU_T = isset($data['prepMU_T'])? $data['prepMU_T'] : '';
	$medicare_T = isset($data['medicare_T'])? $data['medicare_T'] : '';
	$electronic_T = isset($data['electronic_T'])? $data['electronic_T'] : '';
	$icd10_T = isset($data['icd10_T'])? $data['icd10_T'] : '';
    
	//Monday

	$bo_mon = isset($data['bo_mon'])? $data['bo_mon'] : '';
	$him_mon = isset($data['him_mon'])? $data['him_mon'] : '';

	//Tuesday

	$p2p = isset($data['p2p']) ? $p2p = $data['p2p'] : '';
	$mus2 = isset($data['mus2']) ? $mus2 = $data['mus2'] : '' ;
	$idman = isset($data['idman']) ? $idman = $data['idman'] : '' ;
	$softval = isset($data['softval']) ? $softval = $data['softval'] : '';
	$proddev = isset($data['proddev_tues'])?$proddev = $data['proddev_tues'] : '';
	$elrn_tues = isset($data['elrn_tues'])?$elrn_tues = $data['elrn_tues'] : '';

	//Wednesday

	$clinic = isset($data['clinic'])?$clinic = $data['clinic'] : '';

	//Thursday

	$qm_1 = isset($data['qm_1'])?$qm_1 = $data['qm_1'] : '';
	$qm_2 = isset($data['qm_2'])?$qm_2 = $data['qm_2'] : '';
	$qm_3 = isset($data['qm_3'])?$qm_3 = $data['qm_3'] : '';
	$qm_4 = isset($data['qm_4'])?$qm_4 = $data['qm_4'] : '';

	$cd_1 = isset($data['cd_1'])?$cd_1 = $data['cd_1'] : '';
	$cd_2 = isset($data['cd_2'])?$cd_2 = $data['cd_2'] : '';
	$cd_3 = isset($data['cd_3'])?$cd_3 = $data['cd_3'] : '';
	$cd_4 = isset($data['cd_4'])?$cd_4 = $data['cd_4'] : '';

	$is_1 = isset($data['is_1'])?$is_1 = $data['is_1'] : '';
	$is_2 = isset($data['is_2'])?$is_2 = $data['is_2'] : '';
	$is_3 = isset($data['is_3'])?$is_3 = $data['is_3'] : '';
        $is_4 = isset($data['is_4'])?$is_4 = $data['is_4'] : '';

	$pharm = isset($data['pharm'])?$pharm = $data['pharm'] : '';
	$ancil = isset($data['ancil'])?$ancil = $data['ancil'] : '';
	$phys = isset($data['phys'])?$phys = $data['phys'] : '';

	//Friday
	$phys_con = isset($data['phys_con']) ? $data['phys_con'] : '';
	$phys_ins = isset($data['phys_ins']) ? $data['phys_ins'] : '' ;

  
	/*** Form validation **/
	
	if(!isValidName($name) || $name == '' || strlen($name) < 3){
	    if($name == ''){
		$err_msg .= 'First and Last name Required.</br>';
		array_push($err_list,'name');
	    }else{
		$err_msg .= 'Name cannot be all number, blank or be fewer than 3 characters.</br>';
		array_push($err_list,'name');
	    }
	}

	if(!check_fullname($name)){
	    $err_msg .= 'First and Last name Required.</br>';
		array_push($err_list,'name');
	}
	
	if(!isNotEmpty($title) || strlen($title) < 3 ){
	    $err_msg.= 'Title cannot be all numbers, blank or be fewer than 3 characters.<br/>';
	    array_push($err_list,'title');
	}
	
	if(!isNotEmpty($department) || strlen($department) < 3){
	    $err_msg .='Department cannot be all numbers, blank or be  than 3 characters.<br/>';
	    array_push($err_list, 'department');
	}
	
	if(!isNotEmpty($facility) || strlen($facility) <3 ){
	    $err_msg .= 'A facility cannot be the default.<br/>';
	    array_push($err_list,'facility');
	    echo 'Facility->' . $facility;
	}
	
	if(!isValidPhone($phone) || $phone == ''){
	    if($phone == ''){
		$err_msg .= 'Phone number cannot be blank.<br/>';
		array_push($err_list,'phone');
	    }else{
		$err_msg .= 'A valid Phone number is required.<br/>';
		array_push($err_list,'phone');
	    }
	}
	
	if(!isValidEmail($email) || $email == ''){
	    if($email == ''){
		$err_msg .= 'Email cannot be blank.<br/>';
		array_push($err_list,'email');
	    }else{
		$err_msg .= 'A valid email is required.<br/>';
		array_push($err_list, 'email');
	    }
	}
	
	//Check error list and display error message and apply styling if found
	//otherwise forward to  step.
	if(count($err_list) > 0){
	    $err = true;
	}else{
	    $err = false;
	}
	
	$city = getCity($full_facility);
	$state = getState($full_facility);

	/****
	 *TRACKS VALIDATION
	 *
	 */

	// WR 1406171109
	// Validate no concurrent sessions chosen Wednesday
	if(($dataBackup_W && $doYou_W) || ($cpoe5_W && $prepMU_W) || ($helpProviders_W && $medicare_W) || ($importance_W && $electronic_W) || ($pharm_W && $icd10_W)){
	    $dataBackup_W? array_push($tracks_error, 'dataBackup_W') : '';
	    $cpoe5_W? array_push($tracks_error, 'cpoe5_W') : '';
	    $helpProviders_W? array_push($tracks_error, 'helpProvidesr_W') : '';
	    $importance_W? array_push($tracks_error, 'importance_W') : '';
	    $pharm_W? array_push($tracks_error, 'pharm_W') : ''; 
	    $tracks_error_msg .= "You may not submit a registration with concurrent sessions chosen. Please select the sessions you plan to attend.<br/>";
	}
	
	// Validate no concurrent sessions chosen Thursday
	if(($dataBackup_T && $doYou_T) || ($cpoe5_T && $prepMU_T) || ($helpProviders_T && $medicare_T) || ($importance_T && $electronic_T) || ($pharm_T && $icd10_T)){
	    $dataBackup_T? array_push($tracks_error, 'dataBackup_T') : '';
	    $cpoe5_T? array_push($tracks_error, 'cpoe5_T') : '';
	    $helpProviders_T? array_push($tracks_error, 'helpProviders_T') : '';
	    $importance_T? array_push($tracks_error, 'importance_T') : '';
	    $pharm_T? array_push($tracks_error, 'pharm_T') : ''; 
	    $tracks_error_msg .= "You may not submit a registration with concurrent sessions chosen. Please select the sessions you plan to attend.<br/>";
	}
	
	
	//Monday
	if($bo_mon && $him_mon){
	    $bo_mon ? array_push($tracks_error, 'bon_mon') : '';
	    $him_mon ? array_push($tracks_error, 'him_mon') : '' ;
	    $tracks_error_msg .= 'Select either Business Office or HIM on Monday.<br/>';
	}

	//Tuesday
	if(($p2p || $idman) && $mus2){
	    $p2p ? array_push($tracks_error, 'p2p') : '';
	    $idman ? array_push($tracks_error, 'idman') : '';
	    $mus2 ? array_push($tracks_error, 'mus2') : '';
	    $tracks_error_msg .= "Meainful Use - Stage 2 cannot be selected with Propensity to Pay or Identity Management on Tuesday.<br/>";
	}


	//Thursday - Cannot slect multiple events at the same time
	if($qm_1 && ($cd_1 || $is_1) || $cd_1 && ($qm_1 || $is_1) || $is_1 && ($cd_1 || $qm_1)) {
	    array_push($tracks_error,'qm_1');
	    $cd_1? array_push($tracks_error, 'cd_1') : '';
	    $is_1? array_push($tracks_error, 'is_1') : '';
	    $tracks_error_msg.= 'Select only one track for the 7AM time slot on Thursday.<br/>';
	}

	if($qm_2 && ($cd_2 || $is_2) || $cd_2 && ($qm_2 || $is_2) || $is_2 && ($cd_2 || $qm_2)) {
	    array_push($tracks_error,'qm_1');
	    $cd_1? array_push($tracks_error, 'cd_1') : '';
	    $is_1? array_push($tracks_error, 'is_1') : '';
	    $tracks_error_msg.= 'Select only one track for the 8:15AM time slot on Thursday.<br/>';
	}

	if($qm_3 && ($cd_3 || $is_3) || $cd_3 && ($qm_3 || $is_3) || $is_3 && ($cd_3 || $qm_3)) {
	    array_push($tracks_error,'qm_1');
	    $cd_1? array_push($tracks_error, 'cd_1') : '';
	    $is_1? array_push($tracks_error, 'is_1') : '';
	    $tracks_error_msg.= 'Select only one track for the 9:45AM time slot on Thursday.<br/>';
	}

	if($qm_4 && ($cd_4 || $is_4) || $cd_4 && ($qm_4 || $is_4) || $is_4 && ($cd_4 || $qm_4)) {
	    array_push($tracks_error,'qm_1');
	    $cd_1? array_push($tracks_error, 'cd_1') : '';
	    $is_1? array_push($tracks_error, 'is_1') : '';
	    $tracks_error_msg.= 'Select only one track for the 12:30PM time slot on Thursday.<br/>';
	}

	if( $bo_mon || $him_mon || $p2p || $idman||  $proddev || $mus2 || $elrn_tues || $clinic ||  $qm_1 || $qm_2 || $qm_3 || $qm_4 || $cd_1 || $cd_2
	   || $cd_3 || $cd_4 || $is_1 || $is_2 || $is_3 || $is_4 || $pharm || $ancil || $phys || $phys_con || $phys_ins ){
	    $tracks_selected ++;
	}else{
	    array_push($tracks_error, 'all');
	    $tracks_error_msg .= 'You must select at least one track to attend.<br/>';
	}

	//Generate tracks selected by days for email

	$tracks_chosen = '';
	$tracks_chosen_email = '';


	//Monday
	if($bo_mon || $him_mon){
	  
	    $tracks_chosen .= '<div style="float:left; width: 15%;"><strong>Monday</strong><br/>';
		$bo_mon ? $tracks_chosen .= 'Business Office <br/>' : '';
		$him_mon ? $tracks_chosen .= 'HIM' : '';
	    $tracks_chosen .= '</div>';

	    $tracks_chosen_email .='<td><strong>Monday</strong><br/>';
		$bo_mon ? $tracks_chosen_email .= 'Business Office <br/>' : '';
		$him_mon ? $tracks_chosen_email .= 'HIM' : '';
	    $tracks_chosen_email .='</td>';

	}

	//Tuesday
	if( $p2p || $mus2 || $idman || $softval ||  $proddev || $elrn_tues){


	    $tracks_chosen .= '<div style="float:left; width:20%;" ><strong>Tuesday</strong><br/>';
		$p2p ? $tracks_chosen .= 'Propensity to Pay <br/>' : '';
		$mus2 ? $tracks_chosen .= 'Meaningful Use - Stage 2<br/>' : '';
		$idman ? $tracks_chosen .= 'Identity Management<br/>' : '';
		$softval ? $tracks_chosen .= 'Software Validation<br/>' : '';
		$proddev ? $tracks_chosen .= 'Product Development<br/>' : '';
		$elrn_tues ? $tracks_chosen .= 'E-Learning<br/>' : '';
	    $tracks_chosen .= '</div>';

	    $tracks_chosen_email .= '<td><strong>Tuesday</strong><br/>';
		$p2p ? $tracks_chosen_email .= 'Propensity to Pay <br/>' : '';
		$mus2 ? $tracks_chosen_email .= 'Meaningful Use - Stage 2<br/>' : '';
		$idman ?  $tracks_chosen_email .= 'Identity Management<br/>' : '';
		$softval ? $tracks_chosen_email .= 'Software Validation<br/>' : '';
		$proddev ? $tracks_chosen_email .= 'Product Development<br/>' : '';
		$elrn_tues ? $tracks_chosen_email .= 'E-Learning<br/>' : '';
	    $tracks_chosen_email .= '</td>';



	}

	//Wednesday
	if($clinic){

	    $tracks_chosen .= '<div style="float:left; width: 15%;"><strong>Wednesday</strong><br/>';
		$clinic ? $tracks_chosen .= 'Clinical<br/>' : '';
	    $tracks_chosen .= '</div>';

	    $tracks_chosen_email .= '<td ><strong>Wednesday</strong><br/>';
		$clinic ? $tracks_chosen_email .= 'Clinical<br/>' : '';
	    $tracks_chosen_email .= '</td>';

	}

	//Thurday
	if($qm_1 || $qm_2 || $qm_3 || $qm_4 || $cd_1 || $cd_2 || $cd_3 || $cd_4 || $is_1 || $is_2 || $is_3 || $is_4 || $ancil || $phys || $pharm){

	    $tracks_chosen .= '<div style="float:left; width: 20%;"><strong>Thursday</strong><br/>';

	    if($qm_1 || $qm_2 || $qm_3 || $qm_4){
		$tracks_chosen .= 'Quality Measures<br/>';
	    }

	    $tracks_chosen .= '<div style="padding-left: 15px;">';
		$qm_1 ? $tracks_chosen .= '    7AM<br/>' : '';
		$qm_2 ? $tracks_chosen .= '    8:15AM<br/>' : '';
		$qm_3 ? $tracks_chosen .= '    9:45AM<br/>' : '';
		$qm_4 ? $tracks_chosen .= '    12:30PM<br/>' : '';

	    $tracks_chosen .= '</div>';

	    if($cd_1 || $cd_2 || $cd_3 || $cd_4){
		    $tracks_chosen .= 'Clin-Doc Workshop<br/>';
		}

	    $tracks_chosen .= '<div style="padding-left: 15px;">';
		$cd_1 ? $tracks_chosen .= '   7AM<br/>' : '';
		$cd_2 ? $tracks_chosen .= '   8:15AM<br/>' : '';
		$cd_3 ? $tracks_chosen .= '   9:45AM<br/>' : '';
		$cd_4 ? $tracks_chosen .= '   12:30PM<br/>' : '';

	    $tracks_chosen .= '</div>';

	    if($is_1 || $is_2 || $is_3 || $is_4){
		    $tracks_chosen .= 'Inspiration Stations<br/>';
		}

	    $tracks_chosen .= '<div style="padding-left: 15px;">';
		$is_1 ? $tracks_chosen .= '   7AM<br/>' : '';
		$is_2 ? $tracks_chosen .= '   8:15AM<br/>' : '';
		$is_3 ? $tracks_chosen .= '   9:45AM<br/>' : '';
		$is_4 ? $tracks_chosen .= '   12:30PM<br/>' : '';

	    $tracks_chosen .= '</div>';

	    $tracks_chosen .= '<div >';
		$pharm ? $tracks_chosen .= 'Pharmacy Forum <br/>' : '';
		$ancil ? $tracks_chosen .= 'Ancillary Forum <br/>' : '';
		$phys ? $tracks_chosen .= 'Physican Hands-on Workshop<br/>' : '';

	    $tracks_chosen .= '</div>';
	    $tracks_chosen .= '</div>';

	    $tracks_chosen_email .= '<td><strong>Thursday</strong><br/>';

	    if($qm_1 || $qm_2 || $qm_3 || $qm_4){
		$tracks_chosen_email .= 'Quality Measures<br/>';
	    }

	    $tracks_chosen_email .= '';
		$qm_1 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;7AM<br/>' : '';
		$qm_2 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;8:15AM<br/>' : '';
		$qm_3 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;9:45AM<br/>' : '';
		$qm_4 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;12:30PM<br/>' : '';

	    $tracks_chosen_email .= '';

	    if($cd_1 || $cd_2 || $cd_3 || $cd_4){
		$tracks_chosen_email .= 'Clin-Doc Workshop<br/>';
	    }

	    $tracks_chosen_email .= '';
		$cd_1 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;7AM<br/>' : '';
		$cd_2 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;8:15AM<br/>' : '';
		$cd_3 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;9:45AM<br/>' : '';
		$cd_4 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;12:30PM<br/>' : '';

	    $tracks_chosen_email .= '';

	    if($is_1 || $is_2 || $is_3 || $is_4){
		$tracks_chosen_email .= 'Inspiration Stations<br/>';
	    }

	    $tracks_chosen_email .= '';
		$is_1 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;7AM<br/>' : '';
		$is_2 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;8:15AM<br/>' : '';
		$is_3 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;9:45AM<br/>' : '';
		$is_4 ? $tracks_chosen_email .= '&nbsp;&nbsp;&nbsp;&nbsp;12:30PM<br/>' : '';

	    $tracks_chosen_email .= '';

		$pharm ? $tracks_chosen_email .= 'Pharmacy Forum <br/>' : '';
		$ancil ? $tracks_chosen_email .= 'Ancillary Forum <br/>' : '';
		$phys ? $tracks_chosen_email .= 'Physican Hands-on Workshop <br/>' : '';

	  

	    $tracks_chosen_email .= '</td>';



	}
	
	

	//Friday
	if($phys_con || $phys_ins){

	    $tracks_chosen .= '<div style="float:left; width: 20%;"><strong>Friday</strong><br/>';
		$phys_con ? $tracks_chosen .= 'Physician Conference<br/>' : '';
		$phys_ins ? $tracks_chosen .= 'Physician Inspiration Stations' : '' ;
	    $tracks_chosen .= '</div>';


	    $tracks_chosen_email .= '<td ><strong>Friday</strong><br/>';
		$phys_con ? $tracks_chosen_email .= 'Physician Conference<br/>' : '';
		$phys_ins ? $tracks_chosen_email .= 'Physician Inspiration Stations' : '' ;

	    $tracks_chosen_email .= '</td>';

	}

	if(isset($data['attend_report'])&& $data['attend_report'] == 'on'){
		$report_msg = 'You have chosen to have your contact information included in a report that will
	be available to conference attendees.';
	    }else{
		$report_msg = 'You have chosen not to have your contact information included in a report that
	will be available to conference attendees.';
	    }


	//Email message

//image urls... easier to add to variable here than within the HereDoc
  $img = '<img class ="foot_img" src="http://userareas.cpsi.com/userareas/conferences/2014/n_c/img/email signature 2014 user group.png" alt="Conference Signature" />';
  $cp_logo = '<img class ="foot_img" src="http://userareas.cpsi.com/userareas/conferences/2014/n_c/img/cpsi_header3.png" alt="Cpsi Logo" />';

//Heredoc dose not support include statements.. added CSS with the heredoc declaration
    $confirm_email= <<<EOT
	<html>
	    <head>
	    <style>
	       BODY{
		    margin: 40px;
		    background-color: #90D7F2;
		    font-family: HelveticaNeue, sans-serif;
		    max-width: 800px;
		    max-width: 800px;
		}
		
		table{
		    border-collapse: collapse;
		    width: 800px;
		    table-layout: fixed;
		    background-color: #FFFFFF;
		}
		
		.header{
		
		    width: 800px;
		    height: 20px;
		    background-color: #737373;
		    float: left;
		}
		
		.title_div{
		    clear: both;
		    height: 110px;
		    background-color: #3DB8E4;
		    color: #FFFFFF;
		    font-size: 3em;
		    vertical-align:middle;
		}
		
		.con_fee{
		    color: #A65353;
		   /* background-color: #FFCC94;*/
		    padding-left: 10px;
		    width: 500px;
		    font-weight: 700;
		}
		
		.track{
		    color: #A65353;
		   /* background-color: #FFCC94;*/
		    padding-left:10px;
		    font-weight: 700;
		}
		
		.name{
		    color: #A65353;
		   /* background-color: #FFCC94;*/
		    padding-left:10px;
		    font-weight: 700;
		}
		
		.pad_left{
		    padding-left:20px; 
		}
		

		#footer img{
		    width: 800px;
		}
		
		
		</style>    
	    </head>
	    <body>
		<table>
		    <tr>
			<td class="header" colspan="5"></td>
		    </tr>
		    <tr>
			<td class="title_div" colspan="5">
			     $cp_logo
			</td>
		    </tr>
		     <tr>
			<td class="name"  colspan="5">
			    $name has just registered for the 2014 National Conference.
			</td>
		    </tr>
		    <tr >
		    <td class="pad_left" colspan="5">
			Title:      $title <br/>
			Department: $department <br/>
			Facility:   $facility <br/>
			City:       $city <br/>
			State:      $state <br/>
			Telephone:  $phone <br/>
			Email:      $email  <br/><br/>
		    </td>
		    </tr>
		    <tr>
			<td colspan="5" class="pad_left">

				$report_msg
			</td>
		    </tr>
		    <tr>
			<td class="track" colspan="5">
			<br/>
			  You have selected to attend the following tracks/sessions:
			</td>
		    </tr>
		    <tr style="display:inline-block; vertical-align:top;" class="pad_left">
			    $tracks_chosen_email
		    </tr>
		    <tr>
			<td class="con_fee" colspan="5">
			  <br/>Conference Fees
			</td>
		    </tr>
		     <tr>
			<td class="pad_left" colspan="5">
			    The registration fee is $250 per facility for an unlimited number of attendees.
			    (per facility in bold).  The Early Bird registratoin fee is $125 per facility
			    for an unlimited number of attendees for all facilities who have registered and
			    paid by August 27.
			</td>
		     </tr>
		     <tr>
			<td  class="pad_left" colspan="5"><br/>
			  If paying registration fees by check, please make payable to <strong>CPSI</strong>, and remit to:<br/><br/>
			    Bailey Slaton<br/>
			    2014 CPSI Best Practices Conference<br/>
			   6600 Wall St.<br/>
			   Mobile, AL 36695<br/>  
			</td>
		     </tr>
		     <tr>
			<td  class="pad_left" colspan="5">
			<br/>
			      Please do not include registration fees with any other payment to CPSI.
			</td>
		     </tr>
		     <tr>
			<td class="pad_left" colspan="5">
				  All registration fees are <strong>non-refundable</strong>.<br/><br/>
			</td>
		     </tr>
		    </tr>
		    <tr>
		      <td id ="footer" colspan="5">  $img </td>
		    </tr>
		</table>
	    </body>
	</html>
EOT;

 
	//if no errors send out confirmation email and forward to confirmation page
	if(!$err && !$tracks_error && $tracks_selected >= 1) {
	    //used to pass posted data to next page 
	    $_SESSION['posted'] = $_POST;
	    $_SESSION['tracks_chosen'] = $tracks_chosen;

	    $to =  "cameron.anglin@cpsi.com";//"amanda.borchardt@cpsi.com ,bailey.slaton@cpsi.com, jenny.humphreys@cpsi.com";
	    $to2 = $email;
	    $subject = "2014 CPSI Best Practices Conference Confirmation";
	    $message = $confirm_email;



	    
	$mail1 = `perl EmailUser.pl -t '$to' -s '$subject' -b '$message' `;
	$mail2 = `perl EmailUser.pl -t '$to2' -s '$subject' -b '$message'`;
	//
	//echo $message;
	  header("Location: ../2014_BPC/reg_confirm.php");
	}
   }
    
?>

<!DOCTYPE html>
<html lang="en">
    
       <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="style/style.css"/>
        <!--[if lt IE 9]>
            <script src="dist/html5shiv.js"></script>
        <![endif]-->
        <title>2014 Best Practices Conference Registration</title>
    </head>
    <body class="registration_body" >
        
    <div class="title">
	<!-- WR 1406171109 -->
       <div class="reg_logo">
          <a href="../2014_bestpractices.php">  <img src="./img/Best_Practices_4b.jpg" alt="best practices conference" align="left"></a>
	  <img src="./img/Las-Vegas-BPC.png" alt="best practices conference" align="centered"></a>
	  <img src="./img/Chicago-BPC.png" alt="best practices conference" align="centered"></a>
	  <img src="./img/Orlando-BPC.png" alt="best practices conference" align="centered"></a>
       </div>
	<!--<div class="title_text">
	    Registration
	</div>
	-->
    </div>

    <div class="content">
	<form action="../2014_BPC/reg_confirm.php" method="post" onsubmit="return validate_regist_form();">
	 
	 <div class="attend_div" >
	    <div class="div_title">Attendee Information</div>
	    <br/>	     
	    <?php
	      if( $err){
	    ?>
	    <div id="error_msg" class="error">
	    <?php echo $err_msg;?>
	    </div>
		
	    <?php } ?>
	    <div>
		<div class="padd_bottom_div"> 
		    <label for="name">Attendee Name:</label>
		    <span style="margin-left: 20px;">
			 <span class="error">*</span>
			 <input type="text" id="name" name="name"
			   <?php if(isset($err_list) && in_array('name',$err_list)){ echo 'class="js_error"';} ?>  value= "<?php  if(isset($data['name'])){
																	echo htmlspecialchars($data['name']);
																    }else{
																	if(isset($_SESSION['DisplayName'])){
																	    echo htmlspecialchars($_SESSION['DisplayName']);
																	}
																    }
				?>"/>
		    </span>
	       </div>
		   
		<div class="padd_bottom_div">
		     <label for="title">Job Title:</label>
		     <span style="margin-left: 67px;">
			  <span class="error">*</span>
			  <input type="text" id="title" name="title"
			 <?php if(isset($err_list) && in_array('title',$err_list)){ echo 'class="js_error"';} ?>
			 value= "<?php if(isset($data['title'])){ echo $data['title'];}?>"/>
		     </span><br/>
		</div>
		
		<div class="padd_bottom_div">
		     <label for="department">Department:</label>
		     <span style="margin-left: 45px;">
			  <span class="error">*</span>
			  <input type="text" id="department" name="department"
			  <?php if(isset($err_list) && in_array('department',$err_list)){ echo 'class="js_error"';} ?>
			  value= "<?php if(isset($data['department'])){
					     echo htmlspecialchars($data['department']);
					 } else{
					     if(isset($_SESSION['Department'])){
						 echo htmlspecialchars($_SESSION['Department']);
					     }
					 }
				 ?>"
			 />
		     </span><br/>
		</div>
		   
		<div class="padd_bottom_div">
		    <label for="facility">Facility:</label>
		    <span style="margin-left: 75px;">
			 <span class="error">*</span>
			 <select  id="facility" name="facility" 
				  <?php if(isset($err_list) && in_array('facility',$err_list)){ echo 'class="js_error"';} ?>>
			    <?php
			    if(isset($data['facility'])){
				echo '<option value="'.$data['full_facility'].'" >'.$data['full_facility'].'</option>';
			    }else{
				echo '<option value = ""></option>';
			    }
			    ?>	
			    
			    <?php
				include_once('./inc/hospital_list.php');
			    ?>
			</select>
		    </span>
		    <input type="hidden" id="full_facility" name="full_facility"
			   value="<?php
				    if(isset($data['full_facility'])){
					echo htmlspecialchars($data['full_facility']);
				    }
			   ?>"/>
		</div>
	       
		<div class="padd_bottom_div">
		     <label>Telephone:</label>
		     <span style="margin-left: 53px;">
			  <span class="error">*</span>
			  <input type="text"  size="12" id="phone" name="phone"
			  <?php if(isset($err_list) && in_array('phone',$err_list)){ echo 'class="js_error"';} ?>
			   value= "<?php if(isset($data['phone'])){
					     $phone = addDashes($data['phone']);
					     echo $phone;
					 }else{
					     if(isset($_SESSION['Telephone'])){
						 echo htmlspecialchars($_SESSION['Telephone']);
					     }
					 }
			   ?>"
			  /> Example XXX-XXX-XXXX (No extensions, please.)
		     </span><br/>
		 </div>
		
		   <div class="padd_bottom_div">
		    <label>Email:</label>
		    <span style="margin-left: 85px;">
			 <span class="error">*</span>
			 <input type="text" name="email" id="email"  size ="30"
			 <?php if(isset($err_list) && in_array('email',$err_list)){ echo 'class="js_error"';} ?>
			       value= "<?php if(isset($data['email'])){
						echo htmlspecialchars($data['email']);
					      }else{
						if(isset($_SESSION['Email'])){
						    echo htmlspecialchars($_SESSION['Email']);
						}
					      }
					?>"  
				/>
		    </span><br/>
		   </div>
		   <!-- WR 1406171109 --> 
		   <div class="padd_bottom_div">
		    <label for="tshirt">T-Shirt Size:</label>
		    <span style="margin-left: 75px;">
			 <span class="error">*</span>
			 <select id="tshirt" name="tshirt" 
			    <?php
				if(isset($err_list) && in_array('tshirt',$err_list)){ echo 'class="js_error"';}
			    ?>
			    
			    <?php
			    if(isset($data['tshirt'])){
				echo '<option value="'.$data['full_facility'].'" >'.$data['full_facility'].'</option>';
			    }else{
				echo '<option value = ""></option>';
			    }
			    ?>	

			    <?php
				include_once('./inc/tshirt.php');
			    ?>
			</select>
		    </span>
		    <input type="hidden" id="full_facility" name="full_facility"
			   value="<?php
				    if(isset($data['full_facility'])){
					echo htmlspecialchars($data['full_facility']);
				    }
			   ?>"/>
		</div>
		    <div class="attend_check">
		     <input type= "checkbox" id= "attend_report" name= "attend_report" <?php if(isset($data['attend_report'])){echo ' checked';}?>>Please check this box to have your contact information included on an
				attendee report, which will be available to conference attendees.
		    </div> 

		<div style="text-align: left"><span class="error">*</span> Required Items</div>
		<hr />
	    </div> <!-- End attend_div -->
	  
	    <div>
	        <div class="div_title">Conference Education</div>
		<br/> <!-- WR 1406171109 -->
		<div class="flt_lft" style="width: 33%">
		    <strong>Las Vegas, September 17-18</strong><br/>
		    <input type="checkbox" name="vegas" id="vegas" value="vegas" <?php if(isset($data['vegas'])){ echo 'checked'; } ?>/> Las Vegas <br/>
		</div>
		<div class="flt_lft" style="width: 33%">
		    <strong>Chicago, September 24-25</strong><br/>
		    <input type="checkbox" name="chicago" id="chicago" value="chicago" <?php if(isset($data['chicago'])){ echo 'checked'; } ?>/> Chicago <br/>
		</div>
		<div class="flt_lft" style="width: 33%">
		    <strong>Orlando, 8-9</strong><br/>
		    <input type="checkbox" name="orlando" id="orlando" value="orlando" <?php if(isset($data['orlando'])){ echo 'checked'; } ?>/> Orlando <br/>
		</div><br/><br/>
		
		<br/>
		<p style="text-align: left"><strong>Wednesday</strong></p>
		<div class="flt_lft" style="width: 50%">
		    <strong>Track 1</strong><br/>
		    <input type="checkbox" name="dataBackup_W" id="dataBackup_W" <?php if(isset($data['dataBackup_W'])){ echo 'checked'; } ?>/> Data Backup and Recovery<br/>
		    <input type="checkbox" name="cpoe5_W" id="cpoe5W" <?php if(isset($data['cpoe5_W'])){ echo 'checked'; } ?>/> CPOE5 Rollout<br/>
		    <input type="checkbox" name="helpProviders_W" id="helpProviders_W" <?php if(isset($data['helpProviders_W'])){ echo 'checked'; } ?>/> Helping Providers Understand and Use CPOE and Physician Documentaion <br/>
		    <input type="checkbox" name="importance_W" id="importance_W" <?php if(isset($data['importance_W'])){ echo 'checked'; } ?>/> The Importance of Becoming a "Learning Organization"<br/>
		    <input type="checkbox" name="pharm_W" id="pharm_W" <?php if(isset($data['pharm_W'])){ echo 'checked'; } ?>/> 304B Pharmacy Pricing Program Compliance<br/>
		    <input type="checkbox" name="problemList_W" id="problemList_W" <?php if(isset($data['problemList_W'])){ echo 'checked'; } ?>/> Problem List - On the Road to MU<br/>
		    <input type="checkbox" name="welcomeRecep_W" id="welcomeRecep_W" <?php if(isset($data['welcomeT1_W'])){ echo 'checked'; } ?>/> Welcome Reception (Welcome Reception is for conference attendees only.)<br/>
		</div>
		<div class="flt_lft" style="width: 50%">
		    <strong>track 2</strong><br/>
		    <input type="checkbox" name="doYou_W" id="doYou_W" <?php if(isset($data['doYou_W'])){ echo 'checked'; } ?>/> Do You Have What It Takes?<br/>
		    <input type="checkbox" name="prepMU_W" id="prepMU_W" <?php if(isset($data['prepAudit_W'])){ echo 'checked'; } ?>/> Preparing for and Surviving and MU Audit<br/>
		    <input type="checkbox" name="medicare_W" id="medicare_W" <?php if(isset($data['medicare_W'])){ echo 'checked'; } ?>/> Medicare Cost and reimbursement Analysis<br/>
		    <input type="checkbox" name="electronic_W" id="electronic_W" <?php if(isset($data['electronic_W'])){ echo 'checked'; } ?>/> Electronic Documentation and Managing Product Inventory<br/>
		    <input type="checkbox" name="icd10_W" id="icd10_W" <?php if(isset($data['icd10_W'])){ echo 'checked'; } ?>/> ICD-10 and CIO: Where to Lead, Collaborate and Support<br/>
		    <input type="checkbox" name="welcomeT2_W" id="welcomeT2_W" <?php if(isset($data['welcomeT2_W'])){ echo 'checked'; } ?>/> Welcome Reception (Welcome Reception is for conference attendees only.)<br/>
		</div>
	

		<div class="clear_flt" ></div>
		
		<p style="text-align: left"><strong>Thursday</strong></p>
		<div class="flt_lft" style="width: 50%">
		    <strong>Track 1</strong><br/>
		    <input type="checkbox" name="dataBackup_T" id="dataBackup_T" <?php if(isset($data['dataBackup_T'])){ echo 'checked'; } ?>/> Data Backup and Recovery<br/>
		    <input type="checkbox" name="cpoe5_T" id="cpoe5_T" <?php if(isset($data['cpoe5_T'])){ echo 'checked'; } ?>/> CPOE5 Rollout<br/>
		    <input type="checkbox" name="helpProviders_T" id="helpProviders_T" <?php if(isset($data['helpProviders_T'])){ echo 'checked'; } ?>/> Helping Providers Understand and Use CPOE and Physician Documentaion <br/>
		    <input type="checkbox" name="importance_T" id="importance_T" <?php if(isset($data['importance_T'])){ echo 'checked'; } ?>/> The Importance of Becoming a "Learning Organization"<br/>
		    <input type="checkbox" name="pharm_T" id="pharm_T" <?php if(isset($data['pharm_T'])){ echo 'checked'; } ?>/> 304B Pharmacy Pricing Program Compliance<br/>
		    <input type="checkbox" name="problemList_T" id="problemList_T" <?php if(isset($data['problemList_T'])){ echo 'checked'; } ?>/> Problem List - On the Road to MU<br/>    
		</div>

		<div class="flt_lft" style="width: 50%">
		    <strong>track 2</strong><br/>
		    <input type="checkbox" name="doYou_T" id="doYou_T" <?php if(isset($data['doYou_T'])){ echo 'checked'; } ?>/> Do You Have What It Takes?<br/>
		    <input type="checkbox" name="prepMU_T" id="prepMU_T" <?php if(isset($data['prepAudit_T'])){ echo 'checked'; } ?>/> Preparing for and Surviving and MU Audit<br/>
		    <input type="checkbox" name="medicare_T" id="medicare_T" <?php if(isset($data['medicare_T'])){ echo 'checked'; } ?>/> Medicare Cost and reimbursement Analysis<br/>
		    <input type="checkbox" name="electronic_T" id="electronic_T" <?php if(isset($data['electronic_T'])){ echo 'checked'; } ?>/> Electronic Documentation and Managing Product Inventory<br/>
		    <input type="checkbox" name="icd10_T" id="icd10_T" <?php if(isset($data['icd10_T'])){ echo 'checked'; } ?>/> ICD-10 and CIO: Where to Lead, Collaborate and Support<br/> 
		</div>
	    <div class="clear_flt" ></div>
	   <hr />
	    <div>
		<div class="div_title">Conference Fees</div>
		    
		    <p> The registration fee is $250 <strong>per facility</strong> for an unlimited number of attendees.
			The Early Bird registratoin fee is $125 per facility
			for an unlimited number of attendees for all facilities who have registered and
			paid by August 27.
		    
		    </p>
		    <p>
		    If paying registration fees by check, please make payable to <strong>CPSI</strong>, and remit to: <p>
		    <p>
		    Bailey Slaton<br/>
		    2014 CPSI Best Practices Conference<br/>
		    6600 Wall St.<br/>
		    Mobile, AL 36695
		    </p>
		    <p>Please do not include registration fees with any other payment to CPSI.
		    All registration fees are <strong>non-refundable</strong>, and must be
		    <strong>paid in advance</strong> of the conference. </p>
		    </div>
	    <hr />
	    <div>
		<div class="div_title">Join the Conference Converations</div>
		    
		    <p>This year, we will have Facebook groups for each individual Best Practices
		       Conference. These groups are meant to encourage conversation between attendees
                       and provide updates throughout the conference. Feel free to join the group for
		       just the conference you are attending, or all three.
		    </p>
		    <p>Please indicate which Best Practice Conference Facebook group you would like to join:</br></br>
		    <!-- WR 1406171109 -->
                        <input type="checkbox" checked="unchecked" name="lv_mon" value="lv_mon">
                        Las Vegas
                        <br>
                        <input type="checkbox" checked="unchecked" name="ch_mon" value="ch_mon">
                        Chicago
                        <br>
                        <input type="checkbox" checked="unchecked" name="or_mon" value="or_mon">
                        Orlando
                        <br>
		    </p>
		</div>
	    <input type="submit" value="SUBMIT" id="submit" name="submit"/>
	    
	    <span style="margin-left: 20px;"><a href="../2014_bestpractices.php">Cancel</a></span>
	</div>
	     </form> 
	 <br/>
     </div>
    </body>
</html>
<!-- Import Statements-->
<script src="../2014_BPC/js/validate.js"></script>
<!-- Page Specific JS here -->
<script type="text/javascript" >

</script>

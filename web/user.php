<?php
    session_start();
    
    //$_SESSION['valid_user'] = true;
    
    // Check if user is already valid
    if(isset($_SESSION['valid_user']) && $_SESSION['valid_user'] == true){
        //echo 'Valid user - Time : '.date('m/d/Y H:i:s',time()).'<br/>';
        $_SESSION['LAST_ACTIVITY'] = time();
        if(!$_SESSION['SESSION_START'] ){ 
            $_SESSION['SESSION_START'] = time(); // update last activity time stamp
            $_SESSION['SESSION_EXPIRE'] = $_SESSION['SESSION_START'] + (60*60);
        }
         //echo 'Session Start: '.date('m/d/Y H:i:s',$_SESSION['SESSION_START']).'<br/>';
         //echo 'Session Expire: '.date('m/d/Y H:i:s',$_SESSION['SESSION_EXPIRE']).'<br/>';
  
    }else{ 
        // Get the URL with the encrypted string in it
        //echo "ORIGINAL: $_SERVER[REQUEST_URI] </br>";
        $encrypted_data = $_SERVER[REQUEST_URI];
        //echo  addslashes($encrypted_data);
        $character_mask = "/v19/index.php?";    
        $encrypted_data = ltrim($encrypted_data, $character_mask);
        //echo "LTRIM: $encrypted_data <br/>";
        $encrypted_data = ltrim($encrypted_data, "=");
        //echo "LTRIM2: $encrypted_data <br/>";
        $encrypted_data = rtrim($encrypted_data, '/cphelp/default.htm');
        //echo "RTRIM: $encrypted_data <br />";
        $decrypted = exec("echo -e $encrypted_data | openssl enc -bf -nosalt -a -d -pass pass:cpsi123",$retval);
        //echo "END RESULT: $encrypted_data <br />";
        $check_arry = explode("~", $decrypted);
    
        // Check some parts of array for match here
        if(preg_match('/cpsinet.com/i',$check_arry[3])|| preg_match('/cpsi.com/i',$check_arry[3])){
            $_SESSION['valid_user'] = true;
            header("Location: /v19/index.php");
        }else{
            $_SESSION['valid_user'] = false;
        }
    }
    
    // Redirect invalid users to error page
    if((isset($_SESSION['valid_user']) && $_SESSION['valid_user'] == false) || !isset($_SESSION['valid_user'])){
        header('Location: http://cphelp.cpsi.com/error.php');
    }
    
    // Check session time, if last request over an hour ago, destroy session
    if (isset($_SESSION['SESSION_EXPIRE']) && (time() > $_SESSION['SESSION_EXPIRE'])) {
        // last request was more than 60 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        header('Location: http://cphelp.cpsi.com/error.html');
    }
?>

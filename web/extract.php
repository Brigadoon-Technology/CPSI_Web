<?php

function get_ip()
{
    /* First, look for an IP address from the server. */
    if (!empty($_SERVER["REMOTE_ADDR"])) {
        $client_ip = $_SERVER["REMOTE_ADDR"];
    }
    
    /* Look for proxy servers. */
    if ($_SERVER["HTTP_CLIENT_IP"]) {
        $proxy_ip = $_SERVER["HTTP_CLIENT_IP"];
    } else if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
        $proxy_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    
    /* Look for a real IP address underneath proxies. */
    if ($proxy_ip) {
        if (preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $proxy_ip, $ip_list)) {
            $private_ip = array(
                '/^0\./',
                '/^127\.0\.0\.1/',
                '/^192\.168\..*/',
                '/^172\.16\..*/',
                '/^10.\.*/',
                '/^224.\.*/',
                '/^240.\.*/'
            );
            $client_ip  = preg_replace($private_ip, $client_ip, $ip_list[1]);
        }
    }
    
    return $client_ip;
}

function find_browser()
{
    // Determine OS, version, and type of client browsers.
    $browser_info = array(
        "name" => "Unknown",
        "version" => "Unknown",
        "OS" => "Unknown"
    );
    // Get the User Agent.
    if (!empty($_SERVER["HTTP_USER_AGENT"])) {
        $agent = $_SERVER["HTTP_USER_AGENT"];
    }
    
    // Find operating system.
    if (preg_match('/win/i', $agent)) {
        $browser_info["OS"] = "Windows";
    } else if (preg_match('/mac/i', $agent)) {
        $browser_info["OS"] = "Macintosh";
    } else if (preg_match('/linux/i', $agent)) {
        $browser_info["OS"] = "Linux";
    }
    
    if (preg_match('/opera/i', $agent)) {
        // Must start with Opera, since it matches IE string
        $browser_info["name"] = "Opera";
        $agent                = stristr($agent, "Opera");
        if (strpos("/", $agent)) {
            $agent                   = explode("/", $agent);
            $browser_info["version"] = $agent[1];
        } else {
            $agent                   = explode(" ", $agent);
            $browser_info["version"] = $agent[1];
        }
        
    } else if (preg_match('/msie/i', $agent)) {
        $browser_info["name"]    = "Internet Explorer";
        $agent                   = stristr($agent, "msie");
        $agent                   = explode(" ", $agent);
        $browser_info["version"] = str_replace(";", "", $agent[1]);
        
        
    } else if (preg_match('/firefox/i', $agent)) {
        $browser_info["name"]    = "Firefox";
        $agent                   = stristr($agent, "Firefox");
        $agent                   = explode("/", $agent);
        $browser_info["version"] = $agent[1];
        
    } else if (preg_match('/safari/i', $agent)) {
        $browser_info["name"]    = "Safari";
        $agent                   = stristr($agent, "Safari");
        $agent                   = explode("/", $agent);
        $browser_info["version"] = $agent[1];
        
    } else if (preg_match('/netscape/i', $agent)) {
        $browser_info["name"]    = "Netscape Navigator";
        $agent                   = stristr($agent, "Netscape");
        $agent                   = explode("/", $agent);
        $browser_info["version"] = $agent[1];
        
    } else if (preg_match('/Gecko/i', $agent)) {
        $browser_info["name"]    = 'Mozilla';
        $agent                   = stristr($agent, "rv");
        $agent                   = explode(":", $agent);
        $agent                   = explode(")", $agent[1]);
        $browser_info["version"] = $agent[1];
    }
    return $browser_info;
}

?>

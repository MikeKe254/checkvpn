<?php
   /*
   Code by Mike Njagi
   You can include it in your PHP files
   To try enable your vpn
   For tips paypal: mikenjagike@gmail.com
   */
   #Turn off error reporting.
   error_reporting(0);
   
   #Begin the test
   $test_HTTP_proxy_headers = array(
	'X-PROXY-ID',
	'MT-PROXY-ID',
	'X-TINYPROXY',
	'X_FORWARDED_FOR',
	'FORWARDED_FOR',
	'X_FORWARDED',
	'FORWARDED',
	'CLIENT-IP',
	'HTTP_VIA',
	'VIA',
	'Proxy-Connection',
	'HTTP_X_FORWARDED_FOR',  
	'HTTP_FORWARDED_FOR',
	'HTTP_X_FORWARDED',
	'HTTP_FORWARDED',
	'HTTP_CLIENT_IP',
	'HTTP_FORWARDED_FOR_IP',
	'CLIENT_IP',
	'PROXY-AGENT',
	'HTTP_X_CLUSTER_CLIENT_IP',
	'FORWARDED_FOR_IP',
	'HTTP_PROXY_CONNECTION');
	
	foreach($test_HTTP_proxy_headers as $header){
		if (isset($_SERVER[$header]) && !empty($_SERVER[$header])) {
			exit("<title>VPN DETECTED </title>
                  VPN DETECTED" 
                  #Do something 
                 );
		}
	}

     $proxy_ports = array(80,81,8080,443,1080,6588,3128);
	 foreach($proxy_ports as $test_port) {
		if(@fsockopen($_SERVER['REMOTE_ADDR'], $test_port, $errno, $errstr, 5)) {
		exit("<title>VPN DETECTED </title>
                  VPN DETECTED" 
                  #Do something 
                 );
		}
	}

   
    #Visit https://ipqualityscore.com, create an account and get your api Key and fill it below
    $key = 'Enter your key here';
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : $_SERVER['HTTP_CLIENT_IP'];
    $strictness = 1;
    $result = json_decode(file_get_contents(sprintf('https://ipqualityscore.com/api/json/ip/%s/%s?strictness=%s', $key, $ip, $strictness)), true);
    if($result !== null){
        if(isset($result['proxy']) && $result['proxy'] == true){
            // Perform your business logic here
             exit("<title>VPN DETECTED </title>
                  VPN DETECTED" 
                  #Do something 
                 );          
         }
     }
    
    
     #If the code has ran up to this line it means that the client is not using a proxy/vpn
     #Do something

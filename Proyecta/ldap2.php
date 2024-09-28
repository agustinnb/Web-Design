<?php

$domain = 'trendargentina.com.ar'; 
$username = 'agustinb'; 
$password = 'A17n333b110*'; 
$ldapconfig['host'] = 'TASRV01.TRENDARGENTINA.COM.AR'; 
$ldapconfig['port'] = 389; 
$ldapconfig['basedn'] = 'DC=TRENDARGENTINA,DC=COM,DC=AR';  
$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']); 
$dn= "OU=TAUSERS," . $ldapconfig['basedn']; 
$bind=ldap_bind($ds, $username .'@' .$domain, $password);
$attributes = array("displayname", "mail", "samaccountname"); 
 $filter = "(&(objectCategory=person)(sAMAccountName=$username))";
   $isITuser = ldap_search($bind, $dn, $filter, $attributes);
 if ($isITuser) {    
  echo("Login correct"); 
  } else {  
     echo("Login incorrect"); } 

?>
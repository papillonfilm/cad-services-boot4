<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ldap Authentication
    |--------------------------------------------------------------------------
 	| Server to authenticate users
    |
    */

    'server' =>  "ldaps://adldap.pbcgov.org",
	//'server'=> 'ldap://pbcgccdc1.pbcgov.org' ,
	
	/*
    |--------------------------------------------------------------------------
    | Ldap rdn
    |--------------------------------------------------------------------------
 	|  
    |
    */
	
	'ldaprdn' => 'cn=cad icms,ou=Services,ou=CAD,ou=Enterprise,DC=PBCGOV,DC=ORG',
	
	
	/*
    |--------------------------------------------------------------------------
    | Ldap password
    |--------------------------------------------------------------------------
 	|  
    |
    */
	
	
	'ldappass' => 'password99',
	

];
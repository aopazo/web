<?php
    //API Key - see http://admin.mailchimp.com/account/api
    $apikey = '385ff1a9a0b2cf9d67bd02531f686d44-us7';

    // A List Id to run examples against. use lists() to view all
    // Also, login to MC account, go to List, then List Tools, and look for the List ID entry
    $listId = '7f64d00318';  // lista usuarios de produccion
    $listIdPrueba = '1a9463286c';  // lista de prueba
    $listId = '1a9463286c';  // lista de prueba
	
    // A Campaign Id to run examples against. use campaigns() to view all
    $campaignId = '35585';

    //some email addresses used in the examples:
    $my_email = 'algo@gmail.com';
    $boss_man_email = 'INVALID@example.com';

    //just used in xml-rpc examples
    $apiUrl = 'http://api.mailchimp.com/1.3/';

?>

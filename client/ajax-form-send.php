<?php
/**
 * @file
 * Validate and send user data.
 *
 * @author Michal Krauter <michal.krauter@seznam.cz>
 */

require('ValidateUser.class.php');

// SOAP settings
ini_set('default_socket_timeout', 15);
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);

libxml_disable_entity_loader(false);

// return variable
$return_data   = array();
$return_data['success'] = false;
$return_data['message'] = 'Registrace uživatele nebyla úspěšná !';

$register = new ValidateUser();
$errors = $register->validate();

if (empty($errors)){
  try {		
    $client = new SoapClient("http://4rau13r-svr.9e.cz/krauter.wsdl", ['trace' => true, 'cache_wsdl' => WSDL_CACHE_MEMORY]);
    $response = $client->InsertUser($_POST["name"], $_POST["email"], $_POST["password"], $_POST["authority"]);
  }
  catch(Exception $e){
    die($e->getMessage());
  }
  
  if ($response){
    $return_data['success'] = true;
    $return_data['message'] = 'Uživatel úspěšně registrován.';
  }
  else {                                           
    $return_data['errors']  = $errors;
  }
}
else {
  $return_data['errors']  = $errors;
}

echo json_encode($return_data);
 
?>
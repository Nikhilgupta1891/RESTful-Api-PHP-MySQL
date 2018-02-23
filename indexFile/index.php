<?php
use \Psr\Http\Message\Servercustom_addressInterface as Server_Request;
use \Psr\Http\Message\ResponseInterface as Server_Respone;

require '../vendor3rdParties/autoload.php';
require '../src/db_config/database.php';

$phpApp = new \PhpRestSQL\App;
$phpApp->get('/Hey/{inputName}', function (Server_Request $request, Server_Respone $response) {
    $inputName = $request->getAttribute('inputName');
    $server_response->getBody()->write("Hey, how's it going $inputName");
    return $server_response;
});

require '../src/user-routes/users.php';

$phpApp->run();
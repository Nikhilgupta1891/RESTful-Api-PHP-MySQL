<?php
use \Psr\Http\Message\ServerRequestInterface as Server_Request;
use \Psr\Http\Message\ResponseInterface as Server_Response;

$app = new \PhpRestSQL\App;

$app->options('/{user-routes:.+}', function ($server_request, $server_response, $args) {
    return $server_response;
});

$app->add(function ($request, $response, $next) {
    $server_response = $next($request, $response);
    return $server_response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Server_Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Get List of all the users
$app->get('/api/users', function(Server_Request $server_request, Server_Response $server_response){
    $sql = "SELECT * FROM users";

    try{
        // Database Object
        $database = new database();
        // Connection
        $database = $database->connect();

        $db_statement = $database->query($sql);
		
		// Fetch using PDO
        $users = $db_statement->fetchAll(PDO::FETCH_OBJ);
        $database = null;
        echo json_encode($users);
    } catch(PDOException $e){
        echo '{"error": {"msg": '.$e->getMessage().'}';
    }
});

// Update an existing user
$app->put('/api/user/update/{id}', function(Server_Request $server_request, Server_Response $server_response){
    $id = $server_request->getAttribute('id');
    $first_name = $server_request->getParam('first_name');
    $last_name = $server_request->getParam('last_name');
    $address = $server_request->getParam('address');

    $sql = "UPDATE users SET
				first_name 	= :first_name,
				last_name 	= :last_name,
                address 	= :address,
			WHERE id = $id";

    try{
        // Database Object
        $database = new database();
        // Connection
        $database = $database->connect();

        $db_statement = $database->prepare($sql);

        $db_statement->bindParam(':first_name', $first_name);
        $db_statement->bindParam(':last_name',  $last_name);
        $db_statement->bindParam(':address',    $address);

        $db_statement->execute();

        echo '{"notification": {"msg": "User Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"msg": '.$e->getMessage().'}';
    }
});

// Delete an existing user
$app->delete('/api/user/delete/{id}', function(Server_Request $server_request, Server_Response $server_response){
    $id = $server_request->getAttribute('id');

    $sql = "DELETE FROM users WHERE id = $id";

    try{
        // Database Object
        $database = new database();
        // Connection
        $database = $database->connect();

        $db_statement = $database->prepare($sql);
        $db_statement->execute();
        $database = null;
        echo '{"notification": {"msg": "User Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"msg": '.$e->getMessage().'}';
    }
});

// Get a single User
$app->get('/api/user/{id}', function(Server_Request $server_request, Server_Response $server_response){
    $id = $server_request->getAttribute('id');

    $sql = "SELECT * FROM users WHERE id = $id";

    try{
        // Database Object
        $database = new database();
        // Connection
        $database = $database->connect();

        $db_statement = $database->query($sql);
		
		// Fetch using PDO
        $user = $db_statement->fetch(PDO::FETCH_OBJ);
        $database = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"msg": '.$e->getMessage().'}';
    }
});

// Add a User
$app->post('/api/user/add', function(Server_Request $server_request, Server_Response $server_response){
    $first_name = $server_request->getParam('first_name');
    $last_name = $server_request->getParam('last_name');
    $address = $server_request->getParam('address');

    $sql = "INSERT INTO users (first_name,last_name,address) VALUES
    (:first_name,:last_name,:address)";

    try{
        // Get DB Object
        $database = new database();
        // Connect
        $database = $database->connect();

        $db_statement = $database->prepare($sql);

        $db_statement->bindParam(':first_name', $first_name);
        $db_statement->bindParam(':last_name',  $last_name);
        $db_statement->bindParam(':address',    $address);

        $db_statement->execute();

        echo '{"notification": {"msg": "User Added"}';

    } catch(PDOException $e){
        echo '{"error": {"msg": '.$e->getMessage().'}';
    }
});
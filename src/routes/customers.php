<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Get All Customers.
$app->get('/api/customers', 
            function(Request $request, Response $response) {
                
               $sql = "SELECT * FROM customers";
                
               try {
                    // Get DB Object from db class in db.php
                    $db = new db();

                    // connect
                    $db = $db->connect();
                    
                    $stmt = $db->query($sql);
                    $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
                    $db = null;
                    echo json_encode($customers);
               } catch(PDOException $e) {
                    echo '{"error: {"text": '.$e->getMessage().'}"}';
               } 
            }
);

// Get Single Customer.
$app->get('/api/customers/{id}', 
            function(Request $request, Response $response) {
               $id = $request->getAttribute('id');
               // If that ID doesn't exist, an empty JSOn is returned.

               $sql = "SELECT * FROM customers WHERE id=$id";
               try {
                    // Get DB Object from db class in db.php
                    $db = new db();

                    // connect
                    $db = $db->connect();
                    
                    $stmt = $db->query($sql);
                    $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
                    $db = null;
                    echo json_encode($customer);
               } catch(PDOException $e) {
                    echo '{"error: {"text": '.$e->getMessage().'}"}';
               } 
            }
);

$app->post('/api/customer/add', 
                function(Request $request, Response $response) {
                    $first_name = $request->getParam('first_name');
                    $last_name = $request->getParam('last_name');
                    $phone = $request->getParam('phone');

                    // Not yet binding the values
                    $sql = "INSERT into customers (first_name, last_name, phone)
                            VALUES (:first_name,:last_name,:phone)";
                    try {
                        // Create DB Object
                        $db = new db();

                        // Connect
                        $db = $db->connect();

                        // Prepare Statement
                        $stmt = $db->prepare($sql);

                        // Bind Parameters
                        $stmt->bindParam(":first_name", $first_name);
                        $stmt->bindParam(":last_name", $last_name);
                        $stmt->bindParam(":phone", $phone);

                        // Execute the Statement
                        $stmt->execute();
                        echo "Customer Added";
                    } catch(PDOException $e) {
                        echo '{"error: {"text": '.$e->getMessage().'}"}';
                   }
});

$app->delete('/api/customer/delete/{id}', 
                function(Request $request, Response $response) {
                   $id = $request->getAttribute('id');

                    // Not yet binding the values
                    $sql = "DELETE FROM customers WHERE id=$id";
                    try {
                        // Create DB Object
                        $db = new db();

                        // Connect
                        $db = $db->connect();
                        $stmt = $db->query($sql);
                        $stmt->execute();
                        echo "Customer Deleted";
                    } catch(PDOException $e) {
                        echo '{"error: {"text": '.$e->getMessage().'}"}';
                   }
});

$app->put('/api/customer/update/{id}', 
                function(Request $request, Response $response) {
                    
                    $id = $request->getAttribute('id');

                    $first_name = $request->getParam('first_name');
                    $last_name = $request->getParam('last_name');
                    $phone = $request->getParam('phone');

                    // Not yet binding the values
                    $sql = "UPDATE customers SET 
                                first_name = :first_name,
                                last_name = :last_name,
                                phone = :phone 
                                WHERE id = $id";

                    try {
                        // Create DB Object
                        $db = new db();

                        // Connect
                        $db = $db->connect();

                        // Prepare Statement
                        $stmt = $db->prepare($sql);

                        // Bind Parameters
                        $stmt->bindParam(":first_name", $first_name);
                        $stmt->bindParam(":last_name", $last_name);
                        $stmt->bindParam(":phone", $phone);

                        // Execute the Statement
                        $stmt->execute();
                        echo "Customer Updated";
                    } catch(PDOException $e) {
                        echo '{"error: {"text": '.$e->getMessage().'}"}';
                   }
});

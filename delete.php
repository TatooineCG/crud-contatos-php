<?php 

require 'db.php';

$id = $_GET['id'];

$sql = 'DELETE FROM people WHERE id = :id';

$statement = $connection->prepare($sql);

try {
    if($statement->execute([':id' => $id])) {
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}

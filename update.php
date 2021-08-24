<?php 
require 'db.php';

    $id = $_GET['id'];

    $sql = 'SELECT * FROM people WHERE id = :id';
    $statement = $connection->prepare($sql);
    $statement->execute([':id' => $id]);

    $person = $statement->fetch(PDO::FETCH_OBJ);


    try {
        if(isset($_POST['name']) && isset($_POST['email'])) {
            $name = addslashes($_POST['name']);
            $email = addslashes($_POST['email']);
    
            $sql = 'UPDATE people SET name = :name, email = :email WHERE id = :id';
    
            $statement = $connection->prepare($sql);
            
            if($statement->execute([':name' => $name, ':email' => $email, ':id' => $id])) {
                header("Location: index.php");
                exit;
            }
        }
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }

?>

<?php require 'header.php'; ?>

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Editar contato</h2>
        </div>

        <div class="card-body">
            <?php if(!empty($message)): ?>
                <div class="alert alert-success">
                    <?= $message; ?>
                </div>
            <?php endif; ?>

                <form method="post">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" value="<?= $person->name; ?>" name="name" id="name" class="form-control">
                    </div>

                    <div class="form-group mt-2">
                        <label for="email">E-mail</label>
                        <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-info">Salvar</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>

<?php 
require 'db.php';

$message = '';

    try {
        if(isset($_POST['name']) && isset($_POST['email'])) {
            $name = addslashes($_POST['name']);
            $email = addslashes($_POST['email']);
    
            $sql = 'INSERT INTO people(name, email) VALUES(:name, :email)';
    
            $statement = $connection->prepare($sql);
            
            if($statement->execute([':name' => $name, ':email' => $email])) {
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
            <h2>Cadastro de contatos</h2>
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
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group mt-2">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-info">Cadastrar</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>

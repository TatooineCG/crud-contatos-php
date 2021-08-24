<?php 
    require 'db.php';


    $sql = 'SELECT * FROM people';

    $statement = $connection->prepare($sql);
    $statement->execute();

    $people = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<?php require 'header.php'; ?>

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Lista de contatos</h2>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ação</th>
                </tr>

                <?php foreach($people as $person): ?>

                <tr>
                    <td><?= $person->id; ?></td>
                    <td><?= $person->name; ?></td>
                    <td><?= $person->email; ?></td>
                    <td>
                        <a href="update.php?id=<?= $person->id ?>" class="btn btn-info">Editar</a>
                        <a onclick="return confirm('Tem certeza que deseja excluir este contato?')" href="delete.php?id=<?= $person->id ?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>

                <?php endforeach; ?>

            </table>
        </div>

    </div>
</div>

<?php require 'footer.php'; ?>

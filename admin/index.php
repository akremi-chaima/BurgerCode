<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Burger Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.cdnfonts.com/css/holtwood-one-sc" rel="stylesheet">
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
<h1 class="text-logo"><span class="bi-shop"></span> Burger Code <span class="bi-shop"></span></h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Liste des items   </strong><a href="inser.php" class="btn btn-success btn-lg"><span class="bi-plus"></span> Ajouter</a></h1>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require 'database.php';
            $db = Database::connect();
            $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id DESC');
            while($item = $statement->fetch()) {
                echo '<tr>';
                echo '<td>'. $item['name'] . '</td>';
                echo '<td>'. $item['description'] . '</td>';
                echo '<td>'. number_format($item['price'], 2, '.', '') . '</td>';
                echo '<td>'. $item['category'] . '</td>';
                echo '<td width=340>';
                echo '<a class="btn btn-secondary" href="view.php?id='.$item['id'].'"><span class="bi-eye"></span> Voir</a>';
                echo ' ';
                echo '<a class="btn btn-primary" href="update.php?id='.$item['id'].'"><span class="bi-pencil"></span> Modifier</a>';
                echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id='.$item['id'].'"><span class="bi-x"></span> Supprimer</a>';
                echo '</td>';
                echo '</tr>';
            }
            Database::disconnect();
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>



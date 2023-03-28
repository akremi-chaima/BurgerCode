<?php
require 'database.php';

if(!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$db = Database::connect();
$statement = $db->prepare("SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?");
$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();

function checkInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
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
        <div class="col-md-6">
            <h1><strong>Voir un item</strong></h1>
            <br>
            <form>
                <div>
                    <label>Nom:</label><?php echo '  '.$item['name'];?>
                </div>
                <br>
                <div>
                    <label>Description:</label><?php echo '  '.$item['description'];?>
                </div>
                <br>
                <div>
                    <label>Prix:</label><?php echo '  '.number_format((float)$item['price'], 2, '.', ''). ' €';?>
                </div>
                <br>
                <div>
                    <label>Catégorie:</label><?php echo '  '.$item['category'];?>
                </div>
                <br>
                <div>
                    <label>Image:</label><?php echo '  '.$item['image'];?>
                </div>
            </form>
            <br>
            <div class="form-actions">
                <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
            </div>
        </div>
        <div class="col-md-6 site">
            <div class="img-thumbnail">
                <img src="<?php echo '../image/'.$item['image'];?>" alt="...">
                <div class="price"><?php echo number_format((float)$item['price'], 2, '.', ''). ' €';?></div>
                <div class="caption">
                    <h4><?php echo $item['name'];?></h4>
                    <p><?php echo $item['description'];?></p>
                    <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

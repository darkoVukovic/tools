<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Excel Table</title>
</head>
<body>
<?php  loadView('/basic/header', ['title' => 'export to excel']); ?>

    <p>Select database table </p>
    <ul>


    <?php 
        
        foreach($tables as $table) {
            ?>
                <li><a href="?table=<?= $table?>"><?= $table ?></a></li>
            <?php
        }
    ?>
        </ul>
    <?php  if(isset($items) && isset($_GET['table'])) {
             loadView('table', ['keys' => $items['columnNames'], 'items' => $items]); 
    }
    ?>

    <form action="excel/export" method="POST">
        <input type="hidden" name="table" value="<?= $_GET['table'] ?? '' ?>">
        <input type="submit" name="export_excel" value='export to excel'>
    </form>
<?php 
    include_once(ROOTDIR.'/mvc/Views/basic/footer.php');
    ?>
</body>
</html>
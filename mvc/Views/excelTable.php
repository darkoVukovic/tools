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


    <h3>Excel Table</h3>
    <table>
        <tr>
            <th>Id</th>
            <th>Category Name</th>
        </tr>
        <?php 
            foreach($items as $item) {
                echo "<tr>
                    <td>".$item['id_shopCategory']."</td>
                    <td>".$item['name']."</td>
                    </tr>";
            }
        ?>
    </table>

    <form action="excel/export" method="POST">
        <input type="submit" name="export_excel" value='export to excel'>
    </form>
<?php 
    include_once(ROOTDIR.'/mvc/Views/basic/footer.php');
    ?>
</body>
</html>
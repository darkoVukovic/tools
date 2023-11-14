<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/index.css">
    <title>Pdf Converter</title>
</head>
<body>
    <?php 
    include_once(ROOTDIR.'/mvc/Views/basic/header.php');
    ?>

<main>
    <div>
        <h3>Text files to Pdf</h3>
        <form action="/pdf/convert" METHOD=POST >
            <input type="file" id='textFile' name='textFile'>
            <button>Convert </button> 
        </form>
    </div>
</main>

<?php 
    include_once(ROOTDIR.'/mvc/Views/basic/footer.php');
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Tools</title>
</head>
<body>
    <?php  loadView('/basic/header', ['title' => 'tools', 'links' => [['href' => 'excel', 'name' => 'excel'], ['href' => 'pdf', 'name' => 'pdf']]]); ?>


    <?php  loadView('/basic/footer'); ?>    

</body>
</html>
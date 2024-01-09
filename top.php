<?php
$phpSelf = htmlspecialchars($_SERVER[PHP_SELF]);
$path_parts = pathinfo($phpSelf);
?>


<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Homework Planner</title>
        <meta name="author" content="Jack Klug and Bradon Soucy">
        <meta name="description" content="Interactive Page that provides users with a homework planner tool.">
        <link rel="stylesheet" href="css/custom.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media ="(max-width: 900px)" href="css/custom-tablet.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media ="(max-width: 600px)" href="css/custom-phone.css?version=<?php print time(); ?>" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <?php
    print '<body class="grid-layout" id="' . $path_parts['filename'] . '">';
    ?>
    <?php
    include 'connect-DB.php';
    print PHP_EOL;
    include 'header.php';
    print PHP_EOL;
    include 'nav.php';
    ?>
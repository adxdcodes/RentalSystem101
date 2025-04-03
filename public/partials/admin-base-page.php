<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}
?>

<?php
require '../partials/dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../../src/input.css" />
    <title>Rental system</title>
</head>

<body class="flex flex-col min-h-screen select-none">
    <!--- **********************nav*************************** -->

    <?php
    // Nav BAR
    include '../partials/admin-nav.php';

    ?>
    <!--- **********************nav*************************** -->



    <!--- ********************** Main Body *************************** -->
    <div class="flex justify-center flex-1 bg-gray-800 text-white">

    </div>
    <!--- ********************** Main Body *************************** -->


    <!--- **********************  FOOTER *************************** -->
    <?php
    // Nav BAR
    include '../partials/admin-footer.php';
    ?>
    <!--- ********************** FOOTER *************************** -->

</body>

</html>
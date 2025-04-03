<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}
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


    <?php
    include '../partials/config.php';
    ?>

    <?php


    $showAlert = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include '../partials/dbconnect.php';
        $flat = $_POST["flat"];
        $flatType = $_POST["flat-type"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM `users` WHERE flat = '$flat' OR username = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "Flat already exists!";
        } else {
            $sql = "INSERT INTO `users` ( `flat`, `flat_type`, `username`, `password`, `dt`) VALUES ( '$flat','$flatType', '$username', '$hashed_password', current_timestamp())";
            if ($username != $password) {

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert = true;
                    echo "Flat Inserted Successfully!";
                    header("Location:manage-apartments.php");
                }
            } else {
                echo "password same as username!";
            }
        }


        // TO INSERT THE DATA

    }

    ?>

    <!--- ********************** Login Form *************************** -->
    <!-- <div class="flex flex-col flex-1">
    <div class="alert w-full h-[50px] block bg-white">
      <h1>Success!</h1>

    </div> -->

    <div class="flex justify-center items-center flex-1 bg-gray-800">
        <div class="bg-white p-8 shadow-md rounded-lg w-full sm:w-96">
            <h2 class="text-2xl font-bold mb-4 text-center">Add new flat</h2>
            <form method="POST">
                <div class="mb-4">
                    <label for="flat" class="block text-sm font-medium text-gray-700">Flat</label>
                    <input type="text" placeholder="Enter new flat no" id="flat" name="flat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </input>
                </div>
                <div class="mb-4">
                    <label for="flat-type" class="block text-sm font-medium text-gray-700">Flat Type</label>
                    <input type="text" id="flat-type" name="flat-type" placeholder="1BHK/1RK/..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>
                <div class="mb-6">
                    <label for="cpassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>
                <button type="submit" class="w-full bg-gray-500 text-white py-2 px-4 rounded-md focus:outline-none border-gray-600 border-[1.5px] duration-300 ease-in-out hover:text-white hover:bg-black hover:border-black">
                    Add flat
                </button>
            </form>
        </div>
    </div>
    <!-- </div> -->
    <!--- ********************** Login Form *************************** -->

    <!--- **********************  FOOTER *************************** -->
    <?php
    // Nav BAR
    include '../partials/admin-footer.php';
    ?>
    <!--- ********************** FOOTER *************************** -->

    <!--- **********************scripts*************************** -->

    <!--- **********************scripts*************************** -->
</body>

</html>
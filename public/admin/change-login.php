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


    <!-- #################### To Enter the data into db ################### -->
    <?php


    // $showAlert = false;
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //     include '../partials/dbconnect.php';
    //     $flat = $_POST["flat"];
    //     $flatType = $_POST["flat-type"];
    //     $username = $_POST["username"];
    //     $password = $_POST["password"];
    //     $cpassword = $_POST["cpassword"];
    //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //     $query = "SELECT * FROM `users` WHERE flat = '$flat' OR username = '$username'";
    //     $result = mysqli_query($conn, $query);
    //     if (mysqli_num_rows($result) > 0) {
    //         echo "Flat already exists!";
    //     } else {
    //         $sql = "INSERT INTO `users` ( `flat`, `flat_type`, `username`, `password`, `dt`) VALUES ( '$flat','$flatType', '$username', '$hashed_password', current_timestamp())";
    //         if ($username != $password) {

    //             $result = mysqli_query($conn, $sql);
    //             if ($result) {
    //                 $showAlert = true;
    //                 echo "Flat Inserted Successfully!";
    //             }
    //         } else {
    //             echo "password same as username!";
    //         }
    //     }  }


    // TO INSERT THE DATA



    ?>
    <!-- #################### To Enter the data into db ################### -->
    <!-- #################### To Get data from the db ################### -->
    <?php
    include '../partials/dbconnect.php';

    // Check if 'id' is set in the URL
    if (isset($_SESSION['current_id'])) {
        $id = intval($_SESSION['current_id']); // Sanitize the input


        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE sno = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the record
        if ($row = $result->fetch_assoc()) {
            $flat = htmlspecialchars($row['flat']);
            $flat_type = htmlspecialchars($row['flat_type']);
            $fusername = htmlspecialchars($row['username']);
            $fpassword = htmlspecialchars($row['password']);
            // Check if the flat exists

            // $rent_due = htmlspecialchars($row['rent_due']);
            // Other fields as needed
        } else {
            $flat = 'Not found';
            $flat_type = 'Not found';
            $fusername = 'Not found';
            $fpassword = '';

            $rent_due = 'Not found';
        }
    } else {
        $flat = 'Not found';
        $flat_type = 'Not found';
        $fusername = 'Not found';
        $fpassword = '';
        $rent_due = 'No ID provided';
    }
    ?>






    <!-- #################### To Get data from the db ################### -->

    <!--- ********************** Login Form *************************** -->
    <!-- <div class="flex flex-col flex-1">
    <div class="alert w-full h-[50px] block bg-white">
      <h1>Success!</h1>

    </div> -->

    <div class="flex justify-center items-center flex-1 bg-gray-800">
        <div class="bg-white p-8 shadow-md rounded-lg w-full sm:w-96">
            <h2 class="text-2xl font-bold mb-4 text-center">Change Flat Data</h2>
            <form method="POST" action="update-flat.php">
                <input type="hidden" name="sno" value="<?php echo $id; ?>">
                <div class="mb-4">
                    <label for="flat" class="block text-sm font-medium text-gray-700">Flat</label>
                    <input type="text" id="flat" name="flat" value="<?php echo $flat; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none select-none shadow-sm  sm:text-sm" required />
                </div>
                <div class="mb-4">
                    <label for="flat-type" class="block text-sm font-medium text-gray-700">Flat Type</label>
                    <input type="text" id="flat-type" name="flat-type" placeholder="1BHK/1RK/..." value="<?php echo $flat_type; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" value="<?php echo $fusername; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
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
                    Update
                </button>
            </form>
        </div>
    </div>
    <!-- </div> -->

    <!--- **********************  FOOTER *************************** -->
    <?php
    // Nav BAR
    include '../partials/admin-footer.php';
    ?>
    <!--- ********************** FOOTER *************************** -->


    <!--- **********************scripts*************************** -->
</body>

</html>
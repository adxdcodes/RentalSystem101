<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}

include '../partials/dbconnect.php';

$output = '';
$counter = 1;

$search = mysqli_real_escape_string($conn, $_POST["search"]);
$sql = "SELECT * FROM `users` WHERE flat LIKE '%$search%' ORDER BY `flat` ASC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query Failed: ' . mysqli_error($conn)); // This will show an error if the query fails
}

if (mysqli_num_rows($result) > 0) {


    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
        <a href="about-apartments.php?id=' . htmlspecialchars($row["sno"]) . '" class="group block p-6 hover:shadow-xl bg-white rounded-lg shadow-md transition duration-300">
          <p class="mt-2 font-bold duration-200 text-gray-700 text-[40px] text-center hover:text-black">' . htmlspecialchars($row["flat"]) . '</p>
          <p class="mt-2 duration-300 ease-in-out text-gray-600 text-center">See more details!</p>
        </a>';

        $counter++;
    }
    echo $output;
} else {
    echo "<tr class='text-center'><td><h1 class='text-center inline underline-offset-1'>No <h2 class='font-bold text-red-600 inline'>Flat</h2> found</h1></td> </tr>";
}

<?php
session_start();
if (isset($_SESSION['is_logged_in'])) {
  header("Location: user/user-dashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="/src/input.css" />
  <title>Rental system</title>
</head>

<body class="flex flex-col min-h-screen select-none">


  <?php
  require 'partials/header.php';
  include 'partials/config.php';
  ?>


  <!--- ********************** Login Form *************************** -->
  <!-- <div class="flex flex-col flex-1">
    <div class="alert w-full h-[50px] block bg-white">
      <h1>Success!</h1>

    </div> -->

  <div class="flex justify-center items-center flex-1 bg-gray-800">
    <div class="bg-white p-8 shadow-md rounded-lg w-full sm:w-96">
      <h2 class="text-2xl font-bold mb-4 text-center">Sign In</h2>
      <form method="post" action="admin/login-process2.php">
        <div class="mb-4">
          <label for="flat" class="block text-sm font-medium text-gray-700">Flat</label>

          <select id="flat" name="flat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            <option value="" selected>Select your Flat</option>
            <option value="K1">K1</option>
            <option value="K2">K2</option>
            <option value="K3">K3</option>
            <option value="K4">K4</option>
            <option value="K5">K5</option>
          </select>
        </div>
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" id="username" name="username" placeholder="Email or Username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>

        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <button type="submit" class="w-full bg-gray-500 text-white py-2 px-4 rounded-md focus:outline-none border-gray-600 border-[1.5px] duration-300 ease-in-out hover:text-white hover:bg-black hover:border-black">
          Sign In
        </button>
      </form>
    </div>
  </div>
  <!-- </div> -->
  <!--- ********************** Login Form *************************** -->

  <?php
  require 'partials/footer.php'
  ?>

  <!--- **********************scripts*************************** -->

  <!--- **********************scripts*************************** -->
</body>

</html>
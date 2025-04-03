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

  <!--- ********************** admin dash Form *************************** -->

  <div class="flex justify-center flex-1 bg-gray-800 text-white">
    <div class="container mx-auto p-8">
      <h1 class="text-4xl font-bold mb-6">Admin Dashboard</h1>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="manage-apartments.php" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300">
          <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
            <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
          </svg>
          <h2 class="mt-2 text-xl font-bold text-black">Manage Apartments</h2>
          <p class="mt-2 text-gray-600">View and manage all apartments.</p>
        </a>
        <a href="manage-tenants.php" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300">
          <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
          </svg>
          <h2 class="mt-2 text-xl font-bold text-black">Manage Tenants</h2>
          <p class="mt-2 text-gray-600">View and manage all tenants.</p>
        </a>
        <a href="manage-transactions.php" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300">
          <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
            <path d="M0 64C0 46.3 14.3 32 32 32H96h16H288c17.7 0 32 14.3 32 32s-14.3 32-32 32H231.8c9.6 14.4 16.7 30.6 20.7 48H288c17.7 0 32 14.3 32 32s-14.3 32-32 32H252.4c-13.2 58.3-61.9 103.2-122.2 110.9L274.6 422c14.4 10.3 17.7 30.3 7.4 44.6s-30.3 17.7-44.6 7.4L13.4 314C2.1 306-2.7 291.5 1.5 278.2S18.1 256 32 256h80c32.8 0 61-19.7 73.3-48H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H185.3C173 115.7 144.8 96 112 96H96 32C14.3 96 0 81.7 0 64z" />
          </svg>
          <h2 class="mt-2 text-xl font-bold text-black">
            Manage Transactions
          </h2>
          <p class="mt-2 text-gray-600">View and manage all transactions.</p>
        </a>
        <a href="manage-permissions.php" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" viewBox="0 0 512 512">
            <path d="M256 0c4.6 0 9.2 1 13.4 2.9L457.7 82.8c22 9.3 38.4 31 38.3 57.2c-.5 99.2-41.3 280.7-213.6 363.2c-16.7 8-36.1 8-52.8 0C57.3 420.7 16.5 239.2 16 140c-.1-26.2 16.3-47.9 38.3-57.2L242.7 2.9C246.8 1 251.4 0 256 0zm0 66.8V444.8C394 378 431.1 230.1 432 141.4L256 66.8l0 0z" />
          </svg>
          <h2 class="mt-2 text-xl font-bold text-black">Permissions</h2>
          <p class="mt-2 text-gray-600">View and manage all permissions.</p>
        </a>

        <a href="old-tenants.php" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300">
          <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
            <path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
          </svg>
          <h2 class="mt-2 text-xl font-bold text-black">Old Tenants</h2>
          <p class="mt-2 text-gray-600">View and manage all old tenants.</p>
        </a>
      </div>
    </div>
  </div>
  <!--- ********************** Login Form *************************** -->




  <!--- **********************  FOOTER *************************** -->

  <?php
  // Nav BAR
  include '../partials/admin-footer.php';

  ?>

  <!--- ********************** FOOTER *************************** -->
</body>

</html>
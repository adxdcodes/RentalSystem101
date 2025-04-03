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

  <!--- ********************** Main Body *************************** -->
  <div class="flex justify-center flex-1 bg-gray-800 text-black">

    <body class="bg-gray-100">
      <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-6 text-white">Manage Transactions</h1>
        <!--- ********************** search bar *************************** -->

        <div class="relative w-full max-w-xs float-right">
          <input type="text" class="w-full px-4 py-2 text-gray-700 bg-white border rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Search..." />
          <button class="absolute top-0 right-0 mt-2 mr-2">
            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.35 4.35 7.5 7.5 0 0116.35 16.65z"></path>
            </svg>
          </button>
        </div>

        <!--- ********************** search bar *************************** -->

        <div class="mb-4">
          <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Add New Transaction</button>
        </div>



        <table class="min-w-full bg-white">
          <thead>
            <tr>
              <th class="py-2 px-4 border-b">ID</th>
              <th class="py-2 px-4 border-b">Tenant</th>
              <th class="py-2 px-4 border-b">Flat No</th>
              <th class="py-2 px-4 border-b">Due Date</th>
              <th class="py-2 px-4 border-b">Amount Paid</th>
              <th class="py-2 px-4 border-b">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Repeat this <tr> for each transaction -->
            <tr class="text-center">
              <td class="py-2 px-4 border-b">1</td>
              <td class="py-2 px-4 border-b">John Doe</td>
              <td class="py-2 px-4 border-b">K4</td>
              <td class="py-2 px-4 border-b">2023-12-31</td>
              <td class="py-2 px-4 border-b">$1200</td>
              <td class="py-2 px-4 border-b">
                <button class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600 transition duration-300">Details</button>
                <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 transition duration-300">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
  <!--- ********************** Main Body *************************** -->


  <!--- **********************  FOOTER *************************** -->
  <?php
  // Nav BAR
  include '../partials/admin-footer.php';
  ?>
  <!--- ********************** FOOTER *************************** -->


</html>
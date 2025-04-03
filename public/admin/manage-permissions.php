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

  <!--- ********************** Login Form *************************** -->

  <div class="flex justify-center flex-1 bg-gray-800">
    <section id="requests" class="my-8">
      <h2 class="text-xl font-semibold mb-4 text-white">Requests</h2>
      <div class="bg-white p-4 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Request ID
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Flat No
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                User
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Type
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Status
              </th>
              <th class="px-6 py-3 bg-gray-50"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Repeat this <tr> block for each request -->
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">001</td>
              <td class="px-6 py-4 whitespace-nowrap">K4</td>
              <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
              <td class="px-6 py-4 whitespace-nowrap">Add Tenant</td>
              <td class="px-6 py-4 whitespace-nowrap">Pending</td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button class="text-green-600 hover:text-green-900">
                  Approve
                </button>
                <button class="text-red-600 hover:text-red-900 ml-4">
                  Reject
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
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
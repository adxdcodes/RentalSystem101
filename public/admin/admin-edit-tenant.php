<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
  header("Location: admin.php");
  exit();
}
?>

<!-- #################### URL tid And to show which tenant are we editing ##########################  -->


<?php
// Example database connection
include '../partials/dbconnect.php'; // Include your database connection file

// Check if 'id' is set in the URL
if (isset($_GET['tid'])) {
  $tid = intval($_GET['tid']); // Sanitize the input
  $_SESSION['t_id'] = intval($_GET['tid']);



  // Prepare and execute the query
  $stmt = $conn->prepare("SELECT * FROM `tenants` WHERE tenant_id = ?");
  $stmt->bind_param("i", $tid);
  $stmt->execute();
  $result = $stmt->get_result();

  // Fetch the record
  if ($row = $result->fetch_assoc()) {
    $tname = htmlspecialchars($row['tenant_name']);
    $tdeposit = htmlspecialchars($row['t_deposit']);
    $taddress = htmlspecialchars($row['tenant_address']);
    $tjob = htmlspecialchars($row['tenant_job']);
    $tcont = htmlspecialchars($row['tenant_contact']);
    $tparent = htmlspecialchars($row['tenant_parent']);
    $parentCon = htmlspecialchars($row['parent_contact']);
    $tdoc1 = htmlspecialchars($row['tenant_doc_1']);
    $tdoc2 = htmlspecialchars($row['tenant_doc_2']);
  } else {
    $tname = 'Records Not found';
  }
} else {
  $tname = 'No ID provided';
}
?>
<!-- #################### URL tid And to show which tenant are we editing ##########################  -->



<!-- #################### SessionCurrentId to Flat to Tenants Using JOIN to show avail Tenants ##########################  -->


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tname = $_POST['name'];
  $tdepost = $_POST['inDeposit'];
  $taddress = $_POST['address'];
  $tjob = $_POST['occupation'];
  $tcont = $_POST['contact'];
  $tparent = $_POST['parentname'];
  $parentCon = $_POST['parentcontact'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
}

?>


<html>

</html>

<!-- #################### SessionCurrentId to Flat to Tenants Using JOIN to show avail Tenants ##########################  -->



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
  <div class="flex bg-gray-800 w-full justify-center pt-[2%]">
    <h1 class="font-bold text-5xl text-center text-white"><?php echo $_SESSION['current_flat']; ?></h1>
  </div>
  <div class="flex justify-center flex-1 bg-gray-800 w-full h-auto form-padding max-md:flex-col">
    <div class="bg-white p-8 shadow-md rounded-lg w-full sm:w-[550px]">
      <h2 class="text-2xl font-bold mb-4 text-center text-black">Add Info</h2>
      <form method="POST" action="admin-update-tenant.php" enctype="multipart/form-data">
        <div class="mb-4">
          <input type="text" id="tid" name="tid" placeholder="Tenant ID" value="<?php echo $tid; ?>" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm hidden" required />
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" id="name" name="name" placeholder="Full Name" value="<?php echo $tname; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>

        <div class="mb-6">
          <label for="inDeposit" class="block text-sm font-medium text-gray-700">Deposit</label>
          <input type="text" id="inDeposit" name="inDeposit" placeholder="Individual Deposit" value="<?php echo $tdeposit; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>

        <div class="mb-6">
          <label for="address" class="block text-sm font-medium text-gray-700">Full Address</label>
          <input type="text" id="address" name="address" placeholder="Full Address" value="<?php echo $taddress; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <div class="mb-4">
          <label for="Occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
          <input type="text" id="occupation" name="occupation" placeholder="occupation" value="<?php echo $tjob; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>

        <div class="mb-6">
          <label for="contact" class="block text-sm font-medium text-gray-700">Contact No</label>
          <input type="tel" id="contact" name="contact" placeholder="98765-43210" value="<?php echo $tcont; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <div class="mb-4">
          <label for="parentname" class="block text-sm font-medium text-gray-700">Parent Name</label>
          <input type="text" id="parentname" name="parentname" placeholder="Father name or Mother name" value="<?php echo $tparent; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>
        <div class="mb-6">
          <label for="parentcontact" class="block text-sm font-medium text-gray-700">Parent's Contact No</label>
          <input type="tel" id="parentcontact" name="parentcontact" placeholder="Parent's Contact No" value="<?php echo $parentCon; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
        </div>

        <div class="mb-6">
          <label for="id1" class="block text-sm font-medium text-gray-700">Your ID 1 (Aadhar Card)</label>

          <?php if (!empty($tdoc1)) : ?>
            <div class="text-sm mb-1">
              <span class="text-gray-600">Previously uploaded:</span>
              <a href="<?php echo $tdoc1; ?>" target="_blank" class="text-blue-600 underline">
                <?php echo basename($tdoc1); ?>
              </a>
            </div>
          <?php endif; ?>

          <input type="file" id="id1" name="id1"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
           focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div class="mb-6">
          <label for="id1" class="block text-sm font-medium text-gray-700">Your ID 2 (Corporate Or Educational!)</label>

          <?php if (!empty($tdoc2)) : ?>
            <div class="text-sm mb-1">
              <span class="text-gray-600">Previously uploaded:</span>
              <a href="<?php echo $tdoc2; ?>" target="_blank" class="text-blue-600 underline">
                <?php echo basename($tdoc2); ?>
              </a>
            </div>
          <?php endif; ?>

          <input type="file" id="id2" placeholder="Occupational ID" name="id2"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
           focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>


        <button type="submit" class="w-full bg-gray-500 text-white py-2 px-4 rounded-md focus:outline-none border-gray-600 border-[1.5px] duration-300 ease-in-out hover:text-white hover:bg-black hover:border-black">
          Submit
        </button>
        <p class="text-right pt-2 text-red-700 font-medium">All mandatory.</p>
      </form>
    </div>
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
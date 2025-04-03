<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
  header("Location: admin.php");
  exit();
}
?>
<!-- #################### URL sno to SessionCurrentId And to show in which flat are we ##########################  -->
<?php
// Example database connection
include '../partials/dbconnect.php'; // Include your database connection file

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
  $id = intval($_GET['id']); // Sanitize the input
  $_SESSION['current_id'] = intval($_GET['id']); // Sanitize the input


  // Prepare and execute the query
  $stmt = $conn->prepare("SELECT * FROM `users` WHERE sno = ?");
  $stmt->bind_param("i", $_SESSION['current_id']);
  $stmt->execute();
  $result = $stmt->get_result();

  // Fetch the record
  if ($row = $result->fetch_assoc()) {
    $flat = htmlspecialchars($row['flat']);
    $_SESSION['current_flat'] = $flat;
    $flat_type = htmlspecialchars($row['flat_type']);
    $_SESSION['flat_type'] = $flat_type;

    // $rent_due = htmlspecialchars($row['rent_due']);
    // Other fields as needed
  } else {
    header("Location:manage-apartments.php");
    $flat = 'Records Not found';
    $rent_due = 'Not found';
  }
} else {
  $flat = 'No ID provided';
  $rent_due = 'No ID provided';
}
?>
<!-- #################### URL sno to SessionCurrentId And to show in which flat are we ##########################  -->


<!-- #################### SessionCurrentId to Flat to Tenants Using JOIN to show avail Tenants ##########################  -->
<?php
$sno = $_SESSION['current_id'];

$sql = "SELECT tenants.tenant_id, tenants.tenant_name, tenants.tenant_job, tenants.tenant_contact, users.sno
        FROM tenants 
        JOIN users ON tenants.apartment_id = users.sno 
        WHERE users.sno = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // Bind the parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $tenants = $result->fetch_all(MYSQLI_ASSOC);
} else {
}
?>
<!-- #################### SessionCurrentId to Flat to Tenants Using JOIN to show avail Tenants ##########################  -->


<!-- #################### SessionCurrentId to apartments table fetch rent and due date ##########################  -->
<?php


// Fetching data from APARTMENTS TABLE

$stmt = $conn->prepare("SELECT * FROM `apartments` WHERE apartment_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the record
if ($row = $result->fetch_assoc()) {
  $apRent = htmlspecialchars($row['apartment_rent']);
  $apReading = htmlspecialchars($row['current_reading']);
  $apDeposit = htmlspecialchars($row['apartment_deposit']);
  $apEleRate = htmlspecialchars($row['electricity_rate']);
  $apMaintain = htmlspecialchars($row['apartment_maintainance']);
  $flatRentDate = $row['rent_date'];
} else {
  $apRent = 'Records Not found';
  $apReading = 'Records Not found';
}

?>

<!-- #################### SessionCurrentId to apartments table fetch rent and due date ##########################  -->



<!-- #################### CONFIRM TENANT DELETE ajax model ##########################  -->

<script>
  let tenantIdToDelete = null;
  let tenantToDelete = '';

  function openModal(tenantId, tenantName) {
    tenantIdToDelete = tenantId;
    tenantToDelete = tenantName;
    document.getElementById('tenantName').innerText = tenantName;
    document.getElementById('confirmModal').classList.remove('hidden');
    document.getElementById('confirmModal').classList.add('flex');
  }

  function closeModal() {
    document.getElementById('confirmModal').classList.add('hidden');
    document.getElementById('confirmModal').classList.remove('flex');
  }

  function confirmDelete() {
    fetch('move-tenant.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `tenant_id=${tenantIdToDelete}`
      })
      .then(response => response.text())
      .then(data => {
        // alert(data); // Show response message
        // document.getElementById(`tenant-${tenantIdToDelete}`).remove(); // Remove tenant from the list
        closeModal(); // Close the modal
      })
      .then(setTimeout(function() {
        location.reload();
      }, 20))
      .catch(error => {
        console.error('Error:', error);
      });
  }

  window.onclick = function(event) {
    if (event.target == document.getElementById('confirmModal')) {
      closeModal();
    }
  }
</script>

<!-- #################### CONFIRM TENANT DELETE ajax model ##########################  -->

<!-- #################### CONFIRM APARTMENT DELETE ajax model ##########################  -->

<script>
  let apartmentIdToDelete = null;
  let apartmentToDelete = '';

  function openModalAp(apartmentId, apartmentName) {
    apartmentIdToDelete = apartmentId;
    apartmentToDelete = apartmentName;
    document.getElementById('apartmentName').innerText = apartmentName;
    document.getElementById('confirmModalAp').classList.remove('hidden');
    document.getElementById('confirmModalAp').classList.add('flex');
  }

  function closeModalAp() {
    document.getElementById('confirmModalAp').classList.add('hidden');
    document.getElementById('confirmModalAp').classList.remove('flex');
  }

  window.onclick = function(event) {
    if (event.target == document.getElementById('confirmModalAp')) {
      closeModalAp();
    }
  }
</script>

<!-- #################### CONFIRM TENANT DELETE ajax model ##########################  -->

<!-- #################### CONFIRM APARTMENT RENEW ajax model ##########################  -->

<script>
  let apartmentIdToRenew = null;
  let apartmentToRenew = '';

  function openModalRenewAp(apartmentRenewId, apartmentRenewName) {
    apartmentIdToRenew = apartmentRenewId;
    apartmentToRenew = apartmentRenewName;
    document.getElementById('apartmentRenewName').innerText = apartmentRenewName;
    document.getElementById('confirmModalRenewAp').classList.remove('hidden');
    document.getElementById('confirmModalRenewAp').classList.add('flex');
  }

  function closeModalRenewAp() {
    document.getElementById('confirmModalRenewAp').classList.add('hidden');
    document.getElementById('confirmModalRenewAp').classList.remove('flex');
  }

  function confirmRenewAp() {
    fetch('renew-apartment.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `apartment_renew_id=${apartmentIdToRenew}`
      })

      .then(response => response.json())
      .then(data => {
        if (data.status === "success") {
          alert(data.message); // Show success message
          closeModalRenewAp(); // Close the modal
          location.reload(); // Refresh the page
        } else {
          alert(`Error: ${data.message}`); // Show error message
        }
      })
      .then(setTimeout(function() {
        location.reload();
      }, 20))
      .catch(error => {
        console.error('Error:', error);
      });
  }

  window.onclick = function(event) {
    if (event.target == document.getElementById('confirmModalRenewAp')) {
      closeModalRenewAp();
    }
  }
</script>

<!-- #################### CONFIRM APARTMENT RENEW ajax model ##########################  -->


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
  <div class="flex relative bg-gray-800 text-white w-full justify-center pt-[2%]">
    <h1 class="font-bold text-5xl text-center"><?php echo $flat; ?></h1>
    <div class="align-btns absolute right-1">
      <a class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] cursor-pointer font-medium text-white border-gray-600 border-2 rounded-[1px] duration-300 ease-in-out hover:text-red hover:bg-gray-700 hover:border-gray-700 hover:text-blue-400 focus:outline-none" href="admin-add-tenant.php" id="add-new-tenant">Add new Tenant</a>
      <a class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] cursor-pointer font-medium text-white border-gray-600 border-2 rounded-[1px] duration-300 ease-in-out hover:text-red hover:bg-gray-700 hover:border-gray-700 focus:outline-none" href="change-login.php">Change Login</a>
      <!-- <a class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] cursor-pointer font-medium text-white border-gray-600 border-2 rounded-[1px] duration-300 ease-in-out hover:text-red hover:bg-gray-700 hover:border-gray-700 focus:outline-none" id="renew-on">Renew Flat</a> -->
      <?php
      // Assume $tenant['tenant_id'] is numeric and $tenant['tenant_name'] is a string
      echo '<button onclick="openModalRenewAp(' . $id . ', \'' . addslashes($flat) . '\')" class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] cursor-pointer font-medium text-white hover:text-yellow-500 border-gray-600 border-2 rounded-[1px] duration-300 ease-in-out hover:text-red hover:bg-gray-700 hover:border-gray-700 focus:outline-red-500">Renew Flat</button>';
      ?>
      <?php
      // Assume $tenant['tenant_id'] is numeric and $tenant['tenant_name'] is a string
      echo '<button onclick="openModalAp(' . $id . ', \'' . addslashes($flat) . '\')" class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] cursor-pointer font-medium text-white hover:text-red-500 border-gray-600 border-2 rounded-[1px] duration-300 ease-in-out hover:text-red hover:bg-gray-700 hover:border-gray-700 focus:outline-red-500">Delete Flat</button>';
      ?>
    </div>
  </div>
  <div class="flex justify-between flex-1 bg-gray-800 text-white w-full h-full p-[7%] max-md:flex-col">

    <!-- this is name of flat -->

    <div class="user-table text-white w-3/5 max-md:w-full max-md:bg-red-900">
      <h2 class="font-bold text-2xl py-5">Members</h2>
      <table class="min-w-full border-2 text-white border-red-100">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Job</th>
            <th class="py-2 px-4 border-b">Contact</th>
            <th class="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Repeat this <tr> for each tenant -->


          <?php $counter = 1; ?>
          <?php if (isset($tenants)) : ?>
            <?php foreach ($tenants as $tenant) : ?>
              <tr class="text-center py-6">
                <td class="py-2 px-4 border-b"><?php echo $counter;
                                                $counter = $counter + 1; ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_name']); ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_job']); ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_contact']); ?></td>
                <td class="py-2 px-4 border-b">
                  <a href="admin-edit-tenant.php?tid=<?php echo htmlspecialchars($tenant['tenant_id']); ?>" class="cursor-pointer bg-yellow-500 text-black py-1 px-5 mx-1 rounded hover:bg-yellow-600 transition duration-300">
                    Edit
                  </a>
                  <a href="admin-show-details.php?tid=<?php echo htmlspecialchars($tenant['tenant_id']); ?>" target="_blank" class="cursor-pointer text-blue-500 py-1 px-5 mx-1 rounded border border-blue-500 hover:bg-blue-500 hover:text-white transition duration-300">
                    Details
                  </a>
                  <?php
                  // Assume $tenant['tenant_id'] is numeric and $tenant['tenant_name'] is a string
                  echo '<button onclick="openModal(' . $tenant['tenant_id'] . ', \'' . addslashes($tenant['tenant_name']) . '\')" class="bg-red-500 text-black py-1 cursor-pointer px-3 ml-2 rounded hover:bg-red-600 transition duration-300">Delete</button>';
                  ?>

                </td>
              </tr> <?php endforeach; ?>

          <?php else : ?>
            <tr class="text-center py-6">
              <td class="py-2 px-4 border-b"><?php echo $counter;
                                              $counter = $counter + 1; ?></td>
              <td class="py-2 px-4 border-b"><?php echo "No Tenants Found!"; ?></td>
              <td class="py-2 px-4 border-b"></td>
              <td class="py-2 px-4 border-b"></td>
              <td class="py-2 px-4 border-b">
                <a href="admin-add-tenant.php" class="cursor-pointer bg-yellow-500 text-black py-1 px-5 rounded hover:bg-yellow-600 transition duration-300">
                  Add Tenant
                </a>
              </td>
            </tr>
          <?php endif; ?>

        </tbody>
      </table>
    </div>
    <div class="w-2/5 text-gray-800 bg-white m-[5%] rounded-md py-[3%] text-center">
      <div class="flex justify-center">
        <svg class="svg-icon items-center mt-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
          <path d="M0 64C0 46.3 14.3 32 32 32H96h16H288c17.7 0 32 14.3 32 32s-14.3 32-32 32H231.8c9.6 14.4 16.7 30.6 20.7 48H288c17.7 0 32 14.3 32 32s-14.3 32-32 32H252.4c-13.2 58.3-61.9 103.2-122.2 110.9L274.6 422c14.4 10.3 17.7 30.3 7.4 44.6s-30.3 17.7-44.6 7.4L13.4 314C2.1 306-2.7 291.5 1.5 278.2S18.1 256 32 256h80c32.8 0 61-19.7 73.3-48H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H185.3C173 115.7 144.8 96 112 96H96 32C14.3 96 0 81.7 0 64z" />
        </svg>
        <h1 class="text-4xl font-bold">Rent!</h1>
      </div>

      <h1 class="text-4xl bg-white rounded-sm py-1 px-9"><?php echo "₹" . $apRent; ?></h1>
      <p class="mt-2 mb-6 text-gray-600 text-xl">Electricity reading : <?php echo $apReading; ?></p>
      <a href="manage-accounts.php?apId=<?php echo $id; ?>" class="text-center text-white mt-1 text-2xl bg-gray-800 py-3 px-9 rounded hover:bg-gray-700 hover:shadow-md outline-none transition duration-300">Manage
      </a>
      <a href="manage-transactions.php" class="text-center text-white mt-1 text-2xl bg-gray-800 py-3 px-9 ml-2 rounded hover:bg-gray-700 hover:shadow-md outline-none transition duration-300">Transactions
      </a>
    </div>
  </div>



  <!--- ********************** Delete PopUp *************************** -->

  <div id="confirmModal" class="fixed inset-0 hidden backdrop-blur-sm duration-200 ease-in-out bg-opacity-75 justify-center items-center">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full p-6">
      <h2 class="text-xl font-bold mb-4">Confirm Deletion</h2>
      <p>Are you sure you want to delete this tenant?</p>
      <h2 id="tenantName" class="font-bold"></h2>

      <div class="mt-4 flex justify-end">
        <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600  duration-200 text-white px-4 py-2 rounded mr-4">Cancel</button>
        <button onclick="confirmDelete()" class="bg-red-500 hover:bg-red-700 duration-200 text-white px-4 py-2 rounded">Delete</button>
      </div>
    </div>
  </div>
  <!--- ********************** Delete PopUp *************************** -->

  <!--- ********************** Delete Apartment Popup *************************** -->

  <div id="confirmModalAp" class="fixed inset-0 hidden backdrop-blur-sm duration-200 ease-in-out bg-opacity-75 justify-center items-center">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full p-6">
      <h2 class="text-xl font-bold mb-4">Confirm Deletion</h2>
      <p>Are you sure you want to delete this Apartment?</p>
      <h2 id="apartmentName" class="font-bold"></h2>

      <div class="mt-4 flex justify-end">
        <button onclick="closeModalAp()" class="bg-gray-500 hover:bg-gray-600  duration-200 text-white px-4 py-2 rounded mr-4">Cancel</button>
        <a class="bg-red-500 hover:bg-red-700 duration-200 text-white px-4 py-2 rounded" href="delete-apartment2.php?apId=<?php echo $id; ?>">Delete</a>
        <!-- <button onclick="confirmDeleteAp()" class="bg-red-500 hover:bg-red-700 duration-200 text-white px-4 py-2 rounded">Delete</button> -->
      </div>
    </div>
  </div>
  <!--- ********************** Delete Apartment PopUp *************************** -->

  <!--- ********************** Renew Apartment Popup *************************** -->

  <div id="confirmModalRenewAp" class="fixed inset-0 hidden backdrop-blur-sm duration-200 ease-in-out bg-opacity-75 justify-center items-center">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full p-6">
      <h2 class="text-xl font-bold mb-4">Confirm Renew</h2>
      <p>Are you sure you want to Renew/Reset this Apartment?</p>
      <h2 id="apartmentRenewName" class="font-bold"></h2>

      <div class="mt-4 flex justify-end">
        <button onclick="closeModalRenewAp()" class="bg-gray-500 hover:bg-gray-600  duration-200 text-white px-4 py-2 rounded mr-4">Cancel</button>
        <button onclick="confirmRenewAp()" class="bg-yellow-500 hover:bg-yellow-600 duration-200 text-white px-4 py-2 rounded">Renew</button>
      </div>
    </div>
  </div>
  <!--- ********************** Renew Apartment PopUp *************************** -->




  <!--- ********************** Main Body *************************** -->

  <!--- **********************  FOOTER *************************** -->

  <?php
  // Nav BAR
  include '../partials/admin-footer.php';

  ?>

  <!--- ********************** FOOTER *************************** -->



  <!--- **********************Script*************************** -->
  <script>
    document.getElementById("renew-on").addEventListener("click", () => {
      document.getElementById("pop-bg").classList.remove("hidden");
    });
    document.getElementById("renew-cross").addEventListener("click", () => {
      document.getElementById("pop-bg").classList.add("hidden");
    });
  </script>
  <!--- **********************Script*************************** -->


</body>

</html>
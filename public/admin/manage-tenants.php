<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
  header("Location: admin.php");
  exit();
}
?>

<?php
// Example database connection
include '../partials/dbconnect.php'; // Include your database connection file
?>

<?php
$limit = 20; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate offset
$search = isset($_GET['search']) ? $_GET['search'] : '';


$sql = "SELECT * FROM tenants LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

// Fetch the records
$tenants = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


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




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../../src/input.css" />
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <div class="container mx-auto p-8">
      <h1 class="text-3xl font-bold mb-6 text-white"><a href="old-tenants.php"> Manage Tenants</a></h1>
      <!--- ********************** search bar *************************** -->


      <div class="relative w-full max-w-xs float-right mb-4">
        <input name="search_text" id="search_text" type="text" class="w-full px-4 py-2 text-gray-700 bg-white border rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Search..." />
        <button class="absolute top-0 right-1 mt-2 mr-2">
          <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.35 4.35 7.5 7.5 0 0116.35 16.65z"></path>
          </svg>
        </button>
      </div>

      <div class="mb-4">
        <a class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300"
          href="admin-add-tenant-flat.php">
          Add New Tenant
        </a>
      </div>

      <!--- ********************** search bar *************************** -->
      <div class="mb-4"></div>
      <table class="searchResult min-w-full bg-white">
        <thead class="border-black border-b-2">
          <tr>
            <th class="py-2 px-4 border-b">No</th>
            <th class="py-2 px-4 border-b">Flat</th>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Job</th>
            <th class="py-2 px-4 border-b">Contact</th>
            <th class="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody class="searchResult" id="searchResult">

          <!-- Repeat this <tr> for each tenant -->


          <?php $counter = 1 + $offset; ?>
          <?php if (isset($tenants)) : ?>
            <?php foreach ($tenants as $tenant) : ?>
              <tr class="text-center <?php echo $counter % 2 == 0 ? 'bg-gray-100' : 'bg-white'; ?>">
                <td class="py-2 px-4 border-b"><?php echo $counter;
                                                $counter++; ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['apartment_name']); ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_name']); ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_job']); ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_contact']); ?></td>
                <td class="py-2 px-4 border-b">
                  <a href="admin-show-details.php?tid=<?php echo htmlspecialchars($tenant['tenant_id']); ?>" target="_blank" class="bg-yellow-500 text-black cursor-pointer py-1 mx-1 px-3 rounded hover:bg-yellow-600 transition duration-300">
                    Details
                  </a>

                  <?php
                  // Assume $tenant['tenant_id'] is numeric and $tenant['tenant_name'] is a string
                  echo '<button onclick="openModal(' . htmlspecialchars($tenant['tenant_id']) . ', \'' . addslashes(htmlspecialchars($tenant['tenant_name'])) . '\')" class="bg-red-500 text-black py-1 cursor-pointer px-3 rounded hover:bg-red-600 transition duration-300">Delete</button>';
                  ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>

            <tr class="text-center">
              <td class="py-2 px-4 border-b"><?php echo $counter;
                                              $counter = $counter + 1; ?></td>
              <td class="py-2 px-4 border-b">No records found!</td>
              <td class="py-2 px-4 border-b">No records found!</td>
              <td class="py-2 px-4 border-b">No records found!</td>
              <td class="py-2 px-4 border-b">
                <a class="bg-yellow-500 text-black cursor-pointer py-1 mx-1 px-3 rounded hover:bg-yellow-600 transition duration-300">
                  Details
                </a>

                <a class="bg-red-500 text-black py-1 cursor-pointer px-3 rounded hover:bg-red-600 transition duration-300">
                  Delete
                </a>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <?php
      // Get the total number of records
      $total_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM tenants");
      $total_records = mysqli_fetch_assoc($total_result)['count'];
      $total_pages = ceil($total_records / $limit);
      ?>

      <div class="flex justify-center mt-4">
        <?php if ($page > 1): ?>
          <a href="?page=<?php echo $page - 1;
                          echo isset($search) ? '&search=' . urlencode($search) : ''; ?>" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <a href="?page=<?php echo $i;
                          echo isset($search) ? '&search=' . urlencode($search) : ''; ?>" class="bg-<?php echo $page == $i ? 'gray-700' : 'blue-500'; ?> text-white py-2 px-4 mx-1 rounded hover:bg-blue-600 transition duration-300">
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
          <a href="?page=<?php echo $page + 1;
                          echo isset($search) ? '&search=' . urlencode($search) : ''; ?>" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">Next</a>
        <?php endif; ?>
      </div>

    </div>
  </div>
  <!--- ********************** Main Body *************************** -->

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


  <!--- **********************  FOOTER *************************** -->
  <?php
  // Nav BAR
  include '../partials/admin-footer.php';
  ?>
  <!--- ********************** FOOTER *************************** -->



  <!-- #################### SHOW Search results on typing ajax model ##########################  -->
  <script>
    $(document).ready(function() {
      $(' #search_text').on('keyup', function() {
        var txt = $(this).val();
        if (txt === '') {
          $.ajax({
            url: "fetch-all-tenants.php", // Create a new PHP file to handle fetching all tenants
            method: "get",
            dataType: "html",
            success: function(data) {
              $('#searchResult').html(data);
            }
          });

        } else {
          $.ajax({
            url: "search-tenants.php",
            method: "POST",
            data: {
              search: txt
            },
            dataType: "html",
            success: function(data) {
              $('#searchResult').html(data); // Update the table with the search results
            },
            error: function(xhr, status, error) {
              console.error('AJAX Error:', status, error); // Log any errors
            }
          });
        }
      });
    });
  </script>
  <!-- #################### SHOW Search results on typing ajax model ##########################  -->

</body>

</html>
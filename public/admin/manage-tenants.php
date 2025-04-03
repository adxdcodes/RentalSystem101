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




//########################### for showing 20 results per page and Managing pagination ###############################//

$limit = 20; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate offset

// Modify your SQL query to use LIMIT and OFFSET
$sql = "SELECT * FROM tenants LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

// Fetch the records
$tenants = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>





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
      <h1 class="text-3xl font-bold mb-6 text-white">Manage Tenants</h1>
      <!--- ********************** search bar *************************** -->

      <div class="relative w-full max-w-xs mb-4 float-right">
        <input name="search_text" id="search_text" type="text" class="w-full px-4 py-2 text-gray-700 bg-white border rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Search..." />
        <button class="absolute top-0 right-1 mt-2 mr-2">
          <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.35 4.35 7.5 7.5 0 0116.35 16.65z"></path>
          </svg>
        </button>
      </div>

      <!--- ********************** search bar *************************** -->
      <div class="mb-4">
        <a class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300"
          href="admin-add-tenant-flat.php">
          Add New Tenant
        </a>
      </div>

      <table class="searchResult min-w-full bg-white">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Flat</th>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Job</th>
            <th class="py-2 px-4 border-b">Contact</th>
            <th class="py-2 px-4 border-b">Actions</th>
          </tr>
        </thead>
        <tbody class="searchResult" id="searchResult">
          <?php if (isset($tenants)) : ?>
            <?php foreach ($tenants as $index => $tenant): ?>
              <tr class="text-center <?php echo $index % 2 == 0 ? 'bg-gray-100' : 'bg-white'; ?>">
                <td class="py-2 px-4 border-b"><?php echo $index + 1; ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['apartment_name']); ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_name']); ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_job']); ?></td>
                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_contact']); ?>

                </td>
                <td class="py-2 px-4 border-b">
                  <a href="admin-show-details.php?tid=<?php echo htmlspecialchars($tenant['tenant_id']); ?>" target="_blank" class="bg-yellow-500 text-black cursor-pointer py-1 mx-1 px-3 rounded hover:bg-yellow-600 transition duration-300">
                    Details
                  </a>
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
              <td class="py-2 px-4 border-b">No records found!</td>
              <td class="py-2 px-4 border-b">
                No Records!
            </tr>


          <?php endif; ?>
        </tbody>
      </table>




      <!-- ******************* managing pagings ************************  -->
      <?php
      // Get the total number of records
      $total_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM tenants");
      $total_records = mysqli_fetch_assoc($total_result)['count'];
      $total_pages = ceil($total_records / $limit);
      ?>

      <div class="flex justify-center mt-4">
        <?php if ($page > 1): ?>
          <a href="?page=<?php echo $page - 1; ?>" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <a href="?page=<?php echo $i; ?>" class="bg-<?php echo $page == $i ? 'gray-700' : 'blue-500'; ?> text-white py-2 px-4 mx-1 rounded hover:bg-blue-600 transition duration-300">
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
          <a href="?page=<?php echo $page + 1; ?>" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">Next</a>
        <?php endif; ?>
      </div>

    </div>
  </div>
  <!--- ********************** Main Body *************************** -->


  <!--- **********************  FOOTER *************************** -->
  <?php
  // Nav BAR
  include '../partials/admin-footer.php';
  ?>
  <!--- ********************** FOOTER *************************** -->



  <!-- ################################# FOR SEARCHING ON LIVE TYPING ########################## -->

  <script>
    $(document).ready(function() {
      let currentPage = 1;

      function load_data(page, search) {
        $.ajax({
          url: search ? "search-tenants.php" : "fetch-all-tenants.php",
          method: "POST",
          data: {
            search: search,
            page: page
          },
          dataType: "html",
          success: function(data) {
            $('#searchResult').html(data);
            currentPage = page; // Update the current page
          },
          error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error); // Log any errors
          }
        });
      }

      $('#search_text').on('keyup', function() {
        var search = $(this).val();
        load_data(1, search); // Always reset to page 1 on new search
      });

      $(document).on('click', '.pagination_link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        var search = $('#search_text').val();
        load_data(page, search); // Load data for the selected page
      });

      // Initial load of the first page
      load_data(1, '');
    });
  </script>
  <!-- ################################# FOR SEARCHING ON LIVE TYPING ########################## -->



</body>

</html>
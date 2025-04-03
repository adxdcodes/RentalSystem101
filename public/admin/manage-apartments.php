<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
  header("Location: admin.php");
  exit();
}
?>

<?php
require '../partials/dbconnect.php';
$sql = "SELECT * FROM `users` ORDER BY `flat` ASC";
$result = $conn->query($sql); // same as $result = mysqli_query($conn, $sql);

// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $_SESSION['which_flat'] = $row['sno'];
//   }
// }


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
  <div class="flex justify-center flex-1 bg-gray-800 text-white">
    <div class="container mx-auto p-8">
      <h1 class="text-4xl font-bold mb-6">Manage apartment</h1>
      <!--- ********************** search bar *************************** -->

      <div class="relative w-full max-w-xs float-right">
        <input name="search_text" id="search_text" type="text" class="w-full px-4 py-2 text-gray-700 bg-white border rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Search..." />
        <button class="absolute top-0 right-1 mt-2 mr-2">
          <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.35 4.35 7.5 7.5 0 0116.35 16.65z"></path>
          </svg>
        </button>
      </div>

      <!--- ********************** search bar *************************** -->
      <div class="mb-8">
        <a href="add-flat.php">
          <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
            Add New Apartment
          </button>
        </a>
      </div>
      <div id="searchResult" class="searchResult grid grid-4 gap-6">
        <?php

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <a href="about-apartments.php?id=<?php echo htmlspecialchars($row['sno']); ?>" class="group block p-6 hover:shadow-xl bg-white rounded-lg shadow-md transition duration-300">
              <p class="mt-2 font-bold duration-200 text-gray-700 text-[40px] text-center hover:text-black"><?php echo htmlspecialchars($row['flat']); ?></p>
              <p class="mt-2 duration-300 ease-in-out text-gray-600 text-center">See more details!

              </p>
            </a>

        <?php
          }
        } else {
          echo '<p class="text-center text-gray-600">No apartments found.</p>';
        }

        ?>
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

</body>

</html>

<!-- ################################# FOR SEARCHING ON LIVE TYPING ########################## -->

<script>
  $(document).ready(function() {
    $(' #search_text').on('keyup', function() {
      var txt = $(this).val();
      if (txt === '') {
        $.ajax({
          url: "fetch-all-apartments.php", // Create a new PHP file to handle fetching all tenants
          method: "get",
          dataType: "html",
          success: function(data) {
            $('#searchResult').html(data);
          }
        });

      } else {
        $.ajax({
          url: "search-apartment.php",
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
<!-- ################################# FOR SEARCHING ON LIVE TYPING ########################## -->
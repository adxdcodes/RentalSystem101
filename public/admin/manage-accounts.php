<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}
?>

<!-- #################### URL apId And to show which apartment are we assigning rent ##########################  -->


<?php
// Example database connection
include '../partials/dbconnect.php'; // Include your database connection file

// Check if 'id' is set in the URL
if (isset($_GET['apId'])) {
    $apId = intval($_GET['apId']); // Sanitize the label
    $_SESSION['apId'] = $apId;




    // Fetching data from USERS TABLE
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE sno = ?");
    $stmt->bind_param("i", $apId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the record
    if ($row = $result->fetch_assoc()) {
        $flat = htmlspecialchars($row['flat']);
        $_SESSION['apName'] = $flat;
        $flatType = htmlspecialchars($row['flat_type']);
        $_SESSION['apType'] = $flatType;
        $rawFlatCreateDate = $row['dt'];
        $flatCreateDate = date('Y-m-d', strtotime($rawFlatCreateDate));
    } else {
        $flat = 'Records Not found';
    }

    // Fetching data from APARTMENTS TABLE

    $stmt = $conn->prepare("SELECT * FROM `apartments` WHERE apartment_id = ?");
    $stmt->bind_param("i", $apId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the record
    if ($row = $result->fetch_assoc()) {
        $apRent = htmlspecialchars($row['apartment_rent']);
        $apDeposit = htmlspecialchars($row['apartment_deposit']);
        $apMaintain = htmlspecialchars($row['apartment_maintainance']);
        $flatRentDate = $row['rent_date'];
        $cReading = htmlspecialchars($row['current_reading']);
        $lReading = htmlspecialchars($row['last_reading']);
        $apEleRate = htmlspecialchars($row['electricity_rate']);
        $apEleCharges = htmlspecialchars($row['electricity_charges']);
        $rawLastUpdatedOn = htmlspecialchars($row['updated_at']);
        $lastUpdatedOn = date('Y-m-d', strtotime($rawLastUpdatedOn));
        $totalRent = htmlspecialchars($row['total_rent']);
    } else {
        $apRent = NULL;
        $apDeposit = NULL;
        $apEleRate = NULL;
        $apMaintain = NULL;
        $flatRentDate = NULL;
        $cReading = NULL;
        $lReading = NULL;
        $apEleRate = NULL;
        $apEleCharges = NULL;
        $lastUpdatedOn = 'First time, Enter the data!';
        $totalRent = NULL;
    }
} else {
    $flat = 'No ID provided';
    header("Location:manage-apartments.php");
}


$usage = $cReading - $lReading;    // calculates the current usage.

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
    <div class="flex flex-col justify-center flex-1 bg-gray-800 text-white">
        <div class="flex relative bg-gray-800 text-white w-full justify-center pt-[2%]">
            <h1 class="font-bold text-5xl text-center mb-6"><?php echo $flat; ?></h1>
            <div class="align-btns absolute right-2">
                <a class="my-[33px] mx-[5px] px-5 py-[7px] text-[18px] cursor-pointer font-medium text-white border-gray-600 border-2 rounded-[1px] duration-300 ease-in-out hover:text-red hover:bg-gray-700 hover:border-gray-700 focus:outline-none" href="about-apartments.php?id=<?php echo $apId; ?>">Go Back</a>
            </div>
        </div>


        <!--- ********************** Login Form *************************** -->

        <div class="flex justify-center items-center flex-1 bg-gray-800 mb-6">
            <div class="bg-white p-8 shadow-md rounded-lg w-[60%]">
                <h2 class="text-2xl text-black font-bold mb-6 text-center">
                    Rental Details
                </h2>
                <form class="text-black" action="update-rentals.php" method="POST">
                    <div class="mb-6 flex justify-center items-center">
                        <div class="w-1/2">
                            <input
                                type="text"
                                id="ownerId"
                                value="<?php echo $ownerId; ?>"
                                name="ownerId"
                                class="mt-1 hidden w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required />
                            <label for="rentdate" class="text-sm font-medium text-gray-700">Rent Date
                                <p class="inline text-red-600">*</p>
                            </label>
                            <input
                                type="date"
                                id="rentdate"
                                value="<?php echo $flatRentDate; ?>"
                                name="rentdate"
                                placeholder="Password"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="mb-4 w-full">
                            <label
                                for="deposit"
                                class="block text-sm font-medium text-gray-700">Deposit Amount
                                <h2 class="inline text-red-600">*</h2>
                            </label>
                            <input
                                type="text"
                                id="deposit"
                                value="<?php echo $apDeposit; ?>"
                                name="deposit"
                                placeholder="Flat Deposit"
                                class="mt-1 block max-w-full min-w-[90%] px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required />
                        </div>

                        <div class="mb-4 w-full">
                            <label
                                for="rent"
                                class="block text-sm font-medium text-gray-700">Rent Amount
                                <h2 class="inline text-red-600">*</h2>
                            </label>
                            <input
                                type="text"
                                id="rent"
                                value="<?php echo $apRent; ?>"
                                name="rent"
                                placeholder="Flat Rent"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                oninput="calculateTotal ()"
                                required />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="mb-4 w-full">
                            <label
                                for="creading"
                                class="block text-sm font-medium text-gray-700">Current Readings
                                <h2 class="inline text-red-600">*</h2>
                            </label>
                            <input
                                type="text"
                                id="creading"
                                name="creading"
                                placeholder="Current Readings"
                                class="mt-1 block max-w-full min-w-[90%] px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                oninput="calculateReading()"
                                required />
                        </div>

                        <div class="mb-4 w-full">
                            <label
                                for="lreading"
                                class="block text-sm font-medium text-gray-700">Last Readings
                                <p class="inline text-red-600">*</p>
                            </label>
                            <input
                                type="text"
                                id="lreading"
                                value="<?php echo $cReading; ?>"
                                name="lreading"
                                placeholder="Last Readings"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                oninput="calculateReading()"
                                required />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="mb-4 w-full">
                            <label
                                for="usage"
                                class="block text-sm font-medium text-gray-700">Total Usage (Units)
                                <p class="inline text-red-600">*</p>
                            </label>
                            <input
                                type="text"
                                id="usage"
                                value="<?php echo $usage; ?>"
                                name="usage"
                                placeholder="Electricity Used"
                                class="mt-1 block select-none cursor-not-allowed max-w-full min-w-[90%] px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required
                                readonly />
                        </div>

                        <div class="mb-4 w-full">
                            <label
                                for="rateperunit"
                                class="block text-sm font-medium text-gray-700">Rate (Per Unit)
                                <p class="inline text-red-600">*</p>
                            </label>
                            <input
                                type="text"
                                id="rateperunit"
                                value="<?php echo $apEleRate; ?>"
                                name="rateperunit"
                                placeholder="Rate Per Unit"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                oninput="calEleCharges()"
                                required />
                        </div>
                    </div>

                    <div class="mb-6">
                        <label
                            for="electricitycharges"
                            class="block text-sm font-medium text-gray-700">Electricity charges
                            <p class="inline text-red-600">*</p>
                        </label>
                        <input
                            type="text"
                            id="electricitycharges"
                            value="<?php echo $apEleCharges; ?>"
                            name="electricitycharges"
                            placeholder="Electricity Charges"
                            class="mt-1 block cursor-not-allowed w-[45%] px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            oninput="calculateTotal ()"
                            required readonly />
                    </div>
                    <div class="mb-6 flex justify-center items-center">
                        <div class="w-1/2">
                            <label
                                for="total"
                                class="block text-sm font-medium text-gray-700">Total to Pay
                                <p class="inline text-red-600">*</p>
                            </label>
                            <input
                                type="text"
                                id="total"
                                value="<?php echo  $totalRent; ?>"
                                name="total"
                                placeholder="total"
                                class="mt-1 block font-bold w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required />
                        </div>
                    </div>
                    <div class="mb-6 font-bold">
                        Last updated on <p class="text-red-500 inline underline"> <?php echo $lastUpdatedOn; ?></p> !
                    </div>
                    <div class="w-full flex justify-center">
                        <button
                            id="submit-btn"
                            type="submit"
                            class="w-[30%] text-black bg-yellow-500 font-bold py-2 px-4 rounded-md focus:outline-none border-yellow-600 border-[1.5px] duration-300 ease-in-out hover:bg-yellow-600">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--- ********************** Login Form *************************** -->

    </div>
    <!--- ********************** Main Body *************************** -->


    <!--- **********************  FOOTER *************************** -->
    <?php
    // Nav BAR
    include '../partials/admin-footer.php';
    ?>
    <!--- ********************** FOOTER *************************** -->

</body>
<script>
    function calculateReading() {
        // Get the values from input1 and input2
        var cReading = parseFloat(document.getElementById('creading').value) || 0;
        var lReading = parseFloat(document.getElementById('lreading').value) || 0;

        // Perform the calculation
        var usage = cReading - lReading;

        // Get references to the usage field and button
        var usageField = document.getElementById('usage');
        const updateButton = document.getElementById("submit-btn");

        // Check if usage is negative
        if (usage < 0) {
            // Change text color to red and set error message
            usageField.classList.add('text-red-500', 'font-bold');
            usageField.value = 'Enter Valid Readings!';

            // Disable the button and update its class
            updateButton.disabled = true;
            updateButton.classList.add('cursor-not-allowed');
        } else {
            // Remove error styling and set the usage value
            usageField.classList.remove('text-red-500', 'font-bold');
            usageField.value = usage;

            // Enable the button and remove the disabled class
            updateButton.disabled = false;
            updateButton.classList.remove('cursor-not-allowed');
        }
        calEleCharges();
    }




    function calEleCharges() {
        // Get the values from input1 and input2
        var usage = parseFloat(document.getElementById('usage').value) || 0;
        var electricityRate = parseFloat(document.getElementById('rateperunit').value) || 0;

        // Perform the calculation (for example, addition)
        var eleCharges = usage * electricityRate;

        // Set the result value in the result input field
        document.getElementById('electricitycharges').value = eleCharges;
        calculateTotal();

    }

    function calculateTotal() {
        // Get the values from input1 and input2
        var rent = parseFloat(document.getElementById('rent').value) || 0;
        var eleCharges = parseFloat(document.getElementById('electricitycharges').value) || 0;

        // Perform the calculation (for example, addition)
        var totalRent = rent + eleCharges;

        // Set the result value in the result input field
        document.getElementById('total').value = totalRent;

    }


    var lReading = document.getElementById('lreading');
    var readingValue = lReading.value;
    if (readingValue !== null && readingValue !== "" && parseFloat(readingValue) !== 0) {
        lReading.classList.add('cursor-not-allowed');
        lReading.setAttribute('readonly', true); // Add the readonly attribute
    }
</script>

</html>
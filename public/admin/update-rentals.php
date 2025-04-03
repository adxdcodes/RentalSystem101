<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}

include '../partials/dbconnect.php'; // Include your database connection file

// if (isset($_GET['apId'])) {
//     $apId = intval($_GET['apId']); // Sanitize the input
//     $_SESSION['apId'] = $apId; // Sanitize the input

//     // Prepare and execute the query
//     $stmt = $conn->prepare("SELECT * FROM `users` WHERE sno = ?");
//     $stmt->bind_param("i", $apId);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     // Fetch the record
//     if ($row = $result->fetch_assoc()) {
//         $apName = htmlspecialchars($row['flat']);
//         $apType = htmlspecialchars($row['flat_type']);
//     } else {
//         echo "Id got but no match";
//         // header("Location:manage-apartments.php");
//         exit();
//     }
// } else {
//     // header("Location:manage-apartments.php");
//     echo $apId;
//     echo "Id not found!";
//     echo $_SERVER['REQUEST_METHOD'];
//     exit();
// }

// #################### Post method to update into various tables ##########################
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get form data and sanitize it
    $apId = $_SESSION['apId'];
    $ownerId = 2;
    $apName = $_SESSION['apName'];
    $apType = $_SESSION['apType'];
    $apRent = $_POST['rent'];
    $apDeposit = $_POST['deposit'];
    $cReading = $_POST['creading'];
    $lReading = $_POST['lreading'];
    $usage = $_POST['usage'];
    $apEleRate = $_POST['rateperunit'];
    $apEleCharges = $_POST['electricitycharges'];
    $totalRent = $_POST['total'];
    $flatRentDate = $_POST['rentdate'];


    // Check if record exists
    $query = "SELECT * FROM `apartments` WHERE apartment_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $apId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update record
        $stmt = $conn->prepare("UPDATE `apartments` 
            SET apartment_name = ?, 
                ap_type = ?, 
                apartment_rent = ?, 
                apartment_deposit = ?, 
                current_reading = ?, 
                last_reading = ?, 
                electricity_usage = ?, 
                electricity_rate = ?, 
                electricity_charges = ?, 
                total_rent = ?, 
                rent_date = ? 
            WHERE apartment_id = ?");

        $stmt->bind_param("ssiiiiiiiisi", $apName, $apType, $apRent, $apDeposit, $cReading, $lReading, $usage, $apEleRate, $apEleCharges, $totalRent, $flatRentDate, $apId);

        if ($stmt->execute()) {
            echo "Record updated successfully.";
            // Redirect to manage accounts or another page
            header("Location: manage-accounts.php?apId=$apId");
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    } else {
        // Insert record
        $stmt = $conn->prepare("INSERT INTO `apartments` 
            (owner_id, apartment_id, apartment_name, ap_type, apartment_rent, apartment_deposit, current_reading, last_reading, electricity_usage, electricity_rate, electricity_charges, total_rent, rent_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("iissiiiiiiiis", $ownerId, $apId, $apName, $apType, $apRent, $apDeposit, $cReading, $lReading, $usage, $apEleRate, $apEleCharges, $totalRent, $flatRentDate);

        if ($stmt->execute()) {
            echo "New record created successfully.";
            // Redirect to manage accounts or another page
            header("Location: manage-accounts.php?apId=$apId");
            exit();
        } else {
            echo "Error inserting record: " . $stmt->error;
        }
    }
}
// #################### Post method to update into various tables ##########################

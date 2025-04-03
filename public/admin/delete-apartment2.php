<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}

include '../partials/dbconnect.php';

echo "Hello";

if (isset($_GET['apId'])) {
    $apId = intval($_GET['apId']); // Sanitize the input

    echo $apId;
    $stmt = $conn->prepare("INSERT INTO apartments_rec (apartment_id, owner_id, apartment_name, ap_type, apartment_rent, apartment_deposit, current_reading, last_reading, electricity_usage, electricity_rate, electricity_charges, total_rent, rent_date, apartment_maintainance, created_at, updated_at) SELECT apartment_id, owner_id, apartment_name, ap_type, apartment_rent, apartment_deposit, current_reading, last_reading, electricity_usage, electricity_rate, electricity_charges, total_rent, rent_date, apartment_maintainance, created_at, updated_at FROM apartments WHERE apartment_id = ?");
    $stmt->bind_param("i", $apId);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM apartments WHERE apartment_id = ?");
    $stmt->bind_param("i", $apId);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM users WHERE sno = ?");
    $stmt->bind_param("i", $apId);
    $stmt->execute();



    if ($stmt->execute()) {
        header("Location:manage-apartments.php");
    } else {
        echo "Failed to delete the flat!";
    }
} else {
    echo "No Id is provided!";
    header("Location:manage-apartments.php");
}

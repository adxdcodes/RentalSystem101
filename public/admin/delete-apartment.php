<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}

include '../partials/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apartment_id = intval($_POST['apartment_id']); // Sanitize input
    // Start a transaction
    $conn->begin_transaction();

    if ($apartment_id != NULL) {
        // Delete tenant data from apartments table
        $stmt = $conn->prepare("DELETE FROM apartments WHERE apartment_id = ?");
        $stmt->bind_param("i", $apId);
        $stmt->execute();

        // Delete tenant data from users table
        $stmt = $conn->prepare("DELETE FROM users WHERE sno = ?");
        $stmt->bind_param("i", $apartment_id);


        // Execute and check for success
        if ($stmt->execute()) {
            $conn->commit();
            $stmt->close();
            // Redirect to manage-apartments.php
?>
            <script>
                location.reload();
            </script>
<?php

            header("Location: manage-apartments.php");
            exit();
        } else {
            $conn->rollback();
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete apartment.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Apartment ID not provided.']);
    }
}

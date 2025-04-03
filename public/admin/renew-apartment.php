<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}

include '../partials/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apartment_renew_id = intval($_POST['apartment_renew_id']); // Sanitize input

    // Start a transaction
    $conn->begin_transaction();

    if ($apartment_renew_id != NULL) {
        // Move tenants data from tenants to oldTenants table
        $stmt = $conn->prepare("INSERT INTO oldtenants (tenant_id, apartment_id, apartment_name, tenant_name, tenant_address, tenant_job, tenant_contact, tenant_parent, parent_contact, tenant_doc_1, tenant_doc_2) SELECT tenant_id, apartment_id, apartment_name, tenant_name, tenant_address, tenant_job, tenant_contact, tenant_parent, parent_contact, tenant_doc_1, tenant_doc_2 FROM tenants WHERE apartment_id = ?");
        $stmt->bind_param("i", $apartment_renew_id);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM tenants WHERE apartment_id = ?");
        $stmt->bind_param("i", $apartment_renew_id);
        $stmt->execute();
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

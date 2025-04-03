<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}
?>

<?php
include '../partials/dbconnect.php';
?>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tenant_id = intval($_POST['tenant_id']); // Sanitize input

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Move tenant data to oldtenants table
        $stmt = $conn->prepare("INSERT INTO oldtenants (tenant_id, apartment_id, apartment_name, tenant_name, tenant_address, tenant_job, tenant_contact, tenant_parent, parent_contact, tenant_doc_1, tenant_doc_2) SELECT tenant_id, apartment_id, apartment_name, tenant_name, tenant_address, tenant_job, tenant_contact, tenant_parent, parent_contact, tenant_doc_1, tenant_doc_2 FROM tenants WHERE tenant_id = ?");
        $stmt->bind_param("i", $tenant_id);
        $stmt->execute();

        // Delete tenant data from tenants table
        $stmt = $conn->prepare("DELETE FROM tenants WHERE tenant_id = ?");
        $stmt->bind_param("i", $tenant_id);
        $stmt->execute();

        // Commit transaction
        $conn->commit();
        //    SESSION TO DISPLAY TENANT DELETED!
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $conn->rollback();
        echo "Failed to move tenant: " . $e->getMessage();
    }
}
?>

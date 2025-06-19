<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}
include '../partials/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tenant_id = intval($_POST['tenant_id']);

    $conn->begin_transaction();

    try {
        // Get file paths from DB before deleting
        $query = "SELECT tenant_doc_1, tenant_doc_2 FROM oldtenants WHERE oldtenantid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $tenant_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($tenant = $result->fetch_assoc()) {
            $doc1 = $tenant['tenant_doc_1'];
            $doc2 = $tenant['tenant_doc_2'];

            if (file_exists($doc1) && !unlink($doc1)) {
                throw new Exception("Failed to delete file: $doc1");
            }
            if (file_exists($doc2) && !unlink($doc2)) {
                throw new Exception("Failed to delete file: $doc2");
            }
        }

        // Delete tenant
        $stmt = $conn->prepare("DELETE FROM oldtenants WHERE oldtenantid = ?");
        $stmt->bind_param("i", $tenant_id);
        $stmt->execute();

        $conn->commit();

        $_SESSION['success'] = "Tenant and files deleted.";
        header("Location: manage-old-tenants.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Failed to delete tenant: " . $e->getMessage();
    }
}

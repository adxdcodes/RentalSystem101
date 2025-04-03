<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}

include '../partials/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get form data
    $apartmentId = $_POST['apartmentId'];
    $apartmentName = $_POST['apartmentName'];
    $tname = $_POST['name'];
    $tdeposit = $_POST['inDeposit'];
    $taddress = $_POST['address'];
    $tjob = $_POST['occupation'];
    $tcont = $_POST['contact'];
    $tparent = $_POST['parentname'];
    $parentCon = $_POST['parentcontact'];

    // Assign a unique ID for file naming
    $tid = $tname;  // Assuming tenant's name is unique (adjust as needed)

    $upload_dir = '../uploads/';

    // Handle file upload for id1 (Aadhar Card)
    $file_path1 = isset($_POST['id1']) ? $_POST['id1'] : null;  // Default to null if not set
    if (isset($_FILES['id1']) && $_FILES['id1']['error'] == 0) {
        $file_tmp = $_FILES['id1']['tmp_name'];
        $file_ext = pathinfo($_FILES['id1']['name'], PATHINFO_EXTENSION);
        $new_file_name1 = $tid . "_Aadhar_" . time() . "." . $file_ext;
        $file_path1 = $upload_dir . $new_file_name1;

        if (!move_uploaded_file($file_tmp, $file_path1)) {
            echo "Error uploading Aadhar Card.";
        }
    }

    // Handle file upload for id2 (Corporate/Educational ID)
    $file_path2 = isset($_POST['id2']) ? $_POST['id2'] : null;  // Default to null if not set
    if (isset($_FILES['id2']) && $_FILES['id2']['error'] == 0) {
        $file_tmp = $_FILES['id2']['tmp_name'];
        $file_ext = pathinfo($_FILES['id2']['name'], PATHINFO_EXTENSION);
        $new_file_name2 = $tid . "_ID_" . time() . "." . $file_ext;
        $file_path2 = $upload_dir . $new_file_name2;

        if (!move_uploaded_file($file_tmp, $file_path2)) {
            echo "Error uploading Corporate/Educational ID.";
        }
    }

    // Prepare an insert statement
    $stmt = $conn->prepare("INSERT INTO `tenants` (apartment_id, apartment_name, tenant_name, t_deposit, tenant_address, tenant_job, tenant_contact, tenant_parent, parent_contact, tenant_doc_1, tenant_doc_2)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ississisiss", $apartmentId, $apartmentName, $tname, $tdeposit, $taddress, $tjob, $tcont, $tparent, $parentCon, $file_path1, $file_path2);

    // Check if the tenant already exists
    $query = "SELECT * FROM `tenants` WHERE tenant_name = '$tname' OR tenant_contact = '$tcont'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "User already exists!";
?>
        <a href="admin-add-tenant.php"> Go back</a>
    <?php
    } else {
        // Execute the prepared statement
        if ($stmt->execute()) {
            header("Location: about-apartments.php?id=$apartmentId");
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Invalid request method.";
    ?>
    <a href="admin-add-tenant.php"> Go back</a>
<?php
}
?>
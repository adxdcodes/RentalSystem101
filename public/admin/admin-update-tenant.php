<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}
?>

<!-- #################### To update the selected Tenant ##########################  -->


<?php
include '../partials/dbconnect.php'; // include your database connection file

// Get form data
$apartmentId = $_SESSION['current_id'];
$tid = $_SESSION['t_id'];
$tname = $_POST['name'];
$tdeposit = $_POST['inDeposit'];
$taddress = $_POST['address'];
$tjob = $_POST['occupation'];
$tcont = $_POST['contact'];
$tparent = $_POST['parentname'];
$parentCon = $_POST['parentcontact'];



$upload_dir = '../uploads/';

// Handle file upload for id1 (Aadhar Card)
if (isset($_FILES['id1']) && $_FILES['id1']['error'] == 0) {
    $file_tmp = $_FILES['id1']['tmp_name'];
    $file_ext = pathinfo($_FILES['id1']['name'], PATHINFO_EXTENSION);
    $new_file_name1 = $tid . "_Aadhar_" . time() . "." . $file_ext;
    $file_path1 = $upload_dir . $new_file_name1;

    // Move uploaded file to the destination folder
    if (!move_uploaded_file($file_tmp, $file_path1)) {
        echo "Error uploading Aadhar Card.";
    }
} else {
    $file_path1 = $_POST['id1']; // Keep the existing value if no new file is uploaded
}

// Handle file upload for id2 (Corporate/Educational ID)
if (isset($_FILES['id2']) && $_FILES['id2']['error'] == 0) {
    $file_tmp = $_FILES['id2']['tmp_name'];
    $file_ext = pathinfo($_FILES['id2']['name'], PATHINFO_EXTENSION);
    $new_file_name2 = $tid . "_ID_" . time() . "." . $file_ext;
    $file_path2 = $upload_dir . $new_file_name2;

    // Move uploaded file to the destination folder
    if (!move_uploaded_file($file_tmp, $file_path2)) {
        echo "Error uploading Corporate/Educational ID.";
    }
} else {
    $file_path2 = $_POST['id2']; // Keep the existing value if no new file is uploaded
}



if ($tcont !== $parentCon) {
    // Prepare an update statement
    $stmt = $conn->prepare("UPDATE `tenants` SET tenant_name = ?, t_deposit = ?, tenant_address = ?, tenant_job = ?, tenant_contact = ?,
     tenant_parent = ?, parent_contact = ?, tenant_doc_1 = ?,
     tenant_doc_2 = ? WHERE tenant_id = ?");

    // Bind the variables to the statement as parameters
    $stmt->bind_param("sissisissi", $tname, $tdeposit, $taddress, $tjob, $tcont, $tparent, $parentCon, $file_path1, $file_path2, $tid);


    // Execute the statement
    $stmt->execute();


    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "Record updated successfully.";
        header("Location:about-apartments.php?id=$apartmentId");
        $stmt->close();
        $conn->close();
    } else {
        echo "No record updated. Please check the sno.";
    }
} else {
    echo "Error! parent and tenant contact same!";
?>
    <a href="admin-edit-tenant?id=<?php echo $tid; ?>"> Go back</a>
<?php
}

?>

<!-- #################### To update the selected Tenant ##########################  -->
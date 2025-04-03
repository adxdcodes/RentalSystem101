<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}
?>

<!-- #################### URL tid And to show which tenant are we editing ##########################  -->


<?php
// Example database connection
include '../partials/dbconnect.php'; // Include your database connection file

// Check if 'id' is set in the URL
if (isset($_GET['tid'])) {
    $tid = intval($_GET['tid']); // Sanitize the label
    $_SESSION['t_id'] = intval($_GET['tid']);



    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM `tenants` WHERE tenant_id = ?");
    $stmt->bind_param("i", $tid);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the record
    if ($row = $result->fetch_assoc()) {
        $tname = htmlspecialchars($row['tenant_name']);
        $tapartment = htmlspecialchars($row['apartment_name']);
        $taddress = htmlspecialchars($row['tenant_address']);
        $tjob = htmlspecialchars($row['tenant_job']);
        $tcont = htmlspecialchars($row['tenant_contact']);
        $tparent = htmlspecialchars($row['tenant_parent']);
        $parentCon = htmlspecialchars($row['parent_contact']);
        $file_path1 = htmlspecialchars($row['tenant_doc_1']);
        $file_path2 = htmlspecialchars($row['tenant_doc_2']);
        $inDate = htmlspecialchars($row['date_of_entry']);
        $tdeposit = htmlspecialchars($row['t_deposit']);
    } else {
        $tname = 'Records Not found';
    }
} else {
    $tname = 'No ID provided';
    header("Location:dashboard.php");
}
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

<body>
    <div class="flex flex-col text-center justify-center min-h-screen gap-1">
        <h1 class="text-center text-2xl p-5 font-bold">Details of Tenant : <?php echo " " . $tname; ?></h1>
        <div>
            <Label>Name : <?php echo " " . $tname; ?></Label>
        </div>
        <div>
            <Label>Tenant Id :<?php echo " " . $tid; ?></Label>
        </div>
        <div>
            <Label>Flat Name : <?php echo " " . $tapartment; ?></Label>
        </div>
        <div>
            <Label>Tenant Address :<?php echo " " . $taddress; ?></Label>
        </div>
        <div>
            <Label>Job : <?php echo " " . $tjob; ?></Label>
        </div>
        <div>
            <Label>Tenant Contact :<?php echo " " . $tcont; ?></Label>
        </div>
        <div>
            <Label>Parent Name : <?php echo " " . $tparent; ?></Label>
        </div>
        <div>
            <Label>Parent Contact :<?php echo " " . $parentCon; ?></Label>
        </div>
        <div>
            <Label>Entry date :<?php echo " " . $inDate; ?></Label>
        </div>
        <div>
            <Label>Tenant Deposit :<?php echo " ₹" . $tdeposit; ?></Label>
        </div>
        <div>
            <Label>Doc 1 : <?php echo " " . $file_path1; ?></Label>
            <a href="<?php echo " " . $file_path1; ?>" class="text-blue-700 font-semibold underline hover:text-blue-900">View</a>
        </div>
        <div>
            <Label>Doc 2 :<?php echo " " . $file_path2; ?></Label>
            <a href="<?php echo " " . $file_path2; ?>" class="text-blue-700 font-semibold underline hover:text-blue-900">View</a>
        </div>


    </div>
</body>

</html>
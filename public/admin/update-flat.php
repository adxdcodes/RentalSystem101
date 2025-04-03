<!-- ##################################### for updating the particular row in db using sno as key ########################  -->

<?php
include '../partials/dbconnect.php'; // include your database connection file

// Get form data
$sno = $_POST['sno'];
$flat = $_POST["flat"];
$flatType = $_POST["flat-type"];
$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($password === $cpassword) {
    // Prepare an update statement
    $stmt = $conn->prepare("UPDATE `users` SET flat = ?, flat_type = ?, username = ?, password = ? WHERE sno = ?");

    // Bind the variables to the statement as parameters
    $stmt->bind_param("ssssi", $flat, $flatType, $username, $hashed_password, $sno);


    // Execute the statement
    $stmt->execute();


    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "Record updated successfully.";
        header("Location:about-apartments.php?id=$sno");
        $stmt->close();
        $conn->close();
    } else {
        echo "No record updated. Please check the sno.";
    }
} else {
    echo "password and confirm password didn't matched!";
?>
    <a href="change-login.php?id=<?php echo $sno; ?>"> Go back</a>
<?php
}

?>
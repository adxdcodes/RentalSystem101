<?php
session_start();
if (!isset($_SESSION['is_ad_logged_in'])) {
    header("Location: admin.php");
    exit();
}
?>
<?php
// Include your database connection
include '../partials/dbconnect.php';

$sql = "SELECT * FROM tenants LIMIT 20"; // Adjust the limit as needed
$result = mysqli_query($conn, $sql);
$tenants = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<?php foreach ($tenants as $index => $tenant): ?>
    <tr class="text-center <?php echo $index % 2 == 0 ? 'bg-gray-100' : 'bg-white'; ?>">
        <td class="py-2 px-4 border-b"><?php echo $index + 1; ?></td>
        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['apartment_name']); ?></td>
        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_name']); ?></td>
        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_job']); ?></td>
        <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($tenant['tenant_contact']); ?></td>
        <td class="py-2 px-4 border-b">
            <a class="bg-yellow-500 text-black cursor-pointer py-1 mx-1 px-3 rounded hover:bg-yellow-600 transition duration-300">Details</a>
        </td>
    </tr>
<?php endforeach; ?>
<?php
session_start();
include '../partials/dbconnect.php';

$output = '';
$limit = 20;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;
$search = mysqli_real_escape_string($conn, $_POST["search"]);

$sql = "SELECT * FROM tenants WHERE 
    tenant_name LIKE '%$search%' 
    OR tenant_job LIKE '%$search%'
    OR apartment_name LIKE '%$search%'
    OR tenant_contact LIKE '%$search%' 
    ORDER BY tenant_name ASC 
    LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query Failed: ' . mysqli_error($conn)); // This will show an error if the query fails
}

if (mysqli_num_rows($result) > 0) {
    $counter = $offset + 1; // Start counting based on the offset
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <tr class="text-center ' . ($counter % 2 == 0 ? "bg-gray-100" : "bg-white") . '">
                <td class="py-2 px-4 border-b">' . $counter . '</td>
                <td class="py-2 px-4 border-b">' . htmlspecialchars($row["apartment_name"]) . '</td>
                <td class="py-2 px-4 border-b">' . htmlspecialchars($row["tenant_name"]) . '</td>
                <td class="py-2 px-4 border-b">' . htmlspecialchars($row["tenant_job"]) . '</td>
                <td class="py-2 px-4 border-b">' . htmlspecialchars($row["tenant_contact"]) . '</td>
                <td class="py-2 px-4 border-b">
                  <a href="admin-show-details.php?tid=' . htmlspecialchars($row['tenant_id']) . '" target="_blank" class="bg-yellow-500 text-black cursor-pointer py-1 mx-1 px-3 rounded hover:bg-yellow-600 transition duration-300">
                    Details
                  </a>
                </td>
            </tr>';
        $counter++;
    }

    // Pagination Links
    $total_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM tenants WHERE 
        tenant_name LIKE '%$search%' 
        OR tenant_job LIKE '%$search%'
        OR apartment_name LIKE '%$search%'
        OR tenant_contact LIKE '%$search%'");
    $total_records = mysqli_fetch_assoc($total_result)['count'];
    $total_pages = ceil($total_records / $limit);

    // $output .= '<tr><td colspan="6"><div class="flex justify-center mt-4">';
    for ($i = 1; $i <= $total_pages; $i++) {
        $output .= '<a href="#" class="pagination_link bg-' . ($page == $i ? 'gray-700' : 'blue-500') . ' text-white py-2 px-4 mx-1 rounded hover:bg-blue-600 transition duration-300" data-page="' . $i . '">' . $i . '</a>';
    }
    $output .= '</div></td></tr>';

    echo $output;
} else {
    echo "<tr><td colspan='6' class='text-center py-2 px-4'>No data found</td></tr>";
}

<?php
session_start();
require 'connect.php';
// Handle status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complaint_id'], $_POST['status'])) {
    $complaint_id = (int)$_POST['complaint_id'];
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE complaints SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $complaint_id);
    $stmt->execute();
}

// Fetch all complaints with user details
$query = "SELECT c.*, u.`Full Name`, u.`Phone No` 
          FROM complaints c
          JOIN normal_user u ON c.user_email = u.Email
          ORDER BY c.created_at DESC";
$complaints = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Complaint Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Complaint Management Dashboard</h1>
            <div>
                <span class="mr-4 text-gray-700">Welcome, <?php echo htmlspecialchars($_SESSION['full_name'] ?? 'Admin'); ?></span>
                <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200">Logout</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Complaint</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($complaint = $complaints->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo date('M d, Y h:i A', strtotime($complaint['created_at'])); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($complaint['Full Name']); ?></div>
                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars($complaint['user_email']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo htmlspecialchars($complaint['Phone No']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo htmlspecialchars($complaint['complaint_type']); ?>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <div class="max-w-xs truncate"><?php echo htmlspecialchars($complaint['complaint_text']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php 
                                $statusColor = [
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'In Progress' => 'bg-blue-100 text-blue-800',
                                    'Resolved' => 'bg-green-100 text-green-800'
                                ];
                                ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $statusColor[$complaint['status']] ?? 'bg-gray-100 text-gray-800'; ?>">
                                    <?php echo htmlspecialchars($complaint['status']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="POST" class="inline">
                                    <input type="hidden" name="complaint_id" value="<?php echo $complaint['id']; ?>">
                                    <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="Pending" <?php echo $complaint['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="In Progress" <?php echo $complaint['status'] === 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                                        <option value="Resolved" <?php echo $complaint['status'] === 'Resolved' ? 'selected' : ''; ?>>Resolved</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if ($complaints->num_rows === 0): ?>
        <div class="mt-8 bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-500">No complaints found in the system.</p>
        </div>
        <?php endif; ?>
    </div>

    <script>
        // Add any JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // You can add interactive features here
            console.log('Admin dashboard loaded');
        });
    </script>
</body>
</html>
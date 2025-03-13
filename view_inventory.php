<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
     <!-- Sidebar -->
     <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">Inventory System</div>
            <div class="sidebar-toggle" id="sidebar-toggle">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-menu">
            <!-- Dashboard -->
            <div class="sidebar-menu-item" data-page="dashboard" onclick="location.href='index.html'">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </div>
            

            <!-- Inventory Management -->
            <div class="sidebar-menu-item" data-submenu="inventory">
                <i class="fas fa-box"></i>
                <span>Inventory Management</span>
                <i class="fas fa-chevron-right" style="float: right;"></i>
            </div>
            <div class="sidebar-submenu" id="inventory-submenu">
                <div class="sidebar-submenu-item" data-page="view-inventory">View Inventory</div>
                <div class="sidebar-submenu-item" data-page="stocks">Stocks</div>
              
            </div>

            <!-- Borrowing Management -->
            <div class="sidebar-menu-item" data-submenu="borrowing">
                <i class="fas fa-handshake"></i>
                <span>Borrowing Management</span>
                <i class="fas fa-chevron-right" style="float: right;"></i>
            </div>
            <div class="sidebar-submenu" id="borrowing-submenu">
                <div class="sidebar-submenu-item" data-page="borrowed-items" onclick="location.href='borrowed_items.html'">Borrowed Items</div>
                <div class="sidebar-submenu-item" data-page="borrow-items">Borrow Items</div>
                <div class="sidebar-submenu-item" data-page="manage-borrowing">Return Items</div>
               
            </div>

            <!-- Reports -->
            <div class="sidebar-menu-item" data-submenu="reports">
                <i class="fas fa-chart-bar"></i>
                <span>Reports</span>
                <i class="fas fa-chevron-right" style="float: right;"></i>
            </div>
            <div class="sidebar-submenu" id="reports-submenu">
                <div class="sidebar-submenu-item" data-page="borrowing-history">Borrowing History</div>
                <div class="sidebar-submenu-item" data-page="stock-reports">Stock Reports</div>
                <div class="sidebar-submenu-item" data-page="overdue-reports">Overdue Reports</div>
            </div>

            <!-- User Management -->
            <div class="sidebar-menu-item" data-submenu="users">
                <i class="fas fa-users"></i>
                <span>User Management</span>
                <i class="fas fa-chevron-right" style="float: right;"></i>
            </div>
            <div class="sidebar-submenu" id="users-submenu">
                <div class="sidebar-submenu-item" data-page="manage-users">Manage Users</div>
                <div class="sidebar-submenu-item" data-page="roles-permissions">Roles & Permissions</div>
                <div class="sidebar-submenu-item" data-page="user-activity">User Activity Logs</div>
            </div>

            <!-- Settings -->
            <div class="sidebar-menu-item" data-submenu="settings">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
                <i class="fas fa-chevron-right" style="float: right;"></i>
            </div>
            <div class="sidebar-submenu" id="settings-submenu">
                <div class="sidebar-submenu-item" data-page="system-settings">System Settings</div>
                <div class="sidebar-submenu-item" data-page="notification-settings">Notification Settings</div>
                <div class="sidebar-submenu-item" data-page="integration-settings">Integration Settings</div>
            </div>

            <!-- Audit Log -->
            <div class="sidebar-menu-item" data-page="audit-log">
                <i class="fas fa-history"></i>
                <span>Audit Log</span>
            </div>

            <!-- Help / Support -->
            <div class="sidebar-menu-item" data-submenu="help">
                <i class="fas fa-question-circle"></i>
                <span>Help / Support</span>
                <i class="fas fa-chevron-right" style="float: right;"></i>
            </div>
            <div class="sidebar-submenu" id="help-submenu">
                <div class="sidebar-submenu-item" data-page="user-guide">User Guide</div>
                <div class="sidebar-submenu-item" data-page="support-tickets">Support Tickets</div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <div class="header">
            <button class="toggle-button" id="toggle-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="header-actions">
                <div class="header-user">
                    <i class="fas fa-user-circle" style="font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <div class="content" id="content">
            <!-- Inventory Table -->
            <div class="card-title">Inventory Items</div>

            <div class="card">
                <div class="card-header">
                </div>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f8f9fc; border-bottom: 1px solid #e3e6f0;">
                                <th style="padding: 0.75rem; text-align: left;">Item ID</th>
                                <th style="padding: 0.75rem; text-align: left;">Item Name</th>
                                <th style="padding: 0.75rem; text-align: left;">Description</th>
                                <th style="padding: 0.75rem; text-align: left;">Quantity in Stock</th>
                                <th style="padding: 0.75rem; text-align: left;">Unit Price</th>
                                <th style="padding: 0.75rem; text-align: left;">Date Added</th>
                                <th style="padding: 0.75rem; text-align: left;">Last Updated</th>
                                <th style="padding: 0.75rem; text-align: left;">Action</th> <!-- Added Action column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Include the database connection
                            include('server.php');

                            // SQL query to fetch data from the 'items' table
                            $sql = "SELECT `ItemID`, `ItemName`, `Description`, `QuantityInStock`, `UnitPrice`, `DateAdded`, `LastUpdated` FROM `items`";
                            $result = $conn->query($sql);

                            // Check if there are rows in the result
                            if ($result->num_rows > 0) {
                                // Loop through each row and display data
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr style='border-bottom: 1px solid #e3e6f0;'>";
                                    echo "<td style='padding: 0.75rem;'>" . $row['ItemID'] . "</td>";
                                    echo "<td style='padding: 0.75rem;'>" . $row['ItemName'] . "</td>";
                                    echo "<td style='padding: 0.75rem;'>" . $row['Description'] . "</td>";
                                    echo "<td style='padding: 0.75rem;'>" . $row['QuantityInStock'] . "</td>";
                                    echo "<td style='padding: 0.75rem;'>$" . $row['UnitPrice'] . "</td>";
                                    echo "<td style='padding: 0.75rem;'>" . $row['DateAdded'] . "</td>";
                                    echo "<td style='padding: 0.75rem;'>" . $row['LastUpdated'] . "</td>";
                                    // Adding View button with a link
                                    echo "<td style='padding: 0.75rem;'><button onclick=\"window.location.href='view_item.php?itemID=" . $row['ItemID'] . "'\">View</button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' style='text-align: center;'>No items found</td></tr>";
                            }

                            // Close the database connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="js/sidemenu.js"></script>
</body>
</html>

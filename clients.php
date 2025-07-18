<?php
include 'includes/header.php';
include( 'includes/config.php' );
?>

<!-- Client Management Section -->
<section id='client-management' class='mb-5'>
    <div class='dashboard-card'>
        <div class='d-flex justify-content-between align-items-center mb-3'>
            <h5><i class='fas fa-users me-2'></i>Client Management</h5>
            <!-- Add New Client Button -->
            <a class='btn btn-primary btn-sm' href='new-client'>
                <i class='fas fa-user-plus me-1'></i> Add New Client
            </a>
        </div>

        <div class='row mb-3 g-2'>
            <div class='col-md-6'>
                <input type='text' class='form-control' placeholder='Search clients by name or email...'>
            </div>
            <div class='col-md-3'>
                <select class='form-select'>
                    <option selected>Filter by Status</option>
                    <option value='active'>Active</option>
                    <option value='inactive'>Inactive</option>
                </select>
            </div>
            <div class='col-md-3'>
                <button class='btn btn-outline-secondary w-100'><i class='fas fa-filter me-1'></i> Apply
                    Filters</button>
            </div>
        </div>

        <!-- Table for Displaying Clients -->
        <div class='table-responsive'>
            <table class='table table-hover mb-0'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Policies</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
// Fetch clients from the database
$stmt = $pdo->query( 'SELECT * FROM clients' );
while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
    echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['first_name']} {$row['last_name']}</td>
                                <td>{$row['email']}</td>
                                <td>0</td> <!-- Assuming no policies for simplicity -->
                                <td>Active</td> <!-- You can update the status -->
                                <td>
                                    <button class='btn btn-sm btn-info me-1' title='View Policies'><i class='fas fa-file-contract'></i></button>
                                    <button class='btn btn-sm btn-warning me-1' title='Edit Client'><i class='fas fa-edit'></i></button>
                                    <button class='btn btn-sm btn-danger' title='Delete Client'><i class='fas fa-trash-alt'></i></button>
                                </td>
                            </tr>";
}
?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include 'includes/footer.php';
?>
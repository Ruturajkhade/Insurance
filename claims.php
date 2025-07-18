<?php include 'includes/header.php';
?>

<!-- Policy Management Section -->
<section id='policy-management' class='mb-5'>
    <div class='dashboard-card'>
        <div class='d-flex justify-content-between align-items-center mb-3'>
            <h5><i class='fas fa-clipboard-list me-2'></i>Claims Management</h5>
            <button class='btn btn-primary btn-sm'>
                <i class='fas fa-plus-circle me-1'></i> File New Claim
            </button>
        </div>
        <div class='table-responsive'>
            <table class='table table-hover mb-0'>
                <thead>
                    <tr>
                        <th>Claim ID</th>
                        <th>Policy No.</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Date Filed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>CLM-001</td>
                        <td>POL-001</td>
                        <td>Alice Johnson</td>
                        <td><span class='badge bg-warning'>Pending</span></td>
                        <td>2025-07-10</td>
                        <td>
                            <button class='btn btn-sm btn-info me-1' title='View Details'><i
                                    class='fas fa-eye'></i></button>
                            <button class='btn btn-sm btn-success' title='Approve Claim'><i
                                    class='fas fa-check'></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>CLM-002</td>
                        <td>POL-002</td>
                        <td>Bob Williams</td>
                        <td><span class='badge bg-danger'>Rejected</span></td>
                        <td>2025-06-25</td>
                        <td>
                            <button class='btn btn-sm btn-info me-1' title='View Details'><i
                                    class='fas fa-eye'></i></button>
                            <button class='btn btn-sm btn-secondary' title='Reopen Claim'><i
                                    class='fas fa-undo'></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include 'includes/footer.php';
?>
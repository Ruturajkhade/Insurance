<?php include 'includes/header.php';
?>

<!-- Policy Management Section -->
<section id='policy-management' class='mb-5'>
    <div class='dashboard-card'>
        <div class='d-flex justify-content-between align-items-center mb-3'>
            <h5><i class='fas fa-file-contract me-2'></i>Policy Management</h5>
            <button class='btn btn-primary btn-sm'>
                <i class='fas fa-plus-circle me-1'></i> Add New Policy
            </button>
        </div>
        <div class='row mb-3 g-2'>
            <div class='col-md-4'>
                <input type='text' class='form-control' placeholder='Search policies by number or client...'>
            </div>
            <div class='col-md-3'>
                <select class='form-select'>
                    <option selected>Filter by Type</option>
                    <option value='auto'>Auto</option>
                    <option value='home'>Home</option>
                    <option value='life'>Life</option>
                </select>
            </div>
            <div class='col-md-3'>
                <select class='form-select'>
                    <option selected>Filter by Status</option>
                    <option value='active'>Active</option>
                    <option value='expired'>Expired</option>
                    <option value='pending'>Pending</option>
                </select>
            </div>
            <div class='col-md-2'>
                <button class='btn btn-outline-secondary w-100'><i class='fas fa-filter me-1'></i> Apply
                    Filters</button>
            </div>
        </div>
        <div class='table-responsive'>
            <table class='table table-hover mb-0'>
                <thead>
                    <tr>
                        <th>Policy No.</th>
                        <th>Client</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Premium</th>
                        <th>Renewal Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>POL-001</td>
                        <td>Alice Johnson</td>
                        <td>Auto</td>
                        <td><span class='badge bg-success'>Active</span></td>
                        <td>$1200</td>
                        <td>2026-01-15</td>
                        <td>
                            <button class='btn btn-sm btn-info me-1' title='View Details'><i
                                    class='fas fa-eye'></i></button>
                            <button class='btn btn-sm btn-warning me-1' title='Renew Policy'><i
                                    class='fas fa-redo-alt'></i></button>
                            <button class='btn btn-sm btn-danger' title='Edit Policy'><i
                                    class='fas fa-edit'></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>POL-002</td>
                        <td>Bob Williams</td>
                        <td>Home</td>
                        <td><span class='badge bg-warning'>Pending</span></td>
                        <td>$900</td>
                        <td>2025-08-01</td>
                        <td>
                            <button class='btn btn-sm btn-info me-1' title='View Details'><i
                                    class='fas fa-eye'></i></button>
                            <button class='btn btn-sm btn-warning me-1' title='Renew Policy'><i
                                    class='fas fa-redo-alt'></i></button>
                            <button class='btn btn-sm btn-danger' title='Edit Policy'><i
                                    class='fas fa-edit'></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>POL-003</td>
                        <td>Alice Johnson</td>
                        <td>Life</td>
                        <td><span class='badge bg-success'>Active</span></td>
                        <td>$500</td>
                        <td>2027-03-10</td>
                        <td>
                            <button class='btn btn-sm btn-info me-1' title='View Details'><i
                                    class='fas fa-eye'></i></button>
                            <button class='btn btn-sm btn-warning me-1' title='Renew Policy'><i
                                    class='fas fa-redo-alt'></i></button>
                            <button class='btn btn-sm btn-danger' title='Edit Policy'><i
                                    class='fas fa-edit'></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include 'includes/footer.php';
?>
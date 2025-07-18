<?php 
// Start session (if not already started in header.php)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include header
include 'includes/header.php';

// Sample renewal data (in a real app, this would come from a database)
$renewals = [
    [
        'policy_no' => 'POL-002',
        'client_name' => 'Bob Williams',
        'policy_type' => 'Home',
        'renewal_date' => '2025-08-01',
        'premium' => '$900',
        'status' => 'pending'
    ],
    [
        'policy_no' => 'POL-005',
        'client_name' => 'David Lee',
        'policy_type' => 'Auto',
        'renewal_date' => '2025-08-10',
        'premium' => '$1100',
        'status' => 'pending'
    ],
    [
        'policy_no' => 'POL-008',
        'client_name' => 'Sarah Connor',
        'policy_type' => 'Life',
        'renewal_date' => '2025-08-15',
        'premium' => '$750',
        'status' => 'reminder_sent'
    ]
];

// Calculate days until renewal for each policy
$today = new DateTime();
foreach ($renewals as &$renewal) {
    $renewalDate = new DateTime($renewal['renewal_date']);
    $interval = $today->diff($renewalDate);
    $renewal['days_until'] = $interval->days;
}
unset($renewal); // Break the reference
?>

<!-- Upcoming Renewals Section -->
<section id="renewals-section" class="mb-5">
    <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-calendar-check me-2"></i>Upcoming Policy Renewals</h5>
            <div>
                <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#renewalReportModal">
                    <i class="fas fa-file-export me-1"></i> Generate Report
                </button>
                <button class="btn btn-success btn-sm" id="sendAllReminders">
                    <i class="fas fa-bell me-1"></i> Send All Reminders
                </button>
            </div>
        </div>

        <p class="text-muted">Policies due for renewal in the next 30 days. <span
                class="badge bg-info"><?php echo count($renewals); ?> policies found</span></p>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Policy No.</th>
                        <th>Client</th>
                        <th>Type</th>
                        <th>Renewal Date</th>
                        <th>Days Left</th>
                        <th>Premium</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($renewals as $renewal): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($renewal['policy_no']); ?></td>
                        <td><?php echo htmlspecialchars($renewal['client_name']); ?></td>
                        <td><?php echo htmlspecialchars($renewal['policy_type']); ?></td>
                        <td><?php echo htmlspecialchars($renewal['renewal_date']); ?></td>
                        <td>
                            <span class="badge <?php echo $renewal['days_until'] <= 7 ? 'bg-danger' : 'bg-warning'; ?>">
                                <?php echo $renewal['days_until']; ?> days
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($renewal['premium']); ?></td>
                        <td>
                            <?php if ($renewal['status'] === 'reminder_sent'): ?>
                            <span class="badge bg-success">Reminder Sent</span>
                            <?php else: ?>
                            <span class="badge bg-secondary">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button class="btn btn-outline-success send-reminder"
                                    data-policy="<?php echo htmlspecialchars($renewal['policy_no']); ?>"
                                    title="Send Reminder">
                                    <i class="fas fa-bell"></i>
                                </button>
                                <button class="btn btn-outline-primary renew-policy"
                                    data-policy="<?php echo htmlspecialchars($renewal['policy_no']); ?>"
                                    title="Renew Now">
                                    <i class="fas fa-redo-alt"></i>
                                </button>
                                <button class="btn btn-outline-info view-details"
                                    data-policy="<?php echo htmlspecialchars($renewal['policy_no']); ?>"
                                    title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination would go here in a real application -->
        <nav class="mt-3">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<!-- Renewal Report Modal -->
<div class="modal fade" id="renewalReportModal" tabindex="-1" aria-labelledby="renewalReportModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="renewalReportModalLabel"><i class="fas fa-file-export me-2"></i> Generate
                    Renewal Report</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reportForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="reportStartDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="reportStartDate" required>
                        </div>
                        <div class="col-md-6">
                            <label for="reportEndDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="reportEndDate" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="reportType" class="form-label">Report Type</label>
                        <select class="form-select" id="reportType" required>
                            <option value="" selected disabled>Select report type</option>
                            <option value="upcoming">Upcoming Renewals</option>
                            <option value="expired">Expired Policies</option>
                            <option value="all">All Renewals</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reportFormat" class="form-label">Format</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reportFormat" id="formatPdf" value="pdf"
                                checked>
                            <label class="form-check-label" for="formatPdf">PDF</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reportFormat" id="formatExcel"
                                value="excel">
                            <label class="form-check-label" for="formatExcel">Excel</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reportFormat" id="formatCsv" value="csv">
                            <label class="form-check-label" for="formatCsv">CSV</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="generateReport">
                    <i class="fas fa-download me-1"></i> Generate Report
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Renewals Page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Send reminder for a single policy
    document.querySelectorAll('.send-reminder').forEach(button => {
        button.addEventListener('click', function() {
            const policyNo = this.getAttribute('data-policy');
            // In a real app, you would make an AJAX call here
            Swal.fire({
                title: 'Send Reminder?',
                text: `Are you sure you want to send a renewal reminder for policy ${policyNo}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, send it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulate API call
                    setTimeout(() => {
                        Swal.fire(
                            'Reminder Sent!',
                            `A renewal reminder has been sent for policy ${policyNo}.`,
                            'success'
                        );
                        // In a real app, you would update the UI here
                    }, 1000);
                }
            });
        });
    });

    // Renew a policy
    document.querySelectorAll('.renew-policy').forEach(button => {
        button.addEventListener('click', function() {
            const policyNo = this.getAttribute('data-policy');
            // In a real app, you would redirect to renewal page or show a modal
            Swal.fire({
                title: 'Renew Policy',
                text: `You are about to renew policy ${policyNo}.`,
                icon: 'info',
                confirmButtonText: 'Continue to Renewal'
            });
        });
    });

    // Send reminders for all policies
    document.getElementById('sendAllReminders').addEventListener('click', function() {
        Swal.fire({
            title: 'Send All Reminders?',
            text: 'This will send renewal reminders to all clients with upcoming renewals.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, send all!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulate API call
                Swal.fire({
                    title: 'Sending Reminders...',
                    html: 'Please wait while we process your request.',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                setTimeout(() => {
                    Swal.fire(
                        'Reminders Sent!',
                        'All renewal reminders have been sent successfully.',
                        'success'
                    );
                }, 2000);
            }
        });
    });

    // Generate report
    document.getElementById('generateReport').addEventListener('click', function() {
        const startDate = document.getElementById('reportStartDate').value;
        const endDate = document.getElementById('reportEndDate').value;
        const reportType = document.getElementById('reportType').value;
        const format = document.querySelector('input[name="reportFormat"]:checked').value;

        if (!startDate || !endDate || !reportType) {
            Swal.fire('Error', 'Please fill all required fields', 'error');
            return;
        }

        // In a real app, you would submit the form or make an AJAX call
        Swal.fire({
            title: 'Report Generated!',
            text: `Your ${reportType} report (${format}) from ${startDate} to ${endDate} is ready.`,
            icon: 'success',
            confirmButtonText: 'Download'
        }).then(() => {
            // Close modal
            bootstrap.Modal.getInstance(document.getElementById('renewalReportModal')).hide();
        });
    });
});
</script>

<?php 
// Include footer
include 'includes/footer.php';
?>
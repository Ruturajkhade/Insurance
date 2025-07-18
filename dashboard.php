<?php include 'includes/header.php';
?>

<!-- Dashboard Overview Section -->
<section id='dashboard-overview' class='mb-5'>
    <h4 class='mb-4 text-primary'>Dashboard Overview</h4>
    <div class='row'>
        <!-- Agent Stat Cards -->
        <div class='col-md-6 col-lg-3'>
            <div class='dashboard-card text-center'>
                <i class='fas fa-users card-icon'></i>
                <div class='card-value'>150</div>
                <div class='card-text'>Total Clients</div>
            </div>
        </div>
        <div class='col-md-6 col-lg-3'>
            <div class='dashboard-card text-center'>
                <i class='fas fa-file-contract card-icon'></i>
                <div class='card-value'>320</div>
                <div class='card-text'>Active Policies</div>
            </div>
        </div>
        <div class='col-md-6 col-lg-3'>
            <div class='dashboard-card text-center'>
                <i class='fas fa-calendar-check card-icon'></i>
                <div class='card-value'>18</div>
                <div class='card-text'>Upcoming Renewals</div>
            </div>
        </div>
        <div class='col-md-6 col-lg-3'>
            <div class='dashboard-card text-center'>
                <i class='fas fa-dollar-sign card-icon'></i>
                <div class='card-value'>$55, 000</div>
                <div class='card-text'>Total Premiums ( Monthly )</div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Activities -->
<section id='recent-activities' class='mb-5'>
    <div class='dashboard-card'>
        <h5><i class='fas fa-history me-2'></i>Recent Activities</h5>
        <p class='text-muted'>Overview of recent interactions and updates.</p>
        <ul class='list-group list-group-flush'>
            <!-- ... recent activities list ... -->
        </ul>
    </div>
</section>

<!-- Quick Agent Actions -->
<section id='quick-actions' class='mb-5'>
    <div class='dashboard-card'>
        <h5><i class='fas fa-bolt me-2'></i>Quick Actions</h5>
        <div class='row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3'>
            <!-- ... quick action buttons ... -->
        </div>
    </div>
</section>

<?php include 'includes/footer.php';
?>
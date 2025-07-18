<div class="sidebar" id="sidebar">
    <a href="dashboard.php" class="logo">
        <i class="fas fa-hand-holding-usd me-2"></i><span>AgentPanel</span>
    </a>
    <ul>
        <li><a href="dashboard.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
        </li>
        <li><a href="clients.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'clients.php' ? 'active' : ''; ?>">
                <i class="fas fa-users"></i><span>Client Management</span></a>
        </li>
        <li><a href="policies.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'policies.php' ? 'active' : ''; ?>">
                <i class="fas fa-file-contract"></i><span>Policy Management</span></a>
        </li>
        <li><a href="claims.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'claims.php' ? 'active' : ''; ?>">
                <i class="fas fa-clipboard-list"></i><span>Claims</span></a>
        </li>
        <li><a href="renewals.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'renewals.php' ? 'active' : ''; ?>">
                <i class="fas fa-calendar-check"></i><span>Renewals</span></a>
        </li>
        <li><a href="reports.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : ''; ?>">
                <i class="fas fa-chart-line"></i><span>Reports</span></a>
        </li>
        <li><a href="logout.php">
                <i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
        </li>
    </ul>
</div>
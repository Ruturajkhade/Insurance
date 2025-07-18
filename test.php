<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard | Your Insurance App</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Poppins for a modern look -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
    :root {
        --primary-color: #6f42c1;
        /* A vibrant purple */
        --secondary-color: #e9ecef;
        /* Light grey for background */
        --accent-color: #8a2be2;
        /* A slightly darker purple for hover */
        --text-color: #343a40;
        /* Dark grey for general text */
        --light-text-color: #6c757d;
        /* Lighter grey for secondary text */
        --dashboard-bg: #f8f9fa;
        /* Lighter background for dashboard content */
    }

    body {
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        background-color: var(--dashboard-bg);
        /* Consistent light background */
        color: var(--text-color);
        display: flex;
        /* Use flexbox for main layout */
    }

    /* Sidebar Styling */
    .sidebar {
        width: 250px;
        background: linear-gradient(180deg, var(--primary-color) 0%, var(--accent-color) 100%);
        color: white;
        padding: 20px;
        position: fixed;
        /* Fixed sidebar */
        height: 100%;
        overflow-y: auto;
        /* Scrollable if content overflows */
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        z-index: 1000;
        /* Ensure it's above other content */
        left: 0;
        /* Default to visible for desktop, will be hidden by JS on mobile */
    }

    .sidebar.collapsed {
        width: 70px;
        /* Collapsed width */
    }

    .sidebar .logo {
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        text-decoration: none;
        display: block;
    }

    .sidebar.collapsed .logo span {
        display: none;
        /* Hide text when collapsed */
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar ul li {
        margin-bottom: 10px;
    }

    .sidebar ul li a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .sidebar ul li a:hover,
    .sidebar ul li a.active {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateX(5px);
    }

    .sidebar ul li a i {
        margin-right: 15px;
        font-size: 1.2rem;
        width: 25px;
        /* Fixed width for icons */
        text-align: center;
    }

    .sidebar.collapsed ul li a span {
        display: none;
        /* Hide text when collapsed */
    }

    .sidebar.collapsed ul li a {
        justify-content: center;
        /* Center icon when collapsed */
        padding: 12px 0;
    }

    /* Main Content Area */
    .main-content {
        margin-left: 250px;
        /* Space for sidebar */
        flex-grow: 1;
        padding: 30px;
        transition: margin-left 0.3s ease;
    }

    .main-content.shifted {
        margin-left: 70px;
        /* Adjusted margin when sidebar is collapsed */
    }

    /* Navbar (Top Bar) */
    .navbar {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        padding: 15px 25px;
    }

    .navbar .navbar-brand {
        font-weight: 600;
        color: var(--primary-color);
    }

    .navbar .btn-toggle-sidebar {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        border-radius: 0.5rem;
        padding: 8px 12px;
        transition: all 0.3s ease;
    }

    .navbar .btn-toggle-sidebar:hover {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
    }

    /* Dashboard Cards */
    .dashboard-card {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
        padding: 25px;
        margin-bottom: 25px;
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
    }

    .dashboard-card h5 {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .dashboard-card .card-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        opacity: 0.7;
        margin-bottom: 15px;
    }

    .dashboard-card .card-value {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--text-color);
    }

    .dashboard-card .card-text {
        color: var(--light-text-color);
    }

    /* Progress Bar Styling */
    .progress-bar {
        background-color: var(--primary-color);
        border-radius: 0.5rem;
    }

    /* Table Styling */
    .table {
        border-radius: 0.75rem;
        overflow: hidden;
        /* Ensures rounded corners on table */
    }

    .table thead th {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        border-bottom: none;
    }

    .table tbody tr:nth-child(even) {
        background-color: var(--secondary-color);
    }

    .table tbody tr:hover {
        background-color: rgba(111, 66, 193, 0.1);
        /* Light hover effect */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        body.sidebar-open-mobile {
            overflow: hidden;
            /* Prevent scrolling when mobile sidebar is open */
        }

        .sidebar {
            width: 250px;
            /* Full width for overlay */
            left: -250px;
            /* Hidden by default */
            transform: translateX(0);
            /* Reset transform */
        }

        .sidebar.show {
            /* Class to show sidebar on mobile */
            left: 0;
        }

        .sidebar.collapsed {
            /* Ensure collapsed state works if user resizes from desktop */
            width: 70px;
            left: -70px;
        }

        .sidebar.collapsed.show {
            left: 0;
        }

        .main-content {
            margin-left: 0;
            /* No margin on mobile by default */
            padding: 15px;
        }

        .main-content.shifted {
            /* This class will be removed on mobile, as sidebar will be overlay */
            margin-left: 0;
        }

        .navbar .btn-toggle-sidebar {
            display: block !important;
            /* Ensure mobile toggle is always visible on small screens */
        }

        .navbar .btn-toggle-sidebar.d-lg-none {
            display: block !important;
        }

        .navbar .btn-toggle-sidebar.d-none.d-lg-block {
            display: none !important;
        }
    }

    /* Backdrop for mobile sidebar */
    .sidebar-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        /* Below sidebar, above content */
        display: none;
        /* Hidden by default */
    }

    .sidebar-backdrop.show {
        display: block;
    }

    /* Content sections initially hidden, only active one shows */
    .content-section {
        display: none;
    }

    .content-section.active {
        display: block;
    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="#" class="logo">
            <i class="fas fa-hand-holding-usd me-2"></i><span>AgentPanel</span>
        </a>
        <ul>
            <li><a href="#dashboard-overview" class="active"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li><a href="#client-management"><i class="fas fa-users"></i><span>Client Management</span></a></li>
            <li><a href="#policy-management"><i class="fas fa-file-contract"></i><span>Policy Management</span></a></li>
            <li><a href="#claims-management"><i class="fas fa-clipboard-list"></i><span>Claims</span></a></li>
            <li><a href="#renewals-section"><i class="fas fa-calendar-check"></i><span>Renewals</span></a></li>
            <li><a href="#reports-section"><i class="fas fa-chart-line"></i><span>Reports</span></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="btn btn-toggle-sidebar d-lg-none" id="sidebarToggleMobile">
                    <i class="fas fa-bars"></i>
                </button>
                <button class="btn btn-toggle-sidebar d-none d-lg-block" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="ms-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://placehold.co/30x30/6f42c1/ffffff?text=A" class="rounded-circle me-2"
                                    alt="Agent Avatar">
                                Agent User
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Dashboard Overview Section -->
        <section id="dashboard-overview" class="mb-5 content-section active">
            <h4 class="mb-4 text-primary">Dashboard Overview</h4>
            <div class="row">
                <!-- Agent Stat Cards -->
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card text-center">
                        <i class="fas fa-users card-icon"></i>
                        <div class="card-value">150</div>
                        <div class="card-text">Total Clients</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card text-center">
                        <i class="fas fa-file-contract card-icon"></i>
                        <div class="card-value">320</div>
                        <div class="card-text">Active Policies</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card text-center">
                        <i class="fas fa-calendar-check card-icon"></i>
                        <div class="card-value">18</div>
                        <div class="card-text">Upcoming Renewals</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-card text-center">
                        <i class="fas fa-dollar-sign card-icon"></i>
                        <div class="card-value">$55,000</div>
                        <div class="card-text">Total Premiums (Monthly)</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Client Management Section -->
        <section id="client-management" class="mb-5 content-section">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5><i class="fas fa-users me-2"></i>Client Management</h5>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus me-1"></i> Add New Client
                    </button>
                </div>
                <div class="row mb-3 g-2">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Search clients by name or email...">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>Filter by Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-secondary w-100"><i class="fas fa-filter me-1"></i> Apply
                            Filters</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
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
                            <tr>
                                <td>1</td>
                                <td>Alice Johnson</td>
                                <td>alice.j@example.com</td>
                                <td>3</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="View Policies"><i
                                            class="fas fa-file-contract"></i></button>
                                    <button class="btn btn-sm btn-warning me-1" title="Edit Client"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Delete Client"><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Bob Williams</td>
                                <td>bob.w@example.com</td>
                                <td>1</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="View Policies"><i
                                            class="fas fa-file-contract"></i></button>
                                    <button class="btn btn-sm btn-warning me-1" title="Edit Client"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Delete Client"><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Charlie Brown</td>
                                <td>charlie.b@example.com</td>
                                <td>0</td>
                                <td>Inactive</td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="View Policies"><i
                                            class="fas fa-file-contract"></i></button>
                                    <button class="btn btn-sm btn-warning me-1" title="Edit Client"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Delete Client"><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Policy Management Section -->
        <section id="policy-management" class="mb-5 content-section">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5><i class="fas fa-file-contract me-2"></i>Policy Management</h5>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle me-1"></i> Add New Policy
                    </button>
                </div>
                <div class="row mb-3 g-2">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Search policies by number or client...">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>Filter by Type</option>
                            <option value="auto">Auto</option>
                            <option value="home">Home</option>
                            <option value="life">Life</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>Filter by Status</option>
                            <option value="active">Active</option>
                            <option value="expired">Expired</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-secondary w-100"><i class="fas fa-filter me-1"></i> Apply
                            Filters</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
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
                                <td><span class="badge bg-success">Active</span></td>
                                <td>$1200</td>
                                <td>2026-01-15</td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="View Details"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-warning me-1" title="Renew Policy"><i
                                            class="fas fa-redo-alt"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Edit Policy"><i
                                            class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>POL-002</td>
                                <td>Bob Williams</td>
                                <td>Home</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>$900</td>
                                <td>2025-08-01</td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="View Details"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-warning me-1" title="Renew Policy"><i
                                            class="fas fa-redo-alt"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Edit Policy"><i
                                            class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>POL-003</td>
                                <td>Alice Johnson</td>
                                <td>Life</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>$500</td>
                                <td>2027-03-10</td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="View Details"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-warning me-1" title="Renew Policy"><i
                                            class="fas fa-redo-alt"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Edit Policy"><i
                                            class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Claims Management Section -->
        <section id="claims-management" class="mb-5 content-section">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5><i class="fas fa-clipboard-list me-2"></i>Claims Management</h5>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle me-1"></i> File New Claim
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
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
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>2025-07-10</td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="View Details"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-success" title="Approve Claim"><i
                                            class="fas fa-check"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>CLM-002</td>
                                <td>POL-002</td>
                                <td>Bob Williams</td>
                                <td><span class="badge bg-danger">Rejected</span></td>
                                <td>2025-06-25</td>
                                <td>
                                    <button class="btn btn-sm btn-info me-1" title="View Details"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-secondary" title="Reopen Claim"><i
                                            class="fas fa-undo"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Upcoming Renewals Section -->
        <section id="renewals-section" class="mb-5 content-section">
            <div class="dashboard-card">
                <h5><i class="fas fa-calendar-check me-2"></i>Upcoming Policy Renewals</h5>
                <p class="text-muted">Policies due for renewal in the next 30 days.</p>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Policy No.</th>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Renewal Date</th>
                                <th>Premium</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>POL-002</td>
                                <td>Bob Williams</td>
                                <td>Home</td>
                                <td>2025-08-01</td>
                                <td>$900</td>
                                <td>
                                    <button class="btn btn-sm btn-success me-1" title="Send Reminder"><i
                                            class="fas fa-bell"></i></button>
                                    <button class="btn btn-sm btn-primary" title="Renew Now"><i
                                            class="fas fa-redo-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>POL-005</td>
                                <td>David Lee</td>
                                <td>Auto</td>
                                <td>2025-08-10</td>
                                <td>$1100</td>
                                <td>
                                    <button class="btn btn-sm btn-success me-1" title="Send Reminder"><i
                                            class="fas fa-bell"></i></button>
                                    <button class="btn btn-sm btn-primary" title="Renew Now"><i
                                            class="fas fa-redo-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Reports Section -->
        <section id="reports-section" class="mb-5 content-section">
            <div class="dashboard-card">
                <h5><i class="fas fa-chart-line me-2"></i>Reports & Analytics</h5>
                <p class="text-muted">Generate and view various reports on client, policy, and sales performance.</p>
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    <div class="col">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-users d-block mb-2"></i>
                            Client Demographics
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-chart-bar d-block mb-2"></i>
                            Sales Performance
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-file-invoice-dollar d-block mb-2"></i>
                            Premium Collection
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-percent d-block mb-2"></i>
                            Renewal Rate Analysis
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Activities (Agent Specific) -->
        <section id="recent-activities" class="mb-5 content-section">
            <div class="dashboard-card">
                <h5><i class="fas fa-history me-2"></i>Recent Activities</h5>
                <p class="text-muted">Overview of recent interactions and updates.</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-circle text-success me-2" style="font-size: 0.7rem;"></i>
                        New client "David Lee" added.
                        <span class="badge bg-light text-muted">10 mins ago</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-circle text-info me-2" style="font-size: 0.7rem;"></i>
                        Policy POL-002 renewed for Bob Williams.
                        <span class="badge bg-light text-muted">1 hour ago</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-circle text-warning me-2" style="font-size: 0.7rem;"></i>
                        Claim CLM-001 status updated to "Under Review".
                        <span class="badge bg-light text-muted">Yesterday</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-circle text-primary me-2" style="font-size: 0.7rem;"></i>
                        Scheduled follow-up with Client Alice Johnson.
                        <span class="badge bg-light text-muted">2 days ago</span>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Quick Agent Actions -->
        <section id="quick-actions" class="mb-5 content-section">
            <div class="dashboard-card">
                <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3">
                    <div class="col text-center">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-user-plus d-block mb-2"></i>
                            Add New Client
                        </button>
                    </div>
                    <div class="col text-center">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-file-signature d-block mb-2"></i>
                            Create New Policy
                        </button>
                    </div>
                    <div class="col text-center">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-headset d-block mb-2"></i>
                            Contact Client
                        </button>
                    </div>
                    <div class="col text-center">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-chart-line d-block mb-2"></i>
                            View Sales Report
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Sidebar toggle functionality
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const sidebarToggle = document.getElementById('sidebarToggle'); // Desktop toggle
    const sidebarToggleMobile = document.getElementById('sidebarToggleMobile'); // Mobile toggle
    const currentSectionTitle = document.getElementById('current-section-title');
    let isSidebarCollapsed = false; // Track desktop collapse state

    function toggleSidebar() {
        const backdrop = document.getElementById('sidebar-backdrop');
        if (window.innerWidth <= 768) {
            // Mobile behavior: overlay
            sidebar.classList.toggle('show');
            document.body.classList.toggle('sidebar-open-mobile'); // Add class to body to prevent scroll

            if (!backdrop) {
                // Create backdrop if it doesn't exist
                const newBackdrop = document.createElement('div');
                newBackdrop.id = 'sidebar-backdrop';
                newBackdrop.classList.add('sidebar-backdrop');
                document.body.appendChild(newBackdrop);
                newBackdrop.addEventListener('click', toggleSidebar); // Close on backdrop click
                newBackdrop.classList.add('show');
            } else {
                backdrop.classList.toggle('show');
            }
        } else {
            // Desktop behavior: collapse/expand
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('shifted');
            isSidebarCollapsed = sidebar.classList.contains('collapsed');
        }
    }

    // Event listeners for toggle buttons
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }
    if (sidebarToggleMobile) {
        sidebarToggleMobile.addEventListener('click', toggleSidebar);
    }

    // Function to show a specific content section and update active sidebar link
    function showSection(sectionId) {
        // Hide all content sections
        document.querySelectorAll('.content-section').forEach(section => {
            section.classList.remove('active');
        });

        // Show the target section
        const targetSection = document.querySelector(sectionId);
        if (targetSection) {
            targetSection.classList.add('active');
            // Update the navbar title for mobile view
            if (currentSectionTitle) {
                currentSectionTitle.textContent = targetSection.querySelector('h4, h5').textContent;
            }
        }

        // Update active state for sidebar links
        document.querySelectorAll('.sidebar ul li a').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === sectionId) {
                link.classList.add('active');
            }
        });
    }

    // Initial check and resize handling
    function checkLayoutOnResize() {
        const backdrop = document.getElementById('sidebar-backdrop');
        if (window.innerWidth <= 768) {
            // On mobile, ensure desktop collapse state is reset and main-content margin is 0
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('shifted');
            // Ensure backdrop is shown if sidebar is open on mobile
            if (sidebar.classList.contains('show')) {
                if (!backdrop) { // Create if not exists
                    const newBackdrop = document.createElement('div');
                    newBackdrop.id = 'sidebar-backdrop';
                    newBackdrop.classList.add('sidebar-backdrop');
                    document.body.appendChild(newBackdrop);
                    newBackdrop.addEventListener('click', toggleSidebar);
                    newBackdrop.classList.add('show');
                } else {
                    backdrop.classList.add('show');
                }
                document.body.classList.add('sidebar-open-mobile');
            } else {
                if (backdrop) {
                    backdrop.classList.remove('show');
                }
                document.body.classList.remove('sidebar-open-mobile');
            }
        } else {
            // On desktop, ensure mobile overlay is hidden and desktop state is applied
            sidebar.classList.remove('show'); // Hide mobile overlay
            document.body.classList.remove('sidebar-open-mobile');
            if (backdrop) {
                backdrop.classList.remove('show');
            }
            if (isSidebarCollapsed) { // Restore desktop collapsed state if it was collapsed
                sidebar.classList.add('collapsed');
                mainContent.classList.add('shifted');
            } else {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('shifted');
            }
        }
    }

    // Run on load and resize
    window.addEventListener('load', () => {
        checkLayoutOnResize();
        // Show the default active section on load (Dashboard Overview)
        showSection('#dashboard-overview');
    });
    window.addEventListener('resize', checkLayoutOnResize);

    // Handle sidebar link clicks to show relevant section
    document.querySelectorAll('.sidebar ul li a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            showSection(targetId);

            // Close mobile sidebar if open after clicking a link
            if (window.innerWidth <= 768 && sidebar.classList.contains('show')) {
                toggleSidebar();
            }
        });
    });
    </script>
</body>

</html>
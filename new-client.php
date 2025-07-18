<?php
include 'includes/header.php';
// Add necessary includes (DB connection and functions)
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get sanitized inputs
    $firstName = sanitize($_POST['firstName']);
    $lastName  = sanitize($_POST['lastName']);
    $email     = sanitize($_POST['email']);
    $phone     = sanitize($_POST['phone']);
    $dob       = sanitize($_POST['dob']);
    $address   = sanitize($_POST['addressLine1']);
    $taluka    = sanitize($_POST['taluka']);
    $district  = sanitize($_POST['district']);
    $state     = sanitize($_POST['state']);
    $postcode  = sanitize($_POST['postcode']);

    // Validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($address)) {
        die('Please fill all required fields.');
    }

    if (!validateEmail($email)) {
        die('Invalid email address.');
    }

    if (!empty($phone) && !validatePhone($phone)) {
        die('Invalid phone number.');
    }

    // Check if email already exists
    if (emailExists($pdo, $email)) {
        die('Email already exists.');
    }

    // Format date (if provided)
    $dobFormatted = null;
    if (!empty($dob)) {
        $dobFormatted = formatDate($dob);
        if (!$dobFormatted) {
            die('Invalid date format.');
        }
    }

    // Prepare data for insertion
    $data = [
        'first_name' => $firstName,
        'last_name'  => $lastName,
        'email'      => $email,
        'phone'      => $phone,
        'dob'        => $dobFormatted,
        'address'    => $address,
        'taluka'     => $taluka,
        'district'   => $district,
        'state'      => $state,
        'postcode'   => $postcode
    ];

    // Insert into database
    if (create_Client($pdo, $data)) {
        // Redirect on success
        header("Location: clients.php?success=1");
        exit();
    } else {
        die("Error inserting client data.");
    }
}
?>


<!-- Add New Client Section ( Form ) -->
<section id='add-new-client' class='mb-5'>
    <div class='dashboard-card'>
        <div class='d-flex justify-content-between align-items-center mb-3'>
            <h5><i class='fas fa-user-plus me-2'></i>Add New Client</h5>
            <a class='btn btn-secondary btn-sm' href='clients'>
                <i class='fas fa-arrow-left me-1'></i> Back to Client List
            </a>
        </div>
        <form method="POST">
            <div class='row g-3 mb-3'>
                <div class='col-md-6'>
                    <label for='firstName' class='form-label'>First Name</label>
                    <input type='text' class='form-control' id='firstName' name='firstName'
                        placeholder='Enter first name' required>
                </div>
                <div class='col-md-6'>
                    <label for='lastName' class='form-label'>Last Name</label>
                    <input type='text' class='form-control' id='lastName' name='lastName' placeholder='Enter last name'
                        required>
                </div>
            </div>
            <div class='row g-3 mb-3'>
                <div class='col-md-6'>
                    <label for='email' class='form-label'>Email Address</label>
                    <input type='email' class='form-control' id='email' name='email' placeholder='Enter email address'
                        required>
                </div>
                <div class='col-md-6'>
                    <label for='phone' class='form-label'>Phone Number</label>
                    <input type='tel' class='form-control' id='phone' name='phone' placeholder='Enter phone number'>
                </div>
            </div>
            <div class='row g-3 mb-3'>
                <div class='col-md-6'>
                    <label for='dob' class='form-label'>Date Of Birth</label>
                    <div class="input-group">
                        <input type='text' id='dob' class='form-control datepicker' name='dob'
                            placeholder='Select Date'>
                        <span class="input-group-text">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                </div>
            </div>

            <hr class='my-4'>
            <h6 class='mb-3 text-primary'>Address Details</h6>
            <div class='row g-3 mb-3'>
                <div class='col-12'>
                    <label for='addressLine1' class='form-label'>Address Line 1</label>
                    <input type='text' class='form-control' id='addressLine1' name='addressLine1'
                        placeholder='House No., Street Name, Area' required>
                </div>
            </div>
            <div class='row g-3 mb-3'>
                <div class='col-md-6'>
                    <label for='taluka' class='form-label'>Taluka</label>
                    <input type='text' class='form-control' id='taluka' name='taluka' placeholder='Enter Taluka'
                        required>
                </div>
                <div class='col-md-6'>
                    <label for='district' class='form-label'>District</label>
                    <input type='text' class='form-control' id='district' name='district' placeholder='Enter District'
                        required>
                </div>
            </div>
            <div class='row g-3 mb-4'>
                <div class='col-md-6'>
                    <label for='state' class='form-label'>State</label>
                    <input type='text' class='form-control' id='state' name='state' placeholder='Enter State' required>
                </div>
                <div class='col-md-6'>
                    <label for='postcode' class='form-label'>Postcode</label>
                    <input type='text' class='form-control' id='postcode' name='postcode' placeholder='Enter Postcode'
                        required>
                </div>
            </div>
            <div class='d-grid gap-2'>
                <button type='submit' class='btn btn-primary btn-lg'>
                    <i class='fas fa-save me-2'></i>Save New Client
                </button>
                <button type='reset' class='btn btn-outline-secondary btn-lg'>
                    <i class='fas fa-undo me-2'></i>Reset Form
                </button>
            </div>
        </form>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr(".datepicker", {
        dateFormat: "d-m-Y",
        allowInput: true,
        plugins: [new confirmDatePlugin({})]
    });
});
</script>


<?php include 'includes/footer.php';
?>
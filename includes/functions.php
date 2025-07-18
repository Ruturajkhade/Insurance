<?php
// Sanitizes input data to prevent XSS ( Cross-site scripting )

function sanitize( $data ) {
    return htmlspecialchars( trim( $data ), ENT_QUOTES, 'UTF-8' );
}

// Validates email format

function validateEmail( $email ) {
    return filter_var( $email, FILTER_VALIDATE_EMAIL );
}

// Validates phone number ( example: only numbers, length of 10 )

function validatePhone( $phone ) {
    return preg_match( "/^[0-9]{10}$/", $phone );
}

// Convert Date format from d-m-Y to Y-m-d ( DB format )

function formatDate( $date ) {
    $formattedDate = DateTime::createFromFormat( 'd-m-Y', $date );
    return $formattedDate ? $formattedDate->format( 'Y-m-d' ) : null;
}

// Function to insert data into the database

function create_Client( $pdo, $data ) {
    $stmt = $pdo->prepare( "INSERT INTO clients 
        (first_name, last_name, email, phone, dob, address, taluka, district, state, postcode) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" );

    return $stmt->execute( [
        $data[ 'first_name' ],
        $data[ 'last_name' ],
        $data[ 'email' ],
        $data[ 'phone' ],
        $data[ 'dob' ],
        $data[ 'address' ],
        $data[ 'taluka' ],
        $data[ 'district' ],
        $data[ 'state' ],
        $data[ 'postcode' ]
    ] );
}

// Fetch all clients ( example )

function getClients( $pdo ) {
    $stmt = $pdo->query( 'SELECT * FROM clients' );
    return $stmt->fetchAll( PDO::FETCH_ASSOC );
}

// Check if email already exists in the database

function emailExists( $pdo, $email ) {
    $stmt = $pdo->prepare( 'SELECT 1 FROM clients WHERE email = ?' );
    $stmt->execute( [ $email ] );
    return $stmt->fetchColumn() !== false;
}
?>
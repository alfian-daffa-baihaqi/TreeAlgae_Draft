<?php

// Set timezone to your desired region (e.g., Asia/Jakarta)
date_default_timezone_set('Asia/Jakarta');

// Get the current time
$response = [
    'Tahun'   => date('Y'),
    'Bulan'   => date('m'),
    'Tanggal' => date('d'),
    'Day'     => date('l'),
    'Jam'     => date('H'),
    'Menit'   => date('i'),
    'Detik'   => date('s'),
];

// Set content type to JSON
header('Content-Type: application/json');

// Return the JSON response
echo json_encode($response, JSON_PRETTY_PRINT);

?>

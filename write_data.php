<?php
include 'db_connect.php';

// Retrieve data from the GET request
if (isset($_GET['id_perangkat'], $_GET['turbidity'], $_GET['ph'], $_GET['do'], $_GET['waktu'], $_GET['historical'])) {
    $id_perangkat = $_GET['id_perangkat'];
    $turbidity = floatval($_GET['turbidity']);
    $ph = floatval($_GET['ph']);
    $do = floatval($_GET['do']);
    $waktu = str_replace("_", " ", $_GET['waktu']);
    $st_historical = intval($_GET['historical']);
    
    if($st_historical == 1){
        $sql = "INSERT INTO historical_data (id_perangkat, turbidity, ph, do, waktu) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sddds", $id_perangkat, $turbidity, $ph, $do, $waktu);
        if ($stmt->execute()) {
            echo "Data historis berhasil disimpan! \n";
        } else {
            echo "Error inserting historical data: " . $stmt->error;
        }
        $stmt->close();
    }
    
    // SQL query to insert or update the data
    $sql = "INSERT INTO update_data (id_perangkat, turbidity, ph, do, waktu) 
            VALUES (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            turbidity = VALUES(turbidity), 
            ph = VALUES(ph), 
            do = VALUES(do), 
            waktu = VALUES(waktu)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sddds", $id_perangkat, $turbidity, $ph, $do, $waktu);
    if ($stmt->execute()) {
        echo "Data berhasil diperbarui!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Missing parameters!";
}
$conn->close();
?>

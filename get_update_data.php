<?php
include 'db_connect.php';

$id_perangkat = "ALGAE_V0";
$sql = "SELECT turbidity, ph, do, waktu FROM update_data WHERE id_perangkat = ? ORDER BY waktu DESC LIMIT 1";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $id_perangkat);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->bind_result($turbidity, $ph, $do, $waktu);

if ($stmt->fetch()) {
    $data = [
        "turbidity" => $turbidity,
        "ph" => $ph,
        "do" => $do,
        "waktu" => date("Y-m-d H:i:s", strtotime($waktu))
    ];
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No data found"]);
}

$stmt->close();
$conn->close();
?>

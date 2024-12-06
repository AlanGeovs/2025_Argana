<?php
// 1. Conectar con la base de datos
$servername = 'localhost';
$username = 'Operaciones Tradex_encuestas';
$password = 'bsT;!jx.V$o[';
$dbname = 'Operaciones Tradex_encuestas';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// 2. Ejecutar la consulta SQL
$sql = "SELECT `id`, `alc`, `calle`, `next`, `nint`, `col`, `sec`, `cred`, `gen`, `p_1`, `p_2_a`, `p_2_b`, `p_2_c`, `p_3`, `p_4`, `p_5`, `p_6_a`, `p_6_b`, `p_6_c`, `p_6_d`, `p_6_e`, `p_6_f`, `p_6_g`, `p_6_h`, `p_7_a`, `p_7_b`, `p_7_c`, `p_7_d`, `p_7_e`, `p_7_f`, `p_7_g`, `p_7_h`, `p_7_i`, `p_7_j`, `p_8_a`, `p_8_b`, `p_8_c`, `p_8_d`, `p_8_e`, `p_8_f`, `p_8_g`, `p_8_h`, `p_8_i`, `p_8_j`, `p_9`, `p_10`, `p_11`, `p_12`, `p_13_a`, `p_13_b`, `p_13_c`, `p_13_d`, `p_14_a`, `p_14_b`, `p_14_c`, `p_14_d`, `p_15_a`, `p_15_b`, `p_15_c`, `p_15_d`, `p_16_a`, `p_16_b`, `p_16_c`, `p_16_d`, `p_17_a`, `p_17_b`, `p_17_c`, `p_17_d`, `p_18_a`, `p_18_b`, `p_18_c`, `p_18_d`, `p_19_a`, `p_19_b`, `p_19_c`, `p_19_d`, `p_20`, `p_21`, `p_22`, `p_23`, `note`, `observaciones`, `created_at`, `id_usuario`, `geoloc` FROM `encuestas` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // 3. Abrir un archivo CSV para la escritura
    $fechaHora = date('Y-m-d_H-i-s');
    $filename = "encuestas_mh_export_$fechaHora.csv";
    // 5. Encabezados para forzar la descarga
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="' . $filename . '"');

    $fp = fopen('php://output', 'w');

    // 4. Escribir los encabezados de las columnas en el archivo CSV
    $row = $result->fetch_assoc();
    fputcsv($fp, array_keys($row));

    // 4. Escribir los datos en el archivo CSV
    fputcsv($fp, $row); // Escribir la primera fila (ya que fetch_assoc se llamó una vez anteriormente)
    while ($row = $result->fetch_assoc()) {
        fputcsv($fp, $row);
    }



    // 6. Cerrar el archivo CSV
    fclose($fp);
} else {
    echo "0 resultados";
}
$conn->close();

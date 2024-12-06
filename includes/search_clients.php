<?php
require '../model/Order.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $results = Order::searchClients($query);
    echo json_encode($results);
}
?>
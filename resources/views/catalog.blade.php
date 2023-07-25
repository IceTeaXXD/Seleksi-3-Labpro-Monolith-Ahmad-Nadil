<!DOCTYPE html>
<html>

<head>
    <style>
        title {
            margin: 0 auto;
        }

        body {
            font-family: sans-serif;
            margin: 0 auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .buy-button {
            background-color: #4CAF50;
            color: white;
            padding: 5px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .buy-button:hover {
            background-color: #3e8e41;
        }
    </style>
    <title>Halaman Katalog Barang</title>
</head>

<body>
    <h1>Halaman Katalog Barang</h1>
    <h2>Daftar Barang</h2>
    <?php

    // get the token from the session 
    $token = $_SESSION['token'];

    // make the request with the token
    $url = $_SESSION['api_url'] . '/barang';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        'Authorization:' . $token,
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    // convert the response to a PHP associative array
    $response_data = json_decode($response, true);

    // check if the request was successful
    if ($response_data['status'] === "success") {
        // display the data
        $items = $response_data['data'];
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nama Barang</th>";
        echo "<th>Harga</th>";
        echo "<th>Stok</th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($items as $item) {
            echo "<tr>";
            echo "<td>" . $item['nama'] . "</td>";
            echo "<td>Rp" . $item['harga'] . "</td>";
            echo "<td>" . $item['stok'] . "</td>";
            echo "<td><a href='purchase.php?item_id=" . $item['id'] . "' class='buy-button'>Beli Barang</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Error retrieving data.";
    }

    ?>
</body>

</html>
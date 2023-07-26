@include('navbar')
<title>Purchase Details</title>
<h1><span class="yellow">Purchase Details</span></h1>
<style>
    @charset "UTF-8";
    @import url(https://fonts.googleapis.com/css?family=Poppins:300);

    body {
        font-family: Poppins;
        font-weight: 300;
        line-height: 1.42em;
        color: #A7A1AE;
        background-color: #1F2739;
    }

    h1 {
        font-size: 3em;
        font-weight: 300;
        line-height: 1em;
        text-align: center;
        color: #4DC3FA;
    }


    .blue {
        color: #185875;
    }

    .yellow {
        color: #FFF842;
    }

    .container td {
        font-weight: normal;
        font-size: 1em;
        -webkit-box-shadow: 0 2px 2px -2px #0E1119;
        -moz-box-shadow: 0 2px 2px -2px #0E1119;
        box-shadow: 0 2px 2px -2px #0E1119;
    }

    .container {
        text-align: left;
        overflow: hidden;
        width: 80%;
        margin: 0 auto;
        display: table;
        padding: 0 0 8em 0;
    }

    .container td {
        padding-bottom: 2%;
        padding-top: 2%;
        padding-left: 2%;
    }


    /* Background-color of the odd rows */
    .container tr:nth-child(odd) {
        background-color: #323C50;
    }

    /* Background-color of the even rows */
    .container tr:nth-child(even) {
        background-color: #2C3446;
    }

    .container td:first-child {
        color: #FB667A;
    }

    .container tr:hover {
        background-color: #464A52;
        -webkit-box-shadow: 0 6px 6px -6px #0E1119;
        -moz-box-shadow: 0 6px 6px -6px #0E1119;
        box-shadow: 0 6px 6px -6px #0E1119;
    }

    .container td:hover {
        background-color: #FFF842;
        color: #403E10;
        font-weight: bold;

        box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
        transform: translate3d(6px, -6px, 0);

        transition-delay: 0s;
        transition-duration: 0.4s;
        transition-property: all;
        transition-timing-function: line;
    }

    .submit-button {
        text-align: center;
    }
</style>
<?php
$quantity = 1;
if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    $url = 'https://single-service-production.up.railway.app/barang/' . $item_id;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // convert the response to a PHP associative array
    $response_data = json_decode($response, true);

    // check if the request was successful
    if ($response_data['status'] === "success") {
        $item = $response_data['data'];
        echo "<table class='container'>";
        echo "<tr><td><a>NAMA BARANG</a></td><td>" . $item['nama'] . "</td></tr>";
        echo "<tr><td><a>HARGA</a></td><td>Rp" . $item['harga'] . "</td></tr>";
        echo "<tr><td><a>STOK</a></td><td>" . $item['stok'] . "</td></tr>";
        echo "<tr><td><a>TOTAL HARGA</a></td><td id='total_harga'>Rp" . $item['harga'] . "</td></tr>";
        echo "<tr><td><a>QUANTITY</a></td><td><input type='number' id='quantityInput' name='quantity' min='1' max='" . $item['stok'] . "' value='" . $quantity . "' required></td></tr>";
        echo "</table>";
        echo "<script>";
        echo "var quantityInput = document.getElementById('quantityInput');"; // Give the input element an ID for easier access
        echo "quantityInput.addEventListener('input', function() {";
        echo "    var harga = " . $item['harga'] . ";";
        echo "    var quantity = parseInt(this.value);";
        echo "    var total_harga = harga * quantity;";
        echo "    document.querySelector('#total_harga').textContent = 'Rp' + total_harga;";
        echo "    quantityInputHidden.value = quantity;"; // Update the hidden input field with the latest quantity value
        echo "});";
        echo "quantityInput.addEventListener('input', function() {";
        echo "    var maxQuantity = " . $item['stok'] . ";";
        echo "    if (this.value > maxQuantity) {";
        echo "        this.value = maxQuantity;";
        echo "    }";
        echo "    this.max = maxQuantity;";
        echo "});";
        echo "</script>";
        echo "<br>";
    } else {
        echo "Error retrieving data.";
    }
} else {
    echo "Item ID not specified.";
}
?>
<br>
<div class='submit-button'>
    <form action='/process_purchase' method='post'>
        @csrf
        <input  name='item_id' value='<?= $item['id'] ?>' hidden>
        <input  name='quantity' id='quantityInputHidden' value='<?= $quantity ?>' hidden>
<button type='submit' class='btn btn-primary'>Beli Barang</button>
</form>
</div>
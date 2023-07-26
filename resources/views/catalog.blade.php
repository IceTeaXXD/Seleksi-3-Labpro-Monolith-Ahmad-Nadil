@include('navbar')
<h1><span class="yellow">Items Catalog</pan>
</h1>
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

    h2 {
        font-size: 1em;
        font-weight: 300;
        text-align: center;
        display: block;
        line-height: 1em;
        padding-bottom: 2em;
        color: #FB667A;
    }

    h2 a {
        font-weight: 700;
        text-transform: uppercase;
        color: #FB667A;
        text-decoration: none;
    }

    .blue {
        color: #185875;
    }

    .yellow {
        color: #FFF842;
    }

    .container th h1 {
        font-weight: bold;
        font-size: 1em;
        text-align: left;
        color: #185875;
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

    .container td,
    .container th {
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

    .container th {
        background-color: #1F2739;
    }

    .container td:first-child {
        color: #FB667A;
    }

    .container td:last-child button {
        border: none;
        color: white;
        padding: 15px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
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
</style>
<table class="container">
    <thead>
        <tr>
            <th>
                <h1>NAMA BARANG</h1>
            </th>
            <th>
                <h1>HARGA</h1>
            </th>
            <th>
                <h1>STOK</h1>
            </th>
            <th>
                <h1>BELI</h1>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php

        $url = 'https://single-service-production.up.railway.app/barang';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        // convert the response to a PHP associative array
        $response_data = json_decode($response, true);

        // check if the request was successful
        if ($response_data['status'] === "success") {
            // display the data
            $items = $response_data['data'];
            foreach ($items as $item) {
                echo "<tr>";
                echo "<td>" . $item['nama'] . "</td>";
                echo "<td>Rp" . $item['harga'] . "</td>";
                echo "<td>" . $item['stok'] . "</td>";
                // echo "<td><a href='purchase.php?item_id=" . $item['id'] . "' class='buy-button'>Beli Barang</a></td>";
                echo "<td><a href='purchase.php?item_id=" . $item['id'] . "'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalCenter'>Beli Barang</button></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "Error retrieving data.";
        }

        ?>
    </tbody>
</table>
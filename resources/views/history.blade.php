@include('navbar')
<title>History</title>
<h1><span class="yellow">PURCHASE HISTORY</span></h1>
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

    /* Previous and Next links */
    .pagination a {
        color: #FFF;
        padding: 8px 16px;
        text-decoration: none;
        background-color: #333;
        border-radius: 5px;
        margin: 2px;
    }

    /* Current active page */
    .pagination a.active {
        background-color: #4CAF50;
    }

    /* Hover effect */
    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }

    /* Center the pagination */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination-form {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
</style>
<div class="pagination-form">
    <form method="get">
        <label for="itemsPerPage">Items Per Page:</label>
        <select name="itemsPerPage" id="itemsPerPage" onchange="this.form.submit()">
            <option value="5" <?php if (isset($_GET['itemsPerPage']) && $_GET['itemsPerPage'] === '5') echo 'selected'; ?>>5</option>
            <option value="10" <?php if (isset($_GET['itemsPerPage']) && $_GET['itemsPerPage'] === '10') echo 'selected'; ?>>10</option>
            <option value="15" <?php if (isset($_GET['itemsPerPage']) && $_GET['itemsPerPage'] === '15') echo 'selected'; ?>>15</option>
            <option value="20" <?php if (isset($_GET['itemsPerPage']) && $_GET['itemsPerPage'] === '20') echo 'selected'; ?>>20</option>
        </select>
    </form>
</div>
<table class="container">
    <thead>
        <tr>
            <th>
                <h1>NAMA BARANG</h1>
            </th>
            <th>
                <h1>JUMLAH BARANG</h1>
            </th>
            <th>
                <h1>TOTAL HARGA</h1>
            </th>
            <th>
                <h1>TANNGAL PEMBELIAN</h1>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php

        use App\Models\History;
        // Define the default number of items per page and the maximum items per page
        $defaultItemsPerPage = 5;
        $maxItemsPerPage = 20;

        // Get the number of items to show per page from the query string
        $itemsPerPage = isset($_GET['itemsPerPage']) ? intval($_GET['itemsPerPage']) : $defaultItemsPerPage;

        // Ensure the itemsPerPage value is within the allowed range
        $itemsPerPage = min(max($itemsPerPage, 1), $maxItemsPerPage);

        $username = session('username');
        $history = History::where('username', $username)->get();


        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $totalItems = History::where('username', $username)->count();
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Adjust the current page number if it exceeds the total number of pages
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        // Calculate the starting index and ending index of items for the current page
        $startIndex = ($currentPage - 1) * $itemsPerPage;
        $endIndex = min($startIndex + $itemsPerPage, $totalItems);

        if ($totalItems == 0) {
            echo "<tr>";
            echo "<td colspan='4'>No items found.</td>";
            echo "</tr>";
        } else {
            // Loop through the items on this page
            for ($i = $startIndex; $i < $endIndex; $i++) {
                $item = $history[$i];
                echo "<tr>";
                echo "<td>" . $item->nama_barang . "</td>";
                echo "<td>" . $item->jumlah_barang . "</td>";
                echo "<td>Rp" . $item->total_harga . "</td>";
                echo "<td>" . $item->created_at . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }


        // Pagination links
        echo "<div class='pagination'>";
        for ($page = 1; $page <= $totalPages; $page++) {
            $isActive = ($page == $currentPage) ? 'active' : '';
            echo "<a href='?page=" . $page . "&itemsPerPage=" . $itemsPerPage . "' class='" . $isActive . "'>" . $page . "</a>";
        }
        echo "</div>";
        ?>

    </tbody>
</table>
<script>
    // Function to refresh the content
    function refreshContent() {
        // Reload the page
        location.reload();
    }

    const pollingInterval = 10000;

    // Set the interval to refresh the content
    setInterval(refreshContent, pollingInterval);
</script>
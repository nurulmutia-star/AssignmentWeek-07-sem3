<?php
session_start();

// Inisialisasi shopping cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Proses penambahan kuantitas
if (isset($_POST['add'])) {

    foreach ($_POST['quantity'] as $item => $qty) {

        if (is_numeric($qty) && $qty > 0) {

            if (isset($_SESSION['cart'][$item])) {
                // Kuantitas ditambahkan, bukan ditimpa
                $_SESSION['cart'][$item] += (int)$qty;
            } else {
                // Menambahkan item baru
                $_SESSION['cart'][$item] = (int)$qty;
            }
        }
    }
}

// Proses pengurangan kuantitas
if (isset($_POST['remove'])) {

    $item = $_POST['remove'];

    if (isset($_SESSION['cart'][$item])) {

        $_SESSION['cart'][$item]--;

        // Hapus item jika kuantitas mencapai 0
        if ($_SESSION['cart'][$item] <= 0) {
            unset($_SESSION['cart'][$item]);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart Test</title>
</head>

<body>

<h1>Items Available</h1>

<form action="AssignmentWeek-07.php" method="post">

    <table border="1" cellpadding="8">

        <tr>
            <th>Item</th>
            <th>Quantity</th>
        </tr>

        <tr>
            <td>Apples</td>
            <td>
                <input type="number"
                       name="quantity[apples]"
                       min="0"
                       value="0">
            </td>
        </tr>

        <tr>
            <td>Bananas</td>
            <td>
                <input type="number"
                       name="quantity[bananas]"
                       min="0"
                       value="0">
            </td>
        </tr>

    </table>

    <br>

    <input type="submit" name="add"
           value="Click to add to cart">

</form>

<br>

<fieldset style="width:300px">

    <legend>Your Shopping Cart</legend>

    <?php
    if (empty($_SESSION['cart'])) {

        echo "Your shopping cart is empty.";

    } else {

        echo "<table border='1' cellpadding='8'>";

        echo "<tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Action</th>
              </tr>";

        foreach ($_SESSION['cart'] as $key => $value) {

            echo "<tr>";

            echo "<td>" . htmlspecialchars($key) . "</td>";

            echo "<td>" . $value . "</td>";

            echo "<td>
                    <form action='AssignmentWeek-07.php' method='post'>
                        <button type='submit' name='remove'
                        value='" . htmlspecialchars($key) . "'>
                            Remove
                        </button>
                    </form>
                  </td>";

            echo "</tr>";
        }

        echo "</table>";
    }
    ?>

</fieldset>

</body>
</html>
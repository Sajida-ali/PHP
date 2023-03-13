<link rel="stylesheet" href="menu.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<ul>
    <li style="margin-left: 500px "><a class="active" href="home.php">Home</a></li>
    <li><a type="submit" href="cart.php">shopping</a></li>
</form>
<form action="cart.php" method="post">
  <input type="submit" name="logout" value="Logout">
</form>
    </ul>

	<body style="background:black;color :white">

<?php
session_start();


$con = new mysqli("localhost", "root", "", "orot2000");
if (!$con) {
    die("Error connecting to database: " . mysqli_connect_error());
}



$result = mysqli_query($con, 'SELECT * FROM lamps');

?>
<table cellpadding="2" cellspacing="2" border="0">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Price</th>
  
    </tr>
    <?php while ($item = mysqli_fetch_object($result)) { ?>
        <tr>
            <td><?php echo $item->code; ?></td>
            <td><?php echo $item->name; ?></td>
            <td><?php echo $item->price; ?></td>
		

            <td>
                <a href="cart.php?code=<?php echo $item->code; ?>&quantity=1">Add to cart</a>
            </td>
        </tr>
    <?php } ?>
</table>

<table cellpadding="2" cellspacing="2" border="1">
    <tr>
        <th>Option</th>
        <th>Code</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Sum </th>
    </tr>

  <?php if (isset($_SESSION['cart'])) {
		
        $totalSum = 0;
        foreach ($_SESSION['cart'] as $item) {
            $sum = $item->quantity * $item->price;
            $totalSum += $sum;
    ?>
        <tr>
            <td>
				<?php
				if ($item->quantity >= 1) {
					echo '<a href="cart.php?code=' . $item->code . '&quantity=-1">-</a>';
				}
				?>
				<a href="cart.php?code=<?php echo $item->code; ?>&quantity=1">+</a>
                <a href="cart.php?remove=<?php echo $item->code; ?>">Remove</a>
            </td>
            <td><?php echo $item->code; ?></td>
            <td><?php echo $item->name; ?></td>
            <td><?php echo $item->price; ?></td>
            <td><?php echo $item->quantity; ?></td>
            <td><?php echo $sum; ?></td>
        </tr>
    <?php
        }	
    ?>
        <tr>
            <td colspan="5">Total Sum:</td>
            <td><?php echo $totalSum; ?></td>
        </tr>
		<tr>
		
    <?php

	}

	
	
     ?>
	 
</table>
<?php
function emptyCart() {
  $_SESSION['cart'] = array();
}
?>

<?php

function check_stock($code, $quantity) {
  $stock = get_product_stock_from_database($code);
  if ($quantity > $stock) {
    echo "<script>alert('The product is out of stock!');</script>";
    return false;
  } else {
    return true;
  }
}

?>
<?php

?>

	<?php
	
if (isset($_GET["buy"])) {

	$q="SELECT customerid from customers";
	$result2 = mysqli_query($con, $q);
      $query = "SELECT * from lamps";
      $result = mysqli_query($con, $query);
	  emptyCart();
      while ($row = mysqli_fetch_array($result)) {
           foreach ($_SESSION["cart"] as $keys => $values) {          
	if ($row["code"] == $values["id"] && $row["quantity"] > $values["item_quantity"]) {
      $edit_p = "update lamps set quantity = quantity-'" . $values["item_quantity"] . "'WHERE code = '" . $values["id"] . "'";
          mysqli_query($con, $edit_p);
		  
       $customer_code_query = "SELECT customerid FROM customers";
$customer_code_result = mysqli_query($con, $customer_code_query);
$customer_code = mysqli_fetch_assoc($customer_code_result)['customerid'];
$purchase_amount = $_POST['hidden_price'] * $_POST['quantity'];
$add_to_order_query = "INSERT INTO order_table (price, customerid) VALUES ('$purchase_amount', '$customer_code')";
mysqli_query($con, $add_to_order_query);
		  }     
      }
 }
 

if (isset($_SESSION['customer_id']) && isset($_SESSION['total_sum'])) {
  $customer_id = $_SESSION['customer_id'];
  $total_sum = $_SESSION['total_sum'];

 
$con = new mysqli("localhost", "root", "", "orot2000");
  $query = "INSERT INTO orders ('total_sum','customer_id') VALUES ( '$total_sum','$customer_id')";
  if (mysqli_query($con, $query)) {
    echo "Order placed successfully";
  } else {
    echo "Error placing order: " . mysqli_error($con);
  }
  mysqli_close($con);

} 
 
}
 if (isset($_GET['remove']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}
 if (isset($_GET['code']) && isset($_GET['quantity'])) {
    $code = $_GET['code'];
    $quantity = intval($_GET['quantity']);

    $result = mysqli_query($con, 'SELECT * FROM lamps WHERE code=' . $code);
    $item = mysqli_fetch_object($result);

    $new_quantity = $item->quantity - $quantity;

    if ($new_quantity >= 0) {
        $update = mysqli_query($con, "UPDATE lamps SET quantity = '$new_quantity' WHERE code = '$code'");

        if (isset($_SESSION['cart'][$code])) {
            $item->quantity = $_SESSION['cart'][$code]->quantity + $quantity;
        } else {
            $item->quantity = $quantity;
        }

        $_SESSION['cart'][$code] = $item;
    }
	
	
}
	
	
	if (isset($_POST["add_to_cart"])) {
  if ($_POST["quantity"] > 0) {
    if (!isset($_SESSION["cart"])) {
      $_SESSION["cart"] = [];   
    }
    $item_array_id = array_column($_SESSION["cart"], "code");
    if (!in_array($_GET["id"], $item_array_id)) {
      $count = count($_SESSION["cart"]);
      $item_array = [
        'code' => $_GET["id"],
        'name' => $_POST["hidden_name"],
        'price' => $_POST["hidden_price"],
        'quantity' => $_POST["quantity"],
      ];

      if (check_stock($_GET["id"], $_POST["quantity"])) {
        $_SESSION["cart"][$count] = $item_array;
	  }
      }
    }
  }



?>




<?php

function logout() {
  unset($_SESSION['cart']);
}
if (isset($_POST['logout'])) {
  logout(); 
  header("Location: login1.php");
  exit;
}

?>

<form action="cart.php" method="GET">
  <table>
    <tr>
      <td colspan="5"></td>
      <td><button type="submit" name="buy">buy</button></td>
    </tr>
  </table>







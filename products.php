<link rel="stylesheet" href="menu.css" />
<link rel="stylesheet" href="product.css" />
<body style="background:black;color :white">

    <ul>
      
        <li><a href="login1.php">logout</a></li>
        <li><a href="productupload.php">productupload</a></li>
    </ul>


  <?php
$conn = new mysqli("localhost", "root", "", "orot2000");
if (!$conn) {
  die("Error connecting to database: " . mysqli_connect_error());
}

$sql = "SELECT * FROM lamps";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 ?>
<table> 
  <tr>
    <th>Code</th>
    <th>Name</th>
    <th>Price</th>
    <th>Quantity</th>
  </tr>
  <?php
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['code'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
	echo "<td>" . $row['quantity'] . "</td>";
    echo "<td>";
    echo "<form action='products.php' method='post'>";
    echo "<input type='hidden' name='code' value='" . $row["code"] . "'>";
    echo "<input type='submit' value='Delete' name='delete_product'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
  }
  ?>
  </table> <?php
} else {
  
  echo "No products found";
}

if(isset($_POST['delete_product'])){
    $code = $_POST['code'];
    $sql = "DELETE FROM lamps WHERE code='$code'";
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<?php
if(isset($_POST['submit'])){
 
  $code = $_POST['code'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  if(!empty($code) && !empty($name) && !empty($price) && !empty($quantity)&& ($quantity)>0){
$sql = "UPDATE lamps SET name='$name', price='$price', quantity='$quantity' WHERE code='$code'";
if ($conn->query($sql) === TRUE) {
echo "Product updated successfully";
  header('Location: products.php');
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}else{
echo "Please fill all the fields";
}
}

$conn->close();
?>


<div >
<form class="f" action="products.php" method="post">
	<div class="container">
		<h2>Update product</h2>

		<label for="code">Code:</label><br>
		<input style="background:black" type="text" id="code" name="code"><br>
		<label for="name">Name:</label><br>
		<input style="background:black" type="text" id="name" name="name"><br>
		<label for="price">Price:</label><br>
		<input style="background:black" type="text" id="price" name="price"><br>
		<label for="quantity">Quantity:</label><br>
		<input style="background:black" type="text" id="quantity" name="quantity"><br>
		<input type="submit" value="Update" name="submit">
	</div>
</form>
</div>
</body>
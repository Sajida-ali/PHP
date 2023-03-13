<body style="background-color:black" >

<form class="form" method="POST" action="productupload.php"  enctype="multipart/form-data">
		<h2 style="color: white;padding-left:15px">Add product:</h2>
	<div  style="margin:auto ;border:5px white solid;background-color: black;color: white;width: 400px;height:320px;">
		<div style="margin-top:30px">
		<label style="padding-left:15px" for="name">Name:</label><br>
		<input style="color:white;background:black;margin-left:15px" type="text" id="name" name="name"><br>
		<label style="padding-left:15px" for="code">Code:</label><br>
		<input style="color:white;background:black;margin-left:15px" type="text" id="code" name="code"><br>
		<label style="padding-left:15px" for="price">Price:</label><br>
		<input style="color:white;background:black;margin-left:15px" type="text" id="price" name="price"><br>
		<label style="padding-left:15px" for="quantity">Quantity:</label><br>
		<input style="color:white;background:black;margin-left:15px" type="text" id="quantity" name="quantity"><br>
		<br>
		<div>
			<input style="margin-left:15px" type="file" name="image">
		</div>
		<br>	
		<hr>
			<input style="margin-left:150px" type="submit" name="upload" value="Upload product">
		</div>
	</div>
</form>
<li><a href="products.php">our products</a></li>
<hr>
<h1 style="color:white">My Product: </h1>

</body>


<style>
<?php include 'C:\wamp64\www\image_upload_example/Style.css'; ?>
</style>
<?php
	$msg = "";
	
	if(isset($_POST['upload']))
{
	$db = mysqli_connect("localhost","root","","orot2000");
	$code = $_POST['code'];
	$sql = "SELECT * FROM lamps WHERE code='$code'";
	$result = mysqli_query($db, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo "<script>alert('Product with the same code already uploaded!!!');</script>";
	}  
	
		if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {

} else {
    echo "Please select an image to upload.";
}
		$target = "images/".basename($_FILES['image']['name']); 
		$db = mysqli_connect("localhost","root","","orot2000");
		
		$name = $_POST['name'];
		$code = $_POST['code'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
	$image = time() . $_FILES['image']['name'];

	$sql = "INSERT INTO lamps (code,name ,price, quantity,image) VALUES ('$code','$name','$price', '$quantity','$image')";
		mysqli_query($db,$sql); 
		
		$target = "images/".$image;
if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
    $msg = "Image uploaded successfully";
		}
		else
		{
			$msg = "There was a problem uploading image";	
		}
	}
	$db = mysqli_connect("localhost","root","","orot2000");
	$sql= "SELECT * FROM lamps";
	$result = mysqli_query($db,$sql);
	while($row = mysqli_fetch_array($result))

	{
?>

<div style="float:left;margin-left:30px;border: 3px white solid;color:white;width:250px;height:300px; margin-top:20px; float:center">
	<div style=" margin-left:7px">
		<?php   echo "<div class='product'>"; ?> 	</div>
		<?php   echo "<form action='productupload.php' method='post'>"; ?>
		<?php   echo "<h2>" . $row["name"]. "</h3>";  ?>
		<?php   echo "<p>Code: " . $row["code"]. "</p>"; ?>
		<?php   echo "<p>Price: $" . $row["price"]. "</p>";?>
		<?php   echo "<p>Quantity: " . $row["quantity"]. "</p>"; ?>
		<?php 	echo "<div id = 'img_div'>"; ?>	</div>
	</div>
	<div style="border: 1px white solid;width:230px;height:120px ; margin-left:3px ">
		<?php   echo "<img src ='images/".$row['image']."'>"; ?>
	</div>
	</table>
</div>
<?php 
	}
	?>




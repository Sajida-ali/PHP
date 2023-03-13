<?php
session_start();

$con = new mysqli("localhost", "root", "", "orot2000");
if (!$con) {
  die("Error conecting to database: " . mysqli_conect_error());
}


$result = mysqli_query($con,'select * from lamps');
?>
<?php while($lamps	 = mysqli_fetch_object($result)){ ?>
		<tr>
			<td style="border:2px solid white"><?php echo $lamps->code; ?> </td>
			<td style="border:2px solid white"> <?php echo $lamps->name; ?></td>
			<td style="border:2px solid white"> <?php echo $lamps->price; ?></td>
			<td style="border:2px solid white"><a href="cart.php?code=<?php echo $lamps->code; ?>"> Order Now</a></td>
		</tr>
<?php }  ?>
<?php 
	//$cart2=array();
	//$cart2 = serialize($_SESSION['cart']);
	//foreach($c as $cart2){
	//echo $c->price;
	//echo '<script>alert('.$arr[0].')</script>';
		
		//for($i=0;$i<$_SESSION['cart'];$i++){
		//echo $cart2[$i];
		//}
	//echo count($cart2);
	//for($i=0 ; $i<count($cart2);$i++){
	//		echo ($cart2[$i]->price);
	//}
	
 ?>

<body style="background-color:black;color:white">
<link rel="stylesheet" href="logincss.css" />

<form action="login1.php" method="post">
  <div class="container" >
  <h1 style="color:white">Welcome</h1>
    <label for="uname"><b>Username</b></label>
    <input style="background-color:black"  type="text" id="id" name="id"><br>

    <label  for="psw"><b>Password</b></label>
    <input style="background-color:black"type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" name="submit">Login</button>
    <label>
      <input style="background-color:black" type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  
	<span style="float:right; padding-top: 16px;">Don't have account <a href="Register.php">Register?</a></span>
  </div>

</form>

</body>
<?php
  $conn=new mysqli("localhost","root","","orot2000");
  if(!$conn){
    die("not connected".mysqli_error());
  }
	if(isset($_POST['submit'])){
		if($conn->connect_error){
			die("Connection failed: ".$conn->connect_error);
								}
			else{
				echo "Connected successfully";
				}
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = "SELECT * FROM custumers WHERE id='$id' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);
    if($result_check > 0){
      header('Location: home.php');
						 }
			else{
				echo "Invalid id or password";
				}
	$id = mysqli_real_escape_string($conn,$_POST['id']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = "SELECT * FROM workers WHERE id='$id' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);
			if($result_check > 0){
				header('Location: productupload.php');
								 }
					else{
						echo "Invalid id or password";
						}
								}
?>

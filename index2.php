<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Address Book Assignment- Ajebo Market </title>
    
    
    
    
        <link rel="stylesheet" href="css/style.css">
         <link rel="stylesheet" href="css/font-awesome.min.css">

    
    
    
  </head>

  <body>
<?php 
require_once "resources/addBookClass.php";
$add = new addBookClass();
if (!isset($_REQUEST['search']) && !empty($_REQUEST))
{
	$sql = "INSERT INTO addbook (name,email,phone) VALUES ('".$_REQUEST['name']."','".$_REQUEST['email']."','".$_REQUEST['phone']."')";
	$res = $add->proccessSql($sql);
	if($res==true)
	{
		$msg = "<div> Address Book is submitted succesfully";
	}else
	{
		$msg = "<div> Address Book is not succesfully submitted";
	}
}
?>
    <div class="address-book">

<div class="address-book-header">
 <i class="fa fa-book"> </i> Address Book

</div>
  
  <div class="form">
	<?php echo @$msg; ?>
    <form class="search-form" action="index2.php">
      <input type="text" placeholder="Search" name='search'/><span class="form-icon"> <i class="fa fa-search"> </i></span>
     </br>
      <button name="search_but">Search</button>
      <p class="message">  Add a Record ? <span class="change">  <i class="fa fa-chevron-circle-right"></i> Enter</span></p>
    </form>

	
    <form class="address-form" action="index2.php">
     <input type="text" name="name" placeholder="Name"/><span class="form-icon"> <i class="fa fa-user"> </i></span>
      <input type="text" name="phone" placeholder="Phone"/><span class="form-icon"> <i class="fa fa-mobile-phone"> </i></span>
      <input type="text" name="email" placeholder="Email"/><span class="form-icon"> <i class="fa fa-envelope-o"> </i></span>

      </br>
      <button name="submit">Submit</button>
      <p class="message">Looking for a Record ? <span class="change">  <i class="fa fa-chevron-circle-right"></i> Search</span></p>
    </form>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

	<?php
	if (isset($_REQUEST['search_but']))
	{
	$sql = "SELECT * FROM addbook WHERE name ='".$_REQUEST['search']."' OR phone ='".$_REQUEST['search']."' OR email ='".$_REQUEST['search']."'";
	$rows = $add->fetch($sql);
	foreach ($rows AS $row):
	echo
	"<table width='100%' border='0'>
	  <tr>
		<td>".$row['name']."</td>
		<td>".$row['email']."</td>
		<td>".$row['phone']."</td>
	  </tr>
	</table>";
	endforeach;
	}
	?>
    
    
    
  </body>
</html>

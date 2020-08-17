<?php require_once('init.php'); ?>

<?php
class Item {
	
	private $item_number;
	private $name;
	private $type;
	private $make;
	private $model; 
	private $brand;
	private $description;
	
	//create constractors & $this
	
	function __construct ($anitem_number,$aname,$aType,$aMake,$aModel,$aBrand,$aDescription){
		
		$this->setItem_number($anitem_number);
		$this->setName($aname);		
		$this->setAtype($aType);
		$this->setMake($aMake);
		$this->setModel($aModel);
		$this->setBrand($aBrand);
		$this->setDescription($aDescription);
	
	}
	
    public function getItem_number()
	{
		return $this->item_number;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getAtype(){
		return $this->type;
	}
	public function getMake(){
		return $this->make;
	}
	public function getModel(){
		return $this->model;
	}	
	public function getBrand(){
		return $this->brand;
	}
	public function getDescription(){
		return $this->description;
	}
		
	
	public function setItem_number($anitem_number)
	{
		$this-> item_number=$anitem_number;
	}
	public function setName($aname)
	{
		$this-> name=$aname ;
	}
	public function setAtype($aType){
		$this->type=$aType;
	}
	public function setMake($aMake){
		 $this-> make=$aMake;
	}
	public function setModel($aModel){
		 $this->model=$aModel;
	}	
	public function setBrand($aBrand){
		 $this-> brand=$aBrand;
	}
	public function setDescription($aDescription){
		 $this-> description=$aDescription;
	}
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8" />

  <title>index</title>
  <link rel="stylesheet" href="style.css">
  <!-- Load an icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    
    * {
      box-sizing: border-box;
    } 
    
    #myInput {
      background-image: url('/css/searchicon.png');
      background-position: 20px;  
      width: 50%;
      font-size: 20px;
      padding: 20px;
      border: 10px solid #ddd;
      margin-bottom: 12px;
      border-radius: 35px;
    }
       
    #myTable {
      
      border-collapse:inherit;
      width: 80%;
      border: 0px solid #ddd;
      font-size: 18px;
      margin-left: auto;
      margin-right: auto;
    }
    
    #myTable th, #myTable td {
      text-align: left;
      padding: 12px;      
    }
    
    #myTable tr {
      border-bottom: 1px solid #ddd;
    }

    .content {    
      margin-top: 30px;
      text-align: center;
    }
    .content ul {
       list-style: none; 
       position: relative; 
   
       display: block; 
       left: 50%;      
    }

    .content ul li { 
      position: relative; 
      display: block; 
      right: 50%;     
    }

    table, th , td {
      border: 1px solid black;
    }
    </style>

</head>

<body>
  <div class="navbar">
    <a class="active" href="index.html"><i class="fa fa-fw fa-home"></i> Home</a>
    <div class="menu">
      <a href="#"><i class="fa fa-fw fa-search"></i> Product</a>
      <div class="submenu">
        <a href="#">Product 1</a>
        <a href="#">Product 2</a>
      </div>
    </div>

    <div class="menu">
      <a href="contact.html"><i class="fa fa-fw fa-phone"></i> Contact Us</a>
      <div class="submenu">
        <a href="#"><img src="fr.png" alt="French" width="30">  Contactez-nous</a>
        <a href="#"><img src="vn.png" alt="VietName" width="30">  Liên Hệ</a>
      </div>
    </div>
    <a href="aboutme.html"><i class="fa fa-fw fa-user"></i> About Me</a>
  </div>
  <p id="Hello"></p>
  <br>
  <h1>WELCOME TO OUR WEBSITE</h1>
<p style="font-size:30px;"><strong><em>Our product with everything you need for fashion, sport , accessories</em></strong></p>
<div class="content">
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for name or type of item ..." title="Type in a name">
</div>


<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

$conn->select_db("items_DB");

$sql= "SELECT * FROM items";
$item_list = $conn->query($sql);
$items = array();

if($item_list->num_rows > 0) {
  while($item = $item_list->fetch_assoc()){
    $items[] = $item;
  }
} else {
  die("No item found");
}
$conn->close();

 ?>
 
 <table id="myTable">
    <thead>
      <tr class="header">
          <th>Item# </th>
          <th>Name</th>
          <th>Type</th>
          <th>Make</th>
          <th>Model</th>
          <th>Brand</th>
          <th>Description</th>
      </tr>
    </thead>
 <tbody>

 <?php
 foreach($items as $item){
   echo <<<END
   <tr>
      <td>{$item['id']}</td>
      <td>{$item['name']}</td>
      <td>{$item['type']}</td>
      <td>{$item['make']}</td>
      <td>{$item['model']}</td>
      <td>{$item['brand']}</td>
      <td>{$item['description']}</td>
   </tr>

END;
 }
 ?>
 </tbody>
  </table>

<script>
    window.onload = function() {
    var rows = document.querySelectorAll('tr:not(.header)');
    for (var i = 0; i < rows.length; i++) {
    rows[i].style.display = 'none';
  }
}
  // How TO - Filter/Search Table From https://www.w3schools.com/howto/howto_js_filter_table.asp
  // This function filter/search from user input text
  function myFunction() {
    // Declare variables
    var input, filter, table, tr, x, td, td1, i, txtValue, txtValue1, items;
    var hideHeader = true;

    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");  

    // Loop through all list items, and hide those who don't match the search query  
    for (i = 0; i < tr.length; i++) {      
      td = tr[i].getElementsByTagName("td")[2];   
      td1 = tr[i].getElementsByTagName("td")[1];   
      if (td || td1) {
        txtValue = td.textContent;
        txtValue1 = td1.textContent;
        if ((txtValue.toUpperCase().indexOf(filter) > -1 && filter != "") || (txtValue1.toUpperCase().indexOf(filter) > -1 && filter != "")) {
            tr[i].style.display = "table-row";
            hideHeader = false;    
        } else {
          tr[i].style.display = "none";
        }
      }
    }
    if(!hideHeader){
       document.querySelector("thead > tr").style.display = "table-row";
     }else {
      document.querySelector("thead > tr").style.display = "none";
     }
  } 
  
  window.onload = myFunction();
</script>
<script>
  // message to user when login the website
  var date = new Date();
  var hour = date.getHours();
  var message;
  if(hour > 0 && hour < 6){
    message = 'Good morning, you must be an early bird!';
  } else if(hour>=6 && hour<12) {
    message = 'Good morning!';
  }else if(hour>=12 && hour <18){
    message = 'Good Afternoon!';
  }else if(hour>=18 && hour <24){
    message = 'Good evening!';    
  }
  document.getElementById('Hello').innerHTML = '<b>' + message + '</b>';
</script>
</body>

</html>
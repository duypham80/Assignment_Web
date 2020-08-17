<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }
echo "Connected successfully";


//  Create database
$sql = "CREATE DATABASE items_DB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->select_db("items_DB");


//sql to create table
$sql = "CREATE TABLE Items (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(40) ,
    type VARCHAR(40) ,
    make VARCHAR(40) ,
    model VARCHAR(40) ,
    brand VARCHAR(40) ,
    description VARCHAR(60) 
    
     )";
     
    
     if ($conn->query($sql) === TRUE) {
       echo "Table Items created successfully";
     } else {
       echo "Error creating table: " . $conn->error;
     }
    $sql = "alter table items auto_increment=100";
    if ($conn->query($sql) === TRUE) {
      echo "Table Items created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }

   // create items
    $input_items = array();
    $input_items[] = ["The Exodus Mens Printed Softshell Jacket"  ,"Jacket"  ,"2019",  "JK-W"  ,"Moutain Warehouse",  "Water-resistant outer with a soft, bonded lining"];
    $input_items[] = ["The Trail Extreme Jacket", "Jacket", "2020",  "	JK-W"," Moutain Warehouse" ,"Waterproof and breathable fabric "];
    $input_items[] = ["The Field Waterproof Vibram Boots",  "Footwear",  "2019" ,  "FW-S",   "Sport Experts",  "With Vibram outsole for improved traction"];
    $input_items[] = ["Mens Waterproof IsoGrip Boots" , "Footwear",  "2019" ,  "FW-N",  "Sport Check", "High traction rubber outsole and cushioned insole"];
    $input_items[] = ["The Dusk Mens Ski Jacket", "Ski",  "2020", "SK-S", "Sport Experts","Made from water resistant and windproof fabric"];
    $input_items[] = ["Asteroid Mens Ski Jacket",  "Ski" ,"2019 ","SK-M", "Sport Check",  "Made of our IsoDry fabric with taped seams"];
    $input_items[] = ["Hayman Polarised SunglassesI",  "Accessories",  "2020", "AC-T1", "Moutain Warehouse", "Durable plastic frame, with UV400 lenses"];
    $input_items[] = ["Mountain Warehouse Baseball Cap"  ,"Accessories", "2018", "AC-T2",  "Moutain Warehouse", "Designed in 100% cotton twill, it's breathable"];
    $input_items[] = ["PineWood 6 Person Doom Tent", "Camping",  "2021", "CA-M", "Columbia", "Dual triangle venting for excellent air ventilation"];    
    $input_items[] = ["PineWood 8 Person Doom Tent", "Camping",  "2019", "CA-L", "Columbia", "Dual triangle venting with 3 storage "];
    $input_items[] = ["Trilby Straw Sun Hat",  "Accessories",  "2018"  ,"AC-S"  ,"Moutain Warehouse", "The unisex trilby hat is one size measuring 58cm"];
    
    
    $add_items = $conn->prepare("INSERT INTO Items(name, type, make, model, brand, description) VALUES (?, ?, ?, ?, ?, ?)");

    $add_items->bind_param("ssssss", $name, $type, $make, $model, $brand, $description );

    foreach($input_items as $item){
      $name= $item[0];
      $type=$item[1];
      $make=$item[2];
      $model=$item[3];
      $brand=$item[4];
      $description=$item[5];
     
      $add_items->execute();

    }
$add_items->close();

 ?>
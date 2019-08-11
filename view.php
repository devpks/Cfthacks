<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="5">
</head>
<body>
<style>
#c4ytable {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#c4ytable td, #c4ytable th {
    border: 1px solid #ddd;
    padding: 8px;
}

#c4ytable tr:nth-child(even){background-color: #f2f2f2;}

#c4ytable tr:hover {background-color: #ddd;}

#c4ytable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #00A8A9;
    color: white;
}
	#header {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			
	}
	
	#mySearch {
  background-image: url('/css/searchicon.png');
  background-position: 100px 100px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 2px solid #black;
  margin-bottom: 12px;
}

#r {
	color : red;
	font-size: 16px;
}


</style>


<?php
    //Connect to database and create table
    	$servername = "localhost";
	$username = "1092449";
	$password = "wordpress25";
	$dbname = "1092449";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
        echo "<a href='install.php'>If first time running click here to install database</a>";
    }
?> 


<div id="cards" class="cards">

<?php 
    $sql = "SELECT * FROM water ORDER BY id DESC";
    if ($result=mysqli_query($conn,$sql))
    {
      // Fetch one and one row
	  echo "<center><H1 id='header'>Captiozon Systems</H1></center>";
	  echo "<center><H1 id='r'>Chattarpur Real Time Data Analysis</H1></center>";
 echo "<input type='text' id='mySearch' height='100px' width='100px' onkeyup='myFunction()' placeholder='Search for place and zone...' title='Type in a name'>";
	      
	 echo "<TABLE id='c4ytable'>";
	  echo "<TR><TH>Sr.No.</TH><TH>pH Level</TH><TH>turbidity</TH><TH>Dissolved oxygen</TH><TH>Date</TH><TH>Time</TH></TR>";
      
	  
	  while ($row=mysqli_fetch_row($result))
      {
			
        echo "<TR>";
        echo "<TD>".$row[0]."</TD>";
        echo "<TD>".$row[1]."</TD>";
        echo "<TD>".$row[2]."</TD>";
        echo "<TD>".$row[3]."</TD>";
        echo "<TD>".$row[4]."</TD>";
        echo "<TD>".$row[5]."</TD>";
        echo "</TR>";
      }
      echo "</TABLE>";
      // Free result set
      mysqli_free_result($result);
    }

    mysqli_close($conn);
?>

 <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("mySearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("c4ytable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>
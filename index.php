
<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <style>
    body{
      background:rgb(210, 210, 236);
    }
    </style>

<div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="images/holiday2.jpg." alt="Survive" style="width:400px;">
      </div>

      <div class="item">
        <img src="images/holiday4.jpg." alt="Survive" style="width:400px;">
      </div>


      
    
      <div class="item">
        <img src="images/holiday5.jpg." alt="Survive" style="width:400px">
      </div>

      <div class="item">
        <img src="images/holiday6.jpg." alt="Survive" style="width:400px;">
      </div>

      <div class="item">
        <img src="images/holiday7.jpg." alt="Survive" style="width:400px;">
      </div>

      <div class="item">
        <img src="images/holiday8.jpg." alt="Survive" style="width:400px;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
  
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">Plan,organise and list your holiday todos</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
		<input type="text" name="task" class="task_input">
    <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>   
  </form>
 </body>
 </html>
  

  <?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
  <?php } ?>

 
   
  <?php 
    // initialize errors variable
  $errors = "";

  define("DB_SERVER","localhost");
  define("DB_USERNAME","root");
  define("DB_PASSWORD","new_password");
  define("DB_DATABASE", "registration");

	// connect to database
  $db = mysqli_connect('localhost', 'root', 'new_password', 'registration');
    

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$tasks = $_POST['task'];
			$sql = "INSERT INTO task (task) VALUES ('$tasks')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
  }	

  
// delete task
if (isset($_POST['del_task'])) {
	$id = $_POST['del_task'];

	mysqli_query($db, "DELETE FROM task WHERE id=".$id);
	header('location: index.php');
}

?>



<table>
	<thead>
		<tr>
			<th>N</th>
			<th>Tasks</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
    $tasks = mysqli_query($db, "SELECT * FROM task");
		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete">
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>

  








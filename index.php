
<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
  <link rel= "stylesheet" text="text/css" href="style.css">
</head>

<body>
 
<div class="block"> 
  
	<div id="image">
		<img src="images/holiday5.jpg" alt="thailand" width="300px">
	</div>

	<div class="heading">
		<h2 style="font-style: 'Hervetica';">Plan,organise and list your holiday to do's.</h2>
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
  define("DB_DATABASE", "todo");

	// connect to database
  $db = mysqli_connect('localhost', 'root', 'new_password', 'todo');
    

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
			<th style="width: 70px;">Action</th>
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



  








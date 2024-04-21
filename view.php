<html>
<head>
<title>Final Exam </title>
</head>
<style>
table{
text-align:center;
border-collapse: collapse;
width: 75%;
}
th{
font-size: 20px;
}
td{
font-size: 18px;
}
td, th{
border: 1px solid;
}
input{
text-align:center;
padding: 5px;
font-size:20px;
border-radius: 50px;
}
button{
font-size: 20px;
}
</style>
<body>
<center>
<div style="width: 75%; margin-top:5%;">
<form action="" method="GET">
<button type="submit" name="add_data" style="float:left; margin-left: 13%; color: green; font-size: 20px; border:none;">Add Data</button>
</form>
<form action="" method="post">
<button type="submit" name="DA" style="float:right; margin-right: 13%; color: red; font-size: 20px; border:none;">Delete All</button>
</form>
<table>
<th>First Name</th>
<th>Last Name</th>
<th>Age</th>
<th colspan="2">Action</th>
<?php 
include('server.php');
$query = mysqli_query($connect,"SELECT * FROM student") or die(mysqli_error($connect));
if(mysqli_num_rows($query)==0){
?>
<tr>
<td colspan="4"><?php echo "No record found";?></td>
</tr>
<?php } 
while($row = mysqli_fetch_array($query)){
$id = $row['student_id'];
$fname = $row['fname'];
$lname = $row['lname'];
$age = $row['age'];
?>
<tr>
<td><?php echo $fname;?></td>
<td><?php echo $lname;?></td>
<td><?php echo $age;?></td>
<form action="" method="GET">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<td><button type="submit" name="up" style="border: none; color:blue; font-size:16px;">Update</button></td>
</form>
<form action="" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<td><button type="submit" name="del" style="border:none; color:red; font-size:16px;">Delete</button></td>
</form>
</tr>
<?php } ?>
</table>
</div>
<?php if(isset($_GET['add_data'])){
?>
<div style="margin-top:10%;">
<b style="color: green; font-size: 25px;">Add Data</b><br><br>
<form action="" method="POST">
<input type="text" name="fname" placeholder="First Name"><br><br>
<input type="text" name="lname" placeholder="Last Name"><br><br>
<input type="number" name="age" placeholder="Age"><br><br>
<button type="submit" name="ad">Submit</button>
</form>
<?php if(isset($_POST['ad'])){
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$age = $_POST['age'];
mysqli_query($connect,"INSERT INTO student (fname,lname,age) VALUES ('$fname','$lname','$age')");
?>
<script>
alert('Success');
window.location = "index.php";
</script>
<?php } ?>
</div>
<?php } ?>
<?php if(isset($_GET['up'])){
$id = $_GET['id'];
$query = mysqli_query($connect,"select * from student where student_id='$id'") or die(mysqli_error($connect));
while($row = mysqli_fetch_array($query)){
$student_id = $row['student_id'];
$fname = $row['fname'];
$lname = $row['lname'];
$age = $row['age'];
}
?>
<div style="margin-top:10%;">
<b style="color: blue; font-size: 25px;">Update</b><br><br>
<form action="" method="POST">
<input type="hidden" name="id" value="<?php echo $student_id; ?>">
<input type="text" name="fname" value="<?php echo $fname; ?>" placeholder="First Name"><br><br>
<input type="text" name="lname" value="<?php echo $lname; ?>" placeholder="Last Name"><br><br>
<input type="number" name="age" value="<?php echo $age; ?>" placeholder="Age"><br><br>
<button type="submit" name="up2">Submit</button>
</form>
<?php if(isset($_POST['up2'])){
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$age = $_POST['age'];
mysqli_query($connect,"UPDATE student SET fname='$fname', lname='$lname', age='$age' WHERE student_id='$id' ");
?>
<script>
alert('Success');
window.location = "index.php";
</script>
<?php } ?>
</div>
<?php } ?>
</center>
</body>
</html>
<?php if(isset($_POST['del'])){
$id = $_POST['id'];
mysqli_query($connect,"DELETE FROM student WHERE student_id = '$id'");
?>
<script>
alert('Success');
window.location = "index.php";
</script>
<?php } if(isset($_POST['DA'])){
mysqli_query($connect,"TRUNCATE TABLE student");
?>
<script>
alert('Success');
window.location = "index.php";
</script>
<?php } ?>
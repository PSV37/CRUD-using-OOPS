<?php 


 class oops
 { 
 //CREATE CONNECTION	
   public function connection()
   {
     return mysqli_connect('localhost','root','','db_oop'); 
   }

 //FIRE SELECT QUERY
   public function select($sql)
   {
   	 $db = $this->connection();
   	 return mysqli_query($db,$sql);
   }
 
 //FIRE INSERT QUERY
   public function insert($sql)
   {
	 $db = $this->connection();
	 return mysqli_query($db,$sql);
   }
 
 //FIRE DELETE QUERY
   public function del($sql)
   {
   	 $db = $this->connection();
   	 return mysqli_query($db,$sql);
   }

 //FIRE UPDATE QUERY
   public function update($sql)
   {
   	 $db = $this->connection();
   	 return mysqli_query($db,$sql);
   }

 }
 ?>


<!DOCTYPE html>
<?php 
 $obj = new oops();
?>

<?php 
//GET USER DATA FROM DABABASE ACCORDING ID
	 if(isset($_GET['edit_id']))
	 {
		$edit_id = $_GET['edit_id'];
		$update = $obj->select("SELECT * FROM tbl_user WHERE id ='$edit_id' ") ;
		$updata = mysqli_fetch_array($update);
	 }	
 ?>
<html>
<head>
	<title>CRUD Using OOPS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="row">
   <h2 class="text-center">Basic CRUD Using OOPS</h2>
	 <div class="col-md-6">
          <table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Name</th>
		        <th>Email</th>
		        <th>Edit</th>
		        <th>Delete</th>
		      </tr>
		    </thead>
		    <tbody>
	    	<?php
                 $sel = $obj->select("SELECT * FROM tbl_user");
                 while($data = mysqli_fetch_array($sel))
                 {
	    	 ?>
		      <tr>
		        <td><?php echo $data['id']; ?></td>
		        <td><?php echo $data['name']; ?></td>
		        <td><?php echo $data['email']; ?></td>
		        <td><a href="index.php?edit_id=<?php echo $data['id']; ?>" class="btn btn-info">Edit</td>
		        <td><a href="index.php?del_id=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are You Sure....')">Delete</td>
		      </tr>
		    <?php } ?>
		    </tbody>
          </table>
	 </div>


	 <div class="col-md-6">
		<form class="form-horizontal" action="" method="post" style="margin-left: 8%">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" value="<?php echo isset($updata) && $updata['name']!="" ? $updata['name']:'';?>" class="form-control" placeholder="Name">
				<input type="hidden" name="id" value="<?php echo isset($updata) && $updata['id']!="" ? $updata['id']:'';?>">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email"  value="<?php echo isset($updata) && $updata['email']!="" ? $updata['email']:'';?>" class="form-control" placeholder="Email">
			</div>
			<div class="form-group">
				<?php if(isset($updata)){ ?>
				 <input type="submit"  name="update" class="btn btn-primary" value="update"></a>
				<?php } else { ?>
				   <input type="submit"  name="submit" class="btn btn-primary" value="Create"></a>
				 <?php } ?>  
			</div>
		</form>
	 </div>
</div>

<?php

//INSERT INTO DATABASE 
 if(isset($_POST['submit']))
 {
 	$name = $_POST['name'];
 	$email = $_POST['email'];
    $obj->insert("INSERT INTO tbl_user (name , email) VALUES ('$name' , '$email')");
    header('location:index.php');
 }

//DELETE FROM DATABASE
 if(isset($_GET['del_id']))
 {
 	$delete_id = $_GET['del_id'];
 	$obj->del("DELETE FROM tbl_user WHERE id ='$delete_id' ");
 	header('location:index.php');
 }

//UPDATA EXISTING DATA
 if(isset($_POST['update']))
 {
 	$id = $_POST['id'];
 	$name = $_POST['name'];
 	$email = $_POST['email'];
 	$obj->del("UPDATE  tbl_user SET  name ='$name' , email ='$email' WHERE id ='$id' ");
 	header('location:index.php');
 }
?>

</body>
</html>
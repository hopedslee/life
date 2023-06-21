<?php
require('db.php');
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<title>Records List</title>
<!-- <link rel="stylesheet" href="css/style.css" /> -->
</head>
<body>
<div class="form">
<p><a href="index.php">Home</a> 
| <a href="logout.php">Logout</a></p>
<h2>Records List</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>s.no</strong></th>
<th><strong>id</strong></th>
<th><strong>kname</strong></th>
<th><strong>email</strong></th>
<th><strong>password</strong></th>
<th><strong>emailpassword</strong></th>
<th><strong>fxpassword</strong></th>
<th><strong>name</strong></th>
<th><strong>fxserver</strong></th>
<th><strong>acno</strong></th>
<th><strong>vps</strong></th>
<!-- <th><strong>updated</strong></th> -->
</tr>
</thead>
<tbody>
<?php
mysqli_set_charset($con,'utf8');
$count=1;
$sel_query="Select * from users ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["id"]; ?></td>
<td align="center"><?php echo $row["kname"]; ?></td>
<td align="center"><?php echo $row["email"]; ?></td>
<td align="center"><?php echo $row["password"]; ?></td>
<td align="center"><?php echo $row["emailpassword"]; ?></td>
<td align="center"><?php echo $row["fxpassword"]; ?></td>
<td align="center"><?php echo $row["printname"]; ?></td>
<td align="center"><?php echo $row["fxserver"]; ?></td>
<td align="center"><?php echo $row["acno"]; ?></td>
<!-- <td align="center"><?php echo $row["vps"]; ?></td> -->
<!-- <td align="center"><?php echo $row["trn_date"]; ?></td> -->
<td align="center">
<a href="modify.php?id=<?php echo $row["id"]; ?>">Modify</a>
</td>
<td align="center">
<a href="delete.php?id=<?php echo $row["id"]; ?>" onclick="return  confirm('do you want to delete Y/N')">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
</div>
</body>
</html>
<?php
include 'connection.php';
$id=$_POST['id'];

$sql = "DELETE FROM project_owner_pivot WHERE project_id='$id'"; //poject_owner_pivot törlés

$mysqli->query($sql) or die($mysqli->error()); 

$sql = "DELETE FROM project_status_pivot WHERE project_id='$id'"; //poject_status_pivot törlés
$mysqli->query($sql) or die($mysqli->error()); 


$sql = "DELETE FROM projects WHERE id='$id'"; //project törlés
$mysqli->query($sql) or die($mysqli->error());  


?>
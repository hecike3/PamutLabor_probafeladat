<?php
include "connection.php";
$id=$_GET["id"];

$sql = "SELECT projects.id,projects.title,projects.description, owners.name, owners.email,project_status_pivot.status_id
                FROM projects 
                INNER JOIN project_owner_pivot ON projects.id = project_owner_pivot.project_id
                INNER JOIN owners ON project_owner_pivot.owner_id = owners.id 
                INNER JOIN project_status_pivot ON projects.id = project_status_pivot.project_id
                WHERE projects.id=$id";

$res=$mysqli->query($sql)->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szerkesztés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">WeLove Test</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Projektlista</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="add.php">Szerkesztés/Létrehozás</a>
                    </li>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post">

                    <input type="hidden" value="<?= $id?>" name="id">

                    <label class="form-label">Cím</label>
                    <input type="text" name="title" class="form-control" required value="<?=$res['title']?>">

                    <div class="spacer"></div>

                    <label class="form-label">Leírás</label>
                    <textarea class="form-control" name="description" rows="3"
                        required><?=$res['description']?></textarea>

                    <div class="spacer"></div>




                    <label class="form-label">Státusz</label>
                    <select class="form-select" name="status">
                        <option <?=$res['status_id']==1?"selected":"" ?> value="1">Fejlesztésre vár</option>
                        <option <?=$res['status_id']==2?"selected":"" ?> value="2">Folyamatban</option>
                        <option <?=$res['status_id']==3?"selected":"" ?> value="3">Kész</option>
                    </select>

                    <div class="spacer"></div>

                    <label class="form-label">Kapcsolattartó neve</label>
                    <input type="text" class="form-control" name="name" value="<?=$res['name']?>" required>

                    <div class="spacer"></div>

                    <label class="form-label">Kapcsolattartó e-mail címe</label>
                    <input type="email" class="form-control" name="email" value=<?=$res['email']?> required >

                    <div class="spacer"></div>

                    <button type="submit" class="btn btn-primary mb-3"  name="submit1">Mentés</button>

                    <?php
                        if(isset($_POST["submit1"])){
                            //project update
                            $sql = "UPDATE projects SET title='$_POST[title]',description='$_POST[description]' WHERE id='$_POST[id]'";
                            $mysqli->query($sql) or die($mysqli->error); 

                            //update statusz
                            $sql="UPDATE project_status_pivot SET status_id='$_POST[status]' WHERE project_id ='$_POST[id]' ";
                            $mysqli->query($sql);
                                                         

                            //owner update
                            $res=$mysqli->query("SELECT id from owners where name='$_POST[name]' AND email='$_POST[email]'");
                            print_r($res);
                            if(mysqli_num_rows($res)>0){
                                $row=mysqli_fetch_assoc($res);
                                $owner_id=$row["id"];
                                
                            }else{
                                $sql= "INSERT INTO owners (name,email) VALUES('$_POST[name]','$_POST[email]')";
                                $mysqli->query($sql); //owner adatok
                                $owner_id=$mysqli->insert_id;
                                
                            }

                            $sql="UPDATE project_owner_pivot SET project_id = '$_POST[id]',owner_id='$owner_id' where project_id='$_POST[id]'";
                            $mysqli->query($sql);
                            
                                

                            
                            
                        ?>
                         <script type="text/javascript">
                                window.location.href = window.location.href;
                        </script> 
                    
                        <?php
                    }

                    ?>
        
                </form>
            </div>
        </div>
    </div>






</body>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
    crossorigin="anonymous"></script>

</html>
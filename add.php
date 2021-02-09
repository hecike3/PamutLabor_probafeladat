<?php
include "connection.php";
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

                    <label class="form-label">Cím</label>
                    <input type="text" name="title" class="form-control" required ">

                    <div class="spacer"></div>

                    <label class="form-label">Leírás</label>
                    <textarea class="form-control" name="description" rows="3"
                        required"></textarea>

                    <div class="spacer"></div>




                    <label class="form-label">Státusz</label>
                    <select class="form-select" name="status">
                        <option selected value="1">Fejlesztésre vár</option>
                        <option value="2">Folyamatban</option>
                        <option value="3">Kész</option>
                    </select>

                    <div class="spacer"></div>

                    <label class="form-label">Kapcsolattartó neve</label>
                    <input type="text" class="form-control" name="name" required>

                    <div class="spacer"></div>

                    <label class="form-label">Kapcsolattartó e-mail címe</label>
                    <input type="email" class="form-control" name="email" required >

                    <div class="spacer"></div>

                    <button type="submit" class="btn btn-primary mb-3" name="submit1">Mentés</button>

                    <?php
                        if(isset($_POST["submit1"])){
                            $sql = "INSERT INTO projects(title,description) VALUES ('$_POST[title]','$_POST[description]') ";

                            $mysqli->query($sql) or die($mysqli->error);
                            $project_id = $mysqli->insert_id; // legutóbbi beillesztett record id-t itt szerzem meg 


                            
                            //owner beillessztése
                            $sql = "INSERT IGNORE INTO owners (name,email) VALUES ('$_POST[name]','$_POST[email]')";
                            $mysqli-> query($sql);
                            //print_r($sql);
                            $owner_id = $mysqli->insert_id ; // legutóbb beilesztett owner 
                          
                            if($owner_id){
                              $sql ="INSERT INTO project_owner_pivot (project_id,owner_id) VALUES ('$project_id','$owner_id')";
                              $mysqli->query($sql);
                            }
                            else{
                              $sql = "SELECT id FROM owners WHERE name='$_POST[name]' ";
                              $result = $mysqli->query($sql) or die($mysqli->error);
                              $row = $result->fetch_assoc();
                              $owner_id=$row ['id'];

                              $sql ="INSERT INTO project_owner_pivot (project_id,owner_id) VALUES ('$project_id','$owner_id')";
                              $mysqli->query($sql);
                            }

                            //státusz beilesztése 
                            
                            $sql ="INSERT INTO project_status_pivot (project_id,status_id) VALUES ('$project_id','$_POST[status]')";

                            $mysqli->query($sql);
                            

                          ?>
                          <div class="alert alert-success col-lg-12 col-lg-push-0">
                            Sikeresen hozzáadtál egy projektet! 
                          </div>
                        <?php
                        }
                    ?>
                     
                    

                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
    crossorigin="anonymous"></script>



</body>

</html>
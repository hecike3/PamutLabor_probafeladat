<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">WeLove Test</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Projektlista</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add.php">Szerkesztés/Létrehozás</a>
        </li>
    </div>
  </div>
</nav>




<div class="container">
  <div class="row">
    <div class="col-lg">
        <div class="spacer"></div>


        <?php
        

        $result = $mysqli->query("SELECT projects.id,projects.title, owners.name, owners.email,statuses.name
              FROM projects 
              INNER JOIN project_owner_pivot ON projects.id = project_owner_pivot.project_id
              INNER JOIN owners ON project_owner_pivot.owner_id = owners.id 
              INNER JOIN project_status_pivot ON projects.id = project_status_pivot.project_id
              INNER JOIN statuses ON project_status_pivot.status_id = statuses.id  ");

        while($projects = $result->fetch_array()): ?>

        
          <div class="card">
          <div class="card-header ">
          <?= $projects[4]?>

          </div>
          <div class="card-body">
            <h5 class="card-title"> <?= $projects[1]?></h5>
            <p class="card-text">


            <?="$projects[2]($projects[3])"?>


            </p>
            <a href="edit.php?id=<?= $projects[0]?>" class="btn btn-primary">Szerkesztés</a>
            <button id="<?=$projects[0]?>" class="btn btn-danger">Törlés</button>
          </div>
        </div>
  
        <div class="spacer"></div>
        <?php
        
            endwhile;

        ?>

        


    </div>
  </div>
</div>

</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" >
        $(function() {

            $(".btn-danger").click(function() {
                var del_id = $(this).attr("id");
                var info = 'id=' + del_id;
                if (confirm("Biztos szeretnéd törölni?")) {
                    $.ajax({
                        type : "POST",
                        url : "delete.php",
                        data : info,
                        success : function() {

                          console.log("yo");
                        }
                    });
                    $(this).parents(".card").animate("fast").animate({
                        opacity : "hide"
                    }, "slow");
                }
                return false;
            });
        });
 </script>




</html>









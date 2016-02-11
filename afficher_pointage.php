<?php 
include('header.php') ;
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Liste personnel (Pointage)</li>
        </ol>
    </div><!--/.row-->




    <?php
    $id = $_GET['id'];
    $liste = $per->select_personnel($id);
    foreach ($liste as $row) {
        ?>

        <br>
        <table class="table table-responsive table-bordered">
            <tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>NCIN</th><th>Poste</th></tr>
            <tr>

                <td>
                    <?php echo $row['id_personnel']; ?>
                </td>


                <td>
                    <?php echo $row['nom']; ?>	
                </td>

                <td>
                    <?php echo $row['prenom']; ?>
                </td>

                <td>
                    <?php echo $row['ncin']; ?>
                </td>

                <td>
                    <?php echo $row['poste']; ?>
                </td>
            </tr>

        </table>

    <?php } ?>	


 
    <br>
    <form class="form-horizontal"  name="entre" role="form" method="post" >


        <div class="form-group">
            <label for="firstname" class="col-sm-3 control-label">Heur d'entrée</label>
            <div class="col-sm-6">
               
                <select class="form-control" name="entre" id="entre">
                    <option selected  value="08:00">08</option>
                    <option value="09:00">09</option>
                    <option value="10:00">10</option>
                    <option value="11:00">11 </option>
                    <option value="12:00">12 </option>
                    <option value="13:00">13 </option>
                    <option value="14:00">14 </option>
                    <option value="15:00">15 </option>
                    <option value="16:00">16 </option>
                    <option value="17:00">17 </option>
                    <option value="18:00">18 </option>
                    <option value="19:00">19 </option>
                    <option value="20:00">20 </option>
                </select>
            </div>

            <div class="col-sm-3">
                <input type="button" class="btn btn-primary" name="submit_entre" id="entrer" value="Pointage">
            </div>
        </div>
    </form>
    <br>

    <form class="form-horizontal"  role="form" method="post">
      
        <div class="form-group">
            <label for="firstname" class="col-sm-3 control-label">Heur de sortie</label>
            <div class="col-sm-6">
 <input type="hidden" name="id" value="<?php echo $id; ?>">
                <select class="form-control" name="sortie" id="sortie">
                    <option value="08:00">08</option>
                    <option value="09:00">09</option>
                    <option value="10:00">10</option>
                    <option value="11:00">11 </option>
                    <option value="12:00">12 </option>
                    <option value="13:00">13 </option>
                    <option value="14:00">14 </option>
                    <option value="15:00">15 </option>
                    <option value="16:00">16 </option>
                    <option value="17:00">17 </option>
                    <option selected value="18:00">18 </option>
                    <option value="19:00">19 </option>
                    <option value="20:00">20 </option>
                </select>
            </div>

            <div class="col-sm-3">
                <input type="button" class="btn btn-primary" name="submit_sortie" id="sort" value="Pointage">
            </div>
        </div>


    </form>
    <br> 

 <?php 

 
 $per->affichage();
 

 ?>

    <br>
    <div id="liste">
    
    </div>

</div>	<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script>
/* Selection de la liste  */
    var ide = <?php echo $id ?> ; 
     $.ajax({
                type: "POST",
                url: "liste_pointage.php",
                cache: false,
                data: {id : ide },
                success: onSucces,
                error: onErro

            });
            
    function onSucces(data, status) {
                $("#liste").html(data) ; 
            }
            function onErro(data, status) {
                alert('erreur');
            }
/* ---------------------------------------------------------------------------- */ 

/* Exécution de formulaire de pointage en entrée */
    
        $("#entrer").click(function () {
            var formData = $("#entre").serialize();
             var id = <?php echo $id ?> ;
             var entre = $("#entre").val();
            $.ajax({
                type: "POST",
                url: "pointage_entre.php",
                cache: false,
                data: {id:id,entre:entre},
                success: onSucces,
                error: onErro

            });
            function onSucces(data, status) {
                 var id = <?php echo $id ?> ; 
     $.ajax({
                type: "POST",
                url: "liste_pointage.php",
                cache: false,
                data: {id : id },
                success: onSucces,
                error: onErro

            });
            
    function onSucces(data, status) {
                $("#liste").html(data) ; 
            }
            function onErro(data, status) {
                alert('erreur');
            }
            }
            function onErro(data, status) {
                alert('erreur');
            }

        });
/* ------------------------------------------------------------------------------ */

/* Exécution de formulaire de pointage en sortie */ 

      $("#sort").click(function () {
           
            var id = <?php echo $id ?> ;  
            var sortie = $("#sortie").val() ; 
            $.ajax({
                type: "POST",
                url: "pointage_sortie.php",
                cache: false,
                data: {id:id,sortie:sortie},
                success: onSucces,
                error: onErro

            });
            function onSucces(data, status) {
                
                 var id = <?php echo $id ?> ; 
     $.ajax({
                type: "POST",
                url: "liste_pointage.php",
                cache: false,
                data: {id : id },
                success: onSucces,
                error: onErro

            });
            
    function onSucces(data, status) {
                $("#liste").html(data) ; 
            }
            function onErro(data, status) {
                alert('erreur');
            }
            }
            function onErro(data, status) {
                alert('erreur');
            }

        });
/* ------------------------------------------------------------------------------ */

/* Exécution de suppression de pointage  */
  $("#supprimer").click(function () {
            alert("data");
           
        });

</script>
<script src="js/bootstrap.min.js"></script>





</body>

</html>

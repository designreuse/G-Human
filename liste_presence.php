<?php 
include('header.php') ;
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Liste présence </li>
        </ol>
    </div><!--/.row-->



    <br><br>

    <?php
    $per->affichage();
    ?>

    <br>
    <form class="form-horizontal" id="recherche" role="form" method="post">
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">Chercher personnel</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="personnel" name="personnel" placeholder="">
                <span class="error"></span>
            </div>
            <div class="col-sm-2">


            </div>
        </div>
    </form>
    <br>
    <div id="affichage">
        <table class="table table-responsive table-bordered table-hover" id="tab_s">
            <thead>
                <tr>
                    <th>Matricule</th><th>Nom & Prenom</th><th>Poste</th><th></th> 
                </tr>
            </thead>
            <tbody>
<?php
$per->liste_personnel_presence();
?>
            </tbody>
        </table>
    </div>


</div>	<!--/.mainaffichage-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $("#document").ready(function(){
        $("#tab_s").show();
    $("#personnel").keyup(function () {
        load = "<div class='loading' id='load'> <img src='img/load.GIF' class='load-img'></div>"; 
        $("#affichage").html(load);
        var formData = $("#recherche").serialize();
        var personnel = $("#personnel").val();
        $.ajax({
            type: "POST",
            url: "chercher_presence.php",
            cache: false,
            data: formData,
            success: onSucces,
            error: onErro

        });
        function onSucces(data, status) {
            $("#tab_s").hide();
            $("#affichage").html(data);
        }
        function onErro(data, status) {
            alert('erreur de connexion');
        }
    });
    });
    
</script>
</body>

</html>

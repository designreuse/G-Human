<?php 
include('header.php') ;
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Staff consulting</li>
        </ol>
    </div><!--/.row-->
    <br>
    <?php
    $per->affichage();
    ?>
    

    <?php
    $id = $_GET['id'];
    $liste = $per->select_personnel($id);
    foreach ($liste as $row) {
        ?>

        <br>
        <a href="modifier_personnel.php?id=<?php echo $id ?>"><img src='img/modif.png' width='35' height='30'></img> </a>
        <a href="supprimer_personnel.php?id=<?php echo $id ?>"  onclick="if (confirm( '& quot; Voulez vous vraiment supprimer le Personnel: ? ; ')) {
                        return true;
                    }
                    return false;"><img src='img/del.png' width='30' height='30'></img></a>
            <br> <br>
            <div class="row">
            
            <div class="col-md-10">
        <table class="table table-responsive table-bordered table-hover">
            <tr>
                <td>
                    Registration number :  
                </td>
                <td>
    <?php echo $row['id_personnel']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    First name : 
                </td>
                <td>
    <?php echo $row['nom']; ?>	
                </td>
            </tr>
            <tr>
                <td>	
                    Last name :
                </td>
                <td>
    <?php echo $row['prenom']; ?>
                </td>
            </tr>  
            <tr>
                <td>
                    ID Card :
                </td>
                <td>
    <?php echo $row['ncin']; ?>	
                </td>
            </tr>
            <tr>
                <td>
                    Date of birth :
                </td>
                <td>
    <?php echo $row['date_n']; ?>	
                </td>
            </tr>
            <tr>
                <td>
                    Adress :
                </td>
                <td>
    <?php echo $row['adresse']; ?>	
                </td>
            </tr>
            <tr>
                <td> 
                    E-mail : 
                </td>
                <td>
    <?php echo $row['email']; ?>
                </td> 
            </tr>
            <tr>
                <td>
                    Phone number :
                </td> 
                <td>
    <?php echo $row['tel']; ?>	
                </td>	
            </tr>
            <tr>
                <td>
                    Study level :
                </td> 
                <td>
    <?php echo $row['etude']; ?>	
                </td>	
            </tr>
            <tr>
                <td>
                    Work position : 
                </td>
                <td>
    <?php echo $row['poste']; ?>	
                </td> 
            </tr>
            <tr>
            <tr>
                <td>
                    Hiring date : 
                </td>
                <td>
    <?php echo $row['date']; ?>	
                </td> 
            </tr>
            <tr>
                <td>
                    Type of Contract : 
                </td>
                <td>
    <?php echo $row['contrat']; ?>	
                </td> 
            </tr>
            <tr>
                <td>
                    Salary (DT) : 
                </td>
                <td>
    <?php echo $row['salaire']; ?>	
                </td> 
            </tr>

        </table>
                </div>
            </div>
<?php } ?>				
</div>	<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
        $('#calendar').datepicker({
        });

        !function ($) {
            $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
                $(this).find('em:first').toggleClass("glyphicon-minus");
            });
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
            if ($(window).width() > 768)
                $('#sidebar-collapse').collapse('show')
        })
        $(window).on('resize', function () {
            if ($(window).width() <= 767)
                $('#sidebar-collapse').collapse('hide')
        })
</script>	
</body>

</html>

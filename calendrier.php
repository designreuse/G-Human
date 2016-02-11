<?php 
include('header.php') ;
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Calendrier de travail</li>
        </ol>
    </div><!--/.row-->
    
    <div class="alert">
      <h3>
        <?php 
        $point->jour();
        ?>
        
       
    </h3>
  </div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-2">
        <button class="btn btn-primary btn-block" id="jt">Enrégistre un jour de travail</button>
        </div>
    </div>
        <div class='alert alert-success' id="alerti">
  
   Jour de travail enrégistrer avec succées</div>
    <br>
    <div class="row">
        <form class="form-horizontal" id="recherche" role="form" method="post">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label"> </label>
                
                <div class="col-sm-3">
                    <select class="form-control" name="mois" id="moisid">
                        <option selected value="">Mois</option>
                        <option value="01">Janvier</option>
                        <option value="02">Février</option>
                        <option value="03">Mars</option>
                        <option value="04">Avril</option>
                        <option value="05">Mai</option>
                        <option value="06">Juin</option>
                        <option value="07">Juillet</option>
                        <option value="08">Aout</option>
                        <option value="09">Septembre</option>
                        <option value="10">Octobre</option>
                        <option value="11">Novembre</option>
                        <option value="12">Décembre</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="annes" id="annesid">
                        <option selected value="">Année</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option  value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
              
                <div class="col-sm-3">
                    <input type="button" class="btn btn-primary btn-md" value="Chercher" id="chrch">

                </div>




            </div>
        </form>
    </div>

        <br>
    <div class="row">
        <div class="col-sm-12">
            <div id="cal-lis" class="cal-lis" >
                
            </div>
  
            
       
            
        </div>
    </div>

</div>	<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $("#document").ready(function(){
        $.ajax({
		type: "POST",
		url: "liste_pointage_travail.php",
		success:onSucces,
		error:onErro 
			
  });
  function onSucces(data,status){
            
               $("#cal-lis").html(data);
                
			}
                        
	function onErro(data,status){
            
		alert('erreur de connexion');
                
			}
       
    });
    
    
    
    
     $("#alerti").hide();
    $("#jt").click(function(){
      
	$.ajax({
		type: "POST",
		url: "pointage_travail.php",
		success:onSucces,
		error:onErro 
			
  });
  function onSucces(data,status){
            
               $("#alerti").show();
               $("#jt").hide();
               
                $.ajax({
		type: "POST",
		url: "liste_pointage_travail.php",
		success:onSucces,
		error:onErro 
			
  });
  function onSucces(data,status){
            
               $("#cal-lis").html(data);
                
			}
                        
	function onErro(data,status){
            
		alert('erreur de connexion');
                
			   }
			}
                        
	function onErro(data,status){
            
		alert('erreur de connexion');
                
			}
	
    });
    
    $("#chrch").click(function(){
        var formData = $("#recherche").serialize();
         var mois = $("#moisid").val() ; 
         var annes = $("#annesid").val() ; 
         
          
         if(mois=="" || annes== ""){
             alert ("Vueillez choisire le mois et l'années ") ; 
         }else {
             load = "<div class='loading' id='load'> <img src='img/load.GIF' class='load-img'></div>"; 
    $("#cal-lis").html(load) ; 
        $.ajax({
		type: "POST",
		url: "chercher_liste_pointage_travail.php",
                data : formData,
		success:onSucces,
		error:onErro 
			
  });
  function onSucces(data,status){
               
                 $("#cal-lis").html(data) ;
			}
                        
	function onErro(data,status){
            
		alert('erreur de connexion');
                
			}
         }
    }); 
    
</script>

</body>

</html>

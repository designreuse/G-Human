<!DOCTYPE html>
<?php
require_once("class/class.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>G-Human</title>
        <link rel="icon" href="img/logo.ico">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link href="css/wstyle.css" rel="stylesheet">


    </head>

    <body>

        <div class="container">
            <div class="row">


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center>
                            <h3> G-Human (Demo)</h3>
                        </center>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="login-form">
                            <fieldset>
                                <div class="row">
                                    <div class="center-block">
                                        <center>
                                            <img class="img-thumbnail" src="img/accueil.jpg" width="360" height="200">
                                        </center>	
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                </span> 
                                                <input class="form-control" value="admin" name="login" type="text" id="email">
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span> 
                                                    <input class="form-control" value="123" name="pass" type="password" id="password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" id="login-submit"  class="btn btn-lg btn-primary btn-block" value="Log In">
                                               
                                                <div id="msgbox" class="msgbox">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </fieldset>

                        </form>
                    </div>
                    <div class="panel-footer ">
                        <center>
                            AdibDev 2016
                        </center>
                    </div>
                </div>
            </div>

        </div>
    </div>	

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $("#login-submit").click(function () {
            var formData = $("#login-form").serialize();
            var login = $('#email').val();
            var pass = $('#password').val();
             if(login != '')
    {
        $("#email").css({'border-color': '#3c8dbc'});
    }
     if(pass != '')
    {
        $("#password").css({'border-color': '#3c8dbc'});
    }
            if ((login == '') || (pass == '')) {
                $("#email").css({'border-color': 'red'});
                $("#password").css({'border-color': 'red'});
                $("#msgbox").html("<center>Vueillez remplire les champs</center>");
                $("#msgbox").css({'color': 'red'});
                $("#msgbox").css({'font-size': '12pt'});
                $('#pass').val('')
                $('#login').val('');

                return false;
            } else {


                $.post(
                        'auth.php',
                        formData,
                        function (data) {
                            if (data == 0) {



                                $("#msgbox").html("<center>Erreur d'authentification</center>");
                                $("#msgbox").css({'color': 'red'});
                                $("#msgbox").css({'font-size': '12pt'});


                            }
                            else
                            {
                                window.location.href = 'liste_personnel.php';
                            }


                        }

                );



                $("#login-form").submit(function () {

                    return false;
                });

            }

        });
    </script>

</body>

</html>

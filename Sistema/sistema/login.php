<!DOCTYPE html>

<?php

new TSession(); 

function __autoload($classe)
{
    if(file_exists("app/model/{$classe}.class.php"))
        include_once "app/model/{$classe}.class.php";
    if(file_exists("app/ado/{$classe}.class.php"))
        include_once "app/ado/{$classe}.class.php";
    if(file_exists("app/dao/{$classe}.class.php"))
        include_once "app/dao/{$classe}.class.php";
}

$error = "";

$login = "";
$senha = "";
$lembrarme = "";
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{    
        
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $lembrarme = (isset($_POST["remember"]) == 1) ? 'checked' : '';
    
    if(empty($login))
    {
        $error = "* O login deve ser informado";
    }
    else if (empty($senha))
    {
        $error = "* A senha deve ser informada";
    }
    else 
    {
        try {
            
            $criterio = new TCriteria;
            $criterio->add(new TFilter('login', '=', $login), TCriteria::AND_OPERATOR);
            $criterio->add(new TFilter('senha', '=', $senha), TCriteria::AND_OPERATOR);
            $obj = UsuarioDAO::validaLogin($criterio);
            
            if($obj)
            {
                TSession::setValue('dt_hr_logon', date('d/m/y h:i:s'));
                TSession::setValue('user', $obj);
                
                header("Location:" . TGlobal::$default_url_path . "/admin");
                
            }
            else
            {
                $error = "* Usuário ou senha inválidos";
            }
            
            $conn = null;
        }
        catch (PDOException $e)
        {
            // exibe a mensagem de erro
            print "Erro!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
        
}

?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MB | Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align: center;"><img src="<?php echo TGlobal::$default_url_path; ?>/image/logo.png" alt="AgroHost" width="150" /></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="#">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuário" value="<?php echo $login; ?>" name="login" type="text" autofocus maxlength="30" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" value="<?php echo $senha; ?>" name="senha" type="password" value="" maxlength="30" />
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="lembrarme" type="checkbox" <?php echo $lembrarme; ?> />Lembrar-me
                                    </label>
                                </div>
                                <input type="submit" value="Acessar" class="btn btn-lg btn-success btn-block" />
                                <br/>
                                <div style="color: #f00;"><?php echo $error; ?></div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
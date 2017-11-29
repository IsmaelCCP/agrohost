<?php  

/*
 * Adiciona classes dinamicamente
 */

function __autoload($classe)
{
    if(file_exists("../app/model/{$classe}.class.php"))
    {
        include_once "../app/model/{$classe}.class.php";
    }
    else if(file_exists("../app/ado/{$classe}.class.php"))
    {
        include_once "../app/ado/{$classe}.class.php";
    }
    else if(file_exists("../app/util/{$classe}.class.php"))
    {
        include_once "../app/util/{$classe}.class.php";
    }
    else if(file_exists("../app/dao/{$classe}.class.php"))
    {
        include_once "../app/dao/{$classe}.class.php";
    }
}

/*
 * Verifica se o usuário esta logado
 */

new TSession();
$user = TSession::getValue("user");
if(!$user)
    header("Location:" . TGlobal::$default_url_path . "/login");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADM</title>
    
    <link rel="icon" href="<?php echo TGlobal::$default_url_path; ?>/image/logo_ico.ico" />

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo TGlobal::$default_url_path; ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo TGlobal::$default_url_path; ?>/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo TGlobal::$default_url_path; ?>/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo TGlobal::$default_url_path; ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery -->
    <script src="<?php echo TGlobal::$default_url_path; ?>/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo TGlobal::$default_url_path; ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo TGlobal::$default_url_path; ?>/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo TGlobal::$default_url_path; ?>/dist/js/sb-admin-2.js"></script>
    
    
    
    <!-- Ismael CSS -->
    <link href="<?php echo TGlobal::$default_url_path; ?>/estilos/global.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">AgroHost | Olá <?php echo $user->getNome(); ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i style="color:#f00;">1</i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $user->getNome(); ?></a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo TGlobal::$default_url_path; ?>/admin/logout"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                        
                        <li>
                            <a href="<?php echo TGlobal::$default_url_path ?>/admin/"><i class="fa fa-desktop fa-fw"></i> Área de Trabalho</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-folder-o fa-fw"></i> Cadastro<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo TGlobal::$default_url_path ?>/admin/areas"><i class="fa fa-map-marker"></i> Áreas</a>
                                </li>
                                <li>
                                    <a href="<?php echo TGlobal::$default_url_path ?>/admin/cidades"><i class="fa fa-home"></i> Cidades</a>
                                </li>
                                <li>
                                    <a href="<?php echo TGlobal::$default_url_path ?>/admin/equipamentos"><i class="fa fa-truck"></i> Equipamentos</a>
                                </li>
                                <li>
                                    <a href="<?php echo TGlobal::$default_url_path ?>/admin/itens"><i class="fa fa-steam"></i> Itens</a>
                                </li>                                
                                <li>
                                    <a href="<?php echo TGlobal::$default_url_path ?>/admin/parceiros"><i class="fa fa-male"></i> Parceiros</a>
                                </li>
                                <li>
                                    <a href="<?php echo TGlobal::$default_url_path ?>/admin/tipos"><i class="fa fa-gears"></i> Tipos Movimentações</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>  
                        <li>
                            <a href="#"><i class="fa fa-folder-o fa-fw"></i> Entrada<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo TGlobal::$default_url_path ?>/admin/ordemcompra"><i class="fa fa-file-text-o"></i> Ordens de Compra</a>
                                </li>
                                <li>
                                    <a href="<?php echo TGlobal::$default_url_path ?>/admin/fatura"><i class="fa fa-bomb"></i> Fatura</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                      
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


        <!-- Page Content -->
        <div id="page-wrapper">

            <?php
                
            $url_0 = Url::getURL( 0 );     
            
            if( $url_0 == null )
                $url_0 = "inicio";
                
            if( file_exists( $url_0 . ".php" ) )
                require $url_0 . ".php";
            else
                require "404.php";
                
            ?>    
	
        </div>
        <!-- /#page-wrapper -->

	</div>
    <!-- /#wrapper -->
    <div style="border-top: 1px solid #c0c0c0; text-align: center; font-size: 7pt;">
    	© 2017-2017 - Agropecuária Dois Vizinhos, Todos os direitos reservados
    </div>
</body>

</html>




<?php 

$pagetitle = $controller->getpageattr('title'); 
$pagename = $controller->getpageattr('name');
$pagesubtitle = $controller->getpageattr('subtitle');
$userrank = 0;
$UserDetail = $dbconnection->ExecCommand("SELECT * FROM users WHERE id=" . $_SESSION["userid"]);
$user_name= $UserDetail['name'];//store information into variables
$user_email=$UserDetail['email'];
$user_uname=$UserDetail['username'];
$userrank = $UserDetail['permission'];
unset($UserDetail);//delete variable;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <?php if(isset($pagetitle)){
                echo "<title>$pagetitle | Whitehall Properties</title>";
            } else{
                echo "<title>Whitehall Properties</title>";
            }
            ?>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
         <!-- bootstrap 3.0.2 -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Font Awsome -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- include the core styles -->
        <link rel="stylesheet" href="css/alertify.core.css" />
        <!-- include a theme, can be included into the core instead of 2 separate files -->
        <link rel="stylesheet" href="css/alertify.default.css" />

        <link href="js/skins/flat/blue.css" rel="stylesheet">
        <script src="js/icheck.js"></script>
        <!-- Alertify.js -->
        <script src="js/alertify.min.js"></script>
        <!-- Main style -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Whitehall Properties
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a href="../" class="site-visit">View Site</a>

                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="$('.dropdown-toggle').dropdown()">
                                <i class="fa fa-user"></i>
                                <span>
                                <?php echo $user_name?$user_name:$user_uname;?>
                                <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar5.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <center><?php echo $user_name?$user_name:$user_uname;?> - Level <?php echo $userrank?> access</center>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="usersettings.php" class="btn btn-warning btn-flat">Settings</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-danger btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $user_name?$user_name:$user_uname;?></p>

                            <a href="usersettings.php"><i class="fa fa-gear text-success"></i> Settings</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                    <?php 
                    foreach ($adminpages as $key => $value) {
                        $class="";
                        if($key == $pagetitle){
                            $class="active";
                        }
                        if($value['Permission']<=$userrank && $value['hidden']==false){
                            ?>
                            <li class="<?php echo $class;?>"><a href="<?php echo $value['location'];?>"><i class="fa fa-<?php echo $value['fa icon'];?>"></i> <span><?php echo $key;?></span></a></li>
                    <?php } } ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $pagename?>
                        <small><?php echo $pagesubtitle?$pagesubtitle:'Control Panel'?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $pagename?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                
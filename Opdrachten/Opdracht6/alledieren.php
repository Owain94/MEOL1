<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 10/11/14
 * Time: 14:11
 */

require_once('../../Keys.php');
require_once('apicalls/api.php');
$response = api('dieren');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alle dieren</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/clean-blog.css" rel="stylesheet">

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php">
                    <span class="navbar-brand">Dierenarts API</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="alledieren.php">Dieren</a>
                    </li>
                    <li>
                        <a href="alleeigenaren.php">Eigenaren</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="intro-header" style="background-image: url('img/bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Dierenarts API</h1>
                        <hr class="small">
                        <span class="subheading">Alle dieren.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <a href="diertoevoegen.php">Dier toevoegen</a>

                <h2 style="text-align: center">Alle dieren</h2>

                <table class="table sortable">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Naam
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?
                    foreach ($response as $info):
                    ?>
                        <tr>
                            <td>
                                <? echo '<a href="dier.php?id=' . $info->{'id'} . '">' . $info->{'id'} . '</a>' ?>
                            </td>
                            <td>
                                <? echo '<a href="dier.php?id=' . $info->{'id'} . '">' . $info->{'naam'} . '</a>' ?>
                            </td>
                        </tr>
                    <?
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <p class="copyright text-muted">Copyright &copy; Dierenarts API</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/clean-blog.js"></script>
    <script src="js/sorttable.js"></script>

</body>

</html>



<?php
include $_SERVER['DOCUMENT_ROOT'] . '/data/evote.php';
require 'index/classes/TableGenerator.php';
require 'index/classes/MenuGenerator.php';
require 'data/RandomInfo.php';
require 'data/Dialogue.php';
?>

<!DOCTYPE HTML>

<html>

    <head>
        <title>AIR EUROPA TANGO CHAMPIONS 2017</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.css" rel="stylesheet">
        <link href="/css/evote.css" rel="stylesheet">
    </head>

    <body>
        <!-- Main content -->
        <div class="col-sm-12 main-results">

            <div class="well small-centered"">

                <div class="logo">
                    <img id="logo-header" src="/tango-vote-logo.png" />
                </div>

                <div name="maxalt_header" ><div id="vote-info"><img src="images/cup-winner.png" alt="winner" style="height:150px;"></div></div>                <form action="actions/votingpagehandler.php" method="POST" autocomplete="off">
                    <div class="panel panel-default">
                        <table class="table table" id="contentTable">
                            <tr class="rowheader";>
                                <th colspan="2">Best Dancers voted by the public</th>
                            </tr>
<?php
$evote = new Evote();
$tg = new TableGenerator();
$tg->generateMyResultTable();
?>

                        </table>
                    </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/js/bootstrap.min.js"></script>
    </body>

</html>

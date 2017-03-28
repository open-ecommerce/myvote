<?php
require $_SERVER['DOCUMENT_ROOT'].'/data/RandomInfo.php';
require $_SERVER['DOCUMENT_ROOT'].'/data/Dialogue.php';
$dialogue = new dialogue();

$startup = true;
$filename = $_SERVER['DOCUMENT_ROOT'].'/data/config.php';
if (file_exists($filename)) {
    $startup = false;
}

if (isset($_POST['db_host']) &&
    isset($_POST['db_name']) &&
    isset($_POST['db_user']) &&
    isset($_POST['db_pass']) &&
    isset($_POST['su_name']) &&
    isset($_POST['su_pass1']) &&
    isset($_POST['su_pass2']) &&
    $startup) {
    $db_host = $_POST['db_host'];
    $db_name = $_POST['db_name'];
    $db_user = $_POST['db_user'];
    $db_pass = $_POST['db_pass'];
    $su_name = $_POST['su_name'];
    $su_pass1 = $_POST['su_pass1'];
    $su_pass2 = $_POST['su_pass2'];

    if ($db_host != '' && $db_name != '' && $db_user != '' && $db_pass != '' && $su_name != '' && $su_pass1 != '' && $su_pass2 != '') {
        if ($su_pass1 == $su_pass2) {


            $content = "<?php\n";
            $content .= "define(\"MYSQL_PASS\", \"$db_pass\");\n";
            $content .= "define(\"MYSQL_USER\", \"$db_user\");\n";
            $content .= "define(\"MYSQL_DB\", \"$db_name\");\n";
            $content .= "define(\"MYSQL_HOST\", \"$db_host\");\n";
            $content .= "define(\"SUPERUSER\", \"$su_name\");\n";
            $content .= '?>';

            $file = fopen($filename, 'w') or die('Unable to open file!');
            fwrite($file, $content);
            fclose($file);
            $dialogue->appendMessage('Konfigurationen lyckades!', 'success');

            include $_SERVER['DOCUMENT_ROOT'].'/data/evote.php';
            $evote = new Evote();
            if(!$evote->usernameExists($su_name)){
                $evote->createNewUser($su_name, $su_pass1, 0);
            }else{
                $dialogue->appendMessage('En avändare med det namnet fanns redan i databasen.', 'info');
            }
            $startup = false;


        }else{
            $dialogue->appendMessage('Lösenorden för superuser stämmer inte överens. Försök igen.', 'error');
        }
    }else{
        $dialogue->appendMessage('Alla fällt är inte ifyllda.', 'error');
    }
}

$_SESSION['message'] = serialize($dialogue);

?>

<html>
<head>
    <title>E-vote Setup</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/evote.css?version=3" rel="stylesheet">
</head>
<body>
    <?php
    if(isset($_SESSION['message']) && is_string($_SESSION['message']) && $_SESSION['message'] != ''){
        $d = unserialize($_SESSION['message']);
        $d->printAlerts();
        unset($_SESSION['message']);
    }
    ?>
    <div class="center">
        <h3>E-vote setup</h3>
        <?php
        if ($startup) {
        ?>
        <div class="well">
            Hej! Vad kul att just ni vill börja använda E-vote.
            <br>
            <br> Fyll i datan som gäller för ditt system nedan för att konfigurera.
            <br> Se till att skriva in rätt värden för att inte behöva ändra dessa manuelt efteråt.
        </div>

        <form action="" method="POST">
            <div class="well">
                <h4><strong>Databaskonfiguration</strong></h4>
                <hr>
                <div class="form-group">
                    <label for="usr">Host:</label>
                    <input type="text" class="form-control" name="db_host" <?php echo isset($db_host) ? 'value="'.$db_host.'"' : '';
            ?>autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="pwd">DatabasName:</label>
                    <input type="text" class="form-control" name="db_name" <?php echo isset($db_host) ? 'value="'.$db_name.'"' : '';
            ?>autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="pwd">Användare:</label>
                    <input type="text" class="form-control" name="db_user" <?php echo isset($db_host) ? 'value="'.$db_user.'"' : '';
            ?>autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="db_pass" <?php echo isset($db_host) ? 'value="'.$db_pass.'"' : '';
            ?>autocomplete="off">
                </div>
            </div>
            <div class="well">
                <h4><strong>Superuser</strong></h4>
                Detta är användaren som har full kontrol på systemet. Denna användare kan inte raderas från databasen.
                <hr>
                <div class="form-group">
                    <label for="usr">Name:</label>
                    <input type="text" class="form-control" name="su_name" <?php echo isset($db_host) ? 'value="'.$su_name.'"' : '';
            ?>autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="su_pass1">
                </div>
                <div class="form-group">
                    <label for="pwd">Upprepa Password:</label>
                    <input type="password" class="form-control" name="su_pass2">
                </div>
            </div>
            <div class="span7 text-center" style="margin-bottom:50px;">
            <button type="submit" class="btn btn-primary" name="button" value="login" name="login">Spara</button>
            </div>

        </form>

        <?php

        } else {
            ?>

        <div class="well">
            E-vote är konfigurerat!
        </div>

        <?php

        }
        ?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>

</body>
</html>

<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){

    echo "<h3>Usage History</h3>";
    echo "<hr>";
    $tg->generateOverview();

} else {
    echo "You are not authorized to view this page";
}

 ?>

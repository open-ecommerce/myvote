<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    //$mg->printAdminMenu(0);
    echo "<h3>Kontoinformation<h3>";
    echo "<hr>";
    echo "";


} else {
    echo "Du har inte behörighet att visa denna sida";
}

 ?>

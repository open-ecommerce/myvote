<?php
$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
//$mg->printUserhandlerPanelMenu($page);
?>
<h3>Change Password</h3>
<hr>
<div class="well" style="max-width: 400px">
    <form action="/actions/useradminpagehandler.php" method="POST">
    <div class="form-group">
            <label>AnvändarName:</label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label>Nytt Password:</label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px" autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary" value="change" name="button">Byt Lösenord</button>
    </form>
</div>
<?php
} else {
    echo "Du har inte behörighet att visa denna sida.";
}
?>

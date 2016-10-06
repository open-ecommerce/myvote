<?php
$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
//$mg->printUserhandlerPanelMenu($page);
?>

<h3>Skapa ny användare</h3>
<hr>
<div class="well" style="max-width: 400px">
    <form action="/actions/useradminpagehandler.php" method="POST">
    <div>
            <label>AnvändarName:</label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label>Password:</label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <!--
            <label>Privilegier: (0 - 2)</label>
            <input type="number" name="priv" class="form-control" min="0" max="2" style="margin-bottom: 3px; max-width: 200px" autocomplete="off">
        -->
    </div>
    <div class="form-group row">
    <label class="col-sm-3 radio">Privilegier:</label>
    <div class="col-sm-9">
      <div class="radio">
        <label>
          <input type="radio" name="priv" value="1" checked>
          Election Admin
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="priv" value="2">
          Adjuster
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="priv" value="0">
          administrator
        </label>
      </div>
    </div>
    </div>

    <button type="submit" class="btn btn-primary" value="new" name="button">Skapa ny användare</button>
    </form>
</div>
<?php
} else {
    echo "Du har inte behörighet att visa denna sida.";
}
?>

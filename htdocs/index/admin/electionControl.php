<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    //$mg->printAdminMenu(2);

    $ongoingSession = $evote->ongoingSession();

    $buttonstate = "disabled";
    if($ongoingSession){
	   $buttonstate = "active";
    }

    if(!$ongoingSession){ ?>


    	<h3>Create new election</h3>
        <p>This will create the election and the pdf file with all the codes.</p>
        <p>Thats your only chance to print the codes.  Otherwise you will need to delete the election and create a new one</p>
        <p>After it is created you need to logout and login as an adjuster to put the participants.</p>
        <hr>

    	<div class="well" style="max-width: 400px">
    	<form action="/actions/electionadminpagehandler.php" method="POST">
    	<div class="form-group">
    	        <label for="vn">Create new election:</label>
    	        <input type="text" name="valnamn" class="form-control" id="vn" autocomplete="off">
    	</div>
    	<div class="form-group" style="max-width: 150px">
    	        <label for="ap">Max people who vote:</label>
    	        <input type="number" name="antal_personer" class="form-control" id="ap" min="1" autocomplete="off">
    	</div>
    	<button type="submit" class="btn btn-primary" value="create" name="button">Create Election</button>
    	</form>
    	</div>

    <?php }else{
        ?>
        <h3>Close current election</h3>
    	<hr>
    	<div class="well" style="max-width: 400px">
    		<form action="/actions/electionadminpagehandler.php" method="POST">
    			<div class="form-group">
            <label for="psw1">Ditt Password:</label>
            <input type="password" name="pswuser" class="form-control" id="psw1">
    	</div>
    	<button type="submit" class="btn btn-primary" value="delete_election" name="button">Delete Election</button>
    	</form>
    	</div>
        <?php
    }

} else {
    echo "Du har inte behörighet att visa denna sida";
}

 ?>

<?php
$access = array(1);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){

$ongoingSession = $evote->ongoingSession();

$buttonstate = "disabled";
if($ongoingSession){
	$buttonstate = "active";
}
 #------------KNAPPRAD-------------
 //$mg->printElectionadminPanelMenu(0);

#-------------NYTT VAL--------------
if($evote->checkCheating()){
    echo "Någon fuling har mixtrat i databasen.";
}

if(!$ongoingSession){ ?>
	<h4>Det pågår inget valtillfälle.</h4>
<!--
	<h3>Create new election</h3>
	<hr>
	<div style="max-width: 400px">
	<form action="actions/electionadminpagehandler.php" method="POST">
	<div class="form-group">
	        <label for="vn">Create new election:</label>
	        <input type="text" name="valnamn" class="form-control" id="vn" autocomplete="off">
	</div>
	<div class="form-group" style="max-width: 150px">
	        <label for="ap">Max antal personer:</label>
	        <input type="number" name="antal_personer" class="form-control" id="ap" min="1" autocomplete="off">
	</div>
	<button type="submit" class="btn btn-primary" value="create" name="button">Skapa</button>
	</form>
	</div>
-->
<?php }else{
	$ongoing = $evote->ongoingRound();
	# ---------------NY VALOMGÅNG OCH VISA FÖRRA VALOMGÅNGEN --------------
	if(!$ongoing){?>

	    <h3>Create new election</h3>
		<hr>
		<div class="well" style="max-width: 400px">
		<div class=\"panel panel-default">
	        <form action="/actions/electionadminpagehandler.php" method="POST">
	        <div class="form-group">
	                <label>What to choose:</label>
	                <input type="text" class="form-control" name="round_name" autocomplete="off" maxlength="240">
			</div>
	        <div class="form-group">
	                <label>Temporary Code:</label>
	                <input type="text" class="form-control" name="code" autocomplete="off" maxlength="240"/>
	        </div>
			<div class="form-group" style="max-width: 200px">
	                <label>Number of options:</label>
	                <input type="number" class="form-control" name="max_num" id="max" autocomplete="off" value="1" min="1"/>
	        </div>

<!-- 		<?php
		for($i = 0; $i < 5; $i++){
			$p = $i + 1;
			echo "<div class=\"form-group\">";
			echo "<label>Kandidat $p:</label>";
			echo "<input type=\"text\" class=\"form-control\" name=\"candidates[]\" autocomplete=\"off\">";
	        	echo "</div>";
		}
?> -->
                <br>
                <div><h4><b>Alternatives:</b></h4></div>
                <div class="form-group">Number of fields:
                    <div class="btn-group">
                    <button type="button" class="btn btn-default" id="remove_button" onclick="removeField()">-</button>
                    <button type="button" class="btn btn-default" id="add_button" onclick="addField()">+</button>
                    </div>
                </div>

                <div class="input_fields_wrap form-group" id="input_wrapper">
                    <div><input type="text" class="form-control" name="candidates[]" autocomplete="off" maxlength="240"/><br></div>
                    <div><input type="text" class="form-control" name="candidates[]" autocomplete="off" maxlength="240"/><br></div>
                </div>
                <script >
                   function addField(){
        		var container = document.getElementById("input_wrapper");
                        var cdiv = document.createElement("div");
                        var input = document.createElement("input");
                        var t = document.createTextNode("Alt " + (container.childElementCount+1));
                        input.type = "text";
                        input.className = "form-control";
                        input.name = "candidates[]";
                        input.setAttribute( "autocomplete", "off" );
						input.setAttribute( "maxlength", "240" );
                        //cdiv.appendChild(t);
                        cdiv.appendChild(input);
                        cdiv.appendChild(document.createElement("br"));
                        if(container.childElementCount < 20){
                            container.appendChild(cdiv);
                        }
                    }
                   function removeField(){
        		var container = document.getElementById("input_wrapper");
                        if(container.childElementCount > 2){
                            container.removeChild(container.lastChild);
                        }
                    }
                </script>

	        <button type="submit" class="btn btn-primary" value="begin_round" name="button">Create Election</button>
	        </form>
	        </div>
		</div>
		<br><br>

		<?php

		// Generera tabell med förra omgångens resultat.
		echo "<h3></h3>";
		echo "<hr>";
		$tg->generateResultTable("last");

	# ------------- VALOMGÅNG PÅGÅR ----------------
	}else{
		echo "<h3></h3>";
		echo "<hr>";
		echo "<div class=\"well well-sm\" style=\"max-width: 400px\">";
        echo "<div class=\"panel panel-default\">";

		$tg->generateAvailableOptions();

		echo "</div>";
		echo "<div class=\"span7 text-center\">";
		echo "<form action=/actions/electionadminpagehandler.php method=\"POST\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"button\" value=\"end_round\">End Election</button>";
		echo "</form>";
		echo "</div>";
		echo "</div>";
	}

}
} else {
	echo "Du har inte behörighet att visa denna sida.";
}
?>

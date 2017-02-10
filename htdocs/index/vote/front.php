<?php

if(!$evote->ongoingSession()){
	echo "<p><h3>There is nothing to vote on at the moment.</h3></p><br>";
}else{
	$ongoing = $evote->ongoingRound();

	if(!$ongoing){
		echo "<p><h3>There is nothing to vote on at the moment.</h3></p><br>";
	}else{
            $res = $evote->getOptions();
            if($res->num_rows > 0){
?>
			<div class="well small-centered"">

				<div class="logo">
				<img id="logo-header" src="/tango-vote-logo.png" />
				</div>

				<?php
				$max = $evote->getMaxAlternatives();
				echo "<div name=\"maxalt_header\" >";
					echo "<div id=\"vote-info\">(Choose your favorite couple)</div>";
				echo "</div>";
				?>
	    	    <form action="actions/votingpagehandler.php" method="POST" autocomplete="off">
	    	        <?php
                        $head = "";
						$type = "checkbox";
						$id = 0;
						if($max <= 1){
							$type = "radio";
							$id = 1;
						}
						echo "<div class=\"panel panel-default\">";
	    	        	echo "<table class=\"table table\" id=\"contentTable\">";
                        while($row = $res->fetch_assoc()){
                                if($head != $row["e_name"]){
	    	        	        echo "<tr class=\"rowheader\";><th colspan=\"2\">".$row["e_name"]."</th></tr>";
                                $head = $row["e_name"];
                                                }
	    	        			echo "<tr>
									<td class=\"col-md-1 col-xs-1\">
									<input type=$type class=\"big\" name=\"person[]\" id=$id value=".$row["id"]." onclick=\"maxCheck()\"></td>
	    	        				<td class=\"col-md-11 col-xs-11\">".$row["name"]." </td>";
	    	        		}
	    	        	echo "</table>";
						echo "</div>";
	    	        ?>
					<script>
					function maxCheck(){
    					var max = <?php echo $evote->getMaxAlternatives() ?>;

    					var checkboxes = document.getElementsByName("person[]");
						var countChecked = 0;
						for(var i = 0; i<checkboxes.length; i++){
							if(checkboxes[i].checked == true){
								countChecked++;
							}
						}
						for(var i = 0; i<checkboxes.length; i++){
							checkboxes[i].disabled = false;
							if(checkboxes[i].checked == false && countChecked >= max && checkboxes[i].id != 1){
								checkboxes[i].disabled = true;
							}
						}


					}

					</script>

					</script>
	    	        <div class="vote-code">
	    	            <label >Your secret voting code:</label>
	    	            <input type="password" class="form-control" name="code1">
										<input type="hidden" class="form-control" name="code2" value="1234">
	    	        </div>
							<div class="vote-button text-center">
								<button type="submit" class="btn-lg btn-primary" value="vote" name="button" >Vote!</button>
							</div>
	    	    </form>
		</div>
<?php
            }
		}
	}
?>

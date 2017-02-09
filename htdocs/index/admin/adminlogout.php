<?php

$mg->printAdminMenu(3);

echo "<h3>Logout som administrator</h3>";
echo "<hr>";
echo "<div style=\"max-width: 400px\">";
echo "Är du säker på att du vill Logout?";
echo "</div>";
echo "<br>";
echo "<div style=\"max-width: 400px\">";
echo "<form action=actions/usersessionhandler.php method=\"POST\">";
echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-bottom: 5px\">Logout</button>";
echo "</form>";
echo "</div>";


?>

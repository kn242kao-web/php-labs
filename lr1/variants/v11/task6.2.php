<?php

echo "<h3>Шахова таблиця</h3>";
echo "<table border='1' style='border-collapse: collapse;'>";
for ($row = 0; $row < 4; $row++) {
    echo "<tr>";
    for ($col = 0; $col < 11; $col++) {
        $color = ($row + $col) % 2 == 0 ? "white" : "black";
        echo "<td style='width: 30px; height: 30px; background-color: $color;'></td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "<h3>Кола</h3>";
echo "<div style='display: flex; gap: 10px;'>";
for ($i = 0; $i < 9; $i++) {
    echo "<div style='width: 40px; height: 40px; background-color: blue; border-radius: 50%;'></div>";
}
echo "</div>";
?>
<?php
if (isset($_GET['jml'])) {
    $jml = $_GET['jml'];

    echo "<table border=1 cellpadding=25 cellspacing=0 style='margin:auto; text-align:center;'>\n";
    for ($a = $jml; $a > 0; $a--) {
        $total = 0;
        for ($b = $a; $b > 0; $b--) {
            $total += $b;
        }

        echo "<tr><td colspan='$jml' style='font-weight:bold; background:#f0f0f0;'>TOTAL: $total</td></tr>\n";

        echo "<tr>";
        for ($b = $a; $b > 0; $b--) {
            if ($b == $a) {
                echo "<td style='width:40px;'>$b</td>";
            } else {
                echo "<td>$b</td>";
            }
        }
        echo "</tr>\n";
    }
    echo "</table>";
} else {
    echo "Parameter 'jml' belum diisi. Contoh: ?jml=4";
}
?>

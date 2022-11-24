<?php
header("Content-Type: text/plain");
header('Content-Disposition: attachement; filename="jinujawad.csv"');
$pp = new NumberFormatter("en", NumberFormatter::SPELLOUT);
for ($x = 1; $x <= 10; $x++) {
// echo $x.','."The number is: $x ".','.$pp->format($x)."\n";
// withoutnumber formatter
echo $x.','."The number is: $x ".','.$x."\n";
}
?>

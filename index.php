<?php
$file_pointer = "uploads/log.txt";
// Use unlink() function to delete a file  
if (file_exists($file_pointer)) {
    unlink($file_pointer);
}
include 'cards.php';

$userCards = [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">Upload Log</button>
    </form>


    <table>
        <tr>
            <th class="th-name">Card Name
            </th>
            <th class="th-name">Collected</th>
            <th class="th-name">Rarity</th>
            <th class="th-name">MTGID</th>
        </tr>
        <?php foreach ($sortedCards as $row) {
            echo '<tr class="t-row">';
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['collected'] . "</td>";
            echo "<td>" . $row['rarity'] . "</td>";
            echo "<td>" . $row['mtgid'] . "</td>";
            echo "</tr>";
        } ?>
    </table>
</body>

</html>
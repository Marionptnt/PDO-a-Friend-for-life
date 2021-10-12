
<br>
<h1>I'LL BE THERE FOR YOUUUUUUU</h1>
<br>
<?php

require_once 'connect.php';

$pdo = new \PDO(DSN, USER, PASS);



$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($friends as $friend) {
    echo '<p>'.$friend['firstname'] . ' ' . $friend['lastname'].'</p><br>';
}

?>

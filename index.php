<?php

require_once 'connect.php';

$pdo = new \PDO(DSN, USER, PASS);

$firstname = '';
$lastname = '';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']); 

    if (strlen($firstname) >= 10) {
        $errors[] = "Only 45 characters allowed for firstname";
    }
    if (strlen($lastname) >= 10) {
        $errors[] = "Only 45 characters allowed for lastname";
    }

    if (count($errors) === 0) {
        
        $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname,:lastname)";
        $statement = $pdo->prepare($query);
        
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        
        $statement->execute();

        header('Location: header.php');
        exit;
    }
    
}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<?php
foreach($friends as $friend) {
    echo '<p>'.$friend['firstname'] . ' ' . $friend['lastname'].'</p><br>';
}
foreach($errors as $error) {
    echo "<p>$error</p>";
}
?>
<form  action="index.php"  method="post">
    <div>
      <label  for="Firstname">Firstname :</label>
      <input  type="text"  id="Firstname"  name="firstname" value="<?= $firstname ?>">
    </div>
    <br>
    <div>
      <label  for="Lastname">Lastname :</label>
      <input  type="text"  id="Lastname"  name="lastname" value="<?= $lastname ?>">
    </div>
    <br>
    <div  class="button">
      <button  type="submit"> Be a Friend</button>
    </div>
</form>


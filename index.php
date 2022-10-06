<?php
require_once 'env/connec.php';

$pdo = new PDO(DSN, USER, PASS); 

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);


//IT WORKS, WATCH OUT FOR FOLDER REQUIRING!!!!!!!

//$query = "INSERT INTO friend (firstname, lastname) VALUES ('Chandler', 'Bing')";
//$statement = $pdo->exec($query);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Here's a list of all my friends:</h1>
    <ul>
        <?php foreach ($friends as $friend) : ?>
        <li>
            <p>
                <?= $friend["firstname"] . " " . $friend["lastname"]?>
            </p>
        </li>
        <?php endforeach ?>
    </ul>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    
        <div>
        <label for="firstname">Enter Your First Name:</label>
        <input type="text" id="firstname" name="firstname">
        </div>
        <div>
        <label for="lastname">Enter Your Last Name:</label>
        <input type="text" id="lastname" name="lastname">
        </div>

        <button type="submit">Submit</button>
    </form>

</body>

</html>

<?php

var_dump($_POST);

/* $firstname = $_GET[":firstname"] ? $_GET[":firstname"] : "";
$lastname = $_GET[":lastname"] ? $_GET[":lastname"] : ""; */
// Not this ^^^^^^^^

if ($_SERVER["REQUEST_METHOD"] === "POST"){

    //CHECKS IF YOU CLICK BUTTON TO SEND DATA ^^^^^


$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);

$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $pdo->prepare($query);
$statement->bindValue(":firstname", $firstname, PDO::PARAM_STR);
$statement->bindValue(":lastname", $lastname, PDO::PARAM_STR);
$statement->execute();

}

//<?php echo $_SERVER['PHP_SELF']; injection, tells you to stay on same page.
// Never forget actions and methods in form!!!!!! WHY IT WASN'T WORKING!

?>
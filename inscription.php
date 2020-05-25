<?php 
// Connexion à la base de données
try {
	$bdd = new PDO('mysql:host=localhost;dbname=Artists;charset=utf8', 'root', 'root');
} catch(Exception $e){
        die('Erreur : '.$e->getMessage());
}

try {
// Hachage du mot de passe
$pass_hache = password_hash($_POST['mdp'], PASSWORD_DEFAULT);   
} catch(Exception $e) {
    echo 'Erreur : Hachage';
    die('Erreur : '.$e->getMessage());
}

try {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

// Insertion
$req = $bdd->prepare('INSERT INTO utilisateur (nom, prenom, email, mdp) VALUES(:nom, :prenom, :email, :mdp)');
$req->bindParam(':nom', $nom, PDO::PARAM_STR);
$req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
$req->bindParam(':email', $email, PDO::PARAM_STR);
$req->bindParam(':mdp', $pass_hache, PDO::PARAM_STR);
$req->execute();

//$resultat = $req->fetch();
var_dump($req);

header('Location: login.html');
exit();
}catch(Exception $e){
    echo 'Erreur : Insertion';
    die('Erreur : '.$e->getMessage());
}

?>
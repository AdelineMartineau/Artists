<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=Artists;charset=utf8','root', 'root');
}
catch(Exception $e) {    
        die('Erreur : '.$e->getMessage());
}
try {
    $email = $_POST['email'];
//  Récupération de l'utilisateur et de son mdp hashé
    $req = $bdd->prepare('SELECT utilisateur.id, utilisateur.mdp FROM utilisateur WHERE utilisateur.email = :email');
    $req->bindParam(':email', $email, PDO::PARAM_STR);
    $req->execute();
    $resultat = $req->fetch();

// Comparaison du mdp envoyé avec le formulaire depuis la BDD
    $isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);
    var_dump($resultat);
    var_dump($_POST['mdp']);
    var_dump($resultat['mdp']);
}
catch(Exception $e) {
    echo 'Erreur : Select';
        die('Erreur : '.$e->getMessage());
}


if (!$resultat)
{   
    echo 'Erreur : resultat = false';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $email;

        header('Location: home.php');
        exit();
    }
    else {
        echo 'Erreur : Session';
    }
}
?>
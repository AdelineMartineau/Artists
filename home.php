<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Marvel|Raleway|Montserrat&display=swap" rel="stylesheet">
  <title>L.A Event</title>
</head>

<body>
  <div id="navbar">
    <a class="nav_btn" href="#">Categories</a>
    <a class="nav_btn" href="#">Last Event</a>
    <a class="nav_btn" href="#">About</a>
    <a class="nav_btn" href="#">Contact</a>
    <a class="nav_btn" href="logout.php">Se déconnecter</a>
  </div>
  <div id="main">
    <div id="titles">
      <h2 id="main_title">L.A Event</h2>
      <h3 id="main_subtitle">°° REED NOW °°</h3>
    </div>

  <div id="imgs">
    <img class="img" src="./assets/img/FashionWeekLA.png" alt="">
    <img class="img" src="./assets/img/LoreenTrichetShoot.png" alt="">
    <img class="img" src="./assets/img/StreetDanceEvent.png" alt="">
  </div>

  <form action="addPost.php" method="POST">
    <?php
    try {
      $bdd = new PDO('mysql:host=localhost;dbname=artists;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }

    session_start();

    if (isset($_SESSION['id']) and isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
      $req = $bdd->prepare('SELECT utilisateur.prenom FROM utilisateur WHERE utilisateur.email=?');
      $req->execute(array($email));

      $donnees = $req->fetch();
      echo '<p id="main_user_txt">' . 'Bonjour' . ' ' . htmlspecialchars($donnees['prenom']) . ',  partager ici votre nouvel article : ' . '</p>';
    } else {
      header('Location: login.html');
    }
    ?>

      <input name="titre" type="text" placeholder=" Titre">
      <input name="contenu" type="text" placeholder=" Contenu ">
      <button id="form_btn" type="submit">Publier</button>
    </form>
    <hr>

    <div id="articles">

      <?php
      try {
        $bdd = new PDO('mysql:host=localhost;dbname=artists;charset=utf8', 'root', 'root');
      } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
      }

      $reponse = $bdd->query('SELECT article.titre, article.contenu, article.date, utilisateur.nom, utilisateur.prenom FROM article INNER JOiN utilisateur ON utilisateur.id = article.utilisateur_id ORDER BY article.date DESC');
      $reponse->execute();


      while ($donnees = $reponse->fetch()) {
        echo '<div id="main_article">';
        echo '<h5 id="main_article_author">' . htmlspecialchars($donnees['prenom']) . ' ' . htmlspecialchars($donnees['nom']) . '</h5>';
        echo '<p id="main_article_titre">' . htmlspecialchars($donnees['titre']) . '</p>';
        echo '<p id="main_article_content">' . htmlspecialchars($donnees['contenu']) . '</p>';
        echo '<p id="main_article_date">' . htmlspecialchars($donnees['date']) . '</p>';
        echo '</div>';
      }
      $reponse->closeCursor();
      ?>
    </div>
  </div>
</body>

</html>
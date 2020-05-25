<?php 
        try{
          $bdd = new PDO('mysql:host=localhost;dbname=artists;charset=utf8', 'root', 'root');
        } catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
        
        session_start();

        try{
          $todaydate = date("Y-m-d h:i:s");
          $titre = $_POST['titre'];
            if (isset($_POST['contenu'])) {
          $contenu = $_POST['contenu']; }
          $utilisateur_id = $_SESSION['id'];

        var_dump($todaydate);
        var_dump($contenu);
        var_dump($utilisateur_id);

          // Insertion
          $req = $bdd->prepare('INSERT INTO article (article.titre, article.contenu, article.date, article.utilisateur_id) VALUES(:titre, :contenu, :todaydate, :utilisateur_id)');
          $req->bindParam(':titre', $titre, PDO::PARAM_STR);
          $req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
          $req->bindParam(':todaydate', $todaydate, PDO::PARAM_STR);
          $req->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
          var_dump($req);
          $req->execute();
          header('Location: home.php');
          exit();

          }catch(Exception $e){
              echo 'Erreur : Insertion';
              die('Erreur : '.$e->getMessage());
          }
        ?>
<?php

    // Utilités fonction session_start():  
    // 1:  démarrer une session pour l'utilisateur courant
    // 2:  récupérer sa session (si une déjà présente), possible car au démarrage d'une session le serveur enregistrera un cookie PHPSESSID dans le navigateur client 
    //                                                           -> cookie contient identifiant de la session et sera transmis au serveur avec chaque requête HTTP effectuée par le client                                   
    session_start();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ajout produit</title>
</head>
<body>

    <nav class="navbar poppins-semibold">
        <a class="link" href="index.php"> <i class="icon-navbar fa-solid fa-house fa-sm"></i> Accueil</a>
        <a class="link" href="recap.php"> <i class="icon-navbar fa-solid fa-basket-shopping fa-sm"></i> Panier</a>
    </nav>


    <div class="container poppins-regular">
                
        <h1 class="add-a-product">Ajouter un produit</h1>

        <!-- Formulaire qui nous permettra de renseigner les produits à l'application -->

        <!-- ajout ?action=add sinon formulaire ne fonctionne pas -->
        <form action="traitement.php?action=add" method="post" class="form">    <!-- action:  indique  la  cible  du  formulaire,  le  fichier  à  atteindre  lorsque  l'utilisateur soumettra le formulaire   -->
                                                        <!-- method:  précise  par  quelle  méthode  HTTP  les  données  du  formulaire  seront transmises au serveur -->
                                                        <!-- post (pour method ici) : utiliser pour na  pas "polluer" l'URL avec les données du formulaire (possible d'utiliser méthode GET (méthode par défaut)) : cf page 7-8 pdf -->
            <p>
                <label>
                    Nom du produit :
                    <input type="text" name="name" class="input">     
                    <!-- attribut "name": va permettre à la requête de classer le contenu de la saisie dans des clés portant le nom choisi -->
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input type="number" step="any" name="price" class="input">
                    <!-- attribut "name": idem -->
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input type="number" name="qtt" value="1" class="input">
                    <!-- attribut "name": idem -->
                </label>
            </p>
            <p  class="button-container">
                <input type="submit" name="submit" value="Ajouter le produit" class="button poppins-semibold">
                <!-- submit (type) : représente le bouton de soumission du formulaire -->
                <!-- Possède également attribut "name" : serveur va pouvoir vérifier que le formulaire a bien été validé par l'utilisateur -->
            </p>
        </form>

        <p>Quantité totale de produits: </p>

    </div>
    

    <!-- CORRECTION A FAIRE ICI -->
    <?php

        // if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
           
        //     $totalQtt = 0;  // initialisation nouvelle variable à 0

        //     foreach($_SESSION['products'] as $index => $product){
        //         $totalQtt += $product['qtt'];
        //     }

        //     echo $totalQtt;
        // }
    ?>

</body>
</html>
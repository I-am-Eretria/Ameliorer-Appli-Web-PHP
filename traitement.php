<?php

    // Utilités fonction session_start():  
    // 1:  démarrer une session pour l'utilisateur courant
    // 2:  récupérer sa session (si une déjà présente), possible car au démarrage d'une session le serveur enregistrera un cookie PHPSESSID dans le navigateur client 
    //                                                           -> cookie contient identifiant de la session et sera transmis au serveur avec chaque requête HTTP effectuée par le client                                   
    session_start();



    if(isset($_GET['action'])){

        
        switch($_GET['action']){


            case "add": 

                // Pour éviter utilisateur accède directement à URL page traitement
                // et ainsi provoquer des erreurs  sur  la  page  qui  lui  présenterait  des  informations  que  nous  ne  souhaitons  pas dévoiler
                //  -> limiter l'accès à traitement.php par  les  seules  requêtes  HTTP provenant de la soumission de notre formulaire

                if(isset($_POST['submit'])){    // vérification clef submit dans tableau post, submit correspond à attribut name du formulaire



                    // vérification intégrité des valeurs transmises dans le tableau post

                        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                        // FILTER_SANITIZE_STRING : supprime présence caractères spéciaux / balise HTML ou encode  -> Pas d'injection de code HTML possible

                        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        // FILTER_VALIDATE_FLOAT :  validera  le  prix  seulement si c'est bien un  nombre  à virgule
                        // ajout de FILTER_FLAG_ALLOW_FRACTION :  permet l'utilisation du caractère "," ou "." pour la décimale
                        
                        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                        // FILTER_VALIDATE_INT : quantité validée  que  si  celle-ci  est  un nombre entier différent de zéro (qui est considéré comme nul)



                    // vérification pour voir si filtres ont bien fonctionné
                    if ($name && $price && $qtt){   // on ne les compare à rien de précis car si filtre échoue renverra false ou null

                        // stockage des données en session -> tableau session

                            // tableau associatif product pour chaque produit
                            $product = [
                                "name" => $name,
                                "price" => $price,
                                "qtt" => $qtt,
                                "total" => $price*$qtt
                            ];


                        // enregistrement nouveau produit créé en session
                        $_SESSION['products'][] = $product;
                            //      clef  (dans tableau session)
                            //  []  ->  raccourci indiquant à cet emplacement nouvelle entrée au futur tableau products
                    }


                    // Fonction header () : envoie un nouvel entête HTTP (les entêtes d'une réponse) au client
                    // ici type d'appel "Location" -> réponse envoyée au client avec status code 302 -> redirection
                    header("Location:index.php");



                }   // condition true seulement si requête post transmet une clef submit au serveur
                    // sinon redirection grâce à la fonction header()



            break;

            

            case "delete": 
                // fonction unset : détruit la ou les variables
                // -> ici détruit un produit spécifique (via l'identifiant) du tableau de produits stocké en session
                unset($_SESSION['products'][$_GET['id']]);
                header("Location: recap.php");

            break;

           
            case "clear": 

                // fonction unset : détruit la ou les variables
                // -> ici détruit le tableau products
                unset($_SESSION['products']);
                header("Location: recap.php");

            break;



            case "up-qtt": 

                // désigne tableau products -> cible product en particulier (id) -> quantité de ce produit -> +1 à quantité actuelle
                $_SESSION["products"][$_GET['id']]['qtt'] ++;

                // Mis à jour du prix total pour le produit où la quantité a été incrémentée
                $_SESSION["products"][$_GET['id']]['total'] = $_SESSION["products"][$_GET['id']]['price'] * $_SESSION["products"][$_GET['id']]['qtt'];

                header("Location: recap.php");

            break;

            

            case "down-qtt": 

                    // vérifier si le paramètre id est défini dans l'URL
                    // + vérifier si le produit existe
                    if(isset($_GET["id"]) && isset($_SESSION["products"][$_GET["id"]])){

                        // décrémenter / -1 à quantité actuelle du produit
                        $_SESSION["products"][$_GET['id']]['qtt'] --;

                        // Mise à jour du prix total pour le produit où la quantité a été décrémentée
                        $_SESSION["products"][$_GET['id']]['total'] = $_SESSION["products"][$_GET['id']]['price'] * $_SESSION["products"][$_GET['id']]['qtt'];


                        // si qtt = 0 -> on supprime le produit de la session
                        if($_SESSION["products"][$_GET['id']]['qtt'] == 0){
                            unset($_SESSION['products'][$_GET['id']]);

                        }
                        
                        // redirection vers panier (mis à jour)
                        header("Location: recap.php");
                    }


            break;

        }
    }




    // if(isset($_GET)['action']){

        //     switch($_GET['action']){
        //         case "add": ;
        //         case "delete": ;
        //         case "clear": ;
        //         case "up-qtt": ;
        //         case "down-qtt": ;
        //     }
        // }

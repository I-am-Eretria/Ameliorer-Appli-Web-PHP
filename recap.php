<?php

    // Ici besoin de parcourir le tableau de session
    // Appel fonction session_start() en début de fichier afin de récupérer session correspondante à l'utilisateur
    session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Récapitulatif des produits</title>
</head>
<body>
    

    <nav class="navbar poppins-semibold">
        <a class="link" href="index.php"> <i class="fa-solid fa-house fa-sm"></i> Accueil</a>
        <a class="link" href="recap.php"> <i class="fa-solid fa-basket-shopping fa-sm"></i> Panier</a>
    </nav>

    <div class="container poppins-regular">
            
        <?php 
            // fonction isset() : détermine si une variable est déclarée et est différente de null
            // ici avec ! -> si clef 'products' du tableau session n'existe pas
            // OU
            // la clef existe mais ne contient aucune donnée : fonction empty()
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                echo "<p>Aucun produit en session...</p>";
            }

            // Affichage dynamique des produits
            else {
                echo "<table>",
                        "<thead>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th></th>", // colonne +1 quantité
                                "<th>Quantité</th>",
                                "<th></th>", // colonne -1 quantité
                                "<th>Total</th>",
                                "<th> </th>", // colonne pour supprimer produit / tousles produits
                            "</tr",
                        "</thead>",
                        "<tbody>";

                $totalGeneral = 0;  // initialisation nouvelle variable à 0

            
                // Boucle pour permettre affichage uniforme de chaque produit
                foreach($_SESSION['products'] as $index => $product){
                    // $index : aura pour valeur l'index du  tableau  $_SESSION['products'] parcouru
                    //          -> permet numérotation de chaque produit dans tableau HTML (1ère colonne)
                    // $product : variable qui contiendra le produit sous forme de tableau (création et stockage dans fichier traitement.php)
                
                    echo "<tr>",
                            "<td>".$index."</td>",
                            "<td>".$product['name']."</td>",

                            // fontion number_format( variable à modifier, nombre de décimales souhaité,  caractère séparateur décimal, caractère séparateur de milliers);
                            // &nbsp;  ->   entité HTML  -> non-breaking space  -> permet d'ajouter un espace insécable

                            // "<td>".$product['price']."</td>",      // BASE
                            "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",   // AVEC FORMAT MONÉTAIRE



                            // "<td>".$product['qtt']."</td>",    // avant
                            "<td> <a href='traitement.php?action=up-qtt&id=$index'> + </a> </td>",  // +1 qtt
                            "<td>".$product['qtt']."</td>",
                            "<td> <a href='traitement.php?action=down-qtt&id=$index'> - </a> </td>",    // -1 qtt


                            // "<td>".$product['total']."</td>",      // BASE
                            "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",   // AVEC FORMAT MONÉTAIRE

                            // supprimer un seul produit
                            "<td> <a href='traitement.php?action=delete&id=$index'>supprimer</a> </td>",

                        "</tr>";
                    $totalGeneral += $product['total']; // ajout du total du produit parcouru à la valeur de $totalGeneral 
                }
                

                $totalQtt = 0;  // initialisation nouvelle variable à 0
                        foreach($_SESSION['products'] as $index => $product){
                            $totalQtt += $product['qtt'];
                        }


                echo "<tr>",
                        "<td colspan=6>Total général : </td>",  // cellule fusionnée de 6 cellules (colspan=6)
                        "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",

                        // supprimer tous les produits
                        "<td> <a href='traitement.php?action=clear'>supprimer le panier</a> </td>",
                        "</tr>",
                        "<tr> <td>  </td> </tr>", // temporaire : pour ajouter un espace
                        "<tr> <td>  </td> </tr>", // temporaire : pour ajouter un espace
                        "<td colspan=6> Quantité totale : $totalQtt produit(s)</td>",
                    "</tbody>",
                    "</table>";

            }

            
        
        ?>
    </div>

</body>
</html>


<!-- Tests (au tout début)   [p16 PDF cours]

    ajout dans body : < ? php var_dump($_SESSION); ?>  
    
    - pour s'assurer du bon fonctionnement de traitement.php 
    - aussi pour disposer d'un visuel de la structure du tableau session (pour le parcourir correctement)  
    - ajout d'un produit "pirate" qui n'a pas affecté le tableau de session : les filtres fonctionnent correctement 
    
-->




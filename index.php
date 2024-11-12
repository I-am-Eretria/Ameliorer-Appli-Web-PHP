<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout produit</title>
</head>
<body>
    
    <h1>Ajouter un produit</h1>

    <!-- Formulaire qui nous permettra de renseigner les produits à l'application -->

    <form action="traitement.php" method="post">    <!-- action:  indique  la  cible  du  formulaire,  le  fichier  à  atteindre  lorsque  l'utilisateur soumettra le formulaire   -->
                                                    <!-- method:  précise  par  quelle  méthode  HTTP  les  données  du  formulaire  seront transmises au serveur -->
                                                    <!-- post (pour method ici) : utiliser pour na  pas "polluer" l'URL avec les données du formulaire (possible d'utiliser méthode GET (méthode par défaut)) : cf page 7-8 pdf -->
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name">     
                <!-- attribut "name": va permettre à la requête de classer le contenu de la saisie dans des clés portant le nom choisi -->
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" step="any" name="price">
                <!-- attribut "name": idem -->
            </label>
        </p>
        <p>
            <label>
                Quantité désirée :
                <input type="number" name="qtt" value="1">
                <!-- attribut "name": idem -->
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
            <!-- submit (type) : représente le bouton de soumission du formulaire -->
            <!-- Possède également attribut "name" : serveur va pouvoir vérifier que le formulaire a bien été validé par l'utilisateur -->
        </p>
    </form>

</body>
</html>
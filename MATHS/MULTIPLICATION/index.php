<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/main.css">

    <title>Tables de Mutiplication</title>
</head>


<body id="bg">

    <!--script PHP pour faire appel à une table de Multiplication en fonction de notre choix-->
    <div class="container">
        <div class="row">
            <div class="col-md-12"><br>
                <?php
                $table = filter_input(INPUT_GET, 'table', FILTER_VALIDATE_INT); //Récupère une variable externe et la filtre
                if ($table !== FALSE && $table !== NULL) {
                    echo "<h3>Table de $table</h3>";
                    echo "<ul>";
                    for ($i = 1; $i <= 10; $i++)
                        echo "<li>$i x $table = " . ($i * $table) . "</li>"; //Fait l'écho de la table et effectue la réponse sous forme de "LISTE". 
                    echo "</ul>";
                }
                ?>
            </div>
        </div>
    </div>


    <form method="GET">
        <input type=number name="table" placeholder="Choisit ta table">
        <button type="submit">Voir la table</button>
    </form>
</body>

</html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="vues/PagePrincipal.css" media="screen"  />
        <title>Page d'erreur</title>
    </head>
    <body>
        <h1>ERREUR !!!!!</h1>
        <?php
        echo "<a href='?action=afficherNews'>Retour page principal</a><br><br>";

        if(ModelA::isAdmin())
        echo "<a href='?action=PageAdmin'>Retour page Admin</a><br>";

        ?>

        <table id="customers">
            <tr>
                <th>ERREUR</th>
            </tr>

            <?php
            if (isset($e2)){
                echo'<tr>';
                echo '<td>Erreur inattendue !!!</td>';
                echo'</tr>';
            }else if(isset($e)){
                echo'<tr>';
                echo '<td>Erreur inattendue PDOException!!!</td>';
                echo'</tr>';
            }
                echo'<tr>';
                echo '<td>'.$e2->getMessage().'</td>';
                echo '<td>'.$e->getMessage().'</td>';
                echo'</tr>';
            ?>

        </table>
    </body>
</html>
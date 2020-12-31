<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="vues/PagePrincipal.css" media="screen"  />
        <title>Page de News</title>
    </head>
    <body>
        <div id="titre" >
            <h1 >News</h1>
        </div>

        <?php
        echo "<a href='?action=pageConnexion'>Se connecter</a><br><br>";
        echo "<a href='?action=rafraichir'>Rafraichir news</a>";
        ?>

        <table id="customers">
            <tr>
                <th>Date</th>
                <th>Titre</th>
                <th>Description</th>
            </tr>
            <?php
            if ((new Model)->nbNews()==0){
                echo '<h2>Il n\'y a pas de flux à afficher connecté vous en tant que admin et ajouter un flux</h2>';
            }else {
                $nbfoisvisiter=5;
                foreach ($tabNews as $value) {
                    echo '<tr>';
                    echo '<td>' . $value->get_Date() . '</td>';
                    echo '<td><a href="' . $value->get_Lien() . '">' . $value->get_Titre() . '</a></td>';
                    echo '<td>' . $value->get_Description() . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <div id="selectionPage">
            <?php
                if($nbPage>1){
                    echo'<a href="index.php?&page=1">1</a>';
                    if($page>1){
                        echo'<a href="index.php?&page='.($page-1).'"> < </a>';
                    }
                    echo'...'.$page.'...';
                    if($page<$nbPage){
                        echo'<a href="index.php?&page='.($page+1).'"> > </a>';
                    }
                    echo '<a href="index.php?&page='.$nbPage.'">'.$nbPage.'</a>';
                }else{
                    echo "1 page disponible";
                }
            ?>
        </div>



    </body>

</html>

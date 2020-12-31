<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="vues/PagePrincipal.css" media="screen"  />
        <title>Page Admin</title>
    </head>
    <body>
        <?php
        echo "<a href='?action=deconnecter'>Se déconnecter</a><br><br>";
        ?>
        <label>Le nombre de flux que vous avez ajouter récemment :</label>
        <?php
        $nbFoisAjouterFlux=ModelCookie::getCookiesAjouter();
        if (isset($nbFoisAjouterFlux)){
            echo '<label>'.$nbFoisAjouterFlux.'</label><br><br>' ;
        }else{
            echo '<label>0</label><br><br>' ;
        }
        ?>
        <label>Le nombre de flux que vous avez supprimer récemment :</label>
        <?php
        $nbFoisSupprimerFlux=ModelCookie::getCookiesSupprimer();
        if (isset($nbFoisSupprimerFlux)){
            echo '<label>'.$nbFoisSupprimerFlux.'</label><br><br>' ;
        }else{
            echo '<label>0</label><br><br>' ;
        }
        ?>

        <table id="customers">
            <tr>
                <th>Titre</th>
                <th>Description</th>
            </tr>

            <?php
            if ((new ModelA)->getNbFlux()==0){
                echo '<h2>Il n\'y a pas de flux</h2>';
            }else{
                foreach($tabFlux as $value){
                    echo'<tr>';
                    echo '<td><a href="'.$value->getLien().'">'.$value->getTitre().'</a></td>';
                    echo '<td>'.$value->getDescription().'</td>';
                    echo'</tr>';
                }
            }
            ?>

        </table>
        <div id="gauche">
                <form method="POST" action="?action=ajouterFlux">
                    <h2>Gérer les flux RSS</h2><br>
                    <label for="fname">Ajouter Flux</label><br>
                    <input type="text" name="url" placeholder="Rentrer l'URL du flux à ajouter" required><br>
                    <input type="submit" name='Ajouter'>
                </form>

                <form method="POST" action="?action=supprimerFlux">
                    <label for="lname">Supprimer Flux</label><br>
                    <input type="text" name="url" placeholder="Rentrer l'URL du flux a supprimer" required>
                    <input type="submit" value='Supprimer' >
                </form>
        </div>


        <div id="droite">
            <form method="POST" action="?action=changerNbNews">
                <h2>Gérer le nombre de news</h2><br>
                <label>Choisissez le nombre de news à afficher</label>
                <label>
                    <select name="nbnews" >
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </label>
                <input type="submit" value='Valider'>
            </form>
        </div>

        <div>

        </div>
    </body>
</html>





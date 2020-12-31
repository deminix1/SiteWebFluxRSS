<html>
    <body>
        <?php
            //chargement config
            require_once(__DIR__.'/config/config.php');

            //chargement autoloader pour autochargement des classes
            require_once(__DIR__.'/config/Autoload.php');

            Autoload::charger();

            $cont = new ControleurFront();
            //TODO exporter base de données
            ?>
    </body>
</html>

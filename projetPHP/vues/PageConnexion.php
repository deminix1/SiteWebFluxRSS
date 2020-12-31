<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="vues/PagePrincipal.css" media="screen"  />
        <title>Page de Connexion</title>
    </head>
    <body>
        <div id="container">
            <form method="POST" action="?action=seConnecter">
                <h2>Connexion </h2>
                <label><b>Nom d'utilisateur</b></label>
                <label>
                    <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>
                </label>
                <label><b>Mot de passe</b></label>
                <label>
                    <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                </label>
                <input type="submit" value='Se Connecter' >
            </form>
        </div>
    </body>
</html>





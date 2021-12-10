<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css" />
    <title>Document</title>
</head>

<body id="index">
    <div class="wrapper">
        <h2 class="title">Afegir Usuari</h2>
        <form autocomplete="off" action="../../scripts/afegir/afegirC.php" method="POST">
            <div class="field">
                <input id="username" name="username" type="text" required />
                <label>Nom d'Usuari</label>
            </div>
            <div class="field">
                <input id="nom" name="nom" type="text" required />
                <label>Nom</label>
            </div>
            <div class="field">
                <input id="cognoms" name="cognom" type="text" required />
                <label>Cognoms</label>
            </div>
            <div class="field">
                <input id="adreca" name="adreca" type="text" required />
                <label>Adreça</label>
            </div>
            <div class="field">
                <input id="email" name="email" type="text" required />
                <label>Correu Electrònic</label>
            </div>
            <div class="field">
                <input id="telefon" name="telefon" type="text" required />
                <label>Telèfon</label>
            </div>
            <div class="field">
                <input type="submit" value="Afegir" />
            </div>
        </form>
    </div>
</body>

</html>
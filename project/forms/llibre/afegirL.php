<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css" />
    <title>Afegir Llibre</title>
</head>

<body id="index">
    <div class="wrapper">
        <h2 class="title">Afegir Llibre</h2>
        <form autocomplete="off" action="../../scripts/afegir/afegirL.php" method="POST">
            <div class="field">
                <input id="isbn" name="isbn" type="text" required />
                <label>ISBN</label>
            </div>
            <div class="field">
                <input id="titol" name="titol" type="text" required />
                <label>Títol</label>
            </div>
            <div class="field">
                <input id="autor" name="autor" type="text" required />
                <label>Autor</label>
            </div>
            <div class="field">
                <input type="submit" value="Afegir" />
            </div>
        </form>
    </div>
</body>

</html>
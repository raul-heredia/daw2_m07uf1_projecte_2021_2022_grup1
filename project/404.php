<?php
header( "refresh:5;url=./index.html" );
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import 'https://fonts.googleapis.com/css?family=Inconsolata';

        html {
            min-height: 100%;
        }

        body {
            overflow: hidden;
            box-sizing: border-box;
            height: 100%;
            background-color: #000;
            background-image: radial-gradient(#11581e, #041607), url("https://media.giphy.com/media/oEI9uBYSzLpBK/giphy.gif");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Inconsolata', Helvetica, sans-serif;
            font-size: 1.5rem;
            color: rgba(128, 255, 128, 0.8);
            text-shadow: 0 0 1ex rgba(51, 255, 51, 1), 0 0 2px rgba(255, 255, 255, 0.8);
        }

        .noise {
            pointer-events: none;
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url("https://media.giphy.com/media/oEI9uBYSzLpBK/giphy.gif");
            background-repeat: no-repeat;
            background-size: cover;
            z-index: -1;
            opacity: 0.02;
        }

        .overlay {
            pointer-events: none;
            position: absolute;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(180deg, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0) 100%);
            background-size: auto 4px;
            z-index: 1;
        }

        .overlay::before {
            content: "";
            pointer-events: none;
            position: absolute;
            display: block;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(0deg, transparent 0%, rgba(32, 128, 32, 0.2) 2%, rgba(32, 128, 32, 0.8) 3%, rgba(32, 128, 32, 0.2) 3%, transparent 100%);
            background-repeat: no-repeat;
            animation: scan 7.5s linear 0s infinite;
        }

        @keyframes scan {
            0% {
                background-position: 0 -100vh;
            }

            35%,
            100% {
                background-position: 0 100vh;
            }
        }

        .terminal {
            box-sizing: inherit;
            position: absolute;
            height: 100%;
            width: 1250px;
            max-width: 100%;
            padding: 4rem;
            text-transform: uppercase;
        }

        .output {
            color: rgba(128, 255, 128, 0.8);
            text-shadow: 0 0 1px rgba(51, 255, 51, 0.4), 0 0 2px rgba(255, 255, 255, 0.8);
        }

        .output::before {
            content: "> ";
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        a::before {
            content: "[";
        }

        a::after {
            content: "]";
        }

        .errorcode {
            color: white;
        }
    </style>
</head>

<body>
    <div class="noise"></div>
    <div class="overlay"></div>
    <div class="terminal">
        <h1>Error <span class="errorcode">404</span></h1>
        <p class="output">L'usuari introduit no es correcte, comprova l'usuari i contrassenya i torna a intentar-ho.</p>
        <p class="output">En breus seràs redirigit a la pàgina d'inici, si no ets redirigit <a href="./index.html">Fes
                clic
                aquí</a> .</p>
        <p class="output">Bona sort.</p>
    </div>
</body>
</html>

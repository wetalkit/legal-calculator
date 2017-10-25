<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Правен Калкулатор</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="/css/style.css" type="text/css">
        <link rel="stylesheet" href="/css/main.css" type="text/css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Exo+2:200" rel="stylesheet">
        <link rel="icon" href="/images/favicon.png" type="image/x-icon"/>
    </head>
    <body class="{{ isset($bodyClass) ? $bodyClass : '' }}">
        <div class="hero-container fixed-top">
            <div class="header">
                <div class="div-block-logo">
                    <a href="/">
                        <img src="images/logo.png" alt="Правен калкулатор на трошоци" class="logopad">
                    </a>
                </div>
                <div class="div-block menu"></div>
            </div>
        </div>
        <div class="wrapper">
            <div class="content">
                @yield('content')
                <footer>
                    <div class="line"></div>
                    <div class="section-2">
                        <div class="div-block-7">
                            <div class="text-block-2">
                                Со ❤ од <a href="http://wetalkit.xyz" target="_blank">WeTalkIT</a> и <a href="https://www.facebook.com/skopjelegalhackers" target="_blank">Skopje Legal Hackers</a>
                            </div></div>
                        <a href="/about" class="footerbttn w-button-footer">За Нас</a>
                        <a href="/Регистар-на-правни-поими.pdf" class="footerbttn w-button-footer">Водич</a>
                        <a href="/report-bug" class="footerbttn w-button-footer">Пријави Баг</a>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>

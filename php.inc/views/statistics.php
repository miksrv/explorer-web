<!DOCTYPE html>
<html lang="ru">
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/animate.css">
        <link rel="stylesheet" type="text/css" href="../css/weather-icons.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="apple-touch-icon" sizes="57x57" href="images/icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="images/icons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="images/icons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/icons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="images/icons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="images/icons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/icons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="images/icons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="images/icons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="images/icons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/icons/favicon-16x16.png">
        <link rel="manifest" href="images/icons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="images/icons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <title><?= $language->title; ?></title>
    </head>
    <body>
        <header>
            <div class="wrapper content">
                <div class="logo"><img src="../images/logo.png" alt="Automatic weather station" /> <?= $language->description; ?></div>
                <nav>
                    <ul>
                        <?= $lang_menu; ?>
                    </ul>
                </nav>
            </div>
        </header>
        <section>
            <div class="wrapper content">
                <div id="container"></div>
            </div>
        </section>
        <footer>
            <div class="wrapper content">
                <div>Powered by Arduino & PHP\HTML - See on <a href="https://github.com/miksrv/explorer" title="" target="_blank">Github</a></div>
                <div>Copyright &copy; <a href="http://miksrv.ru" title="" target="_blank">Mishka</a> & weather icons &copy; <a href="http://erikflowers.github.io/weather-icons" title="" target="_blank">Erik Flowers</a></div>
            </div>
        </footer>
    </body>
    <script type="text/javascript" src="../../js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">var set = '<?= $set; ?>';</script>
    <script type="text/javascript" src="../../js/charts.js"></script>
</html>
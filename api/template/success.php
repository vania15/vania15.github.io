<?php
session_start();
$order = isset($_SESSION['order']) ? $_SESSION['order'] : '-';
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '-';
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '-';

$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'ru';
$translationDir = dirname(__DIR__) . '/translations';
if (file_exists($translationDir)) {
    $i18nFile = file_exists("$translationDir/$language.php") ? "$translationDir/$language.php" : "$translationDir/ru.php";
    include_once $i18nFile;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $i18n['newsuccess_thanks'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div class="wrap">
    <header class="header">
        <div class="header__left">
            <div class="header__title">
                <?= $i18n['newsuccess_thanks'] ?>
            </div>
            <div class="header__description">
                <h3><?= $i18n['newsuccess_dontturnoff'] ?></h3>
                <?= $i18n['newsuccess_orderaccept'] ?> <?= $i18n['newsuccess_contactyou'] ?>
            </div>
        </div>
        <div class="header__right">
            <div class="header__info">
                <div class="header__info-title">
                    <?= $i18n['newsuccess_orderinfo'] ?>
                </div>
                <div class="header__info-order"><?= $order ?></div>
                <div class="header__info-phone"><?= $phone ?></div>
                <div class="header__info-name"><?= $name ?></div>
            </div>
        </div>
    </header>
    <main class="main-content">
        <h1 class="main-content__title"><?= $i18n['newsuccess_howto'] ?></h1>
        <div class="main-content__description">
            <?= $i18n['newsuccess_getinstr'] ?>
        </div>
        <div class="form-block">
            <div class="form-block__left">
                <div class="form-block__left-info">
                    <?= $i18n['newsuccess_confirm'] ?>
                </div>
                <div class="form-block__left-discount">
                    <?= $i18n['newsuccess_discount'] ?>
                </div>
            </div>
            <div class="form-block__right">
                <div class="form-wrap">
                    <div class="form-wrap__title">
                        <?= $i18n['newsuccess_email'] ?>
                    </div>
                    <form action="#" class="main-form" method="POST">
                        <input type="email" name="email" class="main-form__email" placeholder="<?= $i18n['newsuccess_getemail'] ?>" required="">
                        <button type="submit" class="main-form__button"><?= $i18n['newsuccess_instr'] ?></button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__text">
            <?= $i18n['newsuccess_info'] ?> <?= $i18n['newsuccess_agree'] ?>
        </div>
    </footer>
</div>
<script src="js/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("form.main-form").on("submit", function () {
            $.post(
                "https://system.trackerlead.biz/user/subscribe",
                {feedback_email: $("input.main-form__email").val(), orderid: "<?= $order ?>"}
            );
            $(this).fadeOut("fast", function () {
                $(this).parent().append("<p style='font-size: 1.2em; line-height: 2em; text-align: center;'>Спасибо!</p>");
            });
            return false;
        });
    });
</script>
</body>
</html>
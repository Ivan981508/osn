<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тонировка</title>
    <link href="template/images/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="template/style/resetStyle.css">
    <link rel="stylesheet" href="template/style/LoadFonts.css">
    <link rel="stylesheet" href="template/style/admin.css">
    <meta name="format-detection" content="telephone=no">
</head>
<body>
    <div id="popup">
        <input type="button" id="select_close" class="close_window">
        <div id="load_window">
            <div id="loader_css"><div class="wrapper"><div class="cssload-loader"></div></div></div>
        </div>
        <div id="window"></div>
    </div>
    <div id="panel_block">
        <div class="wrapper">
            <header>
                <img src="template/images/logo.png">
                <a href="/">nokton /admin</a>
                <p>Панель управления</p>    
            </header>
            <div id="group_setting">
                <section class="tool" data-type="call">
                    <div class="img_tool"></div>
                    <p>Звонки</p>
                    <?php if($count_call != 0){ ?><div class="notice"><p><?=$count_call;?></p></div><?php } ?>
                </section>
                <section class="tool" data-type="reserve">
                    <div class="img_tool"></div>
                    <p>Бронь</p>
                    <?php if($count_reserve != 0){ ?><div class="notice"><p><?=$count_reserve;?></p></div><?php } ?>
                </section>
                <section class="tool">
                    <div class="img_tool"></div>
                    <p>Цены</p>
                </section>
                <section class="tool">
                    <div class="img_tool"></div>
                    <p>Фото</p>
                </section>
            </div>
            <div class="clear"></div>
            <input type="button" value="выход с аккаунта" id="exit_acc">    
        </div>
    </div>
    <script src="public/js/jquery-3.2.1.min.js"></script>
    <script src="public/js/general.js"></script>
    <script src="public/js/admin.js"></script>
</body>
</html>

<?php include ROOT."/views/layouts/head.php";?>
<body>
    <?php include ROOT."/views/layouts/nav.php";?>
    <header>
        <div class="wrapper">
            <h1><span>Тонировка авто</span><span>в новотроицке и в орске</span></h1>
        </div>
    </header>
    <div id="make_order">
        <div class="wrapper">
            <div id="main_view_car">
                <div><p>Забронируй заказ</p></div>
                <div><p>получи скидку</p></div>
                <img src="template/images/make_order/car.png">
            </div>
            <div id="info_action">
                <input type="button" class="button" value="Забронировать заказ" onclick="window.location='/price_order'">
                <p id="notice_action">* акция действует ограниченное время, распространяется на любую тонировку и услуги. Размер скидки определяется рандомно</p>
            </div>
        </div>
    </div>
    <div id="warning">
        <div class="wrapper">
            <p>Внимание!!! Сайт является дипломной работой. Сайт функционирует в показательном режиме и не предоставляет никаких услуг!</p>
        </div>
    </div>
    <div id="about_us" class="wrapper">
        <p class="h">О нашей работе</p>
        <p class="text">Наша компания предлагает полный спектр услуг по тонировке автомобилей и стекол. <br><br>
            Наши услуги для тех, кто понимает, что важнее всего для человека – его безопасность. Мы выполняем тонировку по самым актуальным технологиям с использованием качественных и современных материалов. Обращаясь в нашу компанию, вы может быть уверены, что наши специалисты сделают все от них зависящее, чтобы ваши жизнь и здоровье перестали зависеть от случайностей.<br><br>
            Наш центр выполняет тонировку автомобилей в соответствии  с требованиями действующих нормативов, стандартов. Обратившись к нам, вы можете не опасаться, что на трассе у вас возникнут сложности с сотрудниками ГИБДД на предмет некорректно выполненных работ или несоответствия тонировки нормативным значениям.<br><br>
        </p>
        <div id="advantages">
            <div class="wrapper">
                <div><p>Быстрое выполнение</p></div>
                <div><p>Качественная работа</p></div>
                <div><p>Гарантия на работу</p></div>
            </div>
        </div>
        <ul id="about_us_bg">
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div id="toner_info">
        <div class="wrapper">
            <p class="h">МЫ работаем напрямую с производителями</p>
            <p class="p_h">Поэтому наши цены самые низкие в новотроицке</p>
            <ul id="list_manufacturer">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>  
            <img src="template/images/demo_img.png"> 
            <input type="button" class="button" value="Расчитать стоймость" onclick="window.location='/price_order'">
            <span>Расчёт цены в несколько кликов </span>
            <div class="clear"></div> 
        </div>
    </div>
    <div id="link_portfolio">
        <div class="wrapper">
            <div id="bg_link_portfolio">
                <span><?=$count_portfolio;?> работ</span>
                <p>Портфолио</p>
            </div>
            <div id="info_portfolio">
                <img src="template/images/logo_black.png">
                <strong>Все наши работы тут!</strong>
                <p>Мы фотографируем каждую машину, после выполненных работ, чтобы вы могли посмотреть и удостовериться в качестве нашей работы. Предлагаем вам посмотреть наши работы.</p>
                <input type="button" class="button" value="Смотреть" onclick="window.location='/portfolio'">
            </div>
        </div>
    </div>
    <div id="comment_block">
        <div class="wrapper">
            <p class="h">Отзывы</p>
            <div id="arrow_group">
                <input type="button" id="left_arrow">
                <input type="button" id="right_arrow">
            </div>
            <div id="group_review">
                <?php for($i=0;$i<6;$i++) { if(!isset($review[$i])) break;?>
                <div id="review_<?=$review[$i]->id;?>" class="review">
                    <div class="img_review">
                        <img src="template/images/reviews_avatar/<?=$review[$i]->img;?>" style="height: inherit;">
                    </div>
                    <div class="info_review">
                        <p class="nick_review"><?=$review[$i]->name;?></p>
                        <p class="text_review"><?=$review[$i]->text;?></p>
                        <p class="date_review">Дата: <span><?=$review[$i]->date;?></span></p>
                    </div>
                </div> 
                <?php } ?>   
            </div>
            <div class="clear"></div>
            <a id="add_comment" href="#">Оставить отзыв</a>
        </div>
    </div>
    <?php include ROOT."/views/layouts/footer.php";?>
</body>
<script>
$(document).ready(function(){
    setNavActive(1);
    updateWarning($(window).scrollTop());
    $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();
        updateNav(scrollTop);
        updateWarning(scrollTop);
    });
});
</script>
</html>
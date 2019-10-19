<?php include ROOT."/views/layouts/head.php";?>
<body>
    <?php include ROOT."/views/layouts/nav.php";?>
    <div id="warning" class="fixed_warn">
        <div class="wrapper">
            <p>Внимание!!! Сайт является дипломной работой. Сайт функционирует в показательном режиме и не предоставляет никаких услуг!</p>
        </div>
    </div>
    <form id="price_order" class="wrapper">
        <div id="select_car">
            <p class="h">1. ВыБерите класс вашего авто</p>
            <div class="select_group">
                <input type="radio" id="select_car_1" value="0" name="select_car" checked>
                <label for="select_car_1"><div></div><p>Отечественный автомобиль</p></label>
                
                <input type="radio" id="select_car_2" value="1" name="select_car">
                <label for="select_car_2"><div></div><p>Малый<br> класс</p></label>
                
                <input type="radio" id="select_car_3" value="2" name="select_car">
                <label for="select_car_3"><div></div><p>Средний<br> класс</p></label>
                
                <input type="radio" id="select_car_4" value="3" name="select_car">
                <label for="select_car_4"><div></div><p>Бизнес<br> класс</p></label>
                
                <input type="radio" id="select_car_5" value="4" name="select_car">
                <label for="select_car_5"><div></div><p>Премиум<br> класс</p></label>
                
                <input type="radio" id="select_car_6" value="5" name="select_car">
                <label for="select_car_6"><div></div><p>Внедорожник</p></label>
            </div>
        </div>
        <div class="clear"></div>
        <div id="select_firm">
            <p class="h">2. Выберите производителя пленки</p>
            <div class="select_group">
                <input type="radio" id="select_firm_1" value="0" name="select_firm" data-name-firm="suntek" checked>
                <label for="select_firm_1"><div></div></label>
                
                <input type="radio" id="select_firm_2" value="1" name="select_firm" data-name-firm="llumar">
                <label for="select_firm_2"><div></div></label>
                
                <input type="radio" id="select_firm_3" value="2" name="select_firm" data-name-firm="sparks">
                <label for="select_firm_3"><div></div></label>
                
                <input type="radio" id="select_firm_4" value="3" name="select_firm" data-name-firm="armolan">
                <label for="select_firm_4"><div></div></label>
                
                <input type="radio" id="select_firm_5" value="4" name="select_firm" data-name-firm="suncontrol">
                <label for="select_firm_5"><div></div></label>
            </div>
        </div>
        <div class="clear"></div>
        
        <div id="select_toner">
            <p class="h">3. Выберите степень светопропускания</p>
            <div class="select_group"></div>    
        </div><!--Одинаковое 1 -->
        <div class="clear"></div>
        <div id="select_window">
            <p class="h">4. Выберите стёкла</p>
            <div class="select_group">
                <input type="checkbox" id="select_window_1" value="0" name="select_window[]">
                <label for="select_window_1">Лобовое стекло</label>
                
                <input type="checkbox" id="select_window_2" value="1" name="select_window[]">
                <label for="select_window_2">Полоса на лобовое</label>
                
                <input type="checkbox" id="select_window_3" value="2" name="select_window[]">
                <label for="select_window_3">Передние боковые стёкла</label>
                
                <input type="checkbox" id="select_window_4" value="3" name="select_window[]">
                <label for="select_window_4">Задние боковые стёкла</label>
                
                <input type="checkbox" id="select_window_5" value="4" name="select_window[]">
                <label for="select_window_5">Заднее стекло</label>
            </div>
        </div>
        <div class="clear"></div>
        <div id="view_car">
            <div id="toner_1"></div>
            <div id="toner_2"></div>
        </div>
        <p class="text">Независимо от объекта общая стоимость  рассчитывается исходя из объема и сложности работ, площади подлежащего тонировке остекления, а также используемого материала.<br><br>
        Точно определить, сколько будет стоить тонировка стекол автомобиля или другого объекта, возможно только после замеров, которые делают наши специалисты на месте. Уточните цену у наших менеджеров перед тем, как оформить заказ, таким образом, в будущем не возникнет недопонимания и недоразумений.</p>
        <div id="open_order">
            <div id="services">
                <div class="list_service_0">
                    <input type="checkbox" id="service_0" value="0" name="select_service[]">
                    <label for="service_0"></label>
                    <div class="info_service">
                        <p>Снять старую тонировку</p>
                        <span>от 500 Р</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="list_service_1">
                    <input type="checkbox" id="service_1" value="1" name="select_service[]">
                    <label for="service_1"></label>
                    <div class="info_service">
                        <p>Нанести новую тонировку</p>
                        <span>от 800 Р</span>
                    </div>
                </div>
            </div>
            <div id="info_price">
                <p class="h">Приблизительная<span>стоймость</span></p>
                <p id="price">0 Р</p>
                <i>Возможно изменение цены в связи с технически-арматурными работами.</i>
                <input type="button" class="button" value="Забронировать заказ">
            </div>
        </div>
    </form>
    <?php include ROOT."/views/layouts/footer.php";?>
</body>
<script>
$(document).ready(function(){
    var windows = [
        [0,0.5,10,20,35],//Suntek
        [0,0.5,10,15,20,35,50,75,80],//Llumar
        [0,0.5,10,15,20,35,50,75,80],//Sparks
        [0,0.5,15,20,35,50],//Armolan
        [0,0.5,10,15,20,35,50],//suncontrol
    ];
    function update(){
        $.post( "/ajax/calculate",$("#price_order").serialize(),function(data) {
            price = data;
            $("#price").html(price+" Р");
        });
    }
    $("#price_order input[type='radio'],#price_order input[type='checkbox']").click(function(){
        update();
    });
    var id_firm = 0;
    var id_car = 0;
    var power_light = windows[0][0];
    $("#nav_bg").fadeIn(100);
    $(".active").css({"background-color":"white",color: "#353545"});
    
    loadWindowFirm(id_firm);
    function loadWindowFirm(id)
    {
        var html = "";
        for(var i=1;i<windows[id].length;i++) html += '<input type="radio" id="select_toner_'+i+'" value="'+windows[id][i]+'" name="select_toner">\
                    <label for="select_toner_'+i+'"><div></div><p>'+windows[id][i]+'%</p></label>';
        
        $("#select_toner .select_group").fadeOut(function(){
            $(this).html("");
            $("#select_toner .select_group").html(html);
            $("#select_toner_1").attr("checked","");
            updatePowerLight();
            $("#select_toner .select_group").fadeIn();
        });
        
    }
    loadCar(id_car);
    loadToner(id_car);
    function loadToner(arg){
        if(arg == "clear") $("#view_car div").removeAttr("style");
        else {
            for(var i=1;i<3;i++) $("#toner_"+i).css("background","url(template/images/view_car/car_toner_"+id_car+"/"+i+".png)");
            updatePowerLight();
        }
    }
    function updatePowerLight(){
        var light = $('input[name=select_toner]:checked').val();
        power_light = (100-parseInt(light))/100;
        for(var i=1;i<3;i++) $("#toner_"+i).css("opacity",power_light);
    }
    function loadCar(id){
        id_car = id;
        $("#view_car").css("background",'url(template/images/view_car/car_'+id_car+'.png)');
        loadToner();
    }
    var view_window = [false,false];
    $("#select_window input").click(function(){
        var val = $(this).val();
        var id_window = 0;
        if(val == 2) id_window = 1;
        else if(val == 3) id_window = 2;
        updateVisibleWindow(id_window);
    });
    function updateVisibleWindow(id){
        if(!view_window[id]) {
            $("#toner_"+id).css("display","block");
            
            view_window[id] = true;
        }
        else {
            $("#toner_"+id).css("display","none");
            view_window[id] = false;
        }
    }
    $("#select_toner").on("click","input",function(){
        updatePowerLight();
    });
    $("#select_firm input").click(function(){
        id_firm = $("input[name='select_firm']:checked").val();
        loadWindowFirm(id_firm);
    });
    $("#select_car input").click(function(){//Клик по машине
        var id = $("#select_car input:checked").val();
        loadCar(id);
    });
    $("#select_firm input").click(function(){//Клик на фирме плёнки
        var id = $("#select_firm input:checked").val();
        loadWindowFirm(id);
    });
    setNavActive(2);
});
</script>
</html>
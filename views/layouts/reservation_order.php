<div id="reservation_order">
    <div id="ro_header">
        <p>Забронировать <span>заказ</span></p>
    </div>
    <div id="ro_inform">
        <div id="input_call_reserv">
            <label>Ваш номер телефона:</label>
            <input type="text" id="call_reserv" placeholder="+7 100 106 00 00">
            <p>Нажимая на кнопку «Забронировать» вы даете согласие на обработку своих персональных данных в соответсвии со статьей 9 федерального закона от 27 июля 2006 Г. NО 152-ФЗ «О ПЕРСОНАЛЬНЫХ ДАННЫХ».</p>
            <div class="notice_reserv">Мы перезвоним вам в течений 30 минут!</div>
            <input type="button" class="button" value="Забронировать">
        </div>
        <div id="reserve_inform">
            <strong>Приблизительная стоимость:</strong>
            <span id="reserve_price">- РУБ</span>
            <p>Данная стоимость является приблизительной, при бронирований заказа, стоймость не учитывается и может быть расчитана только на месте.
            <span>Оставьте свой номер телефона, мы вам перезвоним и назначим время приезда в сервис + мы вам дадим скидку в 10%</span></p>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#reserve_price").html(price+" РУБ");
    $("#input_call_reserv input[type='button']").click(function(){
        showNoticePhone("hide","","","");
        $.ajax({
            url:"/ajax/insertCall",
            method: "POST",
            dataType: 'json',
            data:{
                phone:$("#call_reserv").val(),
                type:"reserve",
                data:descript
            },
            success: function(json){
                if(json.status == "success") showNoticePhone(2,json.type,".notice_reserv","#call_reserv");
                else showNoticePhone(1,json.type,".notice_reserv","#call_reserv");
            }
        });
    });
});
</script>
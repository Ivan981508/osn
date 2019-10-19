<div id="order_call">
    <div id="left_block"><img src="template/images/logo_black.png"></div>
    <div id="form_call">
        <p class="h">Хотите, мы перезвоним Вам
        и ответим на интересующие вас вопросы?</p>

        <p class="notice">fgd</p>
        <input type="text" placeholder="+7 999 643 67 77" id="phone">
        <input type="button" class="button" value="Жду звонка">
        <div class="clear"></div>
        <p id="personal_data_help">Нажимая на кнопку «ЖДУ ЗВОНКА» вы даете согласие на обработку своих персональных данных в соответсвии со статьей 9 федерального закона от 27 июля 2006 Г. NО 152-ФЗ «О ПЕРСОНАЛЬНЫХ ДАННЫХ».</p>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#form_call input[type='button']").click(function(){
        showNoticePhone("hide","","","");
        $.ajax({
            url:"/ajax/insertCall",
            method: "POST",
            dataType: 'json',
            data:{
                phone:$("#phone").val(),
                type:"call",
                data:"Заявка на звонок!"
            },
            success: function(json){
                if(json.status == "success") showNoticePhone(2,json.type,"#form_call .notice","#phone");
                else showNoticePhone(1,json.type,"#form_call .notice","#phone");
            }
        });
    });

});
</script>
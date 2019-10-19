<form id="edit_review">
    <p class="h">Оставьте свой отзыв</p>
    <div id="group_input_name">
        <label>Как вас зовут?</label>
        <input type="text" id="edit_name">
    </div>
    <div id="group_input_order">
        <label>№ заказа:</label>
        <input type="text" id="edit_order">
        <p>Где взять № заказа?</p>
    </div>
    <div class="clear"></div>
    <label>Напишите ваш отзыв:</label>
    <textarea id="edit_text_review"></textarea>
    <div id="load_img">
        <input type="file" id="load_file" onchange="setFileName()">
        <label for="load_file">Выбрать изображение</label>
        <p>Изображение не выбрано</p>
    </div>
    <div class="clear"></div>
    <p class="text">Все поля обязательны для заполнения, отзыв должен быть содержательным и обоснованным. Перед публикацией, отзыв проходит проверку у администратора!</p>

    <div id="footer_edit_review">
        <p class="error">Тут будут ошибки</p>
        <div id="bg_button">
            <input type="submit" class="button" value="Оставить отзыв">
        </div>
    </div>
</form>
<script>
$(document).ready(function(){
    $("#edit_review").submit(function(e){
        e.preventDefault();

        var file = $('#load_file').prop('files')[0];
        var data = new FormData();
        data.append('photo', file);
        data.append('name', $("#edit_name").val());
        data.append('order', $("#edit_order").val());
        data.append('text', $("#edit_text_review").val());

        $.ajax({
            url:"/ajax/insertReview",
            dataType: 'json',
            type: "POST",
            url:"/ajax/insertReview",
            data: data,
            processData: false, // не преобразовывать данные
            contentType: false, // не устанавливать заголовок, браузер умнее ;)
            success: function(json){
                if(json.status == "success") {
                    showError(2,json.type);
                    $("#edit_review input,#edit_text_review,#load_file,#footer_edit_review input").attr("disabled","");
                }
                else showError(1,json.type);
            }
        });
    });
    function showError(id,text){
        $("#footer_edit_review .error").fadeOut(function(){
            $(this).html(text);
            $(this).removeClass("error_color_red,error_color_green");
            if(id == 1) $(this).addClass("error_color_red");
            else if(id == 2) $(this).addClass("error_color_green");

            $(this).fadeIn();
        });
    }

});
</script>
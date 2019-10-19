<div id="edit_price">
    <div class="loading_table">
        <div class="loading"><i style="width: 40px;height: 40px;"></i></div>
        <p>Идёт загрузка таблицы ...</p>
    </div>
    <div id="bottom_tool">
        <div id="select_firm">
            <input type="radio" name="select_firm" id="select_firm_0" checked>
            <label for="select_firm_0"></label>

            <input type="radio" name="select_firm" id="select_firm_1">
            <label for="select_firm_1"></label>

            <input type="radio" name="select_firm" id="select_firm_2">
            <label for="select_firm_2"></label>

            <input type="radio" name="select_firm" id="select_firm_3">
            <label for="select_firm_3"></label>

            <input type="radio" name="select_firm" id="select_firm_4">
            <label for="select_firm_4"></label>
        </div>
        <div class="clear"></div>
        <div id="input_update">
            <p class="error"></p>
            <input type="button" class="button" value="Обновить цены" id="update_price">
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    loadPrice(0);
    $("#select_firm input").click(function(){
        id = parseNum($(this).attr('id'));
        current_firm = id;
        loadPrice(id);
    });
    $("#update_price").click(function(){
        showError("#edit_price .error","","hide");
        var price = generateLinesPrice();
        $.ajax({
            url:"/ajax/updatePrice",
            type: "POST",
            dataType: 'json',
            data: {
                id:current_firm,
                price:price
            },
            success: function(json){
                $("#edit_price .error").removeClass("n_color_green n_color_red");
                if(json.status == "success"){
                    showError("#edit_price .error",json.type,"show");
                    $("#edit_price .error").addClass("n_color_green");
                }
                else if(json.status == "fail"){
                    showError("#edit_price .error",json.type,"show");
                    $("#edit_price .error").addClass("n_color_red");
                }
            }
        });
    });
});
</script>
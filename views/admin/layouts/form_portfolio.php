<form id="form_portfolio">
    <div class="img_form"></div>
    <div id="loading_list_photo">
        <div class="loading"><i style="width: 40px;height: 40px"></i></div>
        <p>Идёт загрузка изображений ...</p>
    </div>
    <div id="group_photo"></div>
    <div class="clear"></div>
    <div id="input_load_photo">
        <p class="error">Тут будут ошибки</p>
        <input type="file" id="load_photo" multiple  onchange="uploadPhoto(this)">
        <label for="load_photo">Загрузить фото в портфолио</label>
        <p id="count_photo">Количество фото в портфолио: <span><?=$count_portfolio;?></span></p>    
    </div>
</form>
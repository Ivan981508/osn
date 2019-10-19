<div class="form_call" id="type_<?=$type;?>">
    <div class="img_form"></div>
    <div class="none_call"><p>Заявок нету</p></div>
    <div class="scroll_group" style="<?=$attr;?>">
        <div class="wrapper_group">
            <div class="group_call">
                <?php for($i=0;$i<count($list_call);$i++) { ?>
                <div>
                    <img src="template/images/admin/phone.png">
                    <div class="info_call">
                        <strong><?=$text;?></strong>
                        <p class="phone_client">Телефон: <span><?=$list_call[$i]['phone'];?></span></p>
                        <?php if($type == "reserve") { ?> <p class="descript_call"><?=$list_call[$i]['data'];?></p> <?php } ?>
                    </div>
                    <input type="button" class="del_call" data-type="<?=$type;?>" data-id="<?=$list_call[$i]['id'];?>">
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <a href="#" class="close_call" onclick="closeWindow()">Закрыть</a>
</div>
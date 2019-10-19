<?php include ROOT."/views/layouts/head.php";?>
<body>
    <?php include ROOT."/views/layouts/nav.php";?>
    <div id="portfolio" class="wrapper">
        <p id="descript_portfolio"><span id="allot_1">Мы фотографируем</span><span id="allot_2"> каждую машину,</span><br>
        после выполненных работ, чтобы вы могли посмотреть и удостовериться в качестве нашей работы. Предлагаем вам посмотреть наши работы.</p>
        <div id="group_photo" class="view_photo">
            <?php 
            $i = 1;
            while($i <= 6){
                if(isset($prtfl[$i])) {?>
                <div id="prtfl_job_<?=$i;?>" class="prtfl" data-id="<?=$prtfl[$i]->id;?>">
                    <img src="template/images/portfolio/<?=$prtfl[$i]->name;?>">
                    <?php if($i == 1) { ?>
                    <div id="prtfl_hover">
                        <p class="prtfl_count"><?=$count_portfolio;?> фото</p>
                        <p class="prtfl_titul">Портфолио</p>
                        <p class="text">Нажмите на любое фото, чтобы начать смотреть альбом</p>
                    </div>
                    <?php } ?>
                </div>
            <?php $i++;}
            }?>
        </div>
        <div class="clear"></div>
    </div>
    <?php include ROOT."/views/layouts/footer.php";?>
</body>
<script>
$(document).ready(function(){
	setNavActive(3);
    countphoto = '<?=$count_portfolio;?>';
	$("#nav_bg").fadeIn(100);
    $(".active").css({"background-color":"white",color: "#353545"});
    resize("#group_photo img",".prtfl","resize_width");
});
</script>
</html>
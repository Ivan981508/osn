<?php 
    if($review->img == "none_img.jpg") $name_img = "none_img_big.jpg";
    else $name_img = $review->img;
?>
<div id="view_review">
    <div id="img_review">
    </div>
    <div id="data_review">
        <p class="review_name"><?=$review->name;?></p>
        <p class="review_text"><?=$review->text;?></p>
        <p class="review_date"><?=$review->date;?></p>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#img_review").html('<img src="template/images/reviews_avatar/<?=$name_img;?>">');

    $("#view_review").css("height",$("#view_review").height());
    $("#view_review").addClass("center");
    resize("#img_review img","#img_review","resize_width");
});
</script>
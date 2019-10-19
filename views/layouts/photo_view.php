<div id="photo_view">
	<div id="loader_css"><div class="wrapper"><div class="cssload-loader"></div></div></div>
	<img src="template/images/portfolio/<?=$photo->name;?>">
	<div id="panel_key">
		<input type="button" id="pv_left" class="pv_arrow">
		<input type="button" id="pv_right" class="pv_arrow">
		<input type="button" id="pv_close">
		<p id="pv_counter"><?=$current;?>/<?=$count_portfolio;?></p>
	</div>
</div>
<script>
	resize("#photo_view img","#photo_view","resize_height");
	$("#pv_close").click(function(){closeWindow();});
</script>
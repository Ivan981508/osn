$(document).ready(function(){
	//Инициализируем функций и переменный для доступа к ним
	window.showError = showError;
	window.uploadPhoto = uploadPhoto;
	window.loadPrice = loadPrice;
	window.generateLinesPrice = generateLinesPrice;
	window.current_firm = 0;
	var edit_td = 0;



	/*
		==============================================================================================
		Обработчики нажатия кнопок
		==============================================================================================
    */
	$("body").on("click",".edit",function(){
		if(!$(this).children('input').length > 0)
		{
			edit_td = $(this);
			var value = $(this).html();
			$(this).append("<input type='number' value='"+value+"'>");
			var form = $('.edit input'), formVal = form.val();
			form.val('').focus().val(formVal);
		}
	});
	$("body").on("focusout",".edit input",function(){
		var value = $(this).val();
		if(value <= 0) value = 0;
	  	edit_td.html(value);
	});
	$("body").on("click",".del_photo",function(){
		var id = $(this).attr("data-id");
		var el = $(this);
		$.ajax({
            url:"/ajax/deletePhoto",
            type: "POST",
            data: {id:id},
            success: function(json){
                el.parent(".photo").fadeOut(function(){
                	$(this).remove();
                	var count = parseInt($("#count_photo span").html())-1;
                	updateCountPhoto(count);
                });
            }
        });
	});
	$("#autoriz").submit(function(e){
		e.preventDefault();
		showError("#autoriz .error","","hide");
        $.ajax({
            url:"/ajax/login",
            method: "POST",
            dataType: 'json',
            data: $(this).serialize(),
            success: function(json){
                if(json.status == "success") {
                	$("#autoriz").fadeOut(function(){
                		location.reload();
                	});
                }
                else showError("#autoriz .error",json.type,"show");
            }
        });
	});
	$("#exit_acc").click(function(e){
		$.post( "/ajax/exitAdmin",function(data) {
			$("#panel_block").fadeOut(function(){
				location.reload();
			});
        });
	});
	$('body').on("click",".close_window",function(){//Срабатывает когда закрываешь окна
		closeWindow();
	});
	$("#group_setting section:nth-child(3)").click(function(){
		ShowWindow(); 
		$.post( "/ajax/editPrice",function(data) {
			$("#window").html(data);
			$("#load_window").css("display","none");
			$("#window").fadeIn();
        });
	});
	$("#group_setting section:nth-child(4)").click(function(){
		ShowWindow(); 
		$.post( "/ajax/viewPortfolio",function(data) {
			$("#window").html(data);
			$("#load_window").css("display","none");
			$("#window").fadeIn(function(){updatePortfolio();});
        });
	});
	$("#group_setting section:nth-child(1),#group_setting section:nth-child(2)").click(function(){listCall($(this).attr("data-type"));});
	$("body").on("click",".del_call",function(){
		var el = $(this);
		var id = el.attr("data-id");
		var type = el.attr("data-type");
		$.ajax({
            url:"/ajax/delCall",
            method: "POST",
            data:{
                id:id
            },
            success: function(data){
                el.parent("div").remove();
                if($(".group_call").html().trim() === '') $(".scroll_group").fadeOut();
                var count = $(".group_call > div").length;
                if(count <= 0) $("section[data-type='"+type+"'] .notice").remove();
                else $("section[data-type='"+type+"'] .notice p").html(count);
            }
        });
	});



	/*
		==============================================================================================
		Функции
		==============================================================================================
    */
	function updateCountPhoto(value){
        $("#count_photo span").html(value);
	}
	function uploadPhoto(el){
		showError("#form_portfolio .error","","hide");

		var data = new FormData();
        var files = el.files; //это массив файлов

        if(files.length > 0)
        {
        	$("#group_photo").css("display","none");
			$("#loading_list_photo").fadeIn();
	        for(var i=0;i<files.length;i++) data.append("photo[]",files[i]);

	        $.ajax({
	            url:"/ajax/uploadPhoto",
	            type: "POST",
	            data: data,
	            dataType: 'json',
	            processData: false, // не преобразовывать данные
	            contentType: false, // не устанавливать заголовок, браузер умнее ;)
	            success: function(json){
	            	if(json.status == "fail" || json.status == "warning") showError("#form_portfolio .error",json.type,"show");
	            	else if(json.status == "success") updateCountPhoto(json.count);
	            	$("#loading_list_photo").fadeOut(function(){
	            		updatePortfolio();
	            	});
	            }
	        });
    	}
    }
	function updatePortfolio(){
		$.post( "/ajax/updatePortfolio",function(data) {
			$("#loading_list_photo").fadeOut(function(){
				$("#group_photo").html(data);
				$("#group_photo").fadeIn();
				resize("#group_photo img",".photo","resize_width");
			});
        });
	}
	function showError(el,text,type){
		if(type == "hide") $(el).fadeOut();
		else {
			$(el).fadeOut(function(){
				$(el).html(text);
				$(el).fadeIn();
			});
		}
	}
	function listCall(type){
		ShowWindow();
		$.ajax({
            url:"/ajax/listCall",
            method: "POST",
            data:{
                type:type
            },
            success: function(data){
                $("#window").html(data);
				$("#load_window").css("display","none");
				$("#window").fadeIn();
            }
        });
	}
	function generateLinesPrice(){
		var str = "";
		for(var i=2;i<7;i++)
		{
			for(var j=2;j<8;j++)
			{
				str += $("table tr:nth-child("+i+") td:nth-child("+j+")").html()+",";
			}
			str = str.slice(0,-1);
			str += "|";
		}
		str = str.slice(0,-1);
		return str;
	}
	function loadPrice(id){
		$("#edit_price table").remove();
		$.ajax({
            url:"/ajax/loadTablePrice",
            type: "POST",
            data: {id:id},
            success: function(data){
                $("#edit_price").append(data);
                $("#edit_price table").fadeIn();
            }
        });
	}
});
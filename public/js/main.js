$(document).ready(function(){
	//Инициализируем функций и переменный для доступа к ним
	window.setNavActive = setNavActive;
	window.setFileName = setFileName;
	window.showNoticePhone = showNoticePhone;
	window.updateDescript = updateDescript;
	window.updateNav = updateNav;
	window.updateWarning = updateWarning;
	window.views_photo = false;
	window.countphoto = 0;
	window.currentphoto = 0;
	window.price = 0;
	window.descript = "";
	var old_count_review = 0;
	var count_review = 0;




	/*
		==============================================================================================
		Функции
		==============================================================================================
    */
	function updateDescript(){//Генерируем описание заказа
        var windows = "";
        windows += $("input[name=select_car]:checked +label p").html()+"|";
        windows += $("input[name=select_firm]:checked").attr("data-name-firm")+"|";
        windows += $("input[name=select_toner]:checked").val()+"|";
        for(var i=0;i<5;i++)
        {
            if($("#select_window_"+i).prop("checked")) windows += $("#select_window_"+i+"+label").html()+",";
        }
        windows = windows.substring(0, windows.length - 1);
        windows += "|";
        for(var i=0;i<2;i++)
        {
            if($("#service_"+i).prop("checked")) windows += $(".list_service_"+i+" .info_service p").html()+",";
        }
        windows = windows.substring(0, windows.length - 1);
        descript = windows;
    }


	function showNoticePhone(id,text,el,input)//Функция показывающая уведомления для форм обратная связь и забронировать заказ
    {
        var color_text = "";
        var border_input = "";
        if(id == "hide") 
        {
            $(el).html("");
            $(el).fadeOut();
            $(input).removeAttr("style");
        }
        else {
            if(id == 1) {
                color_text = "n_color_red";
                border_input = "#f9542c";
            }
            else if(id == 2) {
                color_text = "n_color_green";
                border_input = "#80d00d";
            }
            $(el).fadeOut(function(){
                $(this).removeClass("n_color_red,n_color_green");
                $(input).css("border-color",border_input);
                $(this).addClass(color_text);
                $(this).html(text);
                $(this).fadeIn();
            });
        }
    }
	

	function leaf(id){//Функция для листания фото
		if(id == "pv_left" && currentphoto-1 >= 1) currentphoto--;
		else if(id == "pv_right" && currentphoto+1 <= countphoto) currentphoto++;
		$("#photo_view img").fadeOut(100,function(){
			$(this).remove();
			$.ajax({
		        url:"/ajax/listPhoto",
		        method: "POST",
		        data:{
		            id:currentphoto
		        },
		        success: function(name){
		            $("#pv_counter").html(currentphoto+"/"+countphoto);
		            $("#photo_view").prepend('<img src="template/images/portfolio/'+name+'">');
		            resize("#photo_view img","#photo_view","resize_width");
		        }
		    });
		});
	}


	function reviewArrow(){//Функция для листания отзывов на главной странице
        $.ajax({
            url:"/ajax/reviewsArrow",
            method: "POST",
            dataType: 'json',
            data:{
                count:count_review
            },
            success: function(json){
                if(json.count_iteration != 0)
                {
                	$("#group_review").fadeOut(function(){
                		$("#group_review").html(json.data);
                		old_count_review = count_review;
                		$("#group_review").fadeIn();
                	});
                }
                else count_review = old_count_review;
            }
        });
	}


	function setNavActive(id){//Выделение белом цветом названия страницы в меню
		$("nav a").removeClass("active");
		$("nav li:nth-child("+id+") a").addClass("active");
		if(id != 1) $(".active").css({"background-color":"white",color: "#353545"});
	}  


	function setFileName() {//Узнаём имя картинки, которая загружают, когда оставляешь отзыв

		var file = $("#load_file").val();
		file = file.replace(/\\/g, "/").split('/').pop();
		$("#load_img p").html('Имя файла: ' + file);
	}



	updateNav($(window).scrollTop());//Вызываем функцию, чтобы поставить фон к меню
    function updateNav(scrollTop){//Функция закрепляет меню наверху, если страницу прокручиваешь на 100px вниз
    	if(!showPopup)
		{
	        if (scrollTop > 100) {
	            $("#nav_bg").fadeIn(100,function(){
	            	$(".active").css({"background-color":"white",color: "#353545"});
	            });
	        } else {
	            $("#nav_bg").fadeOut(100);
	            $(".active").css({"background-color":"transparent",color: "white"});
	        }
    	}
    }
    function updateWarning(scrollTop){
    	if(!showPopup)
        {
            if (scrollTop > 700)
            {
                $("#warning").addClass("fixed_warn");
                $("#about_us").css("margin-top","60px");
            }
            else {
                $("#warning").removeClass("fixed_warn");
                $("#about_us").css("margin-top","0px");
            }
        }
    }





    /*
		==============================================================================================
		Обработчики нажатия кнопок
		==============================================================================================
    */
    $(window).on('keydown' , function( e ) {//чтобы фото при просмотре можно было листать кнопками
    	if(views_photo)
    	{
	        switch( e.keyCode ) {
	            case 37:leaf("pv_left");break;
	          	case 39:leaf("pv_right");break;
	        }
    	}
    });


    $("body").on("click",".pv_arrow",function(){//Нажатие на стрелочки, чтобы листать фото в портфолио
		leaf($(this).attr("id"));
	});


    $(".prtfl").click(function(){//Нажатие на фото в портфолио, для того чтобы открылся просмоторщик фото
		var id = parseNum($(this).attr("data-id"));
		currentphoto = parseNum($(this).attr("id"));
		ShowWindow();
		$.ajax({
            url:"/ajax/viewPhoto",
            method: "POST",
            data:{
                id:id,
                current:currentphoto
            },
            success: function(data){
                $("#window").html(data);
				$("#load_window").css("display","none");
				$("#window").fadeIn();
				views_photo = true;
            }
        });
	});


	$("#arrow_group input").click(function(){//Нажатие на стрелки которые листает отзывы на главной странице
		var id = $(this).attr("id");
		if(id == "left_arrow") count_review-=6;
		else count_review +=6;
		reviewArrow();
	});


    $("body").on("click",".review",function(){//Нажатие на отзыв, чтобы просмотреть его
		ShowWindow();
		var id = parseNum($(this).attr("id"));
		$.ajax({
            url:"/ajax/viewsReview",
            method: "POST",
            data:{
                id:id
            },
            success: function(data){
                $("#window").html(data);
				$("#load_window").css("display","none");
				$("#window").fadeIn();
            }
        });
	});


    $("#button_call").click(function(){//Нажатие на кнопку заказать звонок
		ShowWindow();
		$.post( "/ajax/showCall", function(data) {
			$("#window").html(data);
			$("#load_window").css("display","none");
			$("#window").fadeIn();
		});
	});


	$("#add_comment").click(function(e){//Нажатие на кнопку оставить отзыв
		e.preventDefault();
		ShowWindow();
		$.post( "/ajax/showReviewEdit", function(data) {
			$("#window").html(data);
			$("#load_window").css("display","none");
			$("#window").fadeIn();
		});
	});


    $("#info_price input").click(function(){//нажатие на кнопку Забронировать заказ на странице Расчёт цены
		ShowWindow();
		updateDescript();
		$.post( "/ajax/showOrder", function(data) {
			$("#window").html(data);
			$("#load_window").css("display","none");
			$("#window").fadeIn();
		});
	});


	$('body').on("click",".close_window",function(){//Срабатывает когда закрываешь окна
		closeWindow();
	});


	$("#openMap").click(function(){//Нажатие на кнопку отркыть карту в google maps
    	window.open("https://www.google.ru/maps/dir//51.2072293,58.2961477/@51.2065772,58.3007182,16z/data=!4m2!4m1!3e2?hl=ru");
    });
});
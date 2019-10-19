$(document).ready(function(){
	window.resize = resize;
	window.parseNum = parseNum;
	window.ShowWindow = ShowWindow;
	window.closeWindow = closeWindow;
	window.showPopup = false;


	function parseNum(str){ return parseFloat(String(str).match(/-?\d+(?:\.\d+)?/g, '') || 0, 10); }//Убираем буквы из строки и оставляем только цифры. Пример строка "vadim56", будет "56"
	

	function ShowWindow(){
		var top = $(document).scrollTop();
		var img = "",text = "",h_notice = "",type;
		$("body").addClass("fixed");
		$("body").css("top",-(top));
		$("#popup").fadeIn();
		$("#load_window").css("display","block");
		showPopup = true;
	}


	function closeWindow()//Функция закрытия форм
	{
		views_photo = false;
		$("#window").html(" ");
		$("#window").css("display","none");
		$("#load_window").css("display","none");
		$("body").removeClass("fixed");
		$("#popup").fadeOut("fast");
		var ptop = Math.abs(parseInt($('body').css('top')));
		$(document).scrollTop(ptop);
		showPopup = false;
	}
	function resize(img,parent,type_resize){//Ждём загрузки фото а потом вызываем функцию которая подгоняет размер фото под блок
        var img = $(img);

        img.on('load', function(){
            fix_size(img,parent,type_resize);
            //$('#load_img').css("display","none");
            $(this).css("display","block");
        });
        img.each(function() {
            var src = $(this).attr('src');
            $(this).attr('src', '');
            $(this).attr('src', src);
        }); 
    }

    function fix_size(img,parents,type_resize) {//Функция которая подгоняет размеры изображения под блок
        var images = $(img);
        var type_resize = type_resize;
        images.each(setsize);
        function setsize(parents) {
            var img = $(this),
                img_dom = img.get(0),
                container = img.parents(parents);
            if (img_dom.complete) {
            	if(img_dom.width > container.width() && img_dom.height > container.height()) resize();
            } else img.one('load', resize);

            function resize() {

                if ((container.width() / container.height()) < (img_dom.width / img_dom.height)) {

                	if(type_resize == "resize_width"){
	                    img.height('100%');
	                    img.width('auto');
	                }
	                else if(type_resize == "resize_height"){
	                	img.width('100%');
	                    img.height('auto');
	                }
                    return;
                }

                if(type_resize == "resize_width"){
	                img.width('100%');
	                img.height('auto');
	            }
	            else if(type_resize == "resize_height"){
	            	img.height('100%');
	                img.width('auto');
	            }


            }
        }
    }
});
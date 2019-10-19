<?php


class review
{
    public static function loadReview($id = "all")
    {
    	if($id == "all") $sql = "SELECT * FROM `review` ORDER BY id DESC";
    	else {
    		$id = intval($id);
    		$sql = "SELECT * FROM `review` WHERE id='$id'";
    	}
        $db = db::getConnection();// Соединение с БД

        $result = $db->prepare($sql);// Используется подготовленный запрос
        $result->setFetchMode(PDO::FETCH_ASSOC);// Указываем, что хотим получить данные в виде массива
            
        $result->execute();// Выполнение коменды

        $i = 0;
        $review = [];
        $_monthsList = array(".01." => "января", ".02." => "февраля", 
		".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня", 
		".07." => "июля", ".08." => "августа", ".09." => "сентября",
		".10." => "октября", ".11." => "ноября", ".12." => "декабря");
        while ($row = $result->fetch()) {
            if($id == "all")
            {
                $review[$i]['id'] = $row['id'];
                $review[$i]['img'] = $row['img'];
                $review[$i]['name'] = $row['name'];
                $review[$i]['text'] = $row['text'];
                $review[$i]['date'] = date("d.m.Y", strtotime($row['date']));
                $_mD = ".".explode("-",$row['date'])[1].".";
                $review[$i]['date'] = str_replace($_mD, " ".$_monthsList[$_mD]." ", $review[$i]['date']);
            }
            else {
                $review['id'] = $row['id'];
                $review['img'] = $row['img'];
                $review['name'] = $row['name'];
                $review['text'] = $row['text'];
                $review['date'] = date("d.m.Y", strtotime($row['date']));
                $_mD = ".".explode("-",$row['date'])[1].".";
                $review['date'] = str_replace($_mD, " ".$_monthsList[$_mD]." ", $review['date']);
            }
            $i++;
        }

        if($i == 0) $answer = ["line"=>"none"];
        else $answer = ["line"=>$i,"data"=>$review];
        return json_encode($answer);
        
    }
    public static function listArrow($count){
        $review_info = json_decode(self::loadReview());
        $review = $review_info->data;
        $count_review = $review_info->line;

        $html = "";
        $i = $count;
        $start = $i;
        $count_iteration = 0;
        while($i<$start+6)
        {
            if(!isset($review[$i])) break;
            else {
                $html.= '<div id="review_'.$review[$i]->id.'" class="review">
                    <div class="img_review">
                        <img src="template/images/reviews_avatar/'.$review[$i]->img.'" style="height: inherit;">
                    </div>
                    <div class="info_review">
                        <p class="nick_review">'.$review[$i]->name.'</p>
                        <p class="text_review">'.$review[$i]->text.'</p>
                        <p class="date_review">Дата: <span>'.$review[$i]->date.'</span></p>
                    </div>
                </div>';
            }
            $i++;
            $count_iteration++;
        }
        $answer = ["count_iteration"=>$count_iteration,"data"=>$html];
        return json_encode($answer);
    }
    public static function insertReview($image,$name,$order,$text_review)
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        if($name != "" && $text_review != "" && $order != "")
        {
            if($image != "none_img.jpg")
            {
                $imageFormat = explode('.', $image['name']);
                $imageFormat = $imageFormat[1];

                $nameFile = uniqid().'.'.$imageFormat;
                $imageFullName = $_SERVER['DOCUMENT_ROOT'].'/template/images/reviews_avatar/'.$nameFile;
                $imageType = $image['type'];
            }
            else $imageType = 'image/jpeg';
            // Сохраняем тип изображения в переменную

            if ($imageType == 'image/jpeg' || $imageType == 'image/png') 
            {
                if($image != "none_img.jpg")
                {
                    if (move_uploaded_file($image['tmp_name'],$imageFullName)) $answer = self::saveReview($nameFile,$ip,$order,$name,$text_review);
                    else $answer = ['status'=>"fail","type"=>"Ошибка. Попробуйте позже!"];
                }
                else $answer = self::saveReview($image,$ip,$order,$name,$text_review);
            }
            else $answer = ['status'=>"fail","type"=>"Неверный формат изображения!"];
        }
        else $answer = ['status'=>"fail","type"=>"Некоторые поля не заполнены!"];
        return json_encode($answer);
    }
    public static function saveReview($img,$ip,$order,$name,$text_review){
        $unix_time = time();
        $date_review = date("Y-m-d G:i:s",$unix_time);

        $db = db::getConnection();// Соединение с БД
        $result = $db->prepare("INSERT INTO `review`(`id_order`, `ip`, `img`, `name`, `text`, `date`, `status`) VALUES (:order,:ip,:img,:name,:text_review,'$date_review',1)");

        $result->bindParam(':img', $img);
        $result->bindParam(':ip', $ip);
        $result->bindParam(':order', $order);
        $result->bindParam(':name', $name);
        $result->bindParam(':text_review', $text_review);
        $result->execute();

        $answer = ['status'=>"success","type"=>"Отзыв успешно отправлен! Спасибо)"];
        return $answer;
    }
}
<?php


class portfolio
{
    public static function countPhoto()
    {
    	$db = db::getConnection();// Соединение с БД
        $result = $db->query('SELECT COUNT(*) FROM `portfolio`');
        $num_rows = $result->fetchColumn();
        return $num_rows;
    }
    public static function loadPhoto($arg = "all"){
    	$db = db::getConnection();// Соединение с БД
        if($arg == "all") $sql = "SELECT * FROM `portfolio` ORDER BY id DESC";
        else {
            $id = intval($arg);
            $sql = "SELECT * FROM `portfolio` WHERE id='$id'";
        }

        $result = $db->prepare($sql);// Используется подготовленный запрос
        $result->setFetchMode(PDO::FETCH_ASSOC);// Указываем, что хотим получить данные в виде массива
        $result->execute();// Выполнение коменды

        $i = 1;
        $prtfl = [];
        $prtfl[0] = "";
        while ($row = $result->fetch()) {
            if(!isset($id))
            {
                $prtfl[$i]['id'] = $row['id'];
                $prtfl[$i]['name'] = $row['name'];
            }
            else {
                $prtfl['id'] = $row['id'];
                $prtfl['name'] = $row['name'];
            }
            $i++;
        }
        if($i == 1) $answer = ["line"=>"none"];
        else $answer = ["line"=>$i-1,"data"=>$prtfl];

        return json_encode($answer);
    }
    public static function uploadPhoto(){
        if(isset($_FILES['photo'])) {
            $image = $_FILES['photo'];
            $error = 0;
            for($i=0;$i<count($_FILES['photo']['name']);$i++)
            {
                $imageFormat = explode('.', $image['name'][$i]);
                $imageType = $image['type'][$i];
                if ($imageType == 'image/jpeg') 
                {
                    $nameFile = uniqid().'.'.$imageFormat[1];
                    $imageFullName = $_SERVER['DOCUMENT_ROOT'].'/template/images/portfolio/'.$nameFile;
                    if (move_uploaded_file($image['tmp_name'][$i],$imageFullName)) self::insertPhoto($nameFile);
                    else $error++;
                }
                else {
                    $error++;
                    continue;
                }
            }
            if($error != 0) $answer = ["status"=>"warning","type"=>"Некоторые изображения не были загружены!"];
            else {
                $count = self::countPhoto();
                $answer = ["status"=>"success","count"=>$count];
            }
        }
        else $answer = ["status"=>"fail","type"=>"Ошибка загрузки!"];
        return json_encode($answer);
    }
    public static function insertPhoto($name){
        if(admin::check()){
            $db = db::getConnection();// Соединение с БД
            $result = $db->prepare("INSERT INTO `portfolio`(`name`) VALUES (:name)");
            $result->bindParam(':name', $name);
            $result->execute();
        }
    }
    public static function deletePhoto($id){
        if(admin::check()){
            $photo_info = json_decode(self::loadPhoto($id));
            $namePhoto = $photo_info->data->name;

            $db = db::getConnection();// Соединение с БД
            $result = $db->prepare("DELETE FROM `portfolio` WHERE id=:id");
            $result->bindParam(':id', $id);
            $result->execute();

            $imageFullName = $_SERVER['DOCUMENT_ROOT'].'/template/images/portfolio/'.$namePhoto;
            unlink($imageFullName);
            return true;
        }
    }
}
<?php


class price
{
	public static function updatePrice($firm_id,$data){
		$old_price = self::loadPrice(1);
		if($old_price[$firm_id] != $data)
		{
			$db = db::getConnection();// Соединение с БД

			$sql = "UPDATE `price` SET `data`=:data WHERE id=:firm_id";
	        $result = $db->prepare($sql);
	        $id = $firm_id+1;
	        $result->bindParam(':firm_id',$id);
	        $result->bindParam(':data', $data);
	        $result->execute();

	        $new_price = self::loadPrice(1);
	        if($old_price[$firm_id] == $new_price[$firm_id]) $answer = ["status"=>"fail","type"=>"Ошибка записи в базу данных!"];
	        else $answer = ['status'=>"success","type"=>"Цены успешно изменены!"];
    	}
    	else $answer = ['status'=>"fail","type"=>"Изменений не было!"];
    	return json_encode($answer);
	}
	public static function loadPrice($arg = 0){
		$db = db::getConnection();// Соединение с БД
        $sql = "SELECT * FROM `price`";

        $result = $db->prepare($sql);// Используется подготовленный запрос
        $result->setFetchMode(PDO::FETCH_ASSOC);// Указываем, что хотим получить данные в виде массива
            
        $result->execute();// Выполнение коменды
        $i = 0;
        $data = [];
        while ($row = $result->fetch()) {
        	$data[$i] = $row['data'];
        	$i++;
        }
        if($arg == 0) $answer = self::parse($data);
        else if($arg == 1) $answer = $data;
        return $answer;
	}
	public static function parse($data){
		$price = [];
		for($a = 0;$a<count($data);$a++)
		{
			$str = explode("|",$data[$a]);
			for($b = 0;$b <count($str);$b++)
			{
				$str2 = explode(",",$str[$b]);
				for($c = 0;$c<count($str2);$c++){
					$price[$a][$b][$c] = $str2[$c];
				}
			}
			
		}
		return $price;
	}
    public static function calculate()
    {
    	$calculate = 0;
    	$price = self::loadPrice();
    	
    	if(isset($_POST['select_car']) && isset($_POST['select_firm']) && isset($_POST['select_window']))
    	{
	    	$car = $_POST['select_car'];
	    	$firm = $_POST['select_firm'];
	    	$windows = $_POST['select_window'];

	    	for($i=0;$i<count($windows);$i++){
	    		$calculate += $price[$firm][$windows[$i]][$car];
	    	}
    	}
    	if(isset($_POST['select_service']))
	    {
	    	$service = $_POST['select_service'];
	    	for($j=0;$j<count($service);$j++){
	    		$calculate += $price[5][0][$service[$j]];
	    	}
	    }
    	return $calculate;
    }
    public static function generateTable($firm){
    	$price = self::loadPrice();

    	$html = '<table><tr>
            <td style="width: 140px;"><p>Стёкла</p></td>
            <td><div class="auto_img"></div></td>
            <td><div class="auto_img"></div></td>
            <td><div class="auto_img"></div></td>
            <td><div class="auto_img"></div></td>
            <td><div class="auto_img"></div></td>
            <td style="width: 140px;"><div class="auto_img"></div></td>
        </tr>';
    	for($i=0;$i<5;$i++)
    	{
    		switch ($i) {
    			case 0: $name_window = "Лобовое стекло"; break;
    			case 1: $name_window = "Полоса на лобовое стекло"; break;
    			case 2: $name_window = "Передние боковые стёкла"; break;
    			case 3: $name_window = "Задние боковые стёкла"; break;
    			case 4: $name_window = "Заднее стекло"; break;
    		}
    		$html.= "<tr><td><p>".$name_window."</p></td>";
    		for($auto = 0;$auto<6;$auto++){
    			$html.= "<td class='edit'>".$price[$firm][$i][$auto];
    		}
    		$html.= "</tr>";
    	}
    	$html.= "</table>";
    	return $html;
    }
}
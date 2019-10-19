<?php


class ajax
{
    public static function showCall()
    {
        include ROOT."/views/layouts/order_call.php";
    }
    public static function showReviewEdit()
    {
        include ROOT."/views/layouts/edit_review.php";
    }
    public static function insertCall(){
        $result = call::insertCall();
        echo $result;
    }
    public static function reviewsArrow(){
        $count = intval($_POST['count']);
        echo review::listArrow($count);
    }
    public static function viewsReview(){
        $id = intval($_POST['id']);

        $review_load = json_decode(review::loadReview($id));
        $review = $review_load->data;
        include ROOT."/views/layouts/view_review.php";
    }
    public static function insertReview(){
        if(isset($_FILES["photo"])) $image = $_FILES["photo"];
        else $image = "none_img.jpg";
        $name = $_POST['name'];
        $order = $_POST['order'];
        $text_review = $_POST['text'];
        echo review::insertReview($image,$name,$order,$text_review);
    }
    public static function viewPhoto(){
        $id = intval($_POST['id']);
        $current = intval($_POST['current']);
        $photo_info = json_decode(portfolio::loadPhoto($id));
        $count_portfolio = portfolio::countPhoto();
        $photo = $photo_info->data;
        include ROOT."/views/layouts/photo_view.php";
    }
    public static function listPhoto(){
        $id = $_POST['id'];
        $photo_info = json_decode(portfolio::loadPhoto());
        $array_photo = $photo_info->data;
        echo $array_photo[$id]->name;
    }
    public static function showOrder(){
        include ROOT."/views/layouts/reservation_order.php";
    }
    public static function calculate(){
        $price = price::calculate();
        echo $price;
    }



    //Админ панель
    public static function login(){
        echo admin::autorization();
    }
    public static function exitAdmin(){
        $_SESSION['nokton_token'] = "";
    }
    public static function listCall(){
        $type = $_POST['type'];
        $list_call = call::load($type);
        if($list_call != "none") $attr = "";
        else $attr = "display:none";

        if($type == "call") $text = "Вас просят перезвонить";
        else if($type == "reserve") $text = "Бронирование заказа";
        include ROOT."/views/admin/layouts/list_call.php";
    }
    public static function delCall(){
        $id = intval($_POST['id']);
        call::delete($id);
    }
    public static function viewPortfolio(){
        $count_portfolio = portfolio::countPhoto();
        include ROOT."/views/admin/layouts/form_portfolio.php";
    }
    public static function updatePortfolio(){
        $photo_info = json_decode(portfolio::loadPhoto());
        $count_portfolio = portfolio::countPhoto();
        $photo = $photo_info->data;

        $html = "";
        for($i=1;$i<=$count_portfolio;$i++) {
            $html.='<div class="photo" data-id="'.$i.'">
                <div class="loading"><i style="width: 30px;height: 30px"></i></div>
                <img src="template/images/portfolio/'.$photo[$i]->name.'">
                <input type="button" class="del_photo" data-id="'.$photo[$i]->id.'">
            </div>';
        }
        echo $html;
    }
    public static function uploadPhoto(){
        echo portfolio::uploadPhoto();
    }
    public static function deletePhoto(){
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            echo portfolio::deletePhoto($id);
        }
    }
    public static function editPrice(){
        include ROOT."/views/admin/layouts/edit_price.php";
    }
    public static function loadTablePrice(){
        if(isset($_POST['id'])) echo price::generateTable($_POST['id']);
    }
    public static function updatePrice(){
        if(isset($_POST['id']) && isset($_POST['price']))
        {
            $firm_id = $_POST['id'];
            $data = $_POST['price'];
            echo price::updatePrice($firm_id,$data);
        }
    }
}
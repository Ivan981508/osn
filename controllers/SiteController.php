<?php

class SiteController
{
    public function actionAjax($name_script)
    {
        $loadReviews = ajax::$name_script();
        return true;
    }
    public function actionIndex()
    {
        $count_portfolio = portfolio::countPhoto();
        $review_info = json_decode(review::loadReview());
        $review = $review_info->data;

        require_once(ROOT . '/views/index.php');
        return true;
    }
    public function actionPriceorder()
    {
        $price = price::loadPrice();
        require_once(ROOT . '/views/priceorder.php');
        return true;
    }
    public function actionPortfolio()
    {
        $prtfl_info = json_decode(portfolio::loadPhoto());
        $count_portfolio = $prtfl_info->line;
        $prtfl = $prtfl_info->data;
        require_once(ROOT . '/views/portfolio.php');
        return true;
    }
}

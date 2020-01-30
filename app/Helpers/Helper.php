<?php

use \Illuminate\Contracts\View\Factory;
use \Illuminate\View\View;

if (! function_exists('errorView')) {
    /**
     * 例外エラー発生時にメッセ^字を表示
     * @param null $e
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function errorView($e = null)
    {
        echo '例外発生<br>';
        if(!empty($e)){
            echo '<br>messege:' . $e->getMessage();
            echo '<br>line:' . $e->getLine();
        }
        die();
    }
}

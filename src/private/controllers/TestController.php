<?php

use \PMP\Templating\MustacheHelper as MustacheHelper;
use \PMP\Service\CSRFServiceProvider;

class TestController
{
    public static function Hello()
    {
        CSRFServiceProvider::IssueCSRF(true);
        echo '<h1>Hello from the framework!</h1>';
        echo 'CSRF: '.$_SESSION[PMP_CSRF_TOKEN_NAME];
    }

    public static function Time()
    {
        $dt = new DateTime();
        $times = [
            $dt->setTimezone(new DateTimeZone('Asia/Tokyo'))->format(HUMAN_TIME_FORMAT).' in JST',
            $dt->setTimezone(new DateTimeZone('Etc/Utc'))->format(HUMAN_TIME_FORMAT).' in UTC',
            $dt->setTimezone(new DateTimeZone('America/New_York'))->format(HUMAN_TIME_FORMAT).' in NY'
        ];
        echo MustacheHelper::getMustacheEngine()->render('timePage', ['title' => 'World clock', 'time' => $times]);
    }

    public static function Layout()
    {
        $article = ['title' => 'My awesome article', 'content' => 'Whatever'];
        echo MustacheHelper::getMustacheEngine()->render('article', ['data' => $article]);
    }

    public static function JSON()
    {
        echo 'json';
        var_dump($GLOBALS['requestBody']);
        echo $GLOBALS['requestBody']['asd'];
    }

    public static function Form()
    {
        echo 'form';
        var_dump($GLOBALS['requestBody']);
        echo $GLOBALS['requestBody']['asd'];
    }

    public static function _404()
    {
        http_response_code(404);
        echo
        '<div style="margin-top: 20%; margin-left: 10%">
            <h1>404 - Not Found</h1>
            <h3>PMP Framework</h3>
        </div>';
    }

    public static function Event()
    {
        new \PMP\Event\TestEvent();
    }

    public static function ParamRoute()
    {
        var_dump($_GET);
        $router = \PMP\PMPRouter::class;
        echo $router::GenerateRoute($router::$match['name'], $router::$match['params']);
    }
}

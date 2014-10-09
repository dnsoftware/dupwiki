<?php
/**
 * Created by PhpStorm.
 * User: daemon
 * Date: 09.10.14
 * Time: 21:36
 */

class DognumberForm extends CFormModel
{
    public $dogovor_number = '';

    private static $login;
    private static $password;


    public function rules()
    {
        return array(
            array('dogovor_number', 'required'),
        );
    }


    public function checkdogovor ($login, $password)
    {
        //Yii::app()->session['nash_client'] = 1;


        $url = 'http://naunet.dup.ru/c/login';
        $data = array('login' => $login,
            'password' => $password,
            'rmodule' => 'n',
            'domainList' => '',
            'redirect' => '',
            'type' => '',
            'wantID' => '',
            'wantPeriod' => '',
            'nointredirect' => '',
        );

        $curl = new Curl();
        //$output = iconv("koi8-r", "windows-1251", $curl->post($url, $data));
        $output = $curl->post($url, $data);
        $cookie = $curl->get_cookies_array();
        // print_r($cookie);

//        $redir_url = "http://naunet.dup.ru".$curl->response_headers['Location'];
        $redir_url = "http://naunet.dup.ru/n/".$cookie['ZSessionId']."/statp2?any=".$this->dogovor_number;

        $curl->close();

        $curl = new Curl();
        foreach ($cookie as $ckey => $cval)
        {
            $curl->setCookie($ckey, $cval);
        }
        $output = iconv("koi8-r", "windows-1251", $curl->get($redir_url));


        echo $output;

        return true;
    }

}
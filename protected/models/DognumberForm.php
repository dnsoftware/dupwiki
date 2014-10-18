<?php
/**
 * Created by PhpStorm.
 * User: daemon
 * Date: 09.10.14
 * Time: 21:36
 */

class DognumberForm extends CFormModel
{
    const DOGOVOR_NASH_CLIENT = 1;
    const DOGOVOR_NENASH_CLIENT = 0;
    const DOGOVOR_RESELLER_CLIENT = 2;


    public $dogovor_number = '';

    public $resseler_mails = array();

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
        $output = $curl->post($url, $data);

        $cookie = $curl->get_cookies_array();
//        $redir_url = "http://naunet.dup.ru/n/".$cookie['ZSessionId']."/statp2?any=".$this->dogovor_number;
        $redir_url = "http://naunet.dup.ru/n/".$cookie['ZSessionId']."/?any=".$this->dogovor_number;
//echo $redir_url;
//die();

        $curl->close();

        $curl = new Curl();
        foreach ($cookie as $ckey => $cval)
        {
            $curl->setCookie($ckey, $cval);
        }
        $output = iconv("koi8-r", "utf-8", $curl->get($redir_url));

        preg_match('|any=(\d+?)|siU', $output, $matchnum);
        $login_dognumber = $matchnum[1];
        $redir_url = "http://naunet.dup.ru/n/".$cookie['ZSessionId']."/statp2?any=".$login_dognumber;

        $curl->close();

        $curl = new Curl();
        foreach ($cookie as $ckey => $cval)
        {
            $curl->setCookie($ckey, $cval);
        }
        $output = iconv("koi8-r", "utf-8", $curl->get($redir_url));

        if (preg_match("|<div id='dealerChain'[^>]*>(.+)</div>|siU", $output, $match))
        {

            $dealerchain = strtolower(strip_tags(trim($match[1])));
            if ($dealerchain == 'dup.ru' || strip_tags(trim($match[1])) == 'Борис Витальевич Костырко')
            {
                return self::DOGOVOR_NASH_CLIENT;
            }
            else
            {
                preg_match('|<a href="(.+)"|siU', $match[1], $matchurl);

                //$redir_url = "http://naunet.dup.ru/n/".$cookie['ZSessionId']."/notifications?any=".$this->dogovor_number;
                $redir_url = str_replace("?any", "notifications?any", "http://naunet.dup.ru/".$matchurl[1]);
                $output = iconv("koi8-r", "utf-8", $curl->get($redir_url));

                if (preg_match('|name="NEWREGISTRAR_ADM_EMAILS" value="([^\"]+)"|siU', $output, $match))
                {
                    $this->resseler_mails[$match[1]] = $match[1];
                }
                if (preg_match('|name="NEWEMAIL" value="([^\"]+)"|siU', $output, $match))
                {
                    $this->resseler_mails[$match[1]] = $match[1];
                }
                if (preg_match('|name="NEWREGISTRAR_TECH_EMAILS" value="([^\"]+)"|siU', $output, $match))
                {
                    $this->resseler_mails[$match[1]] = $match[1];
                }

                return self::DOGOVOR_RESELLER_CLIENT;
            }

//            deb::dump($this->resseler_mails);


//            die();
//            echo $output;
        }
        else
        {
            $url = 'http://reg.dup.ru/admin/login.php';
            $data = array(
                'login' => Yii::app()->params['regru_email'],
                'passwd' => Yii::app()->params['regru_password'],
                'email' => Yii::app()->params['regru_email'],
                'ret' => '/admin/',
            );
            $curl = new Curl();
            $output = $curl->post($url, $data);
//echo $output."dd";
//die();
            $cookie = $curl->get_cookies_array();

            $curl->close();

            $curl = new Curl();
            foreach ($cookie as $ckey => $cval)
            {
                $curl->setCookie($ckey, $cval);
            }
            //echo $curl->get('http://reg.dup.ru/admin/');
            $output = iconv("windows-1251", "utf-8", $curl->get('http://reg.dup.ru/admin/'));

//            echo $output;
//            deb::dump($cookie);
//            die();

            $curl->close();
            $url = 'http://reg.dup.ru/admin/users/';
            $data = array(
                'user_name_filter' => $this->dogovor_number,
                'search_user' => 'Борис',
                'find_user' => '1',
            );
            $curl = new Curl();
            $curl->setCookie('admin_index_per_page', 25);
            $curl->setCookie('admin_index_filter', 'd_reg:DESC');
            $curl->setCookie('PHPSESSID', $cookie['PHPSESSID']);

            $output = iconv("windows-1251", "utf-8", $curl->post($url, $data));
            $curl->close();

            preg_match('|Пользователей: (\d+)</h1>|siU', $output, $matchkol);

            if (isset($matchkol[1]) && intval($matchkol[1]) > 0)
            {
                return self::DOGOVOR_NASH_CLIENT;
            }
            else
            {
                return self::DOGOVOR_NENASH_CLIENT;
            }

        }
    }

}
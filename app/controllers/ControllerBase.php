<?php

use Phalcon\Mvc\Controller;

/*
 * 基类
 */

class ControllerBase extends Controller
{
    /* curl会话 */
    protected function curl($url, $post = '', $header = '', $bool = 'utf8', $pem_path = '') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 500);
        if ($post != '') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        if ($pem_path != '') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSLCERT, $pem_path);
        }
        if ($header != '') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        if ($bool == 'gbk') $result = iconv('gbk', 'utf-8', $result);
        return $result;
    }

    /*
     * 检测网络状态是否正常
     */
    protected function checkNetWork() {
        return @fopen('https://www.baidu.com/', "r");
    }

    /*
     * 入口操作方法
     */
    protected function common() {
        $login_title = '登录';
        $login_message = '使用外部账号与密码登录';
        $login_id = 'showLoginDiv';
        if ($this->session->has('uid')) {
            $login_title = '欢迎你，再点一下一键退出';
            $login_message = $this->session->get('nickname');
            $login_id = 'logout';
        }
        $this->view->login_title = $login_title;
        $this->view->login_message = $login_message;
        $this->view->login_id = $login_id;
    }

    /*
     * 随机生成匿名用户名
     */
    protected function getRandomNickName() {
        $db = array(
            '王昭君',
            '赵云',
            '人生如梦',
            '和你同路'
        );
        $index = mt_rand(0, (count($db) - 1));
        return $db[$index];
    }
}

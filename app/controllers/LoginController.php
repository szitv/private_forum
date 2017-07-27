<?php

/*
 * 登录类
 */

class LoginController extends ControllerBase
{
    /*
     * 登录
     */

    public function indexAction() {
        $ret = [];
        if ($this->checkNetWork()) {
            $post = $this->request->getJsonRawBody();
            if ($post) {
                $login_type = 1;
                $uid = isset($post->uId) ? intval($post->uId) : 0;
                $username = isset($post->userName) ? $post->userName : '';
                $password = isset($post->passWord) ? strlen($post->passWord) !== 32 ? md5($post->passWord) : $post->passWord : '';
                $token = isset($post->token) ? $post->token : '';
                $member_db = new Member();
                if ($uid !== 0 && $token !== '') {
                    $check_member_exist = $member_db->findFirst(array("uId = '$uid' order by last_login desc"));
                } else if ($username !== '' && $password !== '') {
                    $login_type = 2;
                    $check_member_exist = $member_db->findFirst(array("userName = '$username' order by last_login desc"));
                } else {
                    $check_member_exist = false;
                }

                if ($check_member_exist) {
                    $get_profile = new Profile();
                    $profile = false;
                    switch($login_type) {
                        case 1:
                            if ($token == $check_member_exist->token) {
                                $profile = $get_profile->findFirst(array("uId = '$uid'"));
                            } else {
                                $ret['code'] = 0;
                                $ret['msg'] = 'password error';
                                return json_encode($ret);
                            }
                            break;
                        case 2:
                            if ($password == $check_member_exist->passWord) {
                                $uid = $check_member_exist->uId;
                                $profile = $get_profile->findFirst(array("uId = '$uid'"));
                            } else {
                                $ret['code'] = 0;
                                $ret['msg'] = 'password error';
                                return json_encode($ret);
                            }
                            break;
                    }
                    if ($profile) {
                        $nickname = $profile->nickName;
                        $portrait = $profile->portrait;
                        $level = $profile->rlevel;
                        $ruId = !empty($profile->ruId) ? $profile->ruId : '';

                        $this->session->set('uid', $uid);
                        $this->session->set('nickname', $nickname);
                        $this->session->set('portrait', $portrait);
                        $this->session->set('level', $level);
                        $this->session->set('ruId', $ruId);

                        $ret['code'] = 1;
                        $ret['nickname'] = $nickname;
                        $ret['portrait'] = $portrait;
                        $ret['level'] = $level;
                        $ret['ruId'] = $ruId;
                        return json_encode($ret);
                    } else {
                        $ret['code'] = 0;
                        $ret['msg'] = '参数错误';
                        return json_encode($ret);
                    }
                }
                $ret['code'] = 0;
                $ret['msg'] = '用户不存在';
                return json_encode($ret);
            }
            $ret['code'] = 0;
            $ret['msg'] = '参数错误';
            return json_encode($ret);
        } else {
            $ret['code'] = 0;
            $ret['msg'] = '网络不行，只能匿名使用';
            return json_encode($ret);
        }
    }

    /*
     * 登出
     */

    public function logoutAction() {
        $this->session->remove('uid');
        $this->session->remove('nickname');
        $this->session->remove('portrait');
        $this->session->remove('level');
        $this->session->remove('ruId');
        $ret['code'] = 1;
        $ret['msg'] = '退出登录成功';
        return json_encode($ret);
    }

}


<?php

/*
 * 测试类
 */
class TestController extends ControllerBase
{

    public function indexAction()
    {
        if ($this->checkNetWork()) {
            $member_db = new Member();
            $member_list = $member_db->find();
            foreach($member_list as $ml) {
                return $ml->userName;
            }
        }

    }


}


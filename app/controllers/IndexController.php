<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->common();
        $module_list = array();
        $init_model = new Module();
        $get_module_list = $init_model->find();
        foreach($get_module_list as $key => $value) {
            $module_list[$key]->id = $value->id;
            $module_list[$key]->name = $value->name;
            $module_list[$key]->description = $value->description;
        }
        $this->view->module_list = $module_list;
        $this->view->page = 'index';
    }

}


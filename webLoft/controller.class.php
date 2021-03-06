<?php
/**
 * @package: 控制器基类
 * @org: WEBLOFT
 * @author: huangcp
 * @email: hcp0224@163.com
 * @created: 2015-11-04
 * @logs:
 */

class Controller implements ControllerUtil{
    protected $_HOST;
    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_template;
    protected $_cache;

    /**
     * 构造方法
     * @param $model
     * @param $controller
     * @param $action
     * @author: huangcp
     * @logs:
     */
    public function __construct($model, $controller,$action) {

        if(__URL__ == '/'){
            header('location:'._DEFAULT_PATH_);
        }
        $this->_controller = $controller;
        $this->_action     = $action;
        $this->_model      = $model;
        $this->_template   = new View($controller,$action);
        $this->init();

    }

    public function init(){}

    /**
     * 全局登录校验
     * @param null $type
     * @author: huangcp
     * @logs:
     */
    public function loginCheck($type = null) {

    }

    /**
     * 渲染页面及设定渲染值
     * @param $name
     * @param $value
     * @author: huangcp
     * @logs:
     */
    public function sign($name,$value) {
        $this->_template->setSign($name,$value);
    }

    /**
     * 页面渲染方法
     * @param null $url
     * @author: huangcp
     * @logs:
     */
    public function render($url = null) {
        if(empty($url)){
            $this->_template->render();
        }else{
            //指定跳转
            header('location:'.$url);
        }

    }

    /**
     * 获取GET参数
     * @param $type
     * @return array
     * @author: huangcp
     * @logs:
     */
    public function GET($type){
        $geter = array();
        $urlArr = explode('/',__URL__);
        unset($urlArr[0],$urlArr[1],$urlArr[2],$urlArr[3]);
        if(count($urlArr) > 0 ){
            if($urlArr[4] === ''){
                return null;
            }
            foreach($urlArr as $key=>$item){
                if($type == $item){
                    $geter[$item] = @$urlArr[$key+1];
                }
            }
            return $geter[$type];
        }
        return null;

    }

    /**
     * 获取POST参数
     * @param $type
     * @return mixed
     * @author: huangcp
     * @logs:
     */
    public function POST($type = null){
        if($type == ''){
            return $_POST;
        }else{
            return $_POST[$type];
        }
    }

}
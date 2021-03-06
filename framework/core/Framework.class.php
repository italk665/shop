<?php
  /**
  * italk 2017-12-7
  *
  *
  */
  class FrameWork
  {
  	
  	public static function run()
  	{
      self::initialization();
      
      self::autoload();self::dispatch();
    }

    private static function initialization()
    {
      //定义路径常量
    define("DS", DIRECTORY_SEPARATOR);
    define("ROOT", getcwd() . DS ); //根目录
    define("APP_PATH", ROOT . 'application' . DS);
    define("FRAMEWORK_PATH", ROOT . "framework" .DS);
    define("PUBLIC_PATH", ROOT . "public" .DS);
    define("CONFIG_PATH", APP_PATH . "config" .DS);
    define("CONTROLLER_PATH", APP_PATH . "controllers" .DS);
    define("MODEL_PATH", APP_PATH . "models" .DS);
    define("VIEW_PATH", APP_PATH . "views" .DS);
    define("CORE_PATH", FRAMEWORK_PATH . "core" .DS);
    define("DB_PATH", FRAMEWORK_PATH . "databases" .DS);
    define("LIB_PATH", FRAMEWORK_PATH . "libraries" .DS);
    define("HELPER_PATH", FRAMEWORK_PATH . "helpers" .DS);
    define("UPLOAD_PATH", PUBLIC_PATH . "uploads" .DS);
    //获取参数p、c、a,index.php?p=admin&c=goods&a=add GoodsController中的addAction
    define('PLATFORM',isset($_GET['p']) ?  $_GET['p'] : "admin");
    define('CONTROLLER',isset($_GET['c']) ?  ucfirst($_GET['c']) : "Index");
    define('ACTION',isset($_GET['a']) ?  $_GET['a'] : "index");
    //设置当前控制器和视图目录 CUR-- current
    define("CUR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
    define("CUR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);
    }


    //路由方法,说白了，就是实例化对象并调用方法
  //index.php?p=admin&c=goods&a=add GoodsController中的addAction
  private static function dispatch(){
    $controller_name = CONTROLLER."Controller";
    $controller = new $controller_name();
    $action_name =  ACTION."Action";
    // $action = new $action_name();
    $controller->$action_name();
  }


  //注册为自动加载
  private static function autoload(){
    // $arr = array(__CLASS__,'load');
    spl_autoload_register('self::load');
  }

  //自动加载功能,此处我们只实现控制器和数据库模型的自动加载
  //如GoodsController、 GoodsModel
  private static function load($classname){
    if (substr($classname, -10) == 'Controller') {
      //载入控制器
      include CUR_CONTROLLER_PATH . "{$classname}.class.php";
    } elseif (substr($classname, -5) == 'Model') {
      //载入数据库模型 
      include MODEL_PATH . "{$classname}.class.php";
    } else {
      //暂略
    }
  }
  }
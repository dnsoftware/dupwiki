<?php

class HelpController extends Controller
{
    public $cssFile = '/modules/adminka/css/accordmenu.css';
    public $jsFile = '/modules/adminka/js/accordion.js';
    //public $jsFile2 = '/modules/adminka/js/treecontroller.js';

    private $_model;

    protected function beforeRender($view) {
        // Подключаем стиль, если выводится HTML и если этот ваш стиль вообще задан.
        Yii::app()->getClientScript()->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath.$this->cssFile));

        $accord_js = '
        $(".topnav").accordion({
            accordion:false,
            speed: 10,
            closedSign: \'[+]\',
            openedSign: \'[-]\'
        });';
        Yii::app()->getClientScript()->registerScript('accord_js', $accord_js, CClientScript::POS_READY);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath.$this->jsFile),  CClientScript::POS_END);
        //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath.$this->jsFile2),  CClientScript::POS_END);


        return parent::beforeRender($view);
    }


    public function actionIndex()
    {
        $id = 0;
        if(isset($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];
            $model = $this->loadModel($id);
        }
        else
        {
            $model = new Helpwiki();
        }

        $model->maxlevel = 2;
        $model->menu_hierarh();
        $model->getSubribriks();
        $tree_path = $model->getLevelparent($id, $model->maxlevel);

        $this->render('index', array('model'=>$model, 'id'=>$id));
    }

    public function loadModel($id)
    {
        if($this->_model===null)
        {
            $this->_model=Helpwiki::model()->findByPk($id);

            if($this->_model===null)
                throw new CHttpException(404,'Нет такой записи.');
        }
        return $this->_model;
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */




}
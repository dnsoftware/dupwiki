<?php

class TreeController extends Controller
{
    public $cssFile = '/modules/adminka/css/accordmenu.css';
    public $jsFile = '/modules/adminka/js/accordion.js';
    public $jsFile2 = '/modules/adminka/js/treecontroller.js';

    private $_model;

    protected function beforeRender($view) {
        // Подключаем стиль, если выводится HTML и если этот ваш стиль вообще задан.
        Yii::app()->getClientScript()->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath.$this->cssFile));

        $accord_js = '
        $(".topnav").accordion({
            accordion:false,
            speed: 500,
            closedSign: \'[+]\',
            openedSign: \'[-]\'
        });';
        Yii::app()->getClientScript()->registerScript('accord_js', $accord_js, CClientScript::POS_READY);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath.$this->jsFile),  CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath.$this->jsFile2),  CClientScript::POS_END);


        return parent::beforeRender($view);
    }



	public function actionIndex()
	{
        $this->render('index');
	}


    public function actionEdititem()
    {
        if(isset($_REQUEST['id']))
        {
            $model = $this->loadModel($_REQUEST['id']);

            $this->renderPartial('edititem', array('model'=>$model, 'selector'=>'edititem'), false, true);
        }

        if(isset($_POST['Dupwiki']))
        {
            $model = $this->loadModel($_POST['Dupwiki']['id']);

            if(isset($_POST['ajax']) && $_POST['ajax']==='frm_edititem')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            $model->attributes=$_POST['Dupwiki'];
            if($model->save())
            {
                $this->renderPartial('viewitem', array('model'=>$model), false, true);
                Yii::app()->end();
            }

        }

    }

    public function actionAdditem()
    {

        if(isset($_REQUEST['id']))
        {
            if ($_REQUEST['id'] > 0)
            {
                $parent_item = $this->loadModel($_REQUEST['id']);
            }
            else
            {
                $parent_item = new Dupwiki();
                $parent_item->id = 0;
                $parent_item->level = 1;
                $parent_item->sortnumber = 10;
            }

            $model = new Dupwiki();
            $model->maxlevel = 30;
            $model->parent_item = $parent_item;

            $this->renderPartial('additem', array('model'=>$model, 'selector'=>'additem'), false, true);
            Yii::app()->end();


        }

        if(isset($_POST['Dupwiki']))
        {
            $model=new Dupwiki;

            $model->attributes=$_POST['Dupwiki'];
            if ($_POST['Dupwiki']['parent_id'] > 0)
            {
                $parent_item = $this->loadModel(intval($_POST['Dupwiki']['parent_id']));
                $model->level = $parent_item->level + 1;
                $model->sortnumber = $parent_item->sortnumber + 10;
            }
            else
            {
                $model->level = 1;
                $model->sortnumber = 10;
            }

            if(isset($_POST['ajax']) && $_POST['ajax']==='frm_edititem')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if($model->save())
            {
                $this->renderPartial('viewitem', array('model'=>$model), false, true);
                Yii::app()->end();
            }

        }

    }

    public function actionViewitem()
    {
        if(isset($_REQUEST['id']))
        {
            $model = $this->loadModel($_REQUEST['id']);
            $model->maxlevel = 30;

            $this->renderPartial('viewitem', array('model'=>$model), false, true);
            Yii::app()->end();

        }
    }

    public function actionRendertree()
    {
        $id = 0;
        if(isset($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];
        }
        $model = new Dupwiki();
        $model->maxlevel = 30;

        $model->menu_hierarh();
        $this->renderPartial('rendertree', array('model'=>$model, 'id'=>$id), false, true);
        //Yii::app()->end();


    }

    public function loadModel($id)
    {
        if($this->_model===null)
        {
             $this->_model=Dupwiki::model()->findByPk($id);

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
<?php

class TreeController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
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

    public function actionCheckdogovor()
    {
        //$model = new DognumberForm(Yii::app()->params['dupru_login'], Yii::app()->params['dupru_password']);
        $model = new DognumberForm;

        if(isset($_POST['ajax']) && $_POST['ajax']==='frm_dognumber')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['DognumberForm']))
        {
            // получаем данные от пользователя
            $model->attributes=$_POST['DognumberForm'];
            // проверяем полученные данные и, если результат проверки положительный,
            // перенаправляем пользователя на предыдущую страницу
            if($model->validate() && $model->checkdogovor(Yii::app()->params['dupru_login'], Yii::app()->params['dupru_password']))
            {
                echo "qwqwqwqwqwq";
                //$this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // рендерим представление
        //$this->render('login',array('model'=>$model));
    }



}
<?php
/**
 * Created by PhpStorm.
 * User: daemon
 * Date: 14.10.14
 * Time: 1:00
 */

$model->render_tree(0, 1, $id);
$accord_js = '
        $(".topnav").accordion({
            accordion:false,
            speed: 500,
            closedSign: \'[+]\',
            openedSign: \'[-]\'
        });';
Yii::app()->getClientScript()->registerScript('accord_js', $accord_js, CClientScript::POS_READY);

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath.'/modules/adminka/js/accordion.js'),  CClientScript::POS_END);

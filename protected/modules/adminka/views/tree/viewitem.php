
<h1>Просмотр</h1>

<div style="font-weight: bold;"><?= $model->problem;?></div>

<div><?= $model->content;?></div>

<?
Yii::app()->clientScript->registerScript('rendertree', 'js_render_tree("'.Yii::app()->createUrl('adminka/tree/rendertree', array('id'=>$model->id)).'", "div_helptree")');
?>

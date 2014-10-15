<?php
/* @var $this TreeController */

$this->breadcrumbs=array(
	'Tree',
);
?>

<script src="<?php echo Yii::app()->baseUrl.'/ckeditor/ckeditor.js'; ?>"></script>




<table style="" border="1">
<tr>
    <td style="vertical-align: top;">

    <div style="font-weight: bold; margin-bottom: 10px; cursor:pointer;" onclick="get_tree_item('<?= Yii::app()->createUrl('adminka/tree/additem', array('id'=>0));?>', 'div_itemedit')">add</div>

    <div id="div_helptree"></div>
    <?
    //$model->render_tree(0, 1, 5);

    Yii::app()->clientScript->registerScript('rendertree', 'js_render_tree("'.Yii::app()->createUrl('adminka/tree/rendertree', array('id'=>$_REQUEST['id'])).'", "div_helptree")');
    ?>
    </td>
    <td style="width: 100%; vertical-align: top;">
        <div id="div_itemedit" style="border: #dddddd solid 1px;">

        </div>
    </td>
</tr>
</table>



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
    <?
    $model->render_tree(0, 1);
    ?>
    </td>
    <td style="width: 100%; vertical-align: top;">
        <div id="div_itemedit" style="border: #dddddd solid 1px;">

        </div>
    </td>
</tr>
</table>

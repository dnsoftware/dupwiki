<?php
/**
 * Created by PhpStorm.
 * User: daemon
 * Date: 16.10.14
 * Time: 19:12
 */
?>

<table style="" border="1">
<tr>
    <td style="vertical-align: top;">

    <div id="div_helptree">
    <?
    $model->render_tree(0, 1);
    ?>
    </div>

</td>
<td style="width: 100%; vertical-align: top;">
    <div id="div_itemedit" style="border: #dddddd solid 0px;">

        <div>
            <?

            ?>
        </div>

        <div style="font-size: 14px; font-weight: bold;"><?= $model->problem;?></div>

        <div>
            <?
            if (count($model->subrubriks) > 0)
            {
            ?>
            <div style="margin: 10px 0 10px 0; background-color: #dddddd; padding: 5px;">
                <?
                foreach($model->subrubriks as $skey => $sval)
                {
                ?><div><a href="<?= Yii::app()->createUrl('help/index', array('id'=>$sval->id));?>"><?= $sval['problem'];?></a></div><?
                }
                ?>
            </div>
            <?
            }
            ?>

            <div style="margin-top: 20px;">
                <?= $model->content;?>

            </div>
        </div>

    </div>
</td>
</tr>
</table>


<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<style>
    .round6
    {
        border-radius:6px;
        -webkit-border-radius:6px;
        -moz-border-radius:6px;
        -khtml-border-radius:6px;
    }

    .clientblock
    {
        width: 200px;
        height: 200px;
    }
</style>

<div style="height: 400px; width: 100%; border: #000 solid 0px;">

<div style="width:500px; height: 100px; margin:60px auto 10px; border: #000 solid 0px;"">

    <div class="round6 clientblock" style="display: table; float: left; background-color: #ff9966;">
        <a style="display: table-cell; vertical-align: middle; text-align: center; font-size: 16px" href="<?= $this->createUrl('site/dognumber');?>">Вы - наш клиент!</a>
    </div>

    <div class="round6 clientblock" style="display: table; float: right; background-color: #ccff99">
        <a style="display: table-cell; vertical-align: middle; text-align: center; font-size: 16px" href="<?= $this->createUrl('help/index');?>">Вы - пока еще не наш клиент!</a>
    </div>
</div>

</div>
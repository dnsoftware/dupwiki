<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
        'action' => $this->createUrl('adminka/tree/checkdogovor'),
        'id'=>'frm_dognumber',
        'enableAjaxValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        )

        )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->label($model,'dogovor_number'); ?>
        <?php echo $form->textField($model,'dogovor_number') ?>
        <?php echo $form->error($model,'dogovor_number'); ?>
    </div>


    <div class="row submit">
        <?php echo CHtml::submitButton('Войти'); ?>
    </div>

<?php $this->endWidget(); ?>

</div>
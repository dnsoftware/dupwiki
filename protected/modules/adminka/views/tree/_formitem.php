<div class="form">


    <?php $form=$this->beginWidget('CActiveForm'); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo $form->hiddenField($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'problem'); ?>
        <?php echo $form->textField($model,'problem'); ?>
        <?php echo $form->error($model,'problem'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textArea($model, 'content', array('id'=>'content_id')); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <script type="text/javascript">
        CKEDITOR.replace('content_id');
    </script>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/**
 * Created by PhpStorm.
 * User: daemon
 * Date: 10.10.14
 * Time: 19:36
 */

if (Yii::app()->session['type_client'] == DognumberForm::DOGOVOR_NENASH_CLIENT)
{
?>
    <div>

        Вы не являетесь нашим клиентом!<br>

        <a href="<?= $this->createUrl('help/index');?>">Справка для новых клиентов</a>

    </div>
<?
}

if (Yii::app()->session['type_client'] == DognumberForm::DOGOVOR_RESELLER_CLIENT)
{
    ?>
    <div>

        <p>По всем вопросам обращайтесь к своему непосредственно вышестоящему реселлеру у которого регистрировали свой договор и кому платите деньги.
        Мейл реселлера <?= implode(', ', $model->resseler_mails);?>.
        </p>

        <p>
        Если реселлер долгое время не будет отвечать, вы можете перевести свой договор под наше прямое управление и получать техподдержку у нас. Подробная инструкция как перенести под наше прямое управление свой договор в Наунете находится здесь:
        </p>
        <a href="http://dup.ru/support/index.php?_m=troubleshooter&_a=steps&troubleshootercatid=3&parentid=0">http://dup.ru/support/index.php?_m=troubleshooter&_a=steps&troubleshootercatid=3&parentid=0</a>
        <p>
        раздел "Перенос доменов и аккаунтов под наше управление - Регистратор домена NAUNET-REG-RIPN (naunet.ru)"
        </p>
        <p>
        <a href="<?= $this->createUrl('help/index');?>">Справка для клиентов</a>
        </p>

    </div>
<?
}

?>


<?
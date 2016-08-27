<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

?>

<div class="stitle-form">

    <?php

        $form = ActiveForm::begin(['layout' => 'default']);

        echo $form->field($model,'title')->textInput(['maxlength' => 255]);
        echo $form->field($model,'num')->textInput();
        echo $form->field($model,'is_auth')->dropDownList(['1'=>'审核','0'=>'不审核']);
        echo $form->field($model,'is_status')->dropDownList(['1'=>'启用','0'=>'禁用']);

        echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

        ActiveForm::end();
    ?>

</div>

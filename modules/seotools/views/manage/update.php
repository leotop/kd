<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model jpunanua\seotools\models\base\MetaBase */

$this->title = Yii::t('seotools', 'Update Meta Base: ', [
    'modelClass' => 'Meta Base',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('seotools', 'Meta Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => !empty($model->title)?$model->title:$model->id_meta, 'url' => ['view', 'id' => $model->id_meta]];
$this->params['breadcrumbs'][] = Yii::t('seotools', 'Update');
?>
<div class="meta-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

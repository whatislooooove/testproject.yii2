<h1>Apples!</h1>
<?php
/**
 * @var $apples
 */

$arApples = [];
//$apple = new Yii::$app->apple();
//$apple2 = new Yii::$app->apple();
//
//echo $apple->spawnDate . '<br>';
//echo $apple2->fallToGround();
//echo $apple2->eat(30);
//echo $apple2->eat(69);
//use yii\bootstrap4\Button;
//echo $apples;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$paramsCreate = ['class'=>'btn btn-info', 'name' => 'submit', 'value' => 'create_apples'];
$paramsRemove = ['class'=>'btn btn-warning ml-5', 'name' => 'submit', 'value' => 'remove_apples'];

if (count($apples) > 0) {
    $paramsCreate['disabled'] = 'disabled';
}
else {
    $paramsRemove['disabled'] = 'disabled';
}
?>



<?= Html::beginForm(['site/apples'], 'post', ['enctype' => 'multipart/form-data']) ?>
<?php //заменить кнопки ссылками?>
<?= Html::submitButton('Grow apples!',$paramsCreate) ?>
<?= Html::submitButton('Cut down apple trees and remove all apples...', $paramsRemove) ?>
<?= Html::endForm() ?>

<div class="row my-4">

<?php
if (count($apples) > 0):
    foreach ($apples as $key => $apple):
    ?>
    <div class="col-sm-4 my-2">
        <div class="card" data-index="<?=$apple->appleNumber?>">
            <div class="card-body">
                <h5 class="card-title">Apple #<?=$apple->appleNumber?></h5>
                <div class="card-data">Color: <?=$apple->color?><br>Spawn date: <?=$apple->spawnDate?></div>
                <div class="fall-date"><?=$apple->fallDate ? 'Fall date: ' . $apple->fallDate : ''?></div>
                <div class="timer row mx-0"><?=$apple->fallDate ? "<div class=\"ml-1\" id=\"$apple->appleNumber\"></div>" : ''?></div>
                <div class="freshness"><?=$apple->isFresh ? "Fresh apple" : "Rotten apple"?></div>
                <div class="apple-state"><?=$apple->onTheTree ? "Apple on the tree" : "Apple on the ground"?></div>
                <div class="apple-eaten row mx-0">Eaten: <div class="eaten-percent ml-1"><?=$apple->eaten?></div>%</div>
                <div class="apple-eaten row mx-0">Size: <div class="size-percent ml-1"><?=$apple->size?></div>%</div>
                <div class="mt-3">
                    <a href="javascript:dropApple(<?=$apple->appleNumber?>)" class="btn btn-primary drop-btn
                    <?=$apple->onTheTree ? '' : 'disabled'?>">Drop to the ground!</a>
                    <div class="input-group my-3">
                        <input type="number" onchange="handleChange(this);" class="form-control col-sm-5" placeholder="Percent" aria-label="Percent" aria-describedby="basic-addon2" min="0" max="100">
                        <div class="input-group-append">
                            <a href="javascript:eatApple(<?=$apple->appleNumber?>)" class="btn btn-primary eat-btn <?=$apple->onTheTree ? 'disabled' : ''?>">Eat!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    endforeach;
else:
    $options = [
            'class' => 'my-5 col-md-5 mx-auto'
    ];
    echo HTML::tag('div', 'You don\'t have apples=( Grow apples right now!', $options);
endif;
?>
</div>
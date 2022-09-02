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
use yii\helpers\Html; ?>


<?= Html::beginForm(['site/apples'], 'post', ['enctype' => 'multipart/form-data']) ?>
<?= Html::submitButton('Grow apples!',['class'=>'btn btn-info', 'name' => 'submit', 'value' => 'create_apples']) ?>
<?= Html::submitButton('Cut down apple trees and remove all apples...',['class'=>'btn btn-warning ml-5', 'name' => 'submit', 'value' => 'remove_apples']) ?>
<?= Html::endForm() ?>

<div class="row">

<?php
foreach ($apples as $key => $apple):
?>
    <div class="col-sm-6 my-2">
        <div class="card" data-index="<?=$apple->appleNumber?>">
            <div class="card-body">
                <h5 class="card-title">Apple #<?=$key?></h5>
                <div class="card-data">Color: <?=$apple->color?><br>Spawn date: <?=$apple->spawnDate?></div>
                <div class="freshness"><?=$apple->isFresh ? "Fresh apple" : "Rotten apple"?></div>
                <div class="apple-state"><?=$apple->onTheTree ? "Apple on the tree" : "Apple on the ground"?></div>
                <div class="apple-eaten row mx-0">Eaten: <div class="eaten-percent ml-1"><?=$apple->eaten?></div>%</div>
                <div class="apple-eaten row mx-0">Size: <div class="size-percent ml-1"><?=$apple->size?></div>%</div>
                <div class="mt-3">
                    <a href="javascript:dropApple(<?=$apple->appleNumber?>)" class="btn btn-primary drop-btn">Drop to the ground!</a>
                    <div class="input-group my-3">
                        <input type="number" class="form-control col-sm-5" placeholder="Percent" aria-label="Percent" aria-describedby="basic-addon2" min="0" max="100">
                        <div class="input-group-append">
                            <a href="javascript:eatApple(<?=$apple->appleNumber?>)" class="btn btn-primary eat-btn disabled">Eat!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
endforeach;
?>

</div>

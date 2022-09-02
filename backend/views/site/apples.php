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
<?= Html::endForm() ?>

<div class="row">

<?php
foreach ($apples as $key => $apple):
?>
    <div class="col-sm-6 my-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Apple #<?=$key?></h5>
                <p class="card-text">Color: <?=$apple->color?><br>Spawn date: <?=$apple->spawnDate?><br>
                    <?=$apple->isFresh ? "Fresh apple" : "Rotten apple"?><br>
                    <?=$apple->onTheTree ? "Apple on the tree" : "Apple on the ground"?><br>
                    Eaten: <?=$apple->eaten?>%<br>
                    Size: <?=$apple->size?>%<br></p>
                <div>
                    <a href="#" class="btn btn-primary">Drop to the ground!</a>
                    <div class="input-group my-3">
                        <input type="text" class="form-control col-sm-5" placeholder="Percent" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <a href="#" class="btn btn-primary">Eat!</a>
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

<h1>Apples!</h1>
<?php
$apple = new Yii::$app->apple();
$apple2 = new Yii::$app->apple();

echo $apple->spawnDate . '<br>';
echo $apple2->spawnDate;
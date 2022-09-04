<?php

namespace app\components;


use app\models\Apples;
use yii\base\ErrorException;

class Apple
{
    private $colors = ['green', 'red', 'yellow', 'yellow-red', 'green-red', 'golden'];
    private $msg = "";

    public $color, $spawnDate, $fallDate, $isFresh, $onTheTree, $eaten, $size, $appleNumber;

    public function __construct($appleNumber,
        $color = null,
        $spawnDate = null,
        $fallDate = null,
        $isFresh = null,
        $onTheTree = null,
        $eaten = null,
        $size = null
    )
    {
        $this->color = $color ?: $this->colors[rand(0, count($this->colors) - 1)];
        $this->spawnDate = $spawnDate ? date('d-m-Y, H:i:s', $spawnDate) : date('d-m-Y, H:i:s', rand(0, time()));
        $this->fallDate = $fallDate ? date('d-m-Y, H:i:s', $fallDate) : null;
        $this->isFresh = $isFresh ?: true;
        $this->onTheTree = !is_null($onTheTree) ? (bool)$onTheTree : true;
        $this->eaten = $eaten ?: 0;
        $this->size = $size ?: 100;
        $this->appleNumber = $appleNumber;
    }

    public function fallToGround() {
        if ($this->onTheTree) {
            $this->onTheTree = false;
            $this->msg = "Apple fell to the ground!<br>";

            $thisApple = Apples::find()->where(['apple_number' => $this->appleNumber])->one();
            $thisApple->on_the_tree = 0;
            $thisApple->falled_at = time();
            $thisApple->save();
        }
        else {
            $this->msg = "The apple is already on the ground!<br>";
        }

        return $this->msg;
    }

    public function eat($percent) {
        if ($this->onTheTree) {
            $this->msg = "An apple on a tree! You can't eat it<br>";
        }
        else if (!$this->isFresh) {
            $this->msg = "This apple is rotten, you can't eat it<br>";
        }
        else if ($percent > 100 || $percent < 1) {
            $this->msg = "You can't eat more than 100% and less than 1%<br>";
        }
        else {
            $this->eaten += $percent;
            $thisApple = Apples::find()->where(['apple_number' => $this->appleNumber])->one();
            if ($this->eaten >= 100) {
                $this->msg = "You completely ate this apple<br>";
                $this->size = 0;
                $thisApple->delete();
            }
            else {
                $this->size =- $this->eaten;

                $thisApple->eaten = $this->eaten;
                $thisApple->save();
                $this->msg = "You took a bite of $percent% of that apple. $this->eaten% eaten<br>";
            }
        }

        return $this->msg;
    }
}
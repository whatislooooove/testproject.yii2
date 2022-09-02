<?php

namespace app\components;


use yii\base\ErrorException;

class Apple
{
    private $colors = ['green', 'red', 'yellow', 'yellow-red', 'green-red', 'golden'];
    private $msg = "";

    private function delete() {
        return "Вы полностью съели яблоко";
    }

    public $color, $spawnDate, $fallDate, $isFresh, $onTheTree, $eaten, $size;

    public function __construct($config = [])
    {
        $this->color = $this->colors[rand(0, count($this->colors) - 1)];
        $this->spawnDate = date('F j, Y, H:i:s', rand(0, time()));
        $this->fallDate = null;
        $this->isFresh = true;
        $this->onTheTree = true;
        $this->eaten = 0;
        $this->size = 100;
    }

    public function fallToGround() {
        if ($this->onTheTree) {
            $this->onTheTree = false;
            $this->msg = "Apple fell to the ground!<br>";
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
            if ($this->eaten >= 100) {
                $this->msg = "You completely ate this apple<br>";
                $this->size = 0;
                //$this->delete(); //допилить удаление
            }
            else {
                $this->size =- $this->eaten;
                $this->msg = "You took a bite of $percent% of that apple. $this->eaten% eaten<br>";
            }
        }

        return $this->msg;
    }
}
<?php

namespace app\components;

use yii\base\Component;

class Apple
{
    private $colors = ['green', 'red', 'yellow', 'yellow-red', 'green-red', 'golden'];

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
        return "Яблоко упало на землю!";
    }

    public function eat($percent) {
        return "Вы съели $percent% яблока!";
    }
}
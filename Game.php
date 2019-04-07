<?php
class Game extends Application
{
    protected $pyramide;

    public function __construct(Array $param)
    {
        parent::__construct($param);
    }
    public function allumettes($line)
    {
        $tab = [];
        for ($l = 0, $i = 1; $l < $line; $l++, $i += 2)
        {
            $t = [];
            for ($c = 0; $c < $i; $c++)
                $t[] = "|";
            $tab[] = $t;
        }
        return $tab;
    }

    public function makePyr(Array $tab)
    {
        $this->draw(sizeof($tab), $tab);
    }
}
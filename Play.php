<?php
class Play extends Game
{
    protected $player;
    protected $ia;
    private $_turn;

    public function __construct(array $argv)
    {
        $this->player = new Player;
        $this->_turn = 1;
        parent::__construct($argv);
    }
    
    public function run()
    {
        do
        {
            $this->makePyr($this->pyramide);
            if ($this->_turn % 2 != 0)
            {
                $this->player->setElement($this->lines, $this->maxMatch);
                $a = $this->player->getArgs();
                $count = array_count_values($this->pyramide[$a["line"]]);
                if (!key_exists("|", $count) || (key_exists("|", $count) && $count["|"] < $a["match"]))
                    continue;
            }
            else
            {
                $a = $this->ia->simulation($this->pyramide);
            }
            if (isset($this->pyramide[$a["line"]]))
                $this->pyramide = $this->unsetAllum($this->pyramide, $a["line"], $a["match"]);
            $this->_turn++;
        } while (!$this->ia->checkWin($this->pyramide));
    }
}
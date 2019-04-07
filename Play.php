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
            system("clear");
            $this->makePyr($this->pyramide);
            $count = array_count_values($tab[$line]);
            if ($this->_turn % 2 != 0)
            {
                $this->player->setElement($this->lines, $this->maxMatch);
                $a = $this->player->getArgs();
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
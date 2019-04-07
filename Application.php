<?php
abstract class Application
{
    use Task;
    
    protected $lines;
    protected $maxMatch;

    protected function __construct(Array $arg)
    {
        if ($params = $this->getArg($arg))
        {
            $this->lines = $params[0];
            $this->maxMatch = $params[1];
            if ($this->lines)
                $this->pyramide = $this->allumettes($this->lines);
            $this->ia = new IA($this->maxMatch);
            $this->run();
        }
        else
            echo "Argument invalide, veuillez entrez deux chiffres : php allum1 (int) lines (int) maxMatch.\n";
    }

    public function getArg(Array $param)
    {
        if (sizeof($param) == 3 && (int) $param[1] && (int) $param[2])
            return [(int) $param[1], (int) $param[2]];
        else
            return false;
    }
}
<?php
class IA
{
    protected $line;
    protected $match;
    protected $map;
    private $_maxMatch;

    use Task;

    public function __construct($maxMatch)
    {
        $this->_maxMatch = $maxMatch;
    }

    public function mapping($tab)
    {
        $map = [];
        foreach ($tab as $value)
            $map[] = array_count_values($value);
        return $map;
    }

    public function makeDecision(Array $tab)
    {
        
        $coord = $this->randominator($tab);
        $this->line = $coord[0];
        $this->match = $coord[1];
    }

    public function simulation(Array $tab)
    {
        $pyr = $tab;
        $proba = [];
        if (!$this->checkWin($pyr))
        {
            foreach ($pyr as $key => $value)
            {
                for ($i = 1; $i <= sizeof($value) && $i <= $this->_maxMatch; $i++)
                {
                    $map = $this->mapping($pyr);
                    if (key_exists("|", $map[$key]) && $map[$key]["|"] >= $i)
                    {
                        $test = $this->proba($this->unsetAllum($pyr, $key, $i));
                        $test["coord"] = ["line" => $key, "match" => $i];
                        $proba[] = $test;
                    }
                }
            }
        }
        return $this->sortByWin($proba)[0]["coord"];
    }

    public function sortByWin($proba)
    {
        $tab = $proba;
        for ($i = 0; $i < sizeof($tab); $i++)
        {
            if (isset($tab[$i + 1]) && $tab[$i]["win"] < $tab[$i + 1]["win"])
            {
                $tmp = $tab[$i];
                $tab[$i] = $tab[$i + 1];
                $tab[$i + 1] = $tmp;
                $i = -1;
            }
        }
        return $tab;
    }

    public function proba(Array $tab)
    {
        $loss = 0;
        $win = 0;
        for ($iter = 0; $iter < 3000; $iter++)
        {
            $test = $tab;
            $turn = 1;
            while (!$this->checkWin($test))
            {
                $coord = $this->randominator($test);
                $test = $this->unsetAllum($test, $coord[0], $coord[1]);
                $turn++;
            }
            if (($turn - 1) % 2 != 0)
                $loss++;
            else
                $win++;
        }
        return ["loss" => $win, "win" => $loss];
    }

    public function randominator($tab)
    {
        $this->map = $this->mapping($tab);
        do
        {
            $line = rand(0, (sizeof($tab) - 1));
            $match = rand(1, $this->_maxMatch);

        } while ((!key_exists("|", $this->map[$line]) && !$this->checkWin($tab))
                || (key_exists("|", $this->map[$line]) 
                && $this->map[$line]["|"] < $match 
                && !$this->checkWin($tab)));
        return [$line, $match];
    }

    public function checkWin(Array $tab)
    {
        foreach ($this->mapping($tab) as $value)
        {
            if (key_exists("|", $value))
                return false;
        }
        return true;
    }

    public function getArgs()
    {
        return ["line" => $this->line, "match" => $this->match];
    }
}
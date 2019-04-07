<?php
class Player
{
    protected $line;
    protected $match;

    public function getElement($message, $attr, $max)
    {
        do
        {
            echo $message;
            $line = fgets(STDIN);
            $test = (int) trim($line);
            if ($test > 0 && $test <= $max)
            {
                $this->$attr = $test;
                break;
            }
            else
            {
                echo "Invalid argument !\n";
                continue;
            }
        } while ($line);
    }

    public function setElement($lineMax, $matchMax)
    {
        $this->getElement("Which line : ", "line", $lineMax);
        $this->getElement("How many match : ", "match", $matchMax);
    }

    public function getArgs()
    {
        return ["line" => ($this->line - 1), "match" => $this->match];
    }
}
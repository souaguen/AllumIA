<?php
trait Task
{
    public function stars($nbS)
    {
        for ($star = 0; $star < $nbS; $star++)
            echo "*";
        echo "\n";
    }

    public function stroke($sLen)
    {
        for ($s = $sLen; ($s - 1) > 0; $s--)
            echo " ";
    }

    public function draw(int $sLen, Array $tab)
    {
        $nbS = $sLen * 2 + 1;
        foreach ($tab as $key => $value)
        {
            if ($key == 0)
                $this->stars($nbS);
            echo "*";
            $this->stroke($sLen);
            foreach($value as $line)
                echo $line;
            $this->stroke($sLen);
            echo "*";
            echo "\n";
            $sLen--;
        }
        $this->stars($nbS);
    }

    public function unsetAllum(Array $tab, int $line, int $match)
    {
        $count = array_count_values($tab[$line]);
        if (key_exists("|", $count) && $count["|"] >= $match)
        {
            for($i = 0, $m = 0; $m < $match && $i < sizeof($tab[$line]); $i++)
            {
                if ($tab[$line][$i] == "|")
                {
                    $tab[$line][$i] = " ";
                    $m++;
                }
            }
        }
        return $tab;
    }
}

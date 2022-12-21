<?php

    public function setCreditLimit($creditLimit)
    {
        $this->creditLimit = $creditLimit;

        return $this;
    }

    public function getDarkMode()
    {
        return $this->darkmode;
    }

    public function setDarkMode($darkmode)
    {
        $this->darkmode = $darkmode;
        return $this;
    }
}

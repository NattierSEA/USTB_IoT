<?php
namespace app\platform\controller;

class System extends Main
{

    public function siteConfig()
    {
        return $this->fetch();
    }

}

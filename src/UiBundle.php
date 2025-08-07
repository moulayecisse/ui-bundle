<?php

namespace Cisse\Bundle\Ui;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UiBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

}

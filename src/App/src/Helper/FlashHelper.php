<?php

declare(strict_types=1);

namespace App\View\Helper;

use Laminas\Form\View\Helper\AbstractHelper;
use Mezzio\Flash\FlashMessages; #<- be sure to add these
use Mezzio\Session\Session; #<- add this line

class FlashHelper extends AbstractHelper
{
    public function __invoke()
    {
        $sessionStatus = session_status() === PHP_SESSION_ACTIVE ? $_SESSION : [];

        return FlashMessages::createFromSession(new Session($sessionStatus))->getFlashes();
    }
}

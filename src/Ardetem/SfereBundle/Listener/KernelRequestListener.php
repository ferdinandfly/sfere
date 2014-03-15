<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/15/14
 * Time: 6:31 PM
 */

namespace Ardetem\SfereBundle\Listener;

use Ardetem\SfereBundle\Lib\GlobalParameter;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class KernelRequestListener {
    public function onKernelRequest(GetResponseEvent $event)
    {
        GlobalParameter::setLocale($event->getRequest()->getLocale());
    }

} 
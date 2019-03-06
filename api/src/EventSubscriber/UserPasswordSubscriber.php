<?php
/**
 * Created by PhpStorm.
 * User: virgilmoreau
 * Date: 06/03/2019
 * Time: 12:40
 */

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;


class UserPasswordSubscriber
{

}
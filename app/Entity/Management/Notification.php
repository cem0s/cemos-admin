<?php

namespace App\Entity\Management;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Notification extends \LaravelDoctrine\ORM\Notifications\Notification
{
   
    protected $user;
}
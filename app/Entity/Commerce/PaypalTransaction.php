<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a paypal transaction.
 * Note that this class extends Transaction
 */

/**
 * @ORM\Entity @ORM\Table(name="paypal_transactions")
 **/
class PaypalTransaction extends Transaction
{
  
}
<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a credit card transaction.
 * Note that this class extends Transaction
 */

/**
 * @ORM\Entity @ORM\Table(name="credit_card_transactions")
 **/
class CreditCardTransaction extends Transaction
{
  
}
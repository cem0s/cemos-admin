<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a visa card transaction.
 * Note that this class extends Transaction
 */

/**
 * @ORM\Entity @ORM\Table(name="visa_card_transactions")
 **/
class VisaCardTransaction extends Transaction
{
  
}
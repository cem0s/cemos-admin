<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a credit points transaction.
 * Note that this class extends Transaction
 */

/**
 * @ORM\Entity @ORM\Table(name="credit_points_transactions")
 **/
class CreditPointsTransaction extends Transaction
{
  
}
<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a incoice transaction.
 * Note that this class extends Transaction
 */

/**
 * @ORM\Entity @ORM\Table(name="invoice_transactions")
 **/
class InvoiceTransaction extends Transaction
{
  
}
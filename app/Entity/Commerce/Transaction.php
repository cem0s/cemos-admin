<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * This class represents an Transaction item, either a Credit points, Invoice, Credit card, Visa card or Paypal.
 * It is abstract because we never have an Object entity, it's either a invoice, credit_points, credit_card, visa_card or paypal
 * @ORM\Entity(repositoryClass="\App\Repository\TransactionsRepository")
 * @ORM\Table(name="transactions")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap( {"invoice" = "InvoiceTransaction", "credit_points" = "CreditPointsTransaction", "credit_card"="CreditCardTransaction", "visa_card"="VisaCardTransaction", "paypal"="PaypalTransaction"} )
 *
 */
abstract class Transaction
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_product_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="OrderProduct")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $orderProductId;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $productId;

    /**
     * @var array
     *
     * @ORM\Column(name="data", type="array", nullable=false)
     */
    private $data;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;


    /***** Getters and setters *****/

    /** Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set order_id
     *
     * @param integer $orderProductId
     * @return OrderProduct
     */
    public function setOrderProductId($orderProductId)
    {
        $this->orderProductId = $orderProductId;

        return $this;
    }

     /**
     * Get order_product_id
     *
     * @return integer 
     */
    public function getOrderProductId()
    {
        return $this->orderProductId;
    }

    /**
     * Set product_id
     *
     * @param integer $productId
     * @return Product
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

     /**
     * Get product_id
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }

   	/**
     * Set data
     *
     * @param array $data
     * @return OrderProduct
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

     /**
     * Get data
     *
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }

        /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    /**
     * Set deleted_at
     *
     * @param integer $deletedAt
     * @return Object
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deleted_at
     *
     * @return datetime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }


}
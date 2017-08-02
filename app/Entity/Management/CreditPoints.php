<?php

namespace App\Entity\Management;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CreditPoints
 * @ORM\Entity(repositoryClass="\App\Repository\CreditPointsRepository")
 * @ORM\Table(name="credit_points")
 */
class CreditPoints
{
	/**
    * @var integer
    *
    * @ORM\Column(name="id", type="integer", nullable=false)
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    private $id;


    /**
     * @var decimal
     *
     * @ORM\Column(name="points", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $points;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $companyId;

    /**
    * @var \DateTime $created_at
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="created_at", type="datetime", nullable=false)
    */
    private $createdAt;

    /**
    * @var \DateTime $updated_at
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="updated_at", type="datetime", nullable=false)
    */
    private $updatedAt;
     
    /**
    * @var \DateTime $deleted_at
    *
    * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
    */
    private $deletedAt;


    /************ Getters and setters ***********/

    /**
    * Get id
    *
    * @return integer 
    */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get points
     *
     * @return decimal 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set points
     *
     * @param decimal $points
     * @return points
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer 
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set companyId
     *
     * @param integer $companyId
     * @return companyId
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
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
    * Get deleted_at
    *
    * @return datetime 
    */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
    * Set deleted_at
    *
    * @param integer $deletedAt
    * @return Region
    */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

}
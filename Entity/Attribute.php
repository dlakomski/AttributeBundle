<?php

namespace Padam87\AttributeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table("attribute")
 */
class Attribute
{
    const ARRAY_DELIMITER = '|';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Definition", inversedBy="attributes")
     * @ORM\JoinColumn(name="definition_id", referencedColumnName="id")
     * @var Definition
     */
    private $definition;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $isArray = false;

    public function __toString()
    {
        return $this->getDefinition()->getName();
    }

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
     * Set value
     *
     * @param string|array $value
     * @return Attribute
     */
    public function setValue($value)
    {
        if (is_array($value)) {
            $value = implode(self::ARRAY_DELIMITER, $value);

            $this->setArray(true);
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string|array
     */
    public function getValue()
    {
        if ($this->isArray()){
            return explode(self::ARRAY_DELIMITER, $this->value);
        }

        return $this->value;
    }

    /**
     * Set definition
     *
     * @param \Padam87\AttributeBundle\Entity\Definition $definition
     * @return Attribute
     */
    public function setDefinition(\Padam87\AttributeBundle\Entity\Definition $definition = null)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * Get definition
     *
     * @return \Padam87\AttributeBundle\Entity\Definition
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param bool $isArray
     *
     * @return $this
     */
    public function setArray($isArray)
    {
        $this->isArray = $isArray;

        return $this;
    }

    /**
     * Check if value is of array type
     *
     * @return bool
     */
    public function isArray()
    {
        return $this->isArray;
    }
}

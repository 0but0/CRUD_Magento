<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\AHTtest\Model\Data;

use AHT\AHTtest\Api\Data\TableInterface;

class Table extends \Magento\Framework\Api\AbstractExtensibleObject implements TableInterface
{

    /**
     * Get table_id
     * @return string|null
     */
    public function getTableId()
    {
        return $this->_get(self::TABLE_ID);
    }

    /**
     * Set table_id
     * @param string $tableId
     * @return \AHT\AHTtest\Api\Data\TableInterface
     */
    public function setTableId($tableId)
    {
        return $this->setData(self::TABLE_ID, $tableId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \AHT\AHTtest\Api\Data\TableInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \AHT\AHTtest\Api\Data\TableExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \AHT\AHTtest\Api\Data\TableExtensionInterface $extensionAttributes
     * @return $this
     */
    // public function setExtensionAttributes(
    //     \AHT\AHTtest\Api\Data\TableExtensionInterface $extensionAttributes
    // ) {
    //     return $this->_setExtensionAttributes($extensionAttributes);
    // }

    /**
     * Get age
     * @return string|null
     */
    public function getAge()
    {
        return $this->_get(self::AGE);
    }

    /**
     * Set age
     * @param string $age
     * @return \AHT\AHTtest\Api\Data\TableInterface
     */
    public function setAge($age)
    {
        return $this->setData(self::AGE, $age);
    }
}

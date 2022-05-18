<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\AHTtest\Api\Data;

interface TableSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get table list.
     * @return \AHT\AHTtest\Api\Data\TableInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \AHT\AHTtest\Api\Data\TableInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

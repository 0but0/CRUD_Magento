<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\AHTtest\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TableRepositoryInterface
{

    /**
     * Save table
     * @param \AHT\AHTtest\Api\Data\TableInterface $table
     * @return \AHT\AHTtest\Api\Data\TableInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \AHT\AHTtest\Api\Data\TableInterface $table
    );

    /**
     * Retrieve table
     * @param string $tableId
     * @return \AHT\AHTtest\Api\Data\TableInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($tableId);

    /**
     * Retrieve table matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AHT\AHTtest\Api\Data\TableSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete table
     * @param \AHT\AHTtest\Api\Data\TableInterface $table
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \AHT\AHTtest\Api\Data\TableInterface $table
    );

    /**
     * Delete table by ID
     * @param string $tableId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($tableId);
}

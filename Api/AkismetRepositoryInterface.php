<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wemessage\Akismet\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface AkismetRepositoryInterface
{

    /**
     * Save Akismet
     * @param \Wemessage\Akismet\Api\Data\AkismetInterface $akismet
     * @return \Wemessage\Akismet\Api\Data\AkismetInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Wemessage\Akismet\Api\Data\AkismetInterface $akismet
    );

    /**
     * Retrieve Akismet
     * @param string $akismetId
     * @return \Wemessage\Akismet\Api\Data\AkismetInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($akismetId);

    /**
     * Retrieve Akismet matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Wemessage\Akismet\Api\Data\AkismetSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Akismet
     * @param \Wemessage\Akismet\Api\Data\AkismetInterface $akismet
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Wemessage\Akismet\Api\Data\AkismetInterface $akismet
    );

    /**
     * Delete Akismet by ID
     * @param string $akismetId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($akismetId);
}


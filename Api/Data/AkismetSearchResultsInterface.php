<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wemessage\Akismet\Api\Data;

interface AkismetSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Akismet list.
     * @return \Wemessage\Akismet\Api\Data\AkismetInterface[]
     */
    public function getItems();

    /**
     * Set id list.
     * @param \Wemessage\Akismet\Api\Data\AkismetInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}


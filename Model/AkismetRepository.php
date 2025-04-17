<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wemessage\Akismet\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Wemessage\Akismet\Api\AkismetRepositoryInterface;
use Wemessage\Akismet\Api\Data\AkismetInterface;
use Wemessage\Akismet\Api\Data\AkismetInterfaceFactory;
use Wemessage\Akismet\Api\Data\AkismetSearchResultsInterfaceFactory;
use Wemessage\Akismet\Model\ResourceModel\Akismet as ResourceAkismet;
use Wemessage\Akismet\Model\ResourceModel\Akismet\CollectionFactory as AkismetCollectionFactory;

class AkismetRepository implements AkismetRepositoryInterface
{

    /**
     * @var Akismet
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var AkismetInterfaceFactory
     */
    protected $akismetFactory;

    /**
     * @var AkismetCollectionFactory
     */
    protected $akismetCollectionFactory;

    /**
     * @var ResourceAkismet
     */
    protected $resource;


    /**
     * @param ResourceAkismet $resource
     * @param AkismetInterfaceFactory $akismetFactory
     * @param AkismetCollectionFactory $akismetCollectionFactory
     * @param AkismetSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceAkismet $resource,
        AkismetInterfaceFactory $akismetFactory,
        AkismetCollectionFactory $akismetCollectionFactory,
        AkismetSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->akismetFactory = $akismetFactory;
        $this->akismetCollectionFactory = $akismetCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(AkismetInterface $akismet)
    {
        try {
            $this->resource->save($akismet);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the akismet: %1',
                $exception->getMessage()
            ));
        }
        return $akismet;
    }

    /**
     * @inheritDoc
     */
    public function get($akismetId)
    {
        $akismet = $this->akismetFactory->create();
        $this->resource->load($akismet, $akismetId);
        if (!$akismet->getId()) {
            throw new NoSuchEntityException(__('Akismet with id "%1" does not exist.', $akismetId));
        }
        return $akismet;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->akismetCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(AkismetInterface $akismet)
    {
        try {
            $akismetModel = $this->akismetFactory->create();
            $this->resource->load($akismetModel, $akismet->getAkismetId());
            $this->resource->delete($akismetModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Akismet: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($akismetId)
    {
        return $this->delete($this->get($akismetId));
    }
}


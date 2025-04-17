<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wemessage\Akismet\Model;

use Magento\Framework\Model\AbstractModel;
use Wemessage\Akismet\Api\Data\AkismetInterface;

class Akismet extends AbstractModel implements AkismetInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Wemessage\Akismet\Model\ResourceModel\Akismet::class);
    }

    /**
     * @inheritDoc
     */
    public function getAkismetId()
    {
        return $this->getData(self::AKISMET_ID);
    }

    /**
     * @inheritDoc
     */
    public function setAkismetId($akismetId)
    {
        return $this->setData(self::AKISMET_ID, $akismetId);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getIp()
    {
        return $this->getData(self::IP);
    }

    /**
     * @inheritDoc
     */
    public function setIp($ip)
    {
        return $this->setData(self::IP, $ip);
    }

    /**
     * @inheritDoc
     */
    public function getUserAgent()
    {
        return $this->getData(self::USER_AGENT);
    }

    /**
     * @inheritDoc
     */
    public function setUserAgent($userAgent)
    {
        return $this->setData(self::USER_AGENT, $userAgent);
    }

    /**
     * @inheritDoc
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * @inheritDoc
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * @inheritDoc
     */
    public function getIsSpam()
    {
        return $this->getData(self::IS_SPAM);
    }

    /**
     * @inheritDoc
     */
    public function setIsSpam($isSpam)
    {
        return $this->setData(self::IS_SPAM, $isSpam);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}


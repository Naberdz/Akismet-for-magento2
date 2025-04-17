<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wemessage\Akismet\Api\Data;

interface AkismetInterface
{

    const USER_AGENT = 'user_agent';
    const NAME = 'name';
    const CREATED_AT = 'created_at';
    const IS_SPAM = 'is_spam';
    const COMMENT = 'comment';
    const ID = 'id';
    const EMAIL = 'email';
    const IP = 'ip';
    const AKISMET_ID = 'akismet_id';

    /**
     * Get akismet_id
     * @return string|null
     */
    public function getAkismetId();

    /**
     * Set akismet_id
     * @param string $akismetId
     * @return \Wemessage\Akismet\Akismet\Api\Data\AkismetInterface
     */
    public function setAkismetId($akismetId);

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \Wemessage\Akismet\Akismet\Api\Data\AkismetInterface
     */
    public function setId($id);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Wemessage\Akismet\Akismet\Api\Data\AkismetInterface
     */
    public function setName($name);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Wemessage\Akismet\Akismet\Api\Data\AkismetInterface
     */
    public function setEmail($email);

    /**
     * Get ip
     * @return string|null
     */
    public function getIp();

    /**
     * Set ip
     * @param string $ip
     * @return \Wemessage\Akismet\Akismet\Api\Data\AkismetInterface
     */
    public function setIp($ip);

    /**
     * Get user_agent
     * @return string|null
     */
    public function getUserAgent();

    /**
     * Set user_agent
     * @param string $userAgent
     * @return \Wemessage\Akismet\Akismet\Api\Data\AkismetInterface
     */
    public function setUserAgent($userAgent);

    /**
     * Get comment
     * @return string|null
     */
    public function getComment();

    /**
     * Set comment
     * @param string $comment
     * @return \Wemessage\Akismet\Akismet\Api\Data\AkismetInterface
     */
    public function setComment($comment);

    /**
     * Get is_spam
     * @return string|null
     */
    public function getIsSpam();

    /**
     * Set is_spam
     * @param string $isSpam
     * @return \Wemessage\Akismet\Akismet\Api\Data\AkismetInterface
     */
    public function setIsSpam($isSpam);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Wemessage\Akismet\Akismet\Api\Data\AkismetInterface
     */
    public function setCreatedAt($createdAt);
}


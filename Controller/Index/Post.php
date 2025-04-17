<?php
namespace Wemessage\Akismet\Controller\Index;

use Magento\Contact\Controller\Index\Post as CorePost;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Contact\Model\ConfigInterface;
use Magento\Contact\Model\MailInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use GuzzleHttp\Client;

class Post extends CorePost implements HttpPostActionInterface
{
    protected $scopeConfig;
    protected $storeManager;

    public function __construct(
        Context $context,
        ConfigInterface $contactsConfig,
        MailInterface $mail,
        DataPersistorInterface $dataPersistor,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        \Wemessage\Akismet\Api\AkismetRepositoryInterface $akismetRepository,
        \Wemessage\Akismet\Model\AkismetFactory $akismetFactory,
        LoggerInterface $logger
    ) {
        parent::__construct($context, $contactsConfig, $mail, $dataPersistor, $logger);
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->akismetRepository = $akismetRepository;
        $this->akismetFactory = $akismetFactory;
        $this->logger = $logger;
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();

        // Akismet spam check
        if ($this->isAkismetSpam($params)) {
            $this->messageManager->addErrorMessage(__('Your message was flagged as spam.'));
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        return parent::execute();
    }

    protected function isAkismetSpam(array $params): bool
    {
        $isEnabled = $this->getConfigValue('akismet/options/enabled');
        if(!$isEnabled) return true;

        $apiKey = $this->getConfigValue('akismet/options/api');
        $siteUrl = $this->storeManager->getStore()->getBaseUrl();

        
        $client = new Client([
            'base_uri' => "https://{$apiKey}.rest.akismet.com/1.1/",
            'timeout'  => 5,
        ]);

        $payload = [
            'blog'                 => $siteUrl,
            'user_ip'              => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent'           => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'referrer'             => $_SERVER['HTTP_REFERER'] ?? '',
            'comment_type'         => 'contact-form',
            'comment_author'       => $params['name'] ?? '',
            'comment_author_email' => $params['email'] ?? '',
            'comment_content'      => $params['comment'] ?? '',
        ];

        try {
            $response = $client->post('comment-check', [
                'form_params' => $payload,
                'headers' => [
                    'User-Agent' => 'Magento/2 | AkismetMagentoIntegration/1.0'
                ]
            ]);
            $body = (string) $response->getBody();
            
            $isSpam = trim($body) === 'true';
            $this->logSubmission($params, $isSpam);
            return $isSpam;
        } catch (\Exception $e) {
            $this->logger->critical('Akismet check failed: ' . $e->getMessage());
            return false;
        }
    }

    private function getConfigValue(string $path): ?string
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }

    protected function logSubmission(array $params, bool $isSpam)
    {
        $akismetLog = $this->akismetFactory->create();
        $akismetLog->setName($params['name'] ?? '');
        $akismetLog->setEmail($params['email'] ?? '');
        $akismetLog->setIp($this->getRequest()->getClientIp());
        $akismetLog->setUserAgent($_SERVER['HTTP_USER_AGENT'] ?? '');
        $akismetLog->setComment($params['comment'] ?? '');
        $akismetLog->setIsSpam((int) $isSpam ? __('Yes') : __('No'));
        $akismetLog->setCreatedAt(date('Y-m-d H:i:s')); // optional if DB handles it

        try {
            $this->akismetRepository->save($akismetLog);
        } catch (\Exception $e) {
            $this->logger->critical(__('Akismet log failed: %1', $e->getMessage()));
        }
    }
}
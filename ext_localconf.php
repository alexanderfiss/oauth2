<?php

use Mfc\OAuth2\LoginProvider\OAuth2LoginProvider;
use Mfc\OAuth2\Services\OAuth2LoginService;

defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    $_EXTKEY,
    'auth',
    OAuth2LoginService::class,
    [
        'title' => 'OAuth Authentication',
        'description' => 'OAuth authentication service for backend users',
        'subtype' => 'getUserBE,authUserBE',
        'available' => true,
        'priority' => 75,
        'quality' => 50,
        'os' => '',
        'exec' => '',
        'className' => OAuth2LoginService::class
    ]
);

$extensionConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['oauth2']);

if ($extensionConfig['gitlabEnableBackendLogin'] && !empty($extensionConfig['gitlabAppId'])
    && !empty($extensionConfig['gitlabAppSecret'])
    && !empty($extensionConfig['gitlabServer'])
) {
    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['backend']['loginProviders'][1529672977] = [
        'provider' => OAuth2LoginProvider::class,
        'sorting' => 25,
        'icon-class' => 'fa-sign-in',
        'label' => 'LLL:EXT:oauth2/Resources/Private/Language/locallang.xlf:oauth2.login.link'
    ];
}

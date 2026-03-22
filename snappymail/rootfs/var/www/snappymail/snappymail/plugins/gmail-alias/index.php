<?php

class GmailAliasPlugin extends \RainLoop\Plugins\AbstractPlugin
{
    const NAME = 'Gmail Alias Password';
    const VERSION = '1.0.0';
    const DESCRIPTION = 'Replaces alias password with real Gmail App password on login';

    public function Init(): void
    {
        $this->addHook('login.credentials.step-1', 'ReplaceAliasPassword');
    }

    public function ReplaceAliasPassword(\RainLoop\Model\Account $oAccount): void
    {
        // Read config from file written by init script
        $sConfigFile = APP_PRIVATE_DATA . 'gmail_alias_config.json';
        if (!\file_exists($sConfigFile)) {
            return;
        }

        $aConfig = \json_decode(\file_get_contents($sConfigFile), true);
        if (!$aConfig) {
            return;
        }

        $sGmailAddress   = $aConfig['gmail_address'] ?? '';
        $sRealPassword   = $aConfig['gmail_password'] ?? '';
        $sAliasPassword  = $aConfig['gmail_alias_password'] ?? '';

        // Only apply if this is the configured Gmail account
        if (
            $oAccount->Email() === $sGmailAddress &&
            $oAccount->Password() === $sAliasPassword
        ) {
            $oAccount->SetPassword($sRealPassword);
        }
    }
}

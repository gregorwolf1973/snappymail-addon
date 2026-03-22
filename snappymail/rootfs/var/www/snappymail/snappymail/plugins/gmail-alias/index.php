<?php
class GmailAliasPlugin extends \RainLoop\Plugins\AbstractPlugin
{
    const NAME = 'Gmail Alias Password';
    const VERSION = '1.0.0';
    const DESCRIPTION = 'Replaces alias password with real Gmail App password on login';

    public function Init(): void
    {
        $this->addHook('login.credentials', 'ReplaceAliasPassword');
    }

    public function ReplaceAliasPassword(string &$sEmail, string &$sImapUser, string &$sPassword, string &$sSmtpUser): void
    {
        $sConfigFile = APP_PRIVATE_DATA . 'gmail_alias_config.json';
        if (!file_exists($sConfigFile)) {
            return;
        }
        $aConfig = json_decode(file_get_contents($sConfigFile), true);
        if (!$aConfig) {
            return;
        }
        $sGmailAddress  = $aConfig['gmail_address'] ?? '';
        $sRealPassword  = $aConfig['gmail_password'] ?? '';
        $sAliasPassword = $aConfig['gmail_alias_password'] ?? '';
        if ($sEmail === $sGmailAddress && $sPassword === $sAliasPassword) {
            $sPassword = $sRealPassword;
        }
    }
}

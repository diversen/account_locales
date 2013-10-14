<?php

class account_locales {
    
    public static function events ($args) {
        
        if ($args['action'] == 'attach_module_menu') {
            return self::getModuleMenuItem($args);
        }
    }
    
    public static function getModuleMenuItem ($args) {
        
        $ary = array(
            'title' => lang::translate('Locales'),
            'url' => '/account_locales/edit',
            'auth' => 'user');
        return $ary;
    }
    
    public static function editAction () {
        moduleloader::includeModule('locales');
             
        layout::setCurrentModuleMenu('account_locales', 'account_profile');
        layout::setModuleMenu('account_profile');

        if (isset($_POST['language'])) {
            locales::updateAccountLanguage('/account_locales/edit');
        }

        
        $default = config::getMainIni('language');
        $user_language = cache::get('account_locales_language', session::getUserId());
        if ($user_language) {
            $default = $user_language;
        }
        locales::displaySetLanguage($default);
        
    }

    
    public static function runLevel ($level) {
        /*
        if ($level == 4) {
            $user_language = cache::get('account_locales_language', session::getUserId());
            if ($user_language) {
                config::setMainIni('language_account', $user_language);
            }
        }*/
    }
}
<?php

/**
 * file contains account:locales
 */

/**
 * class account_locales
 */
class account_locales {
    
    /**
     * events: attach the account_locales module to a parent module
     * @param type $args
     * @return type
     */
    public static function events ($args) {
        if ($args['action'] == 'attach_module_menu') {
            return self::getModuleMenuItem($args);
        }
    }
    
    /**
     * create a module menu item for setting locales per account
     * @param array $args
     * @return array $menu menu item
     */
    public static function getModuleMenuItem ($args) {
        $ary = array(
            'title' => lang::translate('Set language'),
            'url' => '/account_locales/edit',
            'auth' => 'user');
        return $ary;
    }
    
    /**
     * use locales language form and set 'account_locales_language', user_id 
     * in system_cache
     */
    public static function editAction () {
        
        if (!session::isUser()) {
            return;
        }
        
        $parent = config::getModuleIni('account_locales_parent');
        
        moduleloader::includeModule('locales');         
        layout::setCurrentModuleMenu('account_locales', $parent);
        layout::setModuleMenu($parent);
        
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
}

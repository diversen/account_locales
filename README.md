### account_locales

allow users to set `locales` (language) per account. This will override system language when user is logged in.

### Usage

The module will work as a sub module to e.g. a profile module. In the default setup
I use the 'profile' module 'account_profile' (were user can write a short bio or something
similar). I set the `account_locale` ini setting `account_locales_parent`

     account_locales_parent = 'account_profile'

In the `account_profile` module I have added the following to the `account_profile.ini` file

    account_profile_events[] = 'account_locales::events'

This will ensure that `account_locales::events` is called in the `account_profile` 
module. All it does is to attach a `Locales` menu item to the `account_profile` module menu

This makes it easier to attach this user setting to any account|user `profile` module.  

### Call example

The event is called inside the `menu.inc` file of account_profile: 

    $events = config::getModuleIni('account_profile_events');
    $args = array (
        'action' => 'attach_module_menu',
    );

    $menus = event::getTriggerEvent($events, $args);    
    foreach($menus as $menu) {
        $_MODULE_MENU[] = $menu;
    } 

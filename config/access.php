<?php
// This file should control all access to specified modules and actions.
return array(
	// Module/action permissions.
	// These are handled during runtime by Flux.
	// '*' is a default that is checked for any action that has not been
	// specified an access level.
	'modules' => array(
		'main'      => array(
			'*'        => AccountLevel::ANYONE
		),
		'donate'    => array(
			'index'    => AccountLevel::ANYONE,
			'notify'   => AccountLevel::ANYONE,
			'update'   => AccountLevel::ANYONE,
			'complete' => AccountLevel::ANYONE,
			'history'  => AccountLevel::NORMAL
		),
		'purchase'  => array(
			'index'    => AccountLevel::ANYONE,
			'add'      => AccountLevel::NORMAL,
			'clear'    => AccountLevel::NORMAL,
			'cart'     => AccountLevel::NORMAL,
			'checkout' => AccountLevel::NORMAL,
			'remove'   => AccountLevel::NORMAL,
			'pending'  => AccountLevel::NORMAL
		),
		'itemshop'  => array(
			'add'      => AccountLevel::ADMIN,
			'edit'     => AccountLevel::ADMIN,
			'delete'   => AccountLevel::ADMIN
		),
		'account'   => array(
			'index'    => AccountLevel::LOWGM,
			'view'     => AccountLevel::NORMAL,
			'create'   => AccountLevel::UNAUTH,
			'login'    => AccountLevel::UNAUTH,
			'logout'   => AccountLevel::NORMAL,
			'transfer' => AccountLevel::NORMAL,
			'xferlog'  => AccountLevel::NORMAL,
			'cart'     => AccountLevel::NORMAL,
			'changepass' => AccountLevel::NORMAL,
			'edit'       => AccountLevel::ADMIN,
			'changesex'  => AccountLevel::NORMAL
		),
		'character' => array(
			'index'    => AccountLevel::LOWGM,
			'view'     => AccountLevel::NORMAL,
			'online'   => AccountLevel::NORMAL,
			'prefs'    => AccountLevel::NORMAL,
			'changeslot' => AccountLevel::NORMAL
		),
		'guild'     => array(
			'emblem'   => AccountLevel::ANYONE,
			'index'    => AccountLevel::LOWGM,
			'export'   => AccountLevel::ADMIN,
			'view'     => AccountLevel::ADMIN
		),
		'castle'    => array(
			'index'    => AccountLevel::LOWGM
		),
		'economy'   => array(
			'index'    => AccountLevel::NORMAL
		),
		'auction'   => array(
			'index'    => AccountLevel::LOWGM
		),
		'ranking'   => array(
			'index'    => AccountLevel::NORMAL,
			'character' => AccountLevel::NORMAL,
			'guild'     => AccountLevel::NORMAL,
			'zeny'      => AccountLevel::NORMAL
		),
		'item'      => array(
			'index'    => AccountLevel::NORMAL,
			'view'     => AccountLevel::NORMAL
		),
		'monster'   => array(
			'index'    => AccountLevel::NORMAL,
			'view'     => AccountLevel::NORMAL
		),
		'server'    => array(
			'status'     => AccountLevel::ANYONE,
			'status-xml' => AccountLevel::ANYONE
		),
		'logdata'   => array(
			'index'   => AccountLevel::ADMIN,
			'paypal'  => AccountLevel::ADMIN,
			'txnview' => AccountLevel::ADMIN,
			'char'    => AccountLevel::ADMIN,
			'inter'   => AccountLevel::ADMIN,
			'command' => AccountLevel::ADMIN,
			'branch'  => AccountLevel::ADMIN,
			'chat'    => AccountLevel::ADMIN,
			'login'   => AccountLevel::ADMIN,
			'mvp'     => AccountLevel::ADMIN,
			'npc'     => AccountLevel::ADMIN,
			'pick'    => AccountLevel::ADMIN,
			'zeny'    => AccountLevel::ADMIN
		),
		'ipban'     => array(
			'index'    => AccountLevel::ADMIN,
			'add'      => AccountLevel::ADMIN,
			'unban'    => AccountLevel::ADMIN
		),
		'service'   => array(
			'tos'      => AccountLevel::ANYONE
		),
		'captcha'   => array(
			'index'    => AccountLevel::ANYONE
		),
		'install'   => array(
			'index'    => AccountLevel::ANYONE
		),
		'test'      => array(
			'*'        => AccountLevel::ANYONE
		),
		'reload'    => array(
			'index'   => AccountLevel::ADMIN,
			'mobskill' => AccountLevel::ADMIN
		)
	),
	// General feature permissions, handled by the modules themselves.
	'features' => array(
		'ViewAccount'        => AccountLevel::HIGHGM, // View another person's account details.
		'ViewAccountBanLog'  => AccountLevel::HIGHGM, // View another person's account ban log.
		'DeleteAccount'      => AccountLevel::ADMIN,  // (not yet implemented)
		'DeleteCharacter'    => AccountLevel::ADMIN,  // (not yet implemented)
		'SeeAccountPassword' => AccountLevel::ADMIN,  // If not using MD5, view another person's password in list.
		'TempBanAccount'     => AccountLevel::LOWGM,  // Has ability to temporarily ban an account.
		'TempUnbanAccount'   => AccountLevel::LOWGM,  // Has ability to remove a temporary ban on an account.
		'PermBanAccount'     => AccountLevel::HIGHGM, // Has ability to permanently ban an account.
		'PermUnbanAccount'   => AccountLevel::HIGHGM, // Has ability to remove a permanent ban on an account.
		'SearchMD5Passwords' => AccountLevel::ADMIN,  // Ability to search MD5'd passwords in list.
		'ViewCharacter'      => AccountLevel::HIGHGM, // View another person's character details.
		'AddShopItem'        => AccountLevel::ADMIN,  // Ability to add an item to the shop.
		'EditShopItem'       => AccountLevel::ADMIN,  // Ability to modify a shop item's details.
		'DeleteShopItem'     => AccountLevel::ADMIN,  // Ability to remove an item for sale on the shop.
		'ViewGuild'          => AccountLevel::ADMIN,  // Ability to view another guild's details.
		'SearchWhosOnline'   => AccountLevel::NORMAL, // Ability to search the "Who's Online" page.
		'ViewOnlinePosition' => AccountLevel::HELPER, // Ability to see a character's current map on "Who's Online" page.
		'EditAccountLevel'   => AccountLevel::ADMIN,  // Ability to edit another person's account level.
		'EditAccountBalance' => AccountLevel::ADMIN,  // Ability to edit another person's account balance.
		'ModifyAccountPrefs' => AccountLevel::ADMIN,  // Ability to modify another person's account preferences.
		'ModifyCharPrefs'    => AccountLevel::ADMIN,  // Ability to modify another person's character preferences.
		'IgnoreHiddenPref'   => AccountLevel::HELPER, // Ability to see users on "Who's Online" page, hidden or not.
		'IgnoreHiddenPref2'  => AccountLevel::HELPER, // Ability to see users on "Who's Online" page, hidden by app config or not.
		'ChangeSlot'         => AccountLevel::LOWGM,  //
		
		'EditHigherPower'    => 5000,
		'BanHigherPower'     => 5000
	)
);
?>
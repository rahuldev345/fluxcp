CREATE TABLE `cp_trusted` (
`id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`account_id` INT( 11 ) UNSIGNED NOT NULL ,
`email` VARCHAR( 255 ) NOT NULL ,
`create_date` DATETIME NOT NULL ,
`delete_date` DATETIME NULL
) ENGINE = MYISAM ;
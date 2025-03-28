SQL Alter commands

ALTER TABLE `escorts_medias` CHANGE `type` `type` TINYINT(4) NULL DEFAULT NULL COMMENT '0=>image; 1=>video', CHANGE `path` `path` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `discription` `status` TINYINT(4) NULL DEFAULT NULL;
======gender nullable field============
ALTER TABLE `escorts` CHANGE `gender` `gender` TINYINT(4) NULL DEFAULT NULL COMMENT '0=>female; 1=>male; 2=>other';

==========pincode=====
ALTER TABLE `escorts` CHANGE `pincode` `pincode` INT NULL DEFAULT NULL;

======user_id ===============
ALTER TABLE `escorts` CHANGE `user_id` `user_id` VARCHAR(225) NOT NULL;

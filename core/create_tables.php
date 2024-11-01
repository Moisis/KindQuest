<?php
require("Database.php");

run_queries([
"CREATE TABLE `Donation`(
    `donation_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT NOT NULL,
    `event_id` INT NOT NULL,
    `amount` FLOAT(53) NOT NULL,
    `donation_method` ENUM('') NOT NULL COMMENT 'enum?'
);",
    "CREATE TABLE `Fundraising`(
    `event_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `goal` INT NOT NULL
);",
"CREATE TABLE `Charity`(
    `event_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `charity_type` VARCHAR(255) NOT NULL
);",

"CREATE TABLE `Event_Registration`(
    `event_id` BIGINT UNSIGNED NOT NULL,
    `user_id` BIGINT NOT NULL,
    `role` BOOLEAN NOT NULL,
    PRIMARY KEY(`user_id`, `event_id`)
);",
"CREATE TABLE `Account`(
    `account_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `account_type` ENUM('') NOT NULL COMMENT 'enum?'
);",
"CREATE TABLE `Workshop`(
    `event_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `activity` VARCHAR(255) NOT NULL
);",
"CREATE TABLE `Non_Virtual_Events`(
    `event_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `location` VARCHAR(255) NOT NULL COMMENT 'change to composite attr',
    `vol_required` INT NOT NULL,
    `org_required` INT NOT NULL COMMENT 'wtf'
);",
"CREATE TABLE `Events`(
    `event_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `event_name` VARCHAR(255) NOT NULL,
    `desc` VARCHAR(255) NULL,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `registration_date` DATETIME NOT NULL,
    `sponsored` BOOLEAN NOT NULL DEFAULT '0'
);",
"ALTER TABLE
    `Non_Virtual_Events` ADD CONSTRAINT `non_virtual_events_event_id_foreign` FOREIGN KEY(`event_id`) REFERENCES `Workshop`(`event_id`);",
    "ALTER TABLE
    `Events` ADD CONSTRAINT `events_event_id_foreign` FOREIGN KEY(`event_id`) REFERENCES `Non_Virtual_Events`(`event_id`);
",
"ALTER TABLE
    `Donation` ADD CONSTRAINT `donation_event_id_foreign` FOREIGN KEY(`event_id`) REFERENCES `Events`(`event_id`);
",
"ALTER TABLE
    `Events` ADD CONSTRAINT `events_event_id_foreign` FOREIGN KEY(`event_id`) REFERENCES `Event_Registration`(`event_id`);
",
"ALTER TABLE
    `Charity` ADD CONSTRAINT `charity_event_id_foreign` FOREIGN KEY(`event_id`) REFERENCES `Non_Virtual_Events`(`event_id`);
",
"ALTER TABLE
    `Donation` ADD CONSTRAINT `donation_account_id_foreign1` FOREIGN KEY(`account_id`) REFERENCES `Account`(`account_id`);
",
"ALTER TABLE
    `Events` ADD CONSTRAINT `events_event_id_foreign1` FOREIGN KEY(`event_id`) REFERENCES `Fundraising`(`event_id`);
",
"ALTER TABLE
    `Account` ADD CONSTRAINT `account_account_id_foreign` FOREIGN KEY(`account_id`) REFERENCES `Event_Registration`(`user_id`);"]);;







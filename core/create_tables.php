<?php
require("Database.php");

run_queries([

// Drop the database if it already exists, do nothing otherwise
"DROP DATABASE IF EXISTS $configs->DB_NAME",

// Create the database from scratch
"CREATE DATABASE $configs->DB_NAME",

"USE $configs->DB_NAME",
"CREATE TABLE `Account`(
    account_id INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `account_type` ENUM('') NOT NULL COMMENT 'enum?'
);",

"CREATE TABLE `Event`(
    `event_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `event_name` VARCHAR(255) NOT NULL,
    `desc` VARCHAR(255) NULL,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `registration_date` DATETIME NOT NULL,
    `sponsored` BOOLEAN NOT NULL DEFAULT '0'
);",

"CREATE TABLE Donation_Types(
    donation_type_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    donation_type_name VARCHAR(255)
)",

"CREATE TABLE `Donation`(
    `donation_id` INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT  NOT NULL,
    `event_id` INT  NOT NULL,
    `amount` FLOAT(53) NOT NULL,
    `donation_method` INT NOT NULL,
    donation_date DATETIME NOT NULL,
    FOREIGN KEY (account_id) REFERENCES Account(account_id),
    FOREIGN KEY (event_id) REFERENCES Event(event_id),
    FOREIGN KEY (donation_method) REFERENCES Donation_Types(donation_type_id)
);",
    "CREATE TABLE `Fundraising`(
    `event_id` INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `goal` INT NOT NULL,
    FOREIGN KEY (event_id) REFERENCES Event(event_id)
);",
"CREATE TABLE `Charity`(
    `event_id` INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `charity_type` VARCHAR(255) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES Event(event_id)
);",

"CREATE TABLE `Event_Registration`(
    `event_id` INT NOT NULL,
    `account_id` INT NOT NULL,
    `role` BOOLEAN NOT NULL,
    PRIMARY KEY(`account_id`, `event_id`),
    FOREIGN KEY (event_id) REFERENCES Event(event_id),
    FOREIGN KEY (account_id) REFERENCES Account(account_id)
);",

"CREATE TABLE `Workshop`(
    `event_id` INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `activity` VARCHAR(255) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES Event(event_id)
);",
"CREATE TABLE `Non_Virtual_Events`(
    `event_id` INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `location` VARCHAR(255) NOT NULL COMMENT 'change to composite attr',
    `vol_required` INT NOT NULL,
    `org_required` INT NOT NULL COMMENT 'wtf',
    FOREIGN KEY (event_id) REFERENCES Event(event_id)
);",

"CREATE TABLE Badge(
    badge_id INT NOT NULL PRIMARY KEY,
    badge_name VARCHAR(255)    
);",

"CREATE TABLE Account_Badges(
    account_id INT NOT NULL,
    badge_id INT NOT NULL,
    badge_count INT NOT NULL DEFAULT 0,
    PRIMARY KEY(account_id, badge_id),
    FOREIGN KEY (badge_id) REFERENCES Badge(badge_id),
    FOREIGN KEY (account_id) REFERENCES Account(account_id)    

);",
"INSERT INTO Donation_Types(donation_type_name)
VALUES ('VISA')",
"INSERT INTO Donation_Types(donation_type_name)
VALUES ('FAWRY')",
"INSERT INTO Donation_Types(donation_type_name)
VALUES ('CASH')",

]);

/*
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




*/


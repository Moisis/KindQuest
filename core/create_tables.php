<?php
require_once("Database.php");

run_queries([

// Drop the database if it already exists, do nothing otherwise
"DROP DATABASE IF EXISTS $configs->DB_NAME",
// Create the database from scratch
"CREATE DATABASE $configs->DB_NAME",

"USE $configs->DB_NAME",
"CREATE TABLE Account_Types(
    account_type_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    account_type_name VARCHAR(255)

);",
"CREATE TABLE Account(
    account_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(254) NOT NULL,
    password VARCHAR(255) NOT NULL,
    account_type_id INT NOT NULL,
    suspended INT NOT NULL,
    FOREIGN KEY (account_type_id) REFERENCES Account_types(account_type_id)

);",

"CREATE TABLE Preferences(
    account_id INT NOT NULL,
    notification_for INT NOT NULL,
    preference INT NOT NULL,
    FOREIGN KEY (account_id) REFERENCES Account(account_id)
);",

"CREATE TABLE Event_Types(
    event_type_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_type_name VARCHAR(255)
)",

"CREATE TABLE `Event`(
    `event_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    creator_id INT NOT NULL,
    `event_name` VARCHAR(255) NOT NULL,
    `desc` VARCHAR(255) NULL,
    created_at DATETIME,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `registration_date` DATETIME NOT NULL,
    event_type_id INT NOT NULL,
    FOREIGN KEY(creator_id) REFERENCES Account(account_id),
    FOREIGN KEY(event_type_id) REFERENCES Event_Types(event_type_id)
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
    `event_id` INT  NOT NULL PRIMARY KEY,
    `goal` INT NOT NULL,
    FOREIGN KEY (event_id) REFERENCES Event(event_id)
);",
"CREATE TABLE `Charity`(
    `event_id` INT  NOT NULL PRIMARY KEY,
    `charity_type` VARCHAR(255) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES Event(event_id)
);",

"CREATE TABLE `Event_Registration`(
    `event_id` INT NOT NULL,
    `account_id` INT NOT NULL,
    `role` INT NOT NULL,
    PRIMARY KEY(`account_id`, `event_id`),
    FOREIGN KEY (event_id) REFERENCES Event(event_id),
    FOREIGN KEY (account_id) REFERENCES Account(account_id)
);",

"CREATE TABLE `Workshop`(
    `event_id` INT  NOT NULL PRIMARY KEY,
    `activity` VARCHAR(255) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES Event(event_id)
);",
"CREATE TABLE `Non_Virtual_Events`(
    `event_id` INT  NOT NULL PRIMARY KEY,
    `location` VARCHAR(255) NOT NULL COMMENT 'change to composite attr',
    `vol_required` INT NOT NULL,
    `org_required` INT NOT NULL COMMENT 'wtf',
    FOREIGN KEY (event_id) REFERENCES Event(event_id)
);",

"CREATE TABLE Badge(
    badge_id INT NOT NULL PRIMARY KEY,
    badge_name VARCHAR(255),
    badge_points INT NOT NULL DEFAULT 0    
);",

"CREATE TABLE Account_Badges(
    account_id INT NOT NULL,
    badge_id INT NOT NULL,
    badge_count INT NOT NULL DEFAULT 0,
    PRIMARY KEY(account_id, badge_id),
    FOREIGN KEY (badge_id) REFERENCES Badge(badge_id),
    FOREIGN KEY (account_id) REFERENCES Account(account_id)    

);",

"CREATE TABLE Products(
    product_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    price FLOAT NOT NULL,
    img_path VARCHAR(255) NOT NULL
)",

"INSERT INTO Products (product_name, description, price, img_path) VALUES ('Men\'s Shirt', 'A stylish men\'s shirt', 75.00, '/images/merch/tshirt_boy.png')",
"INSERT INTO Products (product_name, description, price, img_path) VALUES ('Women\'s Shirt', 'A stylish women\'s shirt', 80.00, '/images/merch/tshirt_girl.png')",
"INSERT INTO Products (product_name, description, price, img_path) VALUES ('Pillow', 'A comfortable pillow', 68.00, '/images/merch/pillow.png')",
"INSERT INTO Products (product_name, description, price, img_path) VALUES ('Notebook', 'A handy notebook', 70.00, '/images/merch/notebook.png')",
"INSERT INTO Products (product_name, description, price, img_path) VALUES ('Mug', 'A cool mug', 75.00, '/images/merch/mug.png')",
"INSERT INTO Products (product_name, description, price, img_path) VALUES ('Hoodie', 'A warm hoodie', 58.00, '/images/merch/hoodie.jpg')",
"INSERT INTO Products (product_name, description, price, img_path) VALUES ('Bottle', 'A water bottle', 80.00, '/images/merch/bottle.png')",
"INSERT INTO Products (product_name, description, price, img_path) VALUES ('Cap', 'A stylish cap', 65.00, '/images/merch/cap.jpg')",



"INSERT INTO Donation_Types(donation_type_name)
VALUES ('VISA')",
"INSERT INTO Donation_Types(donation_type_name)
VALUES ('FAWRY')",
"INSERT INTO Donation_Types(donation_type_name)
VALUES ('CASH')",
"INSERT INTO Badge(badge_id,badge_name,badge_points)
VALUES (1,'NewComer', 0)",
"INSERT INTO Badge(badge_id,badge_name,badge_points)
VALUES (2,'VolunChamp', 20)",
"INSERT INTO Badge(badge_id,badge_name,badge_points)
VALUES (3,'DonoChamp', 50)",
"INSERT INTO Badge(badge_id,badge_name,badge_points)
VALUES (4,'NewOrganizer', 10)",
"INSERT INTO Badge(badge_id,badge_name,badge_points)
VALUES (5,'OrganizeChamp', 70)",
"INSERT INTO Account_Types(account_type_name)
VALUES('admin')",
"INSERT INTO Account_Types(account_type_name)
VALUES('Individual')",
"INSERT INTO Account_Types(account_type_name)
VALUES('Organization')",


"INSERT INTO Event_Types(event_type_name)
VALUES('Fundraiser')",
"INSERT INTO Event_Types(event_type_name)
VALUES('Charity')",
"INSERT INTO Event_Types(event_type_name)
VALUES('Workshop')"

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


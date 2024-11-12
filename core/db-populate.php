<?php
require("Database.php");

run_queries([

    // Insert sample data into Account table
    "INSERT INTO `Account` (`username`, `password`, `account_type`) VALUES 
    ('user1', 'pass123', 'user'), 
    ('organizer1', 'securepass', 'organizer'), 
    ('admin1', 'adminpass', 'admin');",

    // Insert sample data into Event table
    "INSERT INTO `Event` (`event_name`, `desc`, `start_date`, `end_date`, `registration_date`, `sponsored`) VALUES 
    ('Community Cleanup', 'Local area cleanup event', '2024-12-01 09:00:00', '2024-12-01 17:00:00', '2024-11-20 00:00:00', 1), 
    ('Charity Run', '5k run for charity', '2024-11-15 07:00:00', '2024-11-15 12:00:00', '2024-11-01 00:00:00', 0);",

    // Insert sample data into Donation_Types table
    "INSERT INTO Donation_Types (donation_type_name) VALUES 
    ('VISA'), 
    ('FAWRY'), 
    ('CASH');",

    // Insert sample data into Donation table
    "INSERT INTO `Donation` (`account_id`, `event_id`, `amount`, `donation_method`, `donation_date`) VALUES 
    (1, 1, 50.00, 1, '2024-11-12 10:30:00'), 
    (2, 2, 100.00, 2, '2024-11-14 08:45:00');",

    // Insert sample data into Fundraising table
    "INSERT INTO `Fundraising` (`event_id`, `goal`) VALUES 
    (1, 5000), 
    (2, 10000);",

    // Insert sample data into Charity table
    "INSERT INTO `Charity` (`event_id`, `charity_type`) VALUES 
    (1, 'Environmental'), 
    (2, 'Health');",

    // Insert sample data into Event_Registration table
    "INSERT INTO `Event_Registration` (`event_id`, `account_id`, `role`) VALUES 
    (1, 1, 0), 
    (2, 2, 1);",

    // Insert sample data into Workshop table
    "INSERT INTO `Workshop` (`event_id`, `activity`) VALUES 
    (1, 'Recycling Workshop'), 
    (2, 'Health Awareness');",

    // Insert sample data into Non_Virtual_Events table
    "INSERT INTO `Non_Virtual_Events` (`event_id`, `location`, `vol_required`, `org_required`) VALUES 
    (1, 'City Park', 10, 2), 
    (2, 'Community Center', 20, 3);",

    // Insert sample data into Badge table
    "INSERT INTO Badge (badge_id, badge_name, badge_points) VALUES 
    (1, 'NewComer', 0), 
    (2, 'VolunChamp', 20);",

    // Insert sample data into Account_Badges table
    "INSERT INTO Account_Badges (account_id, badge_id, badge_count) VALUES 
    (1, 1, 1), 
    (2, 2, 3);"

]);
?>

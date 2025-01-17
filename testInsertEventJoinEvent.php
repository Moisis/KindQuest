<?php
require_once "app/models/Events/NonVirtualEvent.php";
require_once "app/models/Users/Organization.php";
require_once "core/Database.php";
require_once "app/models/Auth/OrganizationAuth.php";

$user_id = 1;
$userName = "test";
$password = "test";
$account_type = 3;
$email = "test@gmail.com";
$event_name = "Community Cleanup";
$description = "A local event to clean up the park.";
$registration_time = "2025-01-20 10:00:00";
$start_date = "2025-01-25 09:00:00";
$end_date = "2025-01-25 15:00:00";
$event_type_id = 2;
$location = "Central Park";
$volunteers_required = 10;
$organizers_required = 2;




try {


    //$organization = new Organization($user_id, $userName, $password, $email, $account_type);
    //$organization->register(["username" => $userName, "password" => $password, "email" => $email]);
    // Create a new NonVirtualEvent instance
    $nonVirtualEvent = new NonVirtualEvent( // Event ID will be auto-generated
        $event_name,
        $description,
        $start_date,
        $end_date,
        $event_type_id,
        $location,
        $volunteers_required,
        $organizers_required,
        $user_id

    );

    // Insert the event into the database
    // Add a volunteer
    $volunteer_id = 2; // Replace with a valid account ID
    $addVolunteerResult = $nonVirtualEvent->add_Volunteer($volunteer_id);

    if ($addVolunteerResult === "success") {
        echo "Volunteer successfully added.\n";
    } elseif ($addVolunteerResult === "maximum_reached") {
        echo "Maximum number of volunteers reached.\n";
    } else {
        echo "Failed to add volunteer.\n";
    }

    // Add an organizer
    $organizer_id = 1; // Replace with a valid account ID
    $addOrganizerResult = $nonVirtualEvent->add_Organizer($organizer_id);

    if ($addOrganizerResult === "success") {
        echo "Organizer successfully added.\n";
    } elseif ($addOrganizerResult === "maximum_reached") {
        echo "Maximum number of organizers reached.\n";
    } else {
        echo "Failed to add organizer.\n";
    }

    // Retrieve current volunteers
    $volunteers = $nonVirtualEvent->getVolunteers($nonVirtualEvent->geteventid());
    echo "Current Volunteers: \n";
    foreach ($volunteers as $volunteer) {
        echo "Volunteer ID: " . $volunteer["account_id"] . "\n";
    }

    // Update volunteers required
    $nonVirtualEvent->set_Volunteers_required(8);
    echo "Updated volunteers required: " . $nonVirtualEvent->get_required_volunteers() . "\n";

    // Remove a volunteer
    $nonVirtualEvent->remove_Volunteer($volunteer_id);
    echo "Volunteer removed.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

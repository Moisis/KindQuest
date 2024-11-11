<?php
require_once "app/models/Events/NonVirtualEvent.php";

// Event and volunteer setup
$eventData = [
    'event_name' => 'Community Cleanup',
    'event_id' => 69, // Use a unique ID for testing
    'desc' => 'A local event for cleaning parks and public areas.',
    'start_date' => '2024-12-01',
    'end_date' => '2024-12-02',
    'sponsored' => false,
    'location' => 'City Park',
    'vol_required' => 5,
    'org_required' => 2,
];

// Initialize NonVirtualEvent
$event = new NonVirtualEvent(
    $eventData['event_name'],
    69,
    $eventData['desc'],
    $eventData['start_date'],
    $eventData['end_date'],
    $eventData['sponsored'],
    $eventData['location'],
    $eventData['vol_required'],
    $eventData['org_required']
);

// Try inserting the event
if ($event->insertNonVirtualEvent()) {
    echo "Event inserted successfully.<br>";
} else {
    echo "Failed to insert event.<br>";
}

$volunteerIds = [1, 7]; // Replace with valid account IDs
foreach ($volunteerIds as $account_id) {
    $event->add_Volunteer($account_id);
    echo "Volunteer with account ID $account_id added.<br>";
}
echo $event->get_currentVolunteers();
// Get and display the volunteers
$volunteers = $event->getVolunteers($eventData['event_id']);
echo "<br>List of Volunteers for Event ID {$eventData['event_id']}:<br>";
if (!empty($volunteers)) {
    foreach ($volunteers as $volunteer) {
        echo "Volunteer Username: " . $volunteer['account_id'] . "<br>"; 
    }
} else {
    echo "No volunteers found for this event.<br>";
}
echo $event->get_currentVolunteers();
$event->remove_Volunteer(7);
// Get and display the updated list of volunteers
$updatedVolunteers = $event->getVolunteers($eventData['event_id']);
echo "<br>Updated List of Volunteers for Event ID {$eventData['event_id']}:<br>";
if (!empty($updatedVolunteers)) {
    foreach ($updatedVolunteers as $volunteer) {
        echo "Volunteer Username: " . $volunteer['account_id'] . "<br>"; 
    }
} else {
    echo "No volunteers found for this event.<br>";
}
echo $event->get_currentVolunteers();

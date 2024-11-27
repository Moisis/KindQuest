<?php
require_once __DIR__ . '/EmailNotifier.php';


class Mailtest {

    function sendMail()
    {
        // Check the request method
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? null; // Determine the action
            $emailNotifier = new EmailNotifier();

            switch ($action) {
                case 'sendDonationReceipt':
                    $donorEmail = $_POST['donorEmail'] ?? null;
                    $donorName = $_POST['donorName'] ?? null;
                    $amount = $_POST['amount'] ?? null;

                    if ($donorEmail && $donorName && $amount) {
                        $emailNotifier->sendDonationReceipt($donorEmail, $donorName, $amount);
                        echo json_encode(['status' => 'success', 'message' => 'Donation receipt sent']);
                    } else {
                        http_response_code(400); // Bad Request
                        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
                    }
                    break;


                case 'sendRandom':
                    $recieverEmail = $_POST['recieverEmail'] ?? null;
                    $recieverName = $_POST['recieverName'] ?? null;
                    $subject = $_POST['subject'] ?? null;
                    $title = $_POST['title'] ?? null;
                    $message = $_POST['message'] ?? null;

                    if ($recieverEmail && $recieverName && $subject && $title && $message) {
                        $emailNotifier->sendmessage($recieverEmail ,$recieverName , $subject  , $title , $message);
                        echo json_encode(['status' => 'success', 'message' => 'Event invitation sent']);
                    } else {
                        http_response_code(400); // Bad Request
                        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
                    }
                    break;

                default:
                    http_response_code(404); // Not Found
                    echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            }
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }


    }




}


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>KindQuest | Create Event </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CRoboto:400%7CRubik:100,400,700">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/style.css">
    <script>
        function controlInputs(){
            const event_type = document.getElementById("event_type_id");
            const event_goal_field = document.getElementById("event_goal");
            const event_location_field = document.getElementById("event_location");
            const event_vol_req_field = document.getElementById("vol_req");
            const event_org_req_field = document.getElementById("org_req");            
            console.log("Event type is ",event_type.value);
            if(event_type.value == "1"){
                //show Fundraiser Stuff
                event_goal_field.style.display = "block";
                event_location_field.style.display = "none";
                event_vol_req_field.style.display = "none";                
                event_org_req_field.style.display = "none";
            }
            else if(event_type.value == "2"){
                //show Non-Virtual Stuff
                event_goal_field.style.display = "none";
                event_location_field.style.display = "block";
                event_vol_req_field.style.display = "block";                
                event_org_req_field.style.display = "block";                
            }
        }

        function hideSpecificInputs(){
            const event_goal_field = document.getElementById("event_goal");
            const event_location_field = document.getElementById("event_location");
            const event_vol_req_field = document.getElementById("vol_req");
            const event_org_req_field = document.getElementById("org_req");      
            event_goal_field.style.display = "none";
            event_location_field.style.display = "none";
            event_vol_req_field.style.display = "none";                
            event_org_req_field.style.display = "none";        
        }
    </script>
</head>

<body onload = "hideSpecificInputs()">
<div class="preloader">
    <div class="preloader-body">
        <div class="cssload-container">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
    </div>
</div>
<div class="page">
    <!-- Page Header-->
    <?php require dirname(__DIR__) . "/views/commonParts/navbar.php"; ?>


    <section class="parallax-container" data-parallax-img="images/about/bg-breadcrumbs-about.jpg">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <h2 class="breadcrumbs-custom-title">Create Event </h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="/">Event </a></li>
                            <li class="active">Create Event </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Creation Form -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">Create Event</h3>
        <form method="POST" action="/event/create">
            <!-- Event Type -->

            <div class="form-wrap">
                <label class="form-label" for="user-event_type_id" hidden>I want to create a :</label>
                <select class="form-input" id="event_type_id" name="event_type_id" data-constraints="@Required" onchange="controlInputs()">
                    <option value="" selected disabled>Select event type</option>
                    <option value="1">Fundraising</option>
                    <option value="2">Non-Virtual Event</option>
                </select>
            </div>

            <!-- Event Name -->
            <div class="mb-3">
                <label for="event_name" class="form-label">Event Name</label>
                <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Enter event name" required>
            </div>

            <!-- Event Description -->
            <div class="mb-3">
                <label for="event_description" class="form-label">Event Description</label>
                <textarea class="form-control" id="event_description" name="event_description" rows="3" placeholder="Enter event description" required></textarea>
            </div>

            <!-- Start Date -->
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <!-- End Date -->
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>

            <!-- Event Goal -->
            <div class="mb-3">
                <label for="event_goal" class="form-label">Event Goal</label>
                <input type="number" class="form-control" id="event_goal" name="event_goal" placeholder="Enter event goal amount">
            </div>

            <!-- Event Location -->
            <div class="mb-3">
                <label for="event_location" class="form-label">Location</label>
                <input type="text" class="form-control" id="event_location" name="event_location" placeholder="Enter event location">
            </div>

            <!-- Volunteers Required -->
            <div class="mb-3">
                <label for="vol_req" class="form-label">Volunteers Required</label>
                <input type="number" class="form-control" id="vol_req" name="vol_req" placeholder="Volunteers Required">
            </div>

            <!-- Organizers Required -->
            <div class="mb-3">
                <label for="org_req" class="form-label">Organizers Required</label>
                <input type="number" class="form-control" id="org_req" name="org_req" placeholder="Organizers">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary mb-2">Create Event</button>
            </div>
        </form>
    </div>





    <!-- Footer -->
    <?php require_once dirname(__DIR__) . "/views/commonParts/footer.php"; ?>

</div>
<div class="snackbars" id="form-output-global"></div>

<script src="/js/core.min.js"></script>
<script src="/js/script.js"></script>
</body>

</html>

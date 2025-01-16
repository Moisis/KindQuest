<?php

// admin
require_once __DIR__ . '/../app/controllers/admin/AdminController.php';
require_once __DIR__ . '/../app/controllers/admin/AdminUsersController.php';

require_once __DIR__ . '/../app/controllers/admin/AdminEventsController.php';


require_once __DIR__ . '/../app/controllers/AboutController.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';

//Events
require_once __DIR__ . '/../app/controllers/EventController.php';
require_once __DIR__ . '/../app/controllers/EventCreationController.php';
require_once __DIR__ . '/../app/controllers/EventDetailsController.php';

require_once __DIR__ . '/../app/controllers/ProfileController.php';
require_once __DIR__ . '/../app/controllers/ErrorController.php';

//Donation
require_once __DIR__ . '/../app/controllers/Donation/DonationController.php';
require_once __DIR__ . '/../app/controllers/Donation/DonationProcess.php';

//Auth
require_once __DIR__ . '/../app/controllers/Auth/RegisterController.php';
require_once __DIR__ . '/../app/controllers/Auth/LoginController.php';



//Email

require_once __DIR__ . '/../app/models/Email/mailtest.php';

// wizard
//require_once __DIR__ . '/../app/controllers/wizard/WizardController.php';

// Merch
require_once __DIR__ . '/../app/controllers/Merch/MerchController.php';
require_once __DIR__ . '/../app/controllers/Merch/MerchDetailsController.php';


// ErrorController
require_once __DIR__ . '/../app/controllers/ErrorController.php';



class Router {
    public function route($url) {
        
        global $configs;
        foreach ($configs->ROUTES as $route => $handler) {
            $pattern = $this->buildPattern($route);
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); // Remove full match
                $this->invokeControllerAction($handler, $matches);
                return;
            }
        }

        $this->invokeControllerAction('ErrorController@index', []);
    }

    private function buildPattern($route) {
        return '#^' . preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route) . '$#';
    }

    private function invokeControllerAction($handler, $params) {
        list($controllerName, $action) = explode('@', $handler);
        $controller = new $controllerName();
        $this->callControllerAction($controller, $action, $params);
    }

    private function callControllerAction($controller, $action, $params) {
        $reflectionMethod = new ReflectionMethod($controller, $action);
        $resolvedParams = [];

        foreach ($reflectionMethod->getParameters() as $param) {
            $resolvedParams[] = $params[$param->getName()] ?? null;
        }

        $reflectionMethod->invokeArgs($controller, $resolvedParams);
    }
}
?>

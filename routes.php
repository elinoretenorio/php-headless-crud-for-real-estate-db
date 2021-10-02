<?php

declare(strict_types=1);

$router->get("/admin", "RealEstate\Admin\AdminController::getAll");
$router->post("/admin", "RealEstate\Admin\AdminController::insert");
$router->group("/admin", function ($router) {
    $router->get("/{admin_id:number}", "RealEstate\Admin\AdminController::get");
    $router->post("/{admin_id:number}", "RealEstate\Admin\AdminController::update");
    $router->delete("/{admin_id:number}", "RealEstate\Admin\AdminController::delete");
});

$router->get("/agents", "RealEstate\Agents\AgentsController::getAll");
$router->post("/agents", "RealEstate\Agents\AgentsController::insert");
$router->group("/agents", function ($router) {
    $router->get("/{agent_id:number}", "RealEstate\Agents\AgentsController::get");
    $router->post("/{agent_id:number}", "RealEstate\Agents\AgentsController::update");
    $router->delete("/{agent_id:number}", "RealEstate\Agents\AgentsController::delete");
});

$router->get("/appointments", "RealEstate\Appointments\AppointmentsController::getAll");
$router->post("/appointments", "RealEstate\Appointments\AppointmentsController::insert");
$router->group("/appointments", function ($router) {
    $router->get("/{appointment_id:number}", "RealEstate\Appointments\AppointmentsController::get");
    $router->post("/{appointment_id:number}", "RealEstate\Appointments\AppointmentsController::update");
    $router->delete("/{appointment_id:number}", "RealEstate\Appointments\AppointmentsController::delete");
});

$router->get("/clients", "RealEstate\Clients\ClientsController::getAll");
$router->post("/clients", "RealEstate\Clients\ClientsController::insert");
$router->group("/clients", function ($router) {
    $router->get("/{client_id:number}", "RealEstate\Clients\ClientsController::get");
    $router->post("/{client_id:number}", "RealEstate\Clients\ClientsController::update");
    $router->delete("/{client_id:number}", "RealEstate\Clients\ClientsController::delete");
});

$router->get("/comments", "RealEstate\Comments\CommentsController::getAll");
$router->post("/comments", "RealEstate\Comments\CommentsController::insert");
$router->group("/comments", function ($router) {
    $router->get("/{comment_id:number}", "RealEstate\Comments\CommentsController::get");
    $router->post("/{comment_id:number}", "RealEstate\Comments\CommentsController::update");
    $router->delete("/{comment_id:number}", "RealEstate\Comments\CommentsController::delete");
});

$router->get("/notifications", "RealEstate\Notifications\NotificationsController::getAll");
$router->post("/notifications", "RealEstate\Notifications\NotificationsController::insert");
$router->group("/notifications", function ($router) {
    $router->get("/{notification_id:number}", "RealEstate\Notifications\NotificationsController::get");
    $router->post("/{notification_id:number}", "RealEstate\Notifications\NotificationsController::update");
    $router->delete("/{notification_id:number}", "RealEstate\Notifications\NotificationsController::delete");
});

$router->get("/properties", "RealEstate\Properties\PropertiesController::getAll");
$router->post("/properties", "RealEstate\Properties\PropertiesController::insert");
$router->group("/properties", function ($router) {
    $router->get("/{property_id:number}", "RealEstate\Properties\PropertiesController::get");
    $router->post("/{property_id:number}", "RealEstate\Properties\PropertiesController::update");
    $router->delete("/{property_id:number}", "RealEstate\Properties\PropertiesController::delete");
});

$router->get("/property-images", "RealEstate\PropertyImages\PropertyImagesController::getAll");
$router->post("/property-images", "RealEstate\PropertyImages\PropertyImagesController::insert");
$router->group("/property-images", function ($router) {
    $router->get("/{property_image_id:number}", "RealEstate\PropertyImages\PropertyImagesController::get");
    $router->post("/{property_image_id:number}", "RealEstate\PropertyImages\PropertyImagesController::update");
    $router->delete("/{property_image_id:number}", "RealEstate\PropertyImages\PropertyImagesController::delete");
});


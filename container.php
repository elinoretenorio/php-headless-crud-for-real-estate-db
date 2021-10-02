<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", RealEstate\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Admin

$container->add("AdminRepository", RealEstate\Admin\AdminRepository::class)
    ->addArgument("Database");
$container->add("AdminService", RealEstate\Admin\AdminService::class)
    ->addArgument("AdminRepository");
$container->add(RealEstate\Admin\AdminController::class)
    ->addArgument("AdminService");

// Agents

$container->add("AgentsRepository", RealEstate\Agents\AgentsRepository::class)
    ->addArgument("Database");
$container->add("AgentsService", RealEstate\Agents\AgentsService::class)
    ->addArgument("AgentsRepository");
$container->add(RealEstate\Agents\AgentsController::class)
    ->addArgument("AgentsService");

// Appointments

$container->add("AppointmentsRepository", RealEstate\Appointments\AppointmentsRepository::class)
    ->addArgument("Database");
$container->add("AppointmentsService", RealEstate\Appointments\AppointmentsService::class)
    ->addArgument("AppointmentsRepository");
$container->add(RealEstate\Appointments\AppointmentsController::class)
    ->addArgument("AppointmentsService");

// Clients

$container->add("ClientsRepository", RealEstate\Clients\ClientsRepository::class)
    ->addArgument("Database");
$container->add("ClientsService", RealEstate\Clients\ClientsService::class)
    ->addArgument("ClientsRepository");
$container->add(RealEstate\Clients\ClientsController::class)
    ->addArgument("ClientsService");

// Comments

$container->add("CommentsRepository", RealEstate\Comments\CommentsRepository::class)
    ->addArgument("Database");
$container->add("CommentsService", RealEstate\Comments\CommentsService::class)
    ->addArgument("CommentsRepository");
$container->add(RealEstate\Comments\CommentsController::class)
    ->addArgument("CommentsService");

// Notifications

$container->add("NotificationsRepository", RealEstate\Notifications\NotificationsRepository::class)
    ->addArgument("Database");
$container->add("NotificationsService", RealEstate\Notifications\NotificationsService::class)
    ->addArgument("NotificationsRepository");
$container->add(RealEstate\Notifications\NotificationsController::class)
    ->addArgument("NotificationsService");

// Properties

$container->add("PropertiesRepository", RealEstate\Properties\PropertiesRepository::class)
    ->addArgument("Database");
$container->add("PropertiesService", RealEstate\Properties\PropertiesService::class)
    ->addArgument("PropertiesRepository");
$container->add(RealEstate\Properties\PropertiesController::class)
    ->addArgument("PropertiesService");

// PropertyImages

$container->add("PropertyImagesRepository", RealEstate\PropertyImages\PropertyImagesRepository::class)
    ->addArgument("Database");
$container->add("PropertyImagesService", RealEstate\PropertyImages\PropertyImagesService::class)
    ->addArgument("PropertyImagesRepository");
$container->add(RealEstate\PropertyImages\PropertyImagesController::class)
    ->addArgument("PropertyImagesService");


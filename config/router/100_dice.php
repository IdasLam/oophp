<?php
/**
 * Dice controller.
 */
return [
    // Path where to mount the routes, is added to each route path.
    // "mount" => "sample",

    // All routes in order
    "routes" => [
        [
            "info" => "Dice controller.",
            "mount" => "dice100",
            "handler" => "\Ida\Dice\DiceController",
        ],
    ]
];

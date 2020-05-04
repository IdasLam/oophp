<?php
/**
 * Page for kmom06
 */
return [
    // Path where to mount the routes, is added to each route path.
    // "mount" => "sample",

    // All routes in order
    "routes" => [
        [
            "info" => "kmom06",
            "mount" => "overview",
            "handler" => "\Ida\Overview\OverviewController",
        ],
    ]
];

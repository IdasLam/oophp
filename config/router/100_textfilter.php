<?php
/**
 * textfilter view
 */
return [
    // Path where to mount the routes, is added to each route path.
    // "mount" => "sample",

    // All routes in order
    "routes" => [
        [
            "info" => "textfilter",
            "mount" => "textfilter",
            "handler" => "\Ida\TextFilter\TextfilterController",
        ],
    ]
];

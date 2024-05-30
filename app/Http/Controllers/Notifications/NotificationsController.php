<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Charges;
use App\Models\Notifications;
use DateTime;

class NotificationsController extends Controller
{
    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function getNotificationsData()
    {
        // For the sake of simplicity, assume we have a variable called
        // $notifications with the unread notifications. Each notification
        // have the next properties:
        // icon: An icon for the notification.
        // text: A text for the notification.
        // time: The time since notification was created on the server.
        // At next, we define a hardcoded variable with the explained format,
        // but you can assume this data comes from a database query.

        $notifications = Notifications::whereDate('created_at', date('Y-m-d'))->get();

        // Now, we create the notification dropdown main content.

        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            $icon = '<i class="mr-2 fa-regular fa-circle-info text-primary"></i>';

            $origin = new DateTime($not['created_at']);
            $target = new DateTime('now');
            $interval = $origin->diff($target);
            $time =  $interval->format('%R%a dias');

            $time = "<span class='float-right text-muted text-sm'>
                   {$time}
                 </span>";

            $dropdownHtml .= "<a href='#' class='dropdown-item'>
                            {$icon}{$not['title']}{$time}
                          </a>";

            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }
        //TODO: conituar a desenvolver futuramente
        // Return the new notification data.

        return [
            'label' => count($notifications),
            'dropdown' => $dropdownHtml,
        ];
    }
}

<?php
require '../vendor/autoload.php';

use Carbon\Carbon;

const DATE_FORMAT = 'd/m/Y';
const TIME_FORMAT = 'H:i:s';

Carbon::setWeekStartsAt(Carbon::SATURDAY);

$user = [
    "workHours" => [
        ["from" => "08:00:00", "to" => "16:00:00"],
        ["from" => "08:00:00", "to" => "16:00:00"],

        ["from" => "08:00:00", "to" => "16:00:00"],
        ["from" => "08:00:00", "to" => "16:00:00"],

        ["from" => "08:00:00", "to" => "16:00:00"],
        ["from" => "08:00:00", "to" => "16:00:00"],
        ["from" => "08:00:00", "to" => "16:00:00"],
        ["from" => "08:00:00", "to" => "16:00:00"],

        ["from" => "08:00:00", "to" => "16:00:00"],
    ],
    "sessions" => [
        [
            "date" => "17/6/2017", "status" => "approved",
            "from" => "09:00:00", "end" => "11:00:00",
        ],
        [
            "date" => "17/6/2017", "status" => "new",
            "from" => "12:00:00", "end" => "02:00:00",
        ],
    ],
];

function freeAt($user, $newSession)
{
    $date = Carbon::createFromFormat(DATE_FORMAT, ($newSession['date']));
    $index = ($date->dayOfWeek) % 6;
    $withinWorkHrs = !empty($user['workHours'][$index]) &&
        (Carbon::createFromFormat(TIME_FORMAT, ($newSession['from']))->between(
                Carbon::createFromFormat(TIME_FORMAT, ($user['workHours'][$index]['from']))->subMinutes(30),
                Carbon::createFromFormat(TIME_FORMAT, ($user['workHours'][$index]['to']))->addMinutes(30)) &&
            Carbon::createFromFormat(TIME_FORMAT, ($newSession['end']))->between(
                Carbon::createFromFormat(TIME_FORMAT, ($user['workHours'][$index]['from']))->subMinutes(30),
                Carbon::createFromFormat(TIME_FORMAT, ($user['workHours'][$index]['to']))->addMinutes(30)
            ));


    if (!$withinWorkHrs) return false;

    return collect($user['sessions'])->filter(function ($item) use ($date) {
        return $item['status'] != 'new' &&
            (Carbon::createFromFormat(DATE_FORMAT, ($item['date']))
                ->eq($date));
    })->pipe(function ($result) use ($newSession) {
        return $result->isEmpty() ? true : $result->filter(function ($item) use ($newSession) {
            return
                !(Carbon::createFromFormat(TIME_FORMAT, ($newSession['from']))->between(
                        Carbon::createFromFormat(TIME_FORMAT, ($item['from']))->subMinutes(30),
                        Carbon::createFromFormat(TIME_FORMAT, ($item['end']))->addMinutes(30)) &&
                    Carbon::createFromFormat(TIME_FORMAT, ($newSession['end']))->between(
                        Carbon::createFromFormat(TIME_FORMAT, ($item['from']))->subMinutes(30),
                        Carbon::createFromFormat(TIME_FORMAT, ($item['end']))->addMinutes(30)
                    ));
        });
    })->isEmpty();
}

var_dump(freeAt($user, [
    "date" => "17/6/2017", "status" => "new",
    "from" => "10:30:00", "end" => "11:00:00",
]));
<?php

namespace App\Traits;

use App\Reservation;

trait ReservationTrait
{
    public static function getAllData()
    {
        $black_list = env("BLACK_LIST_USERID_FOR_SEGMENT_COUNT");
        $black_list = explode(',', $black_list);
		$black_list = implode(",",$black_list);
		dd($black_list);
        $all_reservation = Reservation::where("is_confirmed", 1)->get();
        return $all_reservation;
        //return self::getFlightSegmentCount($all_reservation, $black_list);
    }
    public static function getFlightSegmentCount($all_reservation, $black_list)
    {
        if (!is_null($all_reservation)) {
            $sum = 0;
            foreach ($all_reservation as $reservation) {
                if (!in_array($reservation->user_id, $black_list)) {
                    print_r($reservation->user_id." ");
                    $data = json_decode($reservation->data);
                    if (is_object($data)) {
                        if (isset($data->departing_flight_segments)) {
                            if (is_array($data->departing_flight_segments)) {
                                if (isset($data->returning_flight_segments)) {
                                    $sum = $sum + count($data->departing_flight_segments) + count($data->returning_flight_segments);
                                } else {
                                    $sum = $sum + count($data->departing_flight_segments);
                                }
                            } else {
                                return 0;
                            }
                        } else {
                            return 0;
                        }
                    } else {
                        return 0;
                    }
                } else {
                    continue;
                }
            }
            return $sum;
        } else {
            return 0;
        }
    }
}

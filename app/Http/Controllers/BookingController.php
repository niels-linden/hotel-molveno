<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Roomtype;

class BookingController extends Controller
{
    public function index()
    {
        return view("booking.step1");
    }

    public function step2()
    {
        $data = [
            "check_in" => request()->get("check_in"),
            "check_out" => request()->get("check_out"),
            "adults" => request()->get("adults"),
            "children" => request()->get("children"),
            "room_amount" => request()->get("room_amount"),
        ];
        $rooms = Room::getAvailableRooms($data);
        $roomTypes = Roomtype::all();

        if ($data["room_amount"] > $rooms->count()) {
            return redirect()
                ->back()
                ->with(
                    "error",
                    "There are not enough rooms available on this date."
                );
        } else {
            return view("booking.step2", compact("rooms", "roomTypes", "data"));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function step3(Request $request)
    {
        $data = [
            "check_in" => request()->get("check_in"),
            "check_out" => request()->get("check_out"),
            "adults" => request()->get("adults"),
            "children" => request()->get("children"),
            "room_amount" => request()->get("room_amount"),
        ];

        $roomTypes = Roomtype::all();
        $i = 1;
        $roomTypesArr = [];
        $roomTypeKeys = [];
        foreach ($roomTypes as $roomTypeAmount) {
            array_push($roomTypeKeys, $i);
            array_push($roomTypesArr, request()->get("room_type" . $i++));
        }
        $roomTypesKeyValue = array_combine($roomTypeKeys, $roomTypesArr);

        $rooms = Room::getAvailableRooms($data);

        $rooms1 = collect($rooms->get());
        $rooms2 = collect();

        foreach ($roomTypesKeyValue as $key => $value) {
            if ($value > 0) {
                $rooms2->push(
                    $rooms1->where("roomtype_id", $key)->take($value)
                );
            }
        }

        $roomIDsToBook = [];
        foreach ($rooms2 as $room2) {
            foreach ($room2 as $room) {
                array_push($roomIDsToBook, $room->id);
            }
        }

        $roomsToBook = Room::whereIn("id", $roomIDsToBook);

        dd($roomsToBook->get());

        return view("booking.step3", compact("data"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

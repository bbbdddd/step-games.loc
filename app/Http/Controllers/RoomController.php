<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
    $rooms = Room::all();

    return response()->json($rooms, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(Request $request)
    {
        $name = $request->get('name');
        $capacity = $request->get('capacity');
        $type = $request->get('type');
        $user_id = auth()->user()->id;
        $user_id_room = $request->get('user_id');
        $name_room = $request->get('name');
        if (Hash::check($user_id_room,$name_room)) {
            return new \HttpException("У вас уже есть комната", 400);
        }
        else {return Room::create([
            'name' => $name,
            'capacity' => $capacity,
            'type' => $type,
            'user_id' => $user_id]);
        }

    }*/

    public function store(Request $request)
    {
        $name = $request->get('name');
        $capacity=$request->get('capacity');
        $type=$request->get('type');
        $user_id=auth()->user()->id;
        $existingRoom = Room::where('user_id', $user_id)->first(); //используется для выполнения запроса к базе данных с целью проверки наличия комнаты для конкретного пользователя


        if ($existingRoom) {
            return response()->json(['message' => 'У вас уже есть комната'], 400);
        }
        else {
            $newRoom = Room::create([
                'name' => $name,
                'capacity' => $capacity,
                'type' => $type,
                'user_id' => $user_id
            ]);

            return response()->json($newRoom, 201); // Возвращаем созданную комнату с кодом 201 (Created)
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Room::find($id);
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
        //$room = Room::find($id);
        //$room->delete();
       return Room::where('id', $id)->delete();
    }


}

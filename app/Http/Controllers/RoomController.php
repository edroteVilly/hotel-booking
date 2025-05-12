<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Forbidden');
        }
    
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Forbidden');
        }
        return view('rooms.create');

    }
    
    public function store(Request $request)
    {
        // Set the available value to true (1) if the checkbox is checked, false (0) if unchecked
        $available = $request->has('available') ? 1 : 0;
    
        // Validate the request
        $request->validate([
            'room_number' => 'required|unique:rooms',
            'type' => 'required',
            'price' => 'required|numeric',
            'available' => 'in:0,1',  // Accept 0 or 1
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
    
        // Handle the image upload if it exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('rooms', 'public');
        }
    
        // Save the room data
        Room::create([
            'room_number' => $request->room_number,
            'type' => $request->type,
            'price' => $request->price,
            'available' => $request->available,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('rooms.index')->with('success', 'Room created successfully!');
    }
    

    
    
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::findOrFail($id);

        return view('rooms.show', compact('room'));

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'type' => 'required',
            'price' => 'required|numeric',
        ]);
    
        $validated['available'] = $request->has('available');
    
        $room->update($validated);
    
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
    
        return redirect()->route('rooms.index')->with('success', 'Room deleted.');
    }
    
}

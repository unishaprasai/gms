<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\classes;
use App\Models\Trainers;
use Illuminate\Http\Request;


class ClassController extends Controller
{    
    public function index(){
        return view('backend.add_class');
    }
    public function addClass(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'ClassName' => 'required|string',
            'trainerid' => 'required|exists:trainers,id',
            'shift' => 'required|string',
            'class_time' => 'required|string',
            'venue' => 'required|string',
        ]);

    
        // Create a new instance of the GymClassroom model and fill it with validated data
        $classroom = new Classes;
        $classroom->fill($validatedData);
        $classroom->trainersid = $request->input('trainerid'); // Set trainersid explicitly

        $classroom->save();
    
        return redirect()->back()->with('success', 'Class added successfully!');
    }
    
    public function view_class(){
        $classes = Classes::with('trainer')->get();

        return view('backend.view_class', ['classes' => $classes]);
    }

    public function delete_class($id)
{
    // Find the trainer by ID
    $classroom= Classes::find($id);

    if (!$classroom) {
        // Class not found, you may want to handle this case differently (e.g., show error message)
        return redirect()->back()->with('error', 'Class not found!');
    }

    // Delete the trainer
    $classroom->delete();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Class deleted successfully!');
}

public function edit_class($id)
{
    $class = Classes::findOrFail($id); // Retrieve the class by ID
    $trainers = Trainers::pluck('trainer_name', 'id'); 

    return view('backend.edit_class', compact('class', 'trainers'));
}

public function update_class(Request $request, $id)
{
    $validatedData = $request->validate([
        'ClassName' => 'required|string|max:255',
        'trainerid' => 'required|exists:trainers,id',
        'shift' => 'required|string|in:Morning,Afternoon,Evening,Night',
        'class_time' => 'required|string',
        'venue' => 'required|string|max:255',
    ]);

    // Find the class by ID
    $class = Classes::findOrFail($id);

    // Update class attributes with validated data
    $class->ClassName = $validatedData['ClassName'];
    $class->trainersid = $validatedData['trainerid'];
    $class->shift = $validatedData['shift'];
    $class->class_time = $validatedData['class_time'];
    $class->venue = $validatedData['venue'];


    // Save the updated class
    $class->save();

    return redirect()->back()->with('success', 'Trainer updated successfully!');
}

}

<?php

namespace App\Http\Controllers;

use App\Models\DairyTask;

use Illuminate\Http\Request;
use App\Http\Requests\DairyTaskRequest;
use App\Http\Resources\DairyResource;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class DairyTaskController extends Controller
{
    use HttpResponses;

    // Create a new thought

    public function store(DairyTaskRequest $request){
        $request->validated($request->all());

        $thought = DairyTask::create(
            [
                'user_id'=>$request->user_id,
                'date'=>$request->date,
                'thoughts'=>$request->thoughts,
            ]
        );

        return new DairyResource($thought);
    }

    // display all thoughts

    public function index(){
        return DairyResource::collection(
            DairyTask::where('user_id',Auth::user()->id)->get()
        );
    }

    // Display a particular thought

    public function show(DairyTask $thought){
        if(Auth::user()->id != $thought->user_id){
            return $this->authError('','Unauthorized','401');
        }
        return new DairyResource($thought);
    }

    // Delete the thought

    public function destroy(DairyTask $thought){
        $thought->delete();
        return response([504,null]);
    }

    // Modify the thought

    public function update(Request $request,DairyTask $thought){
        // $request->validated($request->all());

        $thought->update($request->all());

        return new DairyResource($thought);
    }
}

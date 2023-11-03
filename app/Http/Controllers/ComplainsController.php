<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complain;

class ComplainsController extends Controller
{
    public function index(Request $request)
    {
        $complains = Complain::with('tenant')->get();
        // dd($rents);
        return view('admin.complains.index', compact('complains'));
    }

    public function destroy_rent($id)
    {
        $complain = Complain::where('id', $id)->first();
        $filePath = 'public/images/complains/' . $complain->image; // $filename is the name of the file you saved

        // logger($filePath);
        // Check if the file exists
        if (Storage::exists($filePath)) {
            // Delete the file
            Storage::delete($filePath);
        }
        $complain->delete();
        return back()->with(['success' => 'Complain Deleted Successfully'], 200);
    }


    public function settle_complain(Request $request){
        if ($request->ajax()) {
            $complain_id = $request->input('id');

            $complain= Complain::where('id', $complain_id)->latest('created_at')->first();

            $complain->status = "settled";
            $complain->save();
            $res = [
                'message'=> "complain settled"
            ];
            return json_encode($res);
        }
    }
}

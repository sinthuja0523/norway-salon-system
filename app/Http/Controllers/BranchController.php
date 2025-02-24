<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $bookings = DB::table('branches')->get();
        // dd($bookings);
        return view('admin.pages.branches',compact('bookings'));
    }

    public function storeBranch(Request $request)
    {
        $request->validate([
            'branch_name' => 'required',
            // 'branch_description' => 'required',
            'branch_address' => 'required',
            'office_number' => 'required',
        ]);

        $branch = new Branch();
        $branch->branch_name = $request->branch_name;
        $branch->branch_address = $request->branch_address;
        $branch->office_number = $request->office_number;
        $branch->save();

        return response()->json(['success' => 'Branch added successfully!']);
    }

    public function editBranch($id){
        \Log::info('Edit branch function loaded');
        $data = Branch::findOrFail($id);
        return response()->json(['data' => $data]);
    }

    public function updateBranch(Request $request, $id){
        \Log::info('Update branch function loaded');
        \Log::info($request->all());
        $branch = Branch::find($id);
        $branch->branch_name = $request->branch_name;
        $branch->branch_address = $request->branch_address;
        $branch->office_number = $request->office_number;
        $branch->save();
    }

    public function deleleBranch($id){
        $data = Branch::find($id);
        $data->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}

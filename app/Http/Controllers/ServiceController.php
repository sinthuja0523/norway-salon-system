<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $bookings = DB::table('services')->get();
        // dd($bookings);
        return view('admin.pages.services',compact('bookings'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
            // 'service_description' => 'required',
            'service_price' => 'required',
        ]);

        $service = new Service();
        $service->service_name = $request->service_name;
        $service->service_description = $request->service_description;
        $service->service_price = $request->service_price;
        $service->save();

        return response()->json(['success' => 'Service added successfully!']);
    }

    public function editService($id){
        \Log::info('Edit service function loaded');
        $data = Service::findOrFail($id);
        return response()->json(['data' => $data]);
    }

    public function updateService(Request $request, $id){
        \Log::info('Update service function loaded');
        \Log::info($request->all());
        $data = Service::find($id);
        $data->service_name = $request->service_name;
        $data->service_description = $request->service_description;
        $data->service_price = $request->service_price;
        $data->save();
    }

    public function deleleService($id){
        $data = Service::find($id);
        $data->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}

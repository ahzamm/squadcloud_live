<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\SubMenu;
use App\Models\UserMenuAccess;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\Clients\{ViewClientRequest, CreateClientRequest, StoreClientRequest, EditClientRequest, UpdateClientRequest, DeleteClientRequest};
use Auth;

class ClientController extends Controller
{
    public function index(ViewClientRequest $request)
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function create(CreateClientRequest $request)
    {
        return view('admin.clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        $filename = '';
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/clients'), $filename);
        }

        $maxSortId = Client::max('sortIds');
        $client = new Client();
        $client->logo = $filename;
        $client->link = $request['link'];
        $client->title = $request['title'];
        $client->description = $request['description'];
        $client->is_active = $request->has('is_active') ? 1 : 0;
        $client->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client Added successfully');
    }

    public function show($id)
    {
        $packageData = Client::find($id);
        return view('admin.clients.show-modal', compact('packageData'));
    }

    public function edit(EditClientRequest $request, $id)
    {
        $client = Client::find($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);

        if ($request->hasFile('logo')) {
            if ($client->logo && file_exists(public_path('frontend_assets/images/clients/' . $client->logo))) {
                unlink(public_path('frontend_assets/images/clients/' . $client->logo));
            }
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('frontend_assets/images/clients'), $filename);
            $client->logo = $filename;
        }

        $client->title = $request['title'];
        $client->description = $request['description'];
        $client->link = $request['link'];
        $client->is_active = $request->has('is_active') ? 1 : 0;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }

    public function destroy(DeleteClientRequest $request, $id = null)
    {
        $client = Client::find($id);
        if ($client) {
            $imagePath = public_path('frontend_assets/images/clients/' . $client->logo);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $client->delete();

            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'message' => 'Client not found.']);
        }
    }

    public function updateSorting(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $menu = Client::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = Client::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }

    public function change_status(EditClientRequest $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = Client::where('id', $id)->update(['is_active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResourcesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ResourcesController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ResourcesModel::getRecord();
        $data['header_title'] = "Church Resources";

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.resources.list', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.resources.list', $data);
            }
        }
    }
    public function add()
    {
        $data['header_title'] = "Add Church Resources";
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.resources.add', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.resources.add', $data);
            }
        }
    }
    public function insert(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'file_image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'document' => 'required|file|mimes:pdf,doc,docx',
            'description' => 'nullable|string|max:250',
        ]);

        $resources = new ResourcesModel();
        $resources->file_name = $request->file_name;
        $resources->document = $request->document;
        $resources->description = $request->description;

        if ($request->hasFile('file_image')) {
            $file = $request->file('file_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/resources/', $filename);
            $resources->file_image = $filename;
        }

        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $originalFilename = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = $document->getClientOriginalExtension();
            $sanitizedFilename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalFilename);
            $documentFilename = strtolower($sanitizedFilename . '_' . time() . '.' . $ext);
            $document->move('upload/resources/documents/', $documentFilename);
            $resources->document = $documentFilename;
        }

        $resources->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/church_resources/list')->with('success', 'File Added Successfully');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/church_resources/list')->with('success', 'File Added Successfully');
            }
        }
    }
    public function edit($id)
    {
        $resource = ResourcesModel::findOrFail($id);
        $data['resource'] = $resource;
        $data['header_title'] = "Edit Church Resources";

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.resources.edit', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.resources.edit', $data);
            }
        }
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'file_name' => 'required|string|max:255',
            'file_image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'description' => 'nullable|string|max:250',
        ]);

        $resources = ResourcesModel::findOrFail($id);
        $resources->file_name = $request->file_name;
        $resources->description = $request->description;

        // Handle file_image upload
        if ($request->hasFile('file_image')) {
            // Delete the old image if it exists
            if ($resources->file_image) {
                @unlink(public_path('upload/resources/' . $resources->file_image));
            }
            $file = $request->file('file_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/resources/', $filename);
            $resources->file_image = $filename;
        }
        // Handle document upload
        if ($request->hasFile('document')) {
            // Delete the old document if it exists
            if ($resources->document) {
                @unlink(public_path('upload/resources/documents/' . $resources->document));
            }
            $document = $request->file('document');
            $originalFilename = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = $document->getClientOriginalExtension();
            $sanitizedFilename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalFilename);
            $documentFilename = strtolower($sanitizedFilename . '_' . time() . '.' . $ext);
            $document->move('upload/resources/documents/', $documentFilename);
            $resources->document = $documentFilename;
        }
        $resources->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/church_resources/list')->with('success', 'File successfully updated.');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/church_resources/list')->with('success', 'File successfully updated.');
            }
        }
    }
    public function delete($id)
    {
        $resource = ResourcesModel::findOrFail($id);
        $resource->is_delete = 1;
        $resource->save();

        return redirect()->back()->with('success', 'File Deleted Successfully');
    }
}

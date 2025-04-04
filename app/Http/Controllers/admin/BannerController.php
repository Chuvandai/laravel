<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1'
        ]);

        $path = public_path('images/banners');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $imageName = time().'.'.$request->image->extension();
        $request->image->move($path, $imageName);

        Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'images/banners/' . $imageName,
            'status' => $request->status
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Thêm banner thành công');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1'
        ]);

        $banner = Banner::findOrFail($id);
        
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ];

        if ($request->hasFile('image')) {
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }
            
            $path = public_path('images/banners');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->move($path, $imageName);
            $data['image'] = 'images/banners/' . $imageName;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Cập nhật banner thành công');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        
        if ($banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }
        
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Xóa banner thành công');
    }
}
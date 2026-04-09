<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Storage;


class TourController extends Controller
{

    public function index(Request $request) {
        $query = Tour::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $tours = $query->get();
        return view('tour.list', compact('tours'));
    }

    public function create() {
        return view('tour.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'slots' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'itinerary' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tours', 'public');
        }

        Tour::create($data);
        return redirect('/')->with('success', 'Tour đã được thêm!');
    }

    public function edit($id) {
        $tour = Tour::find($id);
        return view('tour.edit', compact('tour'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'slots' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'itinerary' => 'nullable|string',
        ]);

        $tour = Tour::find($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($tour->image) {
                Storage::disk('public')->delete($tour->image);
            }
            $data['image'] = $request->file('image')->store('tours', 'public');
        }

        $tour->update($data);
        return redirect('/')->with('success', 'Tour đã được cập nhật!');
    }

    public function delete($id) {
        Tour::destroy($id);
        return redirect('/')->with('success', 'Tour đã được xóa!');
    }

    public function show($id) {
        $tour = Tour::findOrFail($id);
        return view('tour.detail', compact('tour'));
    }
}
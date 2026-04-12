<?php

namespace App\Http\Controllers;

use App\Models\TravelGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TravelGuideController extends Controller
{
    public function index()
    {
        $query = TravelGuide::with('user')->latest();
        $currentUser = Auth::user();

        if ($currentUser) {
            if (($currentUser->role ?? 'user') !== 'admin') {
                $query->where(function ($q) {
                    $q->where('is_published', true)
                      ->orWhere('user_id', Auth::id());
                });
            }
        } else {
            $query->where('is_published', true);
        }

        $guides = $query->get();

        return view('guides.index', compact('guides'));
    }

    public function show($id)
    {
        $guide = TravelGuide::with('user')->findOrFail($id);

        if (!$guide->is_published && !$this->canManage($guide)) {
            abort(403, 'Bạn không có quyền xem bài viết này.');
        }

        return view('guides.show', compact('guide'));
    }

    public function create()
    {
        return view('guides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:40960',
            'is_published' => 'nullable|boolean',
        ]);

        $data['user_id'] = Auth::id();
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('guides', 'public');
        }

        TravelGuide::create($data);

        return redirect()->route('guides.index')->with('success', 'Đăng bài cẩm nang thành công.');
    }

    public function edit($id)
    {
        $guide = TravelGuide::findOrFail($id);
        $this->authorizeManage($guide);

        return view('guides.edit', compact('guide'));
    }

    public function update(Request $request, $id)
    {
        $guide = TravelGuide::findOrFail($id);
        $this->authorizeManage($guide);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:40960',
            'is_published' => 'nullable|boolean',
        ]);

        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('cover_image')) {
            if ($guide->cover_image && Storage::disk('public')->exists($guide->cover_image)) {
                Storage::disk('public')->delete($guide->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('guides', 'public');
        }

        $guide->update($data);

        return redirect()->route('guides.index')->with('success', 'Cập nhật bài viết thành công.');
    }

    public function retract($id)
    {
        $guide = TravelGuide::findOrFail($id);
        $this->authorizeManage($guide);

        $guide->update(['is_published' => false]);

        return redirect()->route('guides.index')->with('success', 'Đã thu hồi bài viết.');
    }

    public function publish($id)
    {
        $guide = TravelGuide::findOrFail($id);
        $this->authorizeManage($guide);

        $guide->update(['is_published' => true]);

        return redirect()->route('guides.index')->with('success', 'Bài viết đã được đăng lại.');
    }

    public function destroy($id)
    {
        $guide = TravelGuide::findOrFail($id);
        $this->authorizeManage($guide);

        if ($guide->cover_image && Storage::disk('public')->exists($guide->cover_image)) {
            Storage::disk('public')->delete($guide->cover_image);
        }

        $guide->delete();

        return redirect()->route('guides.index')->with('success', 'Đã xóa bài viết cẩm nang.');
    }

    private function canManage(TravelGuide $guide): bool
    {
        $currentUser = Auth::user();

        return $currentUser
            && (($currentUser->role ?? 'user') === 'admin' || $guide->user_id === Auth::id());
    }

    private function authorizeManage(TravelGuide $guide): void
    {
        if (!$this->canManage($guide)) {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $galleries = Gallery::query()
            ->when(
                $status === 'aktif',
                fn ($query) => $query->where('is_active', true)
            )
            ->when(
                $status === 'nonaktif',
                fn ($query) => $query->where('is_active', false)
            )
            ->orderBy('sort_order')
            ->orderByDesc('taken_at')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $counts = [
            'semua' => Gallery::count(),
            'aktif' => Gallery::where('is_active', true)->count(),
            'nonaktif' => Gallery::where('is_active', false)->count(),
        ];

        return view('admin.galleries.index', compact('galleries', 'counts', 'status'));
    }

    public function create()
    {
        return view('admin.galleries.create', [
            'gallery' => new Gallery(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'venue' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],
            'taken_at' => ['required', 'date'],
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['image'] = $request->file('image')
            ->store('galleries', 'public');

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        Gallery::create($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'venue' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],
            'taken_at' => ['required', 'date'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);

            $data['image'] = $request->file('image')
                ->store('galleries', 'public');
        } else {
            unset($data['image']);
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $gallery->update($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
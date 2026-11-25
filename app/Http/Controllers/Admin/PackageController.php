<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $packages = Package::query()
            ->when(
                $request->filled('q'),
                fn ($query) => $query->where(
                    'name',
                    'like',
                    '%' . $request->string('q')->trim() . '%'
                )
            )
            ->when(
                $request->filled('category'),
                fn ($query) => $query->where('category', $request->input('category'))
            )
            ->when(
                $request->input('status') === 'aktif',
                fn ($query) => $query->where('is_active', true)
            )
            ->when(
                $request->input('status') === 'nonaktif',
                fn ($query) => $query->where('is_active', false)
            )
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create', [
            'package' => new Package(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatePackage($request);

        $data['slug'] = $this->makeUniqueSlug($data['name']);
        $facilities = $this->extractFacilities($data);
        $data['facilities'] = $facilities;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('packages', 'public');
        }

        Package::create($data);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $this->validatePackage($request);
        
        $data['slug'] = $this->makeUniqueSlug($data['name']);

        $facilities = $this->extractFacilities($data);
        
        $data['facilities'] = $facilities;

        if ($request->hasFile('image')) {
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }

            $data['image'] = $request->file('image')
                ->store('packages', 'public');
        }

        if (! $request->hasFile('image')) {
            unset($data['image']);
        }
        $package->update($data);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Paket berhasil dihapus.');
    }

    private function validatePackage(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'category' => [
                'required',
                Rule::in(['cinta', 'bahagia', 'impian', 'lainnya']),
            ],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string', 'max:5000'],
            'facilities_dekorasi' => ['nullable', 'string', 'max:5000'],
            'facilities_rias' => ['nullable', 'string', 'max:5000'],
            'facilities_dokumentasi' => ['nullable', 'string', 'max:5000'],
            'facilities_lainnya' => ['nullable', 'string', 'max:5000'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => (int) $request->input('sort_order', 0),
        ];
    }


    private function extractFacilities(array &$data): array
    {
        $facilities = [];

        foreach (array_keys(Package::FACILITY_GROUPS) as $key) {
            $field = 'facilities_' . $key;
            $items = $this->parseFacilities($data[$field] ?? '');

            unset($data[$field]);

            if ($items !== []) {
                $facilities[$key] = $items;
            }
        }

        return $facilities;
    }

    private function parseFacilities(?string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $text))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    private function makeUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {
        $base = Str::slug($name) ?: 'paket';
        $slug = $base;
        $counter = 2;

        while (
            Package::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}

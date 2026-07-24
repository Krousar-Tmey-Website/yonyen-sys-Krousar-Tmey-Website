<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryEventController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $events = HistoryEvent::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('year', 'like', '%' . $search . '%')
                      ->orWhere('left_text', 'like', '%' . $search . '%')
                      ->orWhere('right_text', 'like', '%' . $search . '%');
            })
            ->orderBy('sort_order')
            ->orderBy('year')
            ->get();

        $totalEvents = $events->count();

        $viewData = [
            'events'      => $events,
            'filters'     => ['search' => $search],
            'totalEvents' => $totalEvents,
        ];

        if ($request->ajax() || $request->wantsJson()) {
            $html = view('admin.history_events._results', $viewData)->render();

            return response()->json([
                'html'  => $html,
                'total' => $totalEvents,
            ]);
        }

        return view('admin.history_events.index', $viewData);
    }

    public function create()
    {
        return redirect()->route('admin.history-events.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year'          => ['required', 'string', 'max:10'],
            'left_text'     => ['nullable', 'required_without:right_text', 'string'],
            'left_text_fr'  => ['nullable', 'string'],
            'right_text'    => ['nullable', 'required_without:left_text', 'string'],
            'right_text_fr' => ['nullable', 'string'],
            'image'      => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'image_url'  => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
        ], [
            'left_text.required_without'  => 'Enter either Left Column Text or Right Column Text.',
            'right_text.required_without' => 'Enter either Left Column Text or Right Column Text.',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active']  = true;
        $data['image']      = $this->resolveImage($request, $data);
        unset($data['image_url']);

        // Convert empty strings to null so blank fields don't render as content
        $data['left_text']     = $data['left_text'] !== '' ? ($data['left_text'] ?? null) : null;
        $data['right_text']    = $data['right_text'] !== '' ? ($data['right_text'] ?? null) : null;
        $data['left_text_fr']  = !empty($data['left_text_fr']) ? $data['left_text_fr'] : null;
        $data['right_text_fr'] = !empty($data['right_text_fr']) ? $data['right_text_fr'] : null;

        $event = HistoryEvent::create($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'History event added.',
                'event'   => $event->fresh()->toArray(),
            ]);
        }

        return redirect()->route('admin.history-events.index')->with('success', 'History event added.');
    }

    public function edit(HistoryEvent $historyEvent)
    {
        if (request()->wantsJson()) {
            return response()->json($historyEvent->toArray());
        }

        return redirect()->route('admin.history-events.index');
    }

    public function update(Request $request, HistoryEvent $historyEvent)
    {
        $data = $request->validate([
            'year'          => ['required', 'string', 'max:10'],
            'left_text'     => ['nullable', 'required_without:right_text', 'string'],
            'left_text_fr'  => ['nullable', 'string'],
            'right_text'    => ['nullable', 'required_without:left_text', 'string'],
            'right_text_fr' => ['nullable', 'string'],
            'image'      => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'image_url'  => ['nullable', 'url', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
            'sort_order'   => ['nullable', 'integer'],
            'is_active'    => ['nullable', 'boolean'],
        ], [
            'left_text.required_without'  => 'Enter either Left Column Text or Right Column Text.',
            'right_text.required_without' => 'Enter either Left Column Text or Right Column Text.',
        ]);

        if ($request->boolean('remove_image')) {
            $this->deleteStoredImage($historyEvent->image);
            $data['image'] = null;
        } else {
            $newImage = $this->resolveImage($request, $data);
            if ($newImage !== null) {
                $this->deleteStoredImage($historyEvent->image);
                $data['image'] = $newImage;
            } else {
                unset($data['image']);
            }
        }
        unset($data['image_url'], $data['remove_image']);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        
        // Convert empty strings to null so blank fields don't render as content
        if (array_key_exists('left_text', $data) && $data['left_text'] === '') {
            $data['left_text'] = null;
        }
        if (array_key_exists('right_text', $data) && $data['right_text'] === '') {
            $data['right_text'] = null;
        }
        if (array_key_exists('left_text_fr', $data) && $data['left_text_fr'] === '') {
            $data['left_text_fr'] = null;
        }
        if (array_key_exists('right_text_fr', $data) && $data['right_text_fr'] === '') {
            $data['right_text_fr'] = null;
        }

        $historyEvent->update($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'History event updated.',
                'event'   => $historyEvent->fresh()->toArray(),
            ]);
        }

        return redirect()->route('admin.history-events.index')->with('success', 'History event updated.');
    }

    public function destroy(HistoryEvent $historyEvent)
    {
        $this->deleteStoredImage($historyEvent->image);
        $historyEvent->delete();
        return redirect()->route('admin.history-events.index')->with('success', 'History event deleted.');
    }

    /**
     * Resolve the image value from an uploaded file or an image URL.
     * Returns null when neither was provided.
     */
    private function resolveImage(Request $request, array $data): ?string
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('history_events', 'public');
        }

        if (!empty($data['image_url'])) {
            return $data['image_url'];
        }

        return null;
    }

    /**
     * Delete a locally stored image file, ignoring external URLs.
     */
    private function deleteStoredImage(?string $path): void
    {
        if ($path && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
    }
}
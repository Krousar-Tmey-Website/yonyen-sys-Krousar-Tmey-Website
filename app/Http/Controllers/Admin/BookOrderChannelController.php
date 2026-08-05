<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookOrderChannel;
use Illuminate\Http\Request;

class BookOrderChannelController extends Controller
{
    public function index()
    {
        $channels = BookOrderChannel::ordered()->get();

        return view('admin.book-order-channels.index', compact('channels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['icon_key'] = BookOrderChannel::TYPES[$data['type']]['icon'];
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active', true);

        BookOrderChannel::create($data);

        return redirect()->route('admin.book-order-channels.index')->with('success', 'Order channel added.');
    }

    public function update(Request $request, BookOrderChannel $bookOrderChannel)
    {
        $data = $request->validate($this->rules());
        $data['icon_key'] = BookOrderChannel::TYPES[$data['type']]['icon'];
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active', true);

        $bookOrderChannel->update($data);

        return redirect()->route('admin.book-order-channels.index')->with('success', 'Order channel updated.');
    }

    public function destroy(BookOrderChannel $bookOrderChannel)
    {
        $bookOrderChannel->delete();

        return redirect()->route('admin.book-order-channels.index')->with('success', 'Order channel removed.');
    }

    private function rules(): array
    {
        return [
            'type' => ['required', 'string', 'in:' . implode(',', array_keys(BookOrderChannel::TYPES))],
            'label' => ['required', 'string', 'max:100'],
            'label_fr' => ['nullable', 'string', 'max:100'],
            'value' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ];
    }
}

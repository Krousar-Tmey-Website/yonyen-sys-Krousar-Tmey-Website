@extends('admin.layouts.app')

@section('title', 'Book Order Channels')
@section('page-title', 'Book Order Channels')
@section('breadcrumb', 'Get Involved → Book for Sales → Order Channels')

@section('content')

@php
    $types = \App\Models\BookOrderChannel::TYPES;
    $icons = \App\Models\BookOrderChannel::ICONS;
@endphp

<div class="space-y-6"
     x-data="{
         showModal: false,
         editMode: false,
         actionUrl: '{{ route('admin.book-order-channels.store') }}',
         type: 'email',
         label: '',
         labelFr: '',
         value: '',
         sortOrder: 0,
         isActive: true,
         channelMeta: {{ collect($types)->map(fn ($t, $k) => ['placeholder' => $t['placeholder'], 'hint' => $t['hint']])->toJson() }},
         openAddModal() {
             this.editMode = false;
             this.actionUrl = '{{ route('admin.book-order-channels.store') }}';
             this.type = 'email';
             this.label = '';
             this.labelFr = '';
             this.value = '';
             this.sortOrder = 0;
             this.isActive = true;
             this.showModal = true;
         },
         openEditModal(item) {
             this.editMode = true;
             this.actionUrl = `/admin/book-order-channels/${item.id}`;
             this.type = item.type;
             this.label = item.label || '';
             this.labelFr = item.label_fr || '';
             this.value = item.value || '';
             this.sortOrder = item.sort_order;
             this.isActive = !!item.is_active;
             this.showModal = true;
         }
     }">
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-700 text-sm">Book Order Channels</h3>
                <p class="text-xs text-gray-400 mt-0.5">The buttons visitors can click on a book's page to place an order — email, phone, Telegram, WhatsApp, HelloAsso, or any other link.</p>
            </div>
            <button @click="openAddModal()"
                    class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-[#2d6fa3] hover:bg-[#1d4e7a] px-3.5 py-2 rounded-lg transition-all duration-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Channel
            </button>
        </div>

        @if($channels->isEmpty())
        <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
            <p class="text-sm font-medium mb-2">No order channels configured yet.</p>
            <p class="text-xs mb-3">Visitors currently see the default "Order Book Now" (Contact page) and "Order via Email" buttons.</p>
            <button @click="openAddModal()" class="text-[#2d6fa3] text-sm underline hover:text-[#1d4e7a]">Add your first channel</button>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($channels as $item)
            <div class="relative rounded-2xl border-2 border-gray-100 overflow-hidden group cursor-pointer hover:shadow-md transition-all duration-200 {{ $item->is_active ? '' : 'opacity-50' }}"
                 @click="openEditModal({{ json_encode($item->toArray()) }})">
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-9 h-9 rounded-xl bg-[#2d6fa3]/10 flex items-center justify-center shrink-0">
                            <svg class="w-4.5 h-4.5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icons[$item->icon_key] ?? $icons['link'] !!}</svg>
                        </span>
                        <div class="min-w-0">
                            <h4 class="font-bold text-[#1d4e7a] text-sm truncate">{{ $item->label }}</h4>
                            <span class="text-[10px] font-bold uppercase tracking-wide text-gray-400">{{ $types[$item->type]['label'] ?? $item->type }}</span>
                        </div>
                    </div>
                    <p class="text-gray-500 text-xs leading-relaxed truncate">{{ $item->value }}</p>
                    @if($item->label_fr)
                    <p class="text-[10px] text-gray-400 mt-1 truncate">FR: {{ $item->label_fr }}</p>
                    @endif
                    <span class="text-[10px] font-bold text-gray-400 block mt-2">Order: {{ $item->sort_order }} &middot; {{ $item->is_active ? 'Active' : 'Hidden' }}</span>
                </div>
                <div class="absolute top-3 right-3 flex gap-1 items-center opacity-0 group-hover:opacity-100 transition-all duration-200">
                    <form action="{{ route('admin.book-order-channels.destroy', $item) }}" method="POST" @click.stop onsubmit="return confirm('Delete this order channel?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-7 h-7 rounded-full flex items-center justify-center bg-white/80 hover:bg-red-50 hover:text-red-600 text-gray-400 shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Add/Edit Modal --}}
    <template x-teleport="body">
        <div x-show="showModal" x-cloak @keydown.escape.window="showModal = false"
             class="fixed inset-0 z-[9999] flex items-start justify-center p-4 pt-10 sm:pt-16 sm:p-6 overflow-y-auto"
             style="background: rgba(0,0,0,0.5); backdrop-filter: blur(6px);">
            <div @click="showModal = false" class="absolute inset-0 z-0"></div>
            <div class="relative z-10 w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden max-h-[90vh] overflow-y-auto">
                <div class="h-1.5 w-full bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3]"></div>
                <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-50">
                    <h3 class="font-bold text-gray-800 text-sm" x-text="editMode ? 'Edit Channel' : 'Add Channel'">Add Channel</h3>
                    <button @click="showModal = false" class="w-7 h-7 rounded-full flex items-center justify-center bg-gray-100 hover:bg-gray-200">
                        <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-6">
                    <form x-bind:action="actionUrl" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Channel Type</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($types as $key => $t)
                                <label class="flex items-center gap-2 px-3 py-2.5 rounded-xl border-2 cursor-pointer transition-all duration-150"
                                       :class="type === '{{ $key }}' ? 'border-[#2d6fa3] bg-[#2d6fa3]/5' : 'border-gray-200 hover:border-gray-300'">
                                    <input type="radio" name="type" value="{{ $key }}" x-model="type" class="sr-only">
                                    <svg class="w-4 h-4 text-gray-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icons[$t['icon']] !!}</svg>
                                    <span class="text-xs font-medium text-gray-700">{{ $t['label'] }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Button Label <span class="text-red-400">*</span></label>
                            <input type="text" name="label" x-model="label" required maxlength="100"
                                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                   placeholder="e.g. Order via Email">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Button Label (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="text" name="label_fr" x-model="labelFr" maxlength="100"
                                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                   placeholder="ex. Commander par Email">
                            <div class="text-[11px] text-gray-400 mt-1">Leave blank to reuse the English label for French visitors.</div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Value <span class="text-red-400">*</span></label>
                            <input type="text" name="value" x-model="value" required maxlength="255"
                                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                   :placeholder="channelMeta[type]?.placeholder || ''">
                            <div class="text-[11px] text-gray-400 mt-1" x-text="channelMeta[type]?.hint || ''"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Sort Order</label>
                                <input type="number" name="sort_order" x-model="sortOrder"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                            <div class="flex items-end pb-2.5">
                                <label class="flex items-center gap-2 text-xs font-medium text-gray-600 cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" x-model="isActive" class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/30">
                                    Active (visible on site)
                                </label>
                            </div>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="flex-1 btn-primary text-sm py-2.5">
                                <span x-text="editMode ? 'Save Changes' : 'Add Channel'">Add Channel</span>
                            </button>
                            <button type="button" @click="showModal = false" class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>

@endsection

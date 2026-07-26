@extends('admin.layouts.app')

@section('title', 'Admin Users')
@section('page-title', 'Admin Users')
@section('breadcrumb', 'Manage admin accounts that can log into the panel')

@section('content')

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
        <div class="flex items-center gap-2">
            <h3 class="font-bold text-gray-800">All Users</h3>
            <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                {{ $users->count() }}
            </span>
        </div>
        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Admin
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    @if($users->isEmpty())
    <div class="py-16 text-center text-gray-400">
        <div class="text-4xl mb-3">👤</div>
        <p class="text-sm font-medium text-gray-500">No users yet</p>
        <p class="text-xs mt-1">Click <strong>New Admin</strong> to create the first admin account.</p>
    </div>
    @else
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Name</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">Admin</th>
                <th class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50/50">
                <td class="px-6 py-4 text-gray-700">{{ $user->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $user->is_admin ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                        {{ $user->is_admin ? 'Yes' : 'No' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium">Edit</a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                              onsubmit="return confirm('Delete this user?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 text-xs">Delete</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection

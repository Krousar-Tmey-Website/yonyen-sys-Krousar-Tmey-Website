@extends('admin.layouts.app')

@section('title', 'Admin Users')
@section('page-title', 'Admin Users')
@section('breadcrumb', 'Manage admin accounts that can log into the panel')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">{{ $users->count() }} account(s)</p>
    <a href="{{ route('admin.users.create') }}" class="btn-primary text-sm">+ New Admin</a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    @if($users->isEmpty())
    <div class="px-6 py-16 text-center text-gray-400">
        <p class="text-sm">No users yet.</p>
        <a href="{{ route('admin.users.create') }}" class="text-[#2d6fa3] text-sm underline mt-1 inline-block">Create the first admin account</a>
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

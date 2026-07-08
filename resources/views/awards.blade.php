@extends('layouts.app')

@section('title', 'Awards — Krousar Thmey')
@section('description', 'Recognitions and awards received by Krousar Thmey for their humanitarian work in Cambodia.')

@section('content')

{{-- Page Header --}}
<div class="bg-gradient-to-br from-[#1a3c6e] to-[#2d6fa3] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a] translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Awards</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Awards & Recognitions</h1>
        <p class="text-white/70 text-lg max-w-2xl">Celebrating the achievements and recognition of Krousar Thmey's humanitarian work in Cambodia.</p>
    </div>
</div>

{{-- Awards Grid --}}
<section class="py-20 bg-gradient-to-b from-white to-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        @if($awards->isEmpty())
        <div class="text-center py-16 bg-white rounded-3xl border border-gray-100 shadow-sm">
            <div class="w-24 h-24 rounded-2xl bg-[#f0f7ff] flex items-center justify-center mx-auto mb-6">
                <span class="text-5xl">🏆</span>
            </div>
            <p class="text-gray-400 text-lg">No awards have been added yet.</p>
        </div>
        @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($awards as $index => $award)
            <div class="group bg-white rounded-2xl border border-gray-100 hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col h-full cursor-pointer transform hover:-translate-y-2"
                 style="animation-delay: {{ $index * 100 }}ms"
                 onclick="openAwardModal({{ $award->id }}, '{{ addslashes($award->title) }}', '{{ addslashes($award->organization) }}', '{{ addslashes($award->recipient ?? '') }}', '{{ addslashes($award->description ?? '') }}', '{{ $award->image_url }}', '{{ $award->icon }}', '{{ $award->link_url ?? '' }}', '{{ $award->link_type ?? '' }}', '{{ addslashes($award->link_text ?? '') }}')">
                <div class="p-7 flex flex-col h-full">
                    <div class="relative mb-5">
                        @if($award->image)
                        <div class="w-24 h-24 rounded-2xl overflow-hidden mx-auto group-hover:scale-110 transition-transform duration-500 shadow-lg">
                            <img src="{{ $award->image_url }}" alt="{{ $award->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-[#8da83a] rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        @else
                        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-[#2d6fa3] to-[#1a3c6e] flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-lg">
                            <span class="text-5xl">{{ $award->icon }}</span>
                        </div>
                        @endif
                    </div>
                    @if($award->recipient)
                    <span class="text-[#e8a020] text-xs font-bold uppercase tracking-wider block mb-2 text-center bg-[#e8a020]/10 px-3 py-1 rounded-full inline-block mx-auto">{{ $award->recipient }}</span>
                    @endif
                    <h3 class="text-xl font-bold text-[#1a3c6e] mb-2 leading-snug text-center group-hover:text-[#2d6fa3] transition-colors">{{ $award->title }}</h3>
                    <p class="text-[#2d6fa3] text-sm font-semibold mb-4 text-center">{{ $award->organization }}</p>
                    @if($award->description)
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-grow line-clamp-3">{{ $award->description }}</p>
                    @endif
                    @if($award->link_url)
                    <a href="{{ $award->link_url }}" target="_blank" rel="noopener"
                       class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#1a3c6e] to-[#2d6fa3] text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:from-[#2d6fa3] hover:to-[#1a3c6e] transition-all mt-auto shadow-md hover:shadow-lg transform hover:scale-105"
                       onclick="event.stopPropagation()">
                        @if($award->link_type === 'website')
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-8m0-6V6a2 2 0 112 2h-6m-6 0l6 6m-6-6l6-6"/></svg>
                        @elseif($award->link_type === 'article')
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13S12 1.253 12 6.253c0 0 0 5 6 6v8c0 0-6 1-6 6s6-6 6-6v-8c0-5-6-6-6-6z"/></svg>
                        @elseif($award->link_type === 'video')
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l1.252-1.252L12 5.5l-4 4.414L5.252 9.916l1.252 1.252L12 16.5l2.752-5.332z"/></svg>
                        @endif
                        {{ $award->link_text ?? ucfirst($award->link_type) }}
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- Award Detail Modal --}}
<div id="awardModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">
    <div class="bg-white rounded-3xl max-w-lg w-full max-h-[90vh] overflow-y-auto shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="modalContent">
        <div class="p-8">
            <div class="flex items-start justify-between mb-6">
                <h3 id="modalTitle" class="text-2xl font-bold text-[#1a3c6e] pr-4"></h3>
                <button onclick="closeAwardModal()" class="text-gray-300 hover:text-gray-600 transition-colors p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div id="modalImage" class="mb-6 text-center"></div>
            <div class="space-y-4">
                <div class="bg-[#f8f9fc] rounded-xl p-4">
                    <p class="text-xs font-bold text-[#e8a020] uppercase tracking-wider mb-1">Organization</p>
                    <p id="modalOrganization" class="text-gray-700 font-medium text-lg"></p>
                </div>
                <div id="modalRecipientContainer" class="bg-[#f8f9fc] rounded-xl p-4">
                    <p class="text-xs font-bold text-[#e8a020] uppercase tracking-wider mb-1">Recipient</p>
                    <p id="modalRecipient" class="text-gray-700 text-lg"></p>
                </div>
                <div id="modalDescriptionContainer" class="bg-[#f8f9fc] rounded-xl p-4">
                    <p class="text-xs font-bold text-[#e8a020] uppercase tracking-wider mb-1">Description</p>
                    <p id="modalDescription" class="text-gray-600 text-sm leading-relaxed"></p>
                </div>
            </div>
            <div id="modalLinkContainer" class="mt-6">
                <a id="modalLink" href="#" target="_blank" rel="noopener"
                   class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#1a3c6e] to-[#2d6fa3] text-white px-6 py-3 rounded-xl text-sm font-medium hover:from-[#2d6fa3] hover:to-[#1a3c6e] transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                    <span id="modalLinkIcon"></span>
                    <span id="modalLinkText"></span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function openAwardModal(id, title, organization, recipient, description, imageUrl, icon, linkUrl, linkType, linkText) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalOrganization').textContent = organization;
    
    // Show/hide recipient
    const recipientContainer = document.getElementById('modalRecipientContainer');
    if (recipient) {
        document.getElementById('modalRecipient').textContent = recipient;
        recipientContainer.style.display = 'block';
    } else {
        recipientContainer.style.display = 'none';
    }
    
    // Show/hide description
    const descriptionContainer = document.getElementById('modalDescriptionContainer');
    if (description) {
        document.getElementById('modalDescription').textContent = description;
        descriptionContainer.style.display = 'block';
    } else {
        descriptionContainer.style.display = 'none';
    }
    
    // Show image or icon
    const imageContainer = document.getElementById('modalImage');
    if (imageUrl) {
        imageContainer.innerHTML = '<img src="' + imageUrl + '" alt="' + title + '" class="w-40 h-40 rounded-2xl object-cover mx-auto shadow-lg">';
    } else {
        imageContainer.innerHTML = '<div class="w-40 h-40 rounded-2xl bg-gradient-to-br from-[#2d6fa3] to-[#1a3c6e] flex items-center justify-center mx-auto shadow-lg"><span class="text-7xl">' + icon + '</span></div>';
    }
    
    // Show/hide link
    const linkContainer = document.getElementById('modalLinkContainer');
    if (linkUrl) {
        document.getElementById('modalLink').href = linkUrl;
        document.getElementById('modalLinkText').textContent = linkText || (linkType ? linkType.charAt(0).toUpperCase() + linkType.slice(1) : 'Link');
        
        // Set link icon
        let linkIcon = '';
        if (linkType === 'website') {
            linkIcon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-8m0-6V6a2 2 0 112 2h-6m-6 0l6 6m-6-6l6-6"/></svg>';
        } else if (linkType === 'article') {
            linkIcon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13S12 1.253 12 6.253c0 0 0 5 6 6v8c0 0-6 1-6 6s6-6 6-6v-8c0-5-6-6-6-6z"/></svg>';
        } else if (linkType === 'video') {
            linkIcon = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l1.252-1.252L12 5.5l-4 4.414L5.252 9.916l1.252 1.252L12 16.5l2.752-5.332z"/></svg>';
        }
        document.getElementById('modalLinkIcon').innerHTML = linkIcon;
        linkContainer.style.display = 'block';
    } else {
        linkContainer.style.display = 'none';
    }
    
    const modal = document.getElementById('awardModal');
    const modalContent = document.getElementById('modalContent');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeAwardModal() {
    const modal = document.getElementById('awardModal');
    const modalContent = document.getElementById('modalContent');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// Close modal on escape key or click outside
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAwardModal();
    }
});

document.getElementById('awardModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAwardModal();
    }
});
</script>

@endsection
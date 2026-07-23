{{-- CKEditor rich text editor for the article content field. --}}
<div>
    <textarea name="content" data-ckeditor rows="15"
              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ old('content', $contentValue ?? '') }}</textarea>
</div>

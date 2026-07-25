@php
    $name = $name ?? 'content';
    $placeholder = $placeholder ?? 'Write your article content here...';
    $lang = str_contains($name, '_fr') ? 'fr' : 'en';
@endphp
<x-admin.rich-text name="{{ $name }}" :value="old($name, $contentValue ?? '')" lang="{{ $lang }}" :rows="12" placeholder="{{ $placeholder }}" :upload-url="route('admin.news.upload-image')" />

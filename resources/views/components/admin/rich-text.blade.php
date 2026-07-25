{{--
    CKEditor-backed textarea for bilingual long-text fields (description, subtitle, etc).
    Usage: <x-admin.rich-text name="description" :value="old('description')" lang="en" />
           <x-admin.rich-text name="description_fr" :value="old('description_fr')" lang="fr" placeholder="..." />
    See resources/js/admin-ckeditor.js for the init/cleanup wiring.
--}}
@props(['name', 'value' => '', 'lang' => 'en', 'placeholder' => '', 'rows' => 5, 'uploadUrl' => null])

<textarea
    name="{{ $name }}"
    data-ckeditor
    data-ckeditor-lang="{{ $lang }}"
    @if($uploadUrl) data-ckeditor-upload-url="{{ $uploadUrl }}" @endif
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['rows' => $rows, 'class' => 'w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]']) }}
>{{ $value }}</textarea>

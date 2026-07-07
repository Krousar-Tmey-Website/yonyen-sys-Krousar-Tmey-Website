@extends('layouts.app')

@section('title', 'Volunteer With Us — Krousar Thmey')
@section('description', 'Apply to volunteer with Krousar Thmey and make a difference for children in Cambodia.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1a3c6e] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('involved') }}" class="hover:text-white transition-colors">Get Involved</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Volunteer</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Volunteer With Us</h1>
        <p class="text-white/70 text-lg max-w-2xl">Bring your skills and passion to help us build a brighter future for children in Cambodia.</p>
    </div>
</div>

{{-- Application Form --}}
<section class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-6">

        @if(session('success'))
            {{-- Success Message --}}
            <div class="bg-green-50 border border-green-200 rounded-3xl p-12 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Thank You!</h2>
                <p class="text-gray-500 text-lg">Your application has been submitted successfully.</p>
                <p class="text-gray-400 text-sm mt-4">We will review your application and get back to you soon.</p>
                <a href="{{ route('volunteer') }}" class="btn-blue mt-8 inline-flex">Submit Another Application</a>
            </div>
        @else
            {{-- Form Progress Indicator --}}
            <div class="mb-8 flex items-center justify-center gap-4 text-sm">
                <span class="flex items-center gap-1.5 text-[#2d6fa3] font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Personal Info
                </span>
                <span class="text-gray-300">—</span>
                <span class="text-gray-500">Volunteer Info</span>
                <span class="text-gray-300">—</span>
                <span class="text-gray-500">Additional</span>
            </div>

            <form method="POST" action="{{ route('volunteer.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                {{-- ════════════════════════════════════════════ --}}
                {{── Section 1: Personal Information ──}}
                {{-- ════════════════════════════════════════════ --}}
                <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-sm font-bold">1</span>
                        </div>
                        <h2 class="text-xl font-bold text-[#1a3c6e]">Personal Information</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">
                        {{-- Full Name --}}
                        <div class="md:col-span-2">
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1.5">Full Name <span class="text-red-400">*</span></label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('full_name') border-red-300 @enderror"
                                   placeholder="Your full name">
                            @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address <span class="text-red-400">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('email') border-red-300 @enderror"
                                   placeholder="your@email.com">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">Phone Number <span class="text-red-400">*</span></label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('phone') border-red-300 @enderror"
                                   placeholder="+855 12 345 678">
                            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Date of Birth --}}
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1.5">Date of Birth <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('date_of_birth') border-red-300 @enderror">
                            @error('date_of_birth') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Gender --}}
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1.5">Gender <span class="text-gray-400 font-normal">(optional)</span></label>
                            <select name="gender" id="gender"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm bg-white @error('gender') border-red-300 @enderror">
                                <option value="">Select gender</option>
                                <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                                <option value="Prefer not to say" {{ old('gender') === 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                            </select>
                            @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Country --}}
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1.5">Country <span class="text-red-400">*</span></label>
                            <input type="text" name="country" id="country" value="{{ old('country') }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('country') border-red-300 @enderror"
                                   placeholder="Cambodia">
                            @error('country') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Address --}}
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">Address <span class="text-gray-400 font-normal">(optional)</span></label>
                            <textarea name="address" id="address" rows="2"
                                      class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('address') border-red-300 @enderror"
                                      placeholder="Your current address">{{ old('address') }}</textarea>
                            @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- ════════════════════════════════════════════ --}}
                {{── Section 2: Volunteer Information ──}}
                {{-- ════════════════════════════════════════════ --}}
                <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-sm font-bold">2</span>
                        </div>
                        <h2 class="text-xl font-bold text-[#1a3c6e]">Volunteer Information</h2>
                    </div>

                    {{-- Motivation --}}
                    <div class="mb-5">
                        <label for="motivation" class="block text-sm font-medium text-gray-700 mb-1.5">Why do you want to volunteer? <span class="text-red-400">*</span></label>
                        <textarea name="motivation" id="motivation" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('motivation') border-red-300 @enderror"
                                  placeholder="Tell us why you want to volunteer with Krousar Thmey and what motivates you...">{{ old('motivation') }}</textarea>
                        @error('motivation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Skills --}}
                    <div class="mb-5">
                        <label for="skills" class="block text-sm font-medium text-gray-700 mb-1.5">What skills do you have? <span class="text-red-400">*</span></label>
                        <textarea name="skills" id="skills" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('skills') border-red-300 @enderror"
                                  placeholder="Describe your relevant skills, experience, and qualifications...">{{ old('skills') }}</textarea>
                        @error('skills') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Interested Program --}}
                    <div class="mb-5">
                        <label for="interested_program" class="block text-sm font-medium text-gray-700 mb-1.5">Which program are you interested in? <span class="text-gray-400 font-normal">(optional)</span></label>
                        <select name="interested_program" id="interested_program"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm bg-white @error('interested_program') border-red-300 @enderror">
                            <option value="">Select a program</option>
                            <option value="Education" {{ old('interested_program') === 'Education' ? 'selected' : '' }}>Education</option>
                            <option value="Environment" {{ old('interested_program') === 'Environment' ? 'selected' : '' }}>Environment</option>
                            <option value="Community Development" {{ old('interested_program') === 'Community Development' ? 'selected' : '' }}>Community Development</option>
                            <option value="Events" {{ old('interested_program') === 'Events' ? 'selected' : '' }}>Events</option>
                            <option value="Healthcare" {{ old('interested_program') === 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                            <option value="Fundraising" {{ old('interested_program') === 'Fundraising' ? 'selected' : '' }}>Fundraising</option>
                        </select>
                        @error('interested_program') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Availability --}}
                    <div class="mb-5">
                        <label for="availability" class="block text-sm font-medium text-gray-700 mb-1.5">Availability <span class="text-gray-400 font-normal">(optional)</span></label>
                        <select name="availability" id="availability"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm bg-white @error('availability') border-red-300 @enderror">
                            <option value="">Select availability</option>
                            <option value="Weekdays" {{ old('availability') === 'Weekdays' ? 'selected' : '' }}>Weekdays</option>
                            <option value="Weekends" {{ old('availability') === 'Weekends' ? 'selected' : '' }}>Weekends</option>
                            <option value="Full-time" {{ old('availability') === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('availability') === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Flexible" {{ old('availability') === 'Flexible' ? 'selected' : '' }}>Flexible</option>
                        </select>
                        @error('availability') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- ════════════════════════════════════════════ --}}
                {{── Section 3: Additional Information ──}}
                {{-- ════════════════════════════════════════════ --}}
                <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-sm font-bold">3</span>
                        </div>
                        <h2 class="text-xl font-bold text-[#1a3c6e]">Additional Information</h2>
                    </div>

                    {{-- Previous Experience --}}
                    <div class="mb-5">
                        <label for="previous_experience" class="block text-sm font-medium text-gray-700 mb-1.5">Previous volunteer experience <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="previous_experience" id="previous_experience" rows="3"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('previous_experience') border-red-300 @enderror"
                                  placeholder="Have you volunteered before? Tell us about your experience...">{{ old('previous_experience') }}</textarea>
                        @error('previous_experience') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Resume --}}
                    <div class="mb-5">
                        <label for="resume" class="block text-sm font-medium text-gray-700 mb-1.5">Upload CV / Resume <span class="text-gray-400 font-normal">(optional)</span></label>
                        <div class="relative">
                            <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20 @error('resume') border-red-300 @enderror">
                        </div>
                        <p class="text-gray-400 text-xs mt-1.5">Accepted formats: PDF, DOC, DOCX (max 5MB)</p>
                        @error('resume') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Emergency Contact --}}
                    <div class="mb-5">
                        <label for="emergency_contact" class="block text-sm font-medium text-gray-700 mb-1.5">Emergency Contact <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="emergency_contact" id="emergency_contact" rows="2"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all text-sm @error('emergency_contact') border-red-300 @enderror"
                                  placeholder="Name, phone number, and relationship (e.g. Jane Doe, +855 12 345 678, Spouse)">{{ old('emergency_contact') }}</textarea>
                        @error('emergency_contact') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Terms Checkbox --}}
                    <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
                        <input type="checkbox" name="agreed_to_terms" id="agreed_to_terms" value="1"
                               class="mt-0.5 rounded accent-[#2d6fa3] @error('agreed_to_terms') border-red-300 @enderror"
                               {{ old('agreed_to_terms') ? 'checked' : '' }}>
                        <label for="agreed_to_terms" class="text-gray-600 text-sm leading-relaxed">
                            I agree to the NGO's volunteer terms and conditions, and I confirm that the information provided is accurate.
                        </label>
                    </div>
                    @error('agreed_to_terms') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-4 pt-2 pb-8">
                    <button type="submit"
                            class="btn-primary text-base px-10 py-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Submit Application
                    </button>
                    <button type="reset"
                            class="px-6 py-4 rounded-xl border border-gray-200 text-gray-600 font-medium text-sm hover:bg-gray-50 hover:border-gray-300 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset
                    </button>
                </div>
            </form>
        @endif
    </div>
</section>

{{-- Why Volunteer --}}
<section class="py-16 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="section-title mx-auto">Why Volunteer With Us?</h2>
            <p class="section-subtitle mx-auto">Join a community of dedicated individuals making a real difference.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '🌍', 'title' => 'Meaningful Impact', 'desc' => 'Your time and skills directly improve the lives of children and families in Cambodia.'],
                ['icon' => '🤝', 'title' => 'Supportive Community', 'desc' => 'Work alongside passionate professionals and fellow volunteers who share your dedication.'],
                ['icon' => '📈', 'title' => 'Personal Growth', 'desc' => 'Gain invaluable experience, develop new skills, and broaden your perspective.'],
            ] as $reason)
            <div class="bg-white rounded-2xl p-8 border border-gray-100 text-center hover:shadow-md transition-shadow">
                <div class="text-4xl mb-4">{{ $reason['icon'] }}</div>
                <h3 class="font-bold text-[#1a3c6e] mb-2">{{ $reason['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $reason['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

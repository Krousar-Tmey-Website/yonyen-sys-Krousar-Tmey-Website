@extends('admin.layouts.app')

@section('title', 'Transparency')
@section('page-title', 'Transparency')
@section('breadcrumb', 'Manage audited financial statements and transparency content')

@section('content')

<div class="space-y-8" x-data="{ tab: 'reports' }">
    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200">
        <nav class="flex space-x-8 overflow-x-auto">
            <button @click="tab = 'reports'"
                    :class="tab === 'reports' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Audited Statements (PDFs)
            </button>
            <button @click="tab = 'content'"
                    :class="tab === 'content' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Page Text
            </button>
        </nav>
    </div>

{{-- ========================================================
     TAB: PAGE TEXT — everything shown on /who-we-are/transparency
     ======================================================== --}}
<div x-show="tab === 'content'" class="space-y-6">
    <form action="{{ route('admin.transparency.content.update') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-4 text-sm">Page Title</h3>
            <input type="text" name="transparency_title" value="{{ $settings['transparency_title'] ?? 'Transparency and Accountability' }}"
                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-bold text-gray-700 text-sm">Financial Transparency</h3>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Section Heading</label>
                <input type="text" name="transparency_financial_heading" value="{{ $settings['transparency_financial_heading'] ?? 'Financial Transparency' }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 1</label>
                <textarea name="transparency_financial_p1" rows="2"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ $settings['transparency_financial_p1'] ?? 'Financial transparency is a key principle for Krousar Thmey. Everybody has the right to know how the funds raised are used.' }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 2</label>
                <textarea name="transparency_financial_p2" rows="2"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ $settings['transparency_financial_p2'] ?? 'The implementation of programs and projects is our priority.' }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 3</label>
                <textarea name="transparency_financial_p3" rows="2"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ $settings['transparency_financial_p3'] ?? 'Thanks to the strict financial management and the involvement of European volunteers, all administrative costs remain under 4% of the total budget.' }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 4 (Audit firm)</label>
                <textarea name="transparency_financial_p4" rows="3"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ $settings['transparency_financial_p4'] ?? "Krousar Thmey Cambodia's accounts are all audited and certified each year by an independent audit firm (PricewaterhouseCoopers since 2013 and KPMG before then). Working closely with the auditors, Krousar Thmey is committed to constantly improving the quality and precision of its financial processes in order to provide greater efficiency to the organization and transparency to its partners." }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Line Before Report List</label>
                <input type="text" name="transparency_financial_list_intro" value="{{ $settings['transparency_financial_list_intro'] ?? 'Audited financial statements are available here:' }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="text-xs text-gray-400 mt-1">The list of PDF links itself is managed in the "Audited Statements (PDFs)" tab.</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Closing Line</label>
                <textarea name="transparency_financial_outro" rows="2"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ $settings['transparency_financial_outro'] ?? "Our French and Swiss organisations' accounts are also audited annually." }}</textarea>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-bold text-gray-700 text-sm">Origins Of The Funds</h3>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Section Heading</label>
                <input type="text" name="transparency_origins_heading" value="{{ $settings['transparency_origins_heading'] ?? 'Origins Of The Funds' }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 1 (International support)</label>
                <textarea name="transparency_origins_p1" rows="3"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ $settings['transparency_origins_p1'] ?? 'In support of its local activity in Cambodia, Krousar Thmey benefits from the involvement of volunteers in international entities: Krousar Thmey France, Krousar Thmey Switzerland and Krousar Thmey Singapore. As their main activity is fundraising, these branches are a privileged relay to donors outside of Cambodia. They enable Krousar Thmey to receive institutional funding and support from individual donors.' }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 2 (Local support)</label>
                <textarea name="transparency_origins_p2" rows="2"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ $settings['transparency_origins_p2'] ?? 'Donations received in Cambodia come mainly from non-governmental organizations and to a lesser extent from private donors and the Cambodian authorities.' }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 3</label>
                <textarea name="transparency_origins_p3" rows="3"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ $settings['transparency_origins_p3'] ?? "Financial or in-kind donations from the Cambodian authorities have increased steadily over the past few years, accounting for nearly 8% of Krousar Thmey's resources. All staff of special schools for deaf or blind children are civil servants of the Ministry of Education, Youth and Sports who pay their salary (excluding complements paid by Krousar Thmey). For the time being, this contribution is not included in the expenditure and income statement." }}</textarea>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-bold text-gray-700 text-sm">Award Line</h3>
            <p class="text-xs text-gray-400">Renders as: "{prefix} {link label} {suffix}" — e.g. Krousar Thmey won the <span class="text-[#2d6fa3] underline">label Ideas</span> in 2010.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Prefix</label>
                    <input type="text" name="transparency_award_prefix" value="{{ $settings['transparency_award_prefix'] ?? 'Krousar Thmey won the' }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Suffix</label>
                    <input type="text" name="transparency_award_suffix" value="{{ $settings['transparency_award_suffix'] ?? 'in 2010.' }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Link Label</label>
                    <input type="text" name="transparency_award_link_label" value="{{ $settings['transparency_award_link_label'] ?? 'label Ideas' }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Link URL</label>
                    <input type="url" name="transparency_award_link_url" value="{{ $settings['transparency_award_link_url'] ?? 'https://ideas.asso.fr/' }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] text-white rounded-xl text-sm font-semibold hover:bg-[#1d4e7a] transition">
            Save Page Text
        </button>
    </form>
</div>

{{-- ========================================================
     TAB: AUDITED STATEMENTS (PDFs)
     ======================================================== --}}
<div x-show="tab === 'reports'" class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Transparency Reports</h3>
            <p class="text-sm text-gray-500 mt-1">Manage published reports and uploaded PDFs in one place.</p>
        </div>
        <a href="{{ route('admin.transparency.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] text-white rounded-full text-sm font-semibold hover:bg-[#1d4e7a] transition-shadow shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Report
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        @if($reports->isEmpty())
            <div class="px-6 py-12 text-center text-gray-400 text-sm">
                No reports yet. Click "Add New Report" to create the first one.
            </div>
        @else
            <div class="px-5 py-4 bg-gray-50 border-b border-gray-100">
                <h4 class="font-semibold text-gray-700 text-sm">{{ $reports->count() }} Report(s)</h4>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($reports as $report)
                <div class="px-5 py-4 sm:px-6 hover:bg-gray-50 transition">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-800 truncate">{{ $report->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $report->year }} · {{ $report->description ?? 'PDF' }}
                                @if($report->download_url)
                                    · <a href="{{ $report->download_url }}" target="_blank" class="text-[#2d6fa3] hover:underline">View</a>
                                @endif
                                @unless($report->is_active)
                                    <span class="inline-flex items-center rounded-full bg-orange-50 text-orange-600 px-2 py-0.5 text-[11px] uppercase tracking-[.18em]">Hidden</span>
                                @endunless
                                @if($report->file_path && !$report->download_url)
                                    <span class="inline-flex items-center rounded-full bg-red-50 text-red-600 px-2 py-0.5 text-[11px] uppercase tracking-[.18em]">Missing file — re-upload</span>
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <a href="{{ route('admin.transparency.edit', $report) }}"
                               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-[#2d6fa3] bg-[#2d6fa3]/10 rounded-full hover:bg-[#2d6fa3]/15 transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.transparency.destroy', $report) }}" method="POST" onsubmit="return confirm('Delete this report?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-full hover:bg-red-100 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</div>

@endsection
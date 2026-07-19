@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Welcome back, ' . auth()->user()->name)

@section('content')

{{-- Stat cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['label' => 'Total Articles',   'value' => $stats['news_total'],     'color' => 'bg-[#2d6fa3]', 'route' => 'admin.news.index'],
        ['label' => 'Published',        'value' => $stats['news_published'], 'color' => 'bg-[#8da83a]', 'route' => 'admin.news.index'],
        ['label' => 'Programs',         'value' => $stats['programs'],       'color' => 'bg-[#1d4e7a]', 'route' => 'admin.programs.index'],
        ['label' => 'Projects',         'value' => $stats['projects'],       'color' => 'bg-[#2d6fa3]', 'route' => 'admin.projects.index'],
        ['label' => 'Additional Pages', 'value' => $stats['page_items'],     'color' => 'bg-[#e8a020]', 'route' => 'admin.program-pages.index'],
        ['label' => 'Partners',         'value' => $stats['partners'],       'color' => 'bg-[#2d6fa3]', 'route' => 'admin.partners.index'],
        ['label' => 'Awards',           'value' => $stats['awards'],         'color' => 'bg-[#8da83a]', 'route' => 'admin.awards.index'],
    ] as $card)
    <a href="{{ route($card['route']) }}"
       class="bg-white rounded-2xl p-5 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="text-3xl font-black text-gray-800 mb-1">{{ $card['value'] }}</div>
        <div class="text-gray-400 text-xs">{{ $card['label'] }}</div>
        <div class="h-1 {{ $card['color'] }} rounded-full mt-3 w-8"></div>
    </a>
    @endforeach
</div>

{{-- Recent news --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
        <h2 class="font-bold text-gray-800">Recent Articles</h2>
        <a href="{{ route('admin.news.create') }}" class="btn-primary text-xs px-4 py-2">+ New Article</a>
    </div>

    {{-- Partner Categories Chart --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 hover-lift">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Partner Categories</h3>
                    <p class="text-xs text-gray-400">Distribution by category</p>
                </div>
            </div>
            <span class="text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full">{{ $chartData['partnerCategories']->sum() }} partners</span>
        </div>
        <div class="chart-container">
            @if(!$chartData['partnerCategories']->isEmpty())
            <canvas id="categoryChart"></canvas>
            @else
            <div class="flex flex-col items-center justify-center h-full text-center">
                <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <p class="text-gray-400 text-sm font-medium">No partners yet</p>
                <p class="text-gray-300 text-xs mt-1">Category distribution will appear once partners are added.</p>
            </div>
            @endif
        </div>
    </div>
    @else
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Title</th>
                <th class="px-6 py-3 text-left">Tags</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($recentNews as $article)
            <tr class="hover:bg-gray-50/50">
                <td class="px-6 py-3 font-medium text-gray-700 max-w-xs truncate">{{ $article->title }}</td>
                <td class="px-6 py-3 text-gray-400">{{ !empty($article->tag_links) ? collect($article->tag_links)->pluck('label')->implode(', ') : '—' }}</td>
                <td class="px-6 py-3">
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                        {{ $article->is_published ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-6 py-3 text-gray-400 text-xs">{{ $article->created_at->format('d M Y') }}</td>
                <td class="px-6 py-3 text-right">
                    <a href="{{ route('admin.news.edit', $article) }}" class="text-[#2d6fa3] hover:underline text-xs">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection
<<<<<<< HEAD
=======

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Chart === 'undefined') return;

    // ── Donation Trends (Bar Chart) ──
    const donationCtx = document.getElementById('donationChart')?.getContext('2d');
    if (donationCtx) {
        new Chart(donationCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['donationMonths']) !!},
                datasets: [{
                    label: 'Donations ($)',
                    data: {!! json_encode($chartData['donationTotals']) !!},
                    backgroundColor: 'rgba(232, 160, 32, 0.6)',
                    borderColor: '#e8a020',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                    hoverBackgroundColor: '#e8a020',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) { return '$' + ctx.raw.toLocaleString(); }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 100,
                        grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 11 },
                            precision: 0,
                            callback: function(value) { return '$' + value.toLocaleString(); }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 10 } }
                    }
                }
            }
        });
    }

    // ── Category Distribution (Doughnut Chart) ──
    const categoryCtx = document.getElementById('categoryChart')?.getContext('2d');
    if (categoryCtx) {
        const categoryLabels = {!! json_encode($chartData['partnerCategoryLabels']) !!};
        const categoryData = {!! json_encode($chartData['partnerCategories']) !!};
        const colors = ['#2d6fa3', '#8da83a', '#e8a020', '#1d4e7a', '#c4840a', '#4a7c59', '#6b7280', '#9ca3af'];

        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryData,
                    backgroundColor: colors.slice(0, categoryLabels.length),
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 16,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 11 },
                            color: '#64748b',
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) {
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total > 0 ? ((ctx.raw / total) * 100).toFixed(1) : 0;
                                return ctx.label + ': ' + ctx.raw + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // ── Donation by Type (Pie Chart) ──
    const typeCtx = document.getElementById('donationTypeChart')?.getContext('2d');
    if (typeCtx) {
        const typeData = {!! json_encode($chartData['donationByType']->pluck('total')) !!};
        const typeLabels = {!! json_encode($chartData['donationByType']->pluck('DonationType')) !!};
        const typeColors = {
            'Food': '#f97316',
            'Money': '#22c55e',
            'Clothes': '#3b82f6',
        };
        const bgColors = typeLabels.map(l => typeColors[l] || '#94a3b8');

        new Chart(typeCtx, {
            type: 'doughnut',
            data: {
                labels: typeLabels,
                datasets: [{
                    data: typeData,
                    backgroundColor: bgColors,
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 12,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 10 },
                            color: '#64748b',
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) {
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total > 0 ? ((ctx.raw / total) * 100).toFixed(1) : 0;
                                return ctx.label + ': $' + ctx.raw.toLocaleString() + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush
>>>>>>> fc15dc2970bbf006f0657bd29a72215570261c7e

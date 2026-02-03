@php
    $now = \Carbon\Carbon::now();
    $selectedMonth = (int) request()->get('cal_month', $now->month);
    $selectedYear = (int) request()->get('cal_year', $now->year);

    // Validate month and year
    $selectedMonth = max(1, min(12, $selectedMonth));
    $selectedYear = max(2000, min(2100, $selectedYear));

    $firstDay = \Carbon\Carbon::create($selectedYear, $selectedMonth, 1);
    $lastDay = $firstDay->copy()->endOfMonth();
    $startDate = $firstDay->copy()->startOfWeek(\Carbon\CarbonInterface::SUNDAY);
    $endDate = $lastDay->copy()->endOfWeek(\Carbon\CarbonInterface::SATURDAY);

    $monthsNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $daysShort = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
@endphp

<div class="animate-on-scroll">
    <x-website.components.layout.page-title title="Kalender" tag="h3" margin="mb-6" />

    <div class="bg-white border border-gray-100 shadow-sm overflow-hidden" data-calendar-init="true"
        data-selected-month="{{ $selectedMonth }}" data-selected-year="{{ $selectedYear }}"
        data-now-year="{{ $now->year }}" data-now-month="{{ $now->month }}" data-now-day="{{ $now->day }}">

        <!-- Header: Month & Navigation -->
        <div class="bg-green-700 px-4 py-3 flex items-center justify-between text-white">
            <button type="button" data-calendar-action="prev"
                class="p-1.5 hover:bg-white/20 rounded-lg transition-colors focus:outline-none group"
                aria-label="Bulan Sebelumnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="text-center">
                <h4 id="calendar-title"
                    class="text-xs sm:text-sm font-bold uppercase tracking-widest whitespace-nowrap">
                    {{ $monthsNames[$selectedMonth - 1] }} {{ $selectedYear }}
                </h4>
            </div>

            <button type="button" data-calendar-action="next"
                class="p-1.5 hover:bg-white/20 rounded-lg transition-colors focus:outline-none group"
                aria-label="Bulan Selanjutnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="p-3">
            <!-- Day Names -->
            <div class="grid grid-cols-7 mb-2">
                @foreach($daysShort as $day)
                    <div class="flex items-center justify-center py-1">
                        <span
                            class="text-[10px] sm:text-xs font-bold {{ $day === 'Min' ? 'text-red-500' : 'text-black' }} uppercase tracking-tighter">
                            {{ $day }}
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Calendar Days -->
            <div id="calendar-grid" class="grid grid-cols-7 border-t border-l border-gray-50">
                @php $currentDate = $startDate->copy(); @endphp
                @while($currentDate <= $endDate)
                    @php
                        $isCurrentMonth = $currentDate->month == $selectedMonth;
                        $isToday = $currentDate->isToday() && $currentDate->month == $now->month && $currentDate->year == $now->year;
                        $isSunday = $currentDate->dayOfWeek == 0;
                    @endphp
                    <div class="aspect-square border-r border-b border-gray-50 p-0.5 relative group">
                        <div data-date="{{ $currentDate->format('Y-m-d') }}"
                            class="w-full h-full flex flex-col items-center justify-center rounded transition-all duration-200 cursor-pointer
                                                                {{ $isCurrentMonth ? ($isSunday ? 'text-red-500' : 'text-gray-700') : 'text-gray-300' }}
                                                                {{ $isToday ? 'bg-green-700 text-white font-bold' : 'hover:bg-green-50 hover:text-green-700' }}">

                            <span
                                class="text-[10px] sm:text-sm {{ $isToday ? 'scale-110' : '' }} pointer-events-none">{{ $currentDate->day }}</span>

                            @if($isToday)
                                <span class="absolute top-1 right-1 w-1.5 h-1.5 bg-white rounded-full animate-pulse pointer-events-none"></span>
                            @endif
                        </div>
                    </div>
                    @php $currentDate->addDay(); @endphp
                @endwhile
            </div>
        </div>

        <!-- Footer Legend / Info -->
        <div class="bg-gray-50 px-3 py-2 border-t border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 bg-green-700 rounded-full"></span>
                <span class="text-[10px] text-gray-500 font-medium">Hari Ini</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 bg-black rounded-full"></span>
                <span class="text-[10px] text-gray-500 font-medium">Libur/Ahad</span>
            </div>
        </div>
    </div>
</div>
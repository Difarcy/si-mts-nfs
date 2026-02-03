export default function initCalendarWidget() {
    const calendarWidget = document.querySelector('[data-calendar-init="true"]');
    if (!calendarWidget) return;

    const prevBtn = calendarWidget.querySelector('[data-calendar-action="prev"]');
    const nextBtn = calendarWidget.querySelector('[data-calendar-action="next"]');
    const calendarTitle = document.getElementById('calendar-title');
    const calendarGrid = document.getElementById('calendar-grid');

    let currentMonth = parseInt(calendarWidget.dataset.selectedMonth);
    let currentYear = parseInt(calendarWidget.dataset.selectedYear);
    const nowYear = parseInt(calendarWidget.dataset.nowYear);
    const nowMonth = parseInt(calendarWidget.dataset.nowMonth);
    const nowDay = parseInt(calendarWidget.dataset.nowDay);

    // Track selected date string (YYYY-MM-DD). Default to null (no selection initially).
    let selectedDateStr = null;

    const monthNames = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    function renderCalendar(month, year) {
        // Update title
        calendarTitle.textContent = `${monthNames[month - 1]} ${year}`;

        // Clear grid
        calendarGrid.innerHTML = '';

        // Calculate dates
        const firstDay = new Date(year, month - 1, 1);
        const lastDay = new Date(year, month, 0);
        
        // Start from Sunday of the first week
        const startDate = new Date(firstDay);
        startDate.setDate(startDate.getDate() - startDate.getDay());

        // End at Saturday of the last week
        const endDate = new Date(lastDay);
        endDate.setDate(endDate.getDate() + (6 - endDate.getDay()));

        let currentDate = new Date(startDate);

        while (currentDate <= endDate) {
            const isCurrentMonth = currentDate.getMonth() === month - 1;
            const isToday = currentDate.getDate() === nowDay && 
                          currentDate.getMonth() === nowMonth - 1 && 
                          currentDate.getFullYear() === nowYear;
            const isSunday = currentDate.getDay() === 0;

            const dateStr = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(currentDate.getDate()).padStart(2, '0')}`;
            const isSelected = dateStr === selectedDateStr;

            const cell = document.createElement('div');
            cell.className = 'aspect-square border-r border-b border-gray-50 p-0.5 relative group';

            let contentClass = 'w-full h-full flex flex-col items-center justify-center rounded transition-all duration-200 cursor-pointer ';
            
            // Prioritize Selected Style
            if (isSelected) {
                contentClass += 'bg-green-700 text-white font-bold';
            } else {
                contentClass += 'hover:bg-green-50 hover:text-green-700 ';
                if (isCurrentMonth) {
                    contentClass += isSunday ? 'text-black' : 'text-gray-700';
                } else {
                    contentClass += 'text-gray-300';
                }
            }

            let innerHTML = `<div data-date="${dateStr}" class="${contentClass}">
                <span class="text-[10px] sm:text-sm ${isSelected ? 'scale-110' : ''} pointer-events-none">${currentDate.getDate()}</span>`;
            
            // Show dot for today if not selected (or even if selected? usually dot is good to keep)
            // If today is selected, the dot is white on green bg.
            // If today is NOT selected, dot is white? No, dot should be visible.
            // Let's keep the dot logic from blade: white dot.
            // But if today is NOT selected, the background is white. White dot on white bg is invisible.
            // So if today is NOT selected, dot should be green? 
            // In the original code: 
            // if (isToday) contentClass += 'bg-green-700 text-white font-bold';
            // innerHTML += '<span class="... bg-white ..."></span>'
            // So originally today was ALWAYS green bg.
            
            // Now, "Today" might NOT be selected.
            // If Today is NOT selected:
            // Bg is white/hover-green. Text is gray/black.
            // We need a marker for "Today".
            // Let's make the dot green if not selected, white if selected.
            
            if (isToday) {
                const dotColor = isSelected ? 'bg-white' : 'bg-green-700';
                innerHTML += `<span class="absolute top-1 right-1 w-1.5 h-1.5 ${dotColor} rounded-full animate-pulse pointer-events-none"></span>`;
            }
            
            innerHTML += '</div>';
            cell.innerHTML = innerHTML;
            calendarGrid.appendChild(cell);

            currentDate.setDate(currentDate.getDate() + 1);
        }
    }

    // Initial render is handled by Blade, but we need to attach the click listener.
    // And if we click on the initial Blade render, we need to handle it.
    // The initial Blade render doesn't have the "selected" logic fully dynamic yet
    // because PHP doesn't know about client-side clicks.
    // But we can make the JS listener re-render the calendar to apply the "selected" state correctly.
    // Or we can manually toggle classes.
    // Re-rendering is cleaner to ensure state consistency.

    calendarGrid.addEventListener('click', function(e) {
        const targetDiv = e.target.closest('[data-date]');
        if (!targetDiv) return;

        selectedDateStr = targetDiv.dataset.date;
        renderCalendar(currentMonth, currentYear);
    });

    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 1) {
                currentMonth = 12;
                currentYear--;
            }
            renderCalendar(currentMonth, currentYear);
        });

        nextBtn.addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
            }
            renderCalendar(currentMonth, currentYear);
        });
    }
}
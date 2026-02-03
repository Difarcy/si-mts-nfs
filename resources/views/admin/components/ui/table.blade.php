<div class="overflow-x-auto border border-black rounded-lg">
    <table {{ $attributes->merge(['class' => 'w-full text-sm text-left border-collapse']) }}>
        <thead class="bg-gray-50 border-b border-black text-black uppercase font-bold text-xs">
            {{ $thead }}
        </thead>
        <tbody class="divide-y divide-black">
            {{ $slot }}
        </tbody>
    </table>
</div>

<style>
    /* Styling agar garis kolom (vertikal) terlihat jelas */
    table.border-collapse th,
    table.border-collapse td {
        border-right: 1px solid #000000;
        /* black */
    }

    table.border-collapse th:last-child,
    table.border-collapse td:last-child {
        border-right: none;
    }
</style>

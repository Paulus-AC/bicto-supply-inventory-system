<section class="w-full">
    <div
        class="m-5 rounded-sm border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">

        <div class="px-5 flex flex-row items-center justify-between">
            <flux:heading variant="strong" size="xl">Details</flux:heading>
            <flux:button variant="primary" icon="arrow-left" :loading="false" :href="route('items.listing')">
                Back
            </flux:button>
        </div>

        <div class="p-5 pt-10 grid grid-cols-3 gap-5 md:grid-cols-4">
            <div>
                <flux:text variant="subtle">Item Name</flux:text>
                <flux:text variant="strong">{{ $items->name }}</flux:text>
            </div>
            <div>
                <flux:text variant="subtle">Category</flux:text>
                <flux:text variant="strong">{{ $items->category->name }}</flux:text>
            </div>
            <div>
                <flux:text variant="subtle">Unit</flux:text>
                <flux:text variant="strong">{{ $items->unit->name }}</flux:text>
            </div>
            <div>
                <flux:text variant="subtle">Instock</flux:text>
                <flux:badge color="{{ $items->balance === 0 ? 'red' : ($items->balance < 5 ? 'amber' : 'green') }}">
                    {{ $items->balance }}
                </flux:badge>
            </div>
            <div>
                <flux:text variant="subtle">Status</flux:text>
                <flux:text variant="strong">{{ $items->status ? 'Active' : 'Inactive' }}</flux:text>
            </div>
        </div>
    </div>

    <div
        class="m-5 mt-12 rounded-sm border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">

        <div class="px-5 flex flex-row items-center justify-between">
            <flux:heading variant="strong" size="xl">Stock Flow</flux:heading>
            <flux:button variant="primary" icon="plus" :loading="false">
                Add Transaction
            </flux:button>
        </div>

        <div class="mt-10">
            <div class="h-105">
                <flux:table container:class="max-h-96">
                    <flux:table.columns sticky class="bg-white dark:bg-zinc-900">
                        <flux:table.column align="center">ID</flux:table.column>
                        <flux:table.column align="center">Type</flux:table.column>
                        <flux:table.column align="center">Quantity</flux:table.column>
                        <flux:table.column align="center">Officer in Charge</flux:table.column>
                        <flux:table.column align="center">Requested By</flux:table.column>
                        <flux:table.column align="center">Transaction Date</flux:table.column>
                        <flux:table.column align="center">Remarks</flux:table.column>
                        <flux:table.column align="center">Actions</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        {{-- <flux:table.row>
                            <flux:table.cell align="center">1</flux:table.cell>
                            <flux:table.cell align="center">Stock In</flux:table.cell>
                            <flux:table.cell align="center">10</flux:table.cell>
                            <flux:table.cell align="center">John Doe</flux:table.cell>
                            <flux:table.cell align="center">Jane Smith</flux:table.cell>
                            <flux:table.cell align="center">2023-10-01 10:00:00</flux:table.cell>
                            <flux:table.cell align="center">Initial stock</flux:table.cell>
                            <flux:table.cell align="center">
                                <flux:button variant="primary" size="sm" icon="eye" :loading="false"></flux:button>
                                <flux:button variant="primary" size="sm" icon="pencil" :loading="false"></flux:button>
                            </flux:table.cell>
                        </flux:table.row> --}}
                        <flux:table.row>
                            <flux:table.cell colspan="7" align="center">
                                No transactions found.
                            </flux:table.cell>
                        </flux:table.row>
                    </flux:table.rows>
                </flux:table>
            </div>
        </div>
</section>
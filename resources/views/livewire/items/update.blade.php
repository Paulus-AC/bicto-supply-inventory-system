<div>
    <flux:modal :dismissable="false" name="update-item" class="md:w-lg">
        <form method="POST" wire:submit.prevent="updateItem" class="space-y-8">
            @csrf
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Update Item</flux:heading>
                    <flux:text class="mt-2">Modify the details of an existing item.</flux:text>
                </div>

                <!-- Name -->
                <flux:field>
                    <flux:input wire:model="form.name" name="name" label="Name" type="text" required autofocus
                            placeholder="Item name" />

                    <flux:error name="form.name" />
                </flux:field>

                <!-- Category -->
                <flux:field>
                    <flux:select wire:model="form.category_id" label="Category" required>
                        <flux:select.option value="">Choose a category...</flux:select.option>
                        @foreach($categories as $category)
                            <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                        @endforeach
                    </flux:select>

                    <flux:error name="form.category_id" />
                </flux:field>

                <!-- Unit -->
                <flux:field>
                    <flux:select wire:model="form.unit_id" name="unit_id" label="Unit" required>
                        <flux:select.option value="">Choose a unit...</flux:select.option>
                        @foreach ($units as $unit)
                            <flux:select.option value="{{ $unit->id }}">{{ $unit->name }}</flux:select.option>
                        @endforeach
                    </flux:select>

                    <flux:error name="form.unit_id" />
                </flux:field>

                <!-- Balance -->
                <flux:field>
                    <flux:input wire:model="form.balance" name="balance" label="Balance" type="number" readonly variant="filled"/>

                    <flux:error name="form.balance" />
                </flux:field>

                <!-- Status -->
                <flux:field>
                    <flux:label>Status</flux:label>
                    <flux:switch wire:model="form.status" name="status" />

                    <flux:error name="form.status" />
                </flux:field>

                <div class="flex items-center justify-end gap-4">
                    <flux:modal.close>
                        <flux:button variant="danger" wire:close="resetForm">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">Save</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
</div>
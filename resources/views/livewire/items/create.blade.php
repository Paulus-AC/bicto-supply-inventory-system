<div>
    <flux:modal :dismissible="false" name="create-item" class="md:w-lg">
        <form method="POST" wire:submit.prevent="createItem" class="space-y-8">
            @csrf
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Create Item</flux:heading>
                    <flux:text class="mt-2">Add a new item to the system.</flux:text>
                </div>

                <!-- Name -->
                <flux:field>
                    <flux:input wire:model="form.name" name="name" label="Name" type="text"
                        required autofocus autocomplete="name" :placeholder="__('Item name')" />

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
                    <flux:input wire:model="form.balance" name="balance" label="Balance"
                        type="number" required autocomplete="balance" placeholder="0" />

                    <flux:error name="form.balance" />
                </flux:field>

                <!-- Description -->
                <flux:field>
                    <flux:textarea wire:model.defer="form.description" name="description" label="Description"
                        placeholder="No lettuce, tomato, or onion..." />

                    <flux:error name="form.description" />
                </flux:field>
            </div>

            <div class="flex items-center justify-end gap-4">
                <flux:modal.close>
                    <flux:button variant="danger">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
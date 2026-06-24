<div>
    <flux:modal :dismissible="false" name="update-category" class="md:w-lg">
        <form method="POST" wire:submit.prevent="updateCategory" class="space-y-8">
            @csrf
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Update Category</flux:heading>
                    <flux:text class="mt-2">Update the category details.</flux:text>
                </div>

                <!-- Name -->
                <flux:field>
                    <flux:input wire:model="form.name" name="name" :label="__('Name')" :value="old('name')" type="text"
                        required autofocus autocomplete="name" :placeholder="__('Category name')" />

                    <flux:error name="form.name" />
                </flux:field>

                <!-- Status -->
                <flux:field>
                    <flux:label>Status</flux:label>
                    <flux:switch wire:model="form.status" name="status" />

                    <flux:error name="form.status" />
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

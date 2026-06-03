<flux:modal name="{{ $modalName }}" class="min-w-88">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $heading }}</flux:heading>
            <flux:text class="mt-2" variant="strong">
                {{ $subheading }}
            </flux:text>
        </div>
        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button wire:click="delete" type="submit" variant="danger">Delete</flux:button>
        </div>
    </div>
</flux:modal>
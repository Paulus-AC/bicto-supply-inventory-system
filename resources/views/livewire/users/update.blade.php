<div>
    <flux:modal :dismissable="false" name="update-user" class="md:w-lg">
        <form method="POST" wire:submit.prevent="updateUser" class="space-y-8">
            @csrf
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Update User</flux:heading>
                    <flux:text class="mt-2">Update the user's details.</flux:text>
                </div>

                <!-- Name -->
                <flux:field>
                    <flux:input wire:model="form.name" name="name" :label="__('Name')" type="text" required autofocus
                        autocomplete="name"/>

                    <flux:error name="form.name" />
                </flux:field>

                <!-- Employee ID -->
                <flux:field>
                    <flux:input wire:model="form.employee_id" name="employee_id" :label="__('Employee ID')" type="text"
                        required autofocus autocomplete="employee_id"/>

                    <flux:error name="form.employee_id" />
                </flux:field>

                <!-- Email Address -->
                <flux:field>
                    <flux:input wire:model="form.email" name="email" :label="__('Email address')" type="email" required
                        autocomplete="email"/>

                    <flux:error name="form.email" />
                </flux:field>

                <!-- Role -->
                <flux:field>
                    <flux:select wire:model="form.role" name="role" :label="__('Role')" required>
                        <option value="" disabled selected>{{ __('Select a role') }}</option>
                        @foreach (\App\Models\User::ROLE_TYPES as $role => $label)
                            <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>
                                {{ __($label) }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:error name="form.role" />
                </flux:field>

                <!-- Password -->
                <flux:field>
                    <flux:input wire:model="form.password" name="password" :label="__('Password')" type="password"
                        autocomplete="new-password" :placeholder="__('Password')"
                        passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                        viewable />
                    <flux:error name="form.password" />
                </flux:field>

                <!-- Confirm Password -->
                <flux:field>
                    <flux:input wire:model="form.password_confirmation" name="password_confirmation"
                        :label="__('Confirm password')" type="password" autocomplete="new-password"
                        :placeholder="__('Confirm password')"
                        passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                        viewable />
                    <flux:error name="form.password_confirmation" />
                </flux:field>

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
</div>
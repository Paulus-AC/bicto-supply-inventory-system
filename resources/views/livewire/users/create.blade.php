<div>
    <flux:modal :dismissible="false" name="create-user" class="w-full max-w-lg md:w-96">
        <form method="POST" wire:submit="createUser" class="space-y-8">
            @csrf
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Create User</flux:heading>
                    <flux:text class="mt-2">Add a new user to the system.</flux:text>
                </div>

                <!-- Name -->
                <flux:field>
                    <flux:input wire:model="form.name" name="name" :label="__('Name')" :value="old('name')" type="text"
                        required autofocus autocomplete="name" :placeholder="__('Full name')" />

                    <flux:error name="form.name" />
                </flux:field>

                <!-- Employee ID -->
                <flux:field>
                    <flux:input wire:model="form.employee_id" name="employee_id" :label="__('Employee ID')"
                        :value="old('employee_id')" type="text" required autofocus autocomplete="employee_id"
                        :placeholder="__('Employee ID')" />

                    <flux:error name="form.employee_id" />
                </flux:field>

                <!-- Email Address -->
                <flux:field>
                    <flux:input wire:model="form.email" name="email" :label="__('Email address')" :value="old('email')"
                        type="email" required autocomplete="email" placeholder="email@example.com" />

                    <flux:error name="form.email" />
                </flux:field>

                <!-- Role Selection -->
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
                        required autocomplete="new-password" :placeholder="__('Password')"
                        passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                        viewable />
                    <flux:error name="form.password" />
                </flux:field>

                <!-- Confirm Password -->
                <flux:field>
                    <flux:input wire:model="form.password_confirmation" name="password_confirmation"
                        :label="__('Confirm password')" type="password" required autocomplete="new-password"
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
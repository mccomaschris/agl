<x-layouts.app>
    <flux:card class="w-full max-w-80 space-y-6 mx-auto mt-12">
        <div class="space-y-2 text-center">
            <flux:heading size="xl">Forgot password?</flux:heading>
            <flux:text>Enter your email address and we’ll send you a link to reset your password.</flux:text>
        </div>

        <x-auth-session-status :status="session('status')" role="status" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <flux:field>
                <flux:label for="email">Email</flux:label>
                <flux:input id="email" name="email" type="email" placeholder="email@example.com" :value="old('email')" required autofocus autocomplete="email" />
                <flux:error name="email" />
            </flux:field>

            <flux:button variant="primary" class="w-full" type="submit">Send reset link</flux:button>
        </form>

        <div class="text-center">
            <flux:link href="{{ route('login') }}" variant="subtle" class="text-sm">Back to login</flux:link>
        </div>
    </flux:card>
</x-layouts.app>

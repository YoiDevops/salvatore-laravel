<x-layouts::auth :title="__('Log in')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="'Ingresa a tu cuenta'" :description="'Usa tus datos de acceso para continuar en el portal.'" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <x-passkey-verify />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Identificador -->
            <flux:input
                name="email"
                :label="'Número de documento, usuario o correo'"
                :value="old('email')"
                type="text"
                required
                autofocus
                autocomplete="username"
                aria-describedby="login-identifier-help"
                placeholder="Documento, usuario o correo"
            />
            <p id="login-identifier-help" class="-mt-4 text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                Si tu cuenta fue aprobada, ingresa el documento del estudiante y la contraseña enviada al correo. Administradores y cuentas de prueba pueden usar su usuario o correo.
            </p>

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="'Contraseña'"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    Ingresar al sistema
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Don\'t have an account?') }}</span>
            <flux:link
                :href="route('register')"
                data-test="register-link"
                wire:navigate
            >
                {{ __('Sign up') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth>

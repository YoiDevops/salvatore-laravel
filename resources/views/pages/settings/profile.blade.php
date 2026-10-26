<?php

use App\Concerns\ProfileValidationRules;
use App\Models\Estudiante\Estudiante;
use App\Models\Profesor\Profesor;
/* @chisel-email-verification */
use Flux\Flux;
/* @end-chisel-email-verification */
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Profile settings')] class extends Component
{
    use ProfileValidationRules;

    public string $name = '';

    public string $email = '';

    #[Computed]
    public function roleProfile(): array
    {
        $user = Auth::user();
        $role = strtolower(trim((string) ($user->effective_role ?? '')));
        $roleLabel = match ($role) {
            'administrador', 'admin', '1' => 'Administrador',
            'profesor', '2' => 'Profesor',
            'estudiante', '3' => 'Estudiante',
            'acudiente' => 'Acudiente',
            default => $user->effective_role ?: 'Usuario',
        };

        $sections = [
            [
                'title' => 'Cuenta del sistema',
                'items' => [
                    ['label' => 'Rol', 'value' => $roleLabel],
                    ['label' => 'Estado de la cuenta', 'value' => $user->estado ?? $user->status ?? null],
                    ['label' => 'Correo de acceso', 'value' => $user->email],
                ],
            ],
        ];
        $personalDetails = [
            ['label' => 'Nombre del perfil', 'value' => $user->name],
        ];
        $hasRoleRecord = true;

        if (in_array($role, ['profesor', '2'], true)) {
            $profesor = Profesor::query()
                ->where('id_usuario', $user->id_users)
                ->first();

            $hasRoleRecord = $profesor !== null;

            if ($profesor) {
                $personalDetails = [
                    ['label' => 'Nombre completo', 'value' => trim($profesor->nombres_profesor.' '.$profesor->apellidos_profesor)],
                    ['label' => 'Documento de identidad', 'value' => trim($profesor->tipo_documento.' '.$profesor->documento_profesor)],
                ];
                $sections[] = [
                    'title' => 'Datos de contacto',
                    'items' => [
                        ['label' => 'Correo institucional', 'value' => $profesor->correo_profesor],
                        ['label' => 'Teléfono', 'value' => $profesor->telefono_profesor],
                        ['label' => 'Dirección de residencia', 'value' => $profesor->direccion_residencia],
                    ],
                ];
                $sections[] = [
                    'title' => 'Datos laborales',
                    'items' => [
                        ['label' => 'Fecha de ingreso', 'value' => $profesor->fecha_ingreso_colegio
                            ? Carbon::parse($profesor->fecha_ingreso_colegio)->format('d/m/Y')
                            : null],
                        ['label' => 'Tipo de vinculación', 'value' => $profesor->tipo_contra],
                        ['label' => 'Estado docente', 'value' => $profesor->estado_profesor],
                    ],
                ];
            } else {
                $personalDetails = [
                    ['label' => 'Nombre del perfil', 'value' => $user->name],
                    ['label' => 'Documento de identidad', 'value' => null],
                ];
            }
        } elseif (in_array($role, ['estudiante', '3'], true)) {
            $estudiante = Estudiante::query()
                ->with(['curso.grado', 'curso.sede', 'acudiente', 'caracterizacion'])
                ->where('id_usuario', $user->id_users)
                ->first();

            $hasRoleRecord = $estudiante !== null;

            if ($estudiante) {
                $personalDetails = [
                    ['label' => 'Nombre completo', 'value' => trim($estudiante->nombres_estudiante.' '.$estudiante->apellidos_estudiante)],
                    ['label' => 'Documento de identidad', 'value' => trim($estudiante->tipo_documento.' '.$estudiante->documento_identidad)],
                    ['label' => 'Fecha de nacimiento', 'value' => $estudiante->fecha_nacimiento
                        ? Carbon::parse($estudiante->fecha_nacimiento)->format('d/m/Y')
                        : null],
                    ['label' => 'Sexo', 'value' => $estudiante->genero],
                    ['label' => 'Tipo de sangre', 'value' => $estudiante->tipo_sangre],
                    ['label' => 'Lugar de nacimiento', 'value' => $estudiante->lugar_nacimiento],
                ];
                $sections[] = [
                    'title' => 'Datos de contacto',
                    'items' => [
                        ['label' => 'Correo de acceso', 'value' => $user->email],
                    ],
                ];
                $sections[] = [
                    'title' => 'Información escolar',
                    'items' => [
                        ['label' => 'EPS', 'value' => $estudiante->eps],
                        ['label' => 'Estado académico', 'value' => $estudiante->estado_estudiante],
                    ],
                ];

                $sections[] = [
                    'title' => 'Datos académicos',
                    'items' => [
                        ['label' => 'Curso', 'value' => $estudiante->curso?->nombre_curso],
                        ['label' => 'Grado', 'value' => $estudiante->curso?->grado?->nombre_grado],
                        ['label' => 'Jornada', 'value' => $estudiante->curso?->jornada],
                        ['label' => 'Año lectivo', 'value' => $estudiante->curso?->ano_lectivo],
                        ['label' => 'Sede', 'value' => $estudiante->curso?->sede?->nombre_sede],
                    ],
                ];

                if ($estudiante->acudiente) {
                    $acudiente = $estudiante->acudiente;
                    $sections[] = [
                        'title' => 'Contacto familiar',
                        'items' => [
                            ['label' => 'Nombre', 'value' => trim($acudiente->nombres_acudiente.' '.$acudiente->apellidos_acudiente)],
                            ['label' => 'Documento', 'value' => trim($acudiente->tipo_documento.' '.$acudiente->documento_identidad)],
                            ['label' => 'Parentesco', 'value' => $acudiente->parentesco_estudiante],
                            ['label' => 'Teléfono', 'value' => $acudiente->telefono_acudiente],
                            ['label' => 'Correo', 'value' => $acudiente->correo_acudiente],
                            ['label' => 'Ocupación', 'value' => $acudiente->ocupacion],
                            ['label' => 'Lugar de trabajo', 'value' => $acudiente->lugar_trabajo],
                            ['label' => 'Dirección', 'value' => $acudiente->direccion_residencia],
                        ],
                    ];
                }

                if ($estudiante->caracterizacion) {
                    $caracterizacion = $estudiante->caracterizacion;
                    $sections[] = [
                        'title' => 'Caracterización y apoyos',
                        'items' => [
                            ['label' => 'Tipo', 'value' => $caracterizacion->tipo_discapacidad],
                            ['label' => 'Diagnóstico', 'value' => $caracterizacion->diagnostico],
                            ['label' => 'Grado', 'value' => $caracterizacion->grado_discapacidad],
                            ['label' => 'Permanencia', 'value' => $caracterizacion->permanencia],
                            ['label' => 'Grado de atención', 'value' => $caracterizacion->grado_atencion],
                        ],
                    ];
                }
            } else {
                $personalDetails = [
                    ['label' => 'Nombre del perfil', 'value' => $user->name],
                    ['label' => 'Documento de identidad', 'value' => null],
                ];
            }
        }

        return [
            'role' => $roleLabel,
            'personalDetails' => $personalDetails,
            'sections' => $sections,
            'hasRoleRecord' => $hasRoleRecord,
        ];
    }

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate($this->profileRules($user->id_users));

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        Flux::toast(variant: 'success', text: __('Profile updated.'));
    }

    /* @chisel-email-verification */
    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        return Auth::user() instanceof MustVerifyEmail && ! Auth::user()->hasVerifiedEmail();
    }

    #[Computed]
    public function showDeleteUser(): bool
    {
        return ! Auth::user() instanceof MustVerifyEmail
            || (Auth::user() instanceof MustVerifyEmail && Auth::user()->hasVerifiedEmail());
    }
    /* @end-chisel-email-verification */
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Profile settings') }}</flux:heading>

    <x-pages::settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                {{-- @chisel-email-verification --}}
                @if ($this->hasUnverifiedEmail)
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
                {{-- @end-chisel-email-verification --}}
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full" data-test="update-profile-button">
                        {{ __('Save') }}
                    </flux:button>
                </div>

            </div>
        </form>

        <section class="mt-10 space-y-5" aria-labelledby="role-profile-heading">
            <div>
                <flux:heading id="role-profile-heading" size="lg">Información de {{ strtolower($this->roleProfile['role']) }}</flux:heading>
                <flux:subheading class="mt-1">Datos de tu cuenta y la información relacionada con tu rol en la institución.</flux:subheading>
            </div>

            @if (! $this->roleProfile['hasRoleRecord'] && in_array(strtolower($this->roleProfile['role']), ['profesor', 'estudiante'], true))
                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-900 dark:border-amber-900/60 dark:bg-amber-950/30 dark:text-amber-200">
                    Esta cuenta no tiene una ficha de {{ strtolower($this->roleProfile['role']) }} vinculada. Por eso todavía no podemos mostrar su documento ni sus demás datos personales. La institución debe asociar esta cuenta con el registro correspondiente.
                </div>
            @endif

            <article class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-[#3c4043] dark:bg-[#1e1f20] sm:p-6">
                <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Datos personales</h3>
                <dl class="mt-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($this->roleProfile['personalDetails'] as $item)
                        <div class="min-w-0">
                            <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ $item['label'] }}</dt>
                            <dd class="mt-1 break-words text-sm text-zinc-800 dark:text-zinc-100">
                                {{ filled($item['value']) ? $item['value'] : 'Sin registrar' }}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </article>

            <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
                @foreach ($this->roleProfile['sections'] as $section)
                    <article class="min-w-0 rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-[#3c4043] dark:bg-[#1e1f20] sm:p-6">
                        <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ $section['title'] }}</h3>

                        <dl class="mt-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
                            @foreach ($section['items'] as $item)
                                <div class="min-w-0">
                                    <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">{{ $item['label'] }}</dt>
                                    <dd class="mt-1 break-words text-sm text-zinc-800 dark:text-zinc-100">
                                        {{ filled($item['value']) ? $item['value'] : 'Sin registrar' }}
                                    </dd>
                                </div>
                            @endforeach
                        </dl>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- @chisel-email-verification --}}
        @if ($this->showDeleteUser)
        {{-- @end-chisel-email-verification --}}
            <livewire:pages::settings.delete-user-form />
        {{-- @chisel-email-verification --}}
        @endif
        {{-- @end-chisel-email-verification --}}
    </x-pages::settings.layout>
</section>

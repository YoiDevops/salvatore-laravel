@props(['icon', 'title', 'description'])

<div {{ $attributes->class('flex flex-col items-center justify-center px-6 py-10 text-center') }} role="status">
    <flux:icon :name="$icon" class="mb-3 size-10 text-slate-400 dark:text-slate-500" />
    <h3 class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $title }}</h3>
    <p class="mt-1 max-w-md text-sm leading-6 text-slate-400 dark:text-slate-500">{{ $description }}</p>
</div>

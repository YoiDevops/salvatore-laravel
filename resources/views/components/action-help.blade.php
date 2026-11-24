<p role="note" {{ $attributes->merge(['class' => 'flex min-w-0 items-start gap-2 rounded-xl border border-zinc-200 bg-zinc-50 px-3 py-2 text-sm leading-5 text-zinc-700 dark:border-zinc-700 dark:bg-[#202124] dark:text-zinc-300']) }}>
    <flux:icon name="information-circle" class="mt-0.5 size-4 shrink-0 text-[#8a681b] dark:text-[#d8b85c]" aria-hidden="true" />
    <span class="min-w-0">{{ $slot }}</span>
</p>

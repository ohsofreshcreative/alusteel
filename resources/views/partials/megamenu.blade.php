{{-- Mega menu (desktop) — dane z App\Support\MegaMenu, renderowane przez DropdownWalker --}}
<li
  x-data="{ open: false, active: 0, timer: null }"
  @mouseenter="clearTimeout(timer); open = true"
  {{-- Opóźnione zamknięcie: kursor przechodzi przez padding headera między linkiem a panelem --}}
  @mouseleave="timer = setTimeout(() => open = false, 250)"
  @focusin="open = true"
  @focusout="if (!$el.contains($event.relatedTarget)) open = false"
  @keydown.escape="open = false; $refs.trigger.focus()"
  class="{{ implode(' ', (array) $item->classes) }}">
  <a x-ref="trigger" href="{{ $item->url }}" class="inline-flex items-center gap-x-1 text-sm! xl:text-base! font-medium" aria-haspopup="true" :aria-expanded="open.toString()">
    {{ $item->title }}
    <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
  </a>

  <div
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    class="__megamenu absolute inset-x-0 top-full z-20 flex bg-white text-secondary shadow-2xl"
    style="display: none;">

    @if (!empty($panels))
    <ul class="w-1/4 shrink-0 border-r border-secondary-50">
      @foreach ($panels as $panel)
      <li class="border-b border-secondary-50 last:border-b-0">
        <a
          href="{{ $panel['url'] }}"
          @mouseenter="active = {{ $loop->index }}"
          @focus="active = {{ $loop->index }}"
          {{-- Klawiatura: strzałka w prawo przenosi fokus do linków aktywnego panelu --}}
          @keydown.right.prevent="$refs.panel{{ $loop->index }}.querySelector('a')?.focus()"
          :class="active === {{ $loop->index }} && 'bg-secondary-50/40'"
          class="flex items-center gap-6 px-16 py-12 !text-secondary transition-colors hover:bg-secondary-50/40">
          @if ($panel['icon'])
          <span class="w-10 h-10 shrink-0">
            {!! wp_get_attachment_image($panel['icon'], 'thumbnail', false, ['class' => 'w-full h-full object-contain', 'alt' => '']) !!}
          </span>
          @endif
          <span>{{ $panel['title'] }}</span>
        </a>
      </li>
      @endforeach
    </ul>

    <div class="grid grow p-14">
      @foreach ($panels as $panel)
      <div
        x-ref="panel{{ $loop->index }}"
        x-show="active === {{ $loop->index }}"
        x-transition.opacity.duration.200ms
        class="[grid-area:1/1]"
        @if (!$loop->first) x-cloak @endif>
        @if (!empty($panel['columns']))
        <div class="flex flex-col h-full">
        <p class="text-h7 uppercase text-secondary-300 m-header">{{ $panel['title'] }}</p>
        <div class="grid grid-cols-3 gap-10 pb-10">
          @foreach ($panel['columns'] as $column)
          <div class="flex flex-col gap-4">
            @if ($column['title'])
            <p class="m-header">{{ $column['title'] }}</p>
            @endif
            @foreach ($column['items'] as $product)
            <a href="{{ $product['url'] }}" class="!text-primary-900 hover:!text-primary-600 transition-colors">{{ $product['title'] }}</a>
            @endforeach
          </div>
          @endforeach
        </div>
        {{-- Belka na dole panelu: link do całej kategorii --}}
        <a href="{{ $panel['url'] }}" class="group flex items-center justify-between gap-6 mt-auto pt-10 border-t border-secondary-50 !text-primary-600">
          <span>Wszystkie produkty: {{ $panel['title'] }}</span>
          <span class="inline-flex items-center gap-3">
            Sprawdź wszystkie
            <x-icon.arrow-up class="-rotate-90 transition-transform group-hover:translate-x-1" />
          </span>
        </a>
        </div>
        @else
        <div class="flex flex-col gap-4">
          <p class="text-h5 uppercase">{{ $panel['title'] }}</p>
          @if (!empty($panel['text']))
          <div class="__txt">{!! wp_kses_post($panel['text']) !!}</div>
          @endif
          <a href="{{ $panel['url'] }}" class="group inline-flex items-center gap-3 !text-primary-600">
            Dowiedz się więcej
            <x-icon.arrow-up class="-rotate-90 transition-transform group-hover:translate-x-1" />
          </a>
        </div>
        @endif
      </div>
      @endforeach
    </div>
    @endif

    @if (!empty($promo['image']['ID']))
    <div class="relative w-1/4 shrink-0 flex flex-col justify-end gap-6 p-8 overflow-hidden">
      <figure class="absolute inset-0 m-0 after:absolute after:inset-0 after:bg-linear-to-t after:from-black/80 after:to-transparent">
        {!! wp_get_attachment_image($promo['image']['ID'], 'large', false, ['class' => 'w-full h-full object-cover', 'alt' => '']) !!}
      </figure>
      @if (!empty($promo['header']))
      <p class="relative text-h4 uppercase text-white">{{ $promo['header'] }}</p>
      @endif
      @if (!empty($promo['button']['url']) && !empty($promo['button']['title']))
      <div class="relative">
        <x-button :href="$promo['button']['url']" variant="primary" class="!rounded-none">
          {{ $promo['button']['title'] }}
        </x-button>
      </div>
      @endif
    </div>
    @endif
  </div>
</li>

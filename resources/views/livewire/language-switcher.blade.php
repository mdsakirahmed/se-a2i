<div>
    <div class="lang-text">
        <a href="#" wire:click="change_language">
            <div class="language_switcher_text">{{ __('Change Language') }}</div>
            @if(App::isLocale('en'))
            <img class="language_switcher_image" src="{{ asset('assets/img/uk-flag.png') }}" />
            @else
            <img class="language_switcher_image" src="{{ asset('assets/img/bd-flag.png') }}" />
            @endif
        </a>
    </div>
   
</div>

<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
    @foreach($locales as $lang)
        @if($lang != app()->getLocale())
            <small><a href="{{ '/lang/'.$lang }}" class="dropdown-item">{{(trans('menus.language-picker.langs.'.$lang)) ? trans('menus.language-picker.langs.'.$lang) : $lang  }}</a></small>
        @endif
    @endforeach
</div>

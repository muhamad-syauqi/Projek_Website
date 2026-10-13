@props(['name'])

@php
    $paths = [
        'dash'   => '<rect x="3" y="3" width="7.5" height="9" rx="2"/><rect x="13.5" y="3" width="7.5" height="5.5" rx="2"/><rect x="13.5" y="12" width="7.5" height="9" rx="2"/><rect x="3" y="15.5" width="7.5" height="5.5" rx="2"/>',
        'pkg'    => '<path d="M12 3l8 4.2v9.6L12 21l-8-4.2V7.2z"/><path d="M4 7.2l8 4.3 8-4.3M12 11.5V21"/>',
        'img'    => '<rect x="3" y="4" width="18" height="16" rx="3"/><circle cx="9" cy="10" r="1.8"/><path d="M4 18l5.5-5.5 4 4 2.5-2.5L20 18"/>',
        'web'    => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c3 3.2 3 14.8 0 18M12 3c-3 3.2-3 14.8 0 18"/>',
        'out'    => '<path d="M9 4H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h4M16 8l4 4-4 4M20 12H9"/>',
        'plus'   => '<path d="M12 5v14M5 12h14"/>',
        'edit'   => '<path d="M4 20h4L19 9a2.8 2.8 0 0 0-4-4L4 16z"/><path d="M13.5 6.5l4 4"/>',
        'trash'  => '<path d="M4 7h16M10 11v6M14 11v6M6 7l1 12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-12M9 7V4h6v3"/>',
        'search' => '<circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/>',
        'check'  => '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
        'up'     => '<path d="M12 16V5M7 9l5-5 5 5M4 19h16"/>',
        'mail'   => '<rect x="3" y="5" width="18" height="14" rx="3"/><path d="M4 7l8 6 8-6"/>',
        'lock'   => '<rect x="5" y="11" width="14" height="9" rx="3"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>',
        'eye'    => '<path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'arrow'  => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'menu'   => '<path d="M4 7h16M4 12h16M4 17h16"/>',
        'warn'   => '<path d="M12 3l10 18H2z"/><path d="M12 10v5M12 18v.5"/>',
    ];
@endphp

<svg {{ $attributes->merge(['class' => 'ic']) }} viewBox="0 0 24 24" aria-hidden="true">{!! $paths[$name] ?? '' !!}</svg>
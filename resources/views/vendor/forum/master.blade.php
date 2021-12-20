@section('title', 'Forum')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if (isset($thread))
        {{ $thread->title }} -
        @endif
        @if (isset($category))
        {{ $category->title }} -
        @endif
        @yield('title') - {{ config('app.name', 'Noodle') }}
    </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/img/noodle.png" type="image/icon type" />

    <!-- Scripts -->
    @hasSection('main')
    <script src="{{ asset('js/app.js') }}" defer></script>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap (https://github.com/twbs/bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Feather icons (https://github.com/feathericons/feather) -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- Vue (https://github.com/vuejs/vue) -->
    @if (config('app.debug'))
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    @else
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    @endif

    <!-- Axios (https://github.com/axios/axios) -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Pickr (https://github.com/Simonwep/pickr) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

    <!-- Sortable (https://github.com/SortableJS/Sortable) -->
    <script src="//cdn.jsdelivr.net/npm/sortablejs@1.10.1/Sortable.min.js"></script>
    <!-- Vue.Draggable (https://github.com/SortableJS/Vue.Draggable) -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.23.2/vuedraggable.umd.min.js"></script>

    <style>
        body {
            padding: 0;
            background: #f8fafc;
        }

        textarea {
            min-height: 200px;
        }

        table tr td {
            white-space: nowrap;
        }

        a {
            text-decoration: none;
        }

        .deleted {
            opacity: 0.65;
        }

        #main {
            padding: 2em;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card.category {
            margin-bottom: 1em;
        }

        .list-group .list-group {
            min-height: 1em;
            margin-top: 1em;
        }

        .btn svg.feather {
            width: 16px;
            height: 16px;
            stroke-width: 3px;
            vertical-align: -2px;
        }

        .btn-outline-success:hover {
            background: green
        }

        .modal-title svg.feather {
            margin-right: .5em;
            vertical-align: -3px;
        }

        .category .subcategories {
            background: #fff;
        }

        .category>.list-group-item {
            z-index: 1000;
        }

        .category .subcategories .list-group-item:first-child {
            border-radius: 0;
        }

        .timestamp {
            border-bottom: 1px dotted var(--bs-gray);
            cursor: help;
        }

        .fixed-bottom-right {
            position: fixed;
            right: 0;
            bottom: 0;
        }

        .fade-enter-active,
        .fade-leave-active {
            transition: opacity .3s;
        }

        .fade-enter,
        .fade-leave-to {
            opacity: 0;
        }

        .mask {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(50, 50, 50, .2);
            opacity: 0;
            transition: opacity .2s ease;
            z-index: 1020;
        }

        .mask.show {
            opacity: 1;
        }

        .form-check {
            user-select: none;
        }

        .sortable-chosen {
            background: var(--bs-light);
        }

        @media (max-width: 575.98px) {
            #main {
                padding: 1em;
            }
        }

        .breadcrumb {
            padding: 0.75rem 1rem;
            margin-top: 1rem;
        }

        .liked {
            background: seagreen;
            stroke: white;
            color: white;
        }

        .liked:hover {
            background: lightgreen;
            stroke: green;
            color: green;
        }

        .not-liked:hover {
            background: lightgreen;
            stroke: green;
            color: green;
        }




        .btn svg.like {
            width: 16px;
            height: 16px;
            stroke-width: 3px;
            vertical-align: -2px;
        }
    </style>
</head>

<body style="body">
    <nav class="v-navbar navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            @if (Auth::check())
            <a href="/home">
                <img src="/img/noodle.png" alt="Noodle Logo" style="height: 35px; width: 35px; margin-right: 3px;" />
            </a>
            @else
            <a href="/">
                <img src="/img/noodle.png" alt="Noodle Logo" style="height: 35px; width: 35px; margin-right: 3px;" />
            </a>
            @endif
            @if (Auth::check())
            <a class="navbar-brand" href="/home">Noodle</a>
            @else
            <a class="navbar-brand" href="/">Noodle</a>
            @endif
            <button class="navbar-toggler" type="button" :class="{ collapsed: isCollapsed }" @click="isCollapsed = ! isCollapsed">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" :class="{ show: !isCollapsed }">
                <ul class="navbar-nav me-auto">
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/room" style="color: #1E90FF;">Room</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/professors" style="color: #1E90FF;">Professors</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <ul class="navbar-nav">
                            @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="/project" style="color: #1E90FF;">Project</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="forumDropDownMenuLink" @click="isForumDropdownCollapsed = ! isForumDropdownCollapsed" style="color: #1E90FF;">
                                    Forum
                                </a>
                                <div class="dropdown-menu" :class="{ show: ! isForumDropdownCollapsed }" aria-labelledby="forumDropDownMenuLink">
                                    <a class="dropdown-item" href="/forum">Index</a>
                                    <a class="dropdown-item" href="{{ route('forum.recent') }}">{{ trans('forum::threads.recent') }}</a>
                                    @auth
                                    <a class="dropdown-item" href="{{ route('forum.unread') }}">{{ trans('forum::threads.unread_updated') }}</a>
                                    @endauth
                                    @can ('moveCategories')
                                    <a class="dropdown-item" href="{{ route('forum.category.manage') }}">{{ trans('forum::general.manage') }}</a>
                                    @endcan
                                </div>
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" @click="isUserDropdownCollapsed = ! isUserDropdownCollapsed">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" :class="{ show: ! isUserDropdownCollapsed }" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('profile') }}">

                                {{ __('Profile') }}
                            </a>


                            <a class="dropdown-item" href="{{ route('about') }}">

                                {{ __('About') }}
                            </a>

                            <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log out
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Log in</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @hasSection('content')
    <div id="forum" class="container">
        @include('forum::partials.breadcrumbs')
        @include('forum::partials.alerts')

        @yield('content')
    </div>
    @endif

    @hasSection('main')
    <div id="main" class="container">
        <notification-component></notification-component>
        @yield('main')
    </div>
    @endif
    <div class="mask"></div>

    <a href="https://github.com/dBaliukynas/noodle/releases/tag/v0.1" style="position: absolute; bottom: 0; right: 0; color: black;"><strong>v0.1</strong></a>

    <script>
        new Vue({
            el: '.v-navbar',
            name: 'Navbar',
            data: {
                isCollapsed: true,
                isUserDropdownCollapsed: true,
                isForumDropdownCollapsed: true
            },
            methods: {
                onWindowClick(event) {
                    const ignore = ['navbar-toggler', 'navbar-toggler-icon', 'dropdown-toggle', ];
                    if (ignore.some(className => event.target.classList.contains(className))) return;
                    if (!this.isCollapsed) this.isCollapsed = true;
                    if (!this.isUserDropdownCollapsed) this.isUserDropdownCollapsed = true;
                    if (!this.isForumDropdownCollapsed) this.isForumDropdownCollapsed = true;
                }
            },
            created: function() {
                window.addEventListener('click', this.onWindowClick);
            }
        });

        const mask = document.querySelector('.mask');

        function findModal(key) {
            const modal = document.querySelector(`[data-modal=${key}]`);

            if (!modal) throw `Attempted to open modal '${key}' but no such modal found.`;

            return modal;
        }

        function openModal(modal) {
            modal.style.display = 'block';
            mask.style.display = 'block';
            setTimeout(function() {
                modal.classList.add('show');
                mask.classList.add('show');
            }, 200);
        }

        document.querySelectorAll('[data-open-modal]').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();

                openModal(findModal(event.target.dataset.openModal));
            });
        });

        document.querySelectorAll('[data-modal]').forEach(modal => {
            modal.addEventListener('click', event => {
                if (event.target.hasAttribute('data-close-modal')) {
                    modal.classList.remove('show');
                    mask.classList.remove('show');
                    setTimeout(function() {
                        modal.style.display = 'none';
                        mask.style.display = 'none';
                    }, 200);
                }
            });
        });

        document.querySelectorAll('[data-dismiss]').forEach(item => {
            item.addEventListener('click', event => event.target.parentElement.style.display = 'none');
        });

        document.addEventListener('DOMContentLoaded', event => {
            const hash = window.location.hash.substr(1);
            if (hash.startsWith('modal=')) {
                openModal(findModal(hash.replace('modal=', '')));
            }

            feather.replace();

            const input = document.querySelector('input[name=color]');

            if (!input) return;

            const pickr = Pickr.create({
                el: '.pickr',
                theme: 'classic',
                default: input.value || null,

                swatches: [
                    '{{ config('
                    forum.web.default_category_color ') }}',
                    '#f44336',
                    '#e91e63',
                    '#9c27b0',
                    '#673ab7',
                    '#3f51b5',
                    '#2196f3',
                    '#03a9f4',
                    '#00bcd4',
                    '#009688',
                    '#4caf50',
                    '#8bc34a',
                    '#cddc39',
                    '#ffeb3b',
                    '#ffc107'
                ],

                components: {
                    preview: true,
                    hue: true,
                    interaction: {
                        input: true,
                        save: true
                    }
                },

                strings: {
                    save: 'Apply'
                }
            });

            pickr
                .on('save', instance => pickr.hide())
                .on('clear', instance => {
                    input.value = '';
                    input.dispatchEvent(new Event('change'));
                })
                .on('cancel', instance => {
                    const selectedColor = instance
                        .getSelectedColor()
                        .toHEXA()
                        .toString();

                    input.value = selectedColor;
                    input.dispatchEvent(new Event('change'));
                })
                .on('change', (color, instance) => {
                    const selectedColor = color
                        .toHEXA()
                        .toString();

                    input.value = selectedColor;
                    input.dispatchEvent(new Event('change'));
                });
        });
    </script>
    @yield('footer')
</body>

</html>
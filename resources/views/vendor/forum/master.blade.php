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


    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios@0.24.0/dist/axios.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap (https://github.com/twbs/bootstrap) -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Feather icons (https://github.com/feathericons/feather) -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- Vue (https://github.com/vuejs/vue) -->
    @if (config('app.debug'))
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    @else
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    @endif

    <!-- Pickr (https://github.com/Simonwep/pickr) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

    <!-- Sortable (https://github.com/SortableJS/Sortable) -->
    <script src="//cdn.jsdelivr.net/npm/sortablejs@1.10.1/Sortable.min.js"></script>
    <!-- Vue.Draggable (https://github.com/SortableJS/Vue.Draggable) -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.23.2/vuedraggable.umd.min.js"></script>
    @hasSection('content')
    <style>
        #main {
            padding: unset !important;
        }
    </style>
    @endif

    <style>
        body {
            padding: 0;
            background: #f8fafc;
        }

        :root {
            scroll-behavior: auto
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


        #main {
            padding: 2em;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .list-group.threads .list-group-item {
            border-left-width: 2px;
        }

        .list-group.threads .list-group-item.locked {
            border-left-color: var(--bs-yellow);
            background: rgb(255 213 5 / 10%);
        }

        .list-group.threads .list-group-item.pinned {
            border-left-color: var(--bs-cyan);
            background: rgb(0 231 255 / 10%);
        }

        .list-group-item.deleted {
            border-left-color: var(--bs-red);
            background: rgb(217 132 132 / 10%);
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

        .list-custom:active {
            background-color: #0d6efd;
            color: white;
        }


        body {
            min-width: unset;
        }

        .modal-body {
            text-align: initial;
        }

        .no-style-button {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }
    </style>
</head>

<body @click="changeChatStyles('body')">
    <nav class="v-navbar navbar navbar-expand-md navbar-light bg-white shadow-sm" style="flex-wrap: unset;">
        @if (Auth::check())
        <button class="btn btn-primary" type="button" style="margin-left: 10px; display: flex;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg></button>
        <div class="container" style="display: flex; padding: 0; justify-content: unset; margin: 0; flex-direction: column; margin-left: auto; text-align: center">
            <div class="navbar-collapse" :class="{ show: !isCollapsed }" style="align-items: end;">
                <a href="/home">
                    <img src="/img/noodle.png" alt="Noodle Logo" style="height: 35px; width: 35px; margin-right: 3px;" />
                </a>
                @else
                <a href="/">
                    <img src="/img/noodle.png" alt="Noodle Logo" style="height: 35px; width: 35px; margin-right: 3px; margin-left: 25px" />
                </a>
                @endif
                @if (Auth::check())
                <a class="navbar-brand" href="/home">Noodle</a>
                @else
                <a class="navbar-brand" href="/">Noodle</a>
                @endif
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 collapse navbar-collapse" :class="{ show: !isCollapsed }">
                    <li class="nav-item">
                        <ul class="navbar-nav">
                            @if (Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="forumDropDownMenuLink" @click="isForumDropdownCollapsed = ! isForumDropdownCollapsed" style="color: #0d6efd;">
                                    Forum
                                </a>
                                <div class="dropdown-menu" :class="{ show: ! isForumDropdownCollapsed }" aria-labelledby="forumDropDownMenuLink">
                                    <a class="dropdown-item" href="/forum">Index</a>
                                    <a class="dropdown-item" href="{{ route('forum.recent') }}">{{ trans('forum::threads.recent') }}</a>
                                    @auth
                                    <a class="dropdown-item" href="{{ route('forum.unread') }}">{{ trans('forum::threads.unread_updated') }}</a>
                                    @endauth
                                    @can ('moveCategories')
                                    @if (Auth::user()->role_id != 3)
                                    <a class="dropdown-item" href="{{ route('forum.category.manage') }}">{{ trans('forum::general.manage') }}</a>
                                    @endif
                                    @endcan
                                </div>
                            </li>
                            @endif
                            @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color: #0d6efd;">News</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color: #0d6efd;">Faculties</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color: #0d6efd;">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/about" style="color: #0d6efd;">About</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div style="margin-left: auto">
            @if (Auth::check())
            <button type="button" class="btn btn-primary position-relative" style="    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    outline: inherit;
    display: flex;
    margin-right: 10px;
">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" @click="isUserDropdownCollapsed = ! isUserDropdownCollapsed" style="color: white">
                    {{ Auth::user()->name }}
                    <!-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    99+
    <span class="visually-hidden">unread messages</span> -->
                    </span>
                </a>

            </button>
            @endif
            <ul class="navbar-nav ">
                @if (Auth::check())

                <div class="dropdown-menu dropdown-menu-right" :class="{ show: ! isUserDropdownCollapsed }" aria-labelledby="navbarDropdownMenuLink" style='margin-top: 8px; right: 0; width: 100px; height: 100px; text-align: center; margin-right: 10px;'>
                    <a class="dropdown-item" href="{{ route('profile') }}">

                        {{ __('Profile') }}
                    </a>


                    <a class="dropdown-item" href="#">

                        {{ __('Grades') }}
                    </a>

                    <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Log out
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
        </div>
        @else
        <button type="button" class="btn btn-primary position-relative" style="    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    outline: inherit;
    margin-right: 25px;
    display: flex;
">
            <a class="nav-link" style="color: white" href="{{ url('/login') }}">Log in</a>
        </button>
        @endif
        </ul>
    </nav>
    @if (Auth::check())
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group" style="margin-bottom: 50px;">
                <a href="/home" class="list-group-item list-custom list-group-item-action {{ (request()->is('home')) ? 'active' : '' }}">Home</a>
                <a href="/forum" class="list-group-item list-custom list-group-item-action {{ (request()->is('forum', 'forum/c/*', 'forum/t/*')) ? 'active' : '' }}">Forum</a>
                <a href="/forum/recent" class="list-group-item list-custom list-group-item-action {{ (request()->is('forum/recent')) ? 'active' : '' }}"><span style="margin-left: 10px;">Recent threads</span></a>
                <a href="/forum/unread" class="list-group-item list-custom list-group-item-action {{ (request()->is('forum/unread')) ? 'active' : '' }}"><span style="margin-left: 10px;">Unread & updated threads</span></a>
                @if (Auth::user()->role_id != 3)
                <a href="/forum/manage" class="list-group-item list-custom list-group-item-action {{ (request()->is('forum/manage')) ? 'active' : '' }}"><span style="margin-left: 10px;">Manage</span></a>
                @endif
            </div>
            <div class="list-group">
                @if (count($courses) != null)
                <a href="#" style="background-color: lightslategray; color: white; font-size: 16px;" class="list-group-item disabled list-group-item-action">Available courses</a>
                @endif
                @foreach ($courses as $key=>$course)
                <a href="/course/{{ $course->id }}" class="list-group-item list-custom list-group-item-action {{ (request()->is('course/'.$course->id))  ? 'active' : '' }}" id="{{ $course->id }}"><span>{{$course->name}}</span></a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @hasSection('content')
    <div id="forum" class="container">
        <a href="https://github.com/dBaliukynas/noodle/releases/tag/v0.3.2.1" style="position: fixed !important; bottom: 0; right: 0; color: black;" target="_blank" rel="noopener noreferrer"><strong>v0.3.2.1</strong></a>
        @include('forum::partials.breadcrumbs')
        @include('forum::partials.alerts')

        @yield('content')
    </div>
    @endif
    @sectionMissing('hide_chat')

    <div class="v-chat chat" @click="changeChatStyles('chat')">
        <div style="width: 100vw; position: relative; margin-left: -50vw; left: 50%">
            <div style="position: fixed;
    bottom: 0;
    right: 0;
    margin-bottom: 3rem;
    z-index: 1000;
}" @click="changeChatStyles('chat')">

                <button v-if="!chatOpened" class="no-style-button chat-button" @click="chatOpened = !chatOpened, scrollToElement('chatContent', 'auto', 'end')">


                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="white" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: block" class="chat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="18" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#0d6efd">
                            <circle cx="12" cy="15" r="1"></circle>
                            <circle cx="19" cy="15" r="1"></circle>
                            <circle cx="5" cy="15" r="1"></circle>
                        </svg>
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>





                </button>

                <button v-else class="no-style-button chat-button" style="    margin-bottom: 10px;
    margin-right: 3px;
}" @click="chatOpened = !chatOpened">
                    <div> <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="white" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: block" class="chat-icon">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg></div>
                </button>
            </div>
        </div>
        <div v-if="chatOpened" class="card" style="    max-width: 18rem;
    position: fixed;
    bottom: 0;
    right: 0;
    margin-right: 3rem;
    margin-bottom: 6rem;
    border-color: #d4d4d5;
    z-index: 1000;">
            <div class="card-header chat" style="    background-color: #0d6efd;
    color: white; width: 252px;
    margin-left: -1px; margin-top: -1px;
}">Chat</div>
            <div class="card-body chat" id="chatBody" style="    overflow-y: auto;
    height: 20rem; padding: unset !important
}">
                <div style="    display: flex;
    flex-direction: column; padding: 1rem 1rem;
    padding-top: 1rem;
    padding-right: 1rem;
    padding-bottom: 1rem;
    padding-left: 1rem;" class="chat" id="chatContent">
                    <div style="margin-bottom: 10px; " class="chat">
                        <h5 class="card-title chat"><span class="chat">Welcome to Noodle Chat!</span></h5>
                    </div>
                    <div v-for="(chatMessage, index) in chatMessages" :key="index" id="chatSegment" style="margin-bottom: 20px; background-color: whitesmoke; border-radius: 15px; padding: 5px; width: 165px; margin-right: 10px;" class="chat">
                        <div style="margin-left: 7px; white-space: pre-wrap;" class="chat">
                            <span class="chat">@{{ chatMessages[index] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-transparent chat" style="border-color: #d4d4d5;     display: flex;
    align-items: center;
}">


                <div style="    height: 2rem;
    min-height: 2.3rem !important; max-height: 400px; height: auto; resize: none; overflow-y: auto; padding: unset; outline: unset;   width: 12rem; display: flex;justify-content: center; flex-direction: column; border: 2px solid #9d9a9a;
    border-radius: 15px;
}" name="text" class="chat-textarea-wrapper chat" id="chatTextAreaWrapper" @keydown.enter.exact.prevent="sendMessage('textarea', $event)" @keydown.enter.shift.exact>
                    <div style="  width: 10px;
  height: 100%;"></div>
                    <div @paste="convertToText($event), computeHeight()" @input="computeHeight()" id="chatTextArea" ref="chatTextArea" class="chat-text-area chat" contenteditable style="    margin-left: 0.45rem;
    outline: unset;
    width: 85%;
    line-height: initial; overflow-x: auto"></div>


                </div>



                <button class="no-style-button" title="Send" @click="sendMessage()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: block" class="chat-send-icon chat">
                        <path class="chat" d="M5 12h13M12 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <style>
        .chat-icon {
            transition: 0.1s ease-out;
        }

        .chat-icon:hover {
            stroke: #0056b3;
            transition: 0.1s ease-in;
        }

        .chat-send-icon {
            transition: 0.1s ease-out;
        }

        .chat-send-icon:hover {
            stroke: #0056b3;
            transition: 0.1s ease-in;
        }

        textarea:focus {
            outline: none;
        }
    </style>
    <script>
        new Vue({
            el: ".v-chat",
            name: "Chat",


            data: {
                chatOpened: false,
                chatMessages: [],
            },
            methods: {
                changeChatStyles(element) {
                    const chatHeader = document.querySelector('.card-header.chat');
                    const chatSendButton = document.querySelector('.chat-send-icon');
                    const chatTextArea = document.querySelector(".chat-text-area");
                    const chatTextAreaWrapper = document.querySelector(".chat-textarea-wrapper.chat");


                    if (chatHeader != null) {
                        if (element == "chat" && window.getSelection().toString() == '') {
                            chatTextArea.focus();

                        }

                        window.onmousedown = element => {
                            if (element.target.classList.contains('chat')) {

                                chatHeader.style.background = "#0d6efd";
                                chatSendButton.setAttribute('stroke', "#0d6efd");
                                chatTextAreaWrapper.style.borderColor = "#9d9a9a";

                                window.onmouseup = () => {};
                            } else {
                                window.onmouseup = element => {
                                    if (!element.target.classList.contains('chat')) {
                                        chatHeader.style.background = "rgb(53 65 82)";
                                        chatSendButton.setAttribute('stroke', "#354152");
                                        chatTextAreaWrapper.style.borderColor = "#354152";
                                    }
                                };
                            }
                        };
                    }
                },

                async sendMessage(element, event) {
                    const chatBody = document.getElementById("chatBody");
                    const chatTextArea = document.querySelector(".chat-text-area");
                    const chatSegment = document.getElementById("chatSegment");


                    if (this.$refs.chatTextArea.innerText.trim() != '') {
                        await this.chatMessages.push(this.$refs.chatTextArea.innerText);

                        chatTextArea.style.height = '19px';
                        this.$refs.chatTextArea.innerText = '';

                        this.scrollToElement('chatContent', 'auto', 'end');
                    }
                },
                scrollToElement(idName, behavior, block) {

                    this.$nextTick(() => document.getElementById(idName).scrollIntoView({
                        behavior: 'auto',
                        block: 'end',
                    }));
                },

                computeHeight() {
                    const chatTextArea = document.querySelector(".chat-text-area");
                    chatTextArea.style.height = '';
                    chatTextArea.style.height = this.scrollHeight + "px";
                },
                convertToText(event) {
                    event.preventDefault();
                    const text = event.clipboardData.getData('text/plain');
                    this.$refs.chatTextArea.innerText += text;
                },

            },
        }, )
    </script>

    @endif

    @hasSection('main')
    <div id="main" class="container">
        <notification-component></notification-component>
        @yield('main')
        @sectionMissing('hide_version')
        <a href="https://github.com/dBaliukynas/noodle/releases/tag/v0.3.2.1" style="position: fixed !important; bottom: 0; right: 0; color: black;" target="_blank" rel="noopener noreferrer"><strong>v0.3.2.1</strong></a>
        @endif
    </div>
    @endif
    <div class="mask"></div>

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
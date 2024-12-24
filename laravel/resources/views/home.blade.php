@extends('layout.homeapp')

@section('content')
    @if($errors -> any())
        <div class="mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <ul>
                <li class="text-sm rounded-lg bg-red-50" role="alert">
                    @foreach($errors->all() as $error)
                        <div class="text-sm text-white rounded-lg bg-red-50">{{ $error }}</div>
                    @endforeach
                </li>
            </ul>
        </div>
    @endif
    @if(session('message'))
        <div class="mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <div class="text-sm rounded-lg bg-red-50" role="alert">
                    <div class="text-sm text-white rounded-lg bg-red-50"> {{ session('success') }}</div>
            </div>
        </div>
    @endif
    <form action="{{ route('login_guest', request()->query()) }}" method="POST">
        @csrf

        <div class="flex flex-col mb-6">
            <label class="block text-xl font-semibold text-gray-900 dark:text-white mb-4">Имя пользователя</label>
            <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow dark:text-gray-400" type="text" name="login" placeholder="Имя пользователя" />
        </div>
        <div class="flex flex-col">
            <label class="block text-xl font-semibold text-gray-900 dark:text-white mb-4">Пароль</label>
            <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow dark:text-gray-400" type="password" name="password" placeholder="Имя пользователя" />
        </div>

        @foreach($queryParams as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <div class="flex flex-col mt-6 items-center">
            <button class="rounded-md border border-slate-300 py-2 px-4 text-center text-sm transition-all text-white shadow-sm hover:shadow-lg hover:text-white hover:bg-slate-800 hover:border-gray-300 focus:text-slate-800 focus:bg-gray-600 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none w-3/5" type="submit">
                Войти
            </button>
        </div>
    </form>
@endsection

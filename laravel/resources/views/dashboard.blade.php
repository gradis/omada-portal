@extends('layout.app')

@section('title-block')
    Admin
@endsection

@section('content')
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Пользователи</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <form action="{{ route ('user.search') }}" method="GET" class="w-full max-w min-w-[200px] flex flex-row gap-2">
                    @if(@empty($query))
                        <input id="query" name="query" class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Введите данные для поиска" value="">
                    @else
                        <input id="query" name="query" class="w-full bg-white placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Введите данные для поиска" value="{{$query}}">
                    @endif
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Найти</button>
                </form>
            </div>
            <div class="mt-8 mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
{{--                <form>--}}
                    <table class="border-collapse table-fixed w-full text-sm border-spacing-2 bg-slate-300 rounded-lg">
                        <thead>
                        <tr>
                            <th class="border-b font-medium p-4 pl-8 pb-3 text-slate-900 text-left">ФИО</th>
                            <th class="border-b font-medium p-4 pl-8 pb-3 text-slate-900 text-left">Номер пропуска</th>
                            <th class="border-b font-medium p-4 pl-8 pb-3 text-slate-900 text-left">Последий MAC</th>
                            <th class="border-b font-medium p-4 pl-8 pb-3 text-slate-900 text-left">Класс</th>
                            <th class="border-b font-medium p-4 pl-8 pb-3 text-slate-900 text-left">Группа</th>
                            <th class="border-b font-medium p-4 pl-8 pb -3 text-slate-900 text-left max-w-min"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(@empty($data))
                                <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        Ничего не найдено!
                                    </div>
                                </div>
                            @else
                                @foreach($data as $el)
                                    <tr class="py-4 bg-white">
                                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-700 font-medium">{{ $el->secondName }} {{$el->firstName}} {{$el->middleName}}</td>
                                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">{{ $el->number }}</td>
                                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">{{ $el->mac_adress }}</td>
                                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">{{ $el->grade }}</td>
                                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">
                                            @if($el->group == 0)
                                                <div class="bg-blue-300 rounded-full text-center py-1 px-3 text-slate-500 max-w-min">Пользователь</div>
                                            @else
                                                <div class="bg-green-300 rounded-full text-center py-1 px-3 text-slate-500 max-w-min">Администратор</div>
                                            @endif
                                            </td>
                                        <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">
                                            <a href="{{ route('user.edit', $el->id) }}" class="text-purple-600">Редактировать</a></td>
                                    </tr>
                                @endforeach
                           @endif
                        </tbody>
                    </table>
{{--                </form>--}}
            </div>
        </main>
@endsection

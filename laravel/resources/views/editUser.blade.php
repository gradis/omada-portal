@extends('layout.app')

@section('title-block')
    Profile Edit
@endsection

@section('content')
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $user->secondName }} {{$user->firstName}} {{$user->middleName}}</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <form action="{{ route('user.delete', $user->id) }}" method="POST" class="w-full flex flex-row justify-end">
                @csrf
                @method('DELETE')

                <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Удалить пользователя</button>
            </form>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-12">
                    <div class="pb-12">
                        <div class="mt-10 flex flex-col">
                            <div class="sm:col-span-3">
                                <label for="secondName" class="block text-sm font-medium leading-6 text-gray-900">Фамилия</label>
                                <div class="mt-2">
                                    <input type="text" name="secondName" id="secondName" value="{{ $user->secondName }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <label for="firstName" class="block text-sm font-medium leading-6 text-gray-900">Имя</label>
                                <div class="mt-2">
                                    <input type="text" name="firstName" id="firstName" value="{{ $user->firstName }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <label for="middleName" class="block text-sm font-medium leading-6 text-gray-900">Отчество</label>
                                <div class="mt-2">
                                    <input type="text" name="middleName" id="middleName" value="{{ $user->middleName }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3 mt-5">
                                <label for="number" class="block text-sm font-medium leading-6 text-gray-900">Номер</label>
                                <div class="mt-2">
                                    <input type="text" name="number" id="number" value="{{ $user->number }}" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3 mt-5">
                                <label for="grade" class="block text-sm font-medium leading-6 text-gray-900">Класс</label>
                                <div class="mt-2">
                                    <input type="text" name="grade" id="grade" value="{{ $user->grade }}" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3 mt-5">
                                <label for="login" class="block text-sm font-medium leading-6 text-gray-900">Имя пользователя</label>
                                <div class="mt-2">
                                    <input type="text" name="username" id="username" value="{{ $user->username }}" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:row-span-0 sm:col-span-3 mt-5">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Пароль</label>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" placeholder="Вводить только для изменения" value="{{ old('password') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3 mt-5">
                                <label for="user_group" class="block text-sm font-medium leading-6 text-gray-900">Группа пользователя</label>
                                <div class="mt-2">
                                    <select id="user_group" name="user_group" autocomplete="user_group" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        @if($user->group == 0)
                                            <option value="0" selected="selected">Пользователь</option>
                                            <option value="1">Администратор</option>
                                        @else
                                            <option value="0">Пользователь</option>
                                            <option value="1" selected="selected">Администратор</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <a href="{{ route('dashboard') }}" class="text-sm font-semibold leading-6 text-gray-900">Отменить</a>
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

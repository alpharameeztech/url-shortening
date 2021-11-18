<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            URL Shortening
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="w-full">
                        <form method="post" action="{{route('url.store')}}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="https:example.com">
                                    Enter the URL you want to shorten
                                </label>
                                <input name="destination" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="destination" type="text" placeholder="https://example.com">
                            </div>
                            <div class="flex items-center justify-between">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                    Shorten URL
                                </button>
                            </div>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                        </form>

                    </div>

                </div>

                <div class="bg-white rounded-lg shadow-lg py-6">
                    <div class="block overflow-x-auto mx-6">
                        <table class="w-full text-left rounded-lg">
                            <thead>
                                <tr class="text-gray-800 border border-b-0">
                                    <th class="px-4 py-3">Slug</th>

                                    <th class="px-4 py-3">Url</th>
                                    <th class="px-4 py-3">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $urls as $url )

                                <tr class="w-full font-light text-gray-700 bg-gray-100 whitespace-no-wrap border border-b-0">
                                    
                                    <td class="px-4 py-4"><a class="underline" href="/{{ $url->slug }}">{{ $url->ShortenedUrl }}</a></td>
                                    <td class="px-4 py-4"><a class="underline" href="{{$url->destination}}">{{ $url->destination }}</a></td>
                                    <td class="px-4 py-4">
                                        <span class="text-sm bg-green-500 text-white rounded-full px-2 py-1"> {{ \Carbon\Carbon::parse($url->created_at )->diffForHumans() }}</span>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ route('message.store')}}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-jet-label>Asunto</x-jet-label>
                        <x-jet-input type="text" class="w-full" placeholder="Ingrese asunto" name="subject"/>
                        <x-jet-input-error for="subject" />
                    </div>

                    <div class="mb-4">
                        <x-jet-label>Mensaje</x-jet-label>
                        <textarea class="w-full rounded" placeholder="Ingrese descripcion" name="body"></textarea>
                        <x-jet-input-error for="body" />
                    </div>

                    <div class="mb-4">
                        <x-jet-label>Destino</x-jet-label>
                        <select name="to_user_id" class="w-full rounded">
                            <option value=""selected disabled>Seleccione un usuario</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="to_user_id" />
                    </div>

                    <div class="mb-4">
                        <x-jet-button>Enviar</x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

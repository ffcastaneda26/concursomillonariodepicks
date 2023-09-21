@if ($errors->any())
    <div class="text-red-600 bg-white text-lg">
        <div {{ $attributes }}>
            <ul class="mt-3 mb-2 list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

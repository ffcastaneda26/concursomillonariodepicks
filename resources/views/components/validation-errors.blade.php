@if ($errors->any())
    <div class="text-danger">
        <div {{ $attributes }}>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600 text-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

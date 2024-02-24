<div class="border-bottom pb-3 mb-4">
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="h2">
                {{ $slot }}
            </h1>
        </div>

        <div>
        @isset($right)
            <div class="mb-2">
                {{ $right }}
            </div>
        @endisset
        </div>
    </div>

</div>


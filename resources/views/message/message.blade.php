@if(session('success'))
    <x-container>
        <x-errorsAndMessage.success-user class="alert alert-success">
            {{ session('success') }}
        </x-errorsAndMessage.success-user>
    </x-container>
@elseif(session('error'))
    <x-container>
        <x-errorsAndMessage.errors-user class="alert alert-danger">
            {{ session('error') }}
        </x-errorsAndMessage.errors-user>
    </x-container>
@endif

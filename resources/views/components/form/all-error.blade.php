@foreach ($errors->all() as $error)
    <div class="form-status form-status--error">
        {{ $error }}
    </div>
@endforeach

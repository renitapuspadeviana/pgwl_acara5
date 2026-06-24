{{-- SUCCESS --}}
@if(session('success'))
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div class="toast show text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}
            </div>

            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"
                    aria-label="Close"></button>
        </div>
    </div>
</div>
@endif

{{-- ERROR --}}
@if(session('error'))
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div class="toast show text-white bg-danger border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa-solid fa-circle-xmark me-2"></i>
                {{ session('error') }}
            </div>

            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"
                    aria-label="Close"></button>
        </div>
    </div>
</div>
@endif

{{-- WARNING --}}
@if(session('warning'))
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div class="toast show text-dark bg-warning border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                {{ session('warning') }}
            </div>

            <button type="button"
                    class="btn-close me-2 m-auto"
                    data-bs-dismiss="toast"
                    aria-label="Close"></button>
        </div>
    </div>
</div>
@endif

{{-- VALIDATION ERROR --}}
@if($errors->any())
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div class="toast show text-white bg-danger border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa-solid fa-circle-xmark me-2"></i>

                @foreach($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>

            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"
                    aria-label="Close"></button>
        </div>
    </div>
</div>
@endif

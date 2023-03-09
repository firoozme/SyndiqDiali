<div class="flash-message position-fixed fixed-bottom fixed-left  p-3" style="right:auto">
    @if (session()->has('success'))
        <p class="alert alert-success"><span onclick="$('.alert').fadeOut()" class="cursor:pointer mr-3">X</span> {{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger"><span onclick="$('.alert').fadeOut()" class="cursor:pointer mr-3">X</span> {{ session('error') }}</p>
    @endif 
</div>
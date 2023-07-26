@if(session('success'))
<div id="success-message" class="alert alert-success">
    {{ session('success') }}
</div>
@elseif(session('error'))
<div id="success-message" class="alert alert-danger">
    {{ session('error') }}
</div>
@elseif(session('warning'))
<div id="success-message" class="alert alert-warning">
    {{ session('warning') }}
</div>
@elseif(session('info'))
<div id="success-message" class="alert alert-info">
    {{ session('info') }}
</div>
@endif
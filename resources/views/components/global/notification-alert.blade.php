<style>
    .member-badge{
    color: green;
    font-weight: bold;
    background: #ffffff;
    padding: 2px 20px 0px;
    font-size: 12px;
    border-radius: 6px;
    line-height: 15px;
    display: inline-block;
    margin-bottom: 10px;
    }
</style>
<div class="col-lg-12 w-100">

    <div class="alert alert-{{ $type ?? 'info' }} " role="alert">
        @if ($member)
            <span class="member-badge">{{ $member }}</span>
        @endif
        <h4 class="alert-heading">{{ $heading }}</h4>
        <p class="mb-0">{{ $content }}</p>
    </div>
</div>

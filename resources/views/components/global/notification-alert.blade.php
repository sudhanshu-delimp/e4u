<div class="col-lg-12 w-100">

    <div class="alert alert-{{ $type ?? 'info' }} " role="alert">
        @if ($member)
            <span class="member-badge">{{ $member }}</span>
        @endif
        <h4 class="alert-heading">{{ $heading }}</h4>
        <p class="mb-0">{{ $content }}</p>
    </div>
</div>

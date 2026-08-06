{{-- resources/views/components/common/modal.blade.php --}}

@props([
    'id',
    'title' => '',
    'subtitle' => '',
    'icon' => null,
    'size' => '',
    'closeButton' => true,
])

<div
    class="modal fade common-modal"
    id="{{ $id }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="{{ $id }}Label"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-dialog-centered common-modal-dialog {{ $size }}"
        role="document"
    >
        <div class="modal-content common-modal-content">

            {{-- Header --}}
            <div class="modal-header common-modal-header">

                <div class="common-modal-title-wrap">

                    @if($icon)
                        <div class="common-modal-icon">
                            {!! $icon !!}
                        </div>
                    @endif

                    <div>
                        @if($title)
                            <h5
                                class="common-modal-title"
                                id="{{ $id }}Label"
                            >
                                {{ $title }}
                            </h5>
                        @endif

                        @if($subtitle)
                            <p class="common-modal-subtitle">
                                {{ $subtitle }}
                            </p>
                        @endif
                    </div>

                </div>

                @if($closeButton)
                    <button
                        type="button"
                        class="common-modal-close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <svg
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M19 5L4.99998 19M5.00001 5L19 19"
                                stroke="#ff3c5f"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>
                @endif

            </div>


            {{-- Body --}}
            <div class="modal-body common-modal-body">

                {{ $slot }}

            </div>


            {{-- Footer --}}
            @isset($footer)

                <div class="modal-footer common-modal-footer">

                    {{ $footer }}

                </div>

            @endisset

        </div>
    </div>
</div>
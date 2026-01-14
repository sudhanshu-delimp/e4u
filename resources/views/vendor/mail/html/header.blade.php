<tr>
<td class="">
    <table class="header" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="" align="center">
                <a href="{{ $url }}" style="display: inline-block;" class="header_logo">
                    @if (trim($slot) === 'E4U')
                        <img src="{{ asset('assets/app/img/logo.png') }}" class="logo" alt="E4U Logo">
                    @else
                        {{ $slot }}
                    @endif
                </a>
            </td>
        </tr>
    </table>
</td>
</tr>

@php
    $refresh = $refresh ?? true;
@endphp
<div class="timer_section">
    <p>Server time: <span class="serverTime">{{getAustraliaTime(now(), 'h:i:s A')}}</span></p>
    @if($refresh)<p>Refresh time:<span class="refreshSeconds">0</span></p>@endif
    <p>Up time: <span class="uptimeClass">{{getAppUptime()}}</span></p>
</div>
@prepend('script')
<script>
    console.log('child');
    let countdown = 15;
        setInterval(() => {
            countdown--;
            $(".refreshSeconds").text(' ' + countdown);

            if (countdown <= 0) {
                let australiaTime = new Date().toLocaleString("en-AU", {
                    timeZone: `{{config('common.local_timezone')}}`,
                    hour: "numeric",
                    minute: "2-digit",
                    second: "2-digit",
                    hour12: true
                }).toUpperCase();
                $(".serverTime").text(australiaTime);
                $(".uptimeClass").html(`{{getAppUptime()}}`);
                countdown = 15;
            }

        }, 1000);
</script>
@endprepend
    @foreach ($datas['earnings'] as $data)
        <tr>
            <td class="text-left">{{ $data['member_id'] }} </td>
            <td class="text-left">{{ $data['advertiser_name'] }}</td>
            <td class="text-center">{{ $data['joined_date'] }}</td>
            <td class="text-right">$ {{ $data['platinum_spend'] }}</td>
            <td class="text-right">$ {{ $data['gold_spend'] }}</td>
            <td class="text-right">$ {{ $data['silver_spend'] }}</td>
            <td class="text-right">$ {{ $data['pinup_spend'] }}</td>
            <td> </td>
            <td class="text-right">$ {{ $data['total_spend'] }}</td>
            <td class="text-right">$ {{ $data['fees'] }}</td>
            <td class="text-center">
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink" style="">
                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"
                            data-toggle="modal" data-target="#commission-report" {{-- data-target="#message-report" --}}>
                            <i class="fa fa-eye"></i> View Advertiser Report
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"
                            data-toggle="modal" data-target="#">
                            <i class="fa fa-print"></i> Print Advertiser Report
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
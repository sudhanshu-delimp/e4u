<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery PDF | {{$member_id}}</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">

    <!-- Main Container -->
    <div style="width: 1000px; margin: 0 auto; padding: 20px;" class="content_body">

        <!-- Print Button -->
        

        <!-- Hide button during print -->
        <style>
            .content_body{
                 background-color:#ffffff; box-shadow:0px 3px 4px #eeeded
            }
            @media print {
                #printBtn {
                    display: none;
                }
                .content_body{
                    box-shadow: none;
                }
            }
        </style>

        <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <td colspan="5" style="text-align: end">                        
                        <div id="printBtn">
                            <button onclick="window.print()" 
                                    style="padding: 10px 25px; font-size: 14px; cursor: pointer; background-color:#0c223d;color:#fff; border-radius:5px; font-size:16px; border:none;" id="printGalleryBtn" >
                                Print
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <h1>Verification Image - {{$member_id}}</h1>
                    </td>
                    <td colspan="1" style="text-align: end">
                        @switch((int)$status)
                            @case(0)
                                <p style="margin: 0px;color: orange;font-weight: 600;font-size: 24px;line-height:.9;">Pending <br> <span style="color:#000000;font-size: 14px;">(Uploaded Date: {{showDateWithFormat($media_verification->updated_at)}})</span></p> 
                            @break
                            @case(1)
                                <p style="margin: 0px;color: rgb(54 153 5);font-weight: 600; font-size: 24px;line-height:.9;">Approved <br><span style="color:#000000;font-size: 14px;">(Approved By: {{$reviewed_by}})</span> <br> <span style="color:#000000;font-size: 14px;">(Approved Date: {{showDateWithFormat($media_verification->updated_at)}})</span> </p>
                            @break
                            @case(2)
                                <p style="margin: 0px;color: #ff3c5f;font-weight: 600; font-size: 24px;line-height:.9;">Rejected
                                <br> <span style="color:#000000;font-size: 14px;">(Rejected By: {{$reviewed_by}})</span><br><span style="color:#000000;font-size: 14px;">(Rejected Date: {{showDateWithFormat($media_verification->updated_at)}})</span></p>
                            @break
                        @endswitch
                    </td>
                </tr>
            </thead>
            <tbody>
                   <!-- Gallery Images -->
            @if($mediaImages)
                <tr>
                    <td colspan="3" style="vertical-align:baseline;">
                        <div><h2 style="margin-top: 0px;font-size: 18px;">Gallery Images</h2></div>
                        <div id="galleryImages">
                            @foreach($mediaImages as $gallery)
                                {!! $gallery !!}
                            @endforeach
                        </div>
                    </td>
                    <td colspan="2" style="vertical-align:baseline;">
                        <div><h2 style="margin-top: 0px;font-size: 18px;"> Verification Image </h2></div>
                        <div>
                            <img src="{{$media_verification_image ? $media_verification_image : ''}}" alt="Verification Image" style="width:340px; height:265px;object-fit: contain; background:#eee; border: 1px solid #ccc; padding:10px;">
                        </div>
                    </td>
                </tr>    
              @endif
            
            @if($bannerImage)
                <!-- Banner Images -->
                <tr>
                    <td colspan="5">
                        <div><h2 style="margin-top: 0px;font-size: 18px;">Banner Images</h2></div>
                        <div id="bannerImages">     
                            
                                @foreach($bannerImage as $banner_image)
                                    {!! $banner_image !!}
                                @endforeach
                        </div>
                    </td>
                </tr>
            @endif
            @if($pinupImage )
                <!-- Pinup Images -->
                <!-- <tr> -->
                @if($user_type == '3')
                    <tr>
                        <td colspan="5">
                            <div><h2 style="margin-top: 0px;font-size: 18px;">Pin Up Images</h2></div>
                            <div id="pinupImages">
                                @foreach($pinupImage as $pinup_image)
                                    {!! $pinup_image !!}
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endif
            @endif
            </tbody>

        </table>

    </div>

    
</body>
</html>
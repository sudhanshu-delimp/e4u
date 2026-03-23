<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery PDF</title>
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
                    <td colspan="4">
                        <h1>Verification Image - E40112</h1>
                    </td>
                    <td colspan="1" style="text-align: end">
                        <div id="printBtn">
                            <button onclick="window.print()" 
                                    style="padding: 10px 25px; font-size: 14px; cursor: pointer; background-color:#0c223d;color:#fff; border-radius:5px; font-size:16px; border:none;" id="printGalleryBtn" >
                                Print
                            </button>
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <!-- Gallery Images -->
            <tr>
                <td colspan="5">
                    <div><h2 style="margin-top: 0px;font-size: 18px;">Gallery Images</h2></div>
                    <div id="galleryImages">
                        @if($mediaImages)
                            @foreach($mediaImages as $gallery)
                                {!! $gallery !!}
                            @endforeach
                        @endif
                    </div>
                </td>
            </tr>

            <!-- Banner Images -->
            <tr>
                <td colspan="5">
                    <div><h2 style="margin-top: 0px;font-size: 18px;">Banner Images</h2></div>
                    <div id="bannerImages">     
                        @if($mediaImages)
                            @foreach($bannerImage as $banner_image)
                                {!! $banner_image !!}
                            @endforeach
                        @endif
                    </div>
                </td>
            </tr>
           

            <!-- Pinup Images -->
            <tr>
            <tr>
                <td colspan="5">
                    <div><h2 style="margin-top: 0px;font-size: 18px;">Pinup Images</h2></div>
                    <div id="pinupImages">
                        @if($mediaImages)
                            @foreach($pinupImage as $pinup_image)
                                {!! $pinup_image !!}
                            @endforeach
                        @endif
                    </div>
                </td>
            </tr>
            </tbody>

        </table>

    </div>

    
</body>
</html>
@extends('layouts.center')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
      <div class="col-lg-12">
         <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
               <h1 class="h1">Our Spend</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="back-to-dashboard">
               <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                  <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
               </a>
            </div>
         </div>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
              <h3 class="NotesHeader"><b>Notes:</b></h3>
               <ol>
                    <li>This page is a summary of all the Fees you have spent on the Services.</li>
                    <li>To assist you in keeping an idea of your spend with E4U, we have provided information on
                        your spend with E4U for the same time last year.</li>
                </ol>
            </div>
         </div>
      </div>
   </div>

    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="common-grid">                
                <div class="common-card">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="24px" height="24px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#000000" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ff3c5f" d="M298.9 24.31c-14.9.3-25.6 3.2-32.7 8.4l-97.3 52.1-54.1 73.59c-11.4 17.6-3.3 51.6 32.3 29.8l39-51.4c49.5-42.69 150.5-23.1 102.6 62.6-23.5 49.6-12.5 73.8 17.8 84l13.8-46.4c23.9-53.8 68.5-63.5 66.7-106.9l107.2 7.7-1-112.09-194.3-1.4zM244.8 127.7c-17.4-.3-34.5 6.9-46.9 17.3l-39.1 51.4c10.7 8.5 21.5 3.9 32.2-6.4 12.6 6.4 22.4-3.5 30.4-23.3 3.3-13.5 8.2-23 23.4-39zm-79.6 96c-.4 0-.9 0-1.3.1-3.3.7-7.2 4.2-9.8 12.2-2.7 8-3.3 19.4-.9 31.6 2.4 12.1 7.4 22.4 13 28.8 5.4 6.3 10.4 8.1 13.7 7.4 3.4-.6 7.2-4.2 9.8-12.1 2.7-8 3.4-19.5 1-31.6-2.5-12.2-7.5-22.5-13-28.8-4.8-5.6-9.2-7.6-12.5-7.6zm82.6 106.8c-7.9.1-17.8 2.6-27.5 7.3-11.1 5.5-19.8 13.1-24.5 20.1-4.7 6.9-5.1 12.1-3.6 15.2 1.5 3 5.9 5.9 14.3 6.3 8.4.5 19.7-1.8 30.8-7.3 11.1-5.5 19.8-13 24.5-20 4.7-6.9 5.1-12.2 3.6-15.2-1.5-3.1-5.9-5.9-14.3-6.3-1.1-.1-2.1-.1-3.3-.1zm-97.6 95.6c-4.7.1-9 .8-12.8 1.9-8.5 2.5-13.4 7-15 12.3-1.7 5.4 0 11.8 5.7 18.7 5.8 6.8 15.5 13.3 27.5 16.9 11.9 3.6 23.5 3.5 32.1.9 8.6-2.5 13.5-7 15.1-12.3 1.6-5.4 0-11.8-5.8-18.7-5.7-6.8-15.4-13.3-27.4-16.9-6.8-2-13.4-2.9-19.4-2.8z"></path></g></svg>
                        </div>
                        <div class="card-heading">
                            <h2>Advertising</h2>
                        </div>
                    </div>
                    <hr class="custom-hr">
                    <div class="common-stars">
                        <div class="stats-detail">
                            <div class="stats-label">Week to Date
                            </div>
                            <div class="stats-value">$ {{$data['advertiseServices']['week_to_date']}}</div>

                        </div>
                        <div class="stats-detail">
                            <div class="stats-label">Same period last year
                            </div>
                            <div class="stats-value">$ {{$data['advertiseServices']['same_week_period_last_year']}}</div>

                        </div>
                        <hr class="custom-hr">
                        <div class="stats-detail">
                            <div class="stats-label">Month to Date

                            </div>
                            <div class="stats-value">$ {{$data['advertiseServices']['month_to_date']}}</div>

                        </div>
                        <div class="stats-detail">
                            <div class="stats-label">Same period last year
                            </div>
                            <div class="stats-value">$ {{$data['advertiseServices']['same_month_period_last_year']}}</div>

                        </div>
                        <hr class="custom-hr">
                        <div class="stats-detail">
                            <div class="stats-label">Year to date</div>
                            <div class="stats-value">$ {{$data['advertiseServices']['year_to_date']}}</div>

                        </div>
                        <div class="stats-detail">
                            <div class="stats-label">Same period last year
                            </div>
                            <div class="stats-value">$ {{$data['advertiseServices']['same_year_period_last_year']}}</div>

                        </div>
                    </div>
                    
                </div>
                <div class="common-card">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="24px" height="24px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#000000" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ff3c5f" d="M298.9 24.31c-14.9.3-25.6 3.2-32.7 8.4l-97.3 52.1-54.1 73.59c-11.4 17.6-3.3 51.6 32.3 29.8l39-51.4c49.5-42.69 150.5-23.1 102.6 62.6-23.5 49.6-12.5 73.8 17.8 84l13.8-46.4c23.9-53.8 68.5-63.5 66.7-106.9l107.2 7.7-1-112.09-194.3-1.4zM244.8 127.7c-17.4-.3-34.5 6.9-46.9 17.3l-39.1 51.4c10.7 8.5 21.5 3.9 32.2-6.4 12.6 6.4 22.4-3.5 30.4-23.3 3.3-13.5 8.2-23 23.4-39zm-79.6 96c-.4 0-.9 0-1.3.1-3.3.7-7.2 4.2-9.8 12.2-2.7 8-3.3 19.4-.9 31.6 2.4 12.1 7.4 22.4 13 28.8 5.4 6.3 10.4 8.1 13.7 7.4 3.4-.6 7.2-4.2 9.8-12.1 2.7-8 3.4-19.5 1-31.6-2.5-12.2-7.5-22.5-13-28.8-4.8-5.6-9.2-7.6-12.5-7.6zm82.6 106.8c-7.9.1-17.8 2.6-27.5 7.3-11.1 5.5-19.8 13.1-24.5 20.1-4.7 6.9-5.1 12.1-3.6 15.2 1.5 3 5.9 5.9 14.3 6.3 8.4.5 19.7-1.8 30.8-7.3 11.1-5.5 19.8-13 24.5-20 4.7-6.9 5.1-12.2 3.6-15.2-1.5-3.1-5.9-5.9-14.3-6.3-1.1-.1-2.1-.1-3.3-.1zm-97.6 95.6c-4.7.1-9 .8-12.8 1.9-8.5 2.5-13.4 7-15 12.3-1.7 5.4 0 11.8 5.7 18.7 5.8 6.8 15.5 13.3 27.5 16.9 11.9 3.6 23.5 3.5 32.1.9 8.6-2.5 13.5-7 15.1-12.3 1.6-5.4 0-11.8-5.8-18.7-5.7-6.8-15.4-13.3-27.4-16.9-6.8-2-13.4-2.9-19.4-2.8z"></path></g></svg>
                        </div>
                        <div class="card-heading">
                            <h2>Other Services</h2>
                        </div>
                    </div>
                    <hr class="custom-hr">
                    <div class="common-stars">
                        <div class="stats-detail disabled-link">
                            <div class="stats-label">Email account
                            </div>
                            <div class="stats-value">$ ${{$data['otherServices']['email_account']}}</div>
                        </div>
                        <div class="stats-detail disabled-link">
                            <div class="stats-label">Mobile SIM
                            </div>
                            <div class="stats-value">$ {{$data['otherServices']['mobile_sim']}}</div>
                        </div>
                        <div class="stats-detail">
                            <div class="stats-label">Product
                            </div>
                            <div class="stats-value">$ {{$data['otherServices']['product']}}</div>
                        </div>
                        <div class="stats-detail disabled-link">
                            <div class="stats-label">Support (E4U)
                            </div>
                            <div class="stats-value">$ {{$data['otherServices']['support']}}</div>
                        </div>
                    </div>
                    <div class="card-note">
                        <div class="stats-detail">
                                <div class="stats-label">Year to date total
                                </div>
                                <div class="stats-value"><span>$</span> {{$data['otherServices']['year_to_date_total']}} </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end row --}}

</div>
@endsection
@section('script')
@endsection

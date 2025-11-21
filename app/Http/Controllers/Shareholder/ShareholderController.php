<?php

namespace App\Http\Controllers\Shareholder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShareholderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shareholder.dashboard.index');
    }
    // my account
    public function editMyaccount(){
        return view('shareholder.dashboard.my-account.edit-my-account');
    }
    public function changePassword(){
        return view('shareholder.dashboard.my-account.change-password');
    }
    public function uploadAvatar(){
        return view('shareholder.dashboard.my-account.upload-my-avatar');
    }
    public function notifications(){
        return view('shareholder.dashboard.my-account.notifications');
    }

    // Blackbox Tech Pty Ltd

     public function annualReport(){
        return view('shareholder.dashboard.blackbox-tech.annual-report');
    }
     public function directors(){
        return view('shareholder.dashboard.blackbox-tech.directors');
    }
     public function portfolio(){
        return view('shareholder.dashboard.blackbox-tech.portfolio');
    }
     public function contactUs(){
        return view('shareholder.dashboard.blackbox-tech.contact-us');
    }
    // newsletter
     
     public function newsletter(){
        return view('shareholder.dashboard.communications.newsletter');
    }
     public function shareholderNotices(){
        return view('shareholder.dashboard.communications.shareholder-notices');
    }


    
    // newsletter
     
     public function registrations(){
        return view('shareholder.dashboard.e4u-information.registrations');
    }
     public function revenue(){
        return view('shareholder.dashboard.e4u-information.revenue');
    }


    // newsletter
     
     public function escortListing(){
        return view('shareholder.dashboard.global-monitoring.escort-listings');
    }
     public function massageListing(){
        return view('shareholder.dashboard.global-monitoring.massage-centre-listings');
    }
     public function pinUplisting(){
        return view('shareholder.dashboard.global-monitoring.pin-up-listing');
    }

    // Shareholder Documents

    
     public function annualProfitloss(){
        return view('shareholder.dashboard.shareholder-documents.annual-profit-and-loss');
    }
     public function balanceSheet(){
        return view('shareholder.dashboard.shareholder-documents.balance-sheet');
    }
     public function constitution(){
        return view('shareholder.dashboard.shareholder-documents.constitution');
    }
     public function shareholderMinutes(){
        return view('shareholder.dashboard.shareholder-documents.shareholder-minutes');
    }
     public function shareholderUpdates(){
        return view('shareholder.dashboard.shareholder-documents.shareholder-updates');
    }


    // Share Register
        
     public function overview(){
        return view('shareholder.dashboard.share-register.overview');
    }   
     public function shareholders(){
        return view('shareholder.dashboard.share-register.shareholders');
    }   
     public function shareValue(){
        return view('shareholder.dashboard.share-register.share-value');
    }


    
    // support

     public function escortStatistics(){
        return view('shareholder.dashboard.statistics.escort-statistics');
    }
     public function massageStatistics(){
        return view('shareholder.dashboard.statistics.massage-centre-statistics');
    }


    // Subsidiaries

     public function overviewPortfolio(){
        return view('shareholder.dashboard.subsidiaries.overview-and-portfolio');
    }
     public function subAnnualProfitloss(){
        return view('shareholder.dashboard.subsidiaries.annual-profit-and-loss');
    }
     public function subBalancesheet(){
        return view('shareholder.dashboard.subsidiaries.balance-sheet');
    }

    
    // support

     public function submit(){
        return view('shareholder.dashboard.support-tickets.submit');
    }
     public function viewReply(){
        return view('shareholder.dashboard.support-tickets.view-and-reply');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

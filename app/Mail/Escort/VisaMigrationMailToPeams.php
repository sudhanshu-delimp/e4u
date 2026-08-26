<?php

namespace App\Mail\Escort;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaMigrationMailToPeams extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
  protected array $data;

  public function __construct(array $data)
  {
    $this->data = $data;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject("Visa Migration Request – Member ID: {$this->data['member_id']}")->view('emails.escort.visa_migration_request_peams')
      ->with(['data' => $this->data]); // <-- Pass to view
  }
}

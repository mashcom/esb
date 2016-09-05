<?php namespace App\Listeners;

use App\Events\UserAuthenticated;
use \Carbon\Carbon;
use App\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendSubmissionNotification {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}
	public static function convertDatetime($str) {
			list($date, $time) = explode(' ', $str);
			list($year, $month, $day) = explode('-', $date);
			list($hour, $minute, $second) = explode(':', $time);
			$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
			return $timestamp;
	}

	public static function makeAgo($timestamp) {
			return Carbon::createFromTimestampUTC($timestamp)->diffInDays();
	}

	public function sendNotification($to,$message){
		$notification = new Notification();
		$notification->user_id = $to;
		$notification->sender_id = 0;
		$notification->subject = "Automated System Notification";
		$notification->message = $message;
		$notification->category= "sent";
		$notification->save();
	}
	/**
	 * Handle the event.
	 *
	 * @param  UserAuthenticated  $event
	 * @return void
	 */
	public function handle(UserAuthenticated $event)
	{
		$user = $event->getUser();
		$last_submission = $user->last_submission;

		if($user->is_admin==1){
			return;
		}
		if($last_submission==NULL){
			return $this->sendNotification($user->id,"We are still waiting for your submission, nothing has been submitted by you!!");
		}

		$last_timestamp = static::convertDatetime($last_submission);
		if(static::makeAgo($last_timestamp)>7){
			return $this->sendNotification($user->id,"Its been 7 days without any submissions from you, please send the submission as soon as possible");
		}
	}

}

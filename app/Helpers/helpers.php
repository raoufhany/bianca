<?php

//use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

function convert($string)
{
    $arabic = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩',','];
    $num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'];
    $englishNumbersOnly = str_replace($arabic, $num, $string);

    return $englishNumbersOnly;
}

function checkAttribute($attributes, $attrId, $type)
{
	foreach ($attributes as $attribute) {
		if($type == 'edit'){
			if($attribute->attribute_id == $attrId){
				return 'checked';
			}
		} else {
			if($attribute->id == $attrId){
				return 'checked';
			}
		}
	}
}

function checkPermission($page)
{
	$user = auth()->guard('admin')->user();
	if($user->type == '2') {
		if($user->adminPermission->permission->$page == 0) {
			return abort(403);
		}
	}
}

function checkGate($gate)
{
	$user = auth()->guard('admin')->user();
	if($user->type == '2') {
		if($user->adminPermission->$gate == 0) {
			return abort(403);
		}
	}
}

function checkPermit($page)
{
	$user = auth()->guard('admin')->user();
	if($user->type == '2') {
		$condition = Auth::guard('admin')->user()->adminPermission->permission->$page == 0 ? false : true;
	} else {
		$condition = true;
	}

	return $condition;
}

function setMenu($path)
{
	return request()->is('admin/' . $path . '*') ? 'sidebar-group-active open' :  '';
}

function setShown($path)
{
	return request()->is('admin/' . $path . '*') ? 'is-shown' :  '';
}

function setActive($path)
{
	return request()->is('admin/' . $path) ? 'active' :  '';
}

function setActiveParameter($path)
{
	return request()->fullUrl() == $path ? 'active' :  '';
}

function sendNotification($message_ar ,$message_en,$receivers,$receiver_type,$sender_type,$url=null)
{
	// $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
	$SERVER_API_KEY = 'AAAAKJJLZZI:APA91bFhPlyWiVWUyzGiJHb3tqCQcDp8NV1RNPm3EL9cPbfVKr9Fg_Zt6MkRl_i2kBrcoUWMgehCTDCk5VUn3iRimoazl_pX7YpJvr5vVnKifQTEmwZiw0nl8YkyPLElbz90f3EXx28z';

	$tokens=[];
	foreach ($receivers ??[] as $key => $value) {
		$tokens[]=$value->device_token;
	}

	$data = [
		"registration_ids" => $tokens,
		"notification" => [
			"title" => app()->getLocale() == 'ar' ? 'إشعار جديد' : 'New Notification',
			"body" => app()->getLocale() == 'ar' ? $message_ar : $message_en,
		]
	];
	$dataString = json_encode($data);

	$headers = [
		'Authorization: key=' . $SERVER_API_KEY,
		'Content-Type: application/json',
	];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

	$response = curl_exec($ch);

	//store notifications


	foreach ($receivers ??[] as $key => $value) {
		Notification::create([
			'receiver_id'=>$value->id,
			'receiver_type'=>$receiver_type,
			'sender_type'=>$sender_type,
			'sender_id'=>auth()->user()->id??\Auth::guard('admin')->user()->id,
			'message_ar'=>$message_ar,
			'message_en'=>$message_en,
			'url'=>$url,
		]);
	}
	// dd($response);
}

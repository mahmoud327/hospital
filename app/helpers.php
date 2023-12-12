<?php



function notifyByFirebase($title,$body,$tokens,$data = [])        // paramete 5 =>>>> $type
{
    $registrationIDs = $tokens;
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );
    // dd( $registrationIDs);
    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => $data
    );
    $headers = array(
        'Authorization: key='.env('FIREBASE_CREDENTIALS'),
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

if (!function_exists('sendJsonResponse')) {
    /**
     * @param $result
     * @param $message
     */
    function sendJsonResponse($result, $message = '')
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }
}

if (!function_exists('sendJsonError')) {
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    function sendJsonError($errorMessages, $code = 200)
    {
        $response = [
            'success' => false,
            'message' => $errorMessages,
            'data'    => null,
        ];

        return response()->json($response, $code);
    }
}



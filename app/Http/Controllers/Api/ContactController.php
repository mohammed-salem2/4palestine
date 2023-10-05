<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponses;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    use ApiResponses;
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->fail(status: false, code: 422, message: "", errors: $validator->messages(), data: null);
        }

        $contacts = Contact::create([
            'user_id' => $request->get('user_id'),
            // 'user_id' => auth('mobile')->user()->id,
            'message' => $request->get('message'),
        ]);
        if ($contacts) {
            return $this->tiny_success_t(code: 200, message: __('messages.contact_message'));
        } else {
            return $this->tiny_fail(status: false, code: 200, message: __('messages.something_wrong'));
        }
    }
}

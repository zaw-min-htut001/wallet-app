<?php

namespace App\Http\Requests;

use App\Models\Wallet;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        return [
            'amount' => ['required', 'numeric', 'min:1' ,
                function($attribute, $value, $fail) use ($wallet) {
                    if (!$wallet) {
                        return $fail('Wallet not found.');
                    }
                    if ($value > $wallet->amount) {
                        return $fail('Insufficient wallet balance.');
                    }
                }
            ],
            'note' => ['required']
        ];
    }
}

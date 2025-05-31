<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoadCardRequest extends FormRequest
{
    //Determinar se o utilizador está autorizado a fazer esta requisição
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
        $rules = [
            'method' => 'required|in:visa,paypal,mbway',
            'amount' => 'required|numeric|min:1',

            'card_number' => 'required_if:method,visa|nullable|string',
            'cvc' => 'required_if:method,visa|nullable|string',

            'paypal_email' => 'required_if:method,paypal|nullable|email',

            'mbway_phone' => 'required_if:method,mbway|nullable|string',
        ];
        return $rules;
    }

    public function messages(): array
{
    return [
        'amount.required' => 'Amount is required.',
        'amount.numeric' => 'Amount must be an integer.',
        'amount.min' => 'Amount must be equal or greater that 1€.',

        'card_number.required_if' => 'Number card is required.',
        'cvc.required_if' => 'CVC is requires.',
        'paypal_email.required_if' => 'Email is required.',
        'mbway_phone.required_if' => 'MB Way Number is required.',
    ];
}

}

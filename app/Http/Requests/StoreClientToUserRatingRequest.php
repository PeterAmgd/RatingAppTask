<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientToUserRatingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'user_id' => 'required|exists:users,id', // This is not necessary because the user_id is already set in controller
            'rating' => 'required|integer|between:1,5', // Example rating scale from 1 to 5
            'comment' => 'nullable|string|max:255',
        ];
    }
}

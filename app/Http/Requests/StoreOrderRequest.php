<?php

namespace App\Http\Requests;

use App\Models\User;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {   
        if(in_array(Auth::user()->role, ['root', 'admin'])) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'driver_id' => 'required|numeric|exists:drivers,id',
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'return_at' => 'required|after:'.date('Y-m-d H:i:s:00', time() + 3600),
            'staff_ids' => ['required', 'array', 'between:2,5', 
                function (string $attribute, mixed $value, Closure $fail) {
                    if (!User::where('role', 'staff')->whereIn('id', $value)->count() === count($value)) {
                        $fail("The {$attribute} is invalid.");
                    }
                },
            ],
        ];
    }
}

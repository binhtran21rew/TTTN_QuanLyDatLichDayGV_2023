<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'idTime' => 'required|not_in:0',
            'idCourse' => 'required|not_in:0',
            'idTeacher' => 'required|not_in:0',
            'idClass' => 'required|not_in:0',
        ];
    }
}

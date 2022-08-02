<?php

namespace Modules\EventScheduler\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEventRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            "description" => 'required|min:3',
            "event_time" => 'required|date_format:d/m/Y H:i',
            "email_to_notification" => 'required|email'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo nome precisa ter no minímo 3 caracteres.',
            'name.max' => 'O campo nome precisa ter no máximo 255 caracteres.',
            'description.required' => 'O campo event time é obrigatório.',
            'description.required' => 'O campo nome precisa ter no minímo 3 caracteres.',
            'event_time.required' => 'O campo event time é obrigatório.',
            'event_time.date_format' => 'O campo event time não é compatível com o formato :format.',
            'email_to_notification.required' => 'O campo e-mail é obrigatório.',
            'email_to_notification.date_format' => 'O campo e-mail precisa ser um e-mail válido.',
        ];
    }
}

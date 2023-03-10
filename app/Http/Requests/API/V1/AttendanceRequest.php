<?php

namespace App\Http\Requests\API\V1;

use App\Http\Requests\API\FormRequest;
use Illuminate\Validation\Rule;

class AttendanceRequest extends FormRequest
{

    const PREFIX = 'attendances.';
    const ROUTE = [
        'index' => self::PREFIX . 'index', // List all courses
        'show' => self::PREFIX . 'show', // Show a course
        'store' => self::PREFIX . 'store', // Store a course
        'destroy' => self::PREFIX . 'destroy', // Store a course
        'edit' => self::PREFIX . 'edit', // Edit a course
        'update' => self::PREFIX . 'update', // Update a course
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // Stores the current request route
        $currentRouteName = $this->route()->getName();

        if ($currentRouteName === self::ROUTE['index']) {
            return [];
        }

        if ($currentRouteName === self::ROUTE['show']) {

            return [];
        }

        if ($currentRouteName === self::ROUTE['store']) {
            return [
                'student' => ['bail', 'required', 'uuid', 'max:150', Rule::exists('students', 's_id')],
                'course' => ['bail','required', 'uuid', Rule::exists('courses', 'c_id')],
                'is_present' =>  ['bail','required', 'boolean'],
                'total_classes' => ['required', 'integer'],
            ];
        }

        if ($currentRouteName === self::ROUTE['destroy']) {
            return [];
        }

        if ($currentRouteName === self::ROUTE['update']) {
            return [
                'student' => ['bail', 'required', 'uuid', 'max:150', Rule::exists('students', 's_id')],
                'course' => ['bail','required', 'uuid', Rule::exists('courses', 'c_id')],
                'is_present' =>  ['bail','required', 'boolean'],
                'total_classes' => ['required', 'integer'],
            ];
        }
        return [];
    }
}

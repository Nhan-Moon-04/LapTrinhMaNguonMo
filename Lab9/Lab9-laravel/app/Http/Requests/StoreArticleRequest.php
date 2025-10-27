<?php

namespace App\Http\Requests;

use App\Rules\NoForbiddenWords;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Cho phép tất cả (có thể thêm logic phân quyền sau)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255','unique:articles,title', new NoForbiddenWords],
            'body' => ['required','string','min:10'],
            'tags' => ['sometimes','nullable','string'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.unique' => 'Tiêu đề đã tồn tại, vui lòng chọn tiêu đề khác',
            'body.required' => 'Nội dung không được để trống',
            'body.min' => 'Nội dung tối thiểu phải có :min ký tự',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng: jpg, jpeg hoặc png.',
            'image.max' => 'Kích thước ảnh tối đa là :max KB.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'body' => 'Nội dung',
            'image' => 'Ảnh minh hoạ',
        ];
    }
}

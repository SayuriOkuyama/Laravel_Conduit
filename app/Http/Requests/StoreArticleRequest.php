<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreArticleRequest extends FormRequest
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
    return [
      'title' => ['required', 'string', 'max:100'],
      'about' => ['required', 'string', 'max:255'],
      'content' => ['required', 'string'],
      'tag' => ['array', 'nullable'],
      'tags.*' => ['string', 'max:20', 'nullable']
    ];
  }

  /**
   * バリデーションエラー時に例外を投げる
   *
   * @param  \Illuminate\Contracts\Validation\Validator  $validator
   * @return void
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  protected function failedValidation(Validator $validator)
  {
    // 加工後のデータを使ってリクエストオブジェクトを書き換える
    request()->merge($this->input());

    // 基底クラスの処理を実行
    parent::failedValidation($validator);
  }
}

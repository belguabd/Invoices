<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'invoice_number' => 'required|unique:invoices|max:255',
            'invoice_Date' => 'required|date',
            'Due_date' => 'required|date',
            'product' => 'required',
            'Section' => 'required',
            'Amount_collection' => 'required|numeric',
            'Amount_Commission' => 'required|numeric',
            'Discount' => 'required|numeric',
            'Value_VAT' => 'required|numeric',
            'Rate_VAT' => 'required',
            'Total' => 'required|numeric',
            'note' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'invoice_number.required' => 'حقل رقم الفاتورة مطلوب.',
            'invoice_number.unique' => 'رقم الفاتورة مُسجل مسبقًا.',
            'invoice_number.max' => 'رقم الفاتورة يجب ألا يتجاوز 255 حرفًا.',
            'invoice_Date.required' => 'حقل تاريخ الفاتورة مطلوب.',
            'invoice_Date.date' => 'تاريخ الفاتورة يجب أن يكون تاريخًا صالحًا.',
            'Due_date.required' => 'حقل تاريخ الاستحقاق مطلوب.',
            'Due_date.date' => 'تاريخ الاستحقاق يجب أن يكون تاريخًا صالحًا.',
            'product.required' => 'حقل المنتج مطلوب.',
            'Section.required' => 'حقل القسم مطلوب.',
            'Amount_collection.required' => 'حقل مبلغ التحصيل مطلوب.',
            'Amount_collection.numeric' => 'مبلغ التحصيل يجب أن يكون رقمًا.',
            'Amount_Commission.required' => 'حقل مبلغ العمولة مطلوب.',
            'Amount_Commission.numeric' => 'مبلغ العمولة يجب أن يكون رقمًا.',
            'Discount.required' => 'حقل الخصم مطلوب.',
            'Discount.numeric' => 'الخصم يجب أن يكون رقمًا.',
            'Value_VAT.required' => 'حقل قيمة ضريبة القيمة المضافة مطلوب.',
            'Value_VAT.numeric' => 'قيمة ضريبة القيمة المضافة يجب أن تكون رقمًا.',
            'Rate_VAT.required' => 'حقل نسبة ضريبة القيمة المضافة مطلوب.',
            'Total.required' => 'حقل الاجمالي مطلوب.',
            'Total.numeric' => 'الاجمالي يجب أن يكون رقمًا.',
            'note.required' => 'حقل الملاحظات مطلوب.',
        ];
    }
}

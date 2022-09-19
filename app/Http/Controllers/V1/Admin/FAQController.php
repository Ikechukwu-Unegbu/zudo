<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\V1\Admin\Faq;
use App\Models\V1\Admin\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FAQController extends Controller
{
    public function categoryIndex()
    {
        return view('admin.faq.category.index', ['categories' => FaqCategory::orderBy('created_at', 'DESC')->get()]);
    }

    public function categoryStore(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|unique:faq_categories,name']);

        FaqCategory::create([
            'name'  =>  $request->name,
            'slug'  =>  Str::random(10)
        ]);

        session()->flash('success', 'FAQ Category Created Successfully');
        return redirect()->to(route('admin.faq.category.index'));
    }

    public function categoryUpdate(Request $request, FaqCategory $category)
    {
        $this->validate($request, ['name' => 'required|string|unique:faq_categories,name,'.$category->id]);

        $category->update([
            'name'  =>  $request->name,
        ]);

        session()->flash('success', 'FAQ Category Updated Successfully');
        return redirect()->to(route('admin.faq.category.index'));
    }

    public function categoryDestroy(FaqCategory $category)
    {
        $category->delete();
        session()->flash('success', 'FAQ Category Deleted Successfully');
        return redirect()->to(route('admin.faq.category.index'));
    }


    public function faqIndex()
    {
        return view('admin.faq.index', [
            'faqs' => Faq::with('category')->orderBy('created_at', 'DESC')->get(),
            'categories' => FaqCategory::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function faqStore(Request $request)
    {
        $this->validate($request, [
            'category'  =>  'required|integer',
            'question'  =>  'required|string|unique:faqs,question',
            'answer'    =>  'required|string'
        ]);

        Faq::create([
            'category_id'  =>  $request->category,
            'question'  =>  $request->question,
            'answer'    =>  $request->answer,
            'slug'      =>  Str::random(10)
        ]);

        session()->flash('success', 'FAQ Created Successfully');
        return redirect()->to(route('admin.faq.index'));
    }

    public function faqUpdate(Request $request, Faq $faq)
    {
        $this->validate($request, [
            'category'  =>  'required|integer',
            'question'  =>  'required|string|unique:faqs,question,'.$faq->id,
            'answer'    =>  'required|string'
        ]);
        $faq->update([
            'category_id'  =>  $request->category,
            'question'  =>  $request->question,
            'answer'    =>  $request->answer,
            'slug'      =>  Str::random(10)
        ]);

        session()->flash('success', 'FAQ Updated Successfully');
        return redirect()->to(route('admin.faq.index'));
    }

    public function faqDestroy(Faq $faq)
    {
        $faq->delete();
        session()->flash('success', 'FAQ Deleted Successfully');
        return redirect()->to(route('admin.faq.index'));
    }
}

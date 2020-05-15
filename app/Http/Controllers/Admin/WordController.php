<?php

namespace App\Http\Controllers\Admin;

use App\Word;
use App\Choice;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\WordRequest;
use App\Http\Controllers\Controller;

class WordController extends Controller
{
    public function list(Category $category)
    {
        $words = $category->words()->orderBy('id', 'asc')->paginate(10);

        return view('admin.word.list', compact(['words', 'category']));
    }

    public function add(Category $category)
    {
        return view('admin.word.add', compact('category'));
    }

    public function store(WordRequest $request, Category $category)
    {
        $validated = $request->validated();
        $created_word = Word::create([
            'category_id' => $category->id,
            'content' => $validated['content']
        ]);

        for ($i = 0; $i < count($validated['choices']); $i++) {
            $data[$i] = [
                'word_id'             => $created_word->id,
                'content'             => $validated['choices'][$i],
                'correct_answer_flag' => $validated['correct_answer'] == $i ? true : false,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ];
        }

        Choice::insert($data);

        return redirect('/admin/word/list/category/' . $category->id)
            ->with('my_status', __("Succeeded to add word of {$validated['content']}!"));
    }

    public function edit(Word $word)
    {
        return view('admin.word.edit', compact('word'));
    }

    public function update(WordRequest $request, Word $word)
    {
        $validated = $request->validated();
        $word->update([
            'content' => $validated['content']
        ]);

        for ($i = 0; $i < count($validated['choices']); $i++) {
            Choice::where('id', $validated['choice_ids'][$i])
                ->update([
                    'content' => $validated['choices'][$i],
                    'correct_answer_flag' => $validated['correct_answer'] == $validated['choice_ids'][$i] ? true : false
                ]);
        }

        return redirect('/admin/word/list/category/' . $word->category_id)
            ->with('my_status', __("Succeeded to edit word to {$validated['content']}!"));
    }

    public function delete(Word $word)
    {
        $word->delete();

        return redirect('/admin/word/list/category/' . $word->category_id)
            ->with('my_status', __("Succeeded to delete word of {$word->content}!"));
    }
}

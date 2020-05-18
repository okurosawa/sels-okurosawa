<?php

namespace App\Http\Controllers\Admin;

use App\Word;
use App\Choice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChoiceRequest;

class ChoiceController extends Controller
{
    public function list(Word $word)
    {
        $choices = $word->choices()->orderBy('id', 'asc')->paginate(10);

        return view('admin.choice.list', compact(['choices', 'word']));
    }

    public function add(Word $word)
    {
        return view('admin.choice.add', compact('word'));
    }

    public function store(ChoiceRequest $request, Word $word)
    {
        $validated = $request->validated();
        Choice::create([
            'word_id' => $word->id,
            'content' => $validated['content']
        ]);

        return redirect('/admin/choice/list/word/' . $word->id)
            ->with('my_status', __("Succeeded to add choice of {$validated['content']}!"));
    }

    public function edit(Choice $choice)
    {
        return view('admin.choice.edit', compact('choice'));
    }

    public function update(ChoiceRequest $request, Choice $choice)
    {
        $validated = $request->validated();
        $choice->update([
            'content' => $validated['content']
        ]);

        return redirect('/admin/choice/list/word/' . $choice->word_id)
            ->with('my_status', __("Succeeded to edit choice to {$validated['content']}!"));
    }

    public function delete(Choice $choice)
    {
        if ($choice->correct_answer_flag == true) {
            return redirect('/admin/choice/list/word/' . $choice->word_id)
                ->with('my_status', __("You can't delete correct answer!"));
        }

        $choice->delete();

        return redirect('/admin/choice/list/word/' . $choice->word_id)
            ->with('my_status', __("Succeeded to delete word of {$choice->content}!"));
    }
}

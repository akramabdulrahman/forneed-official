<?php

namespace App\Http\Controllers\EndUsers\ServiceProvider;

use App\Http\Requests\QuestionRequest;

use App\Models\Surveys\Answer;
use App\Models\Surveys\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Laracasts\Flash\Flash;

class QuestionsController extends Controller
{
    public function create($id)
    {
        return view('endusers.organizations.forms.questions.create', ['survey_id' => $id]);
    }

    public function edit($id)
    {
        $question = Question::find($id);
        return view('endusers.organizations.forms.questions.edit', ['question' => $question]);

    }

    public function store(QuestionRequest $request)
    {
        $question = null;
        $input = $request->all();
        DB::transaction(function () use ($input, &$question) {
            $input['order'] = $input['survey_id'];
            $question = Question::create($input);
            if (isset($input['answer'])) {
                foreach (array_filter($input['answer']) as $answer) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer' => $answer,
                        'order' => $question->id
                    ]);
                }
            }
        });
        if (($question !== null)) {
            Flash::success('Survey saved successfully.');
            return redirect()->back();
        } else {
            Flash::error('something went wrong.');

            return redirect()->back();
        }
    }

    public function update(QuestionRequest $request, $id)
    {
        $question = null;
        $input = $request->all();
        //  dd($input);
        DB::transaction(function () use ($input, &$question, $id) {
            $question = Question::find($id);
            $question->update($input);
            if (isset($input['answer'])) {
                Answer::where('question_id', '=', $question->id)->delete();
                foreach (array_filter($input['answer']) as $answer) {
                    Answer::Create([
                        'question_id' => $question->id,
                        'answer' => $answer,
                        'order' => $question->id
                    ]);
                }
            }


        });
        if (($question !== null)) {
            Flash::success('Survey saved successfully.');
            return redirect()->back();
        } else {
            Flash::error('something went wrong.');

            return redirect()->back();
        }

    }

    public function delete($id)
    {
        if (Question::find($id)->delete()) {
            Flash::success('Question deleted successfully.');
        }
        return redirect()->back();
    }
}

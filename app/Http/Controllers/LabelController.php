<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(): View
    {
        return view('label.index', ['models' => Label::all()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label.name' => 'required|string|unique:labels,name',
            'label.description' => 'nullable|string',
        ]);

        Label::create($validated['label']);

        flash()->success(__('label.stored'));

        return redirect(route('labels.index'));
    }

    public function create(): View
    {
        return view('label.create');
    }

    public function edit(Label $label): View
    {
        return view('label.edit', ['model' => $label]);
    }

    public function update(Request $request, Label $label): RedirectResponse
    {
        $validated = $request->validate([
            'label.name' => 'string|unique:labels,name',
            'label.description' => 'nullable|string',
        ]);

        $label->update($validated['label']);

        flash()->success(__('label.updated'));

        return redirect(route('labels.index'));
    }

    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->exists()) {
            flash()->error(__('label.has_tasks'));
            return back()->withErrors([
                'message' => __('label.has_tasks'),
            ]);
        }

        $label->delete();

        flash()->success(__('label.deleted'));

        return redirect(route('labels.index'));
    }
}

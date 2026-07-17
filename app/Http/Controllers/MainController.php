<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected ?User $user = null;

    public function __construct()
    {
        $userId = session('user.id');

        $this->user = User::with('notes')->find($userId);
    }

    public function index()
    {
        return view('home', [
            'user' => $this->user
        ]);
    }

    public function createNote()
    {
        return view('new_note', [
            'user' => $this->user
        ]);
    }

    private function validateNoteData(Request $request)
    {
        $validated = $request->validate(
            [
                'text_title'           => 'required|min:3|max:200',
                'text_note'            => 'required|min:3|max:3000',
            ],
            [
                'text_title.required'  => 'O título é obrigatório!',
                'text_title.min'       => 'O título deve ter pelo menos :min caracteres',
                'text_title.max'       => 'O título deve ter no máximo :max caracteres',

                'text_note.required'   => 'O texto é obrigatório',
                'text_note.min'        => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max'        => 'A nota deve ter no máximo :max caracteres',
            ]
        );

        return $validated;
    }

    public function storeNote(Request $request)
    {
        $this->validateNoteData($request);

        $payload = [
            'user_id' => $this->user->id,
            'title'   => $request->text_title,
            'text'    => $request->text_note
        ];

        Note::create($payload);
        return redirect()->route('home');
    }

    public function editNote(string $id)
    {
        $note = Note::with('user')->findOrFail(Operations::decryptId($id));

        if (!$note) {
            return redirect()->route('home');
        }

        return view('edit_note', [
            'note' => $note,
            'user' => $note->user
        ]);
    }

    public function updateNote(Request $request)
    {
        $this->validateNoteData($request);

        if (!$request->note_id) {
            return redirect()->to('home');
        }

        $note = Note::findOrFail(Operations::decryptId($request->note_id));

        if (!$note) {
            return redirect()->route('home');
        }

        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
    }

    public function destroyNote(Request $req, string $id)
    {
        $note = Note::findOrFail(Operations::decryptId($id));

        if (!$note) {
            return redirect()->route('home');
        }

        return view('delete_note', [
            'note' => $note,
            'user' => $this->user
        ]);
    }

    public function deleteConfirm(string $id)
    {
        $note = Note::findOrFail(Operations::decryptId($id));

        if (!$note) {
            return redirect()->route('home');
        }

        $note->delete();
        return redirect()->route('home');
    }
}

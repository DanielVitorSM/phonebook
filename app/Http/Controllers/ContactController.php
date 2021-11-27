<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\matches;

class ContactController extends Controller
{
    /**
     * Show all contacts or search by contacts using name or phone
     */
    public function show(Request $request) {
        $search = $request->get('search');

        if($search) {
            $contacts = Contact::
                where('name', 'like', '%'.$search.'%')
                ->orWhere('cell', 'like', '%'.$search.'%')
                ->get();
        } else {
            $contacts = Auth::user()->contacts;
        }

        return view('home', ['contacts' => $contacts, 'search' => $search]);
    }

    /**
     * Show a view with data from cell number
     */

    public function find(Request $request, $cell) {
        $contact = Contact::where([
            ['user_id', '=', Auth::id()],
            ['cell', '=', $cell]
        ])->first();

        if($contact) {
            return view('contacts/show', ['contact' => $contact]);
        }
        return back()->withErrors(['not_finded' => 'Contato não encontrado']);
    }

    /**
     * Stores a new contact on the databases
     */
 
    public function store(Request $request) {
        $data = $request->validate([
            'image' => ['nullable', 'file'],
            'name' => ['required', 'string'],
            'cell' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'email' => ['nullable', 'email']
        ]);

        $data['user_id'] = Auth::id();
        $data['cell'] = $this->escapePhone($data['cell']);
        $data['phone'] = $this->escapePhone($data['phone']);

        $has_contact = $this->checkCellAlreadySaved($data['cell']);

        if($has_contact) {
            return back()->withErrors(['already_registered' => 'Esse celular já está nos contatos']);
        }


        /**
         * Upload and save an contact image
         */

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = date_timestamp_get(date_create())."_".md5($file->getClientOriginalName()).$file->getClientOriginalExtension();
            $file->move(public_path()."/images/contacts/", $name);
            $data['image'] = $name;
        }

        $contact = new Contact($data);
        if($contact->save()){
            return redirect("/");
        }
        return back()->withErrors(['failed' => 'Não foi possível adicionar este contato']);
    }
    
    public function update(Request $request, $id) {
        $data = $request->validate([
            'image' => ['nullable', 'file'],
            'name' => ['required', 'string'],
            'cell' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'email' => ['nullable', 'email']
        ]);

        $data['user_id'] = Auth::id();
        $data['cell'] = $this->escapePhone($data['cell']);
        $data['phone'] = $this->escapePhone($data['phone']);

        $has_contact = $this->checkCellAlreadySaved($data['cell'], $id);

        if($has_contact) {
            return back()->withErrors(['already_registered' => 'Esse celular já está nos contatos']);
        }

        /**
         * Upload and save an contact image
         */

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = date_timestamp_get(date_create())."_".md5($file->getClientOriginalName()).$file->getClientOriginalExtension();
            $file->move(public_path()."/images/contacts/", $name);
            $data['image'] = $name;
        }

        $contact = Contact::find($id)->update($data);
        if($contact){
            return redirect("/");
        }
        return back()->withErrors(['failed' => 'Não foi possível atualizar este contato']);
    }

    /**
     * Delete an contact with id
     */

    public function delete($id) {
        $result = Contact::where([
            ['id', '=', $id],
            ['user_id', '=', Auth::id()]
        ])->delete();

        if($result) {
            return redirect('/');
        }
        return back()->withErrors(['failed', 'Não foi possível apagar esse contato']);
    }

    /**
     * Removes any non-numeric characters for phone
     * @param text string | null
     */

    private function escapePhone($text) {
        return preg_filter("/\D/m", "", $text);
    }

    /**
     * Verify if a cell number is already registered on user id
     * @param text string
     */

    private function checkCellAlreadySaved(string $cell, $id = null) {
        if(!$id) {
            $result = Contact::where([
                ['cell', '=', $cell],
                ['user_id', '=', Auth::id()]
            ])->first();
        } else {
            $result = Contact::where([
                ['cell', '=', $cell],
                ['user_id', '=', Auth::id()],
                ['id', '!=', $id]
            ])->first();
        }

        return $result;
    }
}
